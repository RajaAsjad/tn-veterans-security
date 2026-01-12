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
                        TRAINING <span class="text-[var(--primary-color)]">SERVICES</span>
                    </h2>
                    <p class="inner-hero-subtext" data-aos="fade-up" data-aos-delay="200">
                        Professional Security Training, Certified Instruction, and Career Development.
                    </p>
                </div>
            </div>
        </section>

        <!-- Services Detailed Section -->
        <section class="py-16 lg:py-24 bg-white">
            <div class="container mx-auto px-4 lg:px-10">
                
                @if($services->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                        @foreach($services as $index => $service)
                            <div class="service-detail-card" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                                <div class="relative h-[250px] overflow-hidden group">
                                    @if($service->image)
                                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    @else
                                        <img src="{{ asset('images/training-img-' . (($index % 6) + 1) . '.png') }}" alt="{{ $service->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    @endif
                                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/0 transition-colors"></div>
                                </div>
                                <div class="p-8 border-x border-b border-gray-100">
                                    <h3 class="text-[24px] font-bold text-[var(--text-color)] mb-4 uppercase">{{ $service->title }}</h3>
                                    @if($service->short_description)
                                        <p class="text-[#666] leading-relaxed mb-6">{{ $service->short_description }}</p>
                                    @elseif($service->description)
                                        <p class="text-[#666] leading-relaxed mb-6">{{ Str::limit(strip_tags($service->description), 150) }}</p>
                                    @endif
                                    <a href="{{ route('service.details', $service->id) }}" class="text-[var(--primary-color)] font-semibold hover:underline inline-flex items-center gap-2">
                                        Learn More <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <p class="text-gray-600 text-lg">No services available at the moment. Please check back later.</p>
                    </div>
                @endif

            </div>
        </section>

        <!-- Specialized Certification Section -->
        <section class="py-16 lg:py-24 bg-[#111] text-white">
            <div class="container mx-auto px-4 lg:px-10">
                <div class="text-center mb-16">
                    <h2 class="text-[30px] md:text-[50px] font-bold uppercase mb-4" data-aos="fade-up">Get <span class="text-[var(--primary-color)]">Certified</span> Professionally</h2>
                    <p class="text-[18px] md:text-[22px] max-w-[800px] mx-auto text-gray-400" data-aos="fade-up" data-aos-delay="200">Our certifications are recognized throughout the industry and are fully state-compliant.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div data-aos="fade-right">
                        <div class="space-y-8">
                            <div class="flex gap-6 items-start">
                                <span class="text-[40px] font-bold text-[var(--primary-color)] leading-none">01.</span>
                                <div>
                                    <h4 class="text-[24px] font-bold mb-3 uppercase">Veteran Friendly</h4>
                                    <p class="text-gray-400">We prioritize veterans and provide an environment that respects and utilizes your previous experience.</p>
                                </div>
                            </div>
                            <div class="flex gap-6 items-start">
                                <span class="text-[40px] font-bold text-[var(--primary-color)] leading-none">02.</span>
                                <div>
                                    <h4 class="text-[24px] font-bold mb-3 uppercase">Job Placement</h4>
                                    <p class="text-gray-400">We help our graduates connect with security companies for immediate employment opportunities.</p>
                                </div>
                            </div>
                            <div class="flex gap-6 items-start">
                                <span class="text-[40px] font-bold text-[var(--primary-color)] leading-none">03.</span>
                                <div>
                                    <h4 class="text-[24px] font-bold mb-3 uppercase">Ongoing Support</h4>
                                    <p class="text-gray-400">From certification renewals to advanced training, we support your career throughout your professional life.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="relative" data-aos="fade-left">
                        <img src="{{ asset('images/contact-form-left-img.png') }}" alt="Certification Training" class="w-full h-auto rounded-lg shadow-2xl">
                        <div class="absolute -top-10 -left-10 w-40 h-40 border-8 border-[var(--primary-color)] -z-10 rounded-full animate-pulse"></div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
