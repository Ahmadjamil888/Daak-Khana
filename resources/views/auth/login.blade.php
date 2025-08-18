<x-guest-layout>
    <div class="max-w-md mx-auto bg-white rounded-2xl shadow-lg p-8 space-y-8">
        
        <!-- Header -->
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-900">Welcome back 👋</h1>
            <p class="mt-2 text-gray-600">Sign in to your account to continue</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autofocus
                       autocomplete="username"
                       placeholder="Enter your email"
                       class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm 
                              focus:ring-2 focus:ring-green-500 focus:border-green-500 
                              placeholder-gray-400 text-gray-900" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password"
                       type="password"
                       name="password"
                       required
                       autocomplete="current-password"
                       placeholder="Enter your password"
                       class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm 
                              focus:ring-2 focus:ring-green-500 focus:border-green-500 
                              placeholder-gray-400 text-gray-900" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <label class="flex items-center text-sm text-gray-600">
                    <input id="remember_me"
                           type="checkbox"
                           name="remember"
                           class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                    <span class="ml-2">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" 
                       class="text-sm font-medium text-green-600 hover:text-green-700 transition-colors">
                        Forgot password?
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                    class="w-full py-3 px-4 bg-green-600 text-white text-base font-semibold rounded-xl 
                           shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 
                           focus:ring-green-500 transition-all">
                Sign in
            </button>
        </form>

        <!-- Divider -->
        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-3 bg-white text-gray-500">New here?</span>
            </div>
        </div>

        <!-- Register Link -->
        @if (Route::has('register'))
            <div class="text-center">
                <p class="text-sm text-gray-600">
                    Don’t have an account?
                    <a href="{{ route('register') }}" 
                       class="font-medium text-green-600 hover:text-green-700 transition-colors">
                        Create one
                    </a>
                </p>
            </div>
        @endif
    </div>
</x-guest-layout>
