<!-- Premium Footer Section -->
<footer class="bg-[#161616] text-white pt-16 pb-0">
    <div class="container mx-auto px-4 lg:px-10">
        <div class="footer-content">
            
            <!-- Quick Links -->
            <div>
                <h4 class="footer-title">
                    Quick Links
                </h4>
                <ul class="footer-ul">
                    <li><a href="{{ url('/') }}" class="footer-link">Home</a></li>
                    <li><a href="{{ route('about') }}" class="footer-link">About Us</a></li>
                    <li><a href="{{ route('services') }}" class="footer-link">Training Services</a></li>
                <li><a href="{{ route('certified') }}" class="footer-link">Get Certified</a></li>
                    <li><a href="{{ route('testimonials') }}" class="footer-link">Testimonials</a></li>
                    <li><a href="{{ route('contact') }}" class="footer-link">Contact Us</a></li>
                </ul>
            </div>

          <!-- Contact Information -->
            <div>
                <h4 class="footer-title">
                    Contact Information
                </h4>
                <div class="space-y-6">
                    <!-- Phone -->
                    @if($siteSettings && $siteSettings->phone)
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0">
                                <img src="{{ asset('images/footer-mobile-icon.png') }}" alt="Phone" class="w-full h-full object-cover">
                            </div>
                            <a href="tel:{{ str_replace([' ', '-', '(', ')'], '', $siteSettings->phone) }}" class="contact-link">
                                {{ $siteSettings->phone }}
                            </a>
                        </div>
                    @endif
                    <!-- Email -->
                    @if($siteSettings && $siteSettings->email)
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0">
                                <img src="{{ asset('images/footer-mail-icon.png') }}" alt="Email" class="w-full h-full object-cover">
                            </div>
                            <a href="mailto:{{ $siteSettings->email }}" class="contact-link">
                                {{ $siteSettings->email }}
                            </a>
                        </div>
                    @endif
                    <!-- Address -->
                    @if($siteSettings && $siteSettings->address)
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0">
                                <svg class="w-full h-full text-white p-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <p class="contact-link">{{ $siteSettings->address }}</p>
                        </div>
                    @endif
                </div>
</div>

            <!-- Center Logo -->
            <div class="flex flex-col items-center justify-center lg:-mt-10">
                @if($siteSettings && $siteSettings->footer_logo)
                    <img src="{{ asset('storage/' . $siteSettings->footer_logo) }}" 
                         alt="TN Veterans Logo" 
                         class="w-auto h-48 md:h-64 lg:h-72 drop-shadow-2xl mb-6">
                @else
                    <img src="{{ asset('images/securty-logo.png') }}" 
                         alt="TN Veterans Logo" 
                         class="w-auto h-48 md:h-64 lg:h-72 drop-shadow-2xl mb-6">
                @endif
            </div>
   <!-- Training Programs -->
            <div>
                <h4 class="footer-title">
                    Training Programs
                </h4>
                <ul class="footer-ul">
                    <li><a href="#" class="footer-link">Armed Security Training</a></li>
                    <li><a href="#" class="footer-link">Unarmed Security Training</a></li>
                    <li><a href="#" class="footer-link">Handgun Carry Permit</a></li>
                    <li><a href="#" class="footer-link">Certification Renewal</a></li>
                    <li><a href="#" class="footer-link">Job Placement Assistance</a></li>
                </ul>
            </div>
           

        </div>
    </div>

    <!-- Social Media Links -->
    @if($siteSettings && ($siteSettings->facebook_url || $siteSettings->twitter_url || $siteSettings->instagram_url || $siteSettings->linkedin_url || $siteSettings->youtube_url))
        <div class="bg-[#1a1a1a] py-8">
            <div class="container mx-auto px-4 lg:px-10">
                <div class="flex justify-center gap-6">
                    @if($siteSettings->facebook_url)
                        <a href="{{ $siteSettings->facebook_url }}" target="_blank" rel="noopener noreferrer" class="w-12 h-12 bg-gray-700 hover:bg-blue-600 rounded-full flex items-center justify-center transition-colors">
                            <i class="fab fa-facebook-f text-white"></i>
                        </a>
                    @endif
                    @if($siteSettings->twitter_url)
                        <a href="{{ $siteSettings->twitter_url }}" target="_blank" rel="noopener noreferrer" class="w-12 h-12 bg-gray-700 hover:bg-blue-400 rounded-full flex items-center justify-center transition-colors">
                            <i class="fab fa-twitter text-white"></i>
                        </a>
                    @endif
                    @if($siteSettings->instagram_url)
                        <a href="{{ $siteSettings->instagram_url }}" target="_blank" rel="noopener noreferrer" class="w-12 h-12 bg-gray-700 hover:bg-pink-600 rounded-full flex items-center justify-center transition-colors">
                            <i class="fab fa-instagram text-white"></i>
                        </a>
                    @endif
                    @if($siteSettings->linkedin_url)
                        <a href="{{ $siteSettings->linkedin_url }}" target="_blank" rel="noopener noreferrer" class="w-12 h-12 bg-gray-700 hover:bg-blue-700 rounded-full flex items-center justify-center transition-colors">
                            <i class="fab fa-linkedin-in text-white"></i>
                        </a>
                    @endif
                    @if($siteSettings->youtube_url)
                        <a href="{{ $siteSettings->youtube_url }}" target="_blank" rel="noopener noreferrer" class="w-12 h-12 bg-gray-700 hover:bg-red-600 rounded-full flex items-center justify-center transition-colors">
                            <i class="fab fa-youtube text-white"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <!-- Bottom Copyright Bar -->
    <div class="bg-[var(--primary-color)] py-6 mt-10">
        <div class="container mx-auto px-4 text-center">
            <p class="text-[#FFFFFF]  text-[18px] font-regular tracking-wide">
                &copy; {{ date('Y') }} Tn Veterans Security Services and Training. All Rights Reserved.
            </p>
        </div>
    </div>
</footer>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000,
    once: false,
  });
</script>
</body>
</html>
