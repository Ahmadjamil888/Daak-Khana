<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureCourierCompany
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
            return redirect()->route('dashboard')
                           ->with('error', 'Only courier companies can access this page.');
        }

        $company = $user->courierCompany;
        
        // If no company exists, redirect to create company
        if (!$company) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Courier company required',
                    'message' => 'Please create your courier company profile first.',
                    'redirect_url' => route('courier.company.create')
                ], 403);
            }
            
            return redirect()->route('courier.company.create')
                           ->with('error', 'Please create your courier company profile first.');
        }

        return $next($request);
    }
}
