<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daak Khana - Pakistan's First Professional Courier Marketplace</title>
    <meta name="description" content="Pakistan's premier courier marketplace connecting customers with verified courier companies. Fast, secure, and reliable delivery solutions across Pakistan.">
    <meta name="keywords" content="courier Pakistan, delivery service, logistics, parcel delivery, express shipping, same day delivery, TCS, Leopards, courier marketplace">
    <meta name="author" content="Daak Khana">
    
    <!-- Open Graph -->
    <meta property="og:title" content="Daak Khana - Pakistan's First Professional Courier Marketplace">
    <meta property="og:description" content="Connect with verified courier companies for reliable delivery solutions across Pakistan.">
    <meta property="og:image" content="{{ asset('favicon.svg') }}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="website">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --primary-50: #f0fdf4;
            --primary-100: #dcfce7;
            --primary-200: #bbf7d0;
            --primary-300: #86efac;
            --primary-400: #4ade80;
            --primary-500: #22c55e;
            --primary-600: #16a34a;
            --primary-700: #15803d;
            --primary-800: #166534;
            --primary-900: #14532d;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, var(--primary-500) 0%, var(--primary-600) 100%);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, var(--primary-500) 0%, var(--primary-600) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero-pattern {
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(34, 197, 94, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(22, 163, 74, 0.06) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(21, 128, 61, 0.04) 0%, transparent 50%);
        }
        
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head><body class
="font-sans antialiased bg-white">
    <!-- Navigation -->
    <nav class="bg-white/95 backdrop-blur-md border-b border-green-100 fixed w-full top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center">
                            <img src="{{ asset('mylogo.png') }}" alt="Daak Khana Logo" class="w-12 h-12 rounded-xl shadow-md">
                            <div class="ml-3">
                                <span class="text-2xl font-bold text-gray-900">Daak Khana</span>
                                <div class="text-xs text-green-600 font-semibold">Pakistan's #1 Courier Platform</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="hidden lg:ml-12 lg:flex lg:space-x-8">
                        <a href="#services" class="text-gray-600 hover:text-green-600 px-3 py-2 text-sm font-medium transition-colors rounded-lg hover:bg-green-50">Services</a>
                        <a href="#how-it-works" class="text-gray-600 hover:text-green-600 px-3 py-2 text-sm font-medium transition-colors rounded-lg hover:bg-green-50">How It Works</a>
                        <a href="#features" class="text-gray-600 hover:text-green-600 px-3 py-2 text-sm font-medium transition-colors rounded-lg hover:bg-green-50">Features</a>
                        <a href="#companies" class="text-gray-600 hover:text-green-600 px-3 py-2 text-sm font-medium transition-colors rounded-lg hover:bg-green-50">Companies</a>
                        <a href="#pricing" class="text-gray-600 hover:text-green-600 px-3 py-2 text-sm font-medium transition-colors rounded-lg hover:bg-green-50">Pricing</a>
                        <a href="#contact" class="text-gray-600 hover:text-green-600 px-3 py-2 text-sm font-medium transition-colors rounded-lg hover:bg-green-50">Contact</a>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="/login" class="text-gray-600 hover:text-green-600 px-4 py-2 text-sm font-medium transition-colors rounded-lg hover:bg-green-50">Login</a>
                    <a href="/register" class="gradient-bg text-white px-6 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- 1. Hero Section -->
    <section class="pt-20 bg-gradient-to-br from-white via-green-50/30 to-white hero-pattern min-h-screen flex items-center relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="text-center lg:text-left fade-in-up">
                    <div class="inline-flex items-center px-4 py-2 bg-green-50 text-green-700 rounded-full text-sm font-semibold mb-8 border border-green-200">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                        Pakistan's First Professional Courier Marketplace
                    </div>
                    
                    <h1 class="text-5xl lg:text-7xl font-bold text-gray-900 mb-8 leading-tight">
                        <span class="gradient-text">Daak Khana</span>
                        <span class="block text-4xl lg:text-5xl mt-2">Connecting Pakistan</span>
                        <span class="block text-4xl lg:text-5xl">One Delivery at a Time</span>
                    </h1>
                    
                    <p class="text-xl text-gray-600 mb-10 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Experience Pakistan's most advanced courier marketplace. Connect with verified courier companies, compare prices, track shipments in real-time, and enjoy seamless delivery solutions across the country.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start mb-12">
                        <a href="/register?type=customer" class="group gradient-bg text-white px-8 py-4 rounded-2xl text-lg font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center justify-center">
                            Start Shipping Now
                            <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                        <a href="#companies" class="group border-2 border-green-200 hover:border-green-300 bg-white hover:bg-green-50 text-gray-700 hover:text-green-700 px-8 py-4 rounded-2xl text-lg font-semibold transition-all duration-300 hover:shadow-lg flex items-center justify-center">
                            Explore Companies
                            <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div class="relative fade-in-up">
                    <!-- Static Image -->
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                        <img src="{{ asset('static-image.png') }}" alt="Courier Service" class="w-full h-96 object-cover">
                        
                        <!-- Greyish Tint Overlay -->
                        <div class="absolute inset-0 bg-gray-900 bg-opacity-20"></div>
                        
                        <!-- Live Tracking Overlay Card -->
                        <div class="absolute bottom-6 left-6 right-6 bg-white/95 backdrop-blur-sm rounded-2xl p-6 border border-green-100">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="w-100 h-100 gradient-bg rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <div class="font-bold text-gray-900 text-sm">Live Tracking</div>
                                        <div class="text-xs text-gray-600">Karachi to Lahore</div>
                                    </div>
                                </div>
                                <div class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                    In Transit
                                </div>
                            </div>
                            
                            <!-- Progress Bar -->
                            <div class="mb-4">
                                <div class="flex justify-between text-xs text-gray-500 mb-1">
                                    <span>Karachi</span>
                                    <span>Lahore</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5">
                                    <div class="gradient-bg h-1.5 rounded-full w-3/4"></div>
                                </div>
                            </div>
                            
                            <!-- Courier Info -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                        <span class="text-green-700 font-bold text-xs">TCS</span>
                                    </div>
                                    <div class="ml-2">
                                        <div class="font-semibold text-gray-900 text-xs">TCS Express</div>
                                        <div class="flex items-center">
                                            <div class="flex text-yellow-400 text-xs">★★★★★</div>
                                            <span class="text-gray-500 text-xs ml-1">4.8</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-gray-900 text-sm">Rs. 450</div>
                                    <div class="text-xs text-gray-500">Next Day</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Floating Stats -->
                    <div class="absolute -top-4 -right-4 bg-white rounded-xl p-3 shadow-lg border border-green-100 z-20">
                        <div class="text-center">
                            <div class="text-xl font-bold gradient-text">24/7</div>
                            <div class="text-xs text-gray-500">Support</div>
                        </div>
                    </div>
                    
                    <div class="absolute -bottom-4 -left-4 bg-white rounded-xl p-3 shadow-lg border border-green-100 z-20">
                        <div class="text-center">
                            <div class="text-xl font-bold gradient-text">98%</div>
                            <div class="text-xs text-gray-500">On Time</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Trust Indicators -->
    <section class="py-16 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-12">
                <p class="text-gray-600 font-medium">Trusted by Pakistan's leading courier companies</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8 items-center opacity-60">
                <div class="flex justify-center">
                    <div class="bg-red-100 text-red-700 px-6 py-3 rounded-lg font-bold text-xl">TCS</div>
                </div>
                <div class="flex justify-center">
                    <div class="bg-blue-100 text-blue-700 px-6 py-3 rounded-lg font-bold text-xl">Leopards</div>
                </div>
                <div class="flex justify-center">
                    <div class="bg-green-100 text-green-700 px-6 py-3 rounded-lg font-bold text-xl">M&P</div>
                </div>
                <div class="flex justify-center">
                    <div class="bg-purple-100 text-purple-700 px-6 py-3 rounded-lg font-bold text-xl">Blue EX</div>
                </div>
                <div class="flex justify-center">
                    <div class="bg-orange-100 text-orange-700 px-6 py-3 rounded-lg font-bold text-xl">Call Courier</div>
                </div>
                <div class="flex justify-center">
                    <div class="bg-indigo-100 text-indigo-700 px-6 py-3 rounded-lg font-bold text-xl">Trax</div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Services Section -->
    <section id="services" class="py-24 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-20">
                <div class="inline-flex items-center px-4 py-2 bg-green-50 text-green-700 rounded-full text-sm font-semibold mb-6 border border-green-200">
                    Our Services
                </div>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">Complete Courier Solutions</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    From same-day delivery to international shipping, we provide comprehensive logistics solutions tailored to your needs.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="group bg-white rounded-2xl p-8 border border-gray-100 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 text-center">Same Day Delivery</h3>
                    <p class="text-gray-600 text-center leading-relaxed mb-4">Ultra-fast delivery service for urgent packages. Get your items delivered within hours across major cities in Pakistan.</p>
                    <div class="text-center">
                        <span class="text-sm text-green-600 font-semibold bg-green-50 px-3 py-1 rounded-full">From Rs. 300</span>
                    </div>
                </div>
                
                <div class="group bg-white rounded-2xl p-8 border border-gray-100 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 text-center">Express Shipping</h3>
                    <p class="text-gray-600 text-center leading-relaxed mb-4">Fast delivery with next-day guarantee. Perfect balance of speed and affordability for regular shipments.</p>
                    <div class="text-center">
                        <span class="text-sm text-green-600 font-semibold bg-green-50 px-3 py-1 rounded-full">From Rs. 150</span>
                    </div>
                </div>
                
                <div class="group bg-white rounded-2xl p-8 border border-gray-100 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 text-center">International Shipping</h3>
                    <p class="text-gray-600 text-center leading-relaxed mb-4">Global shipping solutions connecting Pakistan with the world. Secure international delivery with full tracking.</p>
                    <div class="text-center">
                        <span class="text-sm text-green-600 font-semibold bg-green-50 px-3 py-1 rounded-full">From Rs. 2500</span>
                    </div>
                </div>
                
                <div class="group bg-white rounded-2xl p-8 border border-gray-100 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 text-center">Bulk Orders</h3>
                    <p class="text-gray-600 text-center leading-relaxed mb-4">Enterprise solutions for businesses with high-volume shipping needs. Customized pricing and dedicated support.</p>
                    <div class="text-center">
                        <span class="text-sm text-green-600 font-semibold bg-green-50 px-3 py-1 rounded-full">Custom Pricing</span>
                    </div>
                </div>
            </div>
        </div>
    </section>    
