<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\Customer;
use Stripe\PaymentIntent;
use Stripe\Subscription;
use Stripe\Price;
use Stripe\Product;
use Exception;

class StripeService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function createCustomer($user)
    {
        try {
            $customer = Customer::create([
                'email' => $user->email,
                'name' => $user->name,
                'metadata' => [
                    'user_id' => $user->id,
                    'user_type' => $user->user_type,
                ]
            ]);

            $user->update(['stripe_customer_id' => $customer->id]);
            
            return $customer;
        } catch (Exception $e) {
            throw new Exception('Failed to create Stripe customer: ' . $e->getMessage());
        }
    }

    public function createSubscription($user, $priceId)
    {
        try {
            if (!$user->stripe_customer_id) {
                $this->createCustomer($user);
            }

            $subscription = Subscription::create([
                'customer' => $user->stripe_customer_id,
                'items' => [
                    ['price' => $priceId],
                ],
                'payment_behavior' => 'default_incomplete',
                'payment_settings' => [
                    'save_default_payment_method' => 'on_subscription'
                ],
                'expand' => ['latest_invoice.payment_intent'],
            ]);

            return $subscription;
        } catch (Exception $e) {
            throw new Exception('Failed to create subscription: ' . $e->getMessage());
        }
    }

    public function createPaymentIntent($amount, $currency = 'pkr', $metadata = [])
    {
        try {
            return PaymentIntent::create([
                'amount' => $amount * 100, // Convert to cents
                'currency' => $currency,
                'metadata' => $metadata,
            ]);
        } catch (Exception $e) {
            throw new Exception('Failed to create payment intent: ' . $e->getMessage());
        }
    }

    public function createProducts()
    {
        try {
            // Create User Pro Product
            $userProProduct = Product::create([
                'name' => 'Daak Khana Pro User',
                'description' => 'Premium features for users including real-time tracking, priority support, and messaging',
            ]);

            $userProPrice = Price::create([
                'product' => $userProProduct->id,
                'unit_amount' => 20000, // 200 PKR in paisa
                'currency' => 'pkr',
                'recurring' => ['interval' => 'month'],
            ]);

            // Create Courier Pro Product
            $courierProProduct = Product::create([
                'name' => 'Daak Khana Pro Courier',
                'description' => 'AI-powered features for couriers including profile generation and order handling',
            ]);

            $courierProPrice = Price::create([
                'product' => $courierProProduct->id,
                'unit_amount' => 0, // Free signup
                'currency' => 'pkr',
                'recurring' => ['interval' => 'month'],
            ]);

            // Create Per-Order Fee Product for Couriers
            $perOrderProduct = Product::create([
                'name' => 'Courier Order Fee',
                'description' => 'Per-order fee for courier companies',
            ]);

            $perOrderPrice = Price::create([
                'product' => $perOrderProduct->id,
                'unit_amount' => 8000, // 80 PKR in paisa
                'currency' => 'pkr',
            ]);

            return [
                'user_pro_price_id' => $userProPrice->id,
                'courier_pro_price_id' => $courierProPrice->id,
                'per_order_price_id' => $perOrderPrice->id,
            ];
        } catch (Exception $e) {
            throw new Exception('Failed to create products: ' . $e->getMessage());
        }
    }
}