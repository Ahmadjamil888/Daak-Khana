<x-app-layout>
    <head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-title text-xl font-semibold text-neutral-800 leading-tight">
                {{ __('Browse Courier Companies') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Filters -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-neutral-200/50 p-8 mb-10">
                <form method="GET" action="{{ route('companies.index') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Search -->
                        <div>
                            <label for="search" class="block text-sm font-medium text-neutral-700 mb-1">Search Companies</label>
                            <input type="text" 
                                   name="search" 
                                   id="search"
                                   value="{{ request('search') }}"
                                   placeholder="Company name or description..."
                                   class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500">
                        </div>

                        <!-- Service Type -->
                        <div>
                            <label for="service_type" class="block text-sm font-medium text-neutral-700 mb-1">Service Type</label>
                            <select name="service_type" id="service_type" class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500">
                                <option value="">All Services</option>
                                <option value="same_day" {{ request('service_type') === 'same_day' ? 'selected' : '' }}>Same Day</option>
                                <option value="next_day" {{ request('service_type') === 'next_day' ? 'selected' : '' }}>Next Day</option>
                                <option value="express" {{ request('service_type') === 'express' ? 'selected' : '' }}>Express</option>
                                <option value="standard" {{ request('service_type') === 'standard' ? 'selected' : '' }}>Standard</option>
                                <option value="international" {{ request('service_type') === 'international' ? 'selected' : '' }}>International</option>
                            </select>
                        </div>

                        <!-- Location -->
                        <div>
                            <label for="location" class="block text-sm font-medium text-neutral-700 mb-1">Location</label>
                            <input type="text" 
                                   name="location" 
                                   id="location"
                                   value="{{ request('location') }}"
                                   placeholder="City or area..."
                                   class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500">
                        </div>

                        <!-- Search Button -->
                        <div class="flex items-end">
                            <button type="submit" class="w-full bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    Search
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Results Count -->
            <div class="mb-6">
                <p class="text-neutral-600">
                    Showing {{ $companies->count() }} of {{ $companies->total() }} companies
                    @if(request()->hasAny(['search', 'service_type', 'location']))
                        <a href="{{ route('companies.index') }}" class="text-primary-600 hover:text-primary-700 ml-2">Clear filters</a>
                    @endif
                </p>
            </div>

            <!-- Companies Grid -->
            @if($companies->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @foreach($companies as $company)
                        <div class="bg-white rounded-lg shadow-sm border border-neutral-200 hover:shadow-md transition-shadow">
                            <!-- Company Header -->
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1">
                                        <div class="flex items-center mb-2">
                                            <h3 class="text-lg font-semibold text-neutral-900">{{ $company->company_name }}</h3>
                                            @if($company->is_featured)
                                                <span class="ml-2 px-2 py-1 bg-primary-100 text-primary-800 text-xs font-medium rounded-full">Featured</span>
                                            @endif
                                            @if($company->is_verified)
                                                <svg class="ml-1 w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                            @endif
                                        </div>
                                        
                                        <!-- Rating -->
                                        <div class="flex items-center mb-3">
                                            <div class="flex items-center">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <svg class="w-4 h-4 {{ $i <= $company->rating ? 'text-yellow-400' : 'text-neutral-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                @endfor
                                                <span class="ml-1 text-sm text-neutral-600">{{ number_format($company->rating, 1) }} ({{ $company->total_reviews }})</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Description -->
                                <p class="text-neutral-600 text-sm mb-4 line-clamp-3">
                                    {{ Str::limit($company->description, 120) }}
                                </p>

                                <!-- Services -->
                                <div class="mb-4">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($company->services->take(3) as $service)
                                            <span class="px-2 py-1 bg-neutral-100 text-neutral-700 text-xs rounded-full">
                                                {{ ucfirst(str_replace('_', ' ', $service->service_type)) }}
                                            </span>
                                        @endforeach
                                        @if($company->services->count() > 3)
                                            <span class="px-2 py-1 bg-neutral-100 text-neutral-700 text-xs rounded-full">
                                                +{{ $company->services->count() - 3 }} more
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Pricing -->
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-sm text-neutral-500">Starting from</span>
                                        <div class="text-lg font-semibold text-neutral-900">{{ $company->currency ?? 'PKR' }} {{ number_format($company->base_price, 0) }}</div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('companies.show', $company) }}" 
                                           class="px-4 py-2 border border-neutral-300 text-neutral-700 rounded-lg hover:bg-neutral-50 transition-colors text-sm font-medium">
                                            View Details
                                        </a>
                                        @auth
                                            @if(auth()->user()->isCustomer())
                                                <a href="{{ route('bookings.create', ['company_id' => $company->id]) }}" 
                                                   class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors text-sm font-medium">
                                                    Book Now
                                                </a>
                                            @endif
                                        @else
                                            <a href="{{ route('login') }}" 
                                               class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors text-sm font-medium">
                                                Book Now
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center">
                    {{ $companies->withQueryString()->links() }}
                </div>
            @else
                <!-- No Results -->
                <div class="bg-white rounded-lg shadow-sm border border-neutral-200 p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-neutral-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-neutral-900 mb-2">No companies found</h3>
                    <p class="text-neutral-600 mb-6">
                        @if(request()->hasAny(['search', 'service_type', 'location']))
                            Try adjusting your search criteria or clearing the filters.
                        @else
                            There are no courier companies available at the moment.
                        @endif
                    </p>
                    @if(request()->hasAny(['search', 'service_type', 'location']))
                        <a href="{{ route('companies.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                            Clear Filters
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>