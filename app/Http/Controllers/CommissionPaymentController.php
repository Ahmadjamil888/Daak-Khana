<?php

namespace App\Http\Controllers;

use App\Models\CourierCompany;
use App\Services\CommissionService;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Exception;
use Illuminate\Support\Facades\Schema;

class CommissionPaymentController extends Controller
{
    protected $commissionService;
    protected $stripeService;

    public function __construct(CommissionService $commissionService, StripeService $stripeService)
    {
        $this->middleware('auth');
        $this->middleware('courier.company'); // Ensure user has courier company
        $this->commissionService = $commissionService;
        $this->stripeService = $stripeService;
    }

    /**
     * Show commission payment dashboard
     */
    public function index()
    {
        $user = Auth::user();
        
        if (!$user->isCourier()) {
            abort(403, 'Only courier companies can access this page.');
        }

        $company = $user->courierCompany;
        
        if (!$company) {
            return redirect()->route('courier.company.create')
                           ->with('error', 'Please create your courier company profile first.');
        }

        $commissionsEnabled = Schema::hasTable('courier_company_commissions')
            && Schema::hasColumn('courier_companies', 'is_commission_restricted')
            && Schema::hasColumn('courier_companies', 'total_commission_due');
        if (!$commissionsEnabled) {
            $commissionSummary = [
                'total_unpaid' => 0,
                'formatted_total_unpaid' => $company->currency_symbol . ' ' . number_format(0, 0),
                'unpaid_count' => 0,
                'overdue_count' => 0,
                'days_until_restriction' => null,
                'is_restricted' => false,
                'restriction_message' => null,
                'can_receive_bookings' => true,
                'next_due_date' => null,
            ];
            $commissionHistory = collect();
        } else {
            $commissionSummary = $this->commissionService->getCommissionSummary($company);
            $commissionHistory = $this->commissionService->getCommissionHistory($company, 20);
        }
        
        return view('courier.commissions.index', compact('commissionSummary', 'commissionHistory', 'company', 'commissionsEnabled'));
    }

