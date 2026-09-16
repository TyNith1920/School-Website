@extends('layout')

@section('title', __('Tuition & Fees - Life International School'))

@section('content')

@php
    $themes = [
        'yellow' => [
            'accent' => '#f59e0b',
            'dark'   => '#b45309',
            'soft'   => '#fffbeb',
        ],
        'green' => [
            'accent' => '#10b981',
            'dark'   => '#047857',
            'soft'   => '#ecfdf5',
        ],
        'blue' => [
            'accent' => '#2563eb',
            'dark'   => '#1d4ed8',
            'soft'   => '#eff6ff',
        ],
        'red' => [
            'accent' => '#ef4444',
            'dark'   => '#b91c1c',
            'soft'   => '#fef2f2',
        ],
        'purple' => [
            'accent' => '#8b5cf6',
            'dark'   => '#6d28d9',
            'soft'   => '#f5f3ff',
        ],
    ];
@endphp

<style>
    .fee-card {
        --fee-accent: #f59e0b;
        --fee-dark: #b45309;
        --fee-soft: #fffbeb;
        border-color: #e2e8f0;
    }

    .fee-card:hover {
        border-color: var(--fee-accent);
    }

    .fee-accent-bg {
        background-color: var(--fee-accent);
    }

    .fee-soft-bg {
        background-color: var(--fee-soft);
    }

    .fee-accent-text {
        color: var(--fee-dark);
    }

    .fee-accent-border {
        border-color: var(--fee-accent);
    }

    .fee-button {
        background-color: var(--fee-accent);
    }

    .fee-button:hover {
        filter: brightness(0.92);
    }
</style>

