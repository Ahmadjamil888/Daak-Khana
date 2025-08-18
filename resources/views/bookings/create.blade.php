<x-app-layout>
    <x-slot name="header">
        <h2 class="font-title text-xl font-semibold text-neutral-800 leading-tight">
            {{ __('Create New Booking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('bookings.store') }}" class="space-y-6">
                @csrf

                <!-- Company and Service Selection -->
                <div class="bg-white rounded-lg shadow-sm border border-neutral-200 p-6">
                    <h3 class="text-lg font-semibold text-neutral-900 mb-4">Select Courier Service</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Company Selection -->
                        <div>
                            <label for="courier_company_id" class="block text-sm font-medium text-neutral-700 mb-2">Courier Company</label>
                            <select name="courier_company_id" 
                                    id="courier_company_id"
                                    class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500"
                                    onchange="updateServices()"
                                    required>
                                <option value="">Select a courier company</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" 
                                            data-services="{{ $company->services->toJson() }}"
                                            data-currency="{{ $company->currency ?? 'PKR' }}"
                                            {{ old('courier_company_id', $selectedCompany?->id) == $company->id ? 'selected' : '' }}>
                                        {{ $company->company_name }} - Starting from {{ $company->currency ?? 'PKR' }} {{ number_format($company->base_price, 0) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('courier_company_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Service Selection -->
                        <div>
                            <label for="courier_service_id" class="block text-sm font-medium text-neutral-700 mb-2">Service Type</label>
                            <select name="courier_service_id" 
                                    id="courier_service_id"
                                    class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500"
                                    required>
                                <option value="">Select a service</option>
                                @if($selectedService)
                                    <option value="{{ $selectedService->id }}" selected>
                                        {{ $selectedService->service_name }} - {{ $selectedService->currency ?? $selectedService->courierCompany->currency ?? 'PKR' }} {{ number_format($selectedService->price, 0) }}
                                    </option>
                                @endif
                            </select>
                            @error('courier_service_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Pickup and Delivery Information -->
                <div class="bg-white rounded-lg shadow-sm border border-neutral-200 p-6">
                    <h3 class="text-lg font-semibold text-neutral-900 mb-4">Pickup & Delivery Details</h3>
                    
                    <div class="space-y-6">
                        <!-- Addresses -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="pickup_address" class="block text-sm font-medium text-neutral-700 mb-2">Pickup Address</label>
                                <textarea name="pickup_address" 
                                          id="pickup_address"
                                          rows="3"
                                          class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500"
                                          placeholder="Enter complete pickup address..."
                                          required>{{ old('pickup_address') }}</textarea>
                                @error('pickup_address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="delivery_address" class="block text-sm font-medium text-neutral-700 mb-2">Delivery Address</label>
                                <textarea name="delivery_address" 
                                          id="delivery_address"
                                          rows="3"
                                          class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500"
                                          placeholder="Enter complete delivery address..."
                                          required>{{ old('delivery_address') }}</textarea>
                                @error('delivery_address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Pickup Date -->
                        <div>
                            <label for="pickup_date" class="block text-sm font-medium text-neutral-700 mb-2">Preferred Pickup Date & Time</label>
                            <input type="datetime-local" 
                                   name="pickup_date" 
                                   id="pickup_date"
                                   value="{{ old('pickup_date') }}"
                                   min="{{ now()->format('Y-m-d\TH:i') }}"
                                   class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500"
                                   required>
                            @error('pickup_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Package Information -->
                <div class="bg-white rounded-lg shadow-sm border border-neutral-200 p-6">
                    <h3 class="text-lg font-semibold text-neutral-900 mb-4">Package Information</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div>
                            <label for="package_weight" class="block text-sm font-medium text-neutral-700 mb-2">Weight (kg)</label>
                            <input type="number" 
                                   name="package_weight" 
                                   id="package_weight"
                                   value="{{ old('package_weight') }}"
                                   step="0.1"
                                   min="0.1"
                                   class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500"
                                   required>
                            @error('package_weight')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="package_dimensions" class="block text-sm font-medium text-neutral-700 mb-2">Dimensions (L×W×H cm)</label>
                            <input type="text" 
                                   name="package_dimensions" 
                                   id="package_dimensions"
                                   value="{{ old('package_dimensions') }}"
                                   placeholder="e.g., 30×20×15"
                                   class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500"
                                   required>
                            @error('package_dimensions')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-neutral-700 mb-2">Estimated Cost</label>
                            <div id="estimated_cost" class="text-2xl font-bold text-primary-600 py-2">
                                Select service to see cost
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="package_description" class="block text-sm font-medium text-neutral-700 mb-2">Package Description</label>
                        <textarea name="package_description" 
                                  id="package_description"
                                  rows="2"
                                  class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500"
                                  placeholder="Describe the contents of your package..."
                                  required>{{ old('package_description') }}</textarea>
                        @error('package_description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="special_instructions" class="block text-sm font-medium text-neutral-700 mb-2">Special Instructions (Optional)</label>
                        <textarea name="special_instructions" 
                                  id="special_instructions"
                                  rows="2"
                                  class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500"
                                  placeholder="Any special handling instructions, contact preferences, etc...">{{ old('special_instructions') }}</textarea>
                        @error('special_instructions')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end space-x-4">
                    <a href="{{ route('companies.index') }}" 
                       class="px-6 py-2 border border-neutral-300 text-neutral-700 rounded-lg hover:bg-neutral-50 transition-colors">
                        Back to Companies
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                        Create Booking
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function updateServices() {
            const companySelect = document.getElementById('courier_company_id');
            const serviceSelect = document.getElementById('courier_service_id');
            const selectedOption = companySelect.options[companySelect.selectedIndex];
            
            // Clear existing options
            serviceSelect.innerHTML = '<option value="">Select a service</option>';
            
            if (selectedOption.value) {
                const services = JSON.parse(selectedOption.dataset.services || '[]');
                const companyCurrency = selectedOption.dataset.currency || 'PKR';
                
                services.forEach(service => {
                    const option = document.createElement('option');
                    option.value = service.id;
                    const serviceCurrency = service.currency || companyCurrency;
                    option.textContent = `${service.service_name} - ${serviceCurrency} ${parseFloat(service.price).toFixed(0)} (${service.delivery_time})`;
                    option.dataset.price = service.price;
                    option.dataset.currency = serviceCurrency;
                    serviceSelect.appendChild(option);
                });
            }
            
            updateEstimatedCost();
        }

        function updateEstimatedCost() {
            const serviceSelect = document.getElementById('courier_service_id');
            const weightInput = document.getElementById('package_weight');
            const costDisplay = document.getElementById('estimated_cost');
            
            const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
            const weight = parseFloat(weightInput.value) || 0;
            
            if (selectedOption.value && selectedOption.dataset.price) {
                const basePrice = parseFloat(selectedOption.dataset.price);
                const currency = selectedOption.dataset.currency || 'PKR';
                const weightMultiplier = weight * 25; // PKR 25 per kg (adjusted for PKR)
                const totalCost = basePrice + weightMultiplier;
                
                costDisplay.textContent = `${currency} ${Math.round(totalCost)}`;
            } else {
                costDisplay.textContent = 'Select service to see cost';
            }
        }

        // Update cost when service or weight changes
        document.getElementById('courier_service_id').addEventListener('change', updateEstimatedCost);
        document.getElementById('package_weight').addEventListener('input', updateEstimatedCost);

        // Initialize services if company is pre-selected
        document.addEventListener('DOMContentLoaded', function() {
            updateServices();
        });
    </script>
</x-app-layout>