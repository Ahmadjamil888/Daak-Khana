<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-white leading-tight mb-2 sm:mb-0">
                {{ __('Dashboard') }}
            </h2>
            <div class="text-sm text-gray-300">
                Welcome back, {{ Auth::user()->name }}!
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Quick Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl sm:rounded-2xl p-4 sm:p-6 text-white shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-xs sm:text-sm font-medium">Total Bookings</p>
                            <p class="text-2xl sm:text-3xl font-bold">{{ auth()->user()->bookings()->count() }}</p>
                        </div>
                        <div class="bg-white/20 rounded-lg p-2 sm:p-3">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl sm:rounded-2xl p-4 sm:p-6 text-white shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-xs sm:text-sm font-medium">Active Orders</p>
                            <p class="text-2xl sm:text-3xl font-bold">{{ auth()->user()->bookings()->whereIn('status', ['pending', 'confirmed', 'picked_up', 'in_transit'])->count() }}</p>
                        </div>
                        <div class="bg-white/20 rounded-lg p-2 sm:p-3">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl sm:rounded-2xl p-4 sm:p-6 text-white shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-xs sm:text-sm font-medium">Completed</p>
                            <p class="text-2xl sm:text-3xl font-bold">{{ auth()->user()->bookings()->where('status', 'delivered')->count() }}</p>
                        </div>
                        <div class="bg-white/20 rounded-lg p-2 sm:p-3">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl sm:rounded-2xl p-4 sm:p-6 text-white shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-orange-100 text-xs sm:text-sm font-medium">Account Status</p>
                            <p class="text-lg sm:text-xl font-bold">{{ auth()->user()->isProActive() ? 'Pro' : 'Free' }}</p>
                        </div>
                        <div class="bg-white/20 rounded-lg p-2 sm:p-3">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
                <!-- Quick Actions -->
                <div class="lg:col-span-2">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg border border-white/20">
                        <h3 class="text-lg sm:text-xl font-bold text-white mb-4 sm:mb-6">Quick Actions</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                            @if(auth()->user()->isCustomer())
                                <a href="{{ route('companies.index') }}" class="group bg-gradient-to-r from-green-500/20 to-green-600/20 hover:from-green-500/30 hover:to-green-600/30 border border-green-400/30 rounded-lg sm:rounded-xl p-4 sm:p-6 transition-all duration-300 hover:scale-105">
                                    <div class="flex items-center">
                                        <div class="bg-green-500 rounded-lg p-2 sm:p-3 mr-3 sm:mr-4">
                                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-white font-semibold text-sm sm:text-base">Browse Companies</h4>
                                            <p class="text-gray-300 text-xs sm:text-sm">Find courier services</p>
                                        </div>
                                    </div>
                                </a>

                                <a href="{{ route('bookings.create') }}" class="group bg-gradient-to-r from-blue-500/20 to-blue-600/20 hover:from-blue-500/30 hover:to-blue-600/30 border border-blue-400/30 rounded-lg sm:rounded-xl p-4 sm:p-6 transition-all duration-300 hover:scale-105">
                                    <div class="flex items-center">
                                        <div class="bg-blue-500 rounded-lg p-2 sm:p-3 mr-3 sm:mr-4">
                                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-white font-semibold text-sm sm:text-base">New Booking</h4>
                                            <p class="text-gray-300 text-xs sm:text-sm">Create shipment</p>
                                        </div>
                                    </div>
                                </a>

                                <a href="{{ route('bookings.index') }}" class="group bg-gradient-to-r from-purple-500/20 to-purple-600/20 hover:from-purple-500/30 hover:to-purple-600/30 border border-purple-400/30 rounded-lg sm:rounded-xl p-4 sm:p-6 transition-all duration-300 hover:scale-105">
                                    <div class="flex items-center">
                                        <div class="bg-purple-500 rounded-lg p-2 sm:p-3 mr-3 sm:mr-4">
                                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-white font-semibold text-sm sm:text-base">My Bookings</h4>
                                            <p class="text-gray-300 text-xs sm:text-sm">Track orders</p>
                                        </div>
                                    </div>
                                </a>

                                <a href="{{ route('ai.chat.show') }}" class="group bg-gradient-to-r from-indigo-500/20 to-indigo-600/20 hover:from-indigo-500/30 hover:to-indigo-600/30 border border-indigo-400/30 rounded-lg sm:rounded-xl p-4 sm:p-6 transition-all duration-300 hover:scale-105">
                                    <div class="flex items-center">
                                        <div class="bg-indigo-500 rounded-lg p-2 sm:p-3 mr-3 sm:mr-4">
                                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-white font-semibold text-sm sm:text-base">AI Assistant</h4>
                                            <p class="text-gray-300 text-xs sm:text-sm">Get help</p>
                                        </div>
                                    </div>
                                </a>
                            @elseif(auth()->user()->isCourier())
                                <a href="{{ route('courier.company.profile') }}" class="group bg-gradient-to-r from-green-500/20 to-green-600/20 hover:from-green-500/30 hover:to-green-600/30 border border-green-400/30 rounded-lg sm:rounded-xl p-4 sm:p-6 transition-all duration-300 hover:scale-105">
                                    <div class="flex items-center">
                                        <div class="bg-green-500 rounded-lg p-2 sm:p-3 mr-3 sm:mr-4">
                                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-white font-semibold text-sm sm:text-base">Company Profile</h4>
                                            <p class="text-gray-300 text-xs sm:text-sm">Manage profile</p>
                                        </div>
                                    </div>
                                </a>

                                <a href="{{ route('courier.bookings') }}" class="group bg-gradient-to-r from-blue-500/20 to-blue-600/20 hover:from-blue-500/30 hover:to-blue-600/30 border border-blue-400/30 rounded-lg sm:rounded-xl p-4 sm:p-6 transition-all duration-300 hover:scale-105">
                                    <div class="flex items-center">
                                        <div class="bg-blue-500 rounded-lg p-2 sm:p-3 mr-3 sm:mr-4">
                                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-white font-semibold text-sm sm:text-base">Manage Bookings</h4>
                                            <p class="text-gray-300 text-xs sm:text-sm">Handle orders</p>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg border border-white/20 mt-6">
                        <h3 class="text-lg sm:text-xl font-bold text-white mb-4 sm:mb-6">Recent Activity</h3>
                        <div class="space-y-3 sm:space-y-4">
                            @forelse(auth()->user()->bookings()->latest()->take(5)->get() as $booking)
                                <div class="flex items-center justify-between p-3 sm:p-4 bg-white/5 rounded-lg border border-white/10">
                                    <div class="flex items-center flex-1 min-w-0">
                                        <div class="flex-shrink-0 w-8 h-8 sm:w-10 sm:h-10 bg-green-500 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-white font-medium text-sm sm:text-base truncate">Booking #{{ $booking->id }}</p>
                                            <p class="text-gray-300 text-xs sm:text-sm">{{ $booking->pickup_address }} → {{ $booking->delivery_address }}</p>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 ml-4">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                            @if($booking->status === 'delivered') bg-green-100 text-green-800
                                            @elseif($booking->status === 'in_transit') bg-blue-100 text-blue-800
                                            @elseif($booking->status === 'confirmed') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-300">No bookings yet</h3>
                                    <p class="mt-1 text-sm text-gray-400">Get started by creating your first booking.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Account Info -->
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg border border-white/20">
                        <h3 class="text-lg font-bold text-white mb-4">Account Information</h3>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white font-bold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <p class="text-white font-medium text-sm">{{ Auth::user()->name }}</p>
                                    <p class="text-gray-300 text-xs">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <div class="border-t border-white/20 pt-3">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-gray-300 text-sm">Account Type</span>
                                    <span class="text-white font-medium text-sm">{{ ucfirst(Auth::user()->user_type) }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-300 text-sm">Status</span>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ Auth::user()->isProActive() ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ Auth::user()->isProActive() ? 'Pro' : 'Free' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Upgrade Card (if not Pro) -->
                    @if(!Auth::user()->isProActive())
                        <div class="bg-gradient-to-r from-indigo-500/20 to-purple-600/20 border border-indigo-400/30 rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg">
                            <h3 class="text-lg font-bold text-white mb-2">Upgrade to Pro</h3>
                            <p class="text-gray-300 text-sm mb-4">Unlock premium features and get priority support.</p>
                            <ul class="space-y-2 mb-4">
                                <li class="flex items-center text-sm text-gray-300">
                                    <svg class="w-4 h-4 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Real-time tracking
                                </li>
                                <li class="flex items-center text-sm text-gray-300">
                                    <svg class="w-4 h-4 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Priority support
                                </li>
                                <li class="flex items-center text-sm text-gray-300">
                                    <svg class="w-4 h-4 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Advanced analytics
                                </li>
                            </ul>
                            <a href="{{ route('subscriptions.create') }}" class="block w-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white text-center py-2 px-4 rounded-lg font-semibold hover:from-indigo-600 hover:to-purple-700 transition-all duration-300">
                                Upgrade Now
                            </a>
                        </div>
                    @endif

                    <!-- Help & Support -->
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg border border-white/20">
                        <h3 class="text-lg font-bold text-white mb-4">Help & Support</h3>
                        <div class="space-y-3">
                            <a href="{{ route('ai.chat.show') }}" class="flex items-center text-gray-300 hover:text-white transition-colors">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <span class="text-sm">AI Assistant</span>
                            </a>
                            <a href="#" class="flex items-center text-gray-300 hover:text-white transition-colors">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm">FAQ</span>
                            </a>
                            <a href="#" class="flex items-center text-gray-300 hover:text-white transition-colors">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 7.89a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-sm">Contact Support</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
