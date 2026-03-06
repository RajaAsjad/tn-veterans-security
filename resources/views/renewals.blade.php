@extends('layouts.web.master')

@section('content')
    <main class="overflow-hidden">

        <!-- Inner Hero Section -->
        <section class="inner-hero">
            <div class="inner-hero-overlay"></div>
            <div class="container mx-auto px-4 lg:px-10 relative z-10">
                <div class="max-w-[1000px] py-8">
                    <h2 class="inner-hero-title" data-aos="fade-down" data-aos-duration="1000">
                        <span class="text-[var(--primary-color)]">Renewals</span>
                    </h2>
                    <p class="inner-hero-subtext" data-aos="fade-up" data-aos-delay="200">
                        All individual 4hr classes · Physical
                    </p>
                </div>
            </div>
        </section>

        <!-- Renewals Cards Section -->
        <section class="py-16 lg:py-24 bg-gradient-to-b from-white to-[#F8F8F8]">
            <div class="container mx-auto px-4 lg:px-10">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
                    @php
                        $renewalClasses = [
                            [
                                'title' => 'Active Shooter',
                                'subtitle' => 'Renewal · Annual',
                                'description' => 'Annual renewal for Active Shooter certification. Stay current with required training.',
                                'url' => route('services', ['category' => 'active_shooter']),
                                'image' => 'training-img-1.png',
                            ],
                            [
                                'title' => 'Dallas Law',
                                'subtitle' => 'Renewal · 2 years',
                                'description' => 'Dallas Law renewal valid for 2 years. Required for alcohol-related security work.',
                                'url' => route('services', ['category' => 'dallas_law']),
                                'image' => 'training-img-2.png',
                            ],
                            [
                                'title' => 'Enhanced Armed Guard',
                                'subtitle' => 'To be determined (TBD) · Annual',
                                'description' => 'Enhanced armed guard renewal. Schedule and details coming soon.',
                                'url' => route('handgun.subcategories'),
                                'image' => 'training-img-3.png',
                            ],
                            [
                                'title' => 'Armed Guard',
                                'subtitle' => 'Renewal · 2 years',
                                'description' => 'Armed security guard certification renewal. Valid for 2 years.',
                                'url' => route('services', ['category' => 'security_training']),
                                'image' => 'training-img-4.png',
                            ],
                            [
                                'title' => 'Unarmed',
                                'subtitle' => 'Renewal · 2 years',
                                'description' => 'Unarmed security guard renewal. Keep your registration current for 2 years.',
                                'url' => route('services', ['category' => 'renewals']),
                                'image' => 'training-img-5.png',
                            ],
                        ];
                    @endphp

                    @foreach($renewalClasses as $index => $class)
                        <a href="{{ $class['url'] }}" class="group block">
                            <div class="service-detail-card bg-white rounded-lg overflow-hidden h-full flex flex-col transition-all duration-300 hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                                <!-- Image Section -->
                                <div class="relative h-[280px] overflow-hidden">
                                    <img src="{{ asset('images/' . $class['image']) }}"
                                         alt="{{ $class['title'] }}"
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    <div class="absolute top-4 right-4 bg-[var(--primary-color)] text-white px-4 py-2 rounded-full text-sm font-bold opacity-0 group-hover:opacity-100 transform translate-y-[-10px] group-hover:translate-y-0 transition-all duration-300">
                                        Learn More
                                    </div>
                                </div>
                                <!-- Content Section -->
                                <div class="p-6 lg:p-8 flex-1 flex flex-col">
                                    <h3 class="text-[22px] lg:text-[26px] font-bold text-[var(--text-color)] mb-1 uppercase group-hover:text-[var(--primary-color)] transition-colors" style="font-family: var(--font-display);">
                                        {{ $class['title'] }}
                                    </h3>
                                    @if(!empty($class['subtitle']))
                                        <p class="text-[14px] text-gray-500 mb-3">{{ $class['subtitle'] }}</p>
                                    @endif
                                    <p class="text-[#666] text-[15px] lg:text-[16px] leading-relaxed mb-4 flex-1">
                                        {{ $class['description'] }}
                                    </p>
                                    <div class="flex items-center gap-2 text-[var(--primary-color)] font-semibold mt-auto pt-4 border-t border-gray-100 group-hover:border-[var(--primary-color)]/30 transition-colors">
                                        <span class="text-[15px] uppercase tracking-wide">View Details</span>
                                        <i class="fas fa-arrow-right transform group-hover:translate-x-2 transition-transform"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="ready-section">
            <div class="container mx-auto px-4 lg:px-10 relative z-10">
                <div class="text-left md:text-center lg:text-left md:mx-auto lg:mx-0">
                    <h2 class="mb-5" data-aos="fade-up">
                        <span class="block text-[18px] md:text-[24px] text-white font-normal">Need to renew?</span>
                        <span class="block text-[30px] md:text-[45px] font-black leading-tight uppercase">
                            <span class="text-[#F6CB42]">RENEWALS</span> <span class="text-[#FFFFFF]">· CONTACT US</span>
                        </span>
                    </h2>
                    <p class="text-[16px] md:text-[20px] text-white font-normal mb-8 md:mx-auto lg:mx-0" data-aos="fade-up" data-aos-delay="200">
                        Book your 4hr renewal class and keep your certification current.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-start md:justify-center lg:justify-start" data-aos="fade-up" data-aos-delay="400">
                        <a href="{{ route('contact') }}" class="btn primary-button !text-center">Contact Us</a>
                        <a href="{{ route('services', ['category' => 'renewals']) }}" class="btn secondary-button !text-center">View All Renewals</a>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
