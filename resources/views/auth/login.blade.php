<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-white via-green-50 to-white px-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
            
            <!-- Heading -->
            <div class="text-center mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-green-700 mb-2">اپنے اکاؤنٹ میں لاگ ان کریں</h2>
                <p class="text-neutral-600">اپنی کوریئر سروسز کا انتظام کریں</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-green-700 mb-2">ای میل ایڈریس</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        class="w-full px-4 py-3 border border-green-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-400 transition-all duration-200"
                        placeholder="ای میل درج کریں">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-green-700 mb-2">پاس ورڈ</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full px-4 py-3 border border-green-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-400 transition-all duration-200"
                        placeholder="پاس ورڈ درج کریں">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me + Forgot Password -->
                <div class="flex items-center justify-between text-sm">
                    <label for="remember_me" class="inline-flex items-center text-neutral-600">
                        <input id="remember_me" type="checkbox" class="rounded border-green-300 text-green-600 shadow-sm focus:ring-green-500" name="remember">
                        <span class="ml-2">مجھے یاد رکھیں</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-green-600 hover:text-green-700 font-semibold" href="{{ route('password.request') }}">
                            پاس ورڈ بھول گئے؟
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white py-3 rounded-xl font-semibold transition-all duration-300 shadow-md hover:shadow-xl transform hover:scale-[1.02]">
                    لاگ ان کریں
                </button>

                <!-- Register -->
                <div class="text-center pt-6 border-t border-green-100">
                    <p class="text-neutral-600 text-sm">
                        اکاؤنٹ نہیں ہے؟
                        <a href="{{ route('register') }}" class="text-green-600 hover:text-green-700 font-semibold">
                            رجسٹر کریں
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