<!-- 4. How It Works Section -->
    <section id="how-it-works" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-20">
                <div class="inline-flex items-center px-4 py-2 bg-green-50 text-green-700 rounded-full text-sm font-semibold mb-6 border border-green-200">
                    How It Works
                </div>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">Simple and Fast Process</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Send your packages in just three easy steps. Our streamlined process ensures quick booking, secure payment, and reliable delivery.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="text-center relative">
                    <div class="w-24 h-24 gradient-bg rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-lg">
                        <span class="text-3xl font-bold text-white">1</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Search & Compare</h3>
                    <p class="text-gray-600 leading-relaxed">Browse courier companies, compare services and prices, and choose the best option that fits your delivery requirements and budget.</p>
                    
                    <div class="hidden md:block absolute top-12 left-full w-12 h-0.5 bg-gradient-to-r from-green-300 to-transparent"></div>
                </div>
                
                <div class="text-center relative">
                    <div class="w-24 h-24 gradient-bg rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-lg">
                        <span class="text-3xl font-bold text-white">2</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Book & Pay</h3>
                    <p class="text-gray-600 leading-relaxed">Select your preferred courier, provide delivery details, and make secure payment through multiple convenient payment methods.</p>
                    
                    <div class="hidden md:block absolute top-12 left-full w-12 h-0.5 bg-gradient-to-r from-green-300 to-transparent"></div>
                </div>
                
                <div class="text-center">
                    <div class="w-24 h-24 gradient-bg rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-lg">
                        <span class="text-3xl font-bold text-white">3</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Track & Receive</h3>
                    <p class="text-gray-600 leading-relaxed">Track your package in real-time and receive notifications until successful delivery. Full transparency throughout the process.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Features Section -->
    <section id="features" class="py-24 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-20">
                <div class="inline-flex items-center px-4 py-2 bg-green-50 text-green-700 rounded-full text-sm font-semibold mb-6 border border-green-200">
                    Features
                </div>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">Why Choose Daak Khana?</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Advanced technology meets exceptional service. Experience the perfect blend of innovation, reliability, and customer-focused solutions.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-green-100 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Verified Couriers</h3>
                    <p class="text-gray-600 leading-relaxed">All courier companies undergo thorough verification and quality checks before joining our platform. Only trusted, reliable partners serve our customers.</p>
                </div>
                
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Real-Time Tracking</h3>
                    <p class="text-gray-600 leading-relaxed">Track your packages in real-time with live updates. Know exactly where your shipment is at every step of the delivery journey.</p>
                </div>
                
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-purple-100 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Secure Payments</h3>
                    <p class="text-gray-600 leading-relaxed">Multiple secure payment options including JazzCash, EasyPaisa, bank transfers, and credit/debit cards. Your financial information is always protected.</p>
                </div>
                
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-yellow-100 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Rating System</h3>
                    <p class="text-gray-600 leading-relaxed">Choose the best couriers based on customer reviews and ratings. Transparent feedback system ensures quality service delivery.</p>
                </div>
                
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-indigo-100 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 100 19.5 9.75 9.75 0 000-19.5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">24/7 Support</h3>
                    <p class="text-gray-600 leading-relaxed">Round-the-clock customer support team ready to assist you. Get help whenever you need it through multiple communication channels.</p>
                </div>
                
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-red-100 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Insurance Coverage</h3>
                    <p class="text-gray-600 leading-relaxed">Complete insurance coverage for your valuable packages. Peace of mind with comprehensive protection against loss or damage.</p>
                </div>
            </div>
        </div>
    </section>    <!-- 6
