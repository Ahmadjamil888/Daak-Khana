<x-guest-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="text-center">
            <h1 class="heading-3">Create your account</h1>
            <p class="text-muted mt-2">Join Pakistan's premier courier service platform</p>
        </div>

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- User Type Selection -->
            <div class="form-group">
                <label class="form-label">{{ __('Account Type') }}</label>
                <div class="grid grid-cols-1 gap-3 mt-2">
                    <!-- Customer Option -->
                    <label class="relative flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-primary-50 transition-colors has-[:checked]:border-primary-500 has-[:checked]:bg-primary-50">
                        <input type="radio" 
                               name="user_type" 
                               value="customer"
                               class="form-radio"
                               {{ old('user_type') === 'customer' ? 'checked' : '' }} 
                               required>
                        <div class="ml-3">
                            <div class="font-medium text-gray-900">{{ __('Customer') }}</div>
                            <div class="text-sm text-gray-500">{{ __('I need delivery services') }}</div>
                        </div>
                    </label>

                    <!-- Courier Option -->
                    <label class="relative flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-primary-50 transition-colors has-[:checked]:border-primary-500 has-[:checked]:bg-primary-50">
                        <input type="radio" 
                               name="user_type" 
                               value="courier"
                               class="form-radio"
                               {{ old('user_type') === 'courier' ? 'checked' : '' }} 
                               required>
                        <div class="ml-3">
                            <div class="font-medium text-gray-900">{{ __('Courier Company') }}</div>
                            <div class="text-sm text-gray-500">{{ __('I provide delivery services') }}</div>
                        </div>
                    </label>
                </div>
                <x-input-error :messages="$errors->get('user_type')" class="mt-2" />
            </div>

            <!-- Name -->
            <div class="form-group">
                <label for="name" class="form-label">{{ __('Full Name') }}</label>
                <input id="name" 
                       class="form-input" 
                       type="text" 
                       name="name" 
                       value="{{ old('name') }}" 
                       required 
                       autofocus 
                       autocomplete="name"
                       placeholder="Enter your full name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" 
                       class="form-input" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autocomplete="email"
                       placeholder="Enter your email address" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label for="phone" class="form-label">{{ __('Phone Number') }}</label>
                <input id="phone" 
                       class="form-input" 
                       type="tel" 
                       name="phone" 
                       value="{{ old('phone') }}" 
                       required 
                       autocomplete="tel"
                       placeholder="03XX-XXXXXXX" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" 
                       class="form-input"
                       type="password"
                       name="password"
                       required 
                       autocomplete="new-password"
                       placeholder="Minimum 8 characters" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation" 
                       class="form-input"
                       type="password"
                       name="password_confirmation"
                       required 
                       autocomplete="new-password"
                       placeholder="Confirm your password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Terms & Privacy -->
            <div class="form-group">
                <label class="inline-flex items-start">
                    <input type="checkbox" 
                           class="form-checkbox mt-0.5" 
                           name="terms" 
                           required>
                    <span class="ml-2 text-sm text-gray-600">
                        {{ __('I agree to the') }} 
                        <a href="#" class="text-primary-600 hover:text-primary-700 transition-colors">{{ __('Terms of Service') }}</a>
                        {{ __('and') }}
                        <a href="#" class="text-primary-600 hover:text-primary-700 transition-colors">{{ __('Privacy Policy') }}</a>
                    </span>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-primary w-full">
                {{ __('Create Account') }}
            </button>
        </form>

        <!-- Divider -->
        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">{{ __('Already have an account?') }}</span>
            </div>
        </div>

        <!-- Login Link -->
        <div class="text-center">
            <p class="text-sm text-gray-600">
                {{ __('Already registered?') }}
                <a href="{{ route('login') }}" 
                   class="font-medium text-primary-600 hover:text-primary-700 transition-colors">
                    {{ __('Sign in') }}
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>
