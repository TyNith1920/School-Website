@extends('layout')

@section('title', __('Contact Us - Life International School'))

@section('content')

@php
    $banner = \App\Models\SiteBanner::where(
        'page_name',
        'Contact'
    )->first();

    $contactSetting = \App\Models\SiteSetting::first();

    $contactAddress =
        $contactSetting?->address
        ?? '#123 Street, Sangkat, City, Cambodia';

    $contactPhone =
        $contactSetting?->phone
        ?? '+855 78 517 754';

    $contactEmail =
        $contactSetting?->email
        ?? 'info@lifeinternationalschool.com';

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

{{-- Hero --}}
<section class="relative isolate min-h-[350px] overflow-hidden bg-[#081747] md:min-h-[460px]">
    @if($banner && $banner->image_path)
        <img
            src="{{ Storage::url($banner->image_path) }}"
            alt="Contact Life International School"
            class="absolute inset-0 h-full w-full object-cover object-center"
        >
    @else
        <div class="absolute inset-0 bg-gradient-to-br from-[#081747] via-[#173c9c] to-[#2563eb]"></div>

        <div
            class="absolute inset-0 opacity-20"
            style="
                background-image: radial-gradient(
                    circle,
                    rgba(255,255,255,0.8) 1px,
                    transparent 1px
                );
                background-size: 24px 24px;
            "
        ></div>
    @endif

    <div class="absolute inset-0 bg-gradient-to-r from-slate-950/85 via-blue-950/65 to-blue-900/35"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/30 via-transparent to-transparent"></div>

    <div class="relative z-10 mx-auto flex min-h-[350px] max-w-7xl items-center justify-center px-6 py-16 text-center md:min-h-[460px]">
        <div class="max-w-3xl">
            <div data-aos="fade-down" class="mb-5 inline-flex items-center rounded-full border border-white/25 bg-white/10 px-5 py-2 text-sm font-bold uppercase tracking-wider text-blue-50 backdrop-blur-sm">
                {{ __('HERE TO HELP') }}
            </div>

            <h1 data-aos="fade-up" data-aos-delay="100" class="text-4xl font-black uppercase tracking-wide text-white drop-shadow-lg sm:text-5xl md:text-6xl">
                {{ __('CONTACT US') }}
            </h1>

            <div data-aos="zoom-in" data-aos-delay="200" class="mx-auto mt-6 h-1.5 w-24 rounded-full bg-orange-500 shadow-lg"></div>

            <p data-aos="fade-up" data-aos-delay="300" class="mx-auto mt-6 max-w-2xl text-base leading-7 text-blue-50/90 md:text-lg">
                {{ __('We would love to hear from you. Please contact us using the information below.') }}
            </p>
        </div>
    </div>

    <div
        class="absolute -bottom-px left-0 h-10 w-full bg-slate-50 md:h-16"
        style="clip-path: polygon(0 70%, 100% 0, 100% 100%, 0 100%);"
    ></div>
</section>

{{-- Contact section --}}
<section class="bg-slate-50 px-5 pb-20 pt-10 md:px-8 md:pb-24">
    <div class="relative z-20 mx-auto max-w-7xl">
        <div data-aos="fade-up" class="mb-12 text-center">
            <div class="mb-3 flex items-center justify-center gap-3">
                <span class="h-1 w-10 rounded-full bg-orange-500"></span>
                <span class="text-sm font-bold uppercase tracking-[0.18em] text-orange-500">
                    {{ __('GET IN TOUCH') }}
                </span>
                <span class="h-1 w-10 rounded-full bg-orange-500"></span>
            </div>

            <h2 class="text-3xl font-black text-[#081747] md:text-4xl">
                {{ __('Start a Conversation') }}
            </h2>

            <p class="mx-auto mt-4 max-w-2xl leading-7 text-slate-600">
                {{ __('Fill out the form below and our team will get back to you as soon as possible.') }}
            </p>
        </div>

        <div class="grid overflow-hidden rounded-[30px] border border-slate-200 bg-white shadow-[0_20px_60px_rgba(15,23,42,0.12)] lg:grid-cols-[0.85fr_1.15fr]">

            {{-- Contact information --}}
            <div data-aos="fade-right" data-aos-delay="100" class="relative overflow-hidden bg-gradient-to-br from-[#081747] via-[#102b78] to-[#1d4ed8] p-7 text-white md:p-10 lg:p-12">
                <div
                    class="absolute inset-0 opacity-10"
                    style="
                        background-image: radial-gradient(
                            circle,
                            white 1px,
                            transparent 1px
                        );
                        background-size: 20px 20px;
                    "
                ></div>

                <div class="absolute -right-24 -top-24 h-64 w-64 rounded-full bg-orange-400/20 blur-3xl"></div>
                <div class="absolute -bottom-28 -left-20 h-72 w-72 rounded-full bg-blue-300/20 blur-3xl"></div>

                <div class="relative">
                    <div class="mb-7 flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-500 shadow-lg">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 4v-4z"></path>
                        </svg>
                    </div>

                    <span class="text-sm font-bold uppercase tracking-[0.18em] text-orange-300">
                        {{ __('CONTACT INFO') }}
                    </span>

                    <h3 class="mt-3 text-3xl font-black">
                        {{ __('Get in touch') }}
                    </h3>

                    <p class="mt-4 max-w-md leading-7 text-blue-100">
                        {{ __('Reach out to us using the information below.') }}
                    </p>

                    <div class="mt-10 space-y-5">
                        {{-- Address --}}
                        <div class="group flex items-start gap-4 rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur-sm transition-colors hover:bg-white/15">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white/10 text-orange-300">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>

                            <div>
                                <span class="text-xs font-bold uppercase tracking-wider text-blue-200">
                                    {{ __('School Address') }}
                                </span>
                                <p class="mt-1 text-sm leading-6 text-white">
                                    {{ $contactAddress }}
                                </p>
                            </div>
                        </div>

                        {{-- Phone --}}
                        <a
                            href="tel:{{ $phoneHref }}"
                            class="group flex items-start gap-4 rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur-sm transition-colors hover:bg-white/15"
                        >
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white/10 text-orange-300">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.95.684l1.5 4.493a1 1 0 01-.502 1.21l-2.257 1.128a11.04 11.04 0 005.516 5.516l1.128-2.257a1 1 0 011.21-.502l4.493 1.5a1 1 0 01.684.95V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>

                            <div>
                                <span class="text-xs font-bold uppercase tracking-wider text-blue-200">
                                    {{ __('Phone Number') }}
                                </span>
                                <p class="mt-1 text-sm text-white">
                                    {{ $contactPhone }}
                                </p>
                            </div>
                        </a>

                        {{-- Email --}}
                        <a
                            href="mailto:{{ $contactEmail }}"
                            class="group flex items-start gap-4 rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur-sm transition-colors hover:bg-white/15"
                        >
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white/10 text-orange-300">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>

                            <div class="min-w-0">
                                <span class="text-xs font-bold uppercase tracking-wider text-blue-200">
                                    {{ __('Email Address') }}
                                </span>
                                <p class="mt-1 break-all text-sm text-white">
                                    {{ $contactEmail }}
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Contact form --}}
            <div data-aos="fade-left" data-aos-delay="200" class="p-6 md:p-10 lg:p-12">
                <div class="mb-8">
                    <span class="text-sm font-bold uppercase tracking-[0.18em] text-orange-500">
                        {{ __('SEND A MESSAGE') }}
                    </span>

                    <h3 class="mt-3 text-3xl font-black text-[#081747]">
                        {{ __('How can we help?') }}
                    </h3>

                    <p class="mt-3 leading-7 text-slate-600">
                        {{ __('Please provide your details below.') }}
                    </p>
                </div>

                {{-- Success alert --}}
                @if(session('success'))
                    <div
                        x-data="{ show: true }"
                        x-show="show"
                        x-init="setTimeout(() => show = false, 5000)"
                        x-transition
                        class="mb-7 flex items-start gap-4 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800"
                        role="alert"
                    >
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-emerald-100">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>

                        <div>
                            <p class="font-bold">
                                {{ __('Message Sent Successfully!') }}
                            </p>
                            <p class="mt-1 text-sm text-emerald-700">
                                {{ session('success') }}
                            </p>
                        </div>

                        <button
                            type="button"
                            @click="show = false"
                            class="ml-auto text-emerald-600 hover:text-emerald-900"
                            aria-label="Close alert"
                        >
                            ✕
                        </button>
                    </div>
                @endif

                {{-- Validation summary --}}
                @if($errors->any())
                    <div class="mb-7 rounded-2xl border border-red-200 bg-red-50 p-4 text-red-700">
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
                        {{-- Name --}}
                        <div>
                            <label for="contact-name" class="mb-2 block text-sm font-bold text-slate-700">
                                {{ __('Your Name') }}
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                id="contact-name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="{{ __('Enter your full name') }}"
                                autocomplete="name"
                                required
                                class="w-full rounded-xl border bg-slate-50 px-4 py-3.5 text-slate-900 outline-none transition-all placeholder:text-slate-400 focus:bg-white focus:ring-4 focus:ring-blue-100
                                    @error('name') border-red-400 focus:border-red-500 @else border-slate-300 focus:border-blue-600 @enderror"
                            >

                            @error('name')
                                <p class="mt-2 text-sm font-medium text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div>
                            <label for="contact-phone" class="mb-2 block text-sm font-bold text-slate-700">
                                {{ __('Phone Number') }}
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                id="contact-phone"
                                type="tel"
                                name="phone"
                                value="{{ old('phone') }}"
                                placeholder="+855"
                                autocomplete="tel"
                                required
                                class="w-full rounded-xl border bg-slate-50 px-4 py-3.5 text-slate-900 outline-none transition-all placeholder:text-slate-400 focus:bg-white focus:ring-4 focus:ring-blue-100
                                    @error('phone') border-red-400 focus:border-red-500 @else border-slate-300 focus:border-blue-600 @enderror"
                            >

                            @error('phone')
                                <p class="mt-2 text-sm font-medium text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="contact-email" class="mb-2 block text-sm font-bold text-slate-700">
                            {{ __('Email Address') }}
                            <span class="font-normal text-slate-400">
                                ({{ __('Optional') }})
                            </span>
                        </label>

                        <input
                            id="contact-email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="example@gmail.com"
                            autocomplete="email"
                            class="w-full rounded-xl border bg-slate-50 px-4 py-3.5 text-slate-900 outline-none transition-all placeholder:text-slate-400 focus:bg-white focus:ring-4 focus:ring-blue-100
                                @error('email') border-red-400 focus:border-red-500 @else border-slate-300 focus:border-blue-600 @enderror"
                        >

                        @error('email')
                            <p class="mt-2 text-sm font-medium text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Message --}}
                    <div>
                        <label for="contact-message" class="mb-2 block text-sm font-bold text-slate-700">
                            {{ __('Message') }}
                            <span class="text-red-500">*</span>
                        </label>

                        <textarea
                            id="contact-message"
                            name="message"
                            rows="6"
                            placeholder="{{ __('How can we help you?') }}"
                            required
                            class="w-full resize-y rounded-xl border bg-slate-50 px-4 py-3.5 text-slate-900 outline-none transition-all placeholder:text-slate-400 focus:bg-white focus:ring-4 focus:ring-blue-100
                                @error('message') border-red-400 focus:border-red-500 @else border-slate-300 focus:border-blue-600 @enderror"
                        >{{ old('message') }}</textarea>

                        @error('message')
                            <p class="mt-2 text-sm font-medium text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        :disabled="submitting"
                        class="inline-flex w-full items-center justify-center gap-3 rounded-xl bg-orange-500 px-8 py-4 font-bold text-white shadow-lg transition-all duration-300 hover:-translate-y-1 hover:bg-orange-600 hover:shadow-xl disabled:cursor-not-allowed disabled:opacity-70"
                    >
                        <svg x-show="!submitting" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>

                        <svg x-show="submitting" x-cloak class="h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>

                        <span x-text="submitting ? '{{ __('Sending...') }}' : '{{ __('Send Message') }}'"></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