. Statistics Section -->
    <section class="py-24 gradient-bg text-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold mb-6">Our Impact in Numbers</h2>
                <p class="text-xl text-green-100 max-w-3xl mx-auto">
                    Thousands of satisfied customers across Pakistan trust us with their delivery needs. Join our growing community.
                </p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-5xl font-bold mb-2">500+</div>
                    <div class="text-green-100 font-medium">Verified Couriers</div>
                    <div class="text-sm text-green-200 mt-1">Across Pakistan</div>
                </div>
                <div class="text-center">
                    <div class="text-5xl font-bold mb-2">50K+</div>
                    <div class="text-green-100 font-medium">Successful Deliveries</div>
                    <div class="text-sm text-green-200 mt-1">And counting</div>
                </div>
                <div class="text-center">
                    <div class="text-5xl font-bold mb-2">25K+</div>
                    <div class="text-green-100 font-medium">Happy Customers</div>
                    <div class="text-sm text-green-200 mt-1">Nationwide</div>
                </div>
                <div class="text-center">
                    <div class="text-5xl font-bold mb-2">98%</div>
                    <div class="text-green-100 font-medium">On-Time Delivery</div>
                    <div class="text-sm text-green-200 mt-1">Success rate</div>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. Pricing Section -->
    <section id="pricing" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-20">
                <div class="inline-flex items-center px-4 py-2 bg-green-50 text-green-700 rounded-full text-sm font-semibold mb-6 border border-green-200">
                    Pricing
                </div>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">Transparent and Competitive Pricing</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    No hidden fees, no surprises. Just clear, competitive pricing that fits your budget and delivery requirements.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 border-2 border-gray-200 hover:border-green-300 transition-all duration-300 hover:shadow-lg">
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Standard</h3>
                        <div class="text-4xl font-bold text-gray-900 mb-2">Rs. 150</div>
                        <div class="text-gray-500">per package</div>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            2-3 days delivery
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Basic tracking
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Up to 5kg weight
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Email notifications
                        </li>
                    </ul>
                    <button class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-xl font-semibold transition-colors">
                        Choose Standard
                    </button>
                </div>
                
                <div class="gradient-bg rounded-2xl p-8 text-white relative transform scale-105 shadow-xl">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <span class="bg-yellow-400 text-yellow-900 px-4 py-1 rounded-full text-sm font-semibold">Most Popular</span>
                    </div>
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold mb-2">Express</h3>
                        <div class="text-4xl font-bold mb-2">Rs. 300</div>
                        <div class="text-green-100">per package</div>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Next day delivery
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Real-time tracking
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Up to 10kg weight
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            SMS notifications
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Priority support
                        </li>
                    </ul>
                    <button class="w-full bg-white text-green-600 py-3 rounded-xl font-semibold hover:bg-green-50 transition-colors">
                        Choose Express
                    </button>
                </div>
                
                <div class="bg-white rounded-2xl p-8 border-2 border-gray-200 hover:border-green-300 transition-all duration-300 hover:shadow-lg">
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Same Day</h3>
                        <div class="text-4xl font-bold text-gray-900 mb-2">Rs. 500</div>
                        <div class="text-gray-500">per package</div>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Same day delivery
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Live tracking
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Up to 15kg weight
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Instant notifications
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Dedicated support
                        </li>
                    </ul>
                    <button class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-xl font-semibold transition-colors">
                        Choose Same Day
                    </button>
                </div>
            </div>
        </div>
    </section>    <!-- 
