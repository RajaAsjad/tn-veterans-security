<!-- Premium Header Section -->
@php
    $trainingCategories = [
        ['name' => 'NRA', 'url' => route('services', ['category' => 'nra'])],
        ['name' => 'Red Cross', 'url' => route('services', ['category' => 'red_cross'])],
      
        ['name' => 'ASP 4 Hours (Less than Lethal)', 'url' => route('service.by.slug', 'asp-4-hr')],
        ['name' => 'Handgun Carry Permit', 'url' => route('services', ['category' => 'homeland_security'])],
        ['name' => 'Active Shooter 8 Hours', 'url' => route('service.by.slug', 'active-shooter')],
        ['name' => 'Homeland Security', 'url' => route('service.by.slug', 'homeland-security')],
        ['name' => 'Force Science (De-Escalation)', 'url' => route('service.by.slug', 'forced-science-de-escalation')],
        ['name' => 'Dallas Law', 'url' => route('service.by.slug', 'dallas-law')],
        ['name' => 'Renewals', 'url' => route('services', ['category' => 'renewals'])],
    ];
    $servicesAffiliates = [
        ['name' => 'NRA', 'url' => '#', 'external' => true],
        ['name' => 'ASP', 'url' => '#', 'external' => true],
        ['name' => 'Red Cross', 'url' => '#', 'external' => true],
        ['name' => 'US Law Shield', 'url' => '#', 'external' => true],
    ];
@endphp

<style>
    .dropdown-simple {
        position: absolute;
        left: 0;
        top: 100%;
        width: 280px;
        padding-top: 0.5rem;
        opacity: 0;
        visibility: hidden;
        transition: all 0.2s ease-out;
        z-index: 100;
        pointer-events: none;
    }
    .nav-group:hover .dropdown-simple {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }
    .category-item {
        color: #333333;
        padding: 0.75rem 1.5rem;
        display: block;
        font-weight: 500;
        font-size: 16px;
        transition: all 0.2s ease;
        border-bottom: 1px solid #f0f0f0;
    }
    .category-item:last-child {
        border-bottom: none;
    }
    .category-item:hover {
        background-color: #f9f9f9;
        padding-left: 2rem;
        color: var(--primary-color);
    }
    .mobile-sub-menu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease-out;
    }
    .mobile-sub-menu.active {
        max-height: 1000px;
        transition: max-height 0.5s ease-in;
    }
</style>

