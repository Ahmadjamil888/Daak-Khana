<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-title text-xl font-semibold text-neutral-800 leading-tight">
                {{ __('Booking Details: ') . $booking->booking_number }}
            </h2>
            <a href="{{ route('bookings.index') }}" class="text-primary-600 hover:text-primary-700">
                ← Back to Bookings
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Booking Overview -->
                    <div class="bg-white rounded-lg shadow-sm border border-neutral-200 p-6">
                        <div class="flex items-start justify-between mb-6">
                            <div>
                                <h1 class="text-2xl font-title font-bold text-neutral-900 mb-2">{{ $booking->booking_number }}</h1>
                                <div class="flex items-center space-x-4">
                                    <span class="px-3 py-1 rounded-full text-sm font-medium 
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
                                    <span class="text-sm text-neutral-500">Created {{ $booking->created_at->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-primary-600">PKR {{ number_format($booking->total_amount, 0) }}</div>
                                <div class="text-sm text-neutral-500">Total Amount</div>
                            </div>
                        </div>

                        <!-- Service Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <h3 class="text-sm font-medium text-neutral-500 mb-1">Courier Company</h3>
                                <div class="text-lg font-semibold text-neutral-900">{{ $booking->courierCompany->company_name }}</div>
                                @if($booking->courierCompany->is_verified)
                                    <span class="inline-flex items-center text-sm text-green-600">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        Verified Company
                                    </span>
                                @endif
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-neutral-500 mb-1">Service Type</h3>
                                <div class="text-lg font-semibold text-neutral-900">{{ $booking->courierService->service_name }}</div>
                                <div class="text-sm text-neutral-600">{{ ucfirst(str_replace('_', ' ', $booking->courierService->service_type)) }} • {{ $booking->courierService->delivery_time }}</div>
                            </div>
                        </div>

                        <!-- Customer Information (for courier view) -->
                        @if(auth()->user()->isCourier())
                            <div class="mb-6 p-4 bg-neutral-50 rounded-lg">
                                <h3 class="text-sm font-medium text-neutral-500 mb-2">Customer Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <div class="font-semibold text-neutral-900">{{ $booking->customer->name }}</div>
                                        <div class="text-sm text-neutral-600">{{ $booking->customer->email }}</div>
                                    </div>
                                    <div>
                                        <div class="text-sm text-neutral-600">{{ $booking->customer->phone }}</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Addresses -->
                    <div class="bg-white rounded-lg shadow-sm border border-neutral-200 p-6">
                        <h3 class="text-lg font-semibold text-neutral-900 mb-4">Pickup & Delivery</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="text-sm font-medium text-neutral-500 mb-2">Pickup Address</h4>
                                <div class="text-neutral-900 whitespace-pre-line">{{ $booking->pickup_address }}</div>
                                <div class="text-sm text-neutral-500 mt-2">
                                    Scheduled: {{ $booking->pickup_date->format('M d, Y H:i') }}
                                </div>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-neutral-500 mb-2">Delivery Address</h4>
                                <div class="text-neutral-900 whitespace-pre-line">{{ $booking->delivery_address }}</div>
                                @if($booking->delivery_date)
                                    <div class="text-sm text-neutral-500 mt-2">
                                        Delivered: {{ $booking->delivery_date->format('M d, Y H:i') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Package Details -->
                    <div class="bg-white rounded-lg shadow-sm border border-neutral-200 p-6">
                        <h3 class="text-lg font-semibold text-neutral-900 mb-4">Package Information</h3>
                        
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <div class="text-sm text-neutral-500">Weight</div>
                                <div class="font-semibold text-neutral-900">{{ $booking->package_details['weight'] }}kg</div>
                            </div>
                            <div>
                                <div class="text-sm text-neutral-500">Dimensions</div>
                                <div class="font-semibold text-neutral-900">{{ $booking->package_details['dimensions'] }} cm</div>
                            </div>
                            <div>
                                <div class="text-sm text-neutral-500">Max Weight Allowed</div>
                                <div class="font-semibold text-neutral-900">{{ $booking->courierService->max_weight }}kg</div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <div class="text-sm text-neutral-500 mb-1">Description</div>
                            <div class="text-neutral-900">{{ $booking->package_details['description'] }}</div>
                        </div>

                        @if($booking->special_instructions)
                            <div>
                                <div class="text-sm text-neutral-500 mb-1">Special Instructions</div>
                                <div class="text-neutral-900 whitespace-pre-line">{{ $booking->special_instructions }}</div>
                            </div>
                        @endif
                    </div>

                    <!-- Tracking Updates -->
                    @if($booking->tracking_updates && count($booking->tracking_updates) > 0)
                        <div class="bg-white rounded-lg shadow-sm border border-neutral-200 p-6">
                            <h3 class="text-lg font-semibold text-neutral-900 mb-4">Tracking Updates</h3>
                            
                            <div class="space-y-4">
                                @foreach(array_reverse($booking->tracking_updates) as $update)
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0 w-2 h-2 bg-primary-600 rounded-full mt-2"></div>
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between">
                                                <div class="font-medium text-neutral-900">{{ $update['message'] }}</div>
                                                <div class="text-sm text-neutral-500">{{ \Carbon\Carbon::parse($update['timestamp'])->format('M d, Y H:i') }}</div>
                                            </div>
                                            <div class="text-sm text-neutral-600 capitalize">{{ str_replace('_', ' ', $update['status']) }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Status Update (for courier) -->
                    @if(auth()->user()->isCourier() && $booking->status !== 'delivered' && $booking->status !== 'cancelled')
                        <div class="bg-white rounded-lg shadow-sm border border-neutral-200 p-6">
                            <h3 class="text-lg font-semibold text-neutral-900 mb-4">Update Status</h3>
                            
                            <form method="POST" action="{{ route('courier.bookings.update-status', $booking) }}">
                                @csrf
                                @method('PATCH')
                                
                                <div class="mb-4">
                                    <label for="status" class="block text-sm font-medium text-neutral-700 mb-2">New Status</label>
                                    <select name="status" id="status" class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500" required>
                                        <option value="">Select status</option>
                                        @if($booking->status === 'pending')
                                            <option value="confirmed">Confirmed</option>
                                            <option value="cancelled">Cancelled</option>
                                        @elseif($booking->status === 'confirmed')
                                            <option value="picked_up">Picked Up</option>
                                            <option value="cancelled">Cancelled</option>
                                        @elseif($booking->status === 'picked_up')
                                            <option value="in_transit">In Transit</option>
                                        @elseif($booking->status === 'in_transit')
                                            <option value="delivered">Delivered</option>
                                        @endif
                                    </select>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="message" class="block text-sm font-medium text-neutral-700 mb-2">Update Message (Optional)</label>
                                    <textarea name="message" id="message" rows="2" class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500" placeholder="Add a note about this status update..."></textarea>
                                </div>
                                
                                <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                                    Update Status
                                </button>
                            </form>
                        </div>
                    @endif

                    <!-- Booking Summary -->
                    <div class="bg-white rounded-lg shadow-sm border border-neutral-200 p-6">
                        <h3 class="text-lg font-semibold text-neutral-900 mb-4">Booking Summary</h3>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-neutral-600">Service Fee</span>
                                <span class="font-medium text-neutral-900">PKR {{ number_format($booking->courierService->price, 0) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-neutral-600">Weight Fee ({{ $booking->package_details['weight'] }}kg)</span>
                                <span class="font-medium text-neutral-900">PKR {{ number_format(($booking->package_details['weight'] ?? 0) * 0.5, 0) }}</span>
                            </div>
                            <div class="border-t border-neutral-200 pt-3">
                                <div class="flex justify-between">
                                    <span class="text-lg font-semibold text-neutral-900">Total</span>
                                    <span class="text-lg font-bold text-primary-600">PKR {{ number_format($booking->total_amount, 0) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pro Features -->
                    @if($booking->is_pro_booking || auth()->user()->isProActive())
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg border border-green-200 p-6">
                            <h3 class="text-lg font-semibold text-green-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Pro Features
                            </h3>
                            
                            <div class="space-y-3">
                                <a href="{{ route('messages.index', $booking) }}" 
                                   class="flex items-center justify-between p-3 bg-white rounded-lg hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                        <span class="font-medium">Real-time Messaging</span>
                                    </div>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>

                                @if($booking->real_time_tracking_enabled && auth()->user()->isCustomer())
                                    <div class="p-3 bg-white rounded-lg">
                                        <div class="flex items-center justify-between mb-2">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                </svg>
                                                <span class="font-medium">Real-time Location</span>
                                            </div>
                                            <button onclick="refreshLocation()" class="text-blue-600 hover:text-blue-700 text-sm">
                                                Refresh
                                            </button>
                                        </div>
                                        <div id="location-status" class="text-sm text-gray-600">
                                            Loading location...
                                        </div>
                                    </div>
                                @endif

                                @if(auth()->user()->isCourier() && in_array($booking->status, ['picked_up', 'in_transit']))
                                    <a href="{{ route('courier.location.form', $booking) }}" 
                                       class="flex items-center justify-between p-3 bg-white rounded-lg hover:bg-gray-50 transition-colors">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-orange-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            </svg>
                                            <span class="font-medium">Update Location</span>
                                        </div>
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="bg-blue-50 rounded-lg border border-blue-200 p-6">
                            <h3 class="text-lg font-semibold text-blue-900 mb-2">Upgrade to Pro</h3>
                            <p class="text-blue-800 text-sm mb-4">
                                Get real-time tracking, messaging, and priority support for just PKR 200/month.
                            </p>
                            <a href="{{ route('subscriptions.create') }}" 
                               class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                                Upgrade Now
                            </a>
                        </div>
                    @endif

                    <!-- Contact Information -->
                    <div class="bg-white rounded-lg shadow-sm border border-neutral-200 p-6">
                        <h3 class="text-lg font-semibold text-neutral-900 mb-4">Contact Information</h3>
                        
                        @if(auth()->user()->isCustomer())
                            <div class="space-y-2">
                                <div class="text-sm text-neutral-500">Courier Company</div>
                                <div class="font-medium text-neutral-900">{{ $booking->courierCompany->company_name }}</div>
                                <div class="text-sm text-neutral-600">{{ $booking->courierCompany->user->email }}</div>
                                <div class="text-sm text-neutral-600">{{ $booking->courierCompany->user->phone }}</div>
                            </div>
                        @else
                            <div class="space-y-2">
                                <div class="text-sm text-neutral-500">Customer</div>
                                <div class="font-medium text-neutral-900">{{ $booking->customer->name }}</div>
                                <div class="text-sm text-neutral-600">{{ $booking->customer->email }}</div>
                                <div class="text-sm text-neutral-600">{{ $booking->customer->phone }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($booking->real_time_tracking_enabled && auth()->user()->isCustomer())
    <script>
        async function refreshLocation() {
            const locationStatus = document.getElementById('location-status');
            locationStatus.textContent = 'Loading...';

            try {
                const response = await fetch('{{ route("location.get", $booking) }}');
                const data = await response.json();

                if (data.success && data.location) {
                    const location = data.location;
                    const address = location.address || `${location.latitude}, ${location.longitude}`;
                    const time = new Date(location.created_at).toLocaleString();
                    
                    locationStatus.innerHTML = `
                        <div class="font-medium text-green-700">${data.status.replace('_', ' ').toUpperCase()}</div>
                        <div class="text-xs text-gray-600">${address}</div>
                        <div class="text-xs text-gray-500">Updated: ${time}</div>
                    `;
                } else if (data.status === 'pending') {
                    locationStatus.innerHTML = `
                        <div class="font-medium text-orange-600">PENDING</div>
                        <div class="text-xs text-gray-600">Package not yet picked up</div>
                    `;
                } else {
                    locationStatus.textContent = 'Location not available';
                }
            } catch (error) {
                console.error('Error fetching location:', error);
                locationStatus.textContent = 'Error loading location';
            }
        }

        // Auto-refresh location every 30 seconds for pro users
        refreshLocation();
        setInterval(refreshLocation, 30000);
    </script>
    @endif
</x-app-layout>