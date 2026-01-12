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
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0">
                            <img src="{{ asset('images/footer-mobile-icon.png') }}" alt="Phone" class="w-full h-full object-cover">
                        </div>
                        <a href="tel:6155541131" class="contact-link">
                            615-554-1131
                        </a>
                    </div>
                    <!-- Email -->
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0">
                            <img src="{{ asset('images/footer-mail-icon.png') }}" alt="Email" class="w-full h-full object-cover">
                        </div>
                        <a href="mailto:tnvetsecsvctrng@gmail.com" class="contact-link">
                            tnvetsecsvctrng@gmail.com
                        </a>
                    </div>
                </div>
</div>

            <!-- Center Logo -->
            <div class="flex flex-col items-center justify-center lg:-mt-10">
                <img src="{{ asset('images/securty-logo.png') }}" 
                     alt="TN Veterans Logo" 
                     class="w-auto h-48 md:h-64 lg:h-72 drop-shadow-2xl mb-6">
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
