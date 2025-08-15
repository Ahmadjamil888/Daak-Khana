<x-app-layout>
    <x-slot name="header">
        <h2 class="font-title text-xl font-semibold text-neutral-800 leading-tight">
            {{ __('Manage Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(!auth()->user()->courierCompany)
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">Company Profile Required</h3>
                            <div class="mt-2 text-sm text-yellow-700">
                                <p>You need to create your company profile before you can manage bookings.</p>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('courier.company.create') }}" class="bg-yellow-100 hover:bg-yellow-200 text-yellow-800 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                    Create Company Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @php $company = auth()->user()->courierCompany; @endphp
                @php $bookings = $company->bookings()->with(['customer', 'courierService'])->latest()->paginate(15); @endphp

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-neutral-200">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-neutral-600">Pending</p>
                                <p class="text-2xl font-semibold text-neutral-900">{{ $company->bookings()->where('status', 'pending')->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm border border-neutral-200">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-neutral-600">In Progress</p>
                                <p class="text-2xl font-semibold text-neutral-900">{{ $company->bookings()->whereIn('status', ['confirmed', 'picked_up', 'in_transit'])->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm border border-neutral-200">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-neutral-600">Completed</p>
                                <p class="text-2xl font-semibold text-neutral-900">{{ $company->bookings()->where('status', 'delivered')->count() }}</p>
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
                                <p class="text-2xl font-semibold text-neutral-900">${{ number_format($company->bookings()->where('status', 'delivered')->sum('total_amount'), 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if($bookings->count() > 0)
                    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-neutral-200">
                                <thead class="bg-neutral-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Booking #</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Customer</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Service</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Amount</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Pickup Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-neutral-200">
                                    @foreach($bookings as $booking)
                                        <tr class="hover:bg-neutral-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-neutral-900">{{ $booking->booking_number }}</div>
                                                <div class="text-sm text-neutral-500">{{ $booking->created_at->format('M d, Y') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="w-8 h-8 bg-neutral-200 rounded-full flex items-center justify-center">
                                                        <span class="text-sm font-medium text-neutral-600">{{ substr($booking->customer->name, 0, 1) }}</span>
                                                    </div>
                                                    <div class="ml-3">
                                                        <div class="text-sm font-medium text-neutral-900">{{ $booking->customer->name }}</div>
                                                        <div class="text-sm text-neutral-500">{{ $booking->customer->phone }}</div>
                                                    </div>
                                                </div>
                                            </td>
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
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('bookings.show', $booking) }}" 
                                                       class="text-primary-600 hover:text-primary-900">View</a>
                                                    
                                                    @if($booking->status === 'pending')
                                                        <form method="POST" action="{{ route('courier.bookings.update-status', $booking) }}" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="confirmed">
                                                            <button type="submit" class="text-green-600 hover:text-green-900">Confirm</button>
                                                        </form>
                                                    @elseif($booking->status === 'confirmed')
                                                        <form method="POST" action="{{ route('courier.bookings.update-status', $booking) }}" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="picked_up">
                                                            <button type="submit" class="text-blue-600 hover:text-blue-900">Pick Up</button>
                                                        </form>
                                                    @elseif($booking->status === 'picked_up')
                                                        <form method="POST" action="{{ route('courier.bookings.update-status', $booking) }}" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="in_transit">
                                                            <button type="submit" class="text-yellow-600 hover:text-yellow-900">In Transit</button>
                                                        </form>
                                                    @elseif($booking->status === 'in_transit')
                                                        <form method="POST" action="{{ route('courier.bookings.update-status', $booking) }}" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="delivered">
                                                            <button type="submit" class="text-green-600 hover:text-green-900">Deliver</button>
                                                        </form>
                                                    @endif
                                                </div>
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
                        <p class="text-neutral-600 mb-6">Bookings will appear here once customers start using your services.</p>
                        <div class="flex justify-center space-x-4">
                            <a href="{{ route('courier.services.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                                Manage Services
                            </a>
                            <a href="{{ route('courier.company.profile') }}" 
                               class="inline-flex items-center px-4 py-2 border border-neutral-300 text-neutral-700 rounded-lg hover:bg-neutral-50 transition-colors">
                                Update Profile
                            </a>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>