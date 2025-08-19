<?php

namespace App\Http\Controllers\Courier;

use App\Http\Controllers\Controller;
use App\Services\CommissionService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $commissionService;

    public function __construct(CommissionService $commissionService)
    {
        $this->commissionService = $commissionService;
    }

    public function index()
    {
        $user = auth()->user();
        
        if (!$user->isCourier()) {
            return redirect()->route('dashboard');
        }

        $company = $user->courierCompany;
        $recentBookings = $company ? $company->bookings()->latest()->take(5)->get() : collect();
        
        // Get commission information if company exists
        $commissionSummary = null;
        if ($company) {
            $commissionSummary = $this->commissionService->getCommissionSummary($company);
        }
        
        return view('courier.dashboard', compact('company', 'recentBookings', 'commissionSummary'));
    }
}
