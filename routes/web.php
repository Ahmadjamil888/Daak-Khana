<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboard;
use App\Http\Controllers\Courier\DashboardController as CourierDashboard;
use App\Http\Controllers\CourierCompanyController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Static Pages
Route::get('/services', [App\Http\Controllers\PageController::class, 'services'])->name('pages.services');
Route::get('/about', [App\Http\Controllers\PageController::class, 'about'])->name('pages.about');
Route::get('/pricing', [App\Http\Controllers\PageController::class, 'pricing'])->name('pages.pricing');
Route::get('/contact', [App\Http\Controllers\PageController::class, 'contact'])->name('pages.contact');
Route::get('/how-it-works', [App\Http\Controllers\PageController::class, 'howItWorks'])->name('pages.how-it-works');
Route::get('/features', [App\Http\Controllers\PageController::class, 'features'])->name('pages.features');

// Customer Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [CustomerDashboard::class, 'index'])->name('dashboard');
    
    // Customer specific routes
    Route::prefix('customer')->name('customer.')->group(function () {
        Route::get('/companies', [CourierCompanyController::class, 'index'])->name('companies.index');
        Route::get('/companies/{company}', [CourierCompanyController::class, 'show'])->name('companies.show');
        Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
        Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
        Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
        Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    });
});

// Courier Routes
Route::middleware(['auth', 'verified'])->prefix('courier')->name('courier.')->group(function () {
    Route::get('/dashboard', [CourierDashboard::class, 'index'])->name('dashboard');
    
    // Company management (no restrictions)
    Route::get('/company/create', [CourierCompanyController::class, 'create'])->name('company.create');
    Route::post('/company', [CourierCompanyController::class, 'store'])->name('company.store');
    Route::get('/company/profile', [CourierCompanyController::class, 'profile'])->name('company.profile');
    Route::get('/company/edit', [CourierCompanyController::class, 'edit'])->name('company.edit');
    Route::patch('/company/profile', [CourierCompanyController::class, 'update'])->name('company.update');
    
    // Commission Management (requires courier company)
    Route::middleware(['courier.company'])->group(function () {
        Route::get('/commissions', [\App\Http\Controllers\CommissionPaymentController::class, 'index'])->name('commissions.index');
        Route::get('/commissions/{commission}', [\App\Http\Controllers\CommissionPaymentController::class, 'show'])->name('commissions.show');
        Route::post('/commissions/payment-intent', [\App\Http\Controllers\CommissionPaymentController::class, 'createPaymentIntent'])->name('commissions.payment-intent');
        Route::post('/commissions/confirm-payment', [\App\Http\Controllers\CommissionPaymentController::class, 'confirmPayment'])->name('commissions.confirm-payment');
        Route::get('/commissions/payment-form', [\App\Http\Controllers\CommissionPaymentController::class, 'paymentForm'])->name('commissions.payment-form');
        Route::get('/commissions/pay-all', [\App\Http\Controllers\CommissionPaymentController::class, 'payAll'])->name('commissions.pay-all');
    });
    
    // Services management (requires courier company and commission check)
    Route::middleware(['courier.company', 'commission.check'])->group(function () {
        Route::resource('services', \App\Http\Controllers\Courier\CourierServiceController::class);
        Route::patch('/services/{service}/toggle', [\App\Http\Controllers\Courier\CourierServiceController::class, 'toggle'])->name('services.toggle');
    });
    
    // Bookings management (requires courier company and commission check)
    Route::middleware(['courier.company', 'commission.check'])->group(function () {
        Route::get('/bookings', function() { 
            $company = auth()->user()->courierCompany;
            $bookings = $company ? $company->bookings()->with(['customer', 'courierService'])->latest()->paginate(15) : collect();
            return view('courier.bookings.index', compact('bookings')); 
        })->name('bookings');
        Route::patch('/bookings/{booking}/update-status', [BookingController::class, 'updateStatus'])->name('bookings.update-status');
    });
});

// Public routes (accessible without auth)
Route::get('/companies', [CourierCompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/{company}', [CourierCompanyController::class, 'show'])->name('companies.show');

// Static pages
Route::get('/services', function () { return view('pages.services'); })->name('pages.services');
Route::get('/about', function () { return view('pages.about'); })->name('pages.about');
Route::get('/pricing', function () { return view('pages.pricing'); })->name('pages.pricing');
Route::get('/contact', function () { return view('pages.contact'); })->name('pages.contact');
Route::get('/how-it-works', function () { return view('pages.how-it-works'); })->name('pages.how-it-works');

// Shared authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Booking routes (accessible to both user types)
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
});