<div class="min-h-screen bg-slate-50">

    {{-- Modern High-End Tuition & Fees Hero Banner --}}
    <section class="relative isolate flex min-h-[460px] md:min-h-[560px] items-center justify-center overflow-hidden bg-gradient-to-br from-[#061238] via-[#0d276b] to-[#1a4a9c]">
        
        {{-- Subtle Luxury Geometric Dot Grid --}}
        <div class="absolute inset-0 opacity-15 pointer-events-none"
             style="background-image: radial-gradient(circle, rgba(255,255,255,0.85) 1px, transparent 1px); background-size: 26px 26px;">
        </div>

        {{-- Floating Ambient Glow Orbs (Gold & Emerald/Cyan) --}}
        <div class="absolute -top-24 -left-20 h-96 w-96 rounded-full bg-amber-400/20 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-28 -right-20 h-[420px] w-[420px] rounded-full bg-emerald-400/15 blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 h-80 w-80 rounded-full bg-blue-500/15 blur-[100px] pointer-events-none"></div>

        <div class="relative z-10 mx-auto max-w-5xl px-6 pt-20 pb-32 text-center">
            
            {{-- Category Pill --}}
            <div data-aos="fade-down" class="mb-5 inline-flex items-center gap-2 rounded-full border border-amber-300/30 bg-amber-400/10 px-5 py-1.5 text-xs md:text-sm font-bold uppercase tracking-[0.2em] text-amber-200 backdrop-blur-md shadow-sm">
                <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                {{ __('Investment in Excellence') }}
            </div>

            {{-- Main Title with Gradient Text --}}
            <h1 data-aos="zoom-in" data-aos-delay="100" class="text-4xl sm:text-5xl md:text-7xl font-black uppercase tracking-tight text-white drop-shadow-2xl">
                {{ __('Tuition') }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-orange-300 to-amber-400">&</span> {{ __('Fees') }}
            </h1>

            {{-- Small Accent Bar --}}
            <div data-aos="zoom-in" data-aos-delay="200" class="mx-auto mt-5 mb-6 h-1.5 w-20 rounded-full bg-gradient-to-r from-amber-400 to-orange-400 shadow-[0_0_15px_rgba(251,191,36,0.5)]"></div>

            {{-- Subtitle --}}
            <p data-aos="fade-up" data-aos-delay="300" class="mx-auto max-w-2xl text-base sm:text-lg md:text-xl font-light leading-relaxed text-blue-100 drop-shadow">
                {{ __('Transparent, high-value investment in your child’s holistic education, global character, and bright future.') }}
            </p>

            {{-- Quick Benefits / Feature Badges --}}
            <div data-aos="fade-up" data-aos-delay="400" class="mt-8 flex flex-wrap items-center justify-center gap-3 text-xs md:text-sm text-white/90">
                <div class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-4 py-2 border border-white/15 backdrop-blur-sm shadow-sm">
                    <svg class="h-4 w-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>{{ __('Transparent Pricing') }}</span>
                </div>
                <div class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-4 py-2 border border-white/15 backdrop-blur-sm shadow-sm">
                    <svg class="h-4 w-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>{{ __('Flexible Monthly & Annual Plans') }}</span>
                </div>
                <div class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-4 py-2 border border-white/15 backdrop-blur-sm shadow-sm">
                    <svg class="h-4 w-4 text-cyan-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>{{ __('International Standards') }}</span>
                </div>
            </div>
        </div>

        {{-- 📍 ជម្រើសទី ១: Dual-Layer Wave ជាមួយស្រទាប់មាស/ទឹកក្រូច --}}
        <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none z-20 pointer-events-none">
            <svg class="relative block w-full h-14 sm:h-18 md:h-24" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <!-- ស្រទាប់ទី ១: រលកពណ៌មាសស្រាលពីក្រោយ -->
                <path d="M0,0 C150,90 400,-30 650,45 C900,120 1050,20 1200,55 L1200,120 L0,120 Z" fill="rgba(251, 191, 36, 0.28)"></path>
                <!-- ស្រទាប់ទី ២: រលកពណ៌ផ្ទៃខាងក្រោម (#f8fafc / slate-50) -->
                <path d="M0,25 C200,80 450,15 700,55 C950,95 1100,25 1200,45 L1200,120 L0,120 Z" fill="#f8fafc"></path>
            </svg>
        </div>
    </section>

    {{-- Fee section --}}
    <section class="px-5 py-16 md:px-8 md:py-20">
        <div class="mx-auto max-w-7xl">
            <div class="mx-auto mb-14 max-w-3xl text-center">
                <div class="mb-4 flex items-center justify-center gap-3">
                    <span class="h-1 w-10 rounded-full bg-orange-500"></span>

                    <span class="text-sm font-bold uppercase tracking-[0.18em] text-orange-500">
                        {{ __('Choose a Program') }}
                    </span>

                    <span class="h-1 w-10 rounded-full bg-orange-500"></span>
                </div>

                <h2 class="text-3xl font-black text-[#081747] md:text-4xl">
                    {{ __('Find the Right Program for Your Child') }}
                </h2>

                <p class="mt-5 text-base leading-7 text-slate-600 md:text-lg">
                    {{ __('Review our available programs, schedules and tuition fees. Contact our admissions team if you need help choosing.') }}
                </p>
            </div>

            @if(count($tuitionFees) > 0)
                <div class="flex flex-wrap justify-center gap-7">
                    @foreach($tuitionFees as $fee)
                        @php
                            $theme = $themes[$fee->theme_color]
                                ?? $themes['yellow'];
                        @endphp

                        <article
                            data-aos="fade-up"
                            data-aos-delay="150"

                            class="fee-card group flex w-full max-w-[380px] flex-col overflow-hidden rounded-[26px] border bg-white shadow-[0_12px_40px_rgba(15,23,42,0.08)] transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_24px_55px_rgba(15,23,42,0.16)] sm:w-[calc(50%_-_0.875rem)] lg:w-[calc(33.333%_-_1.2rem)] xl:w-[calc(25%_-_1.35rem)]"
                            style="
                                --fee-accent: {{ $theme['accent'] }};
                                --fee-dark: {{ $theme['dark'] }};
                                --fee-soft: {{ $theme['soft'] }};
                            "
                        >
                            <div class="fee-accent-bg h-2 w-full"></div>

                            <div class="flex flex-1 flex-col p-6">
                                {{-- Category --}}
                                <div class="mb-5 flex items-start justify-between gap-3">
                                    <span class="fee-soft-bg fee-accent-text inline-flex rounded-full px-3.5 py-2 text-[10px] font-black uppercase tracking-wider">
                                        {{ __($fee->category) }}
                                    </span>

                                    <div class="fee-soft-bg fee-accent-text flex h-10 w-10 shrink-0 items-center justify-center rounded-xl">
                                        <svg
                                            class="h-5 w-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 14l9-5-9-5-9 5 9 5z"
                                            ></path>
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 14l6.16-3.422A12.08 12.08 0 0118 17.5c-2 1.5-4 2.25-6 2.25s-4-.75-6-2.25a12.08 12.08 0 01-.16-6.922L12 14z"
                                            ></path>
                                        </svg>
                                    </div>
                                </div>

                                {{-- Program name --}}
                                <h3 class="min-h-[56px] text-2xl font-black uppercase leading-tight tracking-wide text-[#081747]">
                                    {{ __($fee->program_name) }}
                                </h3>

                                {{-- Schedule --}}
                                @if(filled($fee->time_schedule))
                                    <div class="mt-5 inline-flex w-fit items-center gap-2 rounded-xl bg-slate-100 px-4 py-2.5 text-xs font-bold uppercase tracking-wide text-slate-700">
                                        <svg class="h-4 w-4 fee-accent-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>

                                        {{ __($fee->time_schedule) }}
                                    </div>
                                @endif

                                {{-- Monthly price --}}
                                <div class="fee-soft-bg mt-6 rounded-2xl p-5 text-center">
                                    <span class="text-xs font-bold uppercase tracking-[0.15em] text-slate-500">
                                        {{ __('Monthly Tuition') }}
                                    </span>

                                    <div class="fee-accent-text mt-2 text-5xl font-black tracking-tight">
                                        {{ $fee->monthly_fee }}
                                    </div>

                                    <span class="mt-1 block text-xs font-medium text-slate-500">
                                        {{ __('per month') }}
                                    </span>
                                </div>

                                {{-- Additional fees --}}
                                <div class="mt-6 flex-1 divide-y divide-slate-100 border-y border-slate-100">
                                    @if(filled($fee->annual_fee))
                                        <div class="group flex items-center justify-between gap-4 py-4 transition-all duration-300 hover:pl-1.5">
                                            <div class="flex items-center gap-3.5">
                                                <div class="fee-soft-bg fee-accent-text flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border fee-accent-border shadow-sm transition-transform duration-300 group-hover:scale-110">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3M5 11h14M5 5h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z"></path></svg>
                                                </div>
                                                <span class="text-[11px] font-black uppercase tracking-[0.15em] text-slate-500">{{ __('Annual Tuition') }}</span>
                                            </div>
                                            <span class="text-lg font-black fee-accent-text drop-shadow-sm">{{ $fee->annual_fee }}</span>
                                        </div>
                                    @endif

                                    @if(filled($fee->lunch_fee))
                                        <div class="group flex items-center justify-between gap-4 py-4 transition-all duration-300 hover:pl-1.5">
                                            <div class="flex items-center gap-3.5">
                                                <div class="fee-soft-bg fee-accent-text flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border fee-accent-border shadow-sm transition-transform duration-300 group-hover:scale-110">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-3.866 0-7 2.239-7 5h14c0-2.761-3.134-5-7-5zm0 0V5m-8 12h16"></path></svg>
                                                </div>
                                                <span class="text-[11px] font-black uppercase tracking-[0.15em] text-slate-500">{{ __($fee->lunch_fee_label ?: 'Lunch Fee') }}</span>
                                            </div>
                                            <span class="text-lg font-black fee-accent-text drop-shadow-sm">{{ $fee->lunch_fee }}</span>
                                        </div>
                                    @endif

                                    @if(filled($fee->after_school_fee))
                                        <div class="group flex items-center justify-between gap-4 py-4 transition-all duration-300 hover:pl-1.5">
                                            <div class="flex items-center gap-3.5">
                                                <div class="fee-soft-bg fee-accent-text flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border fee-accent-border shadow-sm transition-transform duration-300 group-hover:scale-110">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V4H2v16h5m10 0v-4a5 5 0 00-10 0v4m10 0H7"></path></svg>
                                                </div>
                                                <span class="text-[11px] font-black uppercase tracking-[0.15em] text-slate-500">{{ __('After School') }}</span>
                                            </div>
                                            <span class="text-lg font-black fee-accent-text drop-shadow-sm">{{ $fee->after_school_fee }}</span>
                                        </div>
                                    @endif
                                </div>

                                {{-- Apply button --}}
                                <a
                                    href="{{ url('/enrollment') }}"
                                    class="fee-button mt-6 inline-flex w-full items-center justify-center gap-2 rounded-xl px-6 py-3.5 text-sm font-bold text-white shadow-lg transition-all duration-300 hover:-translate-y-0.5 hover:shadow-xl"
                                >
                                    {{ __('Apply for This Program') }}

                                    <svg
                                        class="h-4 w-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 5l7 7-7 7"
                                        ></path>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="rounded-[28px] border border-dashed border-blue-200 bg-white px-6 py-20 text-center shadow-sm">
                    <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-blue-50 text-blue-700">
                        <svg
                            class="h-10 w-10"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M12 8c-3.866 0-7 2.239-7 5h14c0-2.761-3.134-5-7-5zm0 0V5m-8 12h16"
                            ></path>
                        </svg>
                    </div>

                    <h3 class="text-2xl font-bold text-blue-950">
                        {{ __('Tuition information coming soon') }}
                    </h3>

                    <p class="mt-3 text-slate-500">
                        {{ __('Please contact our admissions team for more information.') }}
                    </p>
                </div>
            @endif
        </div>
    </section>

    {{-- Important notice --}}
    <section class="px-5 pb-20 md:px-8">
        <div class="mx-auto max-w-7xl overflow-hidden rounded-[28px] border border-red-100 bg-white shadow-[0_15px_45px_rgba(15,23,42,0.08)]">
            <div class="grid grid-cols-1 lg:grid-cols-[280px_1fr]">
                <div class="relative overflow-hidden bg-gradient-to-br from-red-600 to-red-700 p-8 text-white md:p-10">
                    <div
                        class="absolute inset-0 opacity-10"
                        style="
                            background-image: radial-gradient(
                                circle,
                                white 1px,
                                transparent 1px
                            );
                            background-size: 18px 18px;
                        "
                    ></div>

                    <div class="relative">
                        <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-white/15">
                            <svg
                                class="h-7 w-7"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                                ></path>
                            </svg>
                        </div>

                        <span class="text-sm font-bold uppercase tracking-[0.18em] text-red-100">
                            {{ __('Important') }}
                        </span>

                        <h2 class="mt-2 text-3xl font-black">
                            {{ __('Payment Notice') }}
                        </h2>

                        <p class="mt-4 text-sm leading-6 text-red-100">
                            {{ __('Please review the following payment policies.') }}
                        </p>
                    </div>
                </div>

                <div class="p-7 md:p-10">
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100 font-black text-blue-700">
                                1
                            </span>

                            <h3 class="mt-4 font-black text-[#081747]">
                                {{ __('Payment Due Date') }}
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-slate-600">
                                {{ __('Monthly payments are due by the') }}
                                <strong class="text-red-600">
                                    {{ __('1st of every month.') }}
                                </strong>
                            </p>
                        </div>

                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 font-black text-emerald-700">
                                7
                            </span>

                            <h3 class="mt-4 font-black text-[#081747]">
                                {{ __('Grace Period') }}
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-slate-600">
                                {{ __('A grace period of') }}
                                <strong class="text-[#081747]">{{ __('7 days') }}</strong>
                                {{ __('will be provided.') }}
                            </p>
                        </div>

                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-100 font-black text-red-700">
                                10%
                            </span>

                            <h3 class="mt-4 font-black text-[#081747]">
                                {{ __('Late Payment') }}
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-slate-600">
                                {{ __('A') }}
                                <strong class="text-red-600">
                                    {{ __('10% penalty fee') }}
                                </strong>
                                {{ __('will be added to late payments.') }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-6 flex flex-col gap-5 rounded-2xl border border-red-100 bg-red-50 p-5 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-red-500">
                                {{ __('Please Note') }}
                            </span>

                            <p class="mt-1 text-lg font-black uppercase tracking-wide text-red-700">
                                {{ __('All tuition and other fees are non-refundable') }}
                            </p>
                        </div>

                        <div class="flex shrink-0 items-center gap-5">
                            <img
                                src="{{ asset('images/lis-logo.png') }}"
                                alt="Life International School"
                                class="h-11 w-auto object-contain"
                            >

                            <img
                                src="{{ asset('images/acsi-logo.png') }}"
                                alt="ACSI"
                                class="h-11 w-auto object-contain"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="px-5 pb-24 md:px-8">
        <div class="relative mx-auto max-w-7xl overflow-hidden rounded-[28px] bg-gradient-to-r from-[#081747] to-[#173c9c] px-7 py-10 text-white shadow-xl md:px-12 md:py-12">
            <div class="absolute -right-20 -top-24 h-64 w-64 rounded-full bg-orange-400/20 blur-3xl"></div>

            <div class="relative flex flex-col gap-7 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <span class="text-sm font-bold uppercase tracking-[0.18em] text-orange-300">
                        {{ __('Need Assistance?') }}
                    </span>

                    <h2 class="mt-2 text-3xl font-black">
                        {{ __('Not Sure Which Program to Choose?') }}
                    </h2>

                    <p class="mt-3 max-w-2xl leading-7 text-blue-100">
                        {{ __('Our admissions team is ready to answer your questions and help you find the right program.') }}
                    </p>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row">
                    <a
                        href="{{ url('/contact-us') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-white/25 bg-white/10 px-6 py-3.5 font-bold text-white transition-colors hover:bg-white hover:text-blue-950"
                    >
                        {{ __('Contact Admissions') }}
                    </a>

                    <a
                        href="{{ url('/enrollment') }}"
                        class="inline-flex items-center justify-center rounded-xl bg-orange-500 px-6 py-3.5 font-bold text-white shadow-lg transition-colors hover:bg-orange-600"
                    >
                        {{ __('Apply Now') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection