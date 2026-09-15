@extends('layout')

@section('title', 'Campus - Life International School')

@section('content')

<style>
    .campus-embed iframe {
        width: 100% !important;
        height: 100% !important;
        border: 0 !important;
        display: block !important;
    }
</style>

@php
    $campusTitle = $campus?->title ?: 'LIS Campus Tour';

    $campusDescription = $campus?->description
        ?: 'Discover the learning spaces, facilities, and welcoming environment of Life International School.';

    $campusPhone = $campus?->phone ?: '+855 12 345 678';

    $campusPhoneLink = preg_replace(
        '/[^0-9+]/',
        '',
        $campusPhone
    );
@endphp

<div class="w-full min-h-screen bg-slate-50">

    {{-- Hero Banner --}}
    <section
        class="relative min-h-[460px] md:min-h-[560px]
               flex items-center overflow-hidden
               bg-gradient-to-br from-[#071b4b] via-[#0f2d72]
               to-[#1a4a9c]"
    >
        {{-- Decorative background pattern --}}
        <div
            class="absolute inset-0 opacity-15"
            style="
                background-image:
                    radial-gradient(
                        circle,
                        rgba(255,255,255,.8) 1px,
                        transparent 1px
                    );
                background-size: 24px 24px;
            "
        ></div>

        {{-- Ambient Glow Orbs --}}
        <div
            class="absolute -top-24 -right-24 w-96 h-96
                   rounded-full bg-cyan-400/20 blur-3xl pointer-events-none"
        ></div>

        <div
            class="absolute -bottom-28 -left-20 w-96 h-96
                   rounded-full bg-orange-500/15 blur-3xl pointer-events-none"
        ></div>

        {{-- Hero Content --}}
        <div
            class="relative z-10 max-w-7xl mx-auto w-full
                   px-6 md:px-12 pt-16 pb-24 text-center"
        >
            {{-- Breadcrumb --}}
            <div
                data-aos="fade-down"
                class="inline-flex flex-wrap justify-center items-center
                       gap-2 text-sm md:text-base text-blue-200
                       font-medium mb-6 px-4 py-1.5 rounded-full bg-white/5 border border-white/10 backdrop-blur-sm"
            >
                <a
                    href="{{ url('/') }}"
                    class="hover:text-orange-400 transition-colors"
                >
                    Home
                </a>

                <svg
                    class="w-4 h-4 text-blue-300"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5l7 7-7 7"
                    />
                </svg>

                <span class="text-orange-400 font-semibold">
                    Campus
                </span>
            </div>

            {{-- Small label --}}
            <div
                data-aos="fade-up" data-aos-delay="100"
                class="inline-flex items-center gap-3 mb-6
                       text-orange-300 font-bold uppercase
                       tracking-[0.25em] text-xs md:text-sm"
            >
                <span class="w-8 md:w-12 h-0.5 bg-orange-400 rounded-full"></span>
                Campus Experience
                <span class="w-8 md:w-12 h-0.5 bg-orange-400 rounded-full"></span>
            </div>

            <h1
                data-aos="zoom-in" data-aos-delay="200"
                class="text-4xl sm:text-5xl md:text-7xl
                       font-black text-white uppercase
                       tracking-tight leading-tight drop-shadow-xl"
            >
                {{ $campusTitle }}
            </h1>

            <p
                data-aos="fade-up" data-aos-delay="300"
                class="max-w-3xl mx-auto mt-6 text-base md:text-xl
                       text-blue-100 leading-relaxed font-light"
            >
                {{ $campusDescription }}
            </p>

            <a
                data-aos="fade-up" data-aos-delay="400"
                href="#campus-tour"
                class="inline-flex items-center gap-3 mt-9
                       bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600
                       text-white font-bold px-8 py-3.5
                       rounded-xl shadow-lg hover:shadow-orange-500/25
                       hover:-translate-y-0.5 transition-all"
            >
                Explore Our Campus

                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 9l-7 7-7-7"
                    />
                </svg>
            </a>
        </div>

        {{-- Soft Organic Wave Transition to Content (bg-slate-50) --}}
        <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none z-20 pointer-events-none">
            <svg class="relative block w-full h-10 sm:h-14 md:h-16 text-slate-50" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0 C200,50 450,15 600,35 C800,60 1000,15 1200,40 L1200,120 L0,120 Z" fill="currentColor"></path>
            </svg>
        </div>
    </section>

    {{-- Main Content --}}
    <main
        id="campus-tour"
        class="max-w-7xl mx-auto px-5 md:px-8
               py-14 md:py-20 scroll-mt-24"
    >
        {{-- Section Heading --}}
        <div data-aos="fade-up" class="max-w-3xl mx-auto text-center mb-12">
            <span
                class="inline-flex items-center gap-2
                       text-blue-700 bg-blue-50 border border-blue-100
                       rounded-full px-4 py-2 text-xs font-bold
                       uppercase tracking-widest"
            >
                Virtual Experience
            </span>

            <h2
                class="text-3xl md:text-5xl font-black
                       text-slate-900 mt-5"
            >
                Take a Tour of Our Campus
            </h2>

            <p class="text-gray-600 mt-4 text-base md:text-lg">
                Explore the facilities and learning environment that make
                Life International School a welcoming place for every student.
            </p>
        </div>

        {{-- Video --}}
        <section
            data-aos="zoom-in" data-aos-delay="100"
            class="bg-white rounded-2xl md:rounded-3xl
                   shadow-xl border border-gray-100
                   overflow-hidden mb-12"
        >
            <div
                class="flex flex-col sm:flex-row sm:items-center
                       sm:justify-between gap-3 px-6 md:px-8 py-5
                       border-b border-gray-100"
            >
                <div>
                    <p
                        class="text-orange-500 text-xs font-bold
                               uppercase tracking-widest mb-1"
                    >
                        Watch Video
                    </p>

                    <h3 class="text-xl md:text-2xl font-black text-slate-900">
                        Life International School Tour
                    </h3>
                </div>

                <div
                    class="w-11 h-11 rounded-full bg-orange-100
                           text-orange-600 flex items-center justify-center"
                >
                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"
                        />
                    </svg>
                </div>
            </div>

            @if(filled($campus?->video_url))
                <div
                    class="campus-embed aspect-video bg-black"
                >
                    {!! $campus->video_url !!}
                </div>
            @else
                <div
                    class="aspect-video bg-slate-900
                           flex flex-col items-center justify-center
                           text-center px-6"
                >
                    <div
                        class="w-16 h-16 rounded-full bg-white/10
                               text-white flex items-center justify-center
                               mb-4"
                    >
                        <svg
                            class="w-8 h-8"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M14.752 11.168l-3.197-2.132A1 1 0
                                   0010 9.868v4.264a1 1 0 001.555.832
                                   l3.197-2.132a1 1 0 000-1.664z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 12a9 9 0 11-18 0
                                   9 9 0 0118 0z"
                            />
                        </svg>
                    </div>

                    <p class="text-white font-bold">
                        Campus video is coming soon
                    </p>
                </div>
            @endif
        </section>

        {{-- Information and Map --}}
        <section
            class="grid grid-cols-1 lg:grid-cols-2
                   gap-8 lg:gap-12 items-stretch"
        >
            {{-- Contact Information --}}
            <div
                data-aos="fade-right" data-aos-delay="200"
                class="bg-white p-7 md:p-10 rounded-2xl md:rounded-3xl
                       shadow-xl border border-gray-100"
            >
                <p
                    class="text-orange-500 text-xs font-bold
                           uppercase tracking-widest mb-2"
                >
                    Visit Our School
                </p>

                <h2
                    class="text-3xl md:text-4xl font-black
                           text-slate-900 mb-8"
                >
                    Campus Information
                </h2>

                {{-- Location --}}
                <div class="flex items-start gap-5">
                    <div
                        class="w-14 h-14 shrink-0 bg-blue-50
                               rounded-2xl text-blue-600
                               flex items-center justify-center"
                    >
                        <svg
                            class="w-7 h-7"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998
                                   1.998 0 01-2.827 0l-4.243-4.243
                                   a8 8 0 1111.314 0z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 11a3 3 0 11-6 0
                                   3 3 0 016 0z"
                            />
                        </svg>
                    </div>

                    <div>
                        <p
                            class="text-xs text-gray-400 font-bold
                                   uppercase tracking-widest mb-1"
                        >
                            Location
                        </p>

                        <h3 class="text-xl font-black text-slate-900">
                            Life International School
                        </h3>

                        <p class="text-gray-600 mt-1">
                            Preah Sihanouk, Cambodia
                        </p>
                    </div>
                </div>

                <hr class="border-gray-100 my-7">

                {{-- Phone --}}
                <div class="flex items-start gap-5">
                    <div
                        class="w-14 h-14 shrink-0 bg-orange-50
                               rounded-2xl text-orange-600
                               flex items-center justify-center"
                    >
                        <svg
                            class="w-7 h-7"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0
                                   01.948.684l1.498 4.493a1 1 0
                                   01-.502 1.21l-2.257 1.13a11.042
                                   11.042 0 005.516 5.516l1.13-2.257
                                   a1 1 0 011.21-.502l4.493 1.498
                                   a1 1 0 01.684.949V19a2 2 0 01-2
                                   2h-1C9.716 21 3 14.284 3 6V5z"
                            />
                        </svg>
                    </div>

                    <div>
                        <p
                            class="text-xs text-gray-400 font-bold
                                   uppercase tracking-widest mb-1"
                        >
                            Contact Us
                        </p>

                        <a
                            href="tel:{{ $campusPhoneLink }}"
                            class="text-xl md:text-2xl font-black
                                   text-slate-900 hover:text-orange-600
                                   transition-colors"
                        >
                            {{ $campusPhone }}
                        </a>
                    </div>
                </div>

                <a
                    href="{{ url('/contact-us') }}"
                    class="mt-9 w-full inline-flex items-center
                           justify-center gap-2 bg-blue-900
                           hover:bg-blue-800 text-white font-bold
                           py-4 px-6 rounded-xl shadow-md
                           hover:-translate-y-0.5 transition-all"
                >
                    Contact the School

                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3"
                        />
                    </svg>
                </a>
            </div>

            {{-- Map --}}
            <div
                data-aos="fade-left" data-aos-delay="300"
                class="bg-white rounded-2xl md:rounded-3xl
                       shadow-xl border border-gray-100
                       overflow-hidden min-h-[400px] lg:min-h-full"
            >
                @if(filled($campus?->map_embed_url))
                    <div class="campus-embed w-full h-full min-h-[400px]">
                        {!! $campus->map_embed_url !!}
                    </div>
                @else
                    <div
                        class="w-full h-full min-h-[400px]
                               bg-gradient-to-br from-blue-50
                               to-slate-100 flex flex-col
                               items-center justify-center text-center px-6"
                    >
                        <div
                            class="w-16 h-16 rounded-full bg-blue-100
                                   text-blue-700 flex items-center
                                   justify-center mb-4"
                        >
                            <svg
                                class="w-8 h-8"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 20l-5.447-2.724A1 1 0
                                       013-.894V5.618a1 1 0 01.553-.894
                                       L9 4m0 16l6-3m-6 3V4m6 13
                                       l4.447 2.224A1 1 0 0021
                                       18.382V7.618a1 1 0 00-.553-.894
                                       L15 4m0 13V4m0 0L9 4"
                                />
                            </svg>
                        </div>

                        <h3 class="text-xl font-black text-slate-900">
                            Campus Map
                        </h3>

                        <p class="text-gray-500 mt-2">
                            The campus map will be available soon.
                        </p>
                    </div>
                @endif
            </div>
        </section>
    </main>
</div>

@endsection