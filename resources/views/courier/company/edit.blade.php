<x-app-layout>
    <head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
    <x-slot name="header">
        <h2 class="font-title text-xl font-semibold text-neutral-800 leading-tight">
            {{ __('Edit Company Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('courier.company.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Company Name -->
                        <div class="mb-6">
                            <label for="company_name" class="block text-sm font-medium text-neutral-700 mb-2">Company Name</label>
                            <input type="text" 
                                   name="company_name" 
                                   id="company_name"
                                   value="{{ old('company_name', $company->company_name) }}"
                                   class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500"
                                   required>
                            @error('company_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-neutral-700 mb-2">Company Description</label>
                            <textarea name="description" 
                                      id="description"
                                      rows="4"
                                      class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500"
                                      placeholder="Describe your company, services, and what makes you unique..."
                                      required>{{ old('description', $company->description) }}</textarea>
                            <p class="mt-1 text-sm text-neutral-500">Minimum 50 characters. This will help customers understand your services.</p>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- AI Generated Description (if exists) -->
                        @if($company->ai_generated_description)
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-neutral-700 mb-2">AI Generated Description</label>
                                <div class="p-4 bg-blue-50 rounded-lg border border-blue-200">
                                    <p class="text-blue-800">{{ $company->ai_generated_description }}</p>
                                    <button type="button" class="mt-2 text-sm text-blue-600 hover:text-blue-800">Generate New AI Description</button>
                                </div>
                            </div>
                        @endif

                        <!-- Service Areas -->
                        <div class="mb-6">
                            <label for="service_areas" class="block text-sm font-medium text-neutral-700 mb-2">Service Areas</label>
                            <div id="service-areas-container">
                                @foreach(old('service_areas', $company->service_areas) as $index => $area)
                                    <div class="flex mb-2">
                                        <input type="text" 
                                               name="service_areas[]" 
                                               value="{{ $area }}"
                                               class="flex-1 rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500"
                                               placeholder="Enter city or area name"
                                               required>
                                        <button type="button" onclick="removeServiceArea(this)" class="ml-2 px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 {{ $index === 0 ? 'hidden' : '' }}">Remove</button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" onclick="addServiceArea()" class="mt-2 px-4 py-2 bg-neutral-500 text-white rounded-lg hover:bg-neutral-600">Add Another Area</button>
                            @error('service_areas')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pricing -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div>
                                <label for="base_price" class="block text-sm font-medium text-neutral-700 mb-2">Base Price ($)</label>
                                <input type="number" 
                                       name="base_price" 
                                       id="base_price"
                                       value="{{ old('base_price', $company->base_price) }}"
                                       step="0.01"
                                       min="0"
                                       class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500"
                                       required>
                                @error('base_price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="per_km" class="block text-sm font-medium text-neutral-700 mb-2">Per KM ($)</label>
                                <input type="number" 
                                       name="per_km" 
                                       id="per_km"
                                       value="{{ old('per_km', $company->pricing_structure['per_km'] ?? '0.50') }}"
                                       step="0.01"
                                       min="0"
                                       class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500">
                            </div>

                            <div>
                                <label for="per_kg" class="block text-sm font-medium text-neutral-700 mb-2">Per KG ($)</label>
                                <input type="number" 
                                       name="per_kg" 
                                       id="per_kg"
                                       value="{{ old('per_kg', $company->pricing_structure['per_kg'] ?? '0.25') }}"
                                       step="0.01"
                                       min="0"
                                       class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500">
                            </div>
                        </div>

                        <!-- Operating Hours -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-neutral-700 mb-2">Operating Hours</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                                    <div class="flex items-center space-x-2">
                                        <label class="w-20 text-sm text-neutral-600 capitalize">{{ $day }}:</label>
                                        <input type="text" 
                                               name="operating_hours[{{ $day }}]" 
                                               value="{{ old('operating_hours.' . $day, $company->operating_hours[$day] ?? 'closed') }}"
                                               placeholder="9:00-17:00 or closed"
                                               class="flex-1 rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500">
                                    </div>
                                @endforeach
                            </div>
                            <p class="mt-1 text-sm text-neutral-500">Use format like "9:00-17:00" or "closed" for closed days.</p>
                        </div>

                        <!-- License and Insurance -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="license_number" class="block text-sm font-medium text-neutral-700 mb-2">License Number (Optional)</label>
                                <input type="text" 
                                       name="license_number" 
                                       id="license_number"
                                       value="{{ old('license_number', $company->license_number) }}"
                                       class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500">
                                @error('license_number')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="insurance_details" class="block text-sm font-medium text-neutral-700 mb-2">Insurance Details (Optional)</label>
                                <input type="text" 
                                       name="insurance_details" 
                                       id="insurance_details"
                                       value="{{ old('insurance_details', $company->insurance_details) }}"
                                       placeholder="e.g., Insured up to $10,000"
                                       class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500">
                                @error('insurance_details')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Company Stats (Read-only) -->
                        <div class="mb-6 p-4 bg-neutral-50 rounded-lg">
                            <h3 class="text-lg font-medium text-neutral-900 mb-3">Company Statistics</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-primary-600">{{ number_format($company->rating, 1) }}</div>
                                    <div class="text-sm text-neutral-600">Rating</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-primary-600">{{ $company->total_reviews }}</div>
                                    <div class="text-sm text-neutral-600">Reviews</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-primary-600">{{ $company->bookings()->count() }}</div>
                                    <div class="text-sm text-neutral-600">Total Bookings</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-primary-600">{{ $company->services()->count() }}</div>
                                    <div class="text-sm text-neutral-600">Services</div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('courier.dashboard') }}" 
                               class="px-6 py-2 border border-neutral-300 text-neutral-700 rounded-lg hover:bg-neutral-50 transition-colors">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                                Update Company Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addServiceArea() {
            const container = document.getElementById('service-areas-container');
            const div = document.createElement('div');
            div.className = 'flex mb-2';
            div.innerHTML = `
                <input type="text" 
                       name="service_areas[]" 
                       class="flex-1 rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500"
                       placeholder="Enter city or area name"
                       required>
                <button type="button" onclick="removeServiceArea(this)" class="ml-2 px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Remove</button>
            `;
            container.appendChild(div);
        }

        function removeServiceArea(button) {
            const container = document.getElementById('service-areas-container');
            if (container.children.length > 1) {
                button.parentElement.remove();
            }
        }
    </script>
</x-app-layout>