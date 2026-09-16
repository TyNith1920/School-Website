@extends('layout')

@section('title', 'News & Events - Life International School')

@section('content')

@php
    $getMediaUrl = function($path) {
        if (empty($path)) return null;
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) return $path;
        try { 
            return \Storage::disk('s3')->url($path); 
        } catch (\Exception $e) { 
            return asset('storage/' . $path); 
        }
    };

    $allNews = collect($newsList ?? []);
    $featuredNews = $allNews->first();
    $regularNews = $allNews->slice(1);
@endphp

<div class="min-h-screen bg-[#f8fafc] text-slate-800">

    {{-- Clean Editorial Header --}}
    <header class="border-b border-slate-200 bg-white pt-12 pb-8">
        <div class="mx-auto max-w-7xl px-5 md:px-8">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-50 border border-orange-200 text-orange-600 text-xs font-black uppercase tracking-widest mb-3">
                        <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                        LIS Gazette & Newsroom
                    </div>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black uppercase tracking-tight text-[#081747]">
                        News <span class="text-orange-500">&</span> Events
                    </h1>
                    <p class="mt-3 text-base sm:text-lg text-slate-500 max-w-xl font-normal leading-relaxed">
                        Stay connected with daily moments, academic milestones, and inspiring stories from our vibrant school community.
                    </p>
                </div>

                {{-- Live Updates Counter --}}
                <div class="inline-flex items-center gap-3 self-start md:self-auto rounded-2xl bg-slate-50 border border-slate-200 px-5 py-3 text-sm font-bold text-slate-700 shadow-sm">
                    <span class="flex h-3 w-3 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                    </span>
                    <span>{{ $allNews->count() }} Published Stories</span>
                </div>
            </div>

            {{-- Category Filter Pills --}}
            <div class="mt-8 pt-6 border-t border-slate-100 flex flex-wrap items-center gap-2.5">
                <span class="text-xs font-black uppercase tracking-wider text-slate-400 mr-2">Filter by:</span>
                <button type="button" class="px-4 py-2 rounded-xl text-xs font-bold bg-[#081747] text-white shadow-sm transition-all hover:bg-orange-500">All Updates</button>
                <button type="button" class="px-4 py-2 rounded-xl text-xs font-bold bg-white text-slate-600 border border-slate-200 hover:border-orange-400 hover:text-orange-500 transition-all">Academic Highlights</button>
                <button type="button" class="px-4 py-2 rounded-xl text-xs font-bold bg-white text-slate-600 border border-slate-200 hover:border-orange-400 hover:text-orange-500 transition-all">School Activities</button>
                <button type="button" class="px-4 py-2 rounded-xl text-xs font-bold bg-white text-slate-600 border border-slate-200 hover:border-orange-400 hover:text-orange-500 transition-all">Official Notices</button>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-5 md:px-8 py-12 md:py-16">

        @if($featuredNews)
            {{-- Featured Magazine Lead Story --}}
            <section data-aos="fade-up" class="mb-16">
                <div class="group relative overflow-hidden rounded-[2.5rem] bg-white border border-slate-200 shadow-[0_20px_50px_rgba(15,23,42,0.06)] hover:shadow-[0_25px_60px_rgba(30,64,175,0.12)] transition-all duration-500">
                    <div class="grid grid-cols-1 lg:grid-cols-12">
                        
                        {{-- Featured Image --}}
                        <div class="relative lg:col-span-7 aspect-[16/10] lg:aspect-auto overflow-hidden bg-slate-100 min-h-[340px]">
                            @if($featuredNews->image)
                                <img src="{{ $getMediaUrl($featuredNews->image) }}" alt="{{ $featuredNews->title }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent lg:hidden"></div>

                            {{-- Calendar Date Stamp --}}
                            <div class="absolute top-6 left-6 flex flex-col items-center justify-center rounded-2xl bg-white/95 backdrop-blur-md px-4 py-2.5 shadow-xl border border-white/40 text-center">
                                <span class="text-[11px] font-black uppercase tracking-widest text-orange-600">{{ $featuredNews->created_at?->format('M') ?? 'LIS' }}</span>
                                <span class="text-2xl font-black text-[#081747] leading-none mt-0.5">{{ $featuredNews->created_at?->format('d') ?? '01' }}</span>
                            </div>

                            <span class="absolute bottom-6 left-6 lg:bottom-auto lg:top-6 lg:left-28 inline-flex items-center gap-2 rounded-full bg-orange-500 px-4 py-1.5 text-xs font-black uppercase tracking-wider text-white shadow-lg">
                                ★ Featured Story
                            </span>
                        </div>

                        {{-- Featured Content --}}
                        <div class="lg:col-span-5 p-8 sm:p-10 lg:p-12 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-3 text-xs font-bold uppercase tracking-wider text-slate-400 mb-4">
                                    <span class="text-orange-500 font-black">Life International School</span>
                                    <span>•</span>
                                    <span>{{ $featuredNews->created_at?->format('Y') ?? '2026' }}</span>
                                </div>

                                <h2 class="text-2xl sm:text-3xl font-black leading-tight text-[#081747] group-hover:text-blue-700 transition-colors">
                                    {{ $featuredNews->title }}
                                </h2>

                                <p class="mt-5 text-sm sm:text-base leading-relaxed text-slate-600 line-clamp-4">
                                    {!! Str::limit(strip_tags($featuredNews->description), 200) !!}
                                </p>
                            </div>

                            <div class="pt-8 mt-8 border-t border-slate-100 flex items-center justify-between">
                                <button type="button" 
                                    onclick="openModal(this)"
                                    data-image="{{ $getMediaUrl($featuredNews->image) }}"
                                    data-title="{{ $featuredNews->title }}"
                                    data-link="{{ $featuredNews->link ?? '' }}"
                                    data-date="{{ $featuredNews->created_at?->format('F d, Y') ?? '' }}"
                                    class="inline-flex items-center gap-3 bg-[#081747] hover:bg-orange-500 text-white text-sm font-bold uppercase tracking-wider px-6 py-3.5 rounded-xl shadow-md hover:-translate-y-0.5 transition-all">
                                    <span>Read Full Article</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </button>
                                
                                <div class="hidden news-full-description">{!! $featuredNews->description !!}</div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        @endif

        {{-- Regular News Grid --}}
        @if($regularNews->count() > 0)
            <div class="mb-10 flex items-center justify-between">
                <h3 class="text-2xl font-black uppercase text-[#081747]">More Stories & Happenings</h3>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">{{ $regularNews->count() }} More Updates</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($regularNews as $index => $news)
                    <article data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}"
                        class="group flex flex-col overflow-hidden rounded-[2rem] bg-white border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300">
                        
                        {{-- Card Image & Date Stamp --}}
                        <div class="relative aspect-[16/10] overflow-hidden bg-slate-100">
                            @if($news->image)
                                <img src="{{ $getMediaUrl($news->image) }}" alt="{{ $news->title }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                            @else
                                <div class="flex h-full w-full items-center justify-center bg-blue-50 text-blue-300 font-bold">LIS Update</div>
                            @endif

                            {{-- Mini Calendar Stamp --}}
                            <div class="absolute top-4 left-4 flex flex-col items-center justify-center rounded-xl bg-white/95 backdrop-blur-sm px-3 py-1.5 shadow-md border border-white/50 text-center">
                                <span class="text-[9px] font-black uppercase tracking-widest text-orange-600 leading-none">{{ $news->created_at?->format('M') ?? 'LIS' }}</span>
                                <span class="text-lg font-black text-[#081747] leading-none mt-1">{{ $news->created_at?->format('d') ?? '01' }}</span>
                            </div>
                        </div>

                        {{-- Card Body --}}
                        <div class="flex flex-1 flex-col p-6 sm:p-7 justify-between">
                            <div>
                                <span class="text-[11px] font-bold uppercase tracking-wider text-blue-600">News Release</span>
                                <h4 class="mt-2 text-lg sm:text-xl font-black text-[#081747] line-clamp-2 leading-snug group-hover:text-orange-500 transition-colors">
                                    {{ $news->title }}
                                </h4>
                                <p class="mt-3 text-sm text-slate-500 line-clamp-3 leading-relaxed">
                                    {!! Str::limit(strip_tags($news->description), 120) !!}
                                </p>
                            </div>

                            <div class="mt-6 pt-5 border-t border-slate-100 flex items-center justify-between">
                                <button type="button" 
                                    onclick="openModal(this)"
                                    data-image="{{ $getMediaUrl($news->image) }}"
                                    data-title="{{ $news->title }}"
                                    data-link="{{ $news->link ?? '' }}"
                                    data-date="{{ $news->created_at?->format('F d, Y') ?? '' }}"
                                    class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-wider text-[#081747] group-hover:text-orange-500 transition-colors">
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
            <div class="rounded-[2.5rem] border border-dashed border-slate-300 bg-white p-16 text-center shadow-sm">
                <div class="mx-auto w-16 h-16 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v8a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 class="text-2xl font-black text-[#081747]">No stories published yet</h3>
                <p class="text-sm text-slate-500 mt-2">New announcements and events will appear here soon.</p>
            </div>
        @endif

    </main>

</div>

{{-- Dynamic News Modal --}}
<div id="newsModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-950/80 p-4 opacity-0 backdrop-blur-md transition-opacity duration-300" aria-hidden="true">
    <div id="modalContent" role="dialog" aria-modal="true" class="relative max-h-[90vh] w-full max-w-4xl scale-95 overflow-y-auto rounded-[2rem] bg-white shadow-2xl transition-transform duration-300">
        
        <button id="modalCloseButton" type="button" onclick="closeModal()" aria-label="Close" class="absolute right-5 top-5 z-20 flex h-10 w-10 items-center justify-center rounded-full bg-slate-900/60 text-white hover:bg-orange-500 transition-colors shadow-md">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        <div class="relative aspect-[16/9] w-full overflow-hidden bg-slate-100" id="modalImageContainer">
            <img id="modalImage" src="" alt="" class="h-full w-full object-cover">
        </div>

        <div class="p-8 sm:p-10">
            <span id="modalDate" class="inline-block text-xs font-bold uppercase tracking-widest text-orange-500 mb-3"></span>
            <h2 id="modalTitle" class="text-2xl sm:text-4xl font-black text-[#081747] leading-tight"></h2>
            
            <div id="modalDesc" class="mt-6 text-base sm:text-lg leading-relaxed text-slate-600 divide-y divide-slate-100"></div>

            <div class="mt-10 pt-6 border-t border-slate-100 flex items-center justify-between">
                <a id="modalLink" href="#" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-sm font-bold text-blue-600 hover:text-orange-500 transition-colors">
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

    function openModal(card) {
        const image = card.dataset.image || '';
        const title = card.dataset.title || 'News Update';
        const date = card.dataset.date || '';
        const link = card.dataset.link || '';
        const descHtml = card.querySelector('.news-full-description')?.innerHTML || card.parentElement.querySelector('.news-full-description')?.innerHTML || '';

        modalImage.src = image;
        modalImage.alt = title;
        modalTitle.textContent = title;
        modalDescription.innerHTML = descHtml || 'No further description is available.';
        modalDate.textContent = date;
        modalLink.href = link || 'https://www.facebook.com/LISOfficialPage';

        if (image) {
            modalImageContainer.classList.remove('hidden');
        } else {
            modalImageContainer.classList.add('hidden');
        }

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
        if (e.key === 'Escape' && !newsModal.classList.contains('hidden')) {
            closeModal();
        }
    });
</script>

@endsection