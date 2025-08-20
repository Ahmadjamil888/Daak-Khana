@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Pay Commission</h1>
            <p class="text-gray-600 mt-2">Complete your commission payment securely to restore full access to bookings.</p>
        </div>

        <!-- Summary Card -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Payment Summary</h2>
            <div class="space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Courier Company</span>
                    <span class="font-medium">{{ $company->company_name }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Selected Commissions</span>
                    <span class="font-medium">{{ $commissions->count() }}</span>
                </div>
                <div class="flex justify-between text-base border-t pt-3 mt-3">
                    <span class="text-gray-800 font-medium">Total Due</span>
                    <span class="text-gray-900 font-bold">{{ $company->currency_symbol }} {{ number_format($totalAmount, 2) }}</span>
                </div>
            </div>

            @if($company->is_commission_restricted)
                <div class="mt-4 p-3 rounded bg-red-50 border border-red-200 text-red-700 text-sm">
                    Account Restricted: Please clear your outstanding payment to continue receiving bookings.
                </div>
            @endif
        </div>

        <!-- Payment Form Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Payment Method</h2>

            <form id="commission-payment-form">
                @csrf
                @csrf
                <div class="mb-4">
                    <label for="card-element" class="block text-sm font-medium text-gray-700 mb-2">Card Details</label>
                    <div id="card-element" class="border rounded-md p-3"></div>
                    <div id="card-errors" role="alert" class="text-red-600 text-sm mt-2"></div>
                </div>

                <button id="pay-now" type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors disabled:opacity-60">
                    <svg id="spinner" class="hidden animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                    Pay Now ({{ $company->currency_symbol }} {{ number_format($totalAmount, 2) }})
                </button>
            </form>

            <p class="text-xs text-gray-500 mt-4 text-center">Secure payment processing by Stripe. Your payment information is encrypted and secure.</p>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    // Initialize Stripe using the publishable key from config
    const stripe = Stripe('{{ config('services.stripe.publishable') }}');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    // Helper to toggle loading
    function setLoading(isLoading) {
        const btn = document.getElementById('pay-now');
        const spinner = document.getElementById('spinner');
        btn.disabled = isLoading;
        spinner.classList.toggle('hidden', !isLoading);
    }

    const commissionIds = @json($commissions->pluck('id'));
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.getElementById('commission-payment-form').addEventListener('submit', async function (event) {
        event.preventDefault();
        setLoading(true);

        try {
            // Step 1: Create a PaymentIntent for the selected commissions
            const piRes = await fetch('{{ route('courier.commissions.payment-intent') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ commission_ids: commissionIds })
            });

            const piData = await piRes.json();
            if (!piRes.ok || !piData.client_secret) {
                throw new Error(piData.error || 'Failed to create payment intent');
            }

            // Step 2: Confirm the payment on the client using Stripe Elements
            const {error: confirmError, paymentIntent} = await stripe.confirmCardPayment(piData.client_secret, {
                payment_method: {
                    card: cardElement,
                }
            });

            if (confirmError) {
                throw new Error(confirmError.message || 'Payment confirmation failed');
            }

            if (paymentIntent && paymentIntent.status === 'succeeded') {
                // Step 3: Notify backend to mark commissions as paid
                const confirmRes = await fetch('{{ route('courier.commissions.confirm-payment') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        payment_intent_id: paymentIntent.id,
                        commission_ids: commissionIds
                    })
                });

                const confirmData = await confirmRes.json();
                if (!confirmRes.ok) {
                    throw new Error(confirmData.error || 'Failed to confirm payment');
                }

                // Redirect to commissions index or show success
                const redirectUrl = confirmData.redirect_url || '{{ route('courier.commissions.index') }}';
                window.location.href = redirectUrl;
            } else {
                throw new Error('Payment was not successful');
            }
        } catch (e) {
            const errEl = document.getElementById('card-errors');
            errEl.textContent = e.message || 'Payment error occurred';
        } finally {
            setLoading(false);
        }
    });
</script>
@endsection
