<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $services = \App\Models\Service::where('is_active', true)->orderBy('order')->limit(6)->get();
    return view('welcome', compact('services'));
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/training-services', function () {
    $services = \App\Models\Service::where('is_active', true)->orderBy('order')->orderBy('created_at', 'desc')->get();
    return view('services', compact('services'));
})->name('services');

Route::get('/training-services/{id}', function ($id) {
    $service = \App\Models\Service::where('is_active', true)->findOrFail($id);
    $relatedServices = \App\Models\Service::where('is_active', true)
        ->where('id', '!=', $id)
        ->orderBy('order')
        ->limit(3)
        ->get();
    return view('service-details', compact('service', 'relatedServices'));
})->name('service.details');

Route::get('/get-certified', function () {
    return view('certified');
})->name('certified');

Route::get('/testimonials', function () {
    return view('testimonials');
})->name('testimonials');

Route::get('/contact-us', function () {
    return view('contact');
})->name('contact');

// Customer Routes
Route::prefix('customer')->name('customer.')->group(function () {
    // Auth Routes (Public)
    Route::get('/login', [App\Http\Controllers\Customer\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Customer\AuthController::class, 'login']);
    Route::get('/register', [App\Http\Controllers\Customer\AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [App\Http\Controllers\Customer\AuthController::class, 'register']);
    Route::post('/logout', [App\Http\Controllers\Customer\AuthController::class, 'logout'])->name('logout');
    
    // Public Routes - View available classes (no login required)
    Route::get('/services/{serviceId}/available-classes', [App\Http\Controllers\Customer\BookingController::class, 'showAvailableClasses'])->name('available-classes');
    
    // Protected Customer Routes
    Route::middleware(['auth:customer'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Customer\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [App\Http\Controllers\Customer\ProfileController::class, 'show'])->name('profile');
        Route::post('/profile', [App\Http\Controllers\Customer\ProfileController::class, 'update'])->name('profile.update');
        
        // Booking Routes
        Route::get('/bookings', [App\Http\Controllers\Customer\BookingController::class, 'index'])->name('bookings');
        Route::get('/bookings/{id}', [App\Http\Controllers\Customer\BookingController::class, 'show'])->name('bookings.show');
        
        // Booking Creation (requires login)
        Route::get('/services/{serviceId}/book', [App\Http\Controllers\Customer\BookingController::class, 'create'])->name('booking.create');
        Route::get('/services/{serviceId}/book/{scheduleId}', [App\Http\Controllers\Customer\BookingController::class, 'create'])->name('booking.create.schedule');
        Route::post('/bookings', [App\Http\Controllers\Customer\BookingController::class, 'store'])->name('booking.store');
        
        // Payment Routes
        Route::get('/bookings/{bookingId}/payment', [App\Http\Controllers\Customer\BookingController::class, 'showPayment'])->name('booking.payment');
        Route::post('/bookings/{bookingId}/payment', [App\Http\Controllers\Customer\BookingController::class, 'processPayment'])->name('booking.payment.process');
    });
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth Routes
    Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
    
    // Protected Admin Routes
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);
        
        // Class Schedules Routes
        Route::resource('class-schedules', App\Http\Controllers\Admin\ClassScheduleController::class);
        
        // Bookings Routes
        Route::get('/bookings', [App\Http\Controllers\Admin\BookingController::class, 'index'])->name('bookings.index');
        Route::get('/bookings/{booking}', [App\Http\Controllers\Admin\BookingController::class, 'show'])->name('bookings.show');
        Route::put('/bookings/{booking}/status', [App\Http\Controllers\Admin\BookingController::class, 'updateStatus'])->name('bookings.update-status');
        
        // Payments Routes
        Route::get('/payments', [App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('payments.index');
        Route::get('/payments/{payment}', [App\Http\Controllers\Admin\PaymentController::class, 'show'])->name('payments.show');
        
        Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
        Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'show'])->name('profile.show');
        Route::post('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    });
});
