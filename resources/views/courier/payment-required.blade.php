<x-app-layout>
    <head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
    <x-slot name="header">
        <h2 class="font-title text-xl font-semibold text-neutral-800 leading-tight">
            {{ __('Payment Required') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="text-center mb-8">
                        <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        
                        <h1 class="text-3xl font-bold text-gray-900 mb-4">
                            Payment Required to Continue
                        </h1>
                        
                        <p class="text-lg text-gray-600 mb-6">
                            You have unpaid order fees that need to be settled before you can access new orders.
                        </p>

                        <div class="bg-red-50 border border-red-200 rounded-lg p-6 mb-8">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-red-600 mb-2">
                                    PKR {{ number_format($unpaidOrders * 80) }}
                                </div>
                                <div class="text-red-800">
                                    Outstanding fees for {{ $unpaidOrders }} order{{ $unpaidOrders > 1 ? 's' : '' }}
                                </div>
                                <div class="text-sm text-red-600 mt-2">
                                    PKR 80 per order processing fee
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- Payment Information -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4">How Our Pricing Works</h3>
                            <ul class="space-y-3 text-gray-600">
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Free registration and profile setup
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Pay only PKR 80 per order you receive
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    No monthly fees or hidden charges
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Access to messaging and basic features
                                </li>
                            </ul>

                            <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                                <h4 class="font-semibold text-blue-900 mb-2">Want More Features?</h4>
                                <p class="text-blue-800 text-sm mb-3">
                                    Upgrade to Pro for AI-powered tools, advanced analytics, and priority listings.
                                </p>
                                <a href="{{ route('subscriptions.create') }}" 
                                   class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                                    Learn About Pro Features
                                </a>
                            </div>
                        </div>

                        <!-- Payment Form -->
                        <div>
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <h3 class="text-xl font-semibold mb-4">Pay Outstanding Fees</h3>
                                
                                <form id="payment-form" method="POST" action="{{ route('courier.pay.fees') }}">
                                    @csrf
                                    
                                    <div class="mb-6">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Payment Method
                                        </label>
                                        <div class="border rounded-lg p-4">
                                            <div id="card-element">
                                                <!-- Stripe Elements will create form elements here -->
                                            </div>
                                            <div id="card-errors" role="alert" class="text-red-600 text-sm mt-2"></div>
                                        </div>
                                    </div>

                                    <div class="mb-6">
                                        <div class="flex justify-between items-center p-3 bg-white rounded border">
                                            <span>Order Processing Fees</span>
                                            <span class="font-semibold">PKR {{ number_format($unpaidOrders * 80) }}</span>
                                        </div>
                                    </div>

                                    <button type="submit" 
                                            class="w-full bg-green-600 text-white py-3 px-4 rounded-lg hover:bg-green-700 transition-colors font-semibold">
                                        Pay PKR {{ number_format($unpaidOrders * 80) }}
                                    </button>
                                </form>

                                <p class="text-xs text-gray-500 mt-4 text-center">
                                    Secure payment processing by Stripe. Your payment information is encrypted and secure.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Support -->
                    <div class="mt-8 text-center">
                        <p class="text-gray-600 mb-4">
                            Having trouble with payment? Need help?
                        </p>
                        <a href="mailto:support@daakkhana.com" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Contact Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ config("services.stripe.publishable") }}');
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        cardElement.on('change', function(event) {
            const displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async function(event) {
            event.preventDefault();

            const {token, error} = await stripe.createToken(cardElement);

            if (error) {
                const errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
            } else {
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
                form.submit();
            }
        });
    </script>
</x-app-layout>