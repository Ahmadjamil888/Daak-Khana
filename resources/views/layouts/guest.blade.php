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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .gradient-bg {
                background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            }
            .hero-pattern {
                background-image: 
                    radial-gradient(circle at 20% 50%, rgba(34, 197, 94, 0.05) 0%, transparent 50%),
                    radial-gradient(circle at 80% 20%, rgba(22, 163, 74, 0.05) 0%, transparent 50%),
                    radial-gradient(circle at 40% 80%, rgba(21, 128, 61, 0.03) 0%, transparent 50%);
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-white via-green-50/30 to-white hero-pattern">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="mb-8">
                <a href="/" class="flex items-center group">
                    <img src="{{ asset('favicon.svg') }}" alt="Daak Khana Logo" class="w-16 h-16 rounded-2xl shadow-lg group-hover:scale-105 transition-transform">
                    <div class="ml-4">
                        <div class="text-3xl font-bold text-neutral-900">ڈاک خانہ</div>
                        <div class="text-sm text-green-600 font-semibold">Pakistan's #1 Courier Platform</div>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-6 py-8 bg-white/95 backdrop-blur-sm shadow-2xl overflow-hidden rounded-2xl border border-green-100">
                {{ $slot }}
            </div>
            
            <div class="mt-6 text-center">
                <p class="text-sm text-neutral-600">
                    پاکستان کا سب سے قابل اعتماد کوریئر پلیٹ فارم
                </p>
                <div class="flex justify-center space-x-4 mt-2 text-xs text-neutral-500">
                    <span>محفوظ</span>
                    <span>•</span>
                    <span>تیز</span>
                    <span>•</span>
                    <span>قابل اعتماد</span>
                </div>
            </div>
        </div>
    </body>
</html>
