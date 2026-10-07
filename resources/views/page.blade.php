@extends('layout')

@section(
    'title',
    ($page->title ?? 'Academic Program') . ' - Life International School'
)

@section('content')

@php
    $pageTitle = $page->title ?: 'Academic Program';

    // 📍 មុខងារទាញយករូបភាពពី Cloudflare R2 (s3)
    $getImageUrl = function($path) {
        if (empty($path)) return null;
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) return $path;
        try { 
            return \Storage::disk('s3')->url($path); 
        } catch (\Exception $e) { 
            return asset('storage/' . $path); 
        }
    };

    $coverImageUrl = $getImageUrl($page->image);

    $rawGallery = $page->gallery ?? [];
    $storedGallery = is_array($rawGallery) ? $rawGallery : (is_string($rawGallery) ? json_decode($rawGallery, true) ?? [] : []);

    $galleryImages = collect($storedGallery)
        ->filter()
        ->map(fn ($img) => $getImageUrl($img))
        ->values()
        ->all();

    // 📍 បញ្ចូលរូប Cover និង Gallery ចូលគ្នាសម្រាប់ធ្វើ Slide ក្នុង Banner
    $bannerSlides = collect([$coverImageUrl])
        ->merge($galleryImages)
        ->filter()
        ->unique()
        ->values()
        ->all();

    $hasContent = filled(trim(strip_tags($page->content ?? '')));
@endphp

