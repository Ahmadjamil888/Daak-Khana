<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-neutral-900 mb-2">اپنے اکاؤنٹ میں لاگ ان کریں</h2>
        <p class="text-neutral-600">اپنی کوریئر سروسز کا انتظام کریں</p>
    </div>
    <head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-neutral-700 mb-2">ای میل ایڈریس</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                   class="w-full px-4 py-3 border border-neutral-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                   placeholder="آپ کا ای میل ایڈریس داخل کریں">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-neutral-700 mb-2">پاس ورڈ</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="w-full px-4 py-3 border border-neutral-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                   placeholder="آپ کا پاس ورڈ داخل کریں">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-neutral-300 text-green-600 shadow-sm focus:ring-green-500" name="remember">
                <span class="ml-2 text-sm text-neutral-600">مجھے یاد رکھیں</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="text-sm text-green-600 hover:text-green-700 font-medium" href="{{ route('password.request') }}">
                    پاس ورڈ بھول گئے؟
                </a>
            @endif
        </div>

        <button type="submit" class="w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-[1.02]">
            لاگ ان کریں
        </button>

        <div class="text-center pt-4 border-t border-neutral-200">
            <p class="text-neutral-600 text-sm">
                اکاؤنٹ نہیں ہے؟ 
                <a href="{{ route('register') }}" class="text-green-600 hover:text-green-700 font-semibold">
                    رجسٹر کریں
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
