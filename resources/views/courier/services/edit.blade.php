<x-app-layout>
    <x-slot name="header">
        <h2 class="font-title text-xl font-semibold text-neutral-800 leading-tight">
            {{ __('Edit Service: ') . $service->service_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('courier.services.update', $service) }}">
                        @csrf
                        @method('PATCH')

                        <!-- Service Name -->
                        <div class="mb-6">
                            <label for="service_name" class="block text-sm font-medium text-neutral-700 mb-2">Service Name</label>
                            <input type="text" 
                                   name="service_name" 
                                   id="service_name"
                                   value="{{ old('service_name', $service->service_name) }}"
                                   class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500"
                                   placeholder="e.g., Same Day Express, Next Day Standard"
                                   required>
                            @error('service_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Service Type -->
                        <div class="mb-6">
                            <label for="service_type" class="block text-sm font-medium text-neutral-700 mb-2">Service Type</label>
                            <select name="service_type" 
                                    id="service_type"
                                    class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500"
                                    required>
                                <option value="">Select service type</option>
                                <option value="same_day" {{ old('service_type', $service->service_type) === 'same_day' ? 'selected' : '' }}>Same Day</option>
                                <option value="next_day" {{ old('service_type', $service->service_type) === 'next_day' ? 'selected' : '' }}>Next Day</option>
                                <option value="express" {{ old('service_type', $service->service_type) === 'express' ? 'selected' : '' }}>Express</option>
                                <option value="standard" {{ old('service_type', $service->service_type) === 'standard' ? 'selected' : '' }}>Standard</option>
                                <option value="international" {{ old('service_type', $service->service_type) === 'international' ? 'selected' : '' }}>International</option>
                            </select>
                            @error('service_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-neutral-700 mb-2">Description</label>
                            <textarea name="description" 
                                      id="description"
                                      rows="3"
                                      class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500"
                                      placeholder="Describe this service, its features, and what makes it special..."
                                      required>{{ old('description', $service->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pricing and Delivery -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div>
                                <label for="price" class="block text-sm font-medium text-neutral-700 mb-2">Price ($)</label>
                                <input type="number" 
                                       name="price" 
                                       id="price"
                                       value="{{ old('price', $service->price) }}"
                                       step="0.01"
                                       min="0"
                                       class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500"
                                       required>
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="delivery_time" class="block text-sm font-medium text-neutral-700 mb-2">Delivery Time</label>
                                <input type="text" 
                                       name="delivery_time" 
                                       id="delivery_time"
                                       value="{{ old('delivery_time', $service->delivery_time) }}"
                                       class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500"
                                       placeholder="e.g., 2-4 hours, 1 business day"
                                       required>
                                @error('delivery_time')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="max_weight" class="block text-sm font-medium text-neutral-700 mb-2">Max Weight (kg)</label>
                                <input type="number" 
                                       name="max_weight" 
                                       id="max_weight"
                                       value="{{ old('max_weight', $service->max_weight) }}"
                                       step="0.1"
                                       min="0.1"
                                       class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500"
                                       required>
                                @error('max_weight')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Package Types -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-neutral-700 mb-2">Package Types Accepted</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                @php
                                    $packageTypes = [
                                        'documents' => 'Documents',
                                        'small_packages' => 'Small Packages',
                                        'packages' => 'Regular Packages',
                                        'electronics' => 'Electronics',
                                        'clothing' => 'Clothing',
                                        'books' => 'Books',
                                        'medical_supplies' => 'Medical Supplies',
                                        'food' => 'Food Items',
                                        'fragile' => 'Fragile Items',
                                        'hazardous' => 'Hazardous Materials',
                                        'oversized' => 'Oversized Items',
                                        'other' => 'Other'
                                    ];
                                    $selectedTypes = old('package_types', $service->package_types ?? []);
                                @endphp
                                
                                @foreach($packageTypes as $value => $label)
                                    <label class="flex items-center">
                                        <input type="checkbox" 
                                               name="package_types[]" 
                                               value="{{ $value }}"
                                               class="rounded border-neutral-300 text-primary-600 focus:ring-primary-500"
                                               {{ in_array($value, $selectedTypes) ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm text-neutral-700">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('package_types')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Service Status -->
                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" 
                                       name="is_active" 
                                       value="1"
                                       class="rounded border-neutral-300 text-primary-600 focus:ring-primary-500"
                                       {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-neutral-700">Service is active and available for booking</span>
                            </label>
                        </div>

                        <!-- Service Statistics -->
                        <div class="mb-6 p-4 bg-neutral-50 rounded-lg">
                            <h3 class="text-lg font-medium text-neutral-900 mb-3">Service Statistics</h3>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-primary-600">{{ $service->bookings()->count() }}</div>
                                    <div class="text-sm text-neutral-600">Total Bookings</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-primary-600">${{ number_format($service->bookings()->sum('total_amount'), 2) }}</div>
                                    <div class="text-sm text-neutral-600">Revenue Generated</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-primary-600">{{ $service->created_at->diffForHumans() }}</div>
                                    <div class="text-sm text-neutral-600">Service Created</div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('courier.services.index') }}" 
                               class="px-6 py-2 border border-neutral-300 text-neutral-700 rounded-lg hover:bg-neutral-50 transition-colors">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                                Update Service
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>