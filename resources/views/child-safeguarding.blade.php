@extends('layout')

@section('title', 'Child Safeguarding - Life International School')

@section('content')

<style>
    .safeguarding-embed iframe {
        width: 100% !important;
        height: 100% !important;
        border: 0 !important;
        display: block !important;
    }
</style>

@php
    $mainInfo = $safeguardings->first();
    $pageTitle = $mainInfo?->title ?: 'Child Safeguarding';
    $pageDescription = $mainInfo?->description ?: 'At Life International School, the safety, protection, and well-being of every child is our highest priority.';
@endphp

<div x-data="{
        lightboxOpen: false,
        activeImage: '',
        openImage(image) {
            this.activeImage = image;
            this.lightboxOpen = true;
        },
        closeImage() {
            this.lightboxOpen = false;
            setTimeout(() => {
                this.activeImage = '';
            }, 300);
        }
    }"
    x-effect="document.body.classList.toggle('overflow-hidden', lightboxOpen)"
    @keydown.escape.window="closeImage()"
    class="w-full min-h-screen bg-slate-50">

    {{-- Hero Banner --}}
    <section class="relative min-h-[480px] md:min-h-[600px] flex items-center overflow-hidden bg-gradient-to-br from-[#071b4b] via-[#1746a2] to-[#4f6ee8]">
        
        {{-- Background pattern --}}
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle, rgba(255,255,255,.8) 1px, transparent 1px); background-size: 24px 24px;"></div>

        {{-- Decorative lights --}}
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-cyan-300/20 blur-3xl"></div>
        <div class="absolute -bottom-32 -left-20 w-[420px] h-[420px] rounded-full bg-orange-400/15 blur-3xl"></div>

        <div class="relative z-10 max-w-7xl mx-auto w-full px-6 md:px-12 py-20">
            <div class="max-w-4xl">

                {{-- Breadcrumb --}}
                <div data-aos="fade-down" class="flex flex-wrap items-center gap-2 text-sm md:text-base font-semibold text-blue-100 mb-8">
                    <a href="{{ url('/') }}" class="hover:text-orange-400 transition-colors">Home</a>
                    <svg class="w-4 h-4 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-orange-400">Child Safeguarding</span>
                </div>

                {{-- Small label --}}
                <div data-aos="fade-up" data-aos-delay="100" class="inline-flex items-center gap-4 text-orange-300 font-bold uppercase tracking-[0.22em] text-xs md:text-sm mb-6">
                    <span class="w-12 md:w-20 h-1 bg-orange-400 rounded-full"></span>
                    Safe • Protected • Supported
                </div>

                <h1 data-aos="fade-up" data-aos-delay="200" class="max-w-4xl text-4xl sm:text-5xl md:text-7xl font-black text-white uppercase tracking-wide leading-[1.05] drop-shadow-xl whitespace-pre-line">
                    {{ $pageTitle }}
                </h1>

                <p data-aos="fade-up" data-aos-delay="300" class="max-w-3xl mt-7 text-base md:text-xl text-blue-100 font-medium leading-relaxed">
                    {{ $pageDescription }}
                </p>

                @if(filled($mainInfo?->pdf_file))
                    <a data-aos="fade-up" data-aos-delay="400" href="{{ Storage::url($mainInfo->pdf_file) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-3 mt-9 bg-orange-500 hover:bg-orange-600 text-white font-bold uppercase tracking-wider px-7 py-4 rounded-xl shadow-xl hover:-translate-y-1 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Child Protection Policy
                    </a>
                @endif
            </div>
        </div>

        {{-- Bottom shape --}}
        <div class="absolute bottom-0 left-0 w-full h-12 md:h-20 bg-slate-50" style="clip-path: polygon(0 72%, 48% 100%, 100% 50%, 100% 100%, 0 100%);"></div>
    </section>

    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto px-5 md:px-8 py-16 md:py-24">

        {{-- Section Heading --}}
        <div data-aos="fade-up" class="max-w-3xl mx-auto text-center mb-14">
            <span class="inline-flex items-center gap-2 text-blue-700 bg-blue-50 border border-blue-100 rounded-full px-4 py-2 text-xs font-bold uppercase tracking-widest">
                Our Commitment
            </span>
            <h2 class="text-3xl md:text-5xl font-black text-slate-900 mt-5">
                Our Safeguarding Measures
            </h2>
            <p class="text-gray-600 text-base md:text-lg leading-relaxed mt-5">
                We are committed to creating a safe, respectful, and supportive environment where every child can learn, grow, and thrive.
            </p>
        </div>

        {{-- Safeguarding Records --}}
        <div class="space-y-16 md:space-y-24">
            @forelse($safeguardings as $item)

                @php
                    $images = is_array($item->images) ? array_values(array_filter($item->images)) : (filled($item->images) ? [$item->images] : []);
                    $hasVideo = filled($item->video_url);
                    $hasImages = count($images) > 0;
                @endphp

                @if($hasVideo || $hasImages)
                    <section data-aos="fade-up" class="bg-white rounded-2xl md:rounded-[2rem] shadow-xl border border-gray-100 overflow-hidden">
                        
                        {{-- Record header --}}
                        @if($safeguardings->count() > 1)
                            <div class="px-6 md:px-10 py-7 border-b border-gray-100">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                                    <div>
                                        <p class="text-orange-500 text-xs font-bold uppercase tracking-widest mb-2">Safeguarding Program</p>
                                        <h3 class="text-2xl md:text-3xl font-black text-slate-900">{{ $item->title ?: 'Child Safeguarding' }}</h3>
                                    </div>

                                    @if($hasImages)
                                        <span class="inline-flex items-center self-start gap-2 bg-blue-50 text-blue-700 border border-blue-100 rounded-full px-4 py-2 text-sm font-bold">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ count($images) }} {{ count($images) === 1 ? 'Photo' : 'Photos' }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div class="p-5 md:p-10">

                            {{-- Video --}}
                            @if($hasVideo)
                                <div data-aos="fade-right" class="{{ $hasImages ? 'mb-12 md:mb-16' : '' }}">
                                    <div class="flex items-center gap-3 mb-5">
                                        <div class="w-11 h-11 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-bold uppercase tracking-widest text-orange-500">Watch</p>
                                            <h4 class="text-xl font-black text-slate-900">Safeguarding Video</h4>
                                        </div>
                                    </div>
                                    <div class="safeguarding-embed aspect-video bg-black rounded-xl md:rounded-2xl overflow-hidden shadow-xl">
                                        {!! $item->video_url !!}
                                    </div>
                                </div>
                            @endif

                            {{-- Gallery --}}
                            @if($hasImages)
                                <div>
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
                                        <div>
                                            <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-1">Photo Gallery</p>
                                            <h4 class="text-xl md:text-2xl font-black text-slate-900">Safeguarding Activities</h4>
                                        </div>
                                        <p class="text-sm text-gray-500">Click an image to view it larger</p>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                                        @foreach($images as $index => $imagePath)
                                            <button data-aos="zoom-in" data-aos-delay="{{ ($index % 3) * 150 }}" type="button" @click="openImage(@js(Storage::url($imagePath)))" class="relative aspect-[4/3] rounded-2xl overflow-hidden bg-gray-100 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-500 group text-left">
                                                <img src="{{ Storage::url($imagePath) }}" alt="{{ $item->title ?: 'Safeguarding' }} image {{ $index + 1 }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" loading="lazy">
                                                <div class="absolute inset-0 bg-gradient-to-t from-blue-950/75 via-transparent to-transparent opacity-60 group-hover:opacity-90 transition-opacity"></div>
                                                <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between">
                                                    <span class="text-white text-sm font-bold">Photo {{ $index + 1 }}</span>
                                                    <span class="w-10 h-10 rounded-full bg-white/90 text-blue-900 flex items-center justify-center translate-y-2 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition-all">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                        </div>
                    </section>
                @endif
            @empty
                <div data-aos="fade-up" class="max-w-2xl mx-auto bg-white border border-gray-100 rounded-3xl shadow-lg p-10 text-center">
                    <div class="w-16 h-16 mx-auto rounded-full bg-blue-50 text-blue-700 flex items-center justify-center mb-5">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M5.07 19H18.93c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900">Content Coming Soon</h3>
                    <p class="text-gray-500 mt-3">Safeguarding information will be available soon.</p>
                </div>
            @endforelse
        </div>
    </main>

    {{-- Image Lightbox --}}
    <div x-show="lightboxOpen" x-cloak @click.self="closeImage()" class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/95 backdrop-blur-sm p-4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <button type="button" @click="closeImage()" aria-label="Close image" class="absolute top-5 right-5 md:top-8 md:right-8 w-12 h-12 rounded-full bg-white/10 hover:bg-orange-500 text-white flex items-center justify-center transition-colors z-20">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <img :src="activeImage" alt="Safeguarding image preview" class="max-w-full max-h-[88vh] object-contain rounded-xl shadow-2xl" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
    </div>
</div>

@endsection