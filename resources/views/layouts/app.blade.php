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
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                            950: '#052e16'
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'Poppins', 'system-ui', 'sans-serif'],
                        arabic: ['Noto Sans Arabic', 'system-ui', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- AdSense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6482011762315089" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .btn-primary {
            @apply bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2;
        }
        .btn-secondary {
            @apply bg-white hover:bg-gray-50 text-primary-700 border border-primary-200 px-4 py-2 rounded-lg font-medium transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2;
        }
        .card {
            @apply bg-white rounded-xl shadow-sm border border-gray-200 p-6;
        }
        .form-input {
            @apply w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200;
        }
        .nav-link {
            @apply text-gray-700 hover:text-primary-600 font-medium transition-colors duration-200;
        }
        .nav-link-active {
            @apply text-primary-600 font-semibold;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900" x-data="{ open: false, profileOpen: false }">
    <div class="min-h-screen bg-gray-50">
        <!-- Navigation -->
        <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
            <nav aria-label="Global" class="max-w-7xl mx-auto flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16">
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <img src="{{ asset('mylogo.png') }}" alt="Daak Khana Logo" class="h-8 w-auto" />
                        <span class="ml-2 text-xl font-bold text-primary-600">ڈاک خانہ</span>
                    </a>
                </div>
                
                <div class="flex lg:hidden">
                    <button type="button" @click="open = ! open" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700 hover:text-gray-900">
                        <span class="sr-only">Open main menu</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-6 h-6">
                            <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                
                <div class="hidden lg:flex lg:items-center lg:space-x-8">
                    @auth
                        @if(auth()->user()->isCustomer())
                            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'nav-link-active' : '' }}">Dashboard</a>
                            <a href="{{ route('companies.index') }}" class="nav-link {{ request()->routeIs('companies.*') ? 'nav-link-active' : '' }}">Browse Companies</a>
                            <a href="{{ route('bookings.index') }}" class="nav-link {{ request()->routeIs('bookings.*') ? 'nav-link-active' : '' }}">My Bookings</a>
                            <a href="{{ route('ai.chat.show') }}" class="nav-link {{ request()->routeIs('ai.*') ? 'nav-link-active' : '' }}">AI Assistant</a>
                            @if(!auth()->user()->isProActive())
                                <a href="{{ route('subscriptions.create') }}" class="btn-primary">Upgrade to Pro</a>
                            @endif
                        @elseif(auth()->user()->isCourier())
                            <a href="{{ route('courier.dashboard') }}" class="nav-link {{ request()->routeIs('courier.dashboard') ? 'nav-link-active' : '' }}">Dashboard</a>
                            <a href="{{ route('courier.company.profile') }}" class="nav-link {{ request()->routeIs('courier.company.*') ? 'nav-link-active' : '' }}">Company Profile</a>
                            <a href="{{ route('courier.bookings') }}" class="nav-link {{ request()->routeIs('courier.bookings') ? 'nav-link-active' : '' }}">Bookings</a>
                            @if(auth()->user()->isProActive())
                                <a href="{{ route('ai.chat.show') }}" class="nav-link {{ request()->routeIs('ai.*') ? 'nav-link-active' : '' }}">AI Tools</a>
                            @else
                                <a href="{{ route('subscriptions.create') }}" class="btn-primary">Pro Features</a>
                            @endif
                        @endif
                    @endauth
                </div>
                
                <div class="hidden lg:flex lg:items-center">
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 rounded-lg px-3 py-2">
                                <div class="w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary-600">Profile Settings</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-red-600"
                                       onclick="event.preventDefault(); this.closest('form').submit();">
                                        Sign Out
                                    </a>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary">Sign In</a>
                    @endauth
                </div>
            </nav>

            <!-- Mobile menu -->
            <div x-show="open" class="lg:hidden" role="dialog" aria-modal="true">
                <div class="fixed inset-0 z-40 bg-black/20" @click="open = false"></div>
                <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm shadow-xl">
                    <div class="flex items-center justify-between">
                        <a href="{{ route('dashboard') }}" class="flex items-center">
                            <img src="{{ asset('mylogo.png') }}" alt="Daak Khana Logo" class="h-8 w-auto" />
                            <span class="ml-2 text-xl font-bold text-primary-600">ڈاک خانہ</span>
                        </a>
                        <button type="button" @click="open = false" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                            <span class="sr-only">Close menu</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-6 h-6">
                                <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                    <div class="mt-6 flow-root">
                        <div class="-my-6 divide-y divide-gray-200">
                            <div class="space-y-2 py-6">
                                @auth
                                    @if(auth()->user()->isCustomer())
                                        <a href="{{ route('dashboard') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-primary-50">Dashboard</a>
                                        <a href="{{ route('companies.index') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-primary-50">Browse Companies</a>
                                        <a href="{{ route('bookings.index') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-primary-50">My Bookings</a>
                                        <a href="{{ route('ai.chat.show') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-primary-50">AI Assistant</a>
                                        @if(!auth()->user()->isProActive())
                                            <a href="{{ route('subscriptions.create') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-primary-600 hover:bg-primary-50">Upgrade to Pro</a>
                                        @endif
                                    @elseif(auth()->user()->isCourier())
                                        <a href="{{ route('courier.dashboard') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-primary-50">Dashboard</a>
                                        <a href="{{ route('courier.company.profile') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-primary-50">Company Profile</a>
                                        <a href="{{ route('courier.bookings') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-primary-50">Bookings</a>
                                        @if(auth()->user()->isProActive())
                                            <a href="{{ route('ai.chat.show') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-primary-50">AI Tools</a>
                                        @else
                                            <a href="{{ route('subscriptions.create') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-primary-600 hover:bg-primary-50">Pro Features</a>
                                        @endif
                                    @endif
                                @endauth
                            </div>
                            <div class="py-6">
                                @auth
                                    <div class="flex items-center px-3 py-2 mb-4">
                                        <div class="w-10 h-10 bg-primary-600 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-3">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</div>
                                            <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                                        </div>
                                    </div>
                                    <a href="{{ route('profile.edit') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">Profile Settings</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-red-600 hover:bg-red-50"
                                           onclick="event.preventDefault(); this.closest('form').submit();">
                                            Sign Out
                                        </a>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-primary-600 hover:bg-primary-50">Sign In</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="bg-green-600">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 text-center">
                    <span class="text-white font-extrabold tracking-wide">We charge only 1% of your earnings</span>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1">
            @hasSection('content')
                @yield('content')
            @elseif(isset($slot))
                {{ $slot }}
            @endif
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center mb-4">
                            <img src="{{ asset('mylogo.png') }}" alt="Daak Khana Logo" class="h-8 w-auto">
                            <span class="ml-2 text-xl font-bold text-primary-600">ڈاک خانہ</span>
                        </div>
                        <p class="text-gray-600 mb-4 max-w-md">
                            پاکستان کا سب سے قابل اعتماد کوریئر سروس پلیٹ فارم۔ تصدیق شدہ کوریئر کمپنیوں کے ساتھ جڑیں اور محفوظ، تیز اور قابل اعتماد ڈیلیوری حل حاصل کریں۔
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-primary-600 transition-colors">
                                <span class="sr-only">Facebook</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-primary-600 transition-colors">
                                <span class="sr-only">Twitter</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-primary-600 transition-colors">
                                <span class="sr-only">LinkedIn</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase mb-4">Services</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-600 hover:text-primary-600 transition-colors">Same Day Delivery</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-primary-600 transition-colors">Express Shipping</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-primary-600 transition-colors">International</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-primary-600 transition-colors">Bulk Orders</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase mb-4">Support</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-600 hover:text-primary-600 transition-colors">Help Center</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-primary-600 transition-colors">Contact Us</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-primary-600 transition-colors">Track Package</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-primary-600 transition-colors">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <p class="text-gray-500 text-sm">
                            © {{ date('Y') }} ڈاک خانہ۔ تمام حقوق محفوظ ہیں۔
                        </p>
                        <div class="flex space-x-6 mt-4 md:mt-0">
                            <a href="#" class="text-gray-500 hover:text-primary-600 text-sm transition-colors">Privacy Policy</a>
                            <a href="#" class="text-gray-500 hover:text-primary-600 text-sm transition-colors">Terms of Service</a>
                            <a href="#" class="text-gray-500 hover:text-primary-600 text-sm transition-colors">Cookie Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

</body>
</html>