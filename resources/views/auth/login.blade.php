<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-white via-green-50/30 to-white min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login to Your Account</h2>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="mt-1 block w-full px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-green-400 focus:outline-none border-gray-300">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" required
                    class="mt-1 block w-full px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-green-400 focus:outline-none border-gray-300">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="h-4 w-4 text-green-500 rounded">
                    <span class="ml-2 text-sm text-gray-600">Remember Me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-green-600 hover:underline">
                        Forgot Password?
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full py-2 px-4 bg-green-600 text-white rounded-xl hover:bg-green-700 transition shadow-md">
                Login
            </button>
        </form>

        <!-- Register -->
        @if (Route::has('register'))
            <p class="mt-6 text-center text-gray-600 text-sm">
                Don’t have an account?
                <a href="{{ route('register') }}" class="text-green-600 font-medium hover:underline">Register</a>
            </p>
        @endif
    </div>

</body>
</html>