8. Testimonials Section -->
    <section class="py-24 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-20">
                <div class="inline-flex items-center px-4 py-2 bg-green-50 text-green-700 rounded-full text-sm font-semibold mb-6 border border-green-200">
                    Customer Reviews
                </div>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">What Our Customers Say</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Thousands of satisfied customers across Pakistan trust us with their delivery needs. Read their success stories.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                            A
                        </div>
                        <div class="ml-4">
                            <div class="font-semibold text-gray-900">Ahmad Ali</div>
                            <div class="text-sm text-gray-500">Business Owner</div>
                        </div>
                    </div>
                    <div class="flex text-yellow-400 mb-4">
                        ★★★★★
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        "Daak Khana has revolutionized my business operations. I can easily compare different courier companies and get the best prices for delivery. The platform is incredibly user-friendly and reliable."
                    </p>
                </div>
                
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-pink-600 rounded-full flex items-center justify-center text-white font-bold">
                            F
                        </div>
                        <div class="ml-4">
                            <div class="font-semibold text-gray-900">Fatima Khan</div>
                            <div class="text-sm text-gray-500">Online Seller</div>
                        </div>
                    </div>
                    <div class="flex text-yellow-400 mb-4">
                        ★★★★★
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        "The best platform for courier services! Real-time tracking and secure payment options have increased my customers' confidence. Thank you Daak Khana for making logistics so simple."
                    </p>
                </div>
                
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center text-white font-bold">
                            M
                        </div>
                        <div class="ml-4">
                            <div class="font-semibold text-gray-900">Muhammad Hassan</div>
                            <div class="text-sm text-gray-500">E-commerce</div>
                        </div>
                    </div>
                    <div class="flex text-yellow-400 mb-4">
                        ★★★★★
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        "Previously I had to contact multiple courier companies separately. Now with Daak Khana, everything is available in one place. Absolutely fantastic service and support!"
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 9. Coverage Map Section -->
    <section id="companies" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-20">
                <div class="inline-flex items-center px-4 py-2 bg-green-50 text-green-700 rounded-full text-sm font-semibold mb-6 border border-green-200">
                    Coverage Area
                </div>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">Nationwide Coverage Across Pakistan</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    From Karachi to Kashmir - our services reach every major city and town across Pakistan. Comprehensive logistics network at your service.
                </p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                <div class="text-center p-6 bg-green-50 rounded-xl border border-green-100 hover:bg-green-100 transition-colors">
                    <div class="text-2xl font-bold text-green-600 mb-2">Karachi</div>
                    <div class="text-sm text-gray-600">Sindh</div>
                </div>
                <div class="text-center p-6 bg-green-50 rounded-xl border border-green-100 hover:bg-green-100 transition-colors">
                    <div class="text-2xl font-bold text-green-600 mb-2">Lahore</div>
                    <div class="text-sm text-gray-600">Punjab</div>
                </div>
                <div class="text-center p-6 bg-green-50 rounded-xl border border-green-100 hover:bg-green-100 transition-colors">
                    <div class="text-2xl font-bold text-green-600 mb-2">Islamabad</div>
                    <div class="text-sm text-gray-600">Federal Capital</div>
                </div>
                <div class="text-center p-6 bg-green-50 rounded-xl border border-green-100 hover:bg-green-100 transition-colors">
                    <div class="text-2xl font-bold text-green-600 mb-2">Rawalpindi</div>
                    <div class="text-sm text-gray-600">Punjab</div>
                </div>
                <div class="text-center p-6 bg-green-50 rounded-xl border border-green-100 hover:bg-green-100 transition-colors">
                    <div class="text-2xl font-bold text-green-600 mb-2">Faisalabad</div>
                    <div class="text-sm text-gray-600">Punjab</div>
                </div>
                <div class="text-center p-6 bg-green-50 rounded-xl border border-green-100 hover:bg-green-100 transition-colors">
                    <div class="text-2xl font-bold text-green-600 mb-2">Multan</div>
                    <div class="text-sm text-gray-600">Punjab</div>
                </div>
                <div class="text-center p-6 bg-green-50 rounded-xl border border-green-100 hover:bg-green-100 transition-colors">
                    <div class="text-2xl font-bold text-green-600 mb-2">Hyderabad</div>
                    <div class="text-sm text-gray-600">Sindh</div>
                </div>
                <div class="text-center p-6 bg-green-50 rounded-xl border border-green-100 hover:bg-green-100 transition-colors">
                    <div class="text-2xl font-bold text-green-600 mb-2">Gujranwala</div>
                    <div class="text-sm text-gray-600">Punjab</div>
                </div>
                <div class="text-center p-6 bg-green-50 rounded-xl border border-green-100 hover:bg-green-100 transition-colors">
                    <div class="text-2xl font-bold text-green-600 mb-2">Peshawar</div>
                    <div class="text-sm text-gray-600">KPK</div>
                </div>
                <div class="text-center p-6 bg-green-50 rounded-xl border border-green-100 hover:bg-green-100 transition-colors">
                    <div class="text-2xl font-bold text-green-600 mb-2">Quetta</div>
                    <div class="text-sm text-gray-600">Balochistan</div>
                </div>
                <div class="text-center p-6 bg-green-50 rounded-xl border border-green-100 hover:bg-green-100 transition-colors">
                    <div class="text-2xl font-bold text-green-600 mb-2">Sialkot</div>
                    <div class="text-sm text-gray-600">Punjab</div>
                </div>
                <div class="text-center p-6 bg-green-50 rounded-xl border border-green-100 hover:bg-green-100 transition-colors">
                    <div class="text-2xl font-bold text-green-600 mb-2">+50</div>
                    <div class="text-sm text-gray-600">More Cities</div>
                </div>
            </div>
        </div>
    </section>

    <!-- 10. Mobile App Section -->
    <section class="py-24 gradient-bg text-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <div class="inline-flex items-center px-4 py-2 bg-white/20 text-white rounded-full text-sm font-semibold mb-6">
                        Mobile App
                    </div>
                    <h2 class="text-4xl lg:text-5xl font-bold mb-6">Book Couriers from Your Phone</h2>
                    <p class="text-xl text-green-100 mb-8 leading-relaxed">
                        Download the Daak Khana mobile app and track, book, and manage your packages anywhere, anytime. Complete logistics solution in your pocket.
                    </p>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-lg">Easy and fast booking</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-lg">Real-time notifications</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-lg">Offline tracking capability</span>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#" class="flex items-center bg-black text-white px-6 py-3 rounded-xl hover:bg-gray-800 transition-colors">
                            <svg class="w-8 h-8 mr-3" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09l.01-.01zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
                            </svg>
                            <div>
                                <div class="text-xs">Download on the</div>
                                <div class="text-lg font-semibold">App Store</div>
                            </div>
                        </a>
                        <a href="#" class="flex items-center bg-black text-white px-6 py-3 rounded-xl hover:bg-gray-800 transition-colors">
                            <svg class="w-8 h-8 mr-3" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M3,20.5V3.5C3,2.91 3.34,2.39 3.84,2.15L13.69,12L3.84,21.85C3.34,21.6 3,21.09 3,20.5M16.81,15.12L6.05,21.34L14.54,12.85L16.81,15.12M20.16,10.81C20.5,11.08 20.75,11.5 20.75,12C20.75,12.5 20.53,12.9 20.18,13.18L17.89,14.5L15.39,12L17.89,9.5L20.16,10.81M6.05,2.66L16.81,8.88L14.54,11.15L6.05,2.66Z"/>
                            </svg>
                            <div>
                                <div class="text-xs">Get it on</div>
                                <div class="text-lg font-semibold">Google Play</div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="bg-white/10 rounded-3xl p-8 backdrop-blur-sm floating-animation">
                        <div class="bg-white rounded-2xl p-6 shadow-2xl">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <img src="{{ asset('favicon.svg') }}" alt="Daak Khana" class="w-8 h-8 rounded-lg mr-3">
                                    <span class="font-bold text-gray-900">Daak Khana</span>
                                </div>
                                <div class="text-xs text-gray-500">9:41 AM</div>
                            </div>
                            <div class="space-y-3">
                                <div class="bg-green-50 p-3 rounded-lg">
                                    <div class="text-sm font-semibold text-gray-900">Your package has been shipped</div>
                                    <div class="text-xs text-gray-600">Tracking: DK123456789</div>
                                </div>
                                <div class="bg-blue-50 p-3 rounded-lg">
                                    <div class="text-sm font-semibold text-gray-900">Package out for delivery</div>
                                    <div class="text-xs text-gray-600">Expected delivery: Today 3:00 PM</div>
                                </div>
                                <div class="bg-yellow-50 p-3 rounded-lg">
                                    <div class="text-sm font-semibold text-gray-900">Delivery completed</div>
                                    <div class="text-xs text-gray-600">Your package has been delivered</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>    <!-- 
