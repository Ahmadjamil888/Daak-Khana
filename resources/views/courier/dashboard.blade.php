<x-app-layout>
    <head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
    <x-slot name="header">
        <h2 class="font-title text-xl font-semibold text-neutral-800 leading-tight">
            کوریئر ڈیش بورڈ - ڈاک خانہ
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-neutral-900">
                    <h3 class="text-2xl font-title font-bold mb-2">خوش آمدید، {{ auth()->user()->name }}!</h3>
                    <p class="text-neutral-600">اپنی کوریئر کمپنی کا انتظام کریں اور اپنی کاروباری کارکردگی کو ٹریک کریں۔</p>
                </div>
            </div>

            @if(!$company)
                <!-- Company Setup Required -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">Company Profile Required</h3>
                            <div class="mt-2 text-sm text-yellow-700">
                                <p>You need to set up your company profile to start receiving bookings.</p>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('courier.company.create') }}" class="bg-yellow-100 hover:bg-yellow-200 text-yellow-800 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                    Set Up Company Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Commission and Debt Section -->
                @if($commissionSummary)
                    @if($commissionSummary['is_restricted'])
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Account Restricted</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <p>{{ $commissionSummary['restriction_message'] }}</p>
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{ route('courier.commissions.index') }}" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-medium">Pay Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($commissionSummary['overdue_count'] > 0)
                        <div class="bg-orange-50 border border-orange-200 rounded-lg p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-orange-800">Overdue Commissions</h3>
                                    <div class="mt-2 text-sm text-orange-700">
                                        <p>You have {{ $commissionSummary['overdue_count'] }} overdue commission payments. Please pay soon to avoid account restrictions.</p>
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{ route('courier.commissions.index') }}" class="inline-flex items-center px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 text-sm font-medium">Review and Pay</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($commissionSummary['days_until_restriction'] !== null && $commissionSummary['days_until_restriction'] <= 3)
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-yellow-800">Payment Due Soon</h3>
                                    <div class="mt-2 text-sm text-yellow-700">
                                        <p>Your commission payment is due in {{ $commissionSummary['days_until_restriction'] }} day(s).</p>
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{ route('courier.commissions.index') }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 text-sm font-medium">Pay Commission</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="bg-white p-6 rounded-lg shadow-sm border border-neutral-200 mb-8">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-neutral-900">Debt & Commission Summary</h3>
                            <a href="{{ route('courier.commissions.index') }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium">Manage Commissions →</a>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                            <div>
                                <div class="text-sm text-neutral-600">Total Outstanding</div>
                                <div class="text-2xl font-bold text-red-600">{{ $commissionSummary['formatted_total_unpaid'] }}</div>
                            </div>
                            <div>
                                <div class="text-sm text-neutral-600">Unpaid</div>
                                <div class="text-2xl font-bold text-blue-600">{{ $commissionSummary['unpaid_count'] }}</div>
                            </div>
                            <div>
                                <div class="text-sm text-neutral-600">Overdue</div>
                                <div class="text-2xl font-bold text-orange-600">{{ $commissionSummary['overdue_count'] }}</div>
                            </div>
                            <div>
                                <div class="text-sm text-neutral-600">Next Due Date</div>
                                @if($commissionSummary['next_due_date'])
                                    <div class="text-2xl font-bold text-neutral-900">{{ $commissionSummary['next_due_date']->format('M j, Y') }}</div>
                                @else
                                    <div class="text-2xl font-bold text-neutral-900">—</div>
                                @endif
                            </div>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <div class="text-sm text-neutral-600">Commission Rate: 1% per booking (deducted as platform fee)</div>
                            @if($commissionSummary['total_unpaid'] > 0)
                                <a href="{{ route('courier.commissions.pay-all') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 text-sm font-medium">
                                    Pay All ({{ $commissionSummary['formatted_total_unpaid'] }})
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-neutral-200">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-neutral-600">Total Bookings</p>
                                <p class="text-2xl font-semibold text-neutral-900">{{ $company->bookings()->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm border border-neutral-200">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-neutral-600">Revenue</p>
                                <p class="text-2xl font-semibold text-neutral-900">Rs. {{ number_format($company->bookings()->sum('total_amount'), 0) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm border border-neutral-200">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-neutral-600">Rating</p>
                                <p class="text-2xl font-semibold text-neutral-900">{{ number_format($company->rating, 1) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm border border-neutral-200">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-neutral-600">Reviews</p>
                                <p class="text-2xl font-semibold text-neutral-900">{{ $company->total_reviews }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <a href="{{ route('courier.company.profile') }}" class="bg-white p-6 rounded-lg shadow-sm border border-neutral-200 hover:shadow-md transition-shadow">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m4 0V9a2 2 0 012-2h2a2 2 0 012 2v12"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold text-neutral-900">Company Profile</h4>
                                <p class="text-sm text-neutral-600">Manage your profile</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('courier.services.index') }}" class="bg-white p-6 rounded-lg shadow-sm border border-neutral-200 hover:shadow-md transition-shadow">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold text-neutral-900">Services</h4>
                                <p class="text-sm text-neutral-600">Manage your services</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('courier.bookings') }}" class="bg-white p-6 rounded-lg shadow-sm border border-neutral-200 hover:shadow-md transition-shadow">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold text-neutral-900">Bookings</h4>
                                <p class="text-sm text-neutral-600">Manage bookings</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('courier.commissions.index') }}" class="bg-white p-6 rounded-lg shadow-sm border border-neutral-200 hover:shadow-md transition-shadow">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold text-neutral-900">Commission Payments</h4>
                                <p class="text-sm text-neutral-600">View debt and pay commissions</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- Recent Bookings -->
            @if($company && $recentBookings->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-neutral-900 mb-4">Recent Bookings</h3>
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-neutral-200">
                                <thead class="bg-neutral-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Booking #</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Customer</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Amount</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Commission (1%)</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-neutral-200">
                                    @foreach($recentBookings as $booking)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-neutral-900">
                                                {{ $booking->booking_number }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500">
                                                {{ $booking->customer->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    @if($booking->status === 'delivered') bg-green-100 text-green-800
                                                    @elseif($booking->status === 'in_transit') bg-blue-100 text-blue-800
                                                    @elseif($booking->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @else bg-neutral-100 text-neutral-800
                                                    @endif">
                                                    {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500">
                                                {{ $booking->formatted_total_amount }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500">
                                                {{ $booking->courierCompany->currency_symbol }} {{ number_format($booking->total_amount * 0.01, 0) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500">
                                                {{ $booking->created_at->format('M d, Y') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>