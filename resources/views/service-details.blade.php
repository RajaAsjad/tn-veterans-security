@extends('layouts.web.master')

@php
    use Illuminate\Support\Str;
    $catLabels = [
        'security_training' => 'Security Training',
        'nra' => 'NRA',
        'red_cross' => 'Red Cross',
        'handgun_carry' => 'Handgun Carry Permit',
        'services' => 'Services',
    ];
@endphp

@section('content')
    <style>
        /* ---- Service details: advanced design ---- */
        .sd-page {
            --sd-radius: 20px;
            --sd-shadow: 0 10px 40px -12px rgba(0, 0, 0, .12);
            --sd-shadow-hover: 0 20px 50px -15px rgba(0, 0, 0, .18);
            --sd-primary: var(--primary-color);
        }

        .sd-hero {
            position: relative;
            min-height: 420px;
            display: flex;
            align-items: flex-end;
            overflow: hidden;
        }

        .sd-hero-bg {
            position: absolute;
            inset: 0;
        }

        .sd-hero-bg img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .sd-hero-shade {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, .4) 40%, rgba(0, 0, 0, .85) 100%);
        }

        .sd-hero-cap {
            position: relative;
            z-index: 2;
            width: 100%;
            padding: 3rem 0 2.5rem;
        }

        .sd-hero-title {
            font-family: var(--font-display);
            font-size: clamp(1.75rem, 4vw, 2.75rem);
            font-weight: 800;
            letter-spacing: 0.02em;
            text-shadow: 0 2px 12px rgba(0, 0, 0, .4);
        }

        .sd-hero-desc {
            font-size: 1rem;
            opacity: .95;
            max-width: 36rem;
            margin-top: .5rem;
        }

        .sd-card {
            background: #fff;
            border-radius: var(--sd-radius);
            box-shadow: var(--sd-shadow);
            border: 1px solid rgba(0, 0, 0, .04);
            overflow: hidden;
            transition: box-shadow .35s ease, transform .35s ease;
        }

        .sd-card:hover {
            box-shadow: var(--sd-shadow-hover);
            transform: translateY(-2px);
        }

        .sd-price-main {
            font-size: 2.25rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--sd-primary), var(--btn-hover-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .sd-badge {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .4rem .85rem;
            border-radius: 999px;
            font-size: .8rem;
            font-weight: 600;
        }

        .sd-badge-green {
            background: rgba(34, 197, 94, .12);
            color: #059669;
        }

        .sd-badge-primary {
            background: rgba(58, 166, 44, .12);
            color: var(--sd-primary);
        }

        .sd-badge-blue {
            background: rgba(59, 130, 246, .1);
            color: #2563eb;
        }

        .sd-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            padding: 1rem 1.5rem;
            border-radius: 14px;
            font-weight: 700;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: .03em;
            background: linear-gradient(135deg, var(--sd-primary), var(--btn-hover-color));
            color: #fff;
            box-shadow: 0 8px 24px -4px rgba(58, 166, 44, .35);
            transition: transform .2s, box-shadow .2s;
        }

        .sd-btn:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 12px 28px -4px rgba(58, 166, 44, .45);
        }

        .sd-detail-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0;
            border: 1px solid #f1f5f9;
            border-radius: 10px;
            overflow: hidden;
        }

        @media (min-width: 480px) {
            .sd-detail-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .sd-detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 0.75rem;
            padding: 0.625rem 1rem;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.875rem;
            min-width: 0;
        }

        @media (min-width: 640px) {
            .sd-detail-row {
                padding: .75rem 1.25rem;
                font-size: .9375rem;
            }
        }

        .sd-detail-row:last-child {
            border-bottom: 0;
        }

        @media (min-width: 480px) {
            .sd-detail-row:nth-child(odd):last-child {
                grid-column: 1 / -1;
            }
        }

        .sd-detail-label {
            color: #64748b;
            flex-shrink: 0;
            min-width: 0;
        }

        .sd-detail-value {
            font-weight: 600;
            color: #0f172a;
            text-align: right;
            min-width: 0;
            word-break: break-word;
        }

        .sd-rel-card {
            background: #fff;
            border-radius: var(--sd-radius);
            box-shadow: var(--sd-shadow);
            border: 1px solid rgba(0, 0, 0, .04);
            overflow: hidden;
            transition: box-shadow .4s ease, transform .4s ease, border-color .3s;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .sd-rel-card:hover {
            box-shadow: var(--sd-shadow-hover);
            transform: translateY(-4px);
            border-color: rgba(58, 166, 44, .15);
        }

        .sd-rel-card .sd-rel-img {
            height: 200px;
            overflow: hidden;
            background: #f1f5f9;
        }

        .sd-rel-card .sd-rel-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }

        .sd-rel-card:hover .sd-rel-img img {
            transform: scale(1.06);
        }

        .sd-rel-card .sd-rel-body {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .sd-rel-card .sd-rel-title {
            font-family: var(--font-display);
            font-size: 1.125rem;
            font-weight: 700;
            color: #0f172a;
            transition: color .2s;
        }

        .sd-rel-card a:hover .sd-rel-title {
            color: var(--sd-primary);
        }

        .sd-rel-price {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--sd-primary);
        }

        .sd-cta-box {
            background: linear-gradient(135deg, var(--sd-primary) 0%, var(--btn-hover-color) 100%);
            border-radius: var(--sd-radius);
            padding: 2rem;
            color: #fff;
            box-shadow: 0 12px 40px -12px rgba(58, 166, 44, .4);
        }

        .sd-cta-box .sd-btn-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            padding: .75rem 1.25rem;
            border-radius: 12px;
            font-weight: 600;
            background: rgba(255, 255, 255, .2);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, .3);
            transition: background .2s, border-color .2s;
        }

        .sd-cta-box .sd-btn-outline:hover {
            background: rgba(255, 255, 255, .3);
            color: #fff;
            border-color: rgba(255, 255, 255, .5);
        }

        .sd-form-label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.35rem;
        }

        .sd-form-input {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 0.9375rem;
            transition: border-color .2s, box-shadow .2s;
        }

        .sd-form-input:focus {
            outline: none;
            border-color: var(--sd-primary);
            box-shadow: 0 0 0 3px rgba(58, 166, 44, .15);
        }

        select.sd-form-input {
            cursor: pointer;
            appearance: auto;
        }

        .sd-desc {
            font-size: 1rem;
            line-height: 1.75;
            color: #475569;
        }

        .sd-desc h2,
        .sd-desc h3,
        .sd-desc h4 {
            color: #0f172a;
            font-weight: 700;
            margin-top: 1.5rem;
            margin-bottom: .5rem;
        }

        .sd-desc p {
            margin-bottom: 1rem;
        }

        .sd-desc ul,
        .sd-desc ol {
            margin: 1rem 0;
            padding-left: 1.5rem;
        }

        .sd-desc li {
            margin-bottom: .25rem;
        }

        /* ---- Responsive & advanced layout (below banner) ---- */
        .sd-page .sd-section {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        @media (min-width: 640px) {
            .sd-page .sd-section {
                padding-top: 2.5rem;
                padding-bottom: 2.5rem;
            }
        }

        @media (min-width: 1024px) {
            .sd-page .sd-section {
                padding-top: 3rem;
                padding-bottom: 3rem;
            }
        }

        .sd-page .sd-container {
            width: 100%;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        @media (min-width: 640px) {
            .sd-page .sd-container {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
                max-width: 1280px;
            }
        }

        @media (min-width: 1024px) {
            .sd-page .sd-container {
                padding-left: 2.5rem;
                padding-right: 2.5rem;
            }
        }

        .sd-card {
            border-radius: 12px;
        }

        @media (min-width: 640px) {
            .sd-card {
                border-radius: 16px;
            }
        }

        @media (min-width: 1024px) {
            .sd-card {
                border-radius: var(--sd-radius);
            }
        }

        .sd-rel-card .sd-rel-img {
            height: 180px;
        }

        @media (min-width: 640px) {
            .sd-rel-card .sd-rel-img {
                height: 200px;
            }
        }

        .sd-section-title {
            font-size: 1.125rem;
            letter-spacing: 0.05em;
        }

        @media (min-width: 640px) {
            .sd-section-title {
                font-size: 1.2rem;
            }
        }

        @media (min-width: 1024px) {
            .sd-section-title {
                font-size: 1.25rem;
            }
        }

        .sd-cta-box {
            padding: 1.5rem;
            border-radius: 16px;
        }

        @media (min-width: 640px) {
            .sd-cta-box {
                padding: 1.75rem;
                border-radius: 18px;
            }
        }

        @media (min-width: 1024px) {
            .sd-cta-box {
                padding: 2rem;
                border-radius: var(--sd-radius);
            }
        }

        /* Sub titles block (below banner, left) */
        .sd-sub-titles-card {
            background: #fff;
            border-radius: var(--sd-radius);
            box-shadow: var(--sd-shadow);
            border: 1px solid rgba(0, 0, 0, .04);
            overflow: hidden;
        }
        .sd-sub-titles-header {
            background: linear-gradient(135deg, var(--sd-primary) 0%, var(--btn-hover-color) 100%);
            color: #fff;
            padding: 0.875rem 1.25rem;
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: 0.02em;
        }
        .sd-sub-titles-list {
            border-top: 1px solid rgba(0, 0, 0, .06);
        }
        .sd-sub-titles-item {
            padding: 0.75rem 1.25rem;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.9375rem;
            color: #0f172a;
            font-weight: 500;
        }
        .sd-sub-titles-item:last-child {
            border-bottom: none;
        }
    </style>

    <main class="sd-page overflow-hidden bg-[#f8fafc]">

        {{-- Banner: always shows service image (or placeholder) --}}
        <section class="sd-hero">
            <div class="sd-hero-bg">
                @if ($service->image)
                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                @else
                    <img src="{{ asset('images/training-img-1.png') }}" alt="{{ $service->title }}">
                @endif
            </div>
            <div class="sd-hero-shade"></div>
            <div class="sd-hero-cap">
                <div class="container mx-auto px-4 lg:px-10">
                    <h1 class="sd-hero-title text-white">{{ $service->title }}</h1>
                    @if ($service->short_description)
                        <p class="sd-hero-desc text-white">{{ Str::limit($service->short_description, 160) }}</p>
                    @endif
                </div>
            </div>
        </section>

        {{-- Breadcrumb / back (below banner) --}}
        <!-- <div class="border-b border-gray-200/80 bg-white/80 backdrop-blur-sm sticky top-0 z-10">
                <div class="sd-container mx-auto py-3 sm:py-3.5">
                    <a href="{{ route('services') }}" class="inline-flex items-center gap-2 text-xs sm:text-sm font-medium text-gray-500 hover:text-[var(--primary-color)] transition-colors">
                        <i class="fas fa-arrow-left"></i> All training services
                    </a>
                </div>
            </div> -->

        {{-- Main + Sidebar --}}
        <section class="sd-section bg-[#f8fafc]">
            <div class="sd-container mx-auto">
                <div class="flex flex-col lg:flex-row flex-wrap gap-6 sm:gap-8 lg:gap-14">

                    {{-- Main column --}}
                    <div class="w-full lg:flex-[1_1_0] lg:min-w-0 space-y-5 sm:space-y-6 lg:space-y-8 order-2 lg:order-1">
                        {{-- Sub titles (below banner, left - from admin) --}}
                        @if ($service->sub_titles && count($service->sub_titles) > 0)
                            <div class="sd-sub-titles-card">
                                <div class="sd-sub-titles-header" style="font-family: var(--font-display);">
                                    {{ $service->title }}
                                </div>
                                <div class="sd-sub-titles-list">
                                    @foreach ($service->sub_titles as $subTitle)
                                        @if (trim($subTitle) !== '')
                                            <div class="sd-sub-titles-item">{{ $subTitle }}</div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- About --}}
                        @if ($service->description || $service->short_description)
                            <div class="sd-card p-5 sm:p-6 lg:p-8">
                                <h2 class="sd-section-title text-gray-900 font-bold uppercase tracking-wide mb-4 sm:mb-6 pb-3 border-b-2 border-[var(--primary-color)]"
                                    style="font-family: var(--font-display);">About this training</h2>
                                @if ($service->description)
                                    <div class="sd-desc">
                                        {!! $service->description !!}
                                    </div>
                                @else
                                    <p class="text-gray-600 leading-relaxed text-base sm:text-lg">
                                        {{ $service->short_description }}</p>
                                @endif
                            </div>
                        @endif
                       
                    </div>

                    {{-- Sidebar (Training details + sticky booking on lg) --}}
                    <div class="w-full lg:flex-[1_1_0] lg:min-w-0 order-1 lg:order-2">
                        {{-- Training details (badges) --}}
                        <div class="sd-card p-5 sm:p-6 lg:p-8 mb-6">
                            <h2 class="sd-section-title text-gray-900 font-bold uppercase tracking-wide mb-4 sm:mb-5 pb-3 border-b-2 border-[var(--primary-color)]"
                                style="font-family: var(--font-display);">Training details</h2>
                            <div class="flex flex-wrap gap-3">
                                @if ($service->class_type)
                                    <span class="sd-badge sd-badge-primary"><i class="fas fa-users"></i>
                                        {{ $service->class_type === 'one-on-one' ? 'One-on-One' : 'Group' }}</span>
                                @endif
                                @if ($service->has_online_parts)
                                    <span class="sd-badge sd-badge-blue"><i class="fas fa-globe"></i> Online
                                        components</span>
                                @endif
                                @if ($service->testing_in_person)
                                    <span class="sd-badge sd-badge-green"><i class="fas fa-clipboard-check"></i> In-person
                                        testing</span>
                                @endif
                                <span
                                    class="sd-badge {{ $service->is_active ? 'sd-badge-green' : 'bg-gray-100 text-gray-600' }}"><i
                                        class="fas fa-circle-check"></i>
                                    {{ $service->is_active ? 'Available' : 'Coming soon' }}</span>
                            </div>
                        </div>
                        @if ($service->requirements)
                        <div class="sd-card p-5 sm:p-6 lg:p-8">
                            <h2 class="sd-section-title text-gray-900 font-bold uppercase tracking-wide mb-4 sm:mb-6 pb-3 border-b-2 border-[var(--primary-color)]"
                                style="font-family: var(--font-display);">Requirements</h2>
                            <div class="sd-desc">
                                {!! $service->requirements !!}
                            </div>
                        </div>
                    @endif
                        <div class="w-full lg:flex-[2_1_0] lg:min-w-0 sd-card p-5 sm:p-6 lg:p-8 mt-6 sm:mt-8 lg:mt-10">
                            <h2 class="sd-section-title text-gray-900 font-bold uppercase tracking-wide mb-4 sm:mb-6 pb-3 border-b-2 border-[var(--primary-color)]"
                                style="font-family: var(--font-display);">All service details</h2>
                            <div class="sd-detail-grid">
                                @if ($service->categories && count($service->categories) > 0)
                                    <div class="sd-detail-row"><span class="sd-detail-label">Categories</span><span
                                            class="sd-detail-value">{{ collect($service->categories)->map(fn($c) => $catLabels[$c] ?? ucfirst(str_replace('_', ' ', $c)))->implode(', ') }}</span>
                                    </div>
                                @endif
                                @if ($service->subcategory)
                                    <div class="sd-detail-row"><span class="sd-detail-label">Subcategory</span><span
                                            class="sd-detail-value">{{ $service->subcategory }}</span></div>
                                @endif
                                @if ($service->price)
                                    <div class="sd-detail-row"><span class="sd-detail-label">Price</span><span
                                            class="sd-detail-value"
                                            style="color: var(--sd-primary);">${{ number_format($service->price, 2) }} /
                                            student</span></div>
                                @endif
                                @if ($service->deposit_amount)
                                    <div class="sd-detail-row"><span class="sd-detail-label">Deposit</span><span
                                            class="sd-detail-value text-emerald-600">${{ number_format($service->deposit_amount, 2) }}
                                            / student</span></div>
                                @endif
                                @if ($service->duration_hours)
                                    <div class="sd-detail-row"><span class="sd-detail-label">Duration</span><span
                                            class="sd-detail-value">{{ $service->duration_hours }}
                                            {{ Str::plural('hour', $service->duration_hours) }}</span></div>
                                @endif
                                {{-- @if ($service->max_students)
                            <div class="sd-detail-row"><span class="sd-detail-label">Max students</span><span class="sd-detail-value" >{{ $service->max_students }}</span></div>
                            @endif --}}
                                @if ($service->max_students !== null && $service->max_students > 0)
                                    @if (($service->current_students ?? 0) >= $service->max_students)
                                    <div class="sd-detail-row"><span class="sd-detail-label">Available Seats</span><span
                                        class="sd-detail-value text-danger">Class Full</span>
                                    </div>
                                    @else
                                    <div class="sd-detail-row"><span class="sd-detail-label">Available Seats</span><span
                                        class="sd-detail-value">{{ $service->max_students - ($service->current_students ?? 0) }}</span>
                                    </div>
                                    @endif
                                @endif
                                @if ($service->min_students)
                                    <div class="sd-detail-row"><span class="sd-detail-label">Min students</span><span
                                            class="sd-detail-value">{{ $service->min_students }}</span></div>
                                @endif
                                @if ($service->class_type)
                                    <div class="sd-detail-row"><span class="sd-detail-label">Class type</span><span
                                            class="sd-detail-value">{{ $service->class_type === 'one-on-one' ? 'One-on-One' : 'Group' }}</span>
                                    </div>
                                @endif
                                <div class="sd-detail-row"><span class="sd-detail-label">Online components</span><span
                                        class="sd-detail-value">{{ $service->has_online_parts ? 'Yes' : 'No' }}</span>
                                </div>
                                <div class="sd-detail-row"><span class="sd-detail-label">In-person testing</span><span
                                        class="sd-detail-value">{{ $service->testing_in_person ? 'Yes' : 'No' }}</span>
                                </div>
                                @if ($service->requires_dallas_law)
                                    <div class="sd-detail-row"><span class="sd-detail-label">Requires Dallas Law</span><span
                                            class="sd-detail-value text-amber-600">Yes</span></div>
                                @endif
                                @if ($service->requires_active_shooter)
                                    <div class="sd-detail-row"><span class="sd-detail-label">Requires Active
                                            Shooter</span><span class="sd-detail-value text-amber-600">Yes</span></div>
                                @endif
                                <div class="sd-detail-row"><span class="sd-detail-label">Status</span><span
                                        class="sd-detail-value {{ $service->is_active ? 'text-emerald-600' : 'text-gray-500' }}">{{ $service->is_active ? 'Available' : 'Coming soon' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="sd-cta-box mt-6 sm:mt-8 lg:mt-10">
                            <h3 class="text-base sm:text-lg font-bold text-white uppercase tracking-wide mb-1.5 sm:mb-2"
                                style="font-family: var(--font-display);">Questions?</h3>
                            <p class="text-white/90 text-xs sm:text-sm mb-4 sm:mb-5">Contact us for enrollment and
                                schedules.</p>
                            <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
                                <a href="{{ route('contact') }}" class="sd-btn-outline flex-1 justify-center"><i
                                        class="fas fa-envelope"></i> Contact</a>
                                @if ($siteSettings && $siteSettings->phone)
                                    <a href="tel:{{ str_replace([' ', '-', '(', ')'], '', $siteSettings->phone) }}"
                                        class="sd-btn-outline flex-1 justify-center"><i class="fas fa-phone"></i> Call</a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="flex flex-col lg:flex-row flex-wrap gap-6 sm:gap-8 lg:gap-14 mt-6 sm:mt-8 lg:mt-10">
                    {{-- All service details --}}

                    <div class="w-full lg:flex-[1_1_0] lg:min-w-0">
                        <div class="lg:sticky lg:top-24 space-y-4 sm:space-y-5 lg:space-y-6">
                            @if ($service->is_active)
                                <div class="sd-card p-5 sm:p-6 lg:p-8">
                                    <h3 class="sd-section-title text-lg font-bold text-gray-900 uppercase tracking-wide mb-4 sm:mb-5"
                                        style="font-family: var(--font-display);">Pricing & booking</h3>
                                    @if ($service->price)
                                        <div class="sd-price-main text-2xl sm:text-[2rem] lg:text-[2.25rem]">
                                            ${{ number_format($service->price, 2) }}</div>
                                        <p class="text-gray-500 text-xs sm:text-sm mt-1">per student</p>
                                    @endif
                                    @if (!$service->price && !$service->deposit_amount)
                                        <p class="text-gray-500 text-sm">Pricing available on class schedules.</p>
                                    @endif

                                    {{-- Simple booking form (account created automatically if new) --}}
                                    <p class="text-xs text-gray-500 mt-4 mb-2">No account? We'll create one for you when
                                        you book.</p>
                                    <form action="{{ route('service.booking.inquiry', $service) }}" method="POST"
                                        class="mt-2 pt-4 border-t border-gray-200 space-y-4">
                                        @csrf
                                        <div>
                                            <label for="booking_name" class="sd-form-label">Name <span
                                                    class="text-red-500">*</span></label>
                                            <input type="text" name="name" id="booking_name"
                                                value="{{ old('name') }}" required maxlength="255"
                                                class="sd-form-input @error('name') border-red-400 @enderror"
                                                placeholder="Your full name">
                                            @error('name')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="booking_email" class="sd-form-label">Email <span
                                                    class="text-red-500">*</span></label>
                                            <input type="email" name="email" id="booking_email"
                                                value="{{ old('email') }}" required
                                                class="sd-form-input @error('email') border-red-400 @enderror"
                                                placeholder="your@email.com">
                                            @error('email')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="booking_phone" class="sd-form-label">Phone</label>
                                            <input type="text" name="phone" id="booking_phone"
                                                value="{{ old('phone') }}" maxlength="50"
                                                class="sd-form-input @error('phone') border-red-400 @enderror"
                                                placeholder="(555) 000-0000">
                                            @error('phone')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        @php
                                            $availableSeats = ($service->max_students ?? 0) - ($service->current_students ?? 0);
                                        @endphp
                                        <div>
                                            <label for="booking_number_of_students" class="sd-form-label">Number of
                                                students (Available Seats: {{ $availableSeats }})</label>
                                            <input type="number" name="number_of_students"
                                                id="booking_number_of_students"
                                                value="{{ old('number_of_students', 1) }}"
                                                min="{{ $service->min_students ?? 1 }}" max="{{ max(1, $availableSeats) }}"
                                                class="sd-form-input @error('number_of_students') border-red-400 @enderror"
                                                placeholder="1">
                                            @error('number_of_students')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="booking_location" class="sd-form-label">Location</label>
                                            <select name="location" id="booking_location"
                                                class="sd-form-input @error('location') border-red-400 @enderror">
                                                <option value="">Any location</option>
                                                @foreach ($bookingLocations ?? collect() as $loc)
                                                    <option value="{{ $loc }}"
                                                        {{ old('location') == $loc ? 'selected' : '' }}>
                                                        {{ $loc }}</option>
                                                @endforeach
                                            </select>
                                            @error('location')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="booking_preferred_date" class="sd-form-label">Preferred
                                                date</label>
                                            @php
                                                $dates = $availableDates ?? [];
                                                $minDate = count($dates) ? min($dates) : now()->toDateString();
                                                $maxDate = count($dates) ? max($dates) : '';
                                            @endphp
                                            <input type="date" name="preferred_date" id="booking_preferred_date"
                                                value="{{ old('preferred_date') }}" min="{{ $minDate }}"
                                                @if ($maxDate) max="{{ $maxDate }}" @endif
                                                class="sd-form-input @error('preferred_date') border-red-400 @enderror">
                                            @error('preferred_date')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <button type="submit"
                                            class="sd-btn w-full mt-2 py-3 sm:py-4 text-sm sm:text-base">
                                            <i class="fas fa-calendar-check"></i> Book Now
                                        </button>
                                    </form>
                                </div>
                            @endif


                        </div>
                    </div>
                </div>
        </section>

        {{-- Related services --}}
        @if ($relatedServices->count() > 0)
            <section class="sd-section py-10 sm:py-12 lg:py-16 xl:py-20 bg-white border-t border-gray-100">
                <div class="sd-container mx-auto">
                    <div class="text-center mb-8 sm:mb-10 lg:mb-12">
                        <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 uppercase tracking-wide px-2"
                            style="font-family: var(--font-display);">
                            @if (isset($linkedServices) && $linkedServices->isNotEmpty())
                                Related <span class="text-[var(--primary-color)]">trainings</span>
                            @else
                                Other <span class="text-[var(--primary-color)]">services</span>
                            @endif
                        </h2>
                        <p class="text-gray-500 mt-2 sm:mt-3 max-w-xl mx-auto text-xs sm:text-sm lg:text-base px-4">
                            @if (isset($linkedServices) && $linkedServices->isNotEmpty())
                                Prerequisites or related courses for this program.
                            @else
                                More training programs you may be interested in.
                            @endif
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5 lg:gap-6 xl:gap-8">
                        @foreach ($relatedServices as $index => $rel)
                            <a href="{{ route('service.details', $rel->id) }}"
                                class="sd-rel-card group block w-full">
                                <div class="sd-rel-img">
                                    @if ($rel->image)
                                        <img src="{{ asset('storage/' . $rel->image) }}" alt="{{ $rel->title }}">
                                    @else
                                        <img src="{{ asset('images/training-img-' . (($index % 6) + 1) . '.png') }}"
                                            alt="{{ $rel->title }}">
                                    @endif
                                </div>
                                <div class="sd-rel-body p-4 sm:p-5 lg:p-6">
                                    <h3 class="sd-rel-title mb-1.5 sm:mb-2 text-base sm:text-lg">{{ $rel->title }}</h3>
                                    @if ($rel->short_description)
                                        <p
                                            class="text-gray-500 text-xs sm:text-sm leading-relaxed mb-3 sm:mb-4 flex-1 line-clamp-3">
                                            {{ Str::limit($rel->short_description, 110) }}</p>
                                    @endif
                                    <div class="space-y-1 text-xs sm:text-sm mb-3 sm:mb-4">
                                        @if ($rel->categories && count($rel->categories) > 0)
                                            <p class="text-gray-400"><span
                                                    class="text-gray-600 font-medium">Categories:</span>
                                                {{ collect($rel->categories)->map(fn($c) => $catLabels[$c] ?? ucfirst(str_replace('_', ' ', $c)))->implode(', ') }}
                                            </p>
                                        @endif
                                        @if ($rel->price)
                                            <p class="sd-rel-price">${{ number_format($rel->price, 2) }} <span
                                                    class="text-gray-400 font-normal text-xs">/ student</span></p>
                                        @endif
                                        @if ($rel->deposit_amount)
                                            <p class="text-emerald-600 font-semibold text-xs">Deposit
                                                ${{ number_format($rel->deposit_amount, 2) }}</p>
                                        @endif
                                        @if (!$rel->price && !$rel->deposit_amount)
                                            <p class="text-gray-400 text-xs">View details for pricing</p>
                                        @endif
                                    </div>
                                    <span
                                        class="inline-flex items-center gap-2 text-[var(--primary-color)] font-semibold text-xs sm:text-sm group-hover:gap-3 transition-all">
                                        View details <i class="fas fa-arrow-right text-xs"></i>
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="mt-8 sm:mt-10 lg:mt-12 text-center">
                        <a href="{{ route('services') }}"
                            class="inline-flex items-center gap-2 text-[var(--primary-color)] font-semibold hover:underline text-xs sm:text-sm py-2">
                            <i class="fas fa-arrow-left"></i> View all services
                        </a>
                    </div>
                </div>
            </section>
        @endif

    </main>
@endsection
