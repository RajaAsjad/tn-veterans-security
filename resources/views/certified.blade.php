@extends('layouts.web.master')

@section('content')
    <main class="overflow-hidden">
        
        <!-- Inner Hero Section -->
        <section class="inner-hero">
            <div class="inner-hero-overlay"></div>
            <div class="container mx-auto px-4 lg:px-10 relative z-10">
                <div class="max-w-[1000px]">
                    <h2 class="inner-hero-title" data-aos="fade-down" data-aos-duration="1000">
                        GET <span class="text-[var(--primary-color)]">CERTIFIED</span>
                    </h2>
                    <p class="inner-hero-subtext" data-aos="fade-up" data-aos-delay="200">
                        Launch Your Career with Industry-Leading Certifications and Expert Training.
                    </p>
                </div>
            </div>
        </section>

        <!-- Certification Overview Section -->
        <section class="py-16 lg:py-24 bg-white">
            <div class="container mx-auto px-4 lg:px-10">
                <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
                    
                    <!-- Left Side: Content -->
                    <div class="lg:w-1/2" data-aos="fade-right">
                        <h2 class="text-[30px] md:text-[45px] font-bold text-[var(--text-color)] uppercase mb-6 leading-tight">
                            Your Path to becoming a <span class="text-[var(--primary-color)]">Certified Professional</span>
                        </h2>
                        <p class="text-[16px] md:text-[20px] text-[#333] leading-relaxed mb-6">
                            Obtaining a certification is the first step towards a stable and respected career in the security industry. Our programs are designed to provide you with the knowledge, skills, and legal understanding required to excel.
                        </p>
                        <p class="text-[16px] md:text-[20px] text-[#333] leading-relaxed mb-8">
                            We offer a streamlined process to help you get certified quickly and efficiently, without compromising on the quality of instruction.
                        </p>
                        
                        <div class="space-y-4">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-[var(--primary-color)] flex items-center justify-center text-white shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-[18px] font-medium text-[var(--text-color)]">State-Approved Curriculum</span>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-[var(--primary-color)] flex items-center justify-center text-white shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-[18px] font-medium text-[var(--text-color)]">Expert Veteran Instructors</span>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-[var(--primary-color)] flex items-center justify-center text-white shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-[18px] font-medium text-[var(--text-color)]">Hands-on Practical Training</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: Image/Card bundle -->
                    <div class="lg:w-1/2" data-aos="fade-left">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-4">
                                <img src="{{ asset('images/training-img-1.png') }}" alt="Training 1" class="w-full h-[200px] object-cover rounded-sm">
                                <img src="{{ asset('images/training-img-2.png') }}" alt="Training 2" class="w-full h-[280px] object-cover rounded-sm">
                            </div>
                            <div class="space-y-4">
                                <img src="{{ asset('images/training-img-3.png') }}" alt="Training 3" class="w-full h-[280px] object-cover rounded-sm">
                                <img src="{{ asset('images/training-img-4.png') }}" alt="Training 4" class="w-full h-[200px] object-cover rounded-sm">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Certification Steps -->
        <section class="py-16 lg:py-24 bg-[#f8f8f8]">
            <div class="container mx-auto px-4 lg:px-10">
                <div class="text-center mb-16">
                    <h2 class="text-[30px] md:text-[50px] font-bold uppercase mb-4" data-aos="fade-up">3 Simple Steps to <span class="text-[var(--primary-color)]">Certification</span></h2>
                    <p class="text-[18px] md:text-[22px] max-w-[800px] mx-auto text-[#666]" data-aos="fade-up" data-aos-delay="200">Start your journey today following our proven certification path.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <!-- Step 1 -->
                    <div class="text-center group" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-24 h-24 bg-white shadow-lg rounded-full flex items-center justify-center mx-auto mb-8 border-2 border-transparent group-hover:border-[var(--primary-color)] transition-all duration-300">
                            <span class="text-[36px] font-bold text-[var(--primary-color)]">01</span>
                        </div>
                        <h4 class="text-[22px] font-bold uppercase mb-4">Choose Your Program</h4>
                        <p class="text-[#666]">Select from our wide range of training services including armed/unarmed guard or specialized tactics.</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="text-center group" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-24 h-24 bg-white shadow-lg rounded-full flex items-center justify-center mx-auto mb-8 border-2 border-transparent group-hover:border-[var(--primary-color)] transition-all duration-300">
                            <span class="text-[36px] font-bold text-[var(--primary-color)]">02</span>
                        </div>
                        <h4 class="text-[22px] font-bold uppercase mb-4">Complete Training</h4>
                        <p class="text-[#666]">Attend our structured, hands-on classes led by certified veteran instructors at our facility.</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="text-center group" data-aos="fade-up" data-aos-delay="300">
                        <div class="w-24 h-24 bg-white shadow-lg rounded-full flex items-center justify-center mx-auto mb-8 border-2 border-transparent group-hover:border-[var(--primary-color)] transition-all duration-300">
                            <span class="text-[36px] font-bold text-[var(--primary-color)]">03</span>
                        </div>
                        <h4 class="text-[22px] font-bold uppercase mb-4">Receive Certificate</h4>
                        <p class="text-[#666]">Upon successful completion, receive your official certification and start your professional career.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Ready to take selection (Reused) -->
        <section class="ready-section">
            <div class="container mx-auto px-4 lg:px-10 relative z-10">
                <div class="text-left md:text-center lg:text-left md:mx-auto lg:mx-0">
                    <h2 class="mb-5" data-aos="fade-up">
                        <span class="block text-[18px] md:text-[24px] text-white font-normal">Ready to get</span>
                        <span class="block text-[30px] md:text-[45px] font-black leading-tight uppercase">
                            <span class="text-[#F6CB42]">CERTIFIED</span> <span class="text-[#FFFFFF]">TODAY?</span>
                        </span>
                    </h2>
                    <p class="text-[16px] md:text-[20px] text-white font-normal mb-8 md:mx-auto lg:mx-0" data-aos="fade-up" data-aos-delay="200">
                        Enroll in our next certification session and take the first step towards a rewarding career.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-start md:justify-center lg:justify-start" data-aos="fade-up" data-aos-delay="400">
                        <a href="#" class="btn primary-button !text-center">Enroll Now</a>
                        <a href="#" class="btn secondary-button !text-center">Contact Us</a>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
