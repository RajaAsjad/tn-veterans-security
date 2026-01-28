@extends('layouts.web.master')

@section('content')
    <main class="overflow-hidden">
        
        <!-- Inner Hero Section -->
        <section class="inner-hero">
            <div class="inner-hero-overlay"></div>
            <div class="container mx-auto px-4 lg:px-10 relative z-10">
                <div class="max-w-[1000px]">
                    <h2 class="inner-hero-title" data-aos="fade-down" data-aos-duration="1000">
                        STUDENT <span class="text-[var(--primary-color)]">TESTIMONIALS</span>
                    </h2>
                    <p class="inner-hero-subtext" data-aos="fade-up" data-aos-delay="200">
                        See What Our Successful Graduates Are Saying About Their Training Experience.
                    </p>
                </div>
            </div>
        </section>

        <!-- Testimonials Grid Section -->
        <section class="py-16 lg:py-24 bg-white">
            <div class="container mx-auto px-4 lg:px-10">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    
                    <!-- Testimonial 1 -->
                    <div class="testimonial-page-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-16 h-16 rounded-full bg-gray-200 overflow-hidden">
                                <img src="https://ui-avatars.com/api/?name=James+Wilson&background=random" alt="James Wilson" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-bold text-[18px]">James Wilson</h4>
                                <p class="text-[var(--primary-color)] text-[14px] uppercase font-bold">Security Officer</p>
                            </div>
                        </div>
                        <div class="relative">
                            <svg class="absolute -top-4 -left-2 w-8 h-8 text-gray-100 -z-10" fill="currentColor" viewBox="0 0 32 32"><path d="M10 8v8H6v12h12V16h-4v-8h-4zm14 0v8h-4v12h12V16h-4v-8h-4z"></path></svg>
                            <p class="text-[#555] italic leading-relaxed">"The training I received was top-notch. The instructors, being veterans themselves, brought a level of realism and discipline that you just don't find elsewhere. I was hired within a week of getting certified."</p>
                        </div>
                        <div class="mt-6 flex text-[#F6CB42]">
                            @for($i=0; $i<5; $i++)
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            @endfor
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="testimonial-page-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-16 h-16 rounded-full bg-gray-200 overflow-hidden">
                                <img src="https://ui-avatars.com/api/?name=Sarah+Johnson&background=random" alt="Sarah Johnson" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-bold text-[18px]">Sarah Johnson</h4>
                                <p class="text-[var(--primary-color)] text-[14px] uppercase font-bold">Unarmed Guard</p>
                            </div>
                        </div>
                        <div class="relative">
                            <svg class="absolute -top-4 -left-2 w-8 h-8 text-gray-100 -z-10" fill="currentColor" viewBox="0 0 32 32"><path d="M10 8v8H6v12h12V16h-4v-8h-4zm14 0v8h-4v12h12V16h-4v-8h-4z"></path></svg>
                            <p class="text-[#555] italic leading-relaxed">"As someone new to the industry, I was a bit nervous. But the instructors made everything so clear and easy to understand. I highly recommend their de-escalation training – it's been invaluable in my daily work."</p>
                        </div>
                        <div class="mt-6 flex text-[#F6CB42]">
                            @for($i=0; $i<5; $i++)
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            @endfor
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="testimonial-page-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-16 h-16 rounded-full bg-gray-200 overflow-hidden">
                                <img src="https://ui-avatars.com/api/?name=Michael+Chen&background=random" alt="Michael Chen" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-bold text-[18px]">Michael Chen</h4>
                                <p class="text-[var(--primary-color)] text-[14px] uppercase font-bold">Armed Guard</p>
                            </div>
                        </div>
                        <div class="relative">
                            <svg class="absolute -top-4 -left-2 w-8 h-8 text-gray-100 -z-10" fill="currentColor" viewBox="0 0 32 32"><path d="M10 8v8H6v12h12V16h-4v-8h-4zm14 0v8h-4v12h12V16h-4v-8h-4z"></path></svg>
                            <p class="text-[#555] italic leading-relaxed">"The firearms training was exceptional. Safety was always the first priority, and the tactical insights shared by the instructors were far beyond what I expected. Best choice for professional certification."</p>
                        </div>
                        <div class="mt-6 flex text-[#F6CB42]">
                            @for($i=0; $i<5; $i++)
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            @endfor
                        </div>
                    </div>

                    <!-- Testimonial 4 -->
                    <div class="testimonial-page-card" data-aos="fade-up" data-aos-delay="400">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-16 h-16 rounded-full bg-gray-200 overflow-hidden">
                                <img src="https://ui-avatars.com/api/?name=Robert+Davis&background=random" alt="Robert Davis" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-bold text-[18px]">Robert Davis</h4>
                                <p class="text-[var(--primary-color)] text-[14px] uppercase font-bold">Patrol Officer</p>
                            </div>
                        </div>
                        <div class="relative">
                            <svg class="absolute -top-4 -left-2 w-8 h-8 text-gray-100 -z-10" fill="currentColor" viewBox="0 0 32 32"><path d="M10 8v8H6v12h12V16h-4v-8h-4zm14 0v8h-4v12h12V16h-4v-8h-4z"></path></svg>
                            <p class="text-[#555] italic leading-relaxed">"Renewing my certifications here was a breeze. They stay updated with all state regulations and the process is very efficient. I won't go anywhere else for my future training needs."</p>
                        </div>
                        <div class="mt-6 flex text-[#F6CB42]">
                            @for($i=0; $i<5; $i++)
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            @endfor
                        </div>
                    </div>

                    <!-- Testimonial 5 -->
                    <div class="testimonial-page-card" data-aos="fade-up" data-aos-delay="500">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-16 h-16 rounded-full bg-gray-200 overflow-hidden">
                                <img src="https://ui-avatars.com/api/?name=Emily+Rodriguez&background=random" alt="Emily Rodriguez" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-bold text-[18px]">Emily Rodriguez</h4>
                                <p class="text-[var(--primary-color)] text-[14px] uppercase font-bold">First Responder</p>
                            </div>
                        </div>
                        <div class="relative">
                            <svg class="absolute -top-4 -left-2 w-8 h-8 text-gray-100 -z-10" fill="currentColor" viewBox="0 0 32 32"><path d="M10 8v8H6v12h12V16h-4v-8h-4zm14 0v8h-4v12h12V16h-4v-8h-4z"></path></svg>
                            <p class="text-[#555] italic leading-relaxed">"The Red Cross training was fantastic. The instructor was patient and made sure we all felt confident in our skills. I feel much better prepared for any emergency situation now."</p>
                        </div>
                        <div class="mt-6 flex text-[#F6CB42]">
                            @for($i=0; $i<5; $i++)
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            @endfor
                        </div>
                    </div>

                    <!-- Testimonial 6 -->
                    <div class="testimonial-page-card" data-aos="fade-up" data-aos-delay="600">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-16 h-16 rounded-full bg-gray-200 overflow-hidden">
                                <img src="https://ui-avatars.com/api/?name=David+Martinez&background=random" alt="David Martinez" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-bold text-[18px]">David Martinez</h4>
                                <p class="text-[var(--primary-color)] text-[14px] uppercase font-bold">Event Security</p>
                            </div>
                        </div>
                        <div class="relative">
                            <svg class="absolute -top-4 -left-2 w-8 h-8 text-gray-100 -z-10" fill="currentColor" viewBox="0 0 32 32"><path d="M10 8v8H6v12h12V16h-4v-8h-4zm14 0v8h-4v12h12V16h-4v-8h-4z"></path></svg>
                            <p class="text-[#555] italic leading-relaxed">"Practical, useful, and professional. The ASP instructor program exceeded my expectations. If you want the best training in Tennessee, this is the place to be."</p>
                        </div>
                        <div class="mt-6 flex text-[#F6CB42]">
                            @for($i=0; $i<5; $i++)
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            @endfor
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Ready to take selection (Reused) -->
        <section class="ready-section">
            <div class="container mx-auto px-4 lg:px-10 relative z-10">
                <div class="text-left md:text-center lg:text-left md:mx-auto lg:mx-0">
                    <h2 class="mb-5" data-aos="fade-up">
                        <span class="block text-[18px] md:text-[24px] text-white font-normal">Ready to join our</span>
                        <span class="block text-[30px] md:text-[45px] font-black leading-tight uppercase">
                            <span class="text-[#F6CB42]">SUCCESSFUL</span> <span class="text-[#FFFFFF]">GRADUATES?</span>
                        </span>
                    </h2>
                    <p class="text-[16px] md:text-[20px] text-white font-normal mb-8 md:mx-auto lg:mx-0" data-aos="fade-up" data-aos-delay="200">
                        Enroll today and start your journey towards becoming a certified security professional.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-start md:justify-center lg:justify-start" data-aos="fade-up" data-aos-delay="400">
                        <a href="#" class="btn primary-button !text-center">Start Your Training</a>
                        <a href="#" class="btn secondary-button !text-center">Contact Us</a>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
