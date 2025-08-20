<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckCommissionRestriction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        
        // Only apply to courier users
        if (!$user || !$user->isCourier()) {
            return $next($request);
        }

        $company = $user->courierCompany;
        
        // If no company exists, allow through (they'll be redirected to create company)
        if (!$company) {
            return $next($request);
        }

        // If commission tracking columns don't exist (migrations pending), skip enforcement to avoid 500s
        if (!\Illuminate\Support\Facades\Schema::hasColumn('courier_companies', 'is_commission_restricted') ||
            !\Illuminate\Support\Facades\Schema::hasTable('courier_company_commissions')) {
            return $next($request);
        }

        // Check if company is restricted due to unpaid commissions
        if ($company->is_commission_restricted) {
            // For AJAX requests, return JSON response
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Access restricted due to unpaid commissions',
                    'message' => $company->getRestrictionMessage(),
                    'total_due' => $company->formatted_total_commission_due,
                    'redirect_url' => route('courier.commissions.index')
                ], 403);
            }
            
            // For web requests, redirect to commission payment page
            return redirect()->route('courier.commissions.index')
                           ->with('error', $company->getRestrictionMessage());
        }

        // Check if company should be restricted (overdue payments)
        if ($company->shouldBeRestricted()) {
            // Apply restriction automatically
            $company->applyCommissionRestriction();
            
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Access restricted due to overdue commissions',
                    'message' => $company->getRestrictionMessage(),
                    'total_due' => $company->formatted_total_commission_due,
                    'redirect_url' => route('courier.commissions.index')
                ], 403);
            }
            
            return redirect()->route('courier.commissions.index')
                           ->with('error', 'Your account has been restricted due to overdue commission payments. Please clear your balance to continue receiving bookings.');
        }

        return $next($request);
    }
}
