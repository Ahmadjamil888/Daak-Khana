<x-guest-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="text-center">
            <h1 class="heading-3">Welcome back</h1>
            <p class="text-muted mt-2">Sign in to your account to continue</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email" 
                       class="form-input" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       autocomplete="username"
                       placeholder="Enter your email address" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" 
                       class="form-input"
                       type="password"
                       name="password"
                       required 
                       autocomplete="current-password"
                       placeholder="Enter your password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" 
                           type="checkbox" 
                           class="form-checkbox" 
                           name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-primary-600 hover:text-primary-700 transition-colors" 
                       href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-primary w-full">
                {{ __('Sign in') }}
            </button>
        </form>

        <!-- Divider -->
        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">{{ __('New to our platform?') }}</span>
            </div>
        </div>

        <!-- Register Link -->
        @if (Route::has('register'))
            <div class="text-center">
                <p class="text-sm text-gray-600">
                    {{ __('Don\'t have an account?') }}
                    <a href="{{ route('register') }}" 
                       class="font-medium text-primary-600 hover:text-primary-700 transition-colors">
                        {{ __('Create account') }}
                    </a>
                </p>
            </div>
        @endif
    </div>
</x-guest-layout>
