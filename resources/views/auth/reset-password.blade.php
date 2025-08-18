<x-guest-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="text-center">
            <h1 class="heading-3">Reset your password</h1>
            <p class="text-muted mt-2">Enter your new password below</p>
        </div>

        <!-- Reset Form -->
        <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" 
                       class="form-input" 
                       type="email" 
                       name="email" 
                       value="{{ old('email', $request->email) }}" 
                       required 
                       autofocus 
                       autocomplete="username"
                       placeholder="Enter your email address" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- New Password -->
            <div class="form-group">
                <label for="password" class="form-label">{{ __('New Password') }}</label>
                <input id="password" 
                       class="form-input" 
                       type="password" 
                       name="password" 
                       required 
                       autocomplete="new-password"
                       placeholder="Enter your new password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">{{ __('Confirm New Password') }}</label>
                <input id="password_confirmation" 
                       class="form-input" 
                       type="password" 
                       name="password_confirmation" 
                       required 
                       autocomplete="new-password"
                       placeholder="Confirm your new password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-primary w-full">
                {{ __('Reset Password') }}
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
