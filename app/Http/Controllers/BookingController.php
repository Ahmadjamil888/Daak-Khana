<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\CourierCompany;
use App\Models\CourierService;
use App\Services\CommissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class BookingController extends Controller
{
    /**
     * Display a listing of bookings
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isCustomer()) {
            $bookings = $user->bookings()
                ->with(['courierCompany', 'courierService'])
                ->latest()
                ->paginate(10);
        } else {
            $company = $user->courierCompany;
            $bookings = $company ? $company->bookings()
                ->with(['customer', 'courierService'])
                ->latest()
                ->paginate(10) : collect();
        }

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new booking
     */
    public function create(Request $request)
    {
        if (!Auth::user()->isCustomer()) {
            return redirect()->route('courier.dashboard')->with('error', 'Access denied.');
        }

        $companies = CourierCompany::with('services')
            ->where('is_verified', true)
            ->get();

        $selectedCompany = null;
        $selectedService = null;

        if ($request->has('company_id')) {
            $selectedCompany = CourierCompany::with('services')->find($request->company_id);
        }

        if ($request->has('service_id')) {
            $selectedService = CourierService::find($request->service_id);
        }

        return view('bookings.create', compact('companies', 'selectedCompany', 'selectedService'));
    }

    /**
     * Store a newly created booking
     */
    public function store(Request $request)
    {
        if (!Auth::user()->isCustomer()) {
            return redirect()->route('courier.dashboard')->with('error', 'Access denied.');
        }

        $request->validate([
            'courier_company_id' => 'required|exists:courier_companies,id',
            'courier_service_id' => 'required|exists:courier_services,id',
            'pickup_address' => 'required|string|max:500',
            'delivery_address' => 'required|string|max:500',
            'pickup_date' => 'required|date|after:now',
            'package_weight' => 'required|numeric|min:0.1',
            'package_dimensions' => 'required|string|max:255',
            'package_description' => 'required|string|max:500',
            'special_instructions' => 'nullable|string|max:1000',
        ]);

        $service = CourierService::findOrFail($request->courier_service_id);
        $company = CourierCompany::findOrFail($request->courier_company_id);

        // Prevent new bookings if the courier is restricted due to unpaid commissions (>10 days)
        if (Schema::hasTable('courier_company_commissions') && Schema::hasColumn('courier_companies', 'is_commission_restricted')) {
            if ($company->is_commission_restricted || $company->shouldBeRestricted()) {
                // Apply restriction if overdue
                if (!$company->is_commission_restricted && $company->shouldBeRestricted()) {
                    $company->applyCommissionRestriction();
                }
                return back()->withErrors([
                    'courier_company_id' => 'Selected courier is temporarily unavailable due to unpaid commissions. Please choose another courier.'
                ])->withInput();
            }
        }

        // Calculate total amount (basic calculation)
        $basePrice = $service->price;
        $currency = $company->currency ?? 'PKR';
        // Use currency-appropriate weight multiplier
        $weightRate = $currency === 'USD' ? 0.5 : 25; // USD: $0.5 per kg, PKR: 25 per kg
        $weightMultiplier = $request->package_weight * $weightRate;
        $totalAmount = $basePrice + $weightMultiplier;

        // Check if user is pro and add pro features
        $isProBooking = Auth::user()->isProActive();
        $proFee = 0;
        $proFeatures = [];

        if ($isProBooking) {
            $proFeatures = ['real_time_tracking', 'priority_support', 'email_notifications'];
            // Pro users get enhanced features but no additional fee
        }

        // Add courier pro fee (80 PKR per order for courier companies)
        if ($company->user->isCourier()) {
            $proFee = 80; // PKR 80 per order for courier companies
        }

        $booking = Booking::create([
            'booking_number' => 'BK-' . strtoupper(Str::random(8)),
            'customer_id' => Auth::id(),
            'courier_company_id' => $request->courier_company_id,
            'courier_service_id' => $request->courier_service_id,
            'pickup_address' => $request->pickup_address,
            'delivery_address' => $request->delivery_address,
            'pickup_date' => $request->pickup_date,
            'total_amount' => $totalAmount,
            'special_instructions' => $request->special_instructions,
            'is_pro_booking' => $isProBooking,
            'real_time_tracking_enabled' => $isProBooking,
            'pro_features' => $proFeatures,
            'pro_fee' => $proFee,
            'package_details' => [
                'weight' => $request->package_weight,
                'dimensions' => $request->package_dimensions,
                'description' => $request->package_description,
            ],
            'tracking_updates' => [
                [
                    'status' => 'pending',
                    'message' => $isProBooking 
                        ? 'Pro booking created with real-time tracking enabled' 
                        : 'Booking created and pending confirmation',
                    'timestamp' => now()->toISOString(),
                ]
            ],
        ]);

        // Automatically deduct 5% commission from the booking
        try {
            $commissionService = app(CommissionService::class);
            $commissionService->deductCommissionFromBooking($booking);
        } catch (\Exception $e) {
            Log::error('Failed to deduct commission from booking', [
                'booking_id' => $booking->id,
                'error' => $e->getMessage()
            ]);
            // Don't fail the booking creation if commission deduction fails
        }

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Booking created successfully! Booking number: ' . $booking->booking_number);
    }

    /**
     * Display the specified booking
     */
    public function show(Booking $booking)
    {
        $user = Auth::user();
        
        // Check if user has access to this booking
        if ($user->isCustomer() && $booking->customer_id !== $user->id) {
            abort(403, 'Unauthorized access to booking.');
        }
        
        if ($user->isCourier() && $booking->courierCompany->user_id !== $user->id) {
            abort(403, 'Unauthorized access to booking.');
        }

        $booking->load(['customer', 'courierCompany', 'courierService']);

        return view('bookings.show', compact('booking'));
    }

    /**
     * Update booking status (for courier companies)
     */
    public function updateStatus(Request $request, Booking $booking)
    {
        $user = Auth::user();
        
        if (!$user->isCourier() || $booking->courierCompany->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'status' => 'required|in:confirmed,picked_up,in_transit,delivered,cancelled',
            'message' => 'nullable|string|max:500',
        ]);

        $oldStatus = $booking->status;

        // Update delivery date if status is delivered
        $updateData = ['status' => $request->status];
        if ($request->status === 'delivered') {
            $updateData['delivery_date'] = now();
        }

        $booking->update($updateData);

        // Add tracking update
        $trackingUpdates = $booking->tracking_updates ?? [];
        $trackingUpdates[] = [
            'status' => $request->status,
            'message' => $request->message ?? 'Status updated to ' . str_replace('_', ' ', $request->status),
            'timestamp' => now()->toISOString(),
        ];

        $booking->update(['tracking_updates' => $trackingUpdates]);

        // Send notification to customer (email for pro users, database for all)
        $booking->customer->notify(new \App\Notifications\BookingStatusUpdated(
            $booking, 
            $oldStatus, 
            $request->status, 
            $request->message
        ));

        return redirect()->back()->with('success', 'Booking status updated successfully!');
    }
}
