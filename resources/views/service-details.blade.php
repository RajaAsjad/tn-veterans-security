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
                <div class="max-w-[1000px]">
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
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    
                    <!-- Main Content -->
                    <div class="lg:col-span-2">
                        @if($service->image)
                            <div class="mb-8 rounded-lg overflow-hidden" data-aos="fade-up">
                                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="w-full h-auto">
                            </div>
                        @endif

                        <div class="prose max-w-none" data-aos="fade-up" data-aos-delay="200">
                            @if($service->description)
                                <div class="text-[#333] text-[16px] md:text-[18px] leading-relaxed">
                                    {!! $service->description !!}
                                </div>
                            @elseif($service->short_description)
                                <p class="text-[#333] text-[16px] md:text-[18px] leading-relaxed">
                                    {{ $service->short_description }}
                                </p>
                            @endif
                        </div>

                        <!-- CTA Section -->
                        <div class="mt-10 pt-8 border-t border-gray-200" data-aos="fade-up" data-aos-delay="300">
                            <a href="{{ route('contact') }}" class="btn primary-button inline-block">
                                Contact Us for This Training
                            </a>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="lg:col-span-1">
                        <!-- Quick Info Card -->
                        <div class="bg-[#F8F8F8] p-6 rounded-lg mb-8" data-aos="fade-left">
                            <h3 class="text-[24px] font-bold text-[var(--text-color)] mb-4 uppercase">Quick Info</h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-[14px] text-gray-600 uppercase tracking-wider mb-1">Service Type</p>
                                    <p class="text-[16px] font-semibold text-[var(--text-color)]">{{ $service->title }}</p>
                                </div>
                                @if($service->short_description)
                                    <div>
                                        <p class="text-[14px] text-gray-600 uppercase tracking-wider mb-1">Overview</p>
                                        <p class="text-[15px] text-[#666]">{{ $service->short_description }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Contact Card -->
                        <div class="bg-[var(--primary-color)] p-6 rounded-lg text-white" data-aos="fade-left" data-aos-delay="200">
                            <h3 class="text-[24px] font-bold mb-4 uppercase">Get Started</h3>
                            <p class="mb-6 text-[16px]">Ready to begin your training? Contact us today to learn more about this program.</p>
                            <a href="{{ route('contact') }}" class="bg-white text-[var(--primary-color)] font-bold py-3 px-6 rounded inline-block hover:bg-gray-100 transition-colors">
                                Contact Us
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Related Services -->
        @if($relatedServices->count() > 0)
            <section class="py-16 lg:py-24 bg-[#F8F8F8]">
                <div class="container mx-auto px-4 lg:px-10">
                    <h2 class="training-heading mb-12" data-aos="fade-up">
                        Other <span class="text-[var(--primary-color)]">Training Services</span>
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($relatedServices as $index => $relatedService)
                            <div class="service-detail-card bg-white" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                                <div class="relative h-[200px] overflow-hidden group">
                                    @if($relatedService->image)
                                        <img src="{{ asset('storage/' . $relatedService->image) }}" alt="{{ $relatedService->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    @else
                                        <img src="{{ asset('images/training-img-' . (($index % 6) + 1) . '.png') }}" alt="{{ $relatedService->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    @endif
                                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/0 transition-colors"></div>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-[20px] font-bold text-[var(--text-color)] mb-3 uppercase">{{ $relatedService->title }}</h3>
                                    @if($relatedService->short_description)
                                        <p class="text-[#666] text-[14px] leading-relaxed mb-4">{{ Str::limit($relatedService->short_description, 100) }}</p>
                                    @endif
                                    <a href="{{ route('service.details', $relatedService->id) }}" class="text-[var(--primary-color)] font-semibold hover:underline inline-flex items-center gap-2 text-[14px]">
                                        Learn More <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- Back to Services -->
        <section class="py-12 bg-white border-t">
            <div class="container mx-auto px-4 lg:px-10">
                <a href="{{ route('services') }}" class="inline-flex items-center gap-2 text-[var(--primary-color)] font-semibold hover:underline">
                    <i class="fas fa-arrow-left"></i> Back to All Services
                </a>
            </div>
        </section>

    </main>
@endsection
