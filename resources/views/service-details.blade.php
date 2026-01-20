@extends('layouts.web.master')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
    <main class="overflow-hidden">
        
        <!-- Inner Hero Section -->
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

        <!-- Service Details Section -->
        <section class="py-16 lg:py-24 bg-white">
            <div class="container mx-auto px-4 lg:px-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
                    
                    <!-- Main Content -->
                    <div class="lg:col-span-8">
                        @if($service->image)
                            <div class="mb-10 rounded-lg overflow-hidden shadow-lg" data-aos="fade-up">
                                <img src="{{ asset('storage/' . $service->image) }}" 
                                     alt="{{ $service->title }}" 
                                     class="w-full h-auto object-cover">
                            </div>
                        @endif

                        <!-- Service Description -->
                        <div class="service-content-wrapper mb-10" data-aos="fade-up" data-aos-delay="200">
                            @if($service->description)
                                <div class="service-description prose prose-lg max-w-none">
                                    <div class="text-[#333] text-[16px] md:text-[18px] leading-relaxed space-y-4">
                                        {!! $service->description !!}
                                    </div>
                                </div>
                            @elseif($service->short_description)
                                <div class="service-description">
                                    <p class="text-[#333] text-[16px] md:text-[18px] leading-relaxed">
                                        {{ $service->short_description }}
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Key Features/Highlights Section (if needed for future) -->
                        <div class="mt-10 pt-8 border-t border-gray-200">
                            <h3 class="text-[24px] md:text-[28px] font-bold text-[var(--text-color)] mb-6 uppercase" style="font-family: var(--font-display);">
                                Why Choose This Training?
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="flex items-start gap-4">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-[var(--primary-color)] flex items-center justify-center">
                                        <i class="fas fa-check text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-[18px] font-bold text-[var(--text-color)] mb-2">Expert Instructors</h4>
                                        <p class="text-[#666] text-[15px] leading-relaxed">Learn from certified professionals with years of real-world experience.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-[var(--primary-color)] flex items-center justify-center">
                                        <i class="fas fa-certificate text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-[18px] font-bold text-[var(--text-color)] mb-2">Certification</h4>
                                        <p class="text-[#666] text-[15px] leading-relaxed">Receive recognized certifications upon successful completion.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-[var(--primary-color)] flex items-center justify-center">
                                        <i class="fas fa-handshake text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-[18px] font-bold text-[var(--text-color)] mb-2">Career Support</h4>
                                        <p class="text-[#666] text-[15px] leading-relaxed">Get assistance with job placement and career advancement.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-[var(--primary-color)] flex items-center justify-center">
                                        <i class="fas fa-clock text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-[18px] font-bold text-[var(--text-color)] mb-2">Flexible Schedule</h4>
                                        <p class="text-[#666] text-[15px] leading-relaxed">Training programs designed to fit your schedule.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CTA Section -->
                        <div class="mt-12 pt-10 border-t-2 border-gray-200" data-aos="fade-up" data-aos-delay="300">
                            <div class="p-8 rounded-lg text-white" style="background: linear-gradient(to right, var(--primary-color), var(--btn-hover-color));">
                                <h3 class="text-[28px] md:text-[32px] font-bold mb-4 uppercase" style="font-family: var(--font-display);">
                                    Ready to Get Started?
                                </h3>
                                <p class="text-[18px] mb-6 opacity-95 max-w-2xl">
                                    Take the first step towards your career in security. Contact us today to learn more about enrollment, schedules, and requirements.
                                </p>
                                <div class="flex flex-wrap gap-4">
                                    <a href="{{ route('contact') }}" class="btn secondary-button inline-block">
                                        Contact Us Now
                                    </a>
                                    @if($siteSettings && $siteSettings->phone)
                                        <a href="tel:{{ str_replace([' ', '-', '(', ')'], '', $siteSettings->phone) }}" 
                                           class="bg-white text-[var(--primary-color)] font-bold py-4 px-8 rounded inline-flex items-center gap-2 hover:bg-gray-100 transition-colors">
                                            <i class="fas fa-phone"></i> Call Us
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="lg:col-span-4">
                        <div class="sticky top-6 space-y-6">
                            <!-- Quick Info Card -->
                            <div class="bg-white border-2 border-gray-200 p-6 rounded-lg shadow-md" data-aos="fade-left">
                                <h3 class="text-[22px] font-bold text-[var(--text-color)] mb-5 uppercase border-b-2 border-[var(--primary-color)] pb-3" style="font-family: var(--font-display);">
                                    Quick Information
                                </h3>
                                <div class="space-y-5">
                                    <div class="flex items-start gap-3">
                                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-[var(--primary-color)]/10 flex items-center justify-center mt-1">
                                            <i class="fas fa-briefcase text-[var(--primary-color)] text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="text-[12px] text-gray-600 uppercase tracking-wider mb-1 font-semibold">Service Type</p>
                                            <p class="text-[16px] font-bold text-[var(--text-color)]">{{ $service->title }}</p>
                                        </div>
                                    </div>
                                    @if($service->short_description)
                                        <div class="flex items-start gap-3">
                                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-[var(--primary-color)]/10 flex items-center justify-center mt-1">
                                                <i class="fas fa-info-circle text-[var(--primary-color)] text-sm"></i>
                                            </div>
                                            <div>
                                                <p class="text-[12px] text-gray-600 uppercase tracking-wider mb-1 font-semibold">Overview</p>
                                                <p class="text-[14px] text-[#666] leading-relaxed">{{ $service->short_description }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="flex items-start gap-3">
                                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-[var(--primary-color)]/10 flex items-center justify-center mt-1">
                                            <i class="fas fa-calendar-check text-[var(--primary-color)] text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="text-[12px] text-gray-600 uppercase tracking-wider mb-1 font-semibold">Status</p>
                                            <p class="text-[16px] font-bold text-[var(--primary-color)]">
                                                @if($service->is_active) Available Now @else Coming Soon @endif
                                            </p>
                                        </div>
                                    </div>
                                    
                                    @if($service->class_type)
                                    <div class="flex items-start gap-3">
                                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-[var(--primary-color)]/10 flex items-center justify-center mt-1">
                                            <i class="fas fa-users text-[var(--primary-color)] text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="text-[12px] text-gray-600 uppercase tracking-wider mb-1 font-semibold">Class Type</p>
                                            <p class="text-[16px] font-bold text-[var(--text-color)]">
                                                {{ $service->class_type === 'one-on-one' ? 'One-on-One Training' : 'Group Classes' }}
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Pricing & Booking Card -->
                            @if($service->is_active && ($service->price || $service->deposit_amount))
                            <div class="bg-white border-2 border-[var(--primary-color)] p-6 rounded-lg shadow-lg" data-aos="fade-left" data-aos-delay="100">
                                <h3 class="text-[22px] font-bold text-[var(--text-color)] mb-5 uppercase border-b-2 border-[var(--primary-color)] pb-3" style="font-family: var(--font-display);">
                                    Pricing & Booking
                                </h3>
                                
                                @if($service->price)
                                <div class="mb-4">
                                    <div class="flex items-baseline gap-2 mb-2">
                                        <span class="text-[32px] font-bold text-[var(--primary-color)]">${{ number_format($service->price, 2) }}</span>
                                        <span class="text-[14px] text-gray-600">per student</span>
                                    </div>
                                </div>
                                @endif
                                
                                @if($service->deposit_amount)
                                <div class="mb-5 pb-4 border-b border-gray-200">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-[14px] text-gray-600">Deposit Required:</span>
                                        <span class="text-[18px] font-bold text-green-600">${{ number_format($service->deposit_amount, 2) }}</span>
                                    </div>
                                    <p class="text-[12px] text-gray-500 mt-1">per student</p>
                                </div>
                                @endif
                                
                                @if($service->hasAvailableSpots())
                                    <a href="{{ route('customer.available-classes', $service->id) }}" 
                                       class="block w-full bg-[var(--primary-color)] hover:bg-[var(--btn-hover-color)] text-white font-bold py-4 px-6 rounded-lg text-center transition-colors mb-3 text-[16px] uppercase" 
                                       style="font-family: var(--font-display);">
                                        <i class="fas fa-calendar-plus mr-2"></i> Book Now
                                    </a>
                                    <p class="text-[12px] text-gray-500 text-center">
                                        View available class schedules
                                    </p>
                                @else
                                    <button disabled
                                       class="block w-full bg-gray-400 text-white font-bold py-4 px-6 rounded-lg text-center cursor-not-allowed mb-3 text-[16px] uppercase">
                                        No Classes Available
                                    </button>
                                    <p class="text-[12px] text-gray-500 text-center">
                                        Please check back later or contact us
                                    </p>
                                @endif
                                
                                @if($service->class_type === 'group')
                                    <div class="mt-4 pt-4 border-t border-gray-200">
                                        <p class="text-[12px] text-gray-600 text-center">
                                            <i class="fas fa-users mr-1"></i>
                                            Group classes available - Book for multiple students
                                        </p>
                                    </div>
                                @endif
                            </div>
                            @endif

                            {{-- Contact Card - Hidden
                            <div class="p-6 rounded-lg shadow-xl text-white" style="background: linear-gradient(to bottom right, var(--primary-color), var(--btn-hover-color));" data-aos="fade-left" data-aos-delay="200">
                                <div class="text-center mb-6">
                                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-headset text-3xl"></i>
                                    </div>
                                    <h3 class="text-[24px] font-bold mb-3 uppercase" style="font-family: var(--font-display);">
                                        Need Help?
                                    </h3>
                                    <p class="text-[15px] opacity-95 leading-relaxed">
                                        Our team is here to answer your questions and guide you through the enrollment process.
                                    </p>
                                </div>
                                
                                <div class="space-y-3 mb-6">
                                    @if($siteSettings && $siteSettings->phone)
                                        <a href="tel:{{ str_replace([' ', '-', '(', ')'], '', $siteSettings->phone) }}" 
                                           class="flex items-center gap-3 bg-white/20 hover:bg-white/30 rounded-lg p-3 transition-colors">
                                            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-phone text-sm"></i>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <p class="text-[11px] opacity-80 uppercase tracking-wider mb-1">Phone</p>
                                                <p class="text-[14px] font-bold truncate">{{ $siteSettings->phone }}</p>
                                            </div>
                                        </a>
                                    @endif
                                    @if($siteSettings && $siteSettings->email)
                                        <a href="mailto:{{ $siteSettings->email }}" 
                                           class="flex items-start gap-3 bg-white/20 hover:bg-white/30 rounded-lg p-3 transition-colors">
                                            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                                <i class="fas fa-envelope text-sm"></i>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <p class="text-[11px] opacity-80 uppercase tracking-wider mb-1">Email</p>
                                                <p class="text-[13px] font-bold break-words leading-snug">{{ $siteSettings->email }}</p>
                                            </div>
                                        </a>
                                    @endif
                                </div>
                                
                                <a href="{{ route('contact') }}" class="block w-full bg-white text-[var(--primary-color)] font-bold py-3 px-6 rounded-lg text-center hover:bg-gray-100 transition-colors">
                                    Send Message
                                </a>
                            </div>
                            --}}

                            <!-- Back to Services -->
                            <div class="bg-[#F8F8F8] p-4 rounded-lg border border-gray-200">
                                <a href="{{ route('services') }}" class="flex items-center justify-center gap-2 text-[var(--primary-color)] font-semibold hover:underline text-[15px]">
                                    <i class="fas fa-arrow-left"></i> 
                                    <span>View All Services</span>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Related Services -->
        @if($relatedServices->count() > 0)
            <section class="py-16 lg:py-24 bg-gradient-to-b from-[#F8F8F8] to-white">
                <div class="container mx-auto px-4 lg:px-10">
                    <div class="text-center mb-12" data-aos="fade-up">
                        <h2 class="training-heading mb-4">
                            Other <span class="text-[var(--primary-color)]">Training Services</span>
                        </h2>
                        <p class="text-[#666] text-[16px] md:text-[18px] max-w-2xl mx-auto">
                            Explore our comprehensive range of professional security training programs designed to advance your career.
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($relatedServices as $index => $relatedService)
                            <div class="service-detail-card bg-white rounded-lg overflow-hidden" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
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
