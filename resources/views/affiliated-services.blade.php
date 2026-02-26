@extends('layouts.web.master')

@section('title', 'Affiliated Services - Partners & Organizations')

@section('content')
    <main class="overflow-hidden">
        
        <!-- Inner Hero Section (same as home/inner pages) -->
        <section class="inner-hero">
            <div class="inner-hero-overlay"></div>
            <div class="container mx-auto px-4 lg:px-10 relative z-10">
                <div class="max-w-[1000px]">
                    <h2 class="inner-hero-title" data-aos="fade-down" data-aos-duration="1000">
                        <span class="text-[var(--primary-color)]">Affiliated</span> Services
                    </h2>
                    <p class="inner-hero-subtext" data-aos="fade-up" data-aos-delay="200">
                        Our trusted partners and affiliated organizations.
                    </p>
                </div>
            </div>
        </section>

        <!-- Affiliates / Partners Section -->
         
        <section class="py-16 lg:py-24 bg-white">
            <div class="container mx-auto px-4 lg:px-10">
                <div class="text-center mb-12" data-aos="fade-up">
                    <h2 class="text-[30px] md:text-[45px] font-bold text-[var(--text-color)] uppercase mb-4">
                        Partners & <span class="text-[var(--primary-color)]">Organizations</span>
                    </h2>
                    <p class="text-[16px] md:text-[20px] text-[#666] max-w-2xl mx-auto">
                        We work with industry-leading organizations. Use the links below to learn more (opens in a new tab).
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    <!-- NRA -->
                    <a href="#"  rel="noopener noreferrer" class="group block bg-gray-50 hover:bg-[var(--primary-color)]/10 border border-gray-200 hover:border-[var(--primary-color)] rounded-xl p-6 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="w-12 h-12 rounded-lg bg-[var(--primary-color)] flex items-center justify-center text-white font-bold text-lg shrink-0 group-hover:scale-110 transition-transform">NRA</div>
                            <h3 class="text-xl font-bold text-[var(--text-color)] group-hover:text-[var(--primary-color)] transition-colors">NRA</h3>
                        </div>
                        <p class="text-[#666] text-sm group-hover:text-gray-700">National Rifle Association — training and education resources.</p>
                        <span class="inline-flex items-center gap-1 text-[var(--primary-color)] font-semibold mt-3 text-sm">Visit site <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg></span>
                    </a>

                    <!-- ASP -->
                    <a href="#"  rel="noopener noreferrer" class="group block bg-gray-50 hover:bg-[var(--primary-color)]/10 border border-gray-200 hover:border-[var(--primary-color)] rounded-xl p-6 transition-all duration-300" data-aos="fade-up" data-aos-delay="150">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="w-12 h-12 rounded-lg bg-[var(--primary-color)] flex items-center justify-center text-white font-bold text-lg shrink-0 group-hover:scale-110 transition-transform">ASP</div>
                            <h3 class="text-xl font-bold text-[var(--text-color)] group-hover:text-[var(--primary-color)] transition-colors">ASP</h3>
                        </div>
                        <p class="text-[#666] text-sm group-hover:text-gray-700">Armament Systems and Procedures — less than lethal and defensive tactics.</p>
                        <span class="inline-flex items-center gap-1 text-[var(--primary-color)] font-semibold mt-3 text-sm">Visit site <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg></span>
                    </a>

                    <!-- Red Cross -->
                    <a href="#"  rel="noopener noreferrer" class="group block bg-gray-50 hover:bg-[var(--primary-color)]/10 border border-gray-200 hover:border-[var(--primary-color)] rounded-xl p-6 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="w-12 h-12 rounded-lg bg-[var(--primary-color)] flex items-center justify-center text-white font-bold text-sm shrink-0 group-hover:scale-110 transition-transform">RC</div>
                            <h3 class="text-xl font-bold text-[var(--text-color)] group-hover:text-[var(--primary-color)] transition-colors">Red Cross</h3>
                        </div>
                        <p class="text-[#666] text-sm group-hover:text-gray-700">American Red Cross — first aid, CPR, and emergency training.</p>
                        <span class="inline-flex items-center gap-1 text-[var(--primary-color)] font-semibold mt-3 text-sm">Visit site <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg></span>
                    </a>

                    <!-- US Law Shield -->
                    <a href="#"  rel="noopener noreferrer" class="group block bg-gray-50 hover:bg-[var(--primary-color)]/10 border border-gray-200 hover:border-[var(--primary-color)] rounded-xl p-6 transition-all duration-300" data-aos="fade-up" data-aos-delay="250">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="w-12 h-12 rounded-lg bg-[var(--primary-color)] flex items-center justify-center text-white font-bold text-xs shrink-0 group-hover:scale-110 transition-transform">USLS</div>
                            <h3 class="text-xl font-bold text-[var(--text-color)] group-hover:text-[var(--primary-color)] transition-colors">US Law Shield</h3>
                        </div>
                        <p class="text-[#666] text-sm group-hover:text-gray-700">Legal defense and education for responsible gun owners.</p>
                        <span class="inline-flex items-center gap-1 text-[var(--primary-color)] font-semibold mt-3 text-sm">Visit site <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg></span>
                    </a>

                    <!-- Other Veteran-Owned Companies and Affiliates (placeholder) -->
                    <!-- <div class="block bg-gray-50 border border-gray-200 rounded-xl p-6 opacity-90" data-aos="fade-up" data-aos-delay="300">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="w-12 h-12 rounded-lg bg-gray-400 flex items-center justify-center text-white font-bold text-xs shrink-0">VET</div>
                            <h3 class="text-xl font-bold text-[var(--text-color)]">Veteran-Owned & Affiliates</h3>
                        </div>
                        <p class="text-[#666] text-sm mb-3">Other veteran-owned companies and affiliate partners. More links coming soon.</p>
                        <span class="text-gray-400 text-sm font-medium">Placeholder</span>
                    </div> -->
                </div>
            </div>
        </section>

        <!-- CTA Section (same style as home inner pages) -->
        <section class="ready-section">
            <div class="container mx-auto px-4 lg:px-10 relative z-10">
                <div class="text-left md:text-center lg:text-left md:mx-auto lg:mx-0">
                    <h2 class="mb-5" data-aos="fade-up">
                        <span class="block text-[18px] md:text-[24px] text-white font-normal">Questions about our</span>
                        <span class="block text-[30px] md:text-[45px] font-black leading-tight uppercase">
                            <span class="text-[#F6CB42]">PARTNERS</span> <span class="text-[#FFFFFF]">?</span>
                        </span>
                    </h2>
                    <p class="text-[16px] md:text-[20px] text-white font-normal mb-8 md:mx-auto lg:mx-0" data-aos="fade-up" data-aos-delay="200">
                        Contact us for more information about our affiliated services and training programs.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-start md:justify-center lg:justify-start" data-aos="fade-up" data-aos-delay="400">
                        <a href="{{ route('contact') }}" class="btn primary-button !text-center">Contact Us</a>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
