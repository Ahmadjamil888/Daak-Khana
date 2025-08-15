<?php

namespace App\Http\Controllers\Courier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if (!$user->isCourier()) {
            return redirect()->route('dashboard');
        }

        $company = $user->courierCompany;
        $recentBookings = $company ? $company->bookings()->latest()->take(5)->get() : collect();
        
        return view('courier.dashboard', compact('company', 'recentBookings'));
    }
}
