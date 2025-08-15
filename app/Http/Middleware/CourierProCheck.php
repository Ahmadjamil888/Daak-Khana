<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourierProCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        
        if (!$user || !$user->isCourier()) {
            abort(403, 'Access denied.');
        }

        $company = $user->courierCompany;
        if (!$company) {
            return redirect()->route('courier.company.create')
                ->with('error', 'Please create your courier company profile first.');
        }

        // Check for unpaid order fees
        $unpaidOrderFees = $company->bookings()
            ->where('pro_fee', '>', 0)
            ->whereNull('pro_fee_paid_at')
            ->sum('pro_fee');

        if ($unpaidOrderFees > 80) { // More than one order fee unpaid
            return redirect()->route('courier.payment.required')
                ->with('error', 'Please pay outstanding order fees to continue using the platform.');
        }

        return $next($request);
    }
}
