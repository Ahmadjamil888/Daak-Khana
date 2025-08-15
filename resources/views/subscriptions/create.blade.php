<x-app-layout>
    <x-slot name="header">
        <h2 class="font-title text-xl font-semibold text-neutral-800 leading-tight">
            {{ __('Upgrade to Pro') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-center mb-8">
                        <h1 class="text-3xl font-bold text-gray-900 mb-4">
                            Upgrade to {{ $plan['name'] }}
                        </h1>
                        <div class="text-5xl font-bold text-primary-600 mb-2">
                            {{ $plan['currency'] }} {{ number_format($plan['price']) }}
                            @if($plan['price'] > 0)
                                <span class="text-lg text-gray-500">/month</span>
                            @else
                                <span class="text-lg text-gray-500">Free Signup</span>
                            @endif
                        </div>
                        @if(isset($plan['per_order_fee']))
                            <p class="text-gray-600">+ PKR {{ $plan['per_order_fee'] }} per order</p>
                        @endif
                    </div>

                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- Features List -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4">Pro Features</h3>
                            <ul class="space-y-3">
                                @foreach($plan['features'] as $feature)
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        {{ $feature }}
                                    </li>
                                @endforeach
                            </ul>

                            @if(auth()->user()->isCourier())
                                <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                                    <h4 class="font-semibold text-blue-900">How it works:</h4>
                                    <p class="text-blue-800 text-sm mt-2">
                                        Sign up for free and get access to basic features. 
                                        Pay PKR 80 per order you receive to keep using the platform.
                                        Upgrade to Pro for AI features and advanced tools.
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Subscription Form -->
                        <div>
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <form method="POST" action="{{ route('subscriptions.store') }}">
                                    @csrf
                                    
                                    @if($plan['price'] > 0)
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
                                    @endif

                                    <button type="submit" 
                                            class="w-full bg-primary-600 text-white py-3 px-4 rounded-lg hover:bg-primary-700 transition-colors font-semibold">
                                        @if($plan['price'] > 0)
                                            Subscribe Now
                                        @else
                                            Enable Pro Features
                                        @endif
                                    </button>
                                </form>

                                <p class="text-xs text-gray-500 mt-4 text-center">
                                    @if($plan['price'] > 0)
                                        You can cancel anytime. No long-term commitments.
                                    @else
                                        Free signup with pay-per-order billing.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($plan['price'] > 0)
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

        const form = document.querySelector('form');
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
    @endif
</x-app-layout>