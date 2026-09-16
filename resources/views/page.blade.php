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

    $hasContent = filled(trim(strip_tags($page->content ?? '')));
@endphp

<style>
    [x-cloak] { display: none !important; }
    .academic-content > * + * { margin-top: 1rem; }
    .academic-content h1, .academic-content h2, .academic-content h3 { color: #081747; font-weight: 800; line-height: 1.3; margin-top: 1.75rem; margin-bottom: 0.75rem; }
    .academic-content h1 { font-size: 2rem; }
    .academic-content h2 { font-size: 1.65rem; }
    .academic-content h3 { font-size: 1.35rem; }
    .academic-content p { color: #475569; font-size: 1rem; line-height: 1.85; }
    .academic-content ul, .academic-content ol { color: #475569; line-height: 1.8; padding-left: 1.5rem; }
    .academic-content ul { list-style: disc; }
    .academic-content ol { list-style: decimal; }
    .academic-content a { color: #1d4ed8; font-weight: 700; text-decoration: underline; }
    .academic-content img { max-width: 100%; height: auto; border-radius: 1rem; margin-top: 1.5rem; margin-bottom: 1.5rem; }
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
    class="min-h-screen bg-slate-50"
>
    {{-- Hero --}}
    <section class="relative isolate min-h-[420px] overflow-hidden bg-[#081747] md:min-h-[520px]">
        @if($coverImageUrl)
            <img src="{{ $coverImageUrl }}" aria-hidden="true" class="absolute inset-0 h-full w-full scale-110 object-cover opacity-70 blur-2xl md:hidden">
            <img src="{{ $coverImageUrl }}" alt="{{ $pageTitle }}" class="absolute inset-0 h-full w-full object-contain object-center md:hidden">
            <img src="{{ $coverImageUrl }}" alt="{{ $pageTitle }}" class="absolute inset-0 hidden h-full w-full object-cover object-center md:block">
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-[#081747] via-[#173c9c] to-[#2563eb]"></div>
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle, rgba(255,255,255,0.8) 1px, transparent 1px); background-size: 24px 24px;"></div>
        @endif

        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-slate-950/65 to-slate-950/20"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 via-transparent to-transparent"></div>

        <div class="relative z-10 mx-auto flex min-h-[420px] max-w-7xl items-center px-6 py-16 md:min-h-[520px] md:px-10">
            <div class="max-w-4xl">
                <div data-aos="fade-up" class="mb-7 flex flex-wrap items-center gap-2 text-sm font-semibold text-slate-200">
                    <a href="{{ url('/') }}" class="transition-colors hover:text-orange-400">Home</a>
                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <span>Academics</span>
                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <span class="text-orange-400">{{ $pageTitle }}</span>
                </div>

                <div data-aos="fade-up" data-aos-delay="100" class="mb-5 flex items-center gap-3">
                    <span class="h-1 w-12 rounded-full bg-orange-500"></span>
                    <span class="text-sm font-bold uppercase tracking-[0.2em] text-orange-400">Academic Program</span>
                </div>

                <h1 data-aos="fade-up" data-aos-delay="200" class="max-w-4xl text-4xl font-black uppercase leading-tight tracking-wide text-white drop-shadow-lg sm:text-5xl md:text-7xl">
                    {{ $pageTitle }}
                </h1>

                <p data-aos="fade-up" data-aos-delay="300" class="mt-6 max-w-2xl text-base leading-7 text-slate-200 md:text-lg">
                    Inspiring students through quality education, meaningful experiences and a caring learning environment.
                </p>

                @if(count($galleryImages) > 0)
                    <div data-aos="fade-up" data-aos-delay="400" class="mt-8 inline-flex items-center gap-3 rounded-xl border border-white/20 bg-white/10 px-5 py-3 text-sm font-bold text-white backdrop-blur-md">
                        <svg class="h-5 w-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16l4-4a2 2 0 012.8 0l2.2 2.2 2-2a2 2 0 012.8 0L21 15.4M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ count($galleryImages) }}
                        {{ count($galleryImages) === 1 ? 'Photo' : 'Photos' }}
                    </div>
                @endif
            </div>
        </div>

        {{-- 📍 បន្ទាត់ Highlight ពណ៌មាស (Metallic Gold Ribbon) --}}
        <div class="absolute -bottom-px left-0 h-[45px] w-full bg-gradient-to-r from-[#b45309] via-[#fde047] to-[#d97706] shadow-[0_0_18px_rgba(251,191,36,0.6)] md:h-[70px]" 
             style="clip-path: polygon(0 70%, 100% 0, 100% 100%, 0 100%);"></div>

        {{-- ផ្ទៃពណ៌សាច់ខាងក្រោម (Slate-50) កាត់ពីលើ បន្សល់ឆ្នូតមាសកម្រាស់ប្រហែល 5px --}}
        <div class="absolute -bottom-px left-0 h-10 w-full bg-slate-50 md:h-16" 
             style="clip-path: polygon(0 70%, 100% 0, 100% 100%, 0 100%);"></div>
    </section>

    {{-- Content --}}
    <section class="px-5 py-14 md:px-8 md:py-20">
        <div class="mx-auto max-w-7xl">
            @if($hasContent)
                <div data-aos="fade-up" class="mb-20 overflow-hidden rounded-[28px] border border-slate-200 bg-white shadow-[0_15px_50px_rgba(15,23,42,0.08)]">
                    <div class="grid grid-cols-1 lg:grid-cols-[310px_1fr]">
                        <div class="relative overflow-hidden bg-gradient-to-br from-[#081747] to-[#173c9c] p-8 text-white md:p-10">
                            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 20px 20px;"></div>
                            <div class="relative">
                                <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-500 shadow-lg">
                                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5A7.5 7.5 0 003 6.253v13A7.5 7.5 0 017.5 18c1.746 0 3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5A7.5 7.5 0 0121 6.253v13A7.5 7.5 0 0016.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                </div>
                                <span class="text-sm font-bold uppercase tracking-[0.18em] text-orange-300">Discover More</span>
                                <h2 class="mt-3 text-3xl font-black leading-tight">About {{ $pageTitle }}</h2>
                                <div class="mt-6 h-1 w-16 rounded-full bg-orange-500"></div>
                            </div>
                        </div>

                        <div class="p-7 md:p-10 lg:p-12">
                            <div class="academic-content">
                                {!! $page->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Gallery --}}
            @if(count($galleryImages) > 0)
                <div>
                    <div data-aos="fade-right" class="mb-12 flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
                        <div>
                            <div class="mb-3 flex items-center gap-3">
                                <span class="h-1 w-10 rounded-full bg-orange-500"></span>
                                <span class="text-sm font-bold uppercase tracking-[0.18em] text-orange-500">Memorable Moments</span>
                            </div>
                            <h2 class="text-3xl font-black uppercase tracking-wide text-[#081747] md:text-4xl">Photo Gallery</h2>
                            <p class="mt-3 text-slate-600">Click any image to view it in full screen.</p>
                        </div>

                        <div class="inline-flex w-fit items-center rounded-full border border-blue-100 bg-white px-5 py-2.5 text-sm font-bold text-blue-900 shadow-sm">
                            {{ count($galleryImages) }}
                            {{ count($galleryImages) === 1 ? 'Image' : 'Images' }}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($galleryImages as $index => $image)
                            <button
                                data-aos="zoom-in"
                                data-aos-delay="{{ ($index % 3) * 100 }}"
                                type="button"
                                @click="openLightbox({{ $index }})"
                                class="group relative aspect-[4/3] overflow-hidden rounded-2xl bg-slate-200 text-left shadow-md transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl"
                            >
                                <img src="{{ $image }}" alt="{{ $pageTitle }} gallery image {{ $index + 1 }}" loading="lazy" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/75 via-slate-950/10 to-transparent opacity-40 transition-opacity duration-300 group-hover:opacity-90"></div>
                                <div class="absolute bottom-4 left-4 translate-y-3 text-sm font-bold text-white opacity-0 transition-all duration-300 group-hover:translate-y-0 group-hover:opacity-100">
                                    Photo {{ $index + 1 }}
                                </div>
                                <div class="absolute bottom-4 right-4 flex h-11 w-11 scale-75 items-center justify-center rounded-full bg-orange-500 text-white opacity-0 shadow-lg transition-all duration-300 group-hover:scale-100 group-hover:opacity-100">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5.2-5.2m2.2-5.3a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0zM10.5 7.5v6m-3-3h6"></path></svg>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>
            @elseif(!$hasContent)
                <div data-aos="fade-up" class="rounded-[28px] border border-dashed border-blue-200 bg-white px-6 py-20 text-center shadow-sm">
                    <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-blue-50 text-blue-700">
                        <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5A7.5 7.5 0 003 6.253v13A7.5 7.5 0 017.5 18c1.746 0 3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5A7.5 7.5 0 0121 6.253v13A7.5 7.5 0 0016.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-blue-950">Content coming soon</h3>
                    <p class="mt-3 text-slate-500">Information for this academic program will be available soon.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- Lightbox --}}
    @if(count($galleryImages) > 0)
        <div
            x-show="lightboxOpen"
            x-cloak
            x-transition.opacity.duration.300ms
            @click.self="closeLightbox()"
            class="fixed inset-0 z-[9999] flex items-center justify-center bg-slate-950/95 p-4 backdrop-blur-md"
            role="dialog"
            aria-modal="true"
        >
            <button type="button" @click="closeLightbox()" aria-label="Close image" class="absolute right-4 top-4 z-30 flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-white transition-colors hover:bg-red-600 md:right-8 md:top-6">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <button x-show="images.length > 1" type="button" @click.stop="previousImage()" aria-label="Previous image" class="absolute left-3 z-30 flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-white transition-colors hover:bg-orange-500 md:left-8 md:h-14 md:w-14">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <button x-show="images.length > 1" type="button" @click.stop="nextImage()" aria-label="Next image" class="absolute right-3 z-30 flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-white transition-colors hover:bg-orange-500 md:right-8 md:h-14 md:w-14">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
            <div class="relative flex max-h-[90vh] max-w-[90vw] items-center justify-center">
                <img :src="images[activeIndex]" :alt="'{{ addslashes($pageTitle) }} photo ' + (activeIndex + 1)" class="max-h-[85vh] max-w-full rounded-xl object-contain shadow-2xl">
                <div class="absolute bottom-4 right-4 rounded-full bg-slate-950/70 px-4 py-2 text-sm font-bold text-white backdrop-blur-sm">
                    <span x-text="activeIndex + 1"></span> / <span x-text="images.length"></span>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection