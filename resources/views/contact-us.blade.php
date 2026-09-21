@extends('layout')

@section('title', __('Contact Us - Life International School'))

@section('content')

@php
    $banner = \App\Models\SiteBanner::where(
        'page_name',
        'Contact'
    )->first();

    // 📍 មុខងារទាញយករូបភាព Banner ពី Cloudflare R2 (s3)
    $getImageUrl = function($path) {
        if (!$path) return null;
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }
        try {
            return \Storage::disk('s3')->url($path);
        } catch (\Exception $e) {
            return asset('storage/' . $path);
        }
    };

    // ទាញយករូបភាពពី Database មកធ្វើជា Slider
    $sliderImages = [];
    if ($banner && $banner->image_path) {
        $raw = is_array($banner->image_path) 
            ? $banner->image_path 
            : (is_string($banner->image_path) ? json_decode($banner->image_path, true) ?? [$banner->image_path] : []);

        foreach ((array)$raw as $img) {
            if ($url = $getImageUrl($img)) {
                $sliderImages[] = $url;
            }
        }
    }

    // Fallback ប្រសិនបើមិនទាន់បាន Upload
    if (empty($sliderImages)) {
        $sliderImages = [
            'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1541829070764-84a7d30dd3f3?q=80&w=2069&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=2064&auto=format&fit=crop',
        ];
    }

    $contactSetting = \App\Models\SiteSetting::first();

    $contactAddress =
        $contactSetting?->address
        ?? 'Group 20, Village 3, Sangkat 3, Sihanoukville, Preah Sihanouk Province, Cambodia';

    $contactPhone =
        $contactSetting?->phone
        ?? '+855 78 517 754';

    $contactEmail =
        $contactSetting?->email
        ?? 'lifeinternationalschool@gmail.com';

    $phoneHref = preg_replace(
        '/[^0-9+]/',
        '',
        $contactPhone
    );
@endphp

<style>
    [x-cloak] {
        display: none !important;
    }
</style>

{{-- 🌟 Contact Hero Banner ជាមួយរូបភាពភ្លឺច្បាស់ មិនបាំងពណ៌ខៀវ & Metallic Gold Wave --}}
<section 
    x-data="{
        current: 0,
        slides: @js($sliderImages),
        timer: null,
        start() {
            if (this.slides.length > 1) {
                this.timer = setInterval(() => {
                    this.current = (this.current + 1) % this.slides.length;
                }, 4500);
            }
        },
        stop() { clearInterval(this.timer); },
        goTo(index) { this.current = index; }
    }"
    x-init="start()"
    @mouseenter="stop()"
    @mouseleave="start()"
    class="relative isolate min-h-[480px] md:min-h-[580px] overflow-hidden bg-slate-900 flex items-center justify-center text-white"
>
    {{-- 📍 Background Cross-fade Slideshow (រូបភាពភ្លឺច្បាស់ធម្មជាតិ) --}}
    <div class="absolute inset-0 z-0">
        <template x-for="(img, idx) in slides" :key="idx">
            <img :src="img" 
                 :alt="'LIS Contact Banner ' + (idx + 1)"
                 x-show="current === idx"
                 x-transition:enter="transition ease-out duration-1000"
                 x-transition:enter-start="opacity-0 scale-105"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-1000 absolute inset-0"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="h-full w-full object-cover object-center"
                 loading="lazy">
        </template>
    </div>

    {{-- 📍 Overlay ស្រាលកម្រិតស្រទន់ (មិនបាំងរូបភាព ជួយឱ្យអក្សរអានបានច្បាស់) --}}
    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-950/30 to-slate-950/50 z-10 pointer-events-none"></div>

    <div class="relative z-20 mx-auto max-w-5xl px-6 pt-16 pb-32 md:pb-36 text-center">
        
        <div data-aos="fade-down" class="mb-5 inline-flex items-center gap-2 rounded-full border border-amber-300/40 bg-black/40 px-5 py-1.5 text-xs md:text-sm font-bold uppercase tracking-[0.2em] text-amber-300 backdrop-blur-md shadow-lg">
            <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
            {{ __('WE ARE HERE TO HELP') }}
        </div>

        <h1 data-aos="fade-up" data-aos-delay="100" class="text-4xl sm:text-6xl md:text-7xl font-black uppercase tracking-tight text-white leading-tight drop-shadow-[0_4px_12px_rgba(0,0,0,0.8)]">
            {{ __('Get In') }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-orange-300 to-amber-400">{{ __('Touch') }}</span>
        </h1>

        <div data-aos="zoom-in" data-aos-delay="200" class="mx-auto mt-4 mb-6 h-1.5 w-20 rounded-full bg-gradient-to-r from-amber-400 to-orange-400 shadow-[0_0_15px_rgba(251,191,36,0.8)]"></div>

        <p data-aos="fade-up" data-aos-delay="300" class="mx-auto max-w-2xl text-base sm:text-lg md:text-xl text-white drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)] leading-relaxed font-medium">
            {{ __('Whether you have questions about admissions, academic programs, or campus visits, our friendly team is eager to assist you.') }}
        </p>

        {{-- Contact Quick Links (Backdrop ដិតស្រួលមើល) --}}
        <div data-aos="fade-up" data-aos-delay="400" class="mt-8 flex flex-wrap items-center justify-center gap-3 text-xs md:text-sm text-white font-bold">
            <a href="tel:{{ $phoneHref }}" class="inline-flex items-center gap-2.5 rounded-xl bg-black/50 hover:bg-black/70 px-5 py-2.5 border border-white/20 backdrop-blur-md transition-all shadow-lg hover:border-amber-400">
                <svg class="h-4 w-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.95.684l1.5 4.493a1 1 0 01-.502 1.21l-2.257 1.128a11.04 11.04 0 005.516 5.516l1.128-2.257a1 1 0 011.21-.502l4.493 1.5a1 1 0 01.684.95V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                <span>{{ $contactPhone }}</span>
            </a>
            <a href="mailto:{{ $contactEmail }}" class="inline-flex items-center gap-2.5 rounded-xl bg-black/50 hover:bg-black/70 px-5 py-2.5 border border-white/20 backdrop-blur-md transition-all shadow-lg hover:border-orange-400">
                <svg class="h-4 w-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <span>{{ $contactEmail }}</span>
            </a>
        </div>

        {{-- Dots Indicator --}}
        <div x-show="slides.length > 1" class="mt-8 flex items-center justify-center gap-2">
            <template x-for="(s, sIdx) in slides" :key="'contact-dot-' + sIdx">
                <button @click="goTo(sIdx)" 
                        :class="current === sIdx ? 'w-7 bg-amber-400' : 'w-2 bg-white/50 hover:bg-white/90'" 
                        class="h-2 rounded-full transition-all duration-300 shadow-sm"></button>
            </template>
        </div>

    </div>

    {{-- 📍 Dual-Layer Rich Metallic Gold Wave Transition --}}
    <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none z-20 pointer-events-none">
        <svg class="relative block w-full h-16 sm:h-20 md:h-28" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <defs>
                <linearGradient id="contactGoldGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" stop-color="#b45309" />
                    <stop offset="25%" stop-color="#f59e0b" />
                    <stop offset="50%" stop-color="#fde047" />
                    <stop offset="75%" stop-color="#f59e0b" />
                    <stop offset="100%" stop-color="#d97706" />
                </linearGradient>
            </defs>
            <path d="M0,0 C160,85 380,-15 640,40 C890,95 1060,15 1200,50 L1200,120 L0,120 Z" fill="url(#contactGoldGradient)"></path>
            <path d="M0,28 C200,85 450,22 700,58 C940,95 1100,32 1200,50 L1200,120 L0,120 Z" fill="#f8fafc"></path>
        </svg>
    </div>
</section>

{{-- Contact Section --}}
<section class="bg-slate-50 px-5 pb-20 pt-8 md:px-8 md:pb-24">
    <div class="relative z-20 mx-auto max-w-7xl">
        <div data-aos="fade-up" class="mb-12 text-center">
            <div class="mb-3 flex items-center justify-center gap-3">
                <span class="h-1 w-10 rounded-full bg-orange-500"></span>
                <span class="text-sm font-bold uppercase tracking-[0.18em] text-orange-500">
                    {{ __('SEND A MESSAGE') }}
                </span>
                <span class="h-1 w-10 rounded-full bg-orange-500"></span>
            </div>

            <h2 class="text-3xl font-black text-[#081747] md:text-4xl">
                {{ __('Start a Conversation') }}
            </h2>

            <p class="mx-auto mt-4 max-w-2xl leading-7 text-slate-600">
                {{ __('Fill out the form below and our admissions team will get back to you as soon as possible.') }}
            </p>
        </div>

        <div class="grid overflow-hidden rounded-[30px] border border-slate-200 bg-white shadow-[0_20px_60px_rgba(15,23,42,0.08)] lg:grid-cols-[0.85fr_1.15fr]">

            {{-- Contact Information Panel --}}
            <div data-aos="fade-right" data-aos-delay="100" class="relative overflow-hidden bg-gradient-to-br from-[#081747] via-[#0d276b] to-[#173c9c] p-7 text-white md:p-10 lg:p-12 flex flex-col justify-between">
                <div
                    class="absolute inset-0 opacity-10 pointer-events-none"
                    style="
                        background-image: radial-gradient(
                            circle,
                            white 1px,
                            transparent 1px
                        );
                        background-size: 20px 20px;
                    "
                ></div>

                <div class="absolute -right-24 -top-24 h-64 w-64 rounded-full bg-orange-400/20 blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-28 -left-20 h-72 w-72 rounded-full bg-blue-300/20 blur-3xl pointer-events-none"></div>

                <div class="relative">
                    <div class="mb-7 flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-500 shadow-lg">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 4v-4z"></path>
                        </svg>
                    </div>

                    <span class="text-sm font-bold uppercase tracking-[0.18em] text-orange-300">
                        {{ __('CAMPUS INFORMATION') }}
                    </span>

                    <h3 class="mt-3 text-3xl font-black">
                        {{ __('Life International School') }}
                    </h3>

                    <p class="mt-4 max-w-md leading-7 text-blue-100">
                        {{ __('We are delighted to welcome parents, students, and guests to our vibrant campus in Sihanoukville.') }}
                    </p>

                    <div class="mt-10 space-y-4">
                        {{-- Address --}}
                        <div class="group flex items-start gap-4 rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur-sm transition-colors hover:bg-white/15">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white/10 text-orange-300">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>

                            <div>
                                <span class="text-[11px] font-bold uppercase tracking-wider text-blue-200">
                                    {{ __('Campus Location') }}
                                </span>
                                <p class="mt-0.5 text-sm leading-6 text-white">
                                    {{ $contactAddress }}
                                </p>
                            </div>
                        </div>

                        {{-- Phone --}}
                        <a
                            href="tel:{{ $phoneHref }}"
                            class="group flex items-start gap-4 rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur-sm transition-colors hover:bg-white/15"
                        >
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white/10 text-orange-300">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.95.684l1.5 4.493a1 1 0 01-.502 1.21l-2.257 1.128a11.04 11.04 0 005.516 5.516l1.128-2.257a1 1 0 011.21-.502l4.493 1.5a1 1 0 01.684.95V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>

                            <div>
                                <span class="text-[11px] font-bold uppercase tracking-wider text-blue-200">
                                    {{ __('Direct Phone Line') }}
                                </span>
                                <p class="mt-0.5 text-sm text-white font-bold">
                                    {{ $contactPhone }}
                                </p>
                            </div>
                        </a>

                        {{-- Email --}}
                        <a
                            href="mailto:{{ $contactEmail }}"
                            class="group flex items-start gap-4 rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur-sm transition-colors hover:bg-white/15"
                        >
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white/10 text-orange-300">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>

                            <div class="min-w-0">
                                <span class="text-[11px] font-bold uppercase tracking-wider text-blue-200">
                                    {{ __('General Admissions Email') }}
                                </span>
                                <p class="mt-0.5 break-all text-sm text-white font-bold">
                                    {{ $contactEmail }}
                                </p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-white/15 flex items-center justify-between text-xs text-blue-200">
                    <span>{{ __('Mon – Fri: 7:30 AM – 4:30 PM') }}</span>
                    <span>{{ __('Closed on Weekends & Holidays') }}</span>
                </div>
            </div>

            {{-- Form Panel --}}
            <div data-aos="fade-left" data-aos-delay="200" class="p-6 md:p-10 lg:p-12">
                <div class="mb-8">
                    <span class="text-xs font-black uppercase tracking-[0.18em] text-orange-500">
                        {{ __('INQUIRY FORM') }}
                    </span>

                    <h3 class="mt-2 text-2xl md:text-3xl font-black text-[#081747]">
                        {{ __('How can we help your family?') }}
                    </h3>

                    <p class="mt-2 leading-relaxed text-slate-500 text-sm">
                        {{ __('Please complete the brief form below and our team will get in touch shortly.') }}
                    </p>
                </div>

                @if(session('success'))
                    <div
                        x-data="{ show: true }"
                        x-show="show"
                        x-init="setTimeout(() => show = false, 6000)"
                        x-transition
                        class="mb-7 flex items-start gap-4 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800 shadow-sm"
                        role="alert"
                    >
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-emerald-100">
                            <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>

                        <div>
                            <p class="font-black text-emerald-900">
                                {{ __('Message Sent Successfully!') }}
                            </p>
                            <p class="mt-0.5 text-sm text-emerald-700">
                                {{ session('success') }}
                            </p>
                        </div>

                        <button
                            type="button"
                            @click="show = false"
                            class="ml-auto text-emerald-600 hover:text-emerald-900 font-bold"
                            aria-label="Close alert"
                        >
                            ✕
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-7 rounded-2xl border border-red-200 bg-red-50 p-4 text-red-700 shadow-sm">
                        <p class="font-bold">
                            {{ __('Please check the information below:') }}
                        </p>

                        <ul class="mt-2 list-inside list-disc space-y-1 text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form
                    action="{{ url('/contact-us') }}"
                    method="POST"
                    x-data="{ submitting: false }"
                    @submit="submitting = true"
                    class="space-y-6"
                >
                    @csrf

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label for="contact-name" class="mb-2 block text-xs font-black uppercase tracking-wider text-slate-700">
                                {{ __('Your Full Name') }}
                                <span class="text-orange-500">*</span>
                            </label>

                            <input
                                id="contact-name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="{{ __('e.g. Sokha Chan') }}"
                                autocomplete="name"
                                required
                                class="w-full rounded-xl border bg-slate-50 px-4 py-3.5 text-slate-900 outline-none transition-all placeholder:text-slate-400 focus:bg-white focus:ring-4 focus:ring-blue-100
                                    @error('name') border-red-400 focus:border-red-500 @else border-slate-300 focus:border-blue-600 @enderror"
                            >

                            @error('name')
                                <p class="mt-2 text-sm font-medium text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="contact-phone" class="mb-2 block text-xs font-black uppercase tracking-wider text-slate-700">
                                {{ __('Phone Number') }}
                                <span class="text-orange-500">*</span>
                            </label>

                            <input
                                id="contact-phone"
                                type="tel"
                                name="phone"
                                value="{{ old('phone') }}"
                                placeholder="{{ __('+855 12 345 678') }}"
                                autocomplete="tel"
                                required
                                class="w-full rounded-xl border bg-slate-50 px-4 py-3.5 text-slate-900 outline-none transition-all placeholder:text-slate-400 focus:bg-white focus:ring-4 focus:ring-blue-100
                                    @error('phone') border-red-400 focus:border-red-500 @else border-slate-300 focus:border-blue-600 @enderror"
                            >

                            @error('phone')
                                <p class="mt-2 text-sm font-medium text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="contact-email" class="mb-2 block text-xs font-black uppercase tracking-wider text-slate-700">
                            {{ __('Email Address') }}
                            <span class="font-normal text-slate-400 lowercase">
                                ({{ __('optional') }})
                            </span>
                        </label>

                        <input
                            id="contact-email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="{{ __('parent@example.com') }}"
                            autocomplete="email"
                            class="w-full rounded-xl border bg-slate-50 px-4 py-3.5 text-slate-900 outline-none transition-all placeholder:text-slate-400 focus:bg-white focus:ring-4 focus:ring-blue-100
                                @error('email') border-red-400 focus:border-red-500 @else border-slate-300 focus:border-blue-600 @enderror"
                        >

                        @error('email')
                            <p class="mt-2 text-sm font-medium text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contact-message" class="mb-2 block text-xs font-black uppercase tracking-wider text-slate-700">
                            {{ __('Inquiry / Message') }}
                            <span class="text-orange-500">*</span>
                        </label>

                        <textarea
                            id="contact-message"
                            name="message"
                            rows="5"
                            placeholder="{{ __('How can we assist you with admissions or school programs?') }}"
                            required
                            class="w-full resize-y rounded-xl border bg-slate-50 px-4 py-3.5 text-slate-900 outline-none transition-all placeholder:text-slate-400 focus:bg-white focus:ring-4 focus:ring-blue-100
                                @error('message') border-red-400 focus:border-red-500 @else border-slate-300 focus:border-blue-600 @enderror"
                        >{{ old('message') }}</textarea>

                        @error('message')
                            <p class="mt-2 text-sm font-medium text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        :disabled="submitting"
                        class="inline-flex w-full items-center justify-center gap-3 rounded-xl bg-orange-500 px-8 py-4 font-bold text-white shadow-lg transition-all duration-300 hover:-translate-y-1 hover:bg-orange-600 hover:shadow-xl disabled:cursor-not-allowed disabled:opacity-70 text-sm uppercase tracking-wider"
                    >
                        <svg x-show="!submitting" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>

                        <svg x-show="submitting" x-cloak class="h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>

                        <span x-text="submitting ? '{{ __('Sending...') }}' : '{{ __('Send Inquiry') }}'"></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

{{-- Map Section --}}
<section class="bg-white px-5 pb-20 pt-6 md:px-8 md:pb-24">
    <div class="mx-auto max-w-7xl">
        <div class="mb-10 flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
            <div data-aos="fade-right">
                <div class="mb-3 flex items-center gap-3">
                    <span class="h-1 w-10 rounded-full bg-orange-500"></span>
                    <span class="text-sm font-bold uppercase tracking-[0.18em] text-orange-500">
                        {{ __('CAMPUS VISIT') }}
                    </span>
                </div>

                <h2 class="text-3xl font-black text-[#081747] md:text-4xl">
                    {{ __('Find Us in Sihanoukville') }}
                </h2>

                <p class="mt-2 max-w-2xl leading-relaxed text-slate-600">
                    {{ __('Schedule a visit or stop by during our office hours to tour our modern classrooms, sports facilities, and library.') }}
                </p>
            </div>

            <a
                data-aos="fade-left"
                href="https://www.google.com/maps/search/?api=1&query=10.632562,103.519738"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex w-fit items-center gap-2 rounded-xl border border-blue-200 bg-blue-50 px-6 py-3.5 text-sm font-bold text-blue-900 transition-all hover:bg-[#081747] hover:text-white shadow-sm"
            >
                <span>{{ __('Open Google Maps') }}</span>
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6m0 0v6m0-6L10 16M7 7H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2"></path>
                </svg>
            </a>
        </div>

        <div data-aos="fade-up" data-aos-delay="100" class="h-[400px] overflow-hidden rounded-[28px] border border-slate-200 bg-slate-100 shadow-[0_15px_45px_rgba(15,23,42,0.1)] md:h-[520px]">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3921.3157199817624!2d103.51973757503978!3d10.632562489507592!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3107e1dd2f564c45%3A0xcc975fdebda19aba!2sJGMC%2B2W%2C%20Preah%20Sihanouk!5e0!3m2!1sen!2skh!4v1785915586224!5m2!1sen!2skh"
                title="Life International School location"
                class="h-full w-full border-0"
                allowfullscreen
                loading="lazy"
                referrerpolicy="strict-origin-when-cross-origin"
            ></iframe>
        </div>
    </div>
</section>

@endsection