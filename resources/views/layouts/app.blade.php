<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ڈاک خانہ - {{ $title ?? 'Pakistan\'s First Professional Courier Service Platform' }}</title>
    <meta name="description" content="پاکستان کا سب سے قابل اعتماد کوریئر سروس پلیٹ فارم۔ تصدیق شدہ کوریئر کمپنیوں کے ساتھ جڑیں اور محفوظ، تیز اور قابل اعتماد ڈیلیوری حل حاصل کریں۔">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('mylogo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&family=Noto+Sans+Arabic:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-body antialiased bg-neutral-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white/95 backdrop-blur-md shadow-lg border-b border-neutral-200/50 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-18">
                    <div class="flex items-center">
                        <!-- Logo -->
                        <div class="flex-shrink-0">
                            <a href="{{ route('dashboard') }}" class="flex items-center group">
                                <img src="{{ asset('mylogo.png') }}" alt="Daak Khana Logo" class="w-10 h-10 rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-105">
                                <span class="ml-3 text-xl font-bold text-neutral-900 group-hover:text-primary-600 transition-colors duration-300">ڈاک خانہ</span>
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            @auth
                                @if(auth()->user()->isCustomer())
                                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                        {{ __('Dashboard') }}
                                    </x-nav-link>
                                    <x-nav-link :href="route('companies.index')" :active="request()->routeIs('companies.*')">
                                        {{ __('Browse Companies') }}
                                    </x-nav-link>
                                    <x-nav-link :href="route('bookings.index')" :active="request()->routeIs('bookings.*')">
                                        {{ __('My Bookings') }}
                                    </x-nav-link>
                                    <x-nav-link :href="route('ai.chat.show')" :active="request()->routeIs('ai.*')">
                                        {{ __('AI Assistant') }}
                                    </x-nav-link>
                                    @if(!auth()->user()->isProActive())
                                        <x-nav-link :href="route('subscriptions.create')" class="text-blue-600 font-semibold">
                                            {{ __('Upgrade to Pro') }}
                                        </x-nav-link>
                                    @endif
                                @elseif(auth()->user()->isCourier())
                                    <x-nav-link :href="route('courier.dashboard')" :active="request()->routeIs('courier.dashboard')">
                                        {{ __('Dashboard') }}
                                    </x-nav-link>
                                    <x-nav-link :href="route('courier.company.profile')" :active="request()->routeIs('courier.company.*')">
                                        {{ __('Company Profile') }}
                                    </x-nav-link>
                                    <x-nav-link :href="route('courier.bookings')" :active="request()->routeIs('courier.bookings')">
                                        {{ __('Bookings') }}
                                    </x-nav-link>
                                    @if(auth()->user()->isProActive())
                                        <x-nav-link :href="route('ai.chat.show')" :active="request()->routeIs('ai.*')">
                                            {{ __('AI Tools') }}
                                        </x-nav-link>
                                    @else
                                        <x-nav-link :href="route('subscriptions.create')" class="text-blue-600 font-semibold">
                                            {{ __('Pro Features') }}
                                        </x-nav-link>
                                    @endif
                                @endif
                            @endauth
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        @auth
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-neutral-500 bg-white hover:text-neutral-700 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>
                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        @else
                            <div class="flex items-center space-x-4">
                                <a href="{{ route('login') }}" class="text-neutral-600 hover:text-neutral-900 px-4 py-2 text-sm font-medium rounded-xl hover:bg-neutral-50 transition-all duration-300">Login</a>
                                <a href="{{ route('register') }}" class="bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white px-6 py-2.5 rounded-xl text-sm font-medium transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">Register</a>
                            </div>
                        @endauth
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-neutral-400 hover:text-neutral-500 hover:bg-neutral-100 focus:outline-none focus:bg-neutral-100 focus:text-neutral-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-neutral-900 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center mb-4">
                            <img src="{{ asset('favicon.svg') }}" alt="Daak Khana Logo" class="w-8 h-8 rounded-lg">
                            <span class="ml-2 text-xl font-bold">ڈاک خانہ</span>
                        </div>
                        <p class="text-neutral-300 mb-4 max-w-md">
                            پاکستان کا سب سے قابل اعتماد کوریئر سروس پلیٹ فارم۔ تصدیق شدہ کوریئر کمپنیوں کے ساتھ جڑیں اور محفوظ، تیز اور قابل اعتماد ڈیلیوری حل حاصل کریں۔
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-neutral-400 hover:text-white transition-colors">
                                <span class="sr-only">Facebook</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-neutral-400 hover:text-white transition-colors">
                                <span class="sr-only">Twitter</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                                </svg>
                            </a>
                            <a href="#" class="text-neutral-400 hover:text-white transition-colors">
                                <span class="sr-only">LinkedIn</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-semibold text-white tracking-wider uppercase mb-4">Services</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-neutral-300 hover:text-white transition-colors">Same Day Delivery</a></li>
                            <li><a href="#" class="text-neutral-300 hover:text-white transition-colors">Express Shipping</a></li>
                            <li><a href="#" class="text-neutral-300 hover:text-white transition-colors">International</a></li>
                            <li><a href="#" class="text-neutral-300 hover:text-white transition-colors">Bulk Orders</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-semibold text-white tracking-wider uppercase mb-4">Support</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-neutral-300 hover:text-white transition-colors">Help Center</a></li>
                            <li><a href="#" class="text-neutral-300 hover:text-white transition-colors">Contact Us</a></li>
                            <li><a href="#" class="text-neutral-300 hover:text-white transition-colors">Track Package</a></li>
                            <li><a href="#" class="text-neutral-300 hover:text-white transition-colors">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="mt-8 pt-8 border-t border-neutral-800">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <p class="text-neutral-400 text-sm">
                            © {{ date('Y') }} ڈاک خانہ۔ تمام حقوق محفوظ ہیں۔
                        </p>
                        <div class="flex space-x-6 mt-4 md:mt-0">
                            <a href="#" class="text-neutral-400 hover:text-white text-sm transition-colors">Privacy Policy</a>
                            <a href="#" class="text-neutral-400 hover:text-white text-sm transition-colors">Terms of Service</a>
                            <a href="#" class="text-neutral-400 hover:text-white text-sm transition-colors">Cookie Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>