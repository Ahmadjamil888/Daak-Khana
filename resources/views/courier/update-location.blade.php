<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-title text-xl font-semibold text-neutral-800 leading-tight">
                Update Location - Booking #{{ $booking->booking_number }}
            </h2>
            <a href="{{ route('bookings.show', $booking) }}" 
               class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                Back to Booking
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Booking Info -->
                    <div class="bg-gray-50 p-4 rounded-lg mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h3 class="font-semibold text-gray-900">Customer: {{ $booking->customer->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $booking->customer->phone }}</p>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Current Status: 
                                    <span class="px-2 py-1 rounded text-xs bg-blue-100 text-blue-800">
                                        {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                                    </span>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <!-- Location Update Form -->
                    <form id="location-form" class="space-y-6">
                        @csrf
                        
                        <!-- Current Location -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Update Your Location</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="latitude" class="block text-sm font-medium text-gray-700 mb-2">
                                        Latitude
                                    </label>
                                    <input type="number" 
                                           name="latitude" 
                                           id="latitude"
                                           step="any"
                                           class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                           required>
                                </div>
                                
                                <div>
                                    <label for="longitude" class="block text-sm font-medium text-gray-700 mb-2">
                                        Longitude
                                    </label>
                                    <input type="number" 
                                           name="longitude" 
                                           id="longitude"
                                           step="any"
                                           class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                           required>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="button" 
                                        onclick="getCurrentLocation()"
                                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                                    Use My Current Location
                                </button>
                            </div>
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                Address (Optional)
                            </label>
                            <input type="text" 
                                   name="address" 
                                   id="address"
                                   placeholder="e.g., Near McDonald's, Main Street"
                                   class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                Update Status
                            </label>
                            <select name="status" 
                                    id="status"
                                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                    required>
                                <option value="">Select status</option>
                                @if($booking->status === 'confirmed')
                                    <option value="picked_up">Picked Up</option>
                                @elseif($booking->status === 'picked_up')
                                    <option value="picked_up">Still at Pickup</option>
                                    <option value="in_transit">In Transit</option>
                                @elseif($booking->status === 'in_transit')
                                    <option value="in_transit">Still in Transit</option>
                                    <option value="delivered">Delivered</option>
                                @endif
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end space-x-4">
                            <button type="submit" 
                                    class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                                Update Location & Status
                            </button>
                        </div>
                    </form>

                    <!-- Pro Feature Notice -->
                    <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-blue-800 font-semibold">Real-time Location Tracking</span>
                        </div>
                        <p class="text-blue-700 text-sm mt-1">
                            This location will be shared with Pro customers for real-time tracking. 
                            Regular customers will only see status updates.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function getCurrentLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        document.getElementById('latitude').value = position.coords.latitude;
                        document.getElementById('longitude').value = position.coords.longitude;
                        
                        // Try to get address from coordinates
                        reverseGeocode(position.coords.latitude, position.coords.longitude);
                    },
                    function(error) {
                        alert('Error getting location: ' + error.message);
                    }
                );
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        }

        function reverseGeocode(lat, lng) {
            // Simple reverse geocoding (you might want to use a proper service)
            document.getElementById('address').value = `Coordinates: ${lat.toFixed(6)}, ${lng.toFixed(6)}`;
        }

        document.getElementById('location-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = {
                latitude: formData.get('latitude'),
                longitude: formData.get('longitude'),
                address: formData.get('address'),
                status: formData.get('status'),
            };

            try {
                const response = await fetch('{{ route("location.store", $booking) }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    const result = await response.json();
                    alert('Location updated successfully!');
                    window.location.href = '{{ route("bookings.show", $booking) }}';
                } else {
                    const error = await response.json();
                    alert('Error: ' + (error.message || 'Failed to update location'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Failed to update location. Please try again.');
            }
        });
    </script>
</x-app-layout>