    /**
     * Create payment intent for commission payment
     */
    public function createPaymentIntent(Request $request)
    {
        try {
            $user = Auth::user();
            $company = $user->courierCompany;
            
            if (!$company) {
                return response()->json([
                    'error' => 'Courier company not found'
                ], 404);
            }

            $request->validate([
                'commission_ids' => 'required|array',
                'commission_ids.*' => 'exists:courier_company_commissions,id'
            ]);

            // Verify all commissions belong to this company and are unpaid
            $commissions = $company->commissions()
                                 ->whereIn('id', $request->commission_ids)
                                 ->unpaid()
                                 ->get();
            
            if ($commissions->isEmpty()) {
                return response()->json([
                    'error' => 'No valid unpaid commissions found'
                ], 400);
            }

            $totalAmount = $commissions->sum('commission_amount');
            $currency = strtolower($company->currency);

            // Create Stripe Payment Intent
            $paymentIntent = $this->stripeService->createCommissionPaymentIntent(
                $totalAmount,
                $currency,
                [
                    'company_id' => (string) $company->id,
                    'company_name' => $company->company_name,
                    'commission_ids' => json_encode($request->commission_ids),
                    'commission_count' => (string) $commissions->count(),
                    'user_id' => (string) $user->id,
                ]
            );

            return response()->json([
                'client_secret' => $paymentIntent->client_secret,
                'payment_intent_id' => $paymentIntent->id,
                'total_amount' => $totalAmount,
                'currency' => $currency,
                'commission_count' => $commissions->count(),
            ]);

        } catch (Exception $e) {
            Log::error('Failed to create commission payment intent', [
                'user_id' => Auth::id(),
                'company_id' => $company->id ?? null,
                'error' => $e->getMessage(),
                'commission_ids' => $request->commission_ids ?? []
            ]);

            return response()->json([
                'error' => 'Failed to create payment intent: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Handle successful payment confirmation
     */
    public function confirmPayment(Request $request)
    {
        try {
            $request->validate([
                'payment_intent_id' => 'required|string',
                'commission_ids' => 'required|array'
            ]);

            $user = Auth::user();
            $company = $user->courierCompany;
            
            // Verify payment with Stripe
            Stripe::setApiKey(config('services.stripe.secret'));
            $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);
            
            if ($paymentIntent->status !== 'succeeded') {
                return response()->json([
                    'error' => 'Payment not completed successfully'
                ], 400);
            }

            // Process the payment
            $result = $this->commissionService->processCommissionPayment(
                $company,
                $request->commission_ids,
                $request->payment_intent_id,
                [
                    'stripe_payment_intent_id' => $paymentIntent->id,
                    'amount_paid' => $paymentIntent->amount / 100, // Convert from cents
                    'currency' => $paymentIntent->currency,
                    'payment_method' => $paymentIntent->payment_method,
                    'processed_at' => now(),
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Payment processed successfully!',
                'result' => $result,
                'redirect_url' => route('courier.commissions.index')
            ]);

        } catch (Exception $e) {
            Log::error('Failed to confirm commission payment', [
                'user_id' => Auth::id(),
                'payment_intent_id' => $request->payment_intent_id ?? null,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'error' => 'Failed to process payment: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show payment form for specific commissions
     */
    public function paymentForm(Request $request)
    {
        $user = Auth::user();
        $company = $user->courierCompany;
        
        if (!Schema::hasTable('courier_company_commissions')) {
            return redirect()->route('courier.commissions.index')
                           ->with('error', 'Commission system is not initialized yet. Please contact support.');
        }
        
        // Normalize commission_ids to array if passed as CSV/string
        $ids = $request->input('commission_ids');
        if (!is_array($ids)) {
            // Try JSON decode first
            $decoded = json_decode($ids, true);
            if (is_array($decoded)) {
                $ids = $decoded;
            } else {
                // Fallback CSV split
                $ids = array_filter(array_map('trim', explode(',', (string) $ids)));
            }
            $request->merge(['commission_ids' => $ids]);
        }
        
        $request->validate([
            'commission_ids' => 'required|array',
            'commission_ids.*' => 'integer|exists:courier_company_commissions,id'
        ]);

        $commissions = $company->commissions()
                             ->whereIn('id', $request->commission_ids)
                             ->unpaid()
                             ->with('booking')
                             ->get();
        
        if ($commissions->isEmpty()) {
            return redirect()->route('courier.commissions.index')
                           ->with('error', 'No valid unpaid commissions found.');
        }

        $totalAmount = $commissions->sum('commission_amount');
        $stripePublicKey = config('services.stripe.publishable');
        
        return view('courier.commissions.payment-form', compact(
            'commissions', 
            'totalAmount', 
            'company', 
            'stripePublicKey'
        ));
    }

    /**
     * Pay all outstanding commissions
     */
    public function payAll()
    {
        try {
            $user = Auth::user();
            $company = $user->courierCompany;
            
            if (!Schema::hasTable('courier_company_commissions')) {
                return redirect()->route('courier.commissions.index')
                               ->with('error', 'Commission system is not initialized yet. Please contact support.');
            }
            
            $unpaidCommissions = $company->getUnpaidCommissions();
            
            if ($unpaidCommissions->isEmpty()) {
                return redirect()->route('courier.commissions.index')
                               ->with('info', 'No outstanding commissions to pay.');
            }

            $commissionIds = $unpaidCommissions->pluck('id')->toArray();
            
            // Redirect to payment form with commission_ids as query parameters (GET)
            return redirect()->route('courier.commissions.payment-form', [
                'commission_ids' => $commissionIds
            ]);
        } catch (\Throwable $e) {
            \Log::error('Pay All failed', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);
            return redirect()->route('courier.commissions.index')
                           ->with('error', 'Failed to load payment interface. Please try again.');
        }
    }

    /**
     * Show commission details
     */
    public function show($commissionId)
    {
        $user = Auth::user();
        $company = $user->courierCompany;
        
        $commission = $company->commissions()
                            ->with(['booking.customer'])
                            ->findOrFail($commissionId);
        
        return view('courier.commissions.show', compact('commission', 'company'));
    }
}