{{-- Map section --}}
<section class="bg-white px-5 pb-20 pt-4 md:px-8 md:pb-24">
    <div class="mx-auto max-w-7xl">
        <div class="mb-10 flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
            <div data-aos="fade-right">
                <div class="mb-3 flex items-center gap-3">
                    <span class="h-1 w-10 rounded-full bg-orange-500"></span>
                    <span class="text-sm font-bold uppercase tracking-[0.18em] text-orange-500">
                        {{ __('VISIT CAMPUS') }}
                    </span>
                </div>

                <h2 class="text-3xl font-black text-[#081747] md:text-4xl">
                    {{ __('Find us on the map') }}
                </h2>

                <p class="mt-3 max-w-2xl leading-7 text-slate-600">
                    {{ __('Come visit us during office hours. We look forward to meeting you.') }}
                </p>
            </div>

            <a
                data-aos="fade-left"
                href="https://www.google.com/maps/search/?api=1&query=10.632562,103.519738"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex w-fit items-center gap-2 rounded-xl border border-blue-200 bg-blue-50 px-5 py-3 text-sm font-bold text-blue-800 transition-colors hover:bg-blue-800 hover:text-white"
            >
                {{ __('Open Google Maps') }}
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6m0 0v6m0-6L10 16M7 7H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2"></path>
                </svg>
            </a>
        </div>

        <div data-aos="fade-up" data-aos-delay="100" class="h-[400px] overflow-hidden rounded-[28px] border border-slate-200 bg-slate-100 shadow-[0_15px_45px_rgba(15,23,42,0.12)] md:h-[520px]">
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