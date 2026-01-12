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
        Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    });
});
