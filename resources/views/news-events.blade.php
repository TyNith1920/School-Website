@extends('layout')

@section('title', 'News & Events - Life International School')

@section('content')

@php
    // 📍 មុខងារទាញយករូបភាពពី R2 / S3 ដែលគាំទ្រទាំង String និង Array
    $getMediaUrl = function($path) use (&$getMediaUrl) {
        if (empty($path)) return null;
        if (is_array($path)) {
            $first = reset($path);
            return $getMediaUrl($first);
        }
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }
        try { 
            return \Storage::disk('s3')->url($path); 
        } catch (\Exception $e) { 
            return asset('storage/' . ltrim($path, '/')); 
        }
    };

    // មុខងារទាញយករូបភាពទាំងអស់ជា Array សុទ្ធ
    $extractNewsImages = function($item) use ($getMediaUrl) {
        $images = [];
        $rawImages = $item->image ?? null;

        if (is_array($rawImages)) {
            foreach ($rawImages as $img) {
                if ($url = $getMediaUrl($img)) $images[] =$url;
            }
        } elseif (is_string($rawImages)) {
            $decoded = json_decode($rawImages, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                foreach ($decoded as$img) {
                    if ($url = $getMediaUrl($img)) $images[] =$url;
                }
            } elseif ($url = $getMediaUrl($rawImages)) {
                $images[] =$url;
            }
        }

        return array_values(array_filter($images));
    };

    $allNews = collect($newsList ?? []);
    $featuredNews =$allNews->first();
    $featuredImages =$featuredNews ? $extractNewsImages($featuredNews) : [];
    $regularNews =$allNews->slice(1);
@endphp

