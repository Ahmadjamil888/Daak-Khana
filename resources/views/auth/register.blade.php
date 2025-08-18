<x-guest-layout>
    <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg p-8 space-y-8">
        
        <!-- Header -->
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-900">Create your account 🚀</h1>
            <p class="mt-2 text-gray-600">Join Pakistan's premier courier service platform</p>
        </div>

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- User Type Selection -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Account Type</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-3">
                    
                    <!-- Customer -->
                    <label class="relative flex items-center p-4 border rounded-xl cursor-pointer transition-all 
                                 hover:border-green-500 hover:bg-green-50 has-[:checked]:border-green-600 has-[:checked]:bg-green-50">
                        <input type="radio" 
                               name="user_type" 
                               value="customer"
                               class="hidden peer"
                               {{ old('user_type') === 'customer' ? 'checked' : '' }} required>
                        <div class="ml-1">
                            <div class="font-medium text-gray-900">Customer</div>
                            <div class="text-sm text-gray-500">I need delivery services</div>
                        </div>
                    </label>

                    <!-- Courier -->
                    <label class="relative flex items-center p-4 border rounded-xl cursor-pointer transition-all 
                                 hover:border-green-500 hover:bg-green-50 has-[:checked]:border-green-600 has-[:checked]:bg-green-50">
                        <input type="radio" 
                               name="user_type" 
                               value="courier"
                               class="hidden peer"
                               {{ old('user_type') === 'courier' ? 'checked' : '' }} required>
                        <div class="ml-1">
                            <div class="font-medium text-gray-900">Courier Company</div>
                            <div class="text-sm text-gray-500">I provide delivery services</div>
                        </div>
                    </label>
                </div>
                <x-input-error :messages="$errors->get('user_type')" class="mt-2" />
            </div>

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input id="name" 
                       type="text" 
                       name="name" 
                       value="{{ old('name') }}" 
                       required 
                       autofocus 
                       autocomplete="name"
                       placeholder="Enter your full name"
                       class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm 
                              focus:ring-2 focus:ring-green-500 focus:border-green-500 
                              placeholder-gray-400 text-gray-900" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input id="email" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autocomplete="email"
                       placeholder="Enter your email address"
                       class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm 
                              focus:ring-2 focus:ring-green-500 focus:border-green-500 
                              placeholder-gray-400 text-gray-900" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input id="phone" 
                       type="tel" 
                       name="phone" 
                       value="{{ old('phone') }}" 
                       required 
                       autocomplete="tel"
                       placeholder="03XX-XXXXXXX"
                       class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm 
                              focus:ring-2 focus:ring-green-500 focus:border-green-500 
                              placeholder-gray-400 text-gray-900" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" 
                       type="password"
                       name="password"
                       required 
                       autocomplete="new-password"
                       placeholder="Minimum 8 characters"
                       class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm 
                              focus:ring-2 focus:ring-green-500 focus:border-green-500 
                              placeholder-gray-400 text-gray-900" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input id="password_confirmation" 
                       type="password"
                       name="password_confirmation"
                       required 
                       autocomplete="new-password"
                       placeholder="Confirm your password"
                       class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm 
                              focus:ring-2 focus:ring-green-500 focus:border-green-500 
                              placeholder-gray-400 text-gray-900" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Terms -->
            <div class="flex items-start">
                <input type="checkbox" 
                       class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500 mt-1" 
                       name="terms" 
                       required>
                <span class="ml-2 text-sm text-gray-600">
                    I agree to the 
                    <a href="#" class="text-green-600 hover:text-green-700">Terms of Service</a> 
                    and 
                    <a href="#" class="text-green-600 hover:text-green-700">Privacy Policy</a>.
                </span>
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                    class="w-full py-3 px-4 bg-green-600 text-white text-base font-semibold rounded-xl 
                           shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 
                           focus:ring-green-500 transition-all">
                Create Account
            </button>
        </form>

        <!-- Divider -->
        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-3 bg-white text-gray-500">Already have an account?</span>
            </div>
        </div>

        <!-- Login Link -->
        <div class="text-center">
            <p class="text-sm text-gray-600">
                Already registered?
                <a href="{{ route('login') }}" 
                   class="font-medium text-green-600 hover:text-green-700 transition-colors">
                    Sign in
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>
