<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if (!$user->isCustomer()) {
            return redirect()->route('courier.dashboard');
        }

        $recentBookings = $user->bookings()->latest()->take(5)->get();
        
        return view('customer.dashboard', compact('recentBookings'));
    }
}
