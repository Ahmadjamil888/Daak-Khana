<x-app-layout>
    <head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-title text-xl font-semibold text-neutral-800 leading-tight">
                {{ __('Company Profile') }}
            </h2>
            <a href="{{ route('courier.company.edit') }}" 
               class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                Edit Profile
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

            @if(!$company)
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
                                <p>You need to create your company profile to start receiving bookings.</p>
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
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Main Content -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Company Overview -->
                        <div class="bg-white rounded-lg shadow-sm border border-neutral-200 p-6">
                            <div class="flex items-start justify-between mb-6">
                                <div>
                                    <h1 class="text-3xl font-title font-bold text-neutral-900 mb-2">{{ $company->company_name }}</h1>
                                    <div class="flex items-center space-x-4">
                                        <!-- Rating -->
                                        <div class="flex items-center">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-5 h-5 {{ $i <= $company->rating ? 'text-yellow-400' : 'text-neutral-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            @endfor
                                            <span class="ml-2 text-lg font-semibold text-neutral-900">{{ number_format($company->rating, 1) }}</span>
                                            <span class="text-neutral-600">({{ $company->total_reviews }} reviews)</span>
                                        </div>
                                        
                                        <!-- Badges -->
                                        @if($company->is_verified)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                                Verified
                                            </span>
                                        @endif
                                        
                                        @if($company->is_featured)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-100 text-primary-800">
                                                Featured
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <a href="{{ route('courier.company.edit') }}" 
                                   class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                    Edit Profile
                                </a>
                            </div>

                            <!-- Description -->
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-neutral-900 mb-3">About Your Company</h3>
                                <p class="text-neutral-700 leading-relaxed">{{ $company->description }}</p>
                                
                                @if($company->ai_generated_description && $company->ai_generated_description !== $company->description)
                                    <div class="mt-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                        <h4 class="text-sm font-medium text-blue-900 mb-2">AI Generated Summary</h4>
                                        <p class="text-blue-800 text-sm">{{ $company->ai_generated_description }}</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Service Areas -->
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-neutral-900 mb-3">Service Areas</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($company->service_areas as $area)
                                        <span class="px-3 py-1 bg-neutral-100 text-neutral-700 rounded-full text-sm">{{ $area }}</span>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Operating Hours -->
                            <div>
                                <h3 class="text-lg font-semibold text-neutral-900 mb-3">Operating Hours</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    @foreach($company->operating_hours as $day => $hours)
                                        <div class="flex justify-between">
                                            <span class="capitalize text-neutral-600">{{ $day }}:</span>
                                            <span class="text-neutral-900 font-medium">{{ $hours === 'closed' ? 'Closed' : $hours }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Services -->
                        <div class="bg-white rounded-lg shadow-sm border border-neutral-200 p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-neutral-900">Your Services</h3>
                                <a href="{{ route('courier.services.index') }}" 
                                   class="text-primary-600 hover:text-primary-700 text-sm font-medium">
                                    Manage Services →
                                </a>
                            </div>
                            
                            @if($company->services->count() > 0)
                                <div class="space-y-4">
                                    @foreach($company->services as $service)
                                        <div class="border border-neutral-200 rounded-lg p-4">
                                            <div class="flex justify-between items-start mb-2">
                                                <h4 class="text-lg font-medium text-neutral-900">{{ $service->service_name }}</h4>
                                                <div class="text-right">
                                                    <div class="text-2xl font-bold text-primary-600">${{ number_format($service->price, 2) }}</div>
                                                    <div class="text-sm text-neutral-500">{{ $service->delivery_time }}</div>
                                                </div>
                                            </div>
                                            
                                            <p class="text-neutral-600 mb-3">{{ $service->description }}</p>
                                            
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-4 text-sm text-neutral-500">
                                                    <span>Max weight: {{ $service->max_weight }}kg</span>
                                                    <span>Type: {{ ucfirst(str_replace('_', ' ', $service->service_type)) }}</span>
                                                    <span class="px-2 py-1 rounded-full text-xs {{ $service->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                        {{ $service->is_active ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </div>
                                                
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('courier.services.edit', $service) }}" 
                                                       class="text-primary-600 hover:text-primary-700 text-sm">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <svg class="mx-auto h-12 w-12 text-neutral-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    <h3 class="text-lg font-medium text-neutral-900 mb-2">No services yet</h3>
                                    <p class="text-neutral-600 mb-6">Add services to start receiving bookings from customers.</p>
                                    <a href="{{ route('courier.services.create') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                                        Add Your First Service
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-6">
                        <!-- Stats -->
                        <div class="bg-white rounded-lg shadow-sm border border-neutral-200 p-6">
                            <h3 class="text-lg font-semibold text-neutral-900 mb-4">Performance Stats</h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-neutral-600">Total Bookings</span>
                                    <span class="text-2xl font-bold text-primary-600">{{ $company->bookings()->count() }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-neutral-600">Completed</span>
                                    <span class="text-2xl font-bold text-green-600">{{ $company->bookings()->where('status', 'delivered')->count() }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-neutral-600">Revenue</span>
                                    <span class="text-2xl font-bold text-green-600">${{ number_format($company->bookings()->where('status', 'delivered')->sum('total_amount'), 2) }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-neutral-600">Active Services</span>
                                    <span class="text-2xl font-bold text-blue-600">{{ $company->services()->where('is_active', true)->count() }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Company Info -->
                        <div class="bg-white rounded-lg shadow-sm border border-neutral-200 p-6">
                            <h3 class="text-lg font-semibold text-neutral-900 mb-4">Company Information</h3>
                            <div class="space-y-3">
                                @if($company->license_number)
                                    <div>
                                        <span class="text-sm text-neutral-500">License Number</span>
                                        <div class="font-medium text-neutral-900">{{ $company->license_number }}</div>
                                    </div>
                                @endif
                                
                                @if($company->insurance_details)
                                    <div>
                                        <span class="text-sm text-neutral-500">Insurance</span>
                                        <div class="font-medium text-neutral-900">{{ $company->insurance_details }}</div>
                                    </div>
                                @endif
                                
                                <div>
                                    <span class="text-sm text-neutral-500">Member Since</span>
                                    <div class="font-medium text-neutral-900">{{ $company->created_at->format('F Y') }}</div>
                                </div>
                                
                                <div>
                                    <span class="text-sm text-neutral-500">Base Price</span>
                                    <div class="font-medium text-neutral-900">${{ number_format($company->base_price, 2) }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="bg-white rounded-lg shadow-sm border border-neutral-200 p-6">
                            <h3 class="text-lg font-semibold text-neutral-900 mb-4">Quick Actions</h3>
                            <div class="space-y-3">
                                <a href="{{ route('courier.services.create') }}" 
                                   class="w-full bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg text-center block transition-colors">
                                    Add New Service
                                </a>
                                <a href="{{ route('courier.bookings') }}" 
                                   class="w-full border border-neutral-300 hover:bg-neutral-50 text-neutral-700 px-4 py-2 rounded-lg text-center block transition-colors">
                                    View Bookings
                                </a>
                                <a href="{{ route('companies.show', $company) }}" 
                                   class="w-full border border-neutral-300 hover:bg-neutral-50 text-neutral-700 px-4 py-2 rounded-lg text-center block transition-colors">
                                    View Public Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>