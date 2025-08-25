<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ڈاک خانہ - {{ $title ?? 'Pakistan\'s First Professional Courier Service Platform' }}</title>
    <meta name="description" content="پاکستان کا سب سے قابل اعتماد کوریئر سروس پلیٹ فارم۔ محفوظ لاگ ان کریں اور اپنی ڈیلیوری سروسز کا انتظام کریں۔">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('mylogo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&family=Noto+Sans+Arabic:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind & Alpine -->
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
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .btn-primary {
            @apply bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2;
        }
        .btn-secondary {
            @apply bg-white hover:bg-gray-50 text-primary-700 border border-primary-200 px-6 py-3 rounded-lg font-medium transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2;
        }
        .form-input {
            @apply w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200 placeholder-gray-500;
        }
        .form-label {
            @apply block text-sm font-medium text-gray-700 mb-2;
        }
        .auth-card {
            @apply bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-8;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-primary-50 via-white to-primary-50 text-gray-900" x-data="{ open: false }">

    <!-- Navbar -->
    <header class="absolute inset-x-0 top-0 z-50">
        <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
            <!-- Logo -->
            <div class="flex lg:flex-1">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('mylogo.png') }}" alt="Daak Khana Logo" class="h-8 w-auto">
                    <span class="ml-2 text-xl font-bold text-primary-600">ڈاک خانہ</span>
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="flex lg:hidden">
                <button type="button" @click="open = !open" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-primary-700 hover:text-primary-800">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                    </svg>
                </button>
            </div>

            <!-- Desktop menu -->
            <div class="hidden lg:flex lg:items-center lg:gap-x-8">
                <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 hover:text-primary-600 transition-colors">Sign In</a>
                <a href="{{ route('register') }}" class="btn-primary">Get Started</a>
            </div>
        </nav>

        <!-- Mobile menu -->
        <div x-show="open" class="lg:hidden" role="dialog" aria-modal="true">
            <div class="fixed inset-0 z-40 bg-black/20" @click="open = false"></div>
            <div class="fixed inset-y-0 right-0 z-50 w-full sm:max-w-sm bg-white shadow-xl p-6">
                <div class="flex items-center justify-between">
                    <a href="/" class="flex items-center">
                        <img src="{{ asset('mylogo.png') }}" alt="Daak Khana Logo" class="h-8 w-auto">
                        <span class="ml-2 text-xl font-bold text-primary-600">ڈاک خانہ</span>
                    </a>
                    <button type="button" @click="open = false" class="p-2 text-gray-700 rounded-md hover:text-gray-900">
                        <span class="sr-only">Close menu</span>
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div class="mt-6 space-y-4">
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-lg text-base font-semibold text-gray-900 hover:bg-primary-50">Sign In</a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 rounded-lg text-base font-semibold text-primary-600 hover:bg-primary-50">Get Started</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-grid-gray-100/50 bg-grid-16 [mask-image:radial-gradient(ellipse_at_center,transparent_20%,black)]" aria-hidden="true"></div>
    
    <!-- Main Content -->
    <main class="relative flex min-h-screen items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">
            <!-- Logo Section -->
            <div class="text-center mb-8">
                <div class="flex items-center justify-center mb-4">
                    <img src="{{ asset('mylogo.png') }}" alt="Daak Khana Logo" class="h-12 w-auto">
                    <span class="ml-3 text-2xl font-bold text-primary-600">ڈاک خانہ</span>
                </div>
                <p class="text-gray-600">Pakistan's First Professional Courier Service Platform</p>
            </div>
            
            <!-- Auth Card -->
            <div class="auth-card">
                {{ $slot }}
            </div>
            
            <!-- Footer Links -->
            <div class="mt-6 text-center text-sm text-gray-500">
                <p>&copy; {{ date('Y') }} ڈاک خانہ. All rights reserved.</p>
                <div class="mt-2 space-x-4">
                    <a href="#" class="hover:text-primary-600 transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-primary-600 transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
