<!-- Premium Header Section -->
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
            <nav class="desktop-nav hidden lg:flex items-center space-x-10 text-[18px] font-medium text-[#333333]">
                <a href="{{ url('/') }}" class="destop-nav-link">Home</a>
                <a href="{{ route('about') }}" class="destop-nav-link">About Us</a>
                <a href="{{ route('services') }}" class="destop-nav-link">Training Services</a>
                <a href="{{ route('certified') }}" class="destop-nav-link">Get Certified</a>
                <a href="{{ route('testimonials') }}" class="destop-nav-link">Testimonials</a>
                <a href="{{ route('contact') }}" class="destop-nav-link">Contact Us</a>
            </nav>

            <!-- Desktop Button (Far Right) -->
            <div class="hidden lg:flex items-center">
                <a href="{{ route('contact') }}" class="btn primary-button">
                    Contact Us
                </a>
            </div>

            <!-- Hamburger Button (<1024px) -->
            <button id="menuBtn" class="lg:hidden text-3xl text-gray-800 focus:outline-none p-2">
                <span id="menuIcon">☰</span>
            </button>
        </div>
    </div>

    <!-- Mobile Menu Vertical List -->
    <div id="mobileMenu" class="hidden lg:hidden   overflow-hidden transition-all duration-300">
        <nav class="mobile-nav-links flex flex-col p-6 space-y-1 mt-[60px]">
            <a href="{{ url('/') }}" class="mobile-nav-links">Home</a>
            <a href="{{ route('about') }}" class="mobile-nav-links">About Us</a>
            <a href="{{ route('services') }}" class="mobile-nav-links">Training Services</a>
            <a href="{{ route('certified') }}" class="mobile-nav-links">Get Certified</a>
            <a href="{{ route('testimonials') }}" class="mobile-nav-links">Testimonials</a>
            <a href="{{ route('contact') }}" class="mobile-nav-links">Contact Us</a>
            <div class="pt-6">
                <a href="{{ route('contact') }}" class="block w-full bg-[var(--primary-color)] text-white text-center py-4 rounded-xl font-bold uppercase tracking-widest shadow-lg">
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
        const links = mobileMenu.querySelectorAll('nav a');
        links.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                menuIcon.innerText = "☰";
            });
        });
    });
</script>


