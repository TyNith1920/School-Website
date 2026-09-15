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

        {{-- Banner --}}
        @if(isset($setting) && $setting->banner_image)
            <div
                class="relative w-full h-[300px] md:h-[500px] bg-cover bg-center"
                style="background-image: url('{{ $getMediaUrl($setting->banner_image) }}');"
            >
                <div class="absolute inset-0 bg-black bg-opacity-30"></div>

                <div
                    class="absolute bottom-0 w-full bg-warm h-24 md:h-32"
                    style="clip-path: polygon(0 100%, 100% 0, 100% 100%);"
                ></div>
            </div>
        @else
            <div
                class="relative w-full h-[300px] md:h-[500px] bg-[#1a365d] overflow-hidden"
            >
                <div
                    class="absolute inset-0 opacity-20"
                    style="
                        background-image:
                            radial-gradient(
                                circle,
                                #ffffff 1px,
                                transparent 1px
                            );
                        background-size: 20px 20px;
                    "
                ></div>

                <div
                    class="absolute bottom-0 w-full bg-warm h-24 md:h-32"
                    style="clip-path: polygon(0 100%, 100% 0, 100% 100%);"
                ></div>
            </div>
        @endif

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