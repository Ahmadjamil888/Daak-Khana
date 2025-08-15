<?php

namespace App\Http\Controllers\Courier;

use App\Http\Controllers\Controller;
use App\Models\CourierService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourierServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user()->isCourier()) {
            return redirect()->route('dashboard')->with('error', 'Access denied.');
        }

        return view('courier.services.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->isCourier()) {
            return redirect()->route('dashboard')->with('error', 'Access denied.');
        }

        $company = Auth::user()->courierCompany;
        if (!$company) {
            return redirect()->route('courier.company.create')->with('info', 'Please create your company profile first.');
        }

        return view('courier.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->isCourier()) {
            return redirect()->route('dashboard')->with('error', 'Access denied.');
        }

        $company = Auth::user()->courierCompany;
        if (!$company) {
            return redirect()->route('courier.company.create')->with('info', 'Please create your company profile first.');
        }

        $request->validate([
            'service_name' => 'required|string|max:255',
            'service_type' => 'required|in:same_day,next_day,express,standard,international',
            'description' => 'required|string|min:10',
            'price' => 'required|numeric|min:0',
            'delivery_time' => 'required|string|max:100',
            'max_weight' => 'required|numeric|min:0.1',
            'package_types' => 'required|array|min:1',
            'package_types.*' => 'string',
            'is_active' => 'boolean',
        ]);

        CourierService::create([
            'courier_company_id' => $company->id,
            'service_name' => $request->service_name,
            'service_type' => $request->service_type,
            'description' => $request->description,
            'price' => $request->price,
            'delivery_time' => $request->delivery_time,
            'max_weight' => $request->max_weight,
            'package_types' => $request->package_types,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('courier.services.index')->with('success', 'Service created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourierService $service)
    {
        if (!Auth::user()->isCourier() || $service->courierCompany->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        return view('courier.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourierService $service)
    {
        if (!Auth::user()->isCourier() || $service->courierCompany->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'service_name' => 'required|string|max:255',
            'service_type' => 'required|in:same_day,next_day,express,standard,international',
            'description' => 'required|string|min:10',
            'price' => 'required|numeric|min:0',
            'delivery_time' => 'required|string|max:100',
            'max_weight' => 'required|numeric|min:0.1',
            'package_types' => 'required|array|min:1',
            'package_types.*' => 'string',
            'is_active' => 'boolean',
        ]);

        $service->update([
            'service_name' => $request->service_name,
            'service_type' => $request->service_type,
            'description' => $request->description,
            'price' => $request->price,
            'delivery_time' => $request->delivery_time,
            'max_weight' => $request->max_weight,
            'package_types' => $request->package_types,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('courier.services.index')->with('success', 'Service updated successfully!');
    }

    /**
     * Toggle service active status.
     */
    public function toggle(CourierService $service)
    {
        if (!Auth::user()->isCourier() || $service->courierCompany->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $service->update(['is_active' => !$service->is_active]);

        $status = $service->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Service {$status} successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourierService $service)
    {
        if (!Auth::user()->isCourier() || $service->courierCompany->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        // Check if service has active bookings
        if ($service->bookings()->whereIn('status', ['pending', 'confirmed', 'picked_up', 'in_transit'])->exists()) {
            return redirect()->back()->with('error', 'Cannot delete service with active bookings.');
        }

        $service->delete();

        return redirect()->route('courier.services.index')->with('success', 'Service deleted successfully!');
    }
}
