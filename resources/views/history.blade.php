@extends('layout')

@section('title', __('History & Governance - Life International School'))

@section('content')

@php
    $rawSlides = $historySetting?->banner_slider ?? [];

    if (is_array($rawSlides)) {
        $bannerSlides = $rawSlides;
    } elseif (is_string($rawSlides)) {
        $bannerSlides = json_decode($rawSlides, true) ?? [];
    } else {
        $bannerSlides = [];
    }

    $bannerSlides = collect($bannerSlides)
        ->filter(
            fn ($slide) =>
                is_array($slide) &&
                !empty($slide['file'])
        )
        ->values()
        ->all();

    $timelineColors = [
        'pink' => '#ec4899',
        'orange' => '#f97316',
        'purple' => '#8b5cf6',
        'green' => '#10b981',
        'red' => '#ef4444',
        'yellow' => '#eab308',
        'indigo' => '#6366f1',
        'cyan' => '#06b6d4',
        'blue' => '#2563eb',
    ];

    $outcomes = [
        [
            'number' => '01',
            'color' => '#8b5cf6',
            'soft' => '#f5f3ff',
            'title' => __('Adaptive students who are effective, efficient and productive in their chosen career fields by:'),
            'points' => [
                __('Performing with perseverance and determination.'),
                __('Producing outputs of excellent standards.'),
            ],
        ],
        [
            'number' => '02',
            'color' => '#0d9488',
            'soft' => '#f0fdfa',
            'title' => __('To produce self-directed leaders that possess a Christian worldview and knowledge of scripture by:'),
            'points' => [
                __('Modeling servant leadership.'),
                __('Demonstrating their God-given ability.'),
            ],
        ],
        [
            'number' => '03',
            'color' => '#ef4444',
            'soft' => '#fef2f2',
            'title' => __('To possess critical thinking skills and be effective communicators by:'),
            'points' => [
                __('Expressing ideas, thoughts and emotions with confidence.'),
                __('Solving problems with analytical skills.'),
            ],
        ],
        [
            'number' => '04',
            'color' => '#ec4899',
            'soft' => '#fdf2f8',
            'title' => __('To strive for academic excellence in all fields by:'),
            'points' => [
                __('Engaging actively in the learning process.'),
                __('Being proficient in oral and written skills.'),
            ],
        ],
        [
            'number' => '05',
            'color' => '#e11d48',
            'soft' => '#fff1f2',
            'title' => __('To demonstrate the character of Christ and have love for others by:'),
            'points' => [
                __('Honoring authority.'),
                __('Respecting oneself and others.'),
            ],
        ],
    ];
@endphp

<style>
    .history-timeline-card {
        border-left: 4px solid var(--timeline-color);
    }

    .history-timeline-dot {
        background-color: var(--timeline-color);
        box-shadow: 0 0 0 6px var(--timeline-soft);
    }

    .history-timeline-year {
        color: var(--timeline-color);
    }

    .outcome-card {
        border-top: 4px solid var(--outcome-color);
    }

    .outcome-number {
        color: var(--outcome-color);
        background-color: var(--outcome-soft);
    }

    .outcome-title {
        color: var(--outcome-color);
    }
</style>

{{-- Hero slider --}}
<section
    x-data="{
        activeSlide: 0,
        totalSlides: {{ count($bannerSlides) }},
        timer: null,

        init() {
            this.startSlider();
        },

        destroy() {
            this.stopSlider();
        },

        startSlider() {
            if (this.totalSlides <= 1) return;

            this.stopSlider();

            this.timer = setInterval(() => {
                this.nextSlide();
            }, 5000);
        },

        stopSlider() {
            if (this.timer) {
                clearInterval(this.timer);
                this.timer = null;
            }
        },

        nextSlide() {
            if (this.totalSlides <= 1) return;

            this.activeSlide =
                (this.activeSlide + 1) % this.totalSlides;
        },

        previousSlide() {
            if (this.totalSlides <= 1) return;

            this.activeSlide =
                (this.activeSlide - 1 + this.totalSlides) %
                this.totalSlides;
        }
    }"
    @mouseenter="stopSlider()"
    @mouseleave="startSlider()"
    class="relative isolate min-h-[430px] overflow-hidden bg-[#081747] md:min-h-[520px]"
