<?php

namespace App\Http\Controllers;

use App\Models\CourierCompany;
use App\Models\CourierService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourierCompanyController extends Controller
{
    /**
     * Display a listing of courier companies
     */
    public function index(Request $request)
    {
        $query = CourierCompany::with(['user', 'services'])
            ->orderBy('is_verified', 'desc')
            ->orderBy('is_featured', 'desc')
            ->orderBy('rating', 'desc');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('ai_generated_description', 'like', "%{$search}%");
            });
        }

        // Filter by service type
        if ($request->has('service_type') && $request->service_type) {
            $query->whereHas('services', function($q) use ($request) {
                $q->where('service_type', $request->service_type);
            });
        }

        // Filter by service areas
        if ($request->has('location') && $request->location) {
            $query->whereJsonContains('service_areas', $request->location);
        }

        $companies = $query->paginate(12);

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new courier company
     */
    public function create()
    {
        if (!Auth::user()->isCourier()) {
            return redirect()->route('dashboard')->with('error', 'Access denied.');
        }

        if (Auth::user()->courierCompany) {
            return redirect()->route('courier.company.profile')->with('info', 'You already have a company profile.');
        }

        return view('courier.company.create');
    }

    /**
     * Store a newly created courier company
     */
    public function store(Request $request)
    {
        if (!Auth::user()->isCourier()) {
            return redirect()->route('dashboard')->with('error', 'Access denied.');
        }

        $request->validate([
            'company_name' => 'required|string|max:255|unique:courier_companies',
            'description' => 'required|string|min:50',
            'service_areas' => 'required|array|min:1',
            'base_price' => 'required|numeric|min:0',
            'currency' => 'nullable|string|in:PKR,USD,EUR,GBP',
            'operating_hours' => 'required|array',
            'license_number' => 'nullable|string|max:255',
            'insurance_details' => 'nullable|string|max:500',
        ]);

        $company = CourierCompany::create([
            'user_id' => Auth::id(),
            'company_name' => $request->company_name,
            'description' => $request->description,
            'service_areas' => $request->service_areas,
            'base_price' => $request->base_price,
            'currency' => $request->currency ?? 'PKR',
            'operating_hours' => $request->operating_hours,
            'license_number' => $request->license_number,
            'insurance_details' => $request->insurance_details,
            'is_verified' => true, // Auto-verify new companies for now
            'rating' => 0.0,
            'total_reviews' => 0,
            'pricing_structure' => [
                'base_rate' => $request->base_price,
                'per_km' => $request->per_km ?? 0.5,
                'per_kg' => $request->per_kg ?? 0.2,
            ],
        ]);

        return redirect()->route('courier.dashboard')->with('success', 'Company profile created successfully!');
    }

    /**
     * Display the specified courier company
     */
    public function show(CourierCompany $company)
    {
        $company->load(['user', 'services' => function($query) {
            $query->where('is_active', true);
        }]);

        $recentReviews = $company->bookings()
            ->whereNotNull('rating')
            ->with('customer')
            ->latest()
            ->take(5)
            ->get();

        return view('companies.show', compact('company', 'recentReviews'));
    }

    /**
     * Show the courier company profile
     */
    public function profile()
    {
        if (!Auth::user()->isCourier()) {
            return redirect()->route('dashboard')->with('error', 'Access denied.');
        }

        $company = Auth::user()->courierCompany;

        return view('courier.company.profile', compact('company'));
    }

    /**
     * Show the form for editing the courier company
     */
    public function edit()
    {
        if (!Auth::user()->isCourier()) {
            return redirect()->route('dashboard')->with('error', 'Access denied.');
        }

        $company = Auth::user()->courierCompany;

        if (!$company) {
            return redirect()->route('courier.company.create')->with('info', 'Please create your company profile first.');
        }

        return view('courier.company.edit', compact('company'));
    }

    /**
     * Update the specified courier company
     */
    public function update(Request $request)
    {
        if (!Auth::user()->isCourier()) {
            return redirect()->route('dashboard')->with('error', 'Access denied.');
        }

        $company = Auth::user()->courierCompany;

        if (!$company) {
            return redirect()->route('courier.company.create')->with('info', 'Please create your company profile first.');
        }

        $request->validate([
            'company_name' => 'required|string|max:255|unique:courier_companies,company_name,' . $company->id,
            'description' => 'required|string|min:50',
            'service_areas' => 'required|array|min:1',
            'base_price' => 'required|numeric|min:0',
            'currency' => 'nullable|string|in:PKR,USD,EUR,GBP',
            'operating_hours' => 'required|array',
            'license_number' => 'nullable|string|max:255',
            'insurance_details' => 'nullable|string|max:500',
        ]);

        $company->update([
            'company_name' => $request->company_name,
            'description' => $request->description,
            'service_areas' => $request->service_areas,
            'base_price' => $request->base_price,
            'currency' => $request->currency ?? $company->currency ?? 'PKR',
            'operating_hours' => $request->operating_hours,
            'license_number' => $request->license_number,
            'insurance_details' => $request->insurance_details,
            'pricing_structure' => [
                'base_rate' => $request->base_price,
                'per_km' => $request->per_km ?? 0.5,
                'per_kg' => $request->per_kg ?? 0.2,
            ],
        ]);

        return redirect()->route('courier.company.profile')->with('success', 'Company profile updated successfully!');
    }
}
