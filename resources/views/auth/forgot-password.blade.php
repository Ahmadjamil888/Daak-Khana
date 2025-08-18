<x-guest-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="text-center">
            <h1 class="heading-3">Forgot your password?</h1>
            <p class="text-muted mt-2">No problem. We'll send you a reset link.</p>
        </div>

        <!-- Description -->
        <div class="alert alert-info">
            <div class="alert-description">
                {{ __('Enter your email address and we will send you a password reset link that will allow you to choose a new one.') }}
            </div>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Reset Form -->
        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" 
                       class="form-input" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       autocomplete="email"
                       placeholder="Enter your email address" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-primary w-full">
                {{ __('Send Password Reset Link') }}
            </button>
        </form>

        <!-- Back to Login -->
        <div class="text-center">
            <a href="{{ route('login') }}" 
               class="text-sm text-primary-600 hover:text-primary-700 transition-colors">
                {{ __('Back to login') }}
            </a>
        </div>
    </div>
</x-guest-layout>
