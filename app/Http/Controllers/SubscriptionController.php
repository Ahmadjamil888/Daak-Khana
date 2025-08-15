<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class SubscriptionController extends Controller
{
    protected $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    public function index()
    {
        $user = Auth::user();
        $subscriptions = $user->subscriptions()->latest()->get();
        
        return view('subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        $user = Auth::user();
        
        // Define pricing based on user type
        $pricing = [
            'customer' => [
                'name' => 'Pro User',
                'price' => 200,
                'currency' => 'PKR',
                'features' => [
                    'Real-time tracking',
                    'Priority support',
                    'Email notifications',
                    'Real-time messaging',
                    'Advanced analytics'
                ]
            ],
            'courier' => [
                'name' => 'Pro Courier',
                'price' => 0,
                'currency' => 'PKR',
                'features' => [
                    'AI profile generation',
                    'AI order handling',
                    'Advanced dashboard',
                    'Priority listings'
                ],
                'per_order_fee' => 80
            ]
        ];

        $plan = $pricing[$user->user_type] ?? $pricing['customer'];
        
        return view('subscriptions.create', compact('plan'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        try {
            if ($user->isCustomer()) {
                // Create subscription for user pro
                $subscription = $this->stripeService->createSubscription($user, 'price_user_pro');
                
                // Store subscription in database
                Subscription::create([
                    'user_id' => $user->id,
                    'type' => 'user_pro',
                    'stripe_subscription_id' => $subscription->id,
                    'amount' => 200,
                    'currency' => 'PKR',
                    'status' => $subscription->status,
                    'current_period_start' => now(),
                    'current_period_end' => now()->addMonth(),
                ]);

                // Update user pro status
                $user->update([
                    'is_pro' => true,
                    'pro_expires_at' => now()->addMonth(),
                    'pro_features' => $user->getProFeaturesForUserType(),
                ]);

                return redirect()->route('subscriptions.success')
                    ->with('success', 'Successfully subscribed to Pro User plan!');
                    
            } else {
                // For couriers, just enable pro features (free signup)
                $user->update([
                    'is_pro' => true,
                    'pro_expires_at' => null, // No expiry for courier pro
                    'pro_features' => $user->getProFeaturesForUserType(),
                ]);

                return redirect()->route('courier.dashboard')
                    ->with('success', 'Pro features enabled! You can now access AI tools.');
            }
            
        } catch (Exception $e) {
            return back()->with('error', 'Failed to create subscription: ' . $e->getMessage());
        }
    }

    public function success()
    {
        return view('subscriptions.success');
    }

    public function cancel(Subscription $subscription)
    {
        $user = Auth::user();
        
        if ($subscription->user_id !== $user->id) {
            abort(403);
        }

        try {
            // Cancel in Stripe
            if ($subscription->stripe_subscription_id) {
                \Stripe\Subscription::update($subscription->stripe_subscription_id, [
                    'cancel_at_period_end' => true
                ]);
            }

            // Update local subscription
            $subscription->update([
                'status' => 'cancelled',
                'cancelled_at' => now(),
            ]);

            return back()->with('success', 'Subscription cancelled successfully.');
            
        } catch (Exception $e) {
            return back()->with('error', 'Failed to cancel subscription: ' . $e->getMessage());
        }
    }

    public function payOrderFees(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->isCourier()) {
            abort(403);
        }

        $request->validate([
            'stripeToken' => 'required'
        ]);

        try {
            $company = $user->courierCompany;
            $unpaidBookings = $company->bookings()
                ->where('pro_fee', '>', 0)
                ->whereNull('pro_fee_paid_at')
                ->get();

            $totalAmount = $unpaidBookings->sum('pro_fee');

            if ($totalAmount <= 0) {
                return redirect()->route('courier.dashboard')
                    ->with('success', 'No outstanding fees to pay.');
            }

            // Create payment intent
            $paymentIntent = $this->stripeService->createPaymentIntent(
                $totalAmount,
                'pkr',
                [
                    'courier_id' => $user->id,
                    'company_id' => $company->id,
                    'type' => 'order_fees',
                    'booking_count' => $unpaidBookings->count()
                ]
            );

            // Mark bookings as paid
            $unpaidBookings->each(function ($booking) {
                $booking->update(['pro_fee_paid_at' => now()]);
            });

            return redirect()->route('courier.dashboard')
                ->with('success', "Successfully paid PKR {$totalAmount} for {$unpaidBookings->count()} orders.");

        } catch (Exception $e) {
            return back()->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }
}
