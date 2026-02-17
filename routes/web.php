<?php

use App\Http\Controllers\QuickBooksController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Get services (grouped structure: each service can appear in multiple categories)
    $allServices = \App\Models\Service::where('is_active', true)
        ->orderBy('order')
        ->get();
    $servicesByCategory = collect();
    foreach ($allServices as $service) {
        $cats = $service->categories ?? [];
        foreach ($cats as $cat) {
            if (!$servicesByCategory->has($cat)) {
                $servicesByCategory->put($cat, collect());
            }
            $servicesByCategory->get($cat)->push($service);
        }
    }
    
    // Also get services for the "Explore Training Programs" section (limit 6)
    $featuredServices = \App\Models\Service::where('is_active', true)
        ->orderBy('order')
        ->limit(6)
        ->get();
    
    return view('welcome', compact('servicesByCategory', 'featuredServices', 'allServices'));
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/all-services', function () {
    $allServices = \App\Models\Service::where('is_active', true)
        ->orderBy('order')
        ->get();
    
    return view('all-services', compact('allServices'));
})->name('all-services');

Route::get('/training-services', function () {
    $category = request()->query('category');
    $subcategory = request()->query('subcategory');
    
    $query = \App\Models\Service::where('is_active', true);
    
    if ($category) {
        $query->whereJsonContains('categories', $category);
    }
    
    if ($subcategory) {
        $query->where('subcategory', $subcategory);
    }
    
    $services = $query->orderBy('order')->orderBy('created_at', 'desc')->get();
    
    // Get all unique categories from services
    $categories = \App\Models\Service::where('is_active', true)
        ->get()
        ->pluck('categories')
        ->flatten()
        ->filter()
        ->unique()
        ->values();
    
    return view('services', compact('services', 'categories', 'category', 'subcategory'));
})->name('services');

Route::get('/training-services/enhanced-armed-guard-security-subcategories', function () {
    $rifleService = \App\Models\Service::where('is_active', true)->find(34);
    $shotgunService = \App\Models\Service::where('is_active', true)->find(35);
    $services = collect([$rifleService, $shotgunService])->filter();
    return view('enhanced-armed-guard-subcategories', compact('services'));
})->name('handgun.subcategories');

Route::get('/training-services/{id}', function ($id) {
    $service = \App\Models\Service::with('linkedServices')->where('is_active', true)->findOrFail($id);
    $linkedServices = $service->linkedServices->where('is_active', true);
    $relatedServices = $linkedServices->isNotEmpty()
        ? $linkedServices
        : \App\Models\Service::where('is_active', true)->where('id', '!=', $id)->orderBy('order')->limit(3)->get();
    // For booking form: locations and available dates from class schedules
    $bookingLocations = \App\Models\ClassSchedule::where('service_id', $service->id)
        ->where('status', 'scheduled')
        ->where('class_date', '>=', now()->toDateString())
        ->whereRaw('current_students < max_students')
        ->distinct()
        ->orderBy('location')
        ->pluck('location')
        ->map(fn ($loc) => $loc ?: 'No Specific Location')
        ->unique()
        ->values();
    $availableDates = \App\Models\ClassSchedule::where('service_id', $service->id)
        ->where('status', 'scheduled')
        ->where('class_date', '>=', now()->toDateString())
        ->whereRaw('current_students < max_students')
        ->orderBy('class_date')
        ->get()
        ->pluck('class_date')
        ->map(fn ($d) => $d->format('Y-m-d'))
        ->unique()
        ->values()
        ->toArray();
    return view('service-details', compact('service', 'relatedServices', 'linkedServices', 'bookingLocations', 'availableDates'));
})->name('service.details');

Route::post('/training-services/{service}/booking-inquiry', function (\App\Models\Service $service, \Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'nullable|string|max:50',
        'number_of_students' => 'nullable|integer|min:1|max:20',
        'location' => 'nullable|string|max:255',
        'preferred_date' => 'nullable|date|after_or_equal:today',
    ]);
    session()->put('booking_inquiry_' . $service->id, $validated);

    // Create customer account if guest, so they don't need to sign up separately
    $wasNewCustomer = false;
    if (! \Illuminate\Support\Facades\Auth::guard('customer')->check()) {
        $customer = \App\Models\Customer::firstOrCreate(
            ['email' => $validated['email']],
            [
                'name' => $validated['name'],
                'phone' => $validated['phone'] ?? null,
                'password' => \Illuminate\Support\Facades\Hash::make(\Illuminate\Support\Str::random(24)),
            ]
        );
        if ($customer->wasRecentlyCreated) {
            $wasNewCustomer = true;
            \Illuminate\Support\Facades\Auth::guard('customer')->login($customer);
            $request->session()->regenerate();
        } else {
            // Update name/phone for existing customer
            $customer->update([
                'name' => $validated['name'],
                'phone' => $validated['phone'] ?? $customer->phone,
            ]);
        }
    }

    $message = $wasNewCustomer
        ? 'Account created. Review your booking and proceed to payment.'
        : 'Review your booking and complete payment.';

    return redirect()->route('customer.services.checkout', $service->id)
        ->with('success', $message);
})->name('service.booking.inquiry');

