@extends('layouts.web.master')

@section('content')
    <main class="overflow-hidden">

        <!-- Inner Hero Section -->
        <section class="inner-hero">
            <div class="inner-hero-overlay"></div>
            <div class="container mx-auto px-4 lg:px-10 relative z-10">
                <div class="max-w-[1000px] py-8">
                    <h2 class="inner-hero-title" data-aos="fade-down" data-aos-duration="1000">
                        <span class="text-[var(--primary-color)]">Initial Security</span>
                    </h2>
                    <p class="inner-hero-subtext" data-aos="fade-up" data-aos-delay="200">
                        Individual classes · Physical classes
                    </p>
                </div>
            </div>
        </section>

        <!-- Initial Security Classes - Cards Section -->
        <section class="py-16 lg:py-24 bg-gradient-to-b from-white to-[#F8F8F8]">
            <div class="container mx-auto px-4 lg:px-10">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
                    @php
                        $initialSecurityClasses = [
                            [
                                'title' => 'Enhanced Armed Guard',
                                'subtitle' => 'To be determined (TBD)',
                                'description' => 'Advanced armed guard certification. Details and scheduling coming soon.',
                                'url' => route('handgun.subcategories'),
                                'image' => 'training-img-1.png',
                                'is_link' => true,
                            ],
                            [
                                'title' => 'Initial Armed Security',
                                'subtitle' => null,
                                'description' => 'State-approved armed security guard training. Get certified and start your career.',
                                'url' => route('services', ['category' => 'security_training']),
                                'image' => 'training-img-2.png',
                                'is_link' => true,
                            ],
                            [
                                'title' => 'Initial Unarmed Security',
                                'subtitle' => null,
                                'description' => 'Unarmed security guard registration training. Choose your path based on your work environment.',
                                'url' => '#',
                                'image' => 'training-img-3.png',
                                'is_link' => false,
                                'opens_modal' => 'unarmed-modal',
                            ],
                        ];
                    @endphp

                    @foreach($initialSecurityClasses as $index => $class)
                        @if(!empty($class['opens_modal']))
                            <div class="group block cursor-pointer" onclick="document.getElementById('{{ $class['opens_modal'] }}').classList.remove('hidden')">
                        @else
                            <a href="{{ $class['url'] }}" class="group block">
                        @endif
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
                                        @if($class['subtitle'])
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
                        @if(!empty($class['opens_modal']))
                            </div>
                        @else
                            </a>
                        @endif
                    @endforeach
                </div>
                <!-- Unarmed Security Modal (same as services page) -->
                <div id="unarmed-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 md:p-8 bg-black/50" onclick="if(event.target===this) document.getElementById('unarmed-modal').classList.add('hidden')">
                    <div class="bg-white rounded-lg shadow-xl max-w-lg w-full max-h-[calc(100vh-2rem)] sm:max-h-[calc(100vh-3rem)] overflow-y-auto m-4 sm:m-6 relative" onclick="event.stopPropagation()">
                        <button type="button" onclick="document.getElementById('unarmed-modal').classList.add('hidden')" class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-full text-gray-500 hover:text-gray-800 hover:bg-gray-100 transition-colors">
                            <i class="fas fa-times text-lg"></i>
                        </button>
                        <div class="p-6 lg:p-8 pt-12">
                            <h3 class="text-xl font-bold text-[var(--text-color)] mb-4 uppercase" style="font-family: var(--font-display);">Choose Your Path</h3>
                            <div class="space-y-4">
                                <a href="{{ route('services', ['category' => 'dallas_law']) }}" class="block p-4 rounded-lg border-2 border-gray-200 hover:border-[var(--primary-color)] hover:bg-gray-50 transition-all text-left group">
                                    <p class="text-[var(--text-color)] font-medium group-hover:text-[var(--primary-color)]">If you are working where Alcohol is distributed you must have Dallas Law.</p>
                                </a>
                                <a href="{{ route('services', ['category' => 'asp_less_than_lethal']) }}" class="block p-4 rounded-lg border-2 border-gray-200 hover:border-[var(--primary-color)] hover:bg-gray-50 transition-all text-left group">
                                    <p class="text-[var(--text-color)] font-medium group-hover:text-[var(--primary-color)]">If you want to carry anything such as OC Spray, Baton, Restraints, or Taser you must have Less Than Lethal Training.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="ready-section">
            <div class="container mx-auto px-4 lg:px-10 relative z-10">
                <div class="text-left md:text-center lg:text-left md:mx-auto lg:mx-0">
                    <h2 class="mb-5" data-aos="fade-up">
                        <span class="block text-[18px] md:text-[24px] text-white font-normal">Ready to start</span>
                        <span class="block text-[30px] md:text-[45px] font-black leading-tight uppercase">
                            <span class="text-[#F6CB42]">INITIAL SECURITY</span> <span class="text-[#FFFFFF]">?</span>
                        </span>
                    </h2>
                    <p class="text-[16px] md:text-[20px] text-white font-normal mb-8 md:mx-auto lg:mx-0" data-aos="fade-up" data-aos-delay="200">
                        Enroll in our initial security classes and take the first step towards your security career.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-start md:justify-center lg:justify-start" data-aos="fade-up" data-aos-delay="400">
                        <a href="{{ route('contact') }}" class="btn primary-button !text-center">Contact Us</a>
                        <a href="{{ route('services') }}" class="btn secondary-button !text-center">View All Services</a>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
