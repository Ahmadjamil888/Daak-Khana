<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-neutral-900 mb-2">نیا اکاؤنٹ بنائیں</h2>
        <p class="text-neutral-600">ڈاک خانہ میں خوش آمدید</p>
    </div>
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- User Type -->
        <div>
            <label class="block text-sm font-medium text-neutral-700 mb-3">اکاؤنٹ کی قسم</label>
            <div class="grid grid-cols-1 gap-3">
                <label class="flex items-center p-4 border-2 border-neutral-200 rounded-xl cursor-pointer hover:bg-green-50 hover:border-green-300 transition-all duration-200 {{ request('type') === 'customer' ? 'border-green-500 bg-green-50' : '' }}">
                    <input type="radio" name="user_type" value="customer" class="text-green-600 focus:ring-green-500" {{ request('type') === 'customer' || old('user_type') === 'customer' ? 'checked' : '' }} required>
                    <div class="ml-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-neutral-900">مجھے ڈیلیوری چاہیے</div>
                                <div class="text-xs text-neutral-500">کوریئر سروس بک کریں</div>
                            </div>
                        </div>
                    </div>
                </label>
                <label class="flex items-center p-4 border-2 border-neutral-200 rounded-xl cursor-pointer hover:bg-green-50 hover:border-green-300 transition-all duration-200 {{ request('type') === 'courier' ? 'border-green-500 bg-green-50' : '' }}">
                    <input type="radio" name="user_type" value="courier" class="text-green-600 focus:ring-green-500" {{ request('type') === 'courier' || old('user_type') === 'courier' ? 'checked' : '' }} required>
                    <div class="ml-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-neutral-900">میں ڈیلیوری فراہم کرتا ہوں</div>
                                <div class="text-xs text-neutral-500">کوریئر کمپنی کے طور پر شامل ہوں</div>
                            </div>
                        </div>
                    </div>
                </label>
            </div>
            <x-input-error :messages="$errors->get('user_type')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-neutral-700 mb-2">مکمل نام</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                   class="w-full px-4 py-3 border border-neutral-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                   placeholder="آپ کا مکمل نام داخل کریں">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-neutral-700 mb-2">ای میل ایڈریس</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                   class="w-full px-4 py-3 border border-neutral-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                   placeholder="آپ کا ای میل ایڈریس داخل کریں">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div>
            <label for="phone" class="block text-sm font-medium text-neutral-700 mb-2">فون نمبر</label>
            <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" required
                   class="w-full px-4 py-3 border border-neutral-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                   placeholder="03XX-XXXXXXX">
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-neutral-700 mb-2">پاس ورڈ</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="w-full px-4 py-3 border border-neutral-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                   placeholder="کم از کم 8 حروف کا پاس ورڈ">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-neutral-700 mb-2">پاس ورڈ کی تصدیق</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                   class="w-full px-4 py-3 border border-neutral-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                   placeholder="پاس ورڈ دوبارہ داخل کریں">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit" class="w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-[1.02]">
            اکاؤنٹ بنائیں
        </button>

        <div class="text-center pt-4 border-t border-neutral-200">
            <p class="text-neutral-600 text-sm">
                پہلے سے اکاؤنٹ ہے؟ 
                <a href="{{ route('login') }}" class="text-green-600 hover:text-green-700 font-semibold">
                    لاگ ان کریں
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
