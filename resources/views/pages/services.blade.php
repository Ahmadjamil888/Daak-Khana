<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>خدمات - Daak Khana | Pakistan's Premier Courier Services</title>
    <meta name="description" content="Explore comprehensive courier services across Pakistan. Same-day delivery, express shipping, international courier, and bulk logistics solutions.">
    <meta name="keywords" content="courier services Pakistan, same day delivery, express shipping, international courier, logistics Pakistan">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white">
    <!-- Navigation -->
    <nav class="bg-white border-b border-neutral-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('welcome') }}" class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 7.89a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <span class="ml-3 text-xl font-bold text-neutral-900">Daak Khana</span>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('welcome') }}" class="text-neutral-600 hover:text-primary-600 px-3 py-2 text-sm font-medium">Home</a>
                    <a href="{{ route('companies.index') }}" class="text-neutral-600 hover:text-primary-600 px-3 py-2 text-sm font-medium">Companies</a>
                    <a href="{{ route('login') }}" class="bg-primary-500 hover:bg-primary-600 text-white px-4 py-2 rounded-lg text-sm font-medium">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary-50 to-white py-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <h1 class="text-4xl lg:text-6xl font-bold text-neutral-900 mb-6">
                ہماری <span class="text-primary-600">خدمات</span>
            </h1>
            <p class="text-xl text-neutral-600 max-w-3xl mx-auto">
                پاکستان بھر میں مختلف قسم کی کوریئر سروسز۔ تیز، محفوظ اور قابل اعتماد ڈیلیوری کے لیے ہمارے ساتھ جڑیں۔
            </p>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Same Day Delivery -->
                <div class="bg-white rounded-2xl p-8 border border-neutral-100 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-neutral-900 mb-4 text-center">Same Day Delivery</h3>
                    <p class="text-neutral-600 text-center mb-6">اسی دن ڈیلیوری کی سہولت۔ فوری اور اہم پیکجز کے لیے مخصوص سروس۔</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center text-sm text-neutral-600">
                            <svg class="w-4 h-4 text-primary-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            2-6 گھنٹے میں ڈیلیوری
                        </li>
                        <li class="flex items-center text-sm text-neutral-600">
                            <svg class="w-4 h-4 text-primary-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            لائیو ٹریکنگ
                        </li>
                        <li class="flex items-center text-sm text-neutral-600">
                            <svg class="w-4 h-4 text-primary-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            محفوظ ہینڈلنگ
                        </li>
                    </ul>
                    <div class="text-center">
                        <span class="text-2xl font-bold text-primary-600">Rs. 300</span>
                        <span class="text-neutral-500"> سے شروع</span>
                    </div>
                </div>

                <!-- Express Delivery -->
                <div class="bg-white rounded-2xl p-8 border border-neutral-100 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-neutral-900 mb-4 text-center">Express Delivery</h3>
                    <p class="text-neutral-600 text-center mb-6">تیز رفتار ڈیلیوری سروس۔ پاکستان بھر میں اگلے دن ڈیلیوری کی ضمانت۔</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center text-sm text-neutral-600">
                            <svg class="w-4 h-4 text-primary-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            24-48 گھنٹے ڈیلیوری
                        </li>
                        <li class="flex items-center text-sm text-neutral-600">
                            <svg class="w-4 h-4 text-primary-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            تمام بڑے شہروں میں
                        </li>
                        <li class="flex items-center text-sm text-neutral-600">
                            <svg class="w-4 h-4 text-primary-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            انشورنس کوریج
                        </li>
                    </ul>
                    <div class="text-center">
                        <span class="text-2xl font-bold text-primary-600">Rs. 150</span>
                        <span class="text-neutral-500"> سے شروع</span>
                    </div>
                </div>

                <!-- Standard Delivery -->
                <div class="bg-white rounded-2xl p-8 border border-neutral-100 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-neutral-900 mb-4 text-center">Standard Delivery</h3>
                    <p class="text-neutral-600 text-center mb-6">معیاری ڈیلیوری سروس۔ کم قیمت میں قابل اعتماد اور محفوظ ڈیلیوری۔</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center text-sm text-neutral-600">
                            <svg class="w-4 h-4 text-primary-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            3-5 دن ڈیلیوری
                        </li>
                        <li class="flex items-center text-sm text-neutral-600">
                            <svg class="w-4 h-4 text-primary-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            اقتصادی قیمت
                        </li>
                        <li class="flex items-center text-sm text-neutral-600">
                            <svg class="w-4 h-4 text-primary-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            پاکستان بھر میں
                        </li>
                    </ul>
                    <div class="text-center">
                        <span class="text-2xl font-bold text-primary-600">Rs. 80</span>
                        <span class="text-neutral-500"> سے شروع</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-primary-500 to-primary-600">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold text-white mb-6">آج ہی شروع کریں</h2>
            <p class="text-xl text-primary-100 mb-8">پاکستان کی بہترین کوریئر سروس کا تجربہ کریں</p>
            <a href="{{ route('register') }}" class="bg-white hover:bg-neutral-50 text-primary-600 px-8 py-4 rounded-2xl text-lg font-semibold transition-all duration-300 shadow-lg hover:shadow-xl">
                مفت اکاؤنٹ بنائیں
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-neutral-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <div class="flex items-center justify-center mb-6">
                <div class="w-10 h-10 bg-primary-500 rounded-xl flex items-center justify-center mr-3">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 7.89a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <span class="text-2xl font-bold">Daak Khana</span>
            </div>
            <p class="text-neutral-400 mb-4">پاکستان کا پہلا پروفیشنل کوریئر پلیٹ فارم</p>
            <p class="text-neutral-500 text-sm">© 2024 Daak Khana. تمام حقوق محفوظ ہیں۔</p>
        </div>
    </footer>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('registerDropdown');
            dropdown.classList.toggle('hidden');
        }
    </script>
</body>
</html>