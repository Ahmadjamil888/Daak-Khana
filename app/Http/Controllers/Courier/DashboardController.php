<?php

namespace App\Http\Controllers\Courier;

use App\Http\Controllers\Controller;
use App\Services\CommissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

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
            if (Schema::hasTable('courier_company_commissions')) {
                $commissionSummary = $this->commissionService->getCommissionSummary($company);
            } else {
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
            }
        }
        
        return view('courier.dashboard', compact('company', 'recentBookings', 'commissionSummary'));
    }
}