// Subscription Routes
Route::middleware('auth')->group(function () {
    Route::get('/subscriptions', [App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::get('/subscriptions/create', [App\Http\Controllers\SubscriptionController::class, 'create'])->name('subscriptions.create');
    Route::post('/subscriptions', [App\Http\Controllers\SubscriptionController::class, 'store'])->name('subscriptions.store');
    Route::get('/subscriptions/success', [App\Http\Controllers\SubscriptionController::class, 'success'])->name('subscriptions.success');
    Route::patch('/subscriptions/{subscription}/cancel', [App\Http\Controllers\SubscriptionController::class, 'cancel'])->name('subscriptions.cancel');
});

// Messaging Routes (Free for all users)
Route::middleware('auth')->group(function () {
    Route::get('/bookings/{booking}/messages', [App\Http\Controllers\MessageController::class, 'index'])->name('messages.index');
    Route::post('/bookings/{booking}/messages', [App\Http\Controllers\MessageController::class, 'store'])->name('messages.store');
    Route::get('/bookings/{booking}/messages/api', [App\Http\Controllers\MessageController::class, 'getMessages'])->name('messages.api');
    Route::patch('/messages/{message}/read', [App\Http\Controllers\MessageController::class, 'markAsRead'])->name('messages.read');
});

// Real-time Location Routes (Pro users only)
Route::middleware('auth')->group(function () {
    Route::post('/bookings/{booking}/location', [App\Http\Controllers\RealTimeLocationController::class, 'store'])->name('location.store');
    Route::get('/bookings/{booking}/location', [App\Http\Controllers\RealTimeLocationController::class, 'getLocation'])->name('location.get');
    Route::get('/bookings/{booking}/location/history', [App\Http\Controllers\RealTimeLocationController::class, 'getLocationHistory'])->name('location.history');
    Route::get('/courier/bookings/{booking}/location/update', [App\Http\Controllers\RealTimeLocationController::class, 'updateLocationForm'])->name('courier.location.form');
});

// AI Features Routes
Route::middleware('auth')->group(function () {
    // Free AI features
    Route::post('/ai/chat', [App\Http\Controllers\AIController::class, 'chatWithDaakKhana'])->name('ai.chat');
    Route::post('/ai/search', [App\Http\Controllers\AIController::class, 'searchCouriers'])->name('ai.search');
    Route::get('/ai/chat', [App\Http\Controllers\AIController::class, 'showChat'])->name('ai.chat.show');
    Route::get('/ai/search', [App\Http\Controllers\AIController::class, 'showSearch'])->name('ai.search.show');
    
    // Pro AI features (Couriers only)
    Route::post('/ai/generate-profile', [App\Http\Controllers\AIController::class, 'generateProfile'])->name('ai.generate.profile');
    Route::post('/bookings/{booking}/ai/handle', [App\Http\Controllers\AIController::class, 'handleOrder'])->name('ai.handle.order');
});

// Courier Pro Features
Route::middleware(['auth'])->prefix('courier')->name('courier.')->group(function () {
    // Payment routes
    Route::get('/payment-required', function() {
        $user = auth()->user();
        if (!$user->isCourier()) abort(403);
        
        $company = $user->courierCompany;
        $unpaidOrders = $company ? $company->bookings()->where('pro_fee', '>', 0)->whereNull('pro_fee_paid_at')->count() : 0;
        
        return view('courier.payment-required', compact('unpaidOrders'));
    })->name('payment.required');
    
    Route::post('/pay-fees', [App\Http\Controllers\SubscriptionController::class, 'payOrderFees'])->name('pay.fees');
    
    // Pro courier payment for orders
    Route::middleware('courier.pro.check')->group(function () {
        Route::get('/orders', function() {
            $user = auth()->user();
            if (!$user->isCourier()) abort(403);
            
            $company = $user->courierCompany;
            if (!$company) {
                return redirect()->route('courier.company.create');
            }
            
            $bookings = $company->bookings()->with(['customer', 'courierService'])->latest()->paginate(15);
            return view('courier.orders', compact('bookings'));
        })->name('orders');
    });
});

require __DIR__.'/auth.php';
