<!DOCTYPE html>
<html lang="ur" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-white via-green-50/30 to-white min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
        <!-- Heading -->
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-green-700 mb-2">نیا اکاؤنٹ بنائیں</h2>
            <p class="text-gray-600">ڈاک خانہ میں خوش آمدید</p>
        </div>

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- User Type -->
            <div>
                <label class="block text-sm font-medium text-green-700 mb-3">اکاؤنٹ کی قسم</label>
                <div class="space-y-3">
                    <!-- Customer -->
                    <label class="flex items-center p-4 border-2 rounded-xl cursor-pointer transition hover:bg-green-50">
                        <input type="radio" name="user_type" value="customer"
                               class="text-green-600 focus:ring-green-500"
                               {{ old('user_type') === 'customer' ? 'checked' : '' }} required>
                        <span class="mr-3 text-gray-700">مجھے ڈیلیوری چاہیے</span>
                    </label>

                    <!-- Courier -->
                    <label class="flex items-center p-4 border-2 rounded-xl cursor-pointer transition hover:bg-green-50">
                        <input type="radio" name="user_type" value="courier"
                               class="text-green-600 focus:ring-green-500"
                               {{ old('user_type') === 'courier' ? 'checked' : '' }} required>
                        <span class="mr-3 text-gray-700">میں ڈیلیوری فراہم کرتا ہوں</span>
                    </label>
                </div>
                @error('user_type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-green-700 mb-2">مکمل نام</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-green-400 border-gray-300"
                       placeholder="اپنا نام درج کریں">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-green-700 mb-2">ای میل ایڈریس</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                       class="w-full px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-green-400 border-gray-300"
                       placeholder="ای میل درج کریں">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-green-700 mb-2">فون نمبر</label>
                <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" required
                       class="w-full px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-green-400 border-gray-300"
                       placeholder="03XX-XXXXXXX">
                @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-green-700 mb-2">پاس ورڈ</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       class="w-full px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-green-400 border-gray-300"
                       placeholder="کم از کم 8 حروف کا پاس ورڈ">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-green-700 mb-2">پاس ورڈ کی تصدیق</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                       class="w-full px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-green-400 border-gray-300"
                       placeholder="پاس ورڈ دوبارہ درج کریں">
                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full py-2 px-4 bg-green-600 text-white rounded-xl hover:bg-green-700 transition shadow-md">
                اکاؤنٹ بنائیں
            </button>
        </form>

        <!-- Login Link -->
        <p class="mt-6 text-center text-sm text-gray-600">
            پہلے سے اکاؤنٹ ہے؟
            <a href="{{ route('login') }}" class="text-green-600 font-semibold hover:underline">لاگ ان کریں</a>
        </p>
    </div>

</body>
</html>
