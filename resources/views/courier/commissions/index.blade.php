@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Commission Payments</h1>
            <p class="text-gray-600 mt-2">Manage your commission payments and account status</p>
        </div>

        <!-- Account Status Alert -->
        @if(!$commissionsEnabled)
            <div class="bg-blue-100 border border-blue-400 text-blue-800 px-4 py-3 rounded mb-6">
                Commission tracking is initializing. Please try again after migrations complete.
            </div>
        @endif

        @if($commissionSummary['is_restricted'])
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <h3 class="font-bold">Account Restricted</h3>
                        <p>{{ $commissionSummary['restriction_message'] }}</p>
                    </div>
                </div>
            </div>
        @elseif($commissionSummary['overdue_count'] > 0)
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-6">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <h3 class="font-bold">Overdue Payments</h3>
                        <p>You have {{ $commissionSummary['overdue_count'] }} overdue commission payments. Please pay soon to avoid account restrictions.</p>
                    </div>
                </div>
            </div>
        @elseif($commissionSummary['days_until_restriction'] !== null && $commissionSummary['days_until_restriction'] <= 3)
            <div class="bg-orange-100 border border-orange-400 text-orange-700 px-4 py-3 rounded mb-6">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <h3 class="font-bold">Payment Due Soon</h3>
                        <p>Your commission payment is due in {{ $commissionSummary['days_until_restriction'] }} day(s).</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Commission Summary -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Commission Summary</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-red-600">{{ $commissionSummary['formatted_total_unpaid'] }}</div>
                            <div class="text-gray-600">Total Due</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-blue-600">{{ $commissionSummary['unpaid_count'] }}</div>
                            <div class="text-gray-600">Unpaid Commissions</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-orange-600">{{ $commissionSummary['overdue_count'] }}</div>
                            <div class="text-gray-600">Overdue Commissions</div>
                        </div>
                    </div>

                    @if($commissionSummary['total_unpaid'] > 0)
                        <div class="flex flex-wrap gap-3">
                            @if($commissionsEnabled)
                                <a href="{{ route('courier.commissions.payment-form', ['commission_ids' => $company->getUnpaidCommissions()->pluck('id')->toArray()]) }}" 
                                   class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                    Pay All ({{ $commissionSummary['formatted_total_unpaid'] }})
                                </a>
                                <a href="{{ route('courier.commissions.payment-form', ['commission_ids' => $company->getUnpaidCommissions()->pluck('id')->toArray()]) }}" 
                                   class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                                    Select Commissions to Pay
                                </a>
                            @else
                                <span class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg cursor-not-allowed">Pay All</span>
                            @endif
                        </div>
                    @else
                        <div class="text-green-600 font-medium">✓ All commissions are paid up!</div>
                    @endif
                </div>

                <!-- Commission History -->
                <div class="bg-white rounded-lg shadow mt-6">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-800">Recent Commission History</h2>
                    </div>
                    <div class="p-6">
                        @if($commissionHistory->isEmpty())
                            <p class="text-gray-500 text-center py-8">No commission records found.</p>
                        @else
                            <div class="space-y-4">
                                @foreach($commissionHistory as $commission)
                                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                        <div>
                                            <div class="font-medium">{{ $commission->booking->booking_number ?? 'N/A' }}</div>
                                            <div class="text-sm text-gray-600">
                                                Booking: {{ $company->currency_symbol }} {{ number_format($commission->booking_amount, 2) }}
                                            </div>
                                            <div class="text-xs text-gray-500">{{ $commission->created_at->format('M j, Y g:i A') }}</div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-bold text-lg">{{ $company->currency_symbol }} {{ number_format($commission->commission_amount, 2) }}</div>
                                            <div class="text-sm">
                                                @if($commission->status === 'paid')
                                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full">Paid</span>
                                                @elseif($commission->status === 'overdue')
                                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full">Overdue</span>
                                                @else
                                                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">Pending</span>
                                                @endif
                                            </div>
                                            @if($commission->status === 'pending' || $commission->status === 'overdue')
                                                <div class="text-xs text-gray-500 mt-1">
                                                    Due: {{ $commission->due_date->format('M j, Y') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="space-y-6">
                <!-- Account Status -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Account Status</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span>Can Receive Bookings:</span>
                            @if($commissionSummary['can_receive_bookings'])
                                <span class="text-green-600 font-medium">Yes ✓</span>
                            @else
                                <span class="text-red-600 font-medium">No ✗</span>
                            @endif
                        </div>
                        
                        @if($commissionSummary['next_due_date'])
                            <div class="flex justify-between">
                                <span>Next Due Date:</span>
                                <span class="font-medium">{{ $commissionSummary['next_due_date']->format('M j, Y') }}</span>
                            </div>
                        @endif

                        @if($commissionSummary['days_until_restriction'] !== null)
                            <div class="flex justify-between">
                                <span>Days Until Restriction:</span>
                                <span class="font-medium">{{ $commissionSummary['days_until_restriction'] }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Help & Support -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Need Help?</h3>
                    <div class="space-y-3 text-sm">
                        <div class="p-3 bg-blue-50 rounded">
                            <h4 class="font-medium text-blue-900">Commission Rate</h4>
                            <p class="text-blue-700">We charge 1% commission on each booking to cover platform costs and payment processing.</p>
                        </div>
                        <div class="p-3 bg-green-50 rounded">
                            <h4 class="font-medium text-green-900">Payment Terms</h4>
                            <p class="text-green-700">Commissions are due within 10 days of booking creation. Late payments may result in account restrictions.</p>
                        </div>
                        <div class="p-3 bg-gray-50 rounded">
                            <h4 class="font-medium text-gray-900">Support</h4>
                            <p class="text-gray-700">If you have questions about your commission charges, please contact our support team.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