<div class="min-h-screen bg-[#f8fafc] text-slate-800">

    {{-- Clean Editorial Header --}}
    <header class="border-b border-slate-200 bg-white pt-10 sm:pt-12 pb-7 sm:pb-8">
        {{-- 💡 កែប្រែពី max-w-7xl ទៅ max-w-[1536px] ដើម្បីអោយ Header ធំពេញអេក្រង់ --}}
        <div class="mx-auto max-w-[1536px] px-4 sm:px-8 lg:px-12">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-50 border border-orange-200 text-orange-600 text-xs font-black uppercase tracking-widest mb-3">
                        <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                        LIS Gazette & Newsroom
                    </div>
                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black uppercase tracking-tight text-[#081747]">
                        News <span class="text-orange-500">&</span> Events
                    </h1>
                    <p class="mt-3 text-sm sm:text-base text-slate-500 max-w-2xl font-normal leading-relaxed">
                        Stay connected with daily moments, academic milestones, and inspiring stories from our vibrant school community.
                    </p>
                </div>

                <div class="inline-flex items-center gap-3 self-start md:self-auto rounded-2xl bg-slate-50 border border-slate-200 px-4 py-2.5 sm:px-5 sm:py-3 text-xs sm:text-sm font-bold text-slate-700 shadow-xs">
                    <span class="flex h-2.5 w-2.5 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                    </span>
                    <span>{{ $allNews->count() }} Published Stories</span>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 flex flex-wrap items-center gap-2">
                <span class="text-xs font-black uppercase tracking-wider text-slate-400 mr-2">Filter by:</span>
                <button type="button" class="px-3.5 py-1.5 rounded-xl text-xs font-bold bg-[#081747] text-white shadow-xs transition-all hover:bg-orange-500">All Updates</button>
                <button type="button" class="px-3.5 py-1.5 rounded-xl text-xs font-bold bg-white text-slate-600 border border-slate-200 hover:border-orange-400 hover:text-orange-500 transition-all">Academic Highlights</button>
                <button type="button" class="px-3.5 py-1.5 rounded-xl text-xs font-bold bg-white text-slate-600 border border-slate-200 hover:border-orange-400 hover:text-orange-500 transition-all">School Activities</button>
                <button type="button" class="px-3.5 py-1.5 rounded-xl text-xs font-bold bg-white text-slate-600 border border-slate-200 hover:border-orange-400 hover:text-orange-500 transition-all">Official Notices</button>
            </div>
        </div>
    </header>

    {{-- 💡 កែប្រែ Container ធំរហូតដល់ 1536px (2XL Screens) --}}
    <main class="mx-auto max-w-[1536px] px-4 sm:px-8 lg:px-12 py-8 sm:py-12 md:py-16">

        @if($featuredNews)
            {{-- 🌟 Featured Story --}}
            <section data-aos="fade-up" class="mb-12 sm:mb-16">
                <div class="group relative overflow-hidden rounded-[2rem] sm:rounded-[2.5rem] bg-white border border-slate-200 shadow-[0_15px_40px_rgba(15,23,42,0.06)] hover:shadow-[0_20px_50px_rgba(30,64,175,0.1)] transition-all duration-500">
                    <div class="grid grid-cols-1 lg:grid-cols-12 items-stretch">
                        
                        {{-- Featured Image Slider --}}
                        <div class="relative lg:col-span-7 xl:col-span-8 min-h-[350px] sm:min-h-[450px] lg:min-h-[500px] overflow-hidden bg-slate-950 w-full"
                             x-data="{ 
                                current: 0, 
                                slides: @js($featuredImages),
                                timer: null,
                                start() {
                                    if (this.slides.length > 1) {
                                        this.timer = setInterval(() => {
                                            this.current = (this.current + 1) % this.slides.length;
                                        }, 4500);
                                    }
                                },
                                stop() { clearInterval(this.timer); },
                                prev() { this.current = (this.current - 1 + this.slides.length) % this.slides.length; },
                                next() { this.current = (this.current + 1) % this.slides.length; }
                             }"
                             x-init="start()"
                             @mouseenter="stop()"
                             @mouseleave="start()">

                            @if(count($featuredImages) > 0)
                                <template x-for="(img, idx) in slides" :key="idx">
                                    <img :src="img" 
                                         :alt="'{{ e($featuredNews->title) }} photo ' + (idx + 1)"
                                         x-show="current === idx"
                                         x-transition:enter="transition ease-out duration-500"
                                         x-transition:enter-start="opacity-0 scale-102"
                                         x-transition:enter-end="opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-500 absolute inset-0"
                                         x-transition:leave-start="opacity-100 scale-100"
                                         x-transition:leave-end="opacity-0 scale-98"
                                         class="h-full w-full object-cover object-center absolute inset-0" 
                                         loading="lazy">
                                </template>
                            @else
                                <div class="flex h-full w-full items-center justify-center bg-blue-900 text-blue-200">Featured Story</div>
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-black/20 pointer-events-none"></div>

                            {{-- Date Stamp --}}
                            <div class="absolute top-4 right-4 sm:top-6 sm:right-6 z-20 flex flex-col items-center justify-center rounded-xl sm:rounded-2xl bg-white/95 backdrop-blur-md px-3 py-1.5 sm:px-4 sm:py-2.5 shadow-lg border border-white/50 text-center">
                                <span class="text-[10px] sm:text-[11px] font-black uppercase tracking-widest text-orange-600 leading-none">{{ $featuredNews->created_at?->format('M') ?? 'LIS' }}</span>
                                <span class="text-xl sm:text-2xl font-black text-[#081747] leading-none mt-0.5">{{ $featuredNews->created_at?->format('d') ?? '01' }}</span>
                            </div>

                            {{-- Badge & Multi-Image Count --}}
                            <div class="absolute top-4 left-4 sm:top-6 sm:left-6 z-20 flex items-center gap-2">
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-orange-500 px-3 py-1 sm:px-4 sm:py-1.5 text-[11px] sm:text-xs font-black uppercase tracking-wider text-white shadow-md">
                                    ★ Featured Story
                                </span>
                                @if(count($featuredImages) > 1)
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-black/60 backdrop-blur-md px-2.5 py-1 sm:px-3 sm:py-1.5 text-[11px] sm:text-xs font-bold text-white border border-white/20">
                                        <svg class="w-3.5 h-3.5 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <span x-text="(current + 1) + '/' + slides.length"></span>
                                    </span>
                                @endif
                            </div>

                            {{-- Arrows --}}
                            <div x-show="slides.length > 1" class="absolute inset-y-0 inset-x-2 sm:inset-x-4 z-20 flex items-center justify-between pointer-events-none">
                                <button type="button" @click.stop="prev()" class="pointer-events-auto w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-black/50 hover:bg-orange-500 text-white flex items-center justify-center backdrop-blur-sm transition-colors shadow-md">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                                </button>
                                <button type="button" @click.stop="next()" class="pointer-events-auto w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-black/50 hover:bg-orange-500 text-white flex items-center justify-center backdrop-blur-sm transition-colors shadow-md">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                </button>
                            </div>

                            {{-- Dots --}}
                            @if(count($featuredImages) > 1 && count($featuredImages) <= 8)
                                <div class="absolute bottom-3 sm:bottom-4 left-1/2 -translate-x-1/2 z-20 flex items-center gap-1.5">
                                    <template x-for="(s, sIdx) in slides" :key="'feat-dot-' + sIdx">
                                        <button @click.stop="current = sIdx" 
                                                :class="current === sIdx ? 'w-5 sm:w-6 bg-amber-400' : 'w-1.5 sm:w-2 bg-white/60 hover:bg-white'" 
                                                class="h-1.5 sm:h-2 rounded-full transition-all duration-300"></button>
                                    </template>
                                </div>
                            @endif

                        </div>

                        {{-- Featured Content --}}
                        <div class="lg:col-span-5 xl:col-span-4 p-6 sm:p-8 lg:p-10 flex flex-col justify-between bg-white">
                            <div>
                                <div class="flex items-center gap-2.5 text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">
                                    <span class="text-orange-500 font-black">Life International School</span>
                                    <span>•</span>
                                    <span>{{ $featuredNews->created_at?->format('Y') ?? date('Y') }}</span>
                                </div>

                                <h2 class="text-xl sm:text-2xl lg:text-3xl xl:text-4xl font-black leading-snug text-[#081747] group-hover:text-blue-700 transition-colors">
                                    {{ $featuredNews->title }}
                                </h2>

                                <p class="mt-3 sm:mt-4 text-xs sm:text-sm sm:leading-relaxed text-slate-600 line-clamp-4 lg:line-clamp-6">
                                    {!! Str::limit(strip_tags($featuredNews->description), 250) !!}
                                </p>
                            </div>

                            <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between">
                                <button type="button" 
                                    onclick="openModal(this)"
                                    data-images='@json($featuredImages)'
                                    data-title="{{ $featuredNews->title }}"
                                    data-link="{{ $featuredNews->link ?? '' }}"
                                    data-date="{{ $featuredNews->created_at?->format('F d, Y') ?? '' }}"
                                    class="inline-flex items-center gap-2 bg-[#081747] hover:bg-orange-500 text-white text-xs sm:text-sm font-bold uppercase tracking-wider px-6 py-3.5 rounded-xl shadow-xs hover:-translate-y-0.5 transition-all">
                                    <span>Read Full Article</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </button>
                                
                                <div class="hidden news-full-description">{!! $featuredNews->description !!}</div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        @endif

        {{-- Regular News Grid (3 Columns on Large Screens) --}}
        @if($regularNews->count() > 0)
            <div class="mb-8 flex items-center justify-between">
                <h3 class="text-xl sm:text-2xl lg:text-3xl font-black uppercase text-[#081747]">More Stories & Happenings</h3>
                <span class="text-xs sm:text-sm font-bold uppercase tracking-wider text-slate-400">{{ $regularNews->count() }} More Updates</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach($regularNews as $index =>$news)
                    @php
                        $itemImages = $extractNewsImages($news);
                        $thumbImage =$itemImages[0] ?? null;
                    @endphp
                    <article data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}"
                        class="group flex flex-col overflow-hidden rounded-[2rem] bg-white border border-slate-200 shadow-xs hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300">
                        
                        {{-- Card Image & Date Stamp --}}
                        <div class="relative aspect-[16/10] overflow-hidden bg-slate-100">
                            @if($thumbImage)
                                <img src="{{ $thumbImage }}" alt="{{ $news->title }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                            @else
                                <div class="flex h-full w-full items-center justify-center bg-blue-50 text-blue-300 font-bold">LIS Update</div>
                            @endif

                            {{-- Mini Calendar Stamp --}}
                            <div class="absolute top-3 left-3 sm:top-4 sm:left-4 flex flex-col items-center justify-center rounded-xl bg-white/95 backdrop-blur-sm px-2.5 py-1 sm:px-3 sm:py-1.5 shadow-md border border-white/50 text-center">
                                <span class="text-[9px] font-black uppercase tracking-widest text-orange-600 leading-none">{{ $news->created_at?->format('M') ?? 'LIS' }}</span>
                                <span class="text-base sm:text-lg font-black text-[#081747] leading-none mt-0.5">{{ $news->created_at?->format('d') ?? '01' }}</span>
                            </div>

                            @if(count($itemImages) > 1)
                                <div class="absolute bottom-2.5 right-2.5 bg-black/60 backdrop-blur-md px-2.5 py-1 rounded-lg text-white text-[10px] sm:text-[11px] font-bold flex items-center gap-1 border border-white/20">
                                    <svg class="w-3.5 h-3.5 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span>{{ count($itemImages) }} Photos</span>
                                </div>
                            @endif
                        </div>

                        {{-- Card Body --}}
                        <div class="flex flex-1 flex-col p-6 sm:p-7 justify-between">
                            <div>
                                <span class="text-[11px] font-bold uppercase tracking-wider text-blue-600">News Release</span>
                                <h4 class="mt-1.5 text-base sm:text-lg font-black text-[#081747] line-clamp-2 leading-snug group-hover:text-orange-500 transition-colors">
                                    {{ $news->title }}
                                </h4>
                                <p class="mt-2.5 text-xs sm:text-sm text-slate-500 line-clamp-3 leading-relaxed">
                                    {!! Str::limit(strip_tags($news->description), 140) !!}
                                </p>
                            </div>

                            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                                <button type="button" 
                                    onclick="openModal(this)"
                                    data-images='@json($itemImages)'
                                    data-title="{{ $news->title }}"
                                    data-link="{{ $news->link ?? '' }}"
                                    data-date="{{ $news->created_at?->format('F d, Y') ?? '' }}"
                                    class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-black uppercase tracking-wider text-[#081747] group-hover:text-orange-500 transition-colors">
                                    <span>Read Story</span>
                                    <svg class="w-3.5 h-3.5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                </button>
                                
                                <div class="hidden news-full-description">{!! $news->description !!}</div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif

        @if($allNews->isEmpty())
            <div class="rounded-[2rem] border border-dashed border-slate-300 bg-white p-12 text-center shadow-xs">
                <div class="mx-auto w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mb-3">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v8a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 class="text-xl font-black text-[#081747]">No stories published yet</h3>
                <p class="text-xs sm:text-sm text-slate-500 mt-1.5">New announcements and events will appear here soon.</p>
            </div>
        @endif

    </main>

</div>

{{-- 🔍 Dynamic News Modal --}}
<div id="newsModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-950/80 p-3 sm:p-4 opacity-0 backdrop-blur-md transition-opacity duration-300" aria-hidden="true">
    <div id="modalContent" role="dialog" aria-modal="true" class="relative max-h-[92vh] w-full max-w-5xl scale-95 overflow-y-auto rounded-[2rem] sm:rounded-[2.5rem] bg-white shadow-2xl transition-transform duration-300">
        
        <button id="modalCloseButton" type="button" onclick="closeModal()" aria-label="Close" class="absolute right-4 top-4 sm:right-5 sm:top-5 z-30 flex h-9 w-9 sm:h-10 sm:w-10 items-center justify-center rounded-full bg-slate-900/60 text-white hover:bg-orange-500 transition-colors shadow-md">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        {{-- Modal Image Slider --}}
        <div class="relative aspect-[16/9] w-full overflow-hidden bg-slate-950" id="modalImageContainer">
            <img id="modalImage" src="" alt="" class="h-full w-full object-contain">
            
            <button type="button" id="modalPrevBtn" class="absolute left-3 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-black/50 hover:bg-orange-500 text-white flex items-center justify-center transition-colors">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button type="button" id="modalNextBtn" class="absolute right-3 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-black/50 hover:bg-orange-500 text-white flex items-center justify-center transition-colors">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>

            <div id="modalCounter" class="absolute bottom-3 right-3 sm:bottom-4 sm:right-4 bg-black/70 px-3 py-1 rounded-full text-white text-[11px] sm:text-xs font-bold backdrop-blur-sm"></div>
        </div>

        <div class="p-6 sm:p-10">
            <span id="modalDate" class="inline-block text-xs font-bold uppercase tracking-widest text-orange-500 mb-2"></span>
            <h2 id="modalTitle" class="text-xl sm:text-3xl font-black text-[#081747] leading-tight"></h2>
            
            <div id="modalDesc" class="mt-4 sm:mt-6 text-sm sm:text-base leading-relaxed text-slate-600 space-y-4"></div>

            <div class="mt-8 pt-5 border-t border-slate-100 flex items-center justify-between">
                <a id="modalLink" href="#" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-xs sm:text-sm font-bold text-blue-600 hover:text-orange-500 transition-colors">
                    <span>View original source link</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    const newsModal = document.getElementById('newsModal');
    const modalContent = document.getElementById('modalContent');
    const modalImage = document.getElementById('modalImage');
    const modalImageContainer = document.getElementById('modalImageContainer');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDesc');
    const modalDate = document.getElementById('modalDate');
    const modalLink = document.getElementById('modalLink');
    const modalCloseButton = document.getElementById('modalCloseButton');
    const modalPrevBtn = document.getElementById('modalPrevBtn');
    const modalNextBtn = document.getElementById('modalNextBtn');
    const modalCounter = document.getElementById('modalCounter');

    let currentModalImages = [];
    let currentModalIndex = 0;

    function renderModalImage() {
        if (currentModalImages.length > 0) {
            modalImage.src = currentModalImages[currentModalIndex];
            modalImageContainer.classList.remove('hidden');
            
            if (currentModalImages.length > 1) {
                modalPrevBtn.classList.remove('hidden');
                modalNextBtn.classList.remove('hidden');
                modalCounter.classList.remove('hidden');
                modalCounter.textContent = `${currentModalIndex + 1} / ${currentModalImages.length}`;
            } else {
                modalPrevBtn.classList.add('hidden');
                modalNextBtn.classList.add('hidden');
                modalCounter.classList.add('hidden');
            }
        } else {
            modalImageContainer.classList.add('hidden');
        }
    }

    modalPrevBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        if (currentModalImages.length <= 1) return;
        currentModalIndex = (currentModalIndex - 1 + currentModalImages.length) % currentModalImages.length;
        renderModalImage();
    });

    modalNextBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        if (currentModalImages.length <= 1) return;
        currentModalIndex = (currentModalIndex + 1) % currentModalImages.length;
        renderModalImage();
    });

    function openModal(card) {
        try {
            currentModalImages = JSON.parse(card.dataset.images || '[]');
        } catch (e) {
            currentModalImages = card.dataset.image ? [card.dataset.image] : [];
        }

        currentModalIndex = 0;
        const title = card.dataset.title || 'News Update';
        const date = card.dataset.date || '';
        const link = card.dataset.link || '';
        const descContainer = card.parentElement.querySelector('.news-full-description');
        const descHtml = descContainer ? descContainer.innerHTML : '';

        modalTitle.textContent = title;
        modalDescription.innerHTML = descHtml || 'No further description is available.';
        modalDate.textContent = date;
        modalLink.href = link || 'https://www.facebook.com/LISOfficialPage';

        renderModalImage();

        newsModal.classList.remove('hidden');
        newsModal.classList.add('flex');
        document.body.style.overflow = 'hidden';

        requestAnimationFrame(() => {
            newsModal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
            modalCloseButton.focus();
        });
    }

    function closeModal() {
        newsModal.classList.add('opacity-0');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');

        setTimeout(() => {
            newsModal.classList.add('hidden');
            newsModal.classList.remove('flex');
            document.body.style.overflow = '';
        }, 300);
    }

    newsModal.addEventListener('click', function(e) {
        if (e.target === newsModal) closeModal();
    });

    document.addEventListener('keydown', function(e) {
        if (newsModal.classList.contains('hidden')) return;

        if (e.key === 'Escape') closeModal();
        if (e.key === 'ArrowLeft') modalPrevBtn.click();
        if (e.key === 'ArrowRight') modalNextBtn.click();
    });
</script>

@endsection