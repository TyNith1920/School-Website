@extends('layout')

@section('title', 'Accreditations - Life International School')

@section('content')

    @php
        // 📍 មុខងារទាញរូបភាពពី Cloudflare R2 (s3)
        $getMediaUrl = function($path) {
            if (empty($path)) return null;
            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) return $path;
            try { 
                return \Storage::disk('s3')->url($path); 
            } catch (\Exception $e) { 
                return asset('storage/' . $path); 
            }
        };
    @endphp

    <style>
        .bg-warm {
            background-color: #fdfaf6;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>

    <div class="bg-warm font-sans text-gray-900 w-full pb-10">

        {{-- High-End Modern Accreditations Banner --}}
        <div class="relative w-full min-h-[460px] md:min-h-[560px] lg:min-h-[620px] bg-[#0b1240] overflow-hidden flex items-end md:items-center">
            
            {{-- Background Image --}}
            @if(isset($setting) && $setting->banner_image)
                <div class="absolute inset-0 bg-cover bg-center md:bg-[center_top_15%] transition-transform duration-1000 scale-100 hover:scale-105"
                     style="background-image: url('{{ $getMediaUrl($setting->banner_image) }}');">
                </div>
            @else
                <div class="absolute inset-0 bg-[#0b1240]"></div>
            @endif

            {{-- Vignette & Deep Navy Gradients --}}
            <div class="absolute inset-0 bg-gradient-to-t from-[#0b1240] via-[#0b1240]/40 to-black/30"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#0b1240]/80 via-[#0b1240]/40 to-transparent hidden md:block"></div>

            {{-- Ambient Floating Glow --}}
            <div class="absolute top-10 left-10 w-72 h-72 bg-[#e06d64]/20 rounded-full blur-3xl pointer-events-none"></div>

            {{-- Content / Floating Glass Card --}}
            <div class="relative z-10 w-full max-w-[1400px] mx-auto px-6 md:px-12 py-16 md:py-24">
                <div class="max-w-2xl bg-white/10 backdrop-blur-md p-6 md:p-8 rounded-2xl border border-white/20 shadow-2xl"
                     data-aos="fade-up" data-aos-duration="1000">
                    
                    {{-- Official Tag --}}
                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#e06d64] text-white text-xs font-bold tracking-wider uppercase mb-4 shadow-sm">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Global Standards & Recognition
                    </div>

                    {{-- Title --}}
                    <h1 class="text-2xl sm:text-3xl md:text-5xl font-black text-white tracking-tight leading-tight uppercase drop-shadow-md">
                        Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-200 to-[#e06d64]">Accreditations</span>
                    </h1>

                    {{-- Subtitle --}}
                    <p class="text-gray-100 text-xs sm:text-sm md:text-base mt-3 leading-relaxed font-light drop-shadow">
                        Committed to educational excellence through accredited programs, recognized both by national ministries and global education institutions.
                    </p>

                    {{-- Breadcrumb Navigation --}}
                    <div class="flex items-center gap-2 text-xs font-medium text-gray-300 mt-5 pt-4 border-t border-white/15">
                        <a href="/" class="hover:text-[#e06d64] transition">Home</a>
                        <span>/</span>
                        <span class="text-orange-200">About Us</span>
                        <span>/</span>
                        <span class="text-[#e06d64] font-bold">Accreditations</span>
                    </div>
                </div>
            </div>

            {{-- Soft Wave Transition ភ្ជាប់ទៅផ្ទៃខាងក្រោម (#fdfaf6) យ៉ាងរលូន --}}
            <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none z-20 pointer-events-none">
                <svg class="relative block w-full h-10 sm:h-14 md:h-18 lg:h-20 text-[#fdfaf6]" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M0,0 C200,60 450,20 600,45 C800,75 1000,20 1200,50 L1200,120 L0,120 Z" fill="currentColor"></path>
                </svg>
            </div>
        </div>

        <div class="max-w-[1400px] mx-auto px-5 md:px-12 py-12">

            {{-- Accreditation Logos --}}
            <div class="flex flex-wrap justify-center items-center gap-10 md:gap-20 mb-16">
                @foreach($accreditations as $acc)
                    @if($acc->logo)
                        <img
                            data-aos="zoom-in"
                            data-aos-delay="{{ $loop->index * 150 }}"
                            src="{{ $getMediaUrl($acc->logo) }}"
                            alt="{{ $acc->name }}"
                            class="h-20 md:h-28 max-w-[220px] object-contain transition-transform duration-300 hover:scale-105"
                            loading="lazy"
                        >
                    @endif
                @endforeach
            </div>

            {{-- Accreditation Details --}}
            @foreach($accreditations as $acc)

                @php
                    $documentImages = is_array($acc->document_image)
                        ? array_values(array_filter($acc->document_image))
                        : (filled($acc->document_image) ? [$acc->document_image] : []);

                    $galleryImages = is_array($acc->gallery)
                        ? array_values(array_filter($acc->gallery))
                        : (filled($acc->gallery) ? [$acc->gallery] : []);

                    $hasDocuments = count($documentImages) > 0;
                    $hasGallery = count($galleryImages) > 0;
                @endphp

                @if($hasDocuments || $hasGallery)
                    <section class="mb-28 md:mb-40 overflow-hidden">

                        <h2 data-aos="fade-up" class="text-3xl md:text-5xl font-extrabold text-center text-black mb-12 md:mb-20">
                            {{ $acc->name }}
                        </h2>

                        @if($acc->description)
                            <p data-aos="fade-up" data-aos-delay="100" class="max-w-4xl mx-auto text-center text-gray-700 leading-relaxed mb-12">
                                {{ $acc->description }}
                            </p>
                        @endif

                        <div class="flex flex-col xl:flex-row gap-10 xl:gap-16 items-center justify-center">

                            {{-- Certificate Images Slider --}}
                            @if($hasDocuments)
                                <div data-aos="fade-right" data-aos-delay="200" class="w-full {{ $hasGallery ? 'xl:w-5/12' : 'max-w-3xl mx-auto' }}">
                                    <h3 class="text-xl font-bold text-center mb-5">
                                        Certificates
                                    </h3>

                                    <div
                                        x-data="{
                                            activeDocument: 0,
                                            totalDocuments: {{ count($documentImages) }}
                                        }"
                                        class="relative w-full group"
                                    >
                                        <div class="relative w-full min-h-[480px] md:min-h-[650px] overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xl">
                                            @foreach($documentImages as $index => $documentImage)
                                                <a
                                                    x-show="activeDocument === {{ $index }}"
                                                    x-transition.opacity
                                                    x-cloak
                                                    href="{{ $getMediaUrl($documentImage) }}"
                                                    target="_blank"
                                                    rel="noopener noreferrer"
                                                    class="absolute inset-0 flex items-center justify-center p-4 md:p-6"
                                                >
                                                    <img
                                                        src="{{ $getMediaUrl($documentImage) }}"
                                                        alt="{{ $acc->name }} certificate {{ $index + 1 }}"
                                                        class="w-full h-full object-contain"
                                                        loading="lazy"
                                                    >
                                                </a>
                                            @endforeach
                                        </div>

                                        {{-- Certificate Navigation --}}
                                        @if(count($documentImages) > 1)
                                            <button
                                                type="button"
                                                aria-label="Previous certificate"
                                                @click="activeDocument = activeDocument === 0 ? totalDocuments - 1 : activeDocument - 1"
                                                class="absolute left-3 md:left-5 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-gray-900 w-11 h-11 flex items-center justify-center rounded-full shadow-lg opacity-100 md:opacity-0 md:group-hover:opacity-100 transition-all"
                                            >
                                                ❮
                                            </button>

                                            <button
                                                type="button"
                                                aria-label="Next certificate"
                                                @click="activeDocument = activeDocument === totalDocuments - 1 ? 0 : activeDocument + 1"
                                                class="absolute right-3 md:right-5 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-gray-900 w-11 h-11 flex items-center justify-center rounded-full shadow-lg opacity-100 md:opacity-0 md:group-hover:opacity-100 transition-all"
                                            >
                                                ❯
                                            </button>

                                            {{-- Certificate Dots --}}
                                            <div class="flex justify-center flex-wrap gap-2 mt-5">
                                                @foreach($documentImages as $index => $documentImage)
                                                    <button
                                                        type="button"
                                                        aria-label="Open certificate {{ $index + 1 }}"
                                                        @click="activeDocument = {{ $index }}"
                                                        class="w-3 h-3 rounded-full transition"
                                                        :class="activeDocument === {{ $index }} ? 'bg-blue-800' : 'bg-gray-300'"
                                                    ></button>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            {{-- Activity Gallery Slider --}}
                            @if($hasGallery)
                                <div data-aos="fade-left" data-aos-delay="300" class="w-full {{ $hasDocuments ? 'xl:w-7/12' : 'max-w-6xl mx-auto' }} flex flex-col justify-center">
                                    <h3 class="text-xl font-bold text-center mb-5">
                                        Activity Gallery
                                    </h3>

                                    <div
                                        x-data="{
                                            activeSlide: 0,
                                            totalSlides: {{ count($galleryImages) }}
                                        }"
                                        class="relative w-full group"
                                    >
                                        <div class="relative w-full h-[350px] md:h-[600px] overflow-hidden rounded-2xl bg-gray-100 shadow-2xl">
                                            @foreach($galleryImages as $index => $image)
                                                <a
                                                    x-show="activeSlide === {{ $index }}"
                                                    x-transition.opacity
                                                    x-cloak
                                                    href="{{ $getMediaUrl($image) }}"
                                                    target="_blank"
                                                    rel="noopener noreferrer"
                                                    class="absolute inset-0"
                                                >
                                                    <img
                                                        src="{{ $getMediaUrl($image) }}"
                                                        class="w-full h-full object-cover"
                                                        alt="{{ $acc->name }} gallery image {{ $index + 1 }}"
                                                        loading="lazy"
                                                    >
                                                </a>
                                            @endforeach
                                        </div>

                                        {{-- Gallery Navigation --}}
                                        @if(count($galleryImages) > 1)
                                            <button
                                                type="button"
                                                aria-label="Previous gallery image"
                                                @click="activeSlide = activeSlide === 0 ? totalSlides - 1 : activeSlide - 1"
                                                class="absolute left-3 md:left-6 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-black w-11 h-11 md:w-12 md:h-12 flex justify-center items-center rounded-full shadow-lg opacity-100 md:opacity-0 md:group-hover:opacity-100 transition-all"
                                            >
                                                ❮
                                            </button>

                                            <button
                                                type="button"
                                                aria-label="Next gallery image"
                                                @click="activeSlide = activeSlide === totalSlides - 1 ? 0 : activeSlide + 1"
                                                class="absolute right-3 md:right-6 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-black w-11 h-11 md:w-12 md:h-12 flex justify-center items-center rounded-full shadow-lg opacity-100 md:opacity-0 md:group-hover:opacity-100 transition-all"
                                            >
                                                ❯
                                            </button>

                                            {{-- Gallery Counter --}}
                                            <div class="absolute bottom-4 right-4 bg-black/60 text-white text-sm px-3 py-1.5 rounded-full">
                                                <span x-text="activeSlide + 1"></span>
                                                /
                                                {{ count($galleryImages) }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                        </div>
                    </section>
                @endif
            @endforeach

        </div>
    </div>

@endsection