<style>
    [x-cloak] { display: none !important; }
    .academic-content > * + * { margin-top: 1.25rem; }
    .academic-content h1, .academic-content h2, .academic-content h3 { color: #081747; font-weight: 800; line-height: 1.3; margin-top: 1.75rem; margin-bottom: 0.75rem; }
    .academic-content h1 { font-size: 2rem; }
    .academic-content h2 { font-size: 1.65rem; }
    .academic-content h3 { font-size: 1.35rem; }
    .academic-content p { color: #475569; font-size: 1.05rem; line-height: 1.85; }
    .academic-content ul, .academic-content ol { color: #475569; line-height: 1.8; padding-left: 1.5rem; }
    .academic-content ul { list-style: disc; }
    .academic-content ol { list-style: decimal; }
    .academic-content a { color: #f59e0b; font-weight: 700; text-decoration: underline; }
    .academic-content img { max-width: 100%; height: auto; border-radius: 1.25rem; margin-top: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
</style>

<div
    x-data="{
        lightboxOpen: false,
        activeIndex: 0,
        images: @js($galleryImages),
        openLightbox(index) { this.activeIndex = index; this.lightboxOpen = true; },
        closeLightbox() { this.lightboxOpen = false; },
        previousImage() { if (this.images.length <= 1) return; this.activeIndex = (this.activeIndex - 1 + this.images.length) % this.images.length; },
        nextImage() { if (this.images.length <= 1) return; this.activeIndex = (this.activeIndex + 1) % this.images.length; }
    }"
    x-effect="document.body.style.overflow = lightboxOpen ? 'hidden' : ''"
    @keydown.escape.window="lightboxOpen && closeLightbox()"
    @keydown.arrow-left.window="lightboxOpen && previousImage()"
    @keydown.arrow-right.window="lightboxOpen && nextImage()"
    class="min-h-screen bg-[#f8fafc] w-full"
>
    {{-- 🌟 1. Cinema Academic Hero Banner ជាមួយ Auto Slideshow (លោតរូបម្តងមួយៗ) --}}
    <section 
        x-data="{
            currentSlide: 0,
            slides: @js($bannerSlides),
            timer: null,
            start() {
                if (this.slides.length > 1) {
                    this.timer = setInterval(() => {
                        this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                    }, 4000);
                }
            },
            stop() { clearInterval(this.timer); },
            goTo(index) {
                this.currentSlide = index;
            }
        }"
        x-init="start()"
        @mouseenter="stop()"
        @mouseleave="start()"
        class="relative isolate min-h-[540px] md:min-h-[640px] flex items-center overflow-hidden bg-[#061238] w-full"
    >
        
        {{-- 📍 កន្លែងបង្ហាញរូបភាព Slide ម្តងមួយៗ --}}
        @if(count($bannerSlides) > 0)
            <div class="absolute inset-0 z-0">
                <template x-for="(img, idx) in slides" :key="idx">
                    <img :src="img" 
                         :alt="'{{ addslashes($pageTitle) }} slide ' + (idx + 1)"
                         x-show="currentSlide === idx"
                         x-transition:enter="transition ease-out duration-1000"
                         x-transition:enter-start="opacity-0 scale-105"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-1000 absolute inset-0"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute inset-0 h-full w-full object-cover object-center">
                </template>
            </div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-[#081747] via-[#102c74] to-[#1d4ed8]"></div>
        @endif

        {{-- Cinematic Vignette Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-r from-[#061238]/90 via-[#061238]/50 to-transparent z-10 pointer-events-none"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#061238]/90 via-transparent to-black/30 z-10 pointer-events-none"></div>

        <div class="relative z-20 w-full px-6 pt-16 pb-28 md:px-12 md:pb-36">
            <div class="max-w-4xl">
                
                {{-- Breadcrumb --}}
                <div data-aos="fade-down" class="mb-6 inline-flex flex-wrap items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-1.5 text-xs md:text-sm font-semibold text-blue-100 backdrop-blur-md shadow-xs">
                    <a href="{{ url('/') }}" class="transition-colors hover:text-amber-300">Home</a>
                    <svg class="h-3.5 w-3.5 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <span>Academics</span>
                    <svg class="h-3.5 w-3.5 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <span class="text-amber-300">{{ $pageTitle }}</span>
                </div>

                {{-- Pill Tag --}}
                <div data-aos="fade-up" data-aos-delay="100" class="mb-4 inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-amber-400/20 border border-amber-400/30 text-amber-300 text-xs font-bold uppercase tracking-[0.2em] backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    Academic Program
                </div>

                {{-- Title --}}
                <h1 data-aos="fade-up" data-aos-delay="200" class="text-4xl sm:text-6xl md:text-7xl font-black uppercase tracking-tight text-white drop-shadow-2xl leading-none">
                    {{ $pageTitle }}
                </h1>

                <div data-aos="zoom-in" data-aos-delay="300" class="mt-5 mb-6 h-1.5 w-20 rounded-full bg-gradient-to-r from-amber-400 to-orange-500 shadow-[0_0_15px_rgba(251,191,36,0.6)]"></div>

                <p data-aos="fade-up" data-aos-delay="350" class="max-w-2xl text-base sm:text-lg text-blue-100/90 leading-relaxed font-light drop-shadow">
                    Inspiring students through Christ-centered quality education, meaningful experiences, and a caring learning community.
                </p>

                {{-- Quick Meta & Slide Control Dots --}}
                <div data-aos="fade-up" data-aos-delay="400" class="mt-8 flex flex-wrap items-center gap-4">
                    <span class="inline-flex items-center gap-2 rounded-xl border border-white/20 bg-white/10 px-4 py-2 text-xs font-bold text-white backdrop-blur-md">
                        <svg class="h-4 w-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        ACSI Accredited
                    </span>

                    {{-- 📍 គ្រាប់ចុចបង្ហាញ Slide Index ក្នុង Banner --}}
                    <div x-show="slides.length > 1" class="inline-flex items-center gap-2 bg-black/40 border border-white/15 px-3 py-2 rounded-xl backdrop-blur-md">
                        <template x-for="(s, sIdx) in slides" :key="'dot-' + sIdx">
                            <button @click="goTo(sIdx)"
                                    :class="currentSlide === sIdx ? 'w-6 bg-amber-400' : 'w-2 bg-white/40 hover:bg-white/75'"
                                    class="h-2 rounded-full transition-all duration-300"></button>
                        </template>
                    </div>
                </div>

            </div>
        </div>

        {{-- Dual-Layer Metallic Gold Wave Transition --}}
        <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none z-20 pointer-events-none">
            <svg class="relative block w-full h-14 sm:h-18 md:h-24" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="academicGoldGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#b45309" />
                        <stop offset="25%" stop-color="#f59e0b" />
                        <stop offset="50%" stop-color="#fde047" />
                        <stop offset="75%" stop-color="#f59e0b" />
                        <stop offset="100%" stop-color="#d97706" />
                    </linearGradient>
                </defs>
                <path d="M0,0 C160,85 380,-15 640,40 C890,95 1060,15 1200,50 L1200,120 L0,120 Z" fill="url(#academicGoldGrad)"></path>
                <path d="M0,28 C200,85 450,22 700,58 C940,95 1100,32 1200,50 L1200,120 L0,120 Z" fill="#f8fafc"></path>
            </svg>
        </div>
    </section>

    {{-- 📖 2. Main Content --}}
    <main class="w-full px-6 md:px-12 py-16 md:py-24">
        
        @if($hasContent)
            <article data-aos="fade-up" class="mb-20 overflow-hidden rounded-[2.5rem] border border-slate-200/90 bg-white shadow-[0_20px_50px_rgba(15,23,42,0.06)] w-full">
                <div class="grid grid-cols-1 lg:grid-cols-[320px_1fr]">
                    
                    {{-- Left Sidebar Card --}}
                    <div class="relative overflow-hidden bg-gradient-to-br from-[#081747] to-[#122e70] p-8 text-white md:p-10 flex flex-col justify-between">
                        <div class="relative z-10">
                            <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-orange-500 to-amber-500 shadow-lg">
                                <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5A7.5 7.5 0 003 6.253v13A7.5 7.5 0 017.5 18c1.746 0 3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5A7.5 7.5 0 0121 6.253v13A7.5 7.5 0 0016.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            </div>
                            <span class="text-xs font-black uppercase tracking-[0.2em] text-amber-300">Curriculum</span>
                            <h2 class="mt-2 text-2xl sm:text-3xl font-black text-white leading-tight">About {{ $pageTitle }}</h2>
                            <div class="mt-4 h-1 w-14 rounded-full bg-amber-400"></div>
                        </div>

                        <div class="relative z-10 mt-8 pt-6 border-t border-white/10 text-xs text-blue-200/80">
                            Life International School • Sihanoukville
                        </div>
                    </div>

                    {{-- Content Area --}}
                    <div class="p-8 md:p-12 lg:p-14">
                        <div class="academic-content max-w-none">
                            {!! $page->content !!}
                        </div>
                    </div>

                </div>
            </article>
        @endif

        {{-- 🖼️ 3. Photo Gallery Grid --}}
        @if(count($galleryImages) > 0)
            <div class="w-full">
                <div data-aos="fade-right" class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <span class="text-xs font-black uppercase tracking-widest text-amber-600">Learning in Action</span>
                        <h2 class="text-3xl font-black uppercase tracking-tight text-[#081747] mt-1 sm:text-4xl">Photo Gallery</h2>
                        <p class="mt-2 text-slate-500 text-sm">Click any photo to explore the full screen showcase.</p>
                    </div>

                    <div class="inline-flex w-fit items-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-2 text-xs font-black text-[#081747] shadow-xs">
                        <span>{{ count($galleryImages) }} {{ count($galleryImages) === 1 ? 'Photo' : 'Photos' }}</span>
                    </div>
                </div>

                {{-- កែប្រែ Grid ឱ្យបង្ហាញ 4 ឬ 3 Columns តាមទំហំ Screen ដើម្បីឱ្យរូបទាំងអស់លាតសន្ធឹងពេញស្អាត --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6 w-full">
                    @foreach($galleryImages as $index => $image)
                        <button
                            data-aos="zoom-in"
                            data-aos-delay="{{ ($index % 4) * 100 }}"
                            type="button"
                            @click="openLightbox({{ $index }})"
                            class="group relative w-full aspect-[4/3] overflow-hidden rounded-[2rem] bg-slate-200 text-left shadow-sm transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl border-2 border-white"
                        >
                            <img src="{{ $image }}" alt="{{ $pageTitle }} gallery {{ $index + 1 }}" loading="lazy" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-50 transition-opacity duration-300 group-hover:opacity-90"></div>
                            
                            <div class="absolute bottom-5 left-5 right-5 flex items-center justify-between">
                                <span class="text-xs font-bold text-white translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                                    Photo {{ $index + 1 }}
                                </span>
                                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-500 text-white shadow-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                </span>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>
        @elseif(!$hasContent)
            <div data-aos="fade-up" class="rounded-[2.5rem] border border-dashed border-slate-300 bg-white p-16 text-center shadow-xs max-w-2xl mx-auto">
                <h3 class="text-xl font-bold text-[#081747]">Content Coming Soon</h3>
                <p class="mt-2 text-slate-500 text-sm">Curriculum details for {{ $pageTitle }} will be published soon.</p>
            </div>
        @endif

    </main>

    {{-- 🔍 Lightbox Modal --}}
    @if(count($galleryImages) > 0)
        <div
            x-show="lightboxOpen"
            x-cloak
            x-transition.opacity.duration.300ms
            @click.self="closeLightbox()"
            class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/95 p-4 backdrop-blur-md"
        >
            <button type="button" @click="closeLightbox()" class="absolute right-5 top-5 z-30 flex h-12 w-12 items-center justify-center rounded-full bg-white/10 text-white hover:bg-orange-500 transition-colors">
                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            <button x-show="images.length > 1" type="button" @click.stop="previousImage()" class="absolute left-4 z-30 flex h-12 w-12 items-center justify-center rounded-full bg-white/10 text-white hover:bg-orange-500 transition-colors">
                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>

            <button x-show="images.length > 1" type="button" @click.stop="nextImage()" class="absolute right-4 z-30 flex h-12 w-12 items-center justify-center rounded-full bg-white/10 text-white hover:bg-orange-500 transition-colors">
                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>

            <div class="relative flex max-h-[90vh] max-w-[90vw] items-center justify-center">
                <img :src="images[activeIndex]" :alt="'{{ addslashes($pageTitle) }} photo ' + (activeIndex + 1)" class="max-h-[85vh] max-w-full rounded-2xl object-contain shadow-2xl">
                <div class="absolute bottom-4 right-4 rounded-full bg-black/70 px-4 py-2 text-xs font-bold text-white backdrop-blur-md">
                    <span x-text="activeIndex + 1"></span> / <span x-text="images.length"></span>
                </div>
            </div>
        </div>
    @endif

</div>
@endsection