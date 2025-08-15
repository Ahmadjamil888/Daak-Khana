<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-title text-xl font-semibold text-neutral-800 leading-tight">
                @if(auth()->user()->isCustomer())
                    {{ __('My Bookings') }}
                @else
                    {{ __('Manage Bookings') }}
                @endif
            </h2>
            @if(auth()->user()->isCustomer())
                <a href="{{ route('bookings.create') }}" 
                   class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    New Booking
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if($bookings->count() > 0)
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-neutral-200">
                            <thead class="bg-neutral-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Booking #</th>
                                    @if(auth()->user()->isCustomer())
                                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Courier Company</th>
                                    @else
                                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Customer</th>
                                    @endif
                                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Service</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Pickup Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-neutral-200">
                                @foreach($bookings as $booking)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-neutral-900">{{ $booking->booking_number }}</div>
                                            <div class="text-sm text-neutral-500">{{ $booking->created_at->format('M d, Y') }}</div>
                                        </td>
                                        @if(auth()->user()->isCustomer())
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-neutral-900">{{ $booking->courierCompany->company_name }}</div>
                                                <div class="text-sm text-neutral-500">{{ $booking->courierService->service_name }}</div>
                                            </td>
                                        @else
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-neutral-900">{{ $booking->customer->name }}</div>
                                                <div class="text-sm text-neutral-500">{{ $booking->customer->email }}</div>
                                            </td>
                                        @endif
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-neutral-900">{{ $booking->courierService->service_name }}</div>
                                            <div class="text-sm text-neutral-500">{{ ucfirst(str_replace('_', ' ', $booking->courierService->service_type)) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($booking->status === 'delivered') bg-green-100 text-green-800
                                                @elseif($booking->status === 'in_transit') bg-blue-100 text-blue-800
                                                @elseif($booking->status === 'picked_up') bg-yellow-100 text-yellow-800
                                                @elseif($booking->status === 'confirmed') bg-purple-100 text-purple-800
                                                @elseif($booking->status === 'pending') bg-orange-100 text-orange-800
                                                @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                                                @else bg-neutral-100 text-neutral-800
                                                @endif">
                                                {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-900">
                                            ${{ number_format($booking->total_amount, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-500">
                                            {{ $booking->pickup_date->format('M d, Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('bookings.show', $booking) }}" 
                                               class="text-primary-600 hover:text-primary-900">View Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $bookings->links() }}
                </div>
            @else
                <div class="bg-white rounded-lg shadow-sm border border-neutral-200 p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-neutral-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-neutral-900 mb-2">No bookings yet</h3>
                    <p class="text-neutral-600 mb-6">
                        @if(auth()->user()->isCustomer())
                            Start by browsing courier companies and booking your first delivery.
                        @else
                            Bookings will appear here once customers start using your services.
                        @endif
                    </p>
                    @if(auth()->user()->isCustomer())
                        <a href="{{ route('companies.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                            Browse Companies
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>