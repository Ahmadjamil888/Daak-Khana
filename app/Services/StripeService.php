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

    /**
     * Create payment intent specifically for commission payments
     */
    public function createCommissionPaymentIntent($amount, $currency = 'pkr', $metadata = [])
    {
        try {
            $commissionMetadata = array_merge($metadata, [
                'payment_type' => 'commission',
                'marketplace' => 'courier_marketplace',
            ]);

            return PaymentIntent::create([
                'amount' => $amount * 100, // Convert to cents/paisa
                'currency' => $currency,
                'metadata' => $commissionMetadata,
                'description' => 'Commission payment for courier company: ' . ($metadata['company_name'] ?? 'Unknown'),
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
                'confirmation_method' => 'manual',
                'confirm' => false,
            ]);
        } catch (Exception $e) {
            throw new Exception('Failed to create commission payment intent: ' . $e->getMessage());
        }
    }

    /**
     * Confirm a payment intent
     */
    public function confirmPaymentIntent($paymentIntentId, $paymentMethodId = null)
    {
        try {
            $params = [];
            
            if ($paymentMethodId) {
                $params['payment_method'] = $paymentMethodId;
            }

            return PaymentIntent::retrieve($paymentIntentId)->confirm($params);
        } catch (Exception $e) {
            throw new Exception('Failed to confirm payment intent: ' . $e->getMessage());
        }
    }

    /**
     * Retrieve payment intent details
     */
    public function getPaymentIntent($paymentIntentId)
    {
        try {
            return PaymentIntent::retrieve($paymentIntentId);
        } catch (Exception $e) {
            throw new Exception('Failed to retrieve payment intent: ' . $e->getMessage());
        }
    }

    /**
     * Handle webhook for commission payment confirmations
     */
    public function handleCommissionPaymentWebhook($payload, $signature)
    {
        try {
            $endpoint_secret = config('services.stripe.webhook_secret');
            
            if ($endpoint_secret) {
                $event = \Stripe\Webhook::constructEvent(
                    $payload, $signature, $endpoint_secret
                );
            } else {
                $event = json_decode($payload);
            }

            // Handle the event
            switch ($event->type) {
                case 'payment_intent.succeeded':
                    $paymentIntent = $event->data->object;
                    
                    // Only handle commission payments
                    if (isset($paymentIntent->metadata->payment_type) && 
                        $paymentIntent->metadata->payment_type === 'commission') {
                        
                        return $this->processCommissionPaymentSuccess($paymentIntent);
                    }
                    break;
                    
                case 'payment_intent.payment_failed':
                    $paymentIntent = $event->data->object;
                    
                    if (isset($paymentIntent->metadata->payment_type) && 
                        $paymentIntent->metadata->payment_type === 'commission') {
                        
                        $this->logCommissionPaymentFailure($paymentIntent);
                    }
                    break;
                    
                default:
                    // Unhandled event type
                    break;
            }

            return true;
        } catch (Exception $e) {
            throw new Exception('Failed to handle webhook: ' . $e->getMessage());
        }
    }

    /**
     * Process successful commission payment from webhook
     */
    private function processCommissionPaymentSuccess($paymentIntent)
    {
        try {
            $metadata = $paymentIntent->metadata;
            $companyId = $metadata->company_id ?? null;
            $commissionIds = isset($metadata->commission_ids) ? 
                           json_decode($metadata->commission_ids, true) : [];

            if (!$companyId || empty($commissionIds)) {
                throw new Exception('Missing company ID or commission IDs in payment metadata');
            }

            $company = \App\Models\CourierCompany::find($companyId);
            if (!$company) {
                throw new Exception('Courier company not found: ' . $companyId);
            }

            $commissionService = app(\App\Services\CommissionService::class);
            $result = $commissionService->processCommissionPayment(
                $company,
                $commissionIds,
                $paymentIntent->id,
                [
                    'stripe_payment_intent_id' => $paymentIntent->id,
                    'amount_paid' => $paymentIntent->amount / 100,
                    'currency' => $paymentIntent->currency,
                    'payment_method' => $paymentIntent->payment_method,
                    'processed_via' => 'webhook',
                    'processed_at' => now(),
                ]
            );

            \Illuminate\Support\Facades\Log::info('Commission payment processed via webhook', [
                'company_id' => $companyId,
                'payment_intent_id' => $paymentIntent->id,
                'result' => $result,
            ]);

            return $result;
        } catch (Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to process commission payment webhook', [
                'payment_intent_id' => $paymentIntent->id,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    /**
     * Log commission payment failure
     */
    private function logCommissionPaymentFailure($paymentIntent)
    {
        \Illuminate\Support\Facades\Log::warning('Commission payment failed', [
            'payment_intent_id' => $paymentIntent->id,
            'company_id' => $paymentIntent->metadata->company_id ?? null,
            'amount' => $paymentIntent->amount / 100,
            'currency' => $paymentIntent->currency,
            'last_payment_error' => $paymentIntent->last_payment_error,
        ]);
    }
}