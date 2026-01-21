@extends('layouts.web.master')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
<style>
    .service-hero {
        position: relative;
        height: 500px;
        overflow: hidden;
    }
    
    .service-hero-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .service-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.7) 100%);
    }
    
    .service-hero-content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 3rem;
        z-index: 10;
    }
    
    .detail-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
    }
    
    .detail-card:hover {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }
    
    .detail-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin-bottom: 1rem;
    }
    
    .price-display {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--btn-hover-color) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
    }
    
    .badge-primary {
        background: rgba(58, 166, 44, 0.1);
        color: var(--primary-color);
    }
    
    .badge-success {
        background: rgba(34, 197, 94, 0.1);
        color: #22c55e;
    }
    
    .badge-info {
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }
    
    .info-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem;
        background: #f9fafb;
        border-radius: 10px;
    }
    
    .info-item-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--primary-color);
        color: var(--primary-color);
        flex-shrink: 0;
    }
    
    .btn-booking {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--btn-hover-color) 100%);
        color: white;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        text-transform: uppercase;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(58, 166, 44, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-booking:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(58, 166, 44, 0.4);
    }
    
    .description-content {
        font-size: 1.125rem;
        line-height: 1.8;
        color: #374151;
    }
    
    .description-content h2,
    .description-content h3,
    .description-content h4 {
        color: #1f2937;
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: 700;
    }
    
    .description-content p {
        margin-bottom: 1rem;
    }
    
    .description-content ul,
    .description-content ol {
        margin-left: 1.5rem;
        margin-bottom: 1rem;
    }
    
    .description-content li {
        margin-bottom: 0.5rem;
    }
</style>

