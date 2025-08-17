<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ڈاک خانہ - {{ $title ?? 'Pakistan\'s First Professional Courier Service Platform' }}</title>
    <meta name="description" content="پاکستان کا سب سے قابل اعتماد کوریئر سروس پلیٹ فارم۔ محفوظ لاگ ان کریں اور اپنی ڈیلیوری سروسز کا انتظام کریں۔">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&family=Noto+Sans+Arabic:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind & Alpine -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-white via-green-50 to-white text-gray-900">

    <!-- Navbar -->
    <header class="absolute inset-x-0 top-0 z-50" x-data="{ open: false }">
        <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
            <!-- Logo -->
            <div class="flex lg:flex-1">
                <a href="/" class="-m-1.5 p-1.5">
                    <span class="sr-only">Daak Khana</span>
                    <img src="{{ asset('favicon.svg') }}" alt="Daak Khana Logo" class="h-8 w-auto">
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="flex lg:hidden">
                <button type="button" @click="open = !open" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-green-700">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                    </svg>
                </button>
            </div>

            <!-- Desktop menu -->
            <div class="hidden lg:flex lg:gap-x-12">
                <a href="{{ route('login') }}" class="text-sm font-semibold text-green-700 hover:text-green-800">Login</a>
                <a href="{{ route('register') }}" class="text-sm font-semibold text-green-700 hover:text-green-800">Register</a>
            </div>
            <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                <a href="{{ route('login') }}" class="text-sm font-semibold text-green-700 hover:text-green-800">Log in <span aria-hidden="true">&rarr;</span></a>
            </div>
        </nav>

        <!-- Mobile menu -->
        <div x-show="open" class="lg:hidden" role="dialog" aria-modal="true">
            <div class="fixed inset-0 z-40 bg-black/20" @click="open = false"></div>
            <div class="fixed inset-y-0 right-0 z-50 w-full sm:max-w-sm bg-white shadow-lg ring-1 ring-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <a href="/" class="-m-1.5 p-1.5">
                        <img src="{{ asset('favicon.svg') }}" alt="Daak Khana Logo" class="h-8 w-auto">
                    </a>
                    <button type="button" @click="open = false" class="p-2 text-green-700 rounded-md">
                        <span class="sr-only">Close menu</span>
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div class="mt-6 space-y-4">
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-lg text-base font-semibold text-green-700 hover:bg-green-50">Login</a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 rounded-lg text-base font-semibold text-green-700 hover:bg-green-50">Register</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex min-h-screen items-center justify-center px-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8 border border-green-100">
            {{ $slot }}
        </div>
    </main>

</body>
</html>
