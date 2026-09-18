@extends('layout')

@section('title', 'Child Safeguarding & Protection - Life International School')

@section('content')

<style>
    .safeguarding-embed iframe {
        width: 100% !important;
        height: 100% !important;
        border: 0 !important;
        display: block !important;
    }

    [x-cloak] {
        display: none !important;
    }
</style>

@php
    $mainInfo = $safeguardings->first();
    $pageTitle = $mainInfo?->title ?: 'Child Safeguarding & Protection';
    $pageDescription = $mainInfo?->description ?: 'At Life International School, the safety, dignity, and emotional well-being of every child under our care is our highest, uncompromising priority.';

    // 📍 មុខងារទាញឯកសារ PDF និងរូបភាពពី Cloudflare R2 (s3)
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
    class="w-full min-h-screen bg-[#f8fafc] text-slate-800">

    {{-- 🛡️ 1. The Sanctuary Shield Hero (ទំនុកចិត្ត សុវត្ថិភាព និងភាពកក់ក្ដៅ) --}}
    <section class="relative overflow-hidden bg-gradient-to-b from-[#051131] via-[#091b48] to-[#0f2a6b] text-white pt-16 pb-28 md:pb-36">
        
        {{-- Ambient Protection Glow --}}
        <div class="absolute -top-28 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-gradient-to-b from-emerald-500/15 via-blue-400/10 to-transparent blur-[120px] pointer-events-none"></div>
        <div class="absolute top-1/3 -right-24 w-80 h-80 rounded-full bg-amber-400/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 max-w-6xl mx-auto px-6 text-center">
            
            {{-- Shield Badge --}}
            <div data-aos="fade-down" class="inline-flex items-center gap-2 rounded-full border border-emerald-400/30 bg-emerald-500/10 px-5 py-1.5 text-xs md:text-sm font-bold uppercase tracking-[0.2em] text-emerald-300 backdrop-blur-md mb-6 shadow-sm">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                Zero Tolerance for Harm • ACSI Standards
            </div>

            <h1 data-aos="fade-up" data-aos-delay="100" class="text-3xl sm:text-5xl md:text-6xl lg:text-7xl font-black uppercase tracking-tight text-white leading-tight">
                Protecting Every Child. <br class="hidden sm:inline">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 via-teal-200 to-amber-300">Nurturing Every Future.</span>
            </h1>

            <p data-aos="fade-up" data-aos-delay="200" class="mx-auto mt-6 max-w-3xl text-base sm:text-lg text-blue-100/90 leading-relaxed font-light">
                {{ $pageDescription }}
            </p>

            {{-- Policy PDF Quick Action Button --}}
            @if(filled($mainInfo?->pdf_file))
                <div data-aos="fade-up" data-aos-delay="300" class="mt-8 flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ $getMediaUrl($mainInfo->pdf_file) }}" target="_blank" rel="noopener noreferrer" 
                       class="inline-flex items-center gap-2.5 bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white font-black uppercase tracking-wider text-xs sm:text-sm px-8 py-4 rounded-xl shadow-xl hover:-translate-y-0.5 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Download Full Policy (PDF)</span>
                    </a>
                    
                    <a href="#measures" class="inline-flex items-center gap-2 text-blue-100 hover:text-white bg-white/10 hover:bg-white/15 px-6 py-4 rounded-xl text-xs sm:text-sm font-bold uppercase tracking-wider border border-white/15 backdrop-blur-sm transition-all">
                        <span>Read Protocols</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    </a>
                </div>
            @endif

        </div>

        {{-- Curved Bottom Transition --}}
        <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none z-20 pointer-events-none">
            <svg class="relative block w-full h-12 sm:h-16 md:h-20" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0 C160,75 380,-10 640,35 C890,85 1060,15 1200,45 L1200,120 L0,120 Z" fill="rgba(16, 185, 129, 0.25)"></path>
                <path d="M0,25 C200,75 450,20 700,52 C940,85 1100,28 1200,45 L1200,120 L0,120 Z" fill="#f8fafc"></path>
            </svg>
        </div>
    </section>

    {{-- 🏛️ 2. The 4 Safeguarding Pillars (បង្ហាញពីទំនុកចិត្ត និងការការពារជាក់ស្ដែង) --}}
    <section class="relative -mt-10 md:-mt-16 z-20 max-w-6xl mx-auto px-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            {{-- Pillar 1 --}}
            <div data-aos="fade-up" data-aos-delay="100" class="p-6 rounded-[2rem] bg-white border border-slate-200/80 shadow-[0_15px_35px_rgba(15,23,42,0.06)] hover:-translate-y-1 transition-all">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h4 class="font-black text-[#081747] text-base">Secure Campus</h4>
                <p class="mt-2 text-xs text-slate-500 leading-relaxed">24/7 guarded gates, comprehensive CCTV coverage, and restricted visitor badges.</p>
            </div>

            {{-- Pillar 2 --}}
            <div data-aos="fade-up" data-aos-delay="200" class="p-6 rounded-[2rem] bg-white border border-slate-200/80 shadow-[0_15px_35px_rgba(15,23,42,0.06)] hover:-translate-y-1 transition-all">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <h4 class="font-black text-[#081747] text-base">Staff Vetting</h4>
                <p class="mt-2 text-xs text-slate-500 leading-relaxed">Background police checks, mandatory child protection interviews, and annual training.</p>
            </div>

            {{-- Pillar 3 --}}
            <div data-aos="fade-up" data-aos-delay="300" class="p-6 rounded-[2rem] bg-white border border-slate-200/80 shadow-[0_15px_35px_rgba(15,23,42,0.06)] hover:-translate-y-1 transition-all">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                </div>
                <h4 class="font-black text-[#081747] text-base">Voice of the Child</h4>
                <p class="mt-2 text-xs text-slate-500 leading-relaxed">Every student is heard and empowered to speak up through trusted counselor channels.</p>
            </div>

            {{-- Pillar 4 --}}
            <div data-aos="fade-up" data-aos-delay="400" class="p-6 rounded-[2rem] bg-white border border-slate-200/80 shadow-[0_15px_35px_rgba(15,23,42,0.06)] hover:-translate-y-1 transition-all">
                <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <h4 class="font-black text-[#081747] text-base">Confidentiality</h4>
                <p class="mt-2 text-xs text-slate-500 leading-relaxed">All disclosures and incident investigations are handled with strict privacy protocols.</p>
            </div>

        </div>
    </section>

    {{-- 📋 3. Main Content, Video & Evidence Records --}}
    <main id="measures" class="max-w-6xl mx-auto px-6 py-20">
        
        <div class="space-y-16">
            @forelse($safeguardings as $item)

                @php
                    $images = is_array($item->images) ? array_values(array_filter($item->images)) : (filled($item->images) ? [$item->images] : []);
                    $hasVideo = filled($item->video_url);
                    $hasImages = count($images) > 0;
                @endphp

                @if($hasVideo || $hasImages)
                    <section data-aos="fade-up" class="bg-white rounded-[2.5rem] border border-slate-200/80 shadow-[0_20px_50px_rgba(15,23,42,0.06)] p-6 md:p-10 overflow-hidden">
                        
                        {{-- Header --}}
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 mb-8 border-b border-slate-100">
                            <div>
                                <span class="text-xs font-black uppercase tracking-widest text-emerald-600">Safeguarding in Action</span>
                                <h3 class="text-2xl sm:text-3xl font-black text-[#081747] mt-1">{{ $item->title ?: 'Safe Campus Life' }}</h3>
                            </div>
                            
                            @if(filled($item->pdf_file))
                                <a href="{{ $getMediaUrl($item->pdf_file) }}" target="_blank" download class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-orange-50 text-orange-600 border border-orange-200 text-xs font-bold uppercase tracking-wider hover:bg-orange-100 transition-colors self-start sm:self-auto">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                    <span>Download Document</span>
                                </a>
                            @endif
                        </div>

                        {{-- Video Frame (បើមាន) --}}
                        @if($hasVideo)
                            <div class="mb-10">
                                <div class="relative aspect-video w-full rounded-2xl md:rounded-[2rem] overflow-hidden bg-black shadow-lg">
                                    <div class="safeguarding-embed w-full h-full">
                                        {!! $item->video_url !!}
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Photo Gallery Grid (ទាញពី Cloudflare R2) --}}
                        @if($hasImages)
                            <div>
                                <div class="flex items-center justify-between mb-6">
                                    <h4 class="text-lg font-black text-[#081747]">Campus Safety & Activities</h4>
                                    <span class="text-xs font-bold text-slate-400 bg-slate-100 px-3 py-1 rounded-full">{{ count($images) }} Photos</span>
                                </div>

                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                    @foreach($images as $index => $imagePath)
                                        <button type="button" @click="openImage(@js($getMediaUrl($imagePath)))" 
                                                class="group relative aspect-square rounded-2xl overflow-hidden bg-slate-100 border border-slate-200/80 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                                            <img src="{{ $getMediaUrl($imagePath) }}" alt="Safeguarding {{ $index + 1 }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-3">
                                                <span class="text-white text-[11px] font-bold">View Photo</span>
                                            </div>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </section>
                @endif

            @empty
                <div data-aos="fade-up" class="p-16 text-center rounded-[2.5rem] bg-white border border-dashed border-slate-300">
                    <p class="text-slate-500 font-bold">Safeguarding details will be updated soon.</p>
                </div>
            @endforelse
        </div>

        {{-- 🚨 Confidential Reporting Hotline Card --}}
        <div data-aos="fade-up" class="mt-16 rounded-[2.5rem] bg-gradient-to-br from-[#081747] via-[#0d235f] to-[#123180] text-white p-8 md:p-12 shadow-2xl relative overflow-hidden">
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="max-w-xl text-center md:text-left">
                    <span class="text-xs font-black uppercase tracking-widest text-emerald-400">Confidential Helpline</span>
                    <h3 class="text-2xl sm:text-3xl font-black mt-1 mb-3">Have a Safeguarding Concern?</h3>
                    <p class="text-blue-100/90 text-sm leading-relaxed">
                        If you have any questions, reports, or concerns regarding the safety and well-being of a student at Life International School, contact our Child Protection Officer immediately. All inquiries are treated with strict confidentiality.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    <a href="mailto:lifeinternationalschool@gmail.com?subject=Safeguarding Concern" class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-500 hover:bg-emerald-600 px-6 py-3.5 text-xs font-black uppercase tracking-wider text-white shadow-lg transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>Report via Email</span>
                    </a>
                    <a href="tel:+85578517754" class="inline-flex items-center justify-center gap-2 rounded-xl bg-white/10 hover:bg-white/20 px-6 py-3.5 text-xs font-black uppercase tracking-wider text-white border border-white/20 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.95.684l1.5 4.493a1 1 0 01-.502 1.21l-2.257 1.128a11.04 11.04 0 005.516 5.516l1.128-2.257a1 1 0 011.21-.502l4.493 1.5a1 1 0 01.684.95V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span>Direct Call</span>
                    </a>
                </div>
            </div>
        </div>

    </main>

    {{-- Image Lightbox --}}
    <div x-show="lightboxOpen" x-cloak @click.self="closeImage()" class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/95 backdrop-blur-sm p-4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <button type="button" @click="closeImage()" aria-label="Close image" class="absolute top-5 right-5 md:top-8 md:right-8 w-12 h-12 rounded-full bg-white/10 hover:bg-orange-500 text-white flex items-center justify-center transition-colors z-20">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <img :src="activeImage" alt="Safeguarding preview" class="max-w-full max-h-[88vh] object-contain rounded-2xl shadow-2xl" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
    </div>

</div>

@endsection