<main class="overflow-hidden">
    
    <!-- Service Image Hero -->
    @if($service->image)
    <section class="service-hero">
        <img src="{{ asset('storage/' . $service->image) }}" 
             alt="{{ $service->title }}" 
             class="service-hero-image">
        <div class="service-hero-overlay"></div>
        <div class="service-hero-content">
            <div class="container mx-auto px-4 lg:px-10">
                <h1 class="text-white text-4xl md:text-[32px] font-bold mb-4 uppercase" style="font-family: var(--font-display);">
                    {{ $service->title }}
                </h1>
                @if($service->short_description)
                    <p class="text-white text-lg md:text-xl max-w-3xl opacity-95">
                        {{ $service->short_description }}
                    </p>
                @endif
            </div>
        </div>
    </section>
    @else
    <!-- Fallback Hero Section -->
    <section class="inner-hero">
        <div class="inner-hero-overlay"></div>
        <div class="container mx-auto px-4 lg:px-10 relative z-10">
            <div class="max-w-[1000px] py-8">
                <h2 class="inner-hero-title" data-aos="fade-down" data-aos-duration="1000">
                    {{ strtoupper($service->title) }}
                </h2>
                @if($service->short_description)
                    <p class="inner-hero-subtext" data-aos="fade-up" data-aos-delay="200">
                        {{ $service->short_description }}
                    </p>
                @endif
            </div>
        </div>
    </section>
    @endif

    <!-- Service Details Section -->
    <section class="py-16 lg:py-24 bg-gray-50">
        <div class="container mx-auto px-4 lg:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
                
                <!-- Main Content -->
                <div class="lg:col-span-8 space-y-8">
                    
                    <!-- Service Description -->
                    @if($service->description)
                    <div class="detail-card" data-aos="fade-up">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6 uppercase" style="font-family: var(--font-display);">
                            About This Training
                        </h2>
                        <div class="description-content">
                            {!! $service->description !!}
                        </div>
                    </div>
                    @elseif($service->short_description)
                    <div class="detail-card" data-aos="fade-up">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6 uppercase" style="font-family: var(--font-display);">
                            About This Training
                        </h2>
                        <p class="text-lg text-gray-700 leading-relaxed">
                            {{ $service->short_description }}
                        </p>
                    </div>
                    @endif

                    <!-- Service Details Grid -->
                    <div class="detail-card" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6 uppercase" style="font-family: var(--font-display);">
                            Training Details
                        </h2>
                        <div class="info-grid">
                            @if($service->class_type)
                            <div class="info-item">
                                <div class="info-item-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Class Type</p>
                                    <p class="text-base font-bold text-gray-900">
                                        {{ $service->class_type === 'one-on-one' ? 'One-on-One' : 'Group Classes' }}
                                    </p>
                                </div>
                            </div>
                            @endif
                            
                            @if($service->has_online_parts)
                            <div class="info-item">
                                <div class="info-item-icon">
                                    <i class="fas fa-globe"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Format</p>
                                    <p class="text-base font-bold text-gray-900">Online Components</p>
                                </div>
                            </div>
                            @endif
                            
                            @if($service->testing_in_person)
                            <div class="info-item">
                                <div class="info-item-icon">
                                    <i class="fas fa-clipboard-check"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Testing</p>
                                    <p class="text-base font-bold text-gray-900">In-Person</p>
                                </div>
                            </div>
                            @endif
                            
                            <div class="info-item">
                                <div class="info-item-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Status</p>
                                    <p class="text-base font-bold {{ $service->is_active ? 'text-green-600' : 'text-gray-500' }}">
                                        {{ $service->is_active ? 'Available Now' : 'Coming Soon' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-4">
                    <div class="sticky top-6 space-y-6">
                        <!-- Quick Info Card -->
                        <div class="detail-card" data-aos="fade-left" data-aos-delay="100">
                            <h3 class="text-xl font-bold text-gray-900 mb-4 uppercase border-b-2 border-[var(--primary-color)] pb-3" style="font-family: var(--font-display);">
                                Quick Info
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Service</p>
                                    <p class="text-base font-bold text-gray-900">{{ $service->title }}</p>
                                </div>
                                
                                @if($service->short_description)
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Overview</p>
                                    <p class="text-sm text-gray-600 leading-relaxed">{{ $service->short_description }}</p>
                                </div>
                                @endif
                                
                                <div class="flex flex-wrap gap-2 pt-2">
                                    @if($service->class_type)
                                        <span class="badge badge-primary">
                                            <i class="fas fa-users"></i>
                                            {{ $service->class_type === 'one-on-one' ? 'One-on-One' : 'Group' }}
                                        </span>
                                    @endif
                                    @if($service->has_online_parts)
                                        <span class="badge badge-info">
                                            <i class="fas fa-globe"></i>
                                            Online
                                        </span>
                                    @endif
                                    @if($service->testing_in_person)
                                        <span class="badge badge-success">
                                            <i class="fas fa-clipboard-check"></i>
                                            In-Person Testing
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        
                    </div>
                </div>

            </div>
            
            <!-- CTA and Booking Section - 6 columns each -->
            <div class="grid grid-cols-2 lg:grid-cols-12 gap-8 lg:gap-12 mt-8">
                <!-- Ready to Get Started Section - 6 columns -->
                <div class="lg:col-span-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="detail-card bg-gradient-to-r from-[var(--primary-color)] to-[var(--btn-hover-color)] text-black h-full">
                        <div class="flex flex-col h-full">
                            <div class="flex-1">
                                <h3 class="text-2xl md:text-3xl font-bold mb-4 uppercase" style="font-family: var(--font-display);">
                                    Ready to Get Started?
                                </h3>
                                <p class="text-lg opacity-95 mb-6">
                                    Contact us today to learn more about enrollment and schedules.
                                </p>
                            </div>
                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="{{ route('contact') }}" class="btn-booking w-full justify-center mb-5">
                                    <i class="fas fa-envelope"></i>
                                    <span>Contact Us</span>
                                </a>
                                @if($siteSettings && $siteSettings->phone)
                                    <a href="tel:{{ str_replace([' ', '-', '(', ')'], '', $siteSettings->phone) }}" 
                                       class="btn-booking w-full justify-center mb-5">
                                        <i class="fas fa-phone"></i>
                                        <span>Call Us</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking/Pricing Section - 6 columns -->
                @if($service->is_active && ($service->price || $service->deposit_amount))
                <div class="lg:col-span-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="detail-card h-full">
                        <div class="text-center mb-6">
                            <h3 class="text-2xl font-bold text-gray-900 mb-4 uppercase" style="font-family: var(--font-display);">
                                Pricing & Booking
                            </h3>
                            @if($service->price)
                            <div class="price-display mb-2">
                                ${{ number_format($service->price, 2) }}
                            </div>
                            <p class="text-sm text-gray-600 mb-4">per student</p>
                            @endif
                            
                            @if($service->deposit_amount)
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                                <p class="text-xs text-gray-600 mb-1">Deposit Required</p>
                                <p class="text-xl font-bold text-green-600">
                                    ${{ number_format($service->deposit_amount, 2) }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">per student</p>
                            </div>
                            @endif
                        </div>
                        
                        @if($service->hasAvailableSpots())
                            <a href="{{ route('customer.available-classes', $service->id) }}" 
                               class="btn-booking w-full justify-center mb-5">
                                <i class="fas fa-calendar-plus"></i>
                                Book Now
                            </a>
                            <p class="text-xs text-gray-500 text-center mt-3">
                                View available class schedules
                            </p>
                        @else
                            <button disabled
                               class="w-full bg-gray-400 text-white font-bold py-4 px-6 rounded-lg text-center cursor-not-allowed">
                                No Classes Available
                            </button>
                            <p class="text-xs text-gray-500 text-center mt-3">
                                Please check back later or contact us
                            </p>
                        @endif
                        
                        @if($service->class_type === 'group')
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <p class="text-xs mt-4 text-gray-600 text-center">
                                    <i class="fas fa-users mr-1"></i>
                                    Group classes available
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Related Services -->
    @if($relatedServices->count() > 0)
        <section class="py-16 lg:py-24 bg-white">
            <div class="container mx-auto px-4 lg:px-10">
                <div class="text-center mb-12" data-aos="fade-up">
                    <h2 class="training-heading mb-4">
                        Other <span class="text-[var(--primary-color)]">Training Services</span>
                    </h2>
                    <p class="text-[#666] text-[16px] md:text-[18px] max-w-2xl mx-auto">
                        Explore our comprehensive range of professional security training programs.
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($relatedServices as $index => $relatedService)
                        <div class="service-detail-card bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                            <div class="relative h-[220px] overflow-hidden group">
                                @if($relatedService->image)
                                    <img src="{{ asset('storage/' . $relatedService->image) }}" 
                                         alt="{{ $relatedService->title }}" 
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                @else
                                    <img src="{{ asset('images/training-img-' . (($index % 6) + 1) . '.png') }}" 
                                         alt="{{ $relatedService->title }}" 
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-4 transform translate-y-full group-hover:translate-y-0 transition-transform">
                                    <a href="{{ route('service.details', $relatedService->id) }}" 
                                       class="inline-flex items-center gap-2 text-white font-semibold hover:underline">
                                        Learn More <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-[20px] font-bold text-[var(--text-color)] mb-3 uppercase" style="font-family: var(--font-display);">
                                    {{ $relatedService->title }}
                                </h3>
                                @if($relatedService->short_description)
                                    <p class="text-[#666] text-[14px] leading-relaxed mb-4 line-clamp-2">
                                        {{ Str::limit($relatedService->short_description, 120) }}
                                    </p>
                                @endif
                                <a href="{{ route('service.details', $relatedService->id) }}" 
                                   class="inline-flex items-center gap-2 text-[var(--primary-color)] font-semibold hover:underline text-[14px] group">
                                    <span>Read More</span>
                                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Back to Services -->
                <div class="bg-gray-100 p-4 rounded-lg border border-gray-200 mt-8">
                    <a href="{{ route('services') }}" class="flex items-center justify-center gap-2 text-[var(--primary-color)] font-semibold hover:underline">
                        <i class="fas fa-arrow-left"></i> 
                        <span>View All Services</span>
                    </a>
                </div>
            </div>
            
        </section>
    @endif

    <!-- Bottom CTA Section -->
    <section class="py-16 bg-[var(--primary-color)]">
        <div class="container mx-auto px-4 lg:px-10">
            <div class="max-w-4xl mx-auto text-center text-white" data-aos="fade-up">
                <h2 class="text-[32px] md:text-[42px] font-bold mb-4 uppercase" style="font-family: var(--font-display);">
                    Start Your Journey Today
                </h2>
                <p class="text-[18px] md:text-[20px] mb-8 opacity-95">
                    Join hundreds of professionals who have advanced their careers with our comprehensive training programs.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('contact') }}" class="btn secondary-button inline-block">
                        Get In Touch
                    </a>
                    <a href="{{ route('services') }}" class="bg-white/20 hover:bg-white/30 text-white font-bold py-4 px-8 rounded transition-colors inline-flex items-center gap-2">
                        <span>View All Services</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>
@endsection