<header class="relative w-full z-50 ">
    <div class="container mx-auto px-4 lg:px-10">
        <div class="flex items-center justify-between h-20 lg:h-24">
            
            <!-- Logo Area (Exact Match to Screenshot) -->
            <div class="relative flex-shrink-0 z-[60]">
                <a href="{{ url('/') }}" class="absolute -top-4 left-0 lg:-top-4">
                    @if($siteSettings && $siteSettings->header_logo)
                        <img src="{{ asset('storage/' . $siteSettings->header_logo) }}" 
                             alt="TN Veterans Logo" 
                             class="header-logo">
                    @else
                        <img src="{{ asset('images/securty-logo.png') }}" 
                             alt="TN Veterans Logo" 
                             class="header-logo">
                    @endif
                </a>
                <!-- Spacing block to push navigation to the right -->
                <div class="w-24 md:w-32 lg:w-48"></div>
            </div>

            <!-- Desktop Navigation Links (Middle/Right) -->
            <nav class="desktop-nav hidden lg:flex items-center space-x-6 text-[15px] font-medium text-[var(--text-color)]">
                <a href="{{ url('/') }}" class="destop-nav-link">Home</a>
                <a href="{{ route('about') }}" class="destop-nav-link">About Us</a>
                
                <!-- Training Services with Mega Menu -->
                <div class="relative nav-group h-full flex items-center">
                    <a href="{{ route('services') }}" class="destop-nav-link flex items-center gap-1 py-8">
                        Training & Classes
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                    
                    <div class="dropdown-simple">
                        <div class="bg-white shadow-xl rounded-xl border border-gray-100 overflow-hidden py-2">
                            @foreach($trainingCategories as $cat)
                                <a href="{{ $cat['url'] }}" class="category-item">
                                    {{ $cat['name'] }}
                                </a>
                            @endforeach
                            <a href="{{ route('services') }}" class="category-item font-bold text-(--primary-color) border-t-2 border-gray-50">
                                View All Services →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Services dropdown (NRA, ASP, Red Cross, US Law Shield) -->
                <div class="relative nav-group h-full flex items-center">
                    <a href="{{ route('affiliated-services') }}" class="destop-nav-link">
                    <span class="destop-nav-link flex items-center gap-1 py-8 cursor-default">
                    Affiliated
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </span>
                    </a>
                    <div class="dropdown-simple">
                        <div class="bg-white shadow-xl rounded-xl border border-gray-100 overflow-hidden py-2">
                            @foreach($servicesAffiliates as $aff)
                            <!-- add target="_blank" rel="noopener noreferrer" if external is true -->
                                <a href="{{ $aff['url'] }}" class="category-item" @if(!empty($aff['external']))  rel="noopener noreferrer" @endif>
                                    {{ $aff['name'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Security Training with dropdown (Initial Security, Renewals) -->
                <div class="relative nav-group h-full flex items-center">
                    <a href="{{ route('security-training') }}" class="destop-nav-link flex items-center gap-1 py-8 cursor-default">
                        Security Training

                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                    <div class="dropdown-simple">
                        <div class="bg-white shadow-xl rounded-xl border border-gray-100 overflow-hidden py-2">
                            <a href="{{ route('intial-security') }}" class="category-item">Initial Security</a>
                            <a href="{{ route('renewals') }}" class="category-item">Renewals</a>
                        </div>
                    </div>
                </div>
                <a href="{{ route('testimonials') }}" class="destop-nav-link">Testimonials</a>
                <a href="{{ route('contact') }}" class="destop-nav-link">Contact Us</a>
            </nav>

            <!-- Desktop Button (Far Right) -->
            <div class="hidden lg:flex items-center gap-4">
                @auth('customer')
                    <a href="{{ route('customer.dashboard') }}" class="destop-nav-link">Dashboard</a>
                    <form method="POST" action="{{ route('customer.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="destop-nav-link">Logout</button>
                    </form>
                @else
                    <a href="{{ route('customer.login') }}" class="destop-nav-link">Login</a>
                    <a href="{{ route('customer.register') }}" class="btn primary-button">
                        Sign Up
                    </a>
                @endauth
            </div>

            <!-- Hamburger Button (<1024px) -->
            <button id="menuBtn" class="lg:hidden text-3xl text-gray-800 focus:outline-none p-2">
                <span id="menuIcon">☰</span>
            </button>
        </div>
    </div>

    <!-- Mobile Menu Vertical List -->
    <div id="mobileMenu" class="hidden lg:hidden   overflow-hidden transition-all duration-300">
        <nav class="flex flex-col p-6 space-y-1 mt-[60px]">
            <a href="{{ url('/') }}" class="mobile-nav-links">Home</a>
            <a href="{{ route('about') }}" class="mobile-nav-links">About Us</a>
            
            <!-- Mobile Training Services Accordion -->
            <div class="mobile-nav-group">
                <button id="mobileServiceToggle" class="mobile-nav-links w-full flex items-center justify-between focus:outline-none">
                    <span>Training Services</span>
                    <svg id="mobileServiceIcon" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="mobileServiceMenu" class="mobile-sub-menu bg-gray-50 rounded-xl mx-2">
                    <div class="p-4 grid grid-cols-1 gap-2">
                        @foreach($trainingCategories as $cat)
                            <a href="{{ $cat['url'] }}" class="mobile-nav-links text-[16px]! py-3 px-4 hover:bg-white rounded-lg block border-l-4 border-transparent hover:border-(--primary-color)">
                                {{ $cat['name'] }}
                            </a>
                        @endforeach
                        <a href="{{ route('services') }}" class="mobile-nav-links text-[16px]! py-3 px-4 font-bold text-(--primary-color)">
                            View All Services →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mobile Services (affiliates) accordion -->
            <div class="mobile-nav-group">

                <button id="mobileServicesToggle" class="mobile-nav-links w-full flex items-center justify-between focus:outline-none">
                    <span>Services</span>
                    <svg id="mobileServicesIcon" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="mobileServicesMenu" class="mobile-sub-menu bg-gray-50 rounded-xl mx-2">
                    <div class="p-4 grid grid-cols-1 gap-2">
                        @foreach($servicesAffiliates as $aff)
                            <a href="{{ $aff['url'] }}" class="mobile-nav-links text-[16px]! py-3 px-4 hover:bg-white rounded-lg block border-l-4 border-transparent hover:border-(--primary-color)" @if(!empty($aff['external'])) target="_blank" rel="noopener noreferrer" @endif>
                                {{ $aff['name'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Mobile Security Training accordion -->
            <div class="mobile-nav-group">
                <button id="mobileSecurityTrainingToggle" class="mobile-nav-links w-full flex items-center justify-between focus:outline-none">
                    <span>Security Training</span>
                    <svg id="mobileSecurityTrainingIcon" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="mobileSecurityTrainingMenu" class="mobile-sub-menu bg-gray-50 rounded-xl mx-2">
                    <div class="p-4 grid grid-cols-1 gap-2">
                        <a href="{{ route('security-training') }}" class="mobile-nav-links text-[16px]! py-3 px-4 hover:bg-white rounded-lg block border-l-4 border-transparent hover:border-(--primary-color)">Initial Security</a>
                        <a href="{{ route('services', ['category' => 'renewals']) }}" class="mobile-nav-links text-[16px]! py-3 px-4 hover:bg-white rounded-lg block border-l-4 border-transparent hover:border-(--primary-color)">Renewals</a>
                    </div>
                </div>
            </div>
            <a href="{{ route('testimonials') }}" class="mobile-nav-links">Testimonials</a>
            <a href="{{ route('contact') }}" class="mobile-nav-links">Contact Us</a>
            @auth('customer')
                <a href="{{ route('customer.dashboard') }}" class="mobile-nav-links">Dashboard</a>
                <form method="POST" action="{{ route('customer.logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="mobile-nav-links w-full text-left">Logout</button>
                </form>
            @else
                <a href="{{ route('customer.login') }}" class="mobile-nav-links">Login</a>
                <a href="{{ route('customer.register') }}" class="mobile-nav-links">Sign Up</a>
            @endauth
            <div class="pt-6">
                <a href="{{ route('contact') }}" class="block w-full bg-(--primary-color) text-white text-center py-4 rounded-xl font-bold uppercase tracking-widest shadow-lg">
                    Contact Us
                </a>
            </div>
        </nav>
    </div>
</header>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const menuBtn = document.getElementById("menuBtn");
        const mobileMenu = document.getElementById("mobileMenu");
        const menuIcon = document.getElementById("menuIcon");

        menuBtn.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
            
            if (mobileMenu.classList.contains("hidden")) {
                menuIcon.innerText = "☰";
            } else {
                menuIcon.innerText = "✕";
            }
        });

        // Close menu when a link is clicked
        const links = mobileMenu.querySelectorAll('nav > a');
        links.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                menuIcon.innerText = "☰";
            });
        });

        // Mobile Service Sub-menu Toggle
        const mobileServiceToggle = document.getElementById("mobileServiceToggle");
        const mobileServiceMenu = document.getElementById("mobileServiceMenu");
        const mobileServiceIcon = document.getElementById("mobileServiceIcon");

        if (mobileServiceToggle) {
            mobileServiceToggle.addEventListener("click", () => {
                mobileServiceMenu.classList.toggle("active");
                mobileServiceIcon.classList.toggle("rotate-180");
            });
        }

        // Mobile Services (affiliates) sub-menu toggle
        const mobileServicesToggle = document.getElementById("mobileServicesToggle");
        const mobileServicesMenu = document.getElementById("mobileServicesMenu");
        const mobileServicesIcon = document.getElementById("mobileServicesIcon");
        if (mobileServicesToggle) {
            mobileServicesToggle.addEventListener("click", () => {
                mobileServicesMenu.classList.toggle("active");
                mobileServicesIcon.classList.toggle("rotate-180");
            });
        }

        // Mobile Security Training sub-menu toggle
        const mobileSecurityTrainingToggle = document.getElementById("mobileSecurityTrainingToggle");
        const mobileSecurityTrainingMenu = document.getElementById("mobileSecurityTrainingMenu");
        const mobileSecurityTrainingIcon = document.getElementById("mobileSecurityTrainingIcon");
        if (mobileSecurityTrainingToggle) {
            mobileSecurityTrainingToggle.addEventListener("click", () => {
                mobileSecurityTrainingMenu.classList.toggle("active");
                mobileSecurityTrainingIcon.classList.toggle("rotate-180");
            });
        }
    });
</script>