11. FAQ Section -->
    <section class="py-24 bg-white">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-20">
                <div class="inline-flex items-center px-4 py-2 bg-green-50 text-green-700 rounded-full text-sm font-semibold mb-6 border border-green-200">
                    Frequently Asked Questions
                </div>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">Common Questions Answered</h2>
                <p class="text-xl text-gray-600">
                    Find answers to the most frequently asked questions about our services and platform.
                </p>
            </div>
            
            <div class="space-y-6">
                <div class="bg-white border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition-all duration-300">
                    <div class="flex justify-between items-center cursor-pointer" onclick="toggleFAQ(1)">
                        <h3 class="text-lg font-semibold text-gray-900">What is Daak Khana?</h3>
                        <svg class="w-6 h-6 text-gray-400 transform transition-transform" id="faq-icon-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="hidden mt-4 text-gray-600 leading-relaxed" id="faq-content-1">
                        Daak Khana is Pakistan's first online courier marketplace that allows you to compare different courier companies' services and book delivery at the best prices from a single professional platform.
                    </div>
                </div>
                
                <div class="bg-white border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition-all duration-300">
                    <div class="flex justify-between items-center cursor-pointer" onclick="toggleFAQ(2)">
                        <h3 class="text-lg font-semibold text-gray-900">Is it safe and secure?</h3>
                        <svg class="w-6 h-6 text-gray-400 transform transition-transform" id="faq-icon-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="hidden mt-4 text-gray-600 leading-relaxed" id="faq-content-2">
                        Yes, we only work with verified and trusted courier companies. All payments are secure and complete insurance coverage is provided for your packages.
                    </div>
                </div>
                
                <div class="bg-white border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition-all duration-300">
                    <div class="flex justify-between items-center cursor-pointer" onclick="toggleFAQ(3)">
                        <h3 class="text-lg font-semibold text-gray-900">How long does delivery take?</h3>
                        <svg class="w-6 h-6 text-gray-400 transform transition-transform" id="faq-icon-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="hidden mt-4 text-gray-600 leading-relaxed" id="faq-content-3">
                        It depends on your selected service. Same Day Delivery delivers the same day, Express delivers in 1-2 days, and Standard delivers in 2-3 days.
                    </div>
                </div>
                
                <div class="bg-white border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition-all duration-300">
                    <div class="flex justify-between items-center cursor-pointer" onclick="toggleFAQ(4)">
                        <h3 class="text-lg font-semibold text-gray-900">Can I track my package?</h3>
                        <svg class="w-6 h-6 text-gray-400 transform transition-transform" id="faq-icon-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="hidden mt-4 text-gray-600 leading-relaxed" id="faq-content-4">
                        Yes, you can track your package in real-time. You will receive continuous updates via SMS and app notifications throughout the delivery process.
                    </div>
                </div>
                
                <div class="bg-white border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition-all duration-300">
                    <div class="flex justify-between items-center cursor-pointer" onclick="toggleFAQ(5)">
                        <h3 class="text-lg font-semibold text-gray-900">What are the payment methods?</h3>
                        <svg class="w-6 h-6 text-gray-400 transform transition-transform" id="faq-icon-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="hidden mt-4 text-gray-600 leading-relaxed" id="faq-content-5">
                        You can pay through JazzCash, EasyPaisa, bank transfer, credit/debit cards, and Cash on Delivery options.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 12. Newsletter Section -->
    <section class="py-24 gradient-bg text-white">
        <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center">
            <div class="mb-8">
                <h2 class="text-4xl lg:text-5xl font-bold mb-6">Stay Updated</h2>
                <p class="text-xl text-green-100 max-w-2xl mx-auto">
                    Subscribe to our newsletter for new services, special offers, and important updates about Pakistan's courier industry.
                </p>
            </div>
            
            <div class="max-w-md mx-auto">
                <div class="flex flex-col sm:flex-row gap-4">
                    <input type="email" placeholder="Enter your email address" class="flex-1 px-6 py-4 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-4 focus:ring-white/20">
                    <button class="bg-white text-green-600 px-8 py-4 rounded-xl font-semibold hover:bg-green-50 transition-colors">
                        Subscribe
                    </button>
                </div>
                <p class="text-sm text-green-100 mt-4">
                    We respect your privacy and never share your information with third parties.
                </p>
            </div>
        </div>
    </section>

    <!-- 13. Contact & Footer Section -->
    <section id="contact" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-20">
                <div class="inline-flex items-center px-4 py-2 bg-green-50 text-green-700 rounded-full text-sm font-semibold mb-6 border border-green-200">
                    Contact Us
                </div>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">Get in Touch</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Have questions or need assistance? Our dedicated support team is always ready to help you with your courier and logistics needs.
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="bg-gray-50 rounded-2xl p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Send us a Message</h3>
                        <form class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                    <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                    <input type="email" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="tel" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                                <textarea rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"></textarea>
                            </div>
                            <button type="submit" class="w-full gradient-bg text-white py-4 rounded-xl font-semibold hover:opacity-90 transition-all duration-300 shadow-lg hover:shadow-xl">
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="space-y-8">
                    <div class="bg-white border border-gray-200 rounded-2xl p-6">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Phone</h3>
                        <p class="text-gray-600">+92-300-0000000</p>
                        <p class="text-sm text-gray-500 mt-1">Available 24/7</p>
                    </div>
                    
                    <div class="bg-white border border-gray-200 rounded-2xl p-6">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 7.89a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Email</h3>
                        <p class="text-gray-600">support@daakkhana.com</p>
                        <p class="text-sm text-gray-500 mt-1">Response within 24 hours</p>
                    </div>
                    
                    <div class="bg-white border border-gray-200 rounded-2xl p-6">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Office</h3>
                        <p class="text-gray-600">Karachi, Pakistan</p>
                        <p class="text-sm text-gray-500 mt-1">9 AM to 6 PM</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <div class="flex items-center mb-6">
                        <img src="{{ asset('favicon.svg') }}" alt="Daak Khana Logo" class="w-10 h-10 rounded-lg mr-3">
                        <span class="text-2xl font-bold">Daak Khana</span>
                    </div>
                    <p class="text-gray-400 leading-relaxed mb-6">
                        Pakistan's first and most trusted courier marketplace. We provide you with the best delivery solutions through verified courier partners.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-green-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-green-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-green-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146 1.124.347 2.317.544 3.571.544 6.624 0 11.99-5.367 11.99-11.988C24.5 5.896 19.354.75 12.5.75z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-6">Services</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Same Day Delivery</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Express Shipping</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">International</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Bulk Orders</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Package Insurance</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-6">Company</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Careers</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Press</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Partners</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-6">Support</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Complaints</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Tracking</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">API</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-gray-400 text-sm mb-4 md:mb-0">
                        © 2025 Daak Khana. All rights reserved.
                    </div>
                    <div class="flex space-x-6 text-sm">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Privacy Policy</a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Terms of Service</a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function toggleFAQ(id) {
            const content = document.getElementById(`faq-content-${id}`);
            const icon = document.getElementById(`faq-icon-${id}`);
            
            content.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in-up');
                }
            });
        }, observerOptions);

        document.querySelectorAll('section').forEach(section => {
            observer.observe(section);
        });
    </script>
</body>
</html>