Route::get('/get-certified', function () {
    return view('certified');
})->name('certified');

Route::get('/testimonials', function () {
    return view('testimonials');
})->name('testimonials');

Route::get('/contact-us', function () {
    return view('contact');
})->name('contact');

Route::get('/private-protective-services', function () {
    // Get services in the "services" category (Private Protective Services)
    $services = \App\Models\Service::where('is_active', true)
        ->whereJsonContains('categories', 'services')
        ->orderBy('order')
        ->get();
    
    // Get security company links from database
    $companyLinks = \App\Models\SecurityCompanyLink::where('is_active', true)
        ->orderBy('order')
        ->get();
    
    return view('private-protective-services', compact('services', 'companyLinks'));
})->name('private-protective-services');

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

    // Checkout (public – shows summary; login required to complete payment)
    Route::get('/services/{serviceId}/checkout', [App\Http\Controllers\Customer\BookingController::class, 'showCheckout'])->name('services.checkout');

    // Protected Customer Routes
    Route::middleware([\App\Http\Middleware\AuthenticateCustomer::class])->group(function () {
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

        // Checkout – create booking from inquiry and go to payment
        Route::post('/services/{serviceId}/checkout', [App\Http\Controllers\Customer\BookingController::class, 'processCheckout'])->name('services.checkout.process');

        // Payment Routes
        Route::get('/bookings/{bookingId}/payment', [App\Http\Controllers\Customer\BookingController::class, 'showPayment'])->name('booking.payment');
        Route::post('/bookings/{bookingId}/payment', [App\Http\Controllers\Customer\BookingController::class, 'processPayment'])->name('booking.payment.process');
        Route::get('/bookings/{bookingId}/payment/quickbooks-session', [App\Http\Controllers\Customer\BookingController::class, 'getQuickBooksPaymentSession'])->name('booking.payment.quickbooks.session');
        Route::post('/bookings/{bookingId}/payment/quickbooks', [App\Http\Controllers\Customer\BookingController::class, 'processQuickBooksPayment'])->name('booking.payment.quickbooks');
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
        Route::resource('class-schedules', App\Http\Controllers\Admin\ClassScheduleController::class)->names('class-schedules');
        
        // Bookings Routes
        Route::get('/bookings', [App\Http\Controllers\Admin\BookingController::class, 'index'])->name('bookings.index');
        Route::get('/bookings/{booking}', [App\Http\Controllers\Admin\BookingController::class, 'show'])->name('bookings.show');
        Route::put('/bookings/{booking}/status', [App\Http\Controllers\Admin\BookingController::class, 'updateStatus'])->name('bookings.update-status');
        
        // Payments Routes
        Route::get('/payments', [App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('payments.index');
        Route::get('/payments/{payment}', [App\Http\Controllers\Admin\PaymentController::class, 'show'])->name('payments.show');
        Route::post('/payments/{payment}/sync-quickbooks', [App\Http\Controllers\Admin\PaymentController::class, 'syncQuickBooks'])->name('payments.sync-quickbooks');
        Route::post('/payments/{payment}/sync-bank', [App\Http\Controllers\Admin\PaymentController::class, 'syncBank'])->name('payments.sync-bank');
        Route::post('/payments/sync-all-quickbooks', [App\Http\Controllers\Admin\PaymentController::class, 'syncAllQuickBooks'])->name('payments.sync-all-quickbooks');
        Route::post('/payments/sync-all-bank', [App\Http\Controllers\Admin\PaymentController::class, 'syncAllBank'])->name('payments.sync-all-bank');
        
        Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
        
        // Security Company Links
        Route::resource('security-company-links', App\Http\Controllers\Admin\SecurityCompanyLinkController::class);
        
        Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'show'])->name('profile.show');
        Route::post('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    });
});


Route::get('/admin/quickbooks/connect', [QuickBooksController::class, 'connect'])
    ->name('quickbooks.connect');

    Route::get('/admin/quickbooks/callback', [QuickBooksController::class, 'callback'])
    ->name('quickbooks.callback');