>
    @if(count($bannerSlides) > 0)
        @foreach($bannerSlides as $index => $slide)
            <div
                x-cloak
                x-show="activeSlide === {{ $index }}"
                x-transition:enter="transition-opacity duration-700"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity duration-700"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0"
            >
                @if(($slide['type'] ?? 'image') === 'video')
                    <video
                        src="{{ asset('storage/' . $slide['file']) }}"
                        autoplay
                        loop
                        muted
                        playsinline
                        preload="metadata"
                        class="h-full w-full object-cover"
                    ></video>
                @else
                    <img
                        src="{{ asset('storage/' . $slide['file']) }}"
                        alt="History and Governance banner {{ $index + 1 }}"
                        class="h-full w-full object-cover object-center"
                    >
                @endif
            </div>
        @endforeach
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

    {{-- Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/55 to-slate-950/20"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/35 via-transparent to-transparent"></div>

    {{-- Hero content --}}
    <div class="relative z-20 mx-auto flex min-h-[430px] max-w-7xl items-center px-6 py-16 md:min-h-[520px] md:px-10">
        <div class="max-w-3xl">
            <div data-aos="fade-right" class="mb-5 flex items-center gap-3">
                <span class="h-1 w-12 rounded-full bg-orange-500"></span>

                <span class="text-sm font-bold uppercase tracking-[0.2em] text-orange-400">
                    {{ __('Our Story') }}
                </span>
            </div>

            <h1 data-aos="fade-up" data-aos-delay="150" class="text-4xl font-black uppercase leading-tight tracking-wide text-white drop-shadow-lg sm:text-5xl md:text-6xl">
                {{ __('History & Governance') }}
            </h1>

            <p data-aos="fade-up" data-aos-delay="300" class="mt-6 max-w-2xl text-base leading-7 text-slate-200 md:text-lg">
                {{ __('Discover the vision, mission and journey that have shaped Life International School.') }}
            </p>
        </div>
    </div>

    {{-- Slider navigation --}}
    @if(count($bannerSlides) > 1)
        <button
            type="button"
            @click="previousSlide()"
            aria-label="Previous slide"
            class="absolute left-4 top-1/2 z-30 hidden h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full border border-white/20 bg-slate-950/30 text-white backdrop-blur-sm transition-colors hover:bg-orange-500 md:flex"
        >
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        <button
            type="button"
            @click="nextSlide()"
            aria-label="Next slide"
            class="absolute right-4 top-1/2 z-30 hidden h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full border border-white/20 bg-slate-950/30 text-white backdrop-blur-sm transition-colors hover:bg-orange-500 md:flex"
        >
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <div class="absolute bottom-10 left-0 right-0 z-30 flex justify-center gap-2 md:bottom-12">
            @foreach($bannerSlides as $index => $slide)
                <button
                    type="button"
                    @click="activeSlide = {{ $index }}"
                    aria-label="Go to slide {{ $index + 1 }}"
                    :class="
                        activeSlide === {{ $index }}
                            ? 'w-8 bg-orange-500'
                            : 'w-3 bg-white/60 hover:bg-white'
                    "
                    class="h-3 rounded-full shadow-md transition-all duration-300"
                ></button>
            @endforeach
        </div>
    @endif

    <div
        class="absolute -bottom-px left-0 z-20 h-10 w-full bg-slate-50 md:h-16"
        style="clip-path: polygon(0 70%, 100% 0, 100% 100%, 0 100%);"
    ></div>
</section>

<div class="bg-slate-50 px-5 py-16 md:px-8 md:py-20">
    <div class="mx-auto max-w-7xl">

        @if($historySetting)
            {{-- Foundation heading --}}
            <div data-aos="fade-up" class="mx-auto mb-12 max-w-3xl text-center">
                <div class="mb-4 flex items-center justify-center gap-3">
                    <span class="h-1 w-10 rounded-full bg-orange-500"></span>

                    <span class="text-sm font-bold uppercase tracking-[0.18em] text-orange-500">
                        {{ __('Our Foundation') }}
                    </span>

                    <span class="h-1 w-10 rounded-full bg-orange-500"></span>
                </div>

                <h2 class="text-3xl font-black text-[#081747] md:text-4xl">
                    {{ __('Guided by Purpose and Faith') }}
                </h2>

                <p class="mt-4 leading-7 text-slate-600">
                    {{ __('Our vision and mission guide every decision, program and learning experience at Life International School.') }}
                </p>
            </div>

            {{-- Vision and Mission --}}
            <div class="mb-20 grid grid-cols-1 gap-8 md:grid-cols-2">
                <article data-aos="fade-right" class="group relative overflow-hidden rounded-[26px] border border-blue-100 bg-white p-7 shadow-[0_12px_40px_rgba(15,23,42,0.08)] transition-all duration-300 hover:-translate-y-2 hover:shadow-xl md:p-10">
                    <div class="absolute left-0 top-0 h-1.5 w-full bg-blue-800"></div>

                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-100 text-blue-800">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14m-6 4h4a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2h4z"></path>
                        </svg>
                    </div>

                    <span class="text-xs font-bold uppercase tracking-[0.18em] text-blue-500">
                        {{ __('Where We Are Going') }}
                    </span>

                    <h3 class="mt-2 text-3xl font-black uppercase text-blue-900">
                        {{ __('Vision') }}
                    </h3>

                    <p class="mt-5 text-base leading-8 text-slate-600 md:text-lg">
                        {{ __($historySetting->vision) }}
                    </p>
                </article>

                <article data-aos="fade-left" data-aos-delay="150" class="group relative overflow-hidden rounded-[26px] border border-orange-100 bg-white p-7 shadow-[0_12px_40px_rgba(15,23,42,0.08)] transition-all duration-300 hover:-translate-y-2 hover:shadow-xl md:p-10">
                    <div class="absolute left-0 top-0 h-1.5 w-full bg-orange-500"></div>

                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-100 text-orange-600">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5A7.5 7.5 0 003 6.253v13A7.5 7.5 0 017.5 18c1.746 0 3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5A7.5 7.5 0 0121 6.253v13A7.5 7.5 0 0016.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>

                    <span class="text-xs font-bold uppercase tracking-[0.18em] text-orange-500">
                        {{ __('What We Do') }}
                    </span>

                    <h3 class="mt-2 text-3xl font-black uppercase text-orange-600">
                        {{ __('Mission') }}
                    </h3>

                    <p class="mt-5 text-base leading-8 text-slate-600 md:text-lg">
                        {{ __($historySetting->mission) }}
                    </p>
                </article>
            </div>

            {{-- Founder message --}}
            @if(filled($historySetting->founder_message) || filled($historySetting->founder_image))
                <section data-aos="fade-up" class="relative mb-24 overflow-hidden rounded-[30px] border border-slate-200 bg-white shadow-[0_15px_50px_rgba(15,23,42,0.1)]">
                    <div class="grid grid-cols-1 lg:grid-cols-[0.8fr_1.2fr]">
                        <div class="relative min-h-[350px] bg-blue-950">
                            @if($historySetting->founder_image)
                                <img
                                    src="{{ asset('storage/' . $historySetting->founder_image) }}"
                                    alt="{{ $historySetting->founder_name ?: 'Founder' }}"
                                    class="absolute inset-0 h-full w-full object-cover"
                                >
                            @else
                                <div class="flex h-full min-h-[350px] items-center justify-center text-blue-200">
                                    {{ __('No founder image') }}
                                </div>
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-blue-950/75 via-transparent to-transparent"></div>
                        </div>

                        <div class="relative p-7 md:p-10 lg:p-12">
                            <svg class="absolute right-8 top-8 h-20 w-20 text-blue-50" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7.17 6A5.17 5.17 0 002 11.17V18h7v-7H5.1A2.07 2.07 0 017.17 9H9V6H7.17zm10 0A5.17 5.17 0 0012 11.17V18h7v-7h-3.9A2.07 2.07 0 0117.17 9H19V6h-1.83z"></path>
                            </svg>

                            <div class="relative">
                                <span class="text-sm font-bold uppercase tracking-[0.18em] text-orange-500">
                                    {{ __('Leadership Message') }}
                                </span>

                                <h2 class="mt-3 text-3xl font-black text-[#081747] md:text-4xl">
                                    {{ __('Message from the Founder') }}
                                </h2>

                                <div class="mt-5 h-1 w-16 rounded-full bg-orange-500"></div>

                                <p class="mt-7 whitespace-pre-line text-base leading-8 text-slate-600 md:text-lg">{{ __($historySetting->founder_message) }}</p>

                                @if($historySetting->founder_blessing)
                                    <p class="mt-6 text-xl font-bold italic text-orange-600">
                                        {{ __($historySetting->founder_blessing) }}
                                    </p>
                                @endif

                                @if($historySetting->founder_name)
                                    <div class="mt-6 border-l-4 border-blue-800 pl-4">
                                        <p class="font-black text-[#081747]">
                                            {{ $historySetting->founder_name }}
                                        </p>
                                        <p class="mt-1 text-sm text-slate-500">
                                            {{ __('Founder, Life International School') }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        @endif

        {{-- History timeline --}}
        @if(count($timelines) > 0)
            <section class="mb-24">
                <div data-aos="fade-up" class="mx-auto mb-14 max-w-3xl text-center">
                    <div class="mb-4 flex items-center justify-center gap-3">
                        <span class="h-1 w-10 rounded-full bg-orange-500"></span>
                        <span class="text-sm font-bold uppercase tracking-[0.18em] text-orange-500">{{ __('Our History') }}</span>
                        <span class="h-1 w-10 rounded-full bg-orange-500"></span>
                    </div>
                    <h2 class="text-3xl font-black uppercase text-[#081747] md:text-5xl">{{ __('Our Journey') }}</h2>
                    <p class="mt-4 leading-7 text-slate-600">{{ __('Important milestones that have shaped our school.') }}</p>
                </div>

                <div class="relative mx-auto max-w-4xl pl-7 md:pl-10">
                    <div class="absolute bottom-0 left-[7px] top-0 w-0.5 bg-slate-200 md:left-[11px]"></div>

                    <div class="space-y-7">
                        @foreach($timelines as $timeline)
                            @php
                                $timelineColor = $timelineColors[$timeline->color] ?? '#2563eb';
                                $timelineSoft = $timelineColor . '20';
                            @endphp

                            <article
                                data-aos="fade-up"
                                class="history-timeline-card relative rounded-2xl bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.07)] transition-all duration-300 hover:-translate-y-1 hover:shadow-lg md:p-8"
                                style="
                                    --timeline-color: {{ $timelineColor }};
                                    --timeline-soft: {{ $timelineSoft }};
                                "
                            >
                                <span class="history-timeline-dot absolute -left-[31px] top-8 h-4 w-4 rounded-full md:-left-[43px]"></span>

                                <span class="history-timeline-year text-2xl font-black">
                                    {{ $timeline->year }}
                                </span>

                                <p class="mt-3 text-base leading-7 text-slate-600">
                                    {{ __($timeline->description) }}
                                </p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Faculty directory --}}
        @if(count($faculties) > 0)
            <section class="mb-24">
                <div data-aos="fade-up" class="mx-auto mb-14 max-w-3xl text-center">
                    <div class="mb-4 flex items-center justify-center gap-3">
                        <span class="h-1 w-10 rounded-full bg-orange-500"></span>
                        <span class="text-sm font-bold uppercase tracking-[0.18em] text-orange-500">{{ __('School Leadership') }}</span>
                        <span class="h-1 w-10 rounded-full bg-orange-500"></span>
                    </div>
                    <h2 class="text-3xl font-black uppercase text-[#081747] md:text-5xl">{{ __('Faculty Directory') }}</h2>
                    <p class="mt-4 leading-7 text-slate-600">{{ __('Meet the dedicated leaders and educators serving our community.') }}</p>
                </div>

                <div class="flex flex-wrap justify-center gap-8">
                    @foreach($faculties as $index => $faculty)
                        <article data-aos="zoom-in" data-aos-delay="{{ ($index % 3) * 150 }}" class="group w-full max-w-[350px] rounded-[26px] border border-slate-200 bg-white p-7 text-center shadow-[0_10px_35px_rgba(15,23,42,0.07)] transition-all duration-300 hover:-translate-y-2 hover:border-blue-200 hover:shadow-xl sm:w-[calc(50%_-_1rem)] lg:w-[calc(33.333%_-_1.35rem)]">
                            <div class="mx-auto h-48 w-48 overflow-hidden rounded-full border-4 border-blue-50 bg-slate-100 shadow-lg transition-all duration-300 group-hover:border-orange-200">
                                @if($faculty->image)
                                    <img
                                        src="{{ asset('storage/' . $faculty->image) }}"
                                        alt="{{ $faculty->name }}"
                                        loading="lazy"
                                        class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                                    >
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-slate-400">
                                        {{ __('No image') }}
                                    </div>
                                @endif
                            </div>

                            <h3 class="mt-6 text-2xl font-black text-[#081747]">
                                {{ $faculty->name }}
                            </h3>

                            <p class="mt-2 text-sm font-bold uppercase tracking-wider text-orange-500">
                                {{ __($faculty->position) }}
                            </p>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- Student expected outcomes --}}
        <section>
            <div data-aos="fade-up" class="mx-auto mb-14 max-w-4xl text-center">
                <div class="mb-4 flex items-center justify-center gap-3">
                    <span class="h-1 w-10 rounded-full bg-orange-500"></span>
                    <span class="text-sm font-bold uppercase tracking-[0.18em] text-orange-500">{{ __('Student Development') }}</span>
                    <span class="h-1 w-10 rounded-full bg-orange-500"></span>
                </div>
                <h2 class="text-3xl font-black uppercase text-[#081747] md:text-5xl">{{ __('Student Expected Outcomes') }}</h2>
                <h3 class="mt-5 text-xl font-bold text-slate-700 md:text-2xl">{{ __('Learning from one another and growing together.') }}</h3>
                <p class="mt-5 text-base leading-8 text-slate-600 md:text-lg">
                    {{ __('We strive to build a healthy community in which students and teachers contribute their God-given talents for the benefit of all.') }}
                </p>
            </div>

            <div class="flex flex-wrap justify-center gap-7">
                @foreach($outcomes as $index => $outcome)
                    <article
                        data-aos="fade-up"
                        data-aos-delay="{{ ($index % 2) * 150 }}"
                        class="outcome-card group w-full rounded-[24px] bg-white p-7 shadow-[0_10px_35px_rgba(15,23,42,0.07)] transition-all duration-300 hover:-translate-y-2 hover:shadow-xl md:w-[calc(50%_-_0.875rem)]"
                        style="
                            --outcome-color: {{ $outcome['color'] }};
                            --outcome-soft: {{ $outcome['soft'] }};
                        "
                    >
                        <div class="flex flex-col gap-5 sm:flex-row">
                            <div class="outcome-number flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl text-lg font-black">
                                {{ $outcome['number'] }}
                            </div>

                            <div>
                                <h3 class="outcome-title text-lg font-black leading-7">
                                    {{ $outcome['title'] }}
                                </h3>

                                <ul class="mt-5 space-y-3">
                                    @foreach($outcome['points'] as $point)
                                        <li class="flex items-start gap-3 text-slate-600">
                                            <svg
                                                class="mt-1 h-5 w-5 shrink-0"
                                                style="color: {{ $outcome['color'] }}"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span class="leading-7">{{ $point }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    </div>
</div>

@endsection