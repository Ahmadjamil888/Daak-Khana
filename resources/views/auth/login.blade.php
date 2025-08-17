<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-white mb-2">اپنے اکاؤنٹ میں لاگ ان کریں</h2>
        <p class="text-gray-300">اپنی کوریئر سروسز کا انتظام کریں</p>
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">ای میل ایڈریس</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 text-white"
                   placeholder="آپ کا ای میل ایڈریس داخل کریں">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">پاس ورڈ</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 text-white"
                   placeholder="آپ کا پاس ورڈ داخل کریں">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-600 text-indigo-600 shadow-sm focus:ring-indigo-500 bg-gray-700" name="remember">
                <span class="ml-2 text-sm text-gray-300">مجھے یاد رکھیں</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-400 hover:text-indigo-300 font-medium" href="{{ route('password.request') }}">
                    پاس ورڈ بھول گئے؟
                </a>
            @endif
        </div>

        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg font-semibold transition-all duration-300 shadow-lg hover:shadow-xl">
            لاگ ان کریں
        </button>

        <div class="text-center pt-4 border-t border-gray-700">
            <p class="text-gray-400 text-sm">
                اکاؤنٹ نہیں ہے؟
                <a href="{{ route('register') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold">
                    رجسٹر کریں
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
