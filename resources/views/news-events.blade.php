@extends('layout')

@section('title', 'News & Events - Life International School')

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

{{-- Hero Banner --}}
<section class="relative isolate flex min-h-[330px] w-full items-center justify-center overflow-hidden bg-gradient-to-br from-[#081747] via-[#173c9c] to-[#2563eb] md:min-h-[400px]">
    <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: radial-gradient(circle, rgba(255, 255, 255, 0.8) 1px, transparent 1px); background-size: 24px 24px;"></div>
    <div class="absolute -left-32 -top-32 h-80 w-80 rounded-full bg-blue-400/30 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-36 right-0 h-96 w-96 rounded-full bg-orange-400/20 blur-3xl pointer-events-none"></div>

    <div class="relative z-10 mx-auto max-w-4xl px-6 pt-16 pb-20 text-center">
        <div data-aos="fade-down" class="mb-5 inline-flex items-center rounded-full border border-white/25 bg-white/10 px-5 py-2 text-sm font-semibold uppercase tracking-wider text-blue-50 backdrop-blur-sm">
            Life International School
        </div>
        <h1 data-aos="fade-up" data-aos-delay="100" class="text-4xl font-black uppercase tracking-wide text-white drop-shadow-lg sm:text-5xl md:text-6xl">
            News & Events
        </h1>
        <div data-aos="zoom-in" data-aos-delay="200" class="mx-auto mt-6 h-1.5 w-24 rounded-full bg-orange-400 shadow-lg"></div>
        <p data-aos="fade-up" data-aos-delay="300" class="mx-auto mt-6 max-w-2xl text-base leading-relaxed text-blue-50/90 md:text-lg">
            Discover the latest news, student achievements, school activities,
            and upcoming events from our community.
        </p>
    </div>

    {{-- 📍 បន្ទាត់ Highlight ពណ៌មាសអមតាមគែមទ្រេត (Metallic Gold Ribbon) --}}
    <div class="absolute -bottom-px left-0 h-[45px] w-full bg-gradient-to-r from-[#b45309] via-[#fde047] to-[#d97706] shadow-[0_0_18px_rgba(251,191,36,0.6)] md:h-[65px]" 
         style="clip-path: polygon(0 70%, 100% 0, 100% 100%, 0 100%);"></div>

    {{-- ផ្ទៃពណ៌សាច់ខាងក្រោម (Slate-50) កាត់ពីលើ បន្សល់ឆ្នូតមាសកម្រាស់ប្រហែល 5px --}}
    <div class="absolute -bottom-px left-0 h-10 w-full bg-slate-50 md:h-14" 
         style="clip-path: polygon(0 70%, 100% 0, 100% 100%, 0 100%);"></div>
</section>

{{-- News Section --}}
<section class="bg-slate-50 px-5 py-16 md:px-8 md:py-20">
    <div class="mx-auto max-w-7xl">

        {{-- Section heading --}}
        <div class="mb-12 flex flex-col gap-5 text-center md:flex-row md:items-end md:justify-between md:text-left">
            <div data-aos="fade-right">
                <div class="mb-3 flex items-center justify-center gap-3 md:justify-start">
                    <span class="h-1 w-10 rounded-full bg-orange-500"></span>
                    <span class="text-sm font-bold uppercase tracking-[0.18em] text-orange-500">
                        Stay Connected
                    </span>
                </div>
                <h2 class="text-3xl font-black text-[#081747] md:text-4xl">
                    Latest News & Events
                </h2>
                <p class="mt-3 max-w-2xl text-base leading-relaxed text-slate-600">
                    Stay informed about achievements, activities and important
                    updates from Life International School.
                </p>
            </div>

            <div data-aos="fade-left" class="mx-auto inline-flex items-center gap-2 rounded-full border border-blue-100 bg-white px-5 py-2.5 text-sm font-bold text-blue-900 shadow-sm md:mx-0">
                <svg class="h-5 w-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m10 0V5a2 2 0 00-2-2H9a2 2 0 00-2 2v2m10 0H7"></path>
                </svg>
                {{ count($newsList ?? []) }} {{ count($newsList ?? []) === 1 ? 'Update' : 'Updates' }}
            </div>
        </div>

        {{-- Cards --}}
        @if(isset($newsList) && count($newsList) > 0)
            <div class="flex flex-wrap justify-center gap-8">
                @foreach($newsList as $index => $news)
                    <button
                        data-aos="fade-up"
                        data-aos-delay="{{ ($index % 3) * 150 }}"
                        type="button"
                        onclick="openModal(this)"
                        data-image="{{ $getMediaUrl($news->image) }}"
                        data-title="{{ $news->title }}"
                        data-link="{{ $news->link ?? '' }}"
                        data-date="{{ $news->created_at?->format('F d, Y') ?? '' }}"
                        class="group flex w-full max-w-[390px] flex-col overflow-hidden rounded-[24px] border border-slate-200 bg-white text-left shadow-[0_10px_35px_rgba(15,23,42,0.08)] transition-all duration-300 hover:-translate-y-2 hover:border-blue-200 hover:shadow-[0_22px_50px_rgba(30,64,175,0.18)] sm:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.4rem)]"
                    >
                        <div class="hidden news-full-description">{!! $news->description !!}</div>

                        {{-- Image --}}
                        <div class="relative aspect-[16/10] w-full overflow-hidden bg-slate-100">
                            @if($news->image)
                                <img
                                    src="{{ $getMediaUrl($news->image) }}"
                                    alt="{{ $news->title }}"
                                    class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                                    loading="lazy"
                                >
                            @else
                                <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-blue-100 to-slate-100">
                                    <svg class="h-16 w-16 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11l-7-7-7 7m14 0v8a2 2 0 01-2 2H7a2 2 0 01-2-2v-8m14 0H5"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-[#081747]/70 via-transparent to-transparent opacity-60 transition-opacity duration-300 group-hover:opacity-80"></div>
                            
                            @if($news->created_at)
                                <div class="absolute left-4 top-4 rounded-full border border-white/30 bg-white/90 px-4 py-2 text-xs font-bold text-blue-900 shadow-lg backdrop-blur-md">
                                    {{ $news->created_at->format('M d, Y') }}
                                </div>
                            @endif
                            
                            <div class="absolute bottom-4 right-4 flex h-11 w-11 translate-y-3 items-center justify-center rounded-full bg-orange-500 text-white opacity-0 shadow-lg transition-all duration-300 group-hover:translate-y-0 group-hover:opacity-100">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12 18 18.75 12 18.75 2.25 12 2.25 12Z"></path>
                                    <circle cx="12" cy="12" r="3" stroke-width="2"></circle>
                                </svg>
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="flex flex-grow flex-col p-6">
                            <div class="mb-3 flex items-center gap-2">
                                <span class="h-2 w-2 rounded-full bg-orange-500"></span>
                                <span class="text-xs font-bold uppercase tracking-wider text-blue-700">
                                    School Update
                                </span>
                            </div>

                            <h3 class="mb-3 line-clamp-2 text-xl font-extrabold leading-snug text-[#081747] transition-colors duration-300 group-hover:text-blue-700">
                                {{ $news->title }}
                            </h3>

                            @if($news->description)
                                <p class="mb-6 line-clamp-3 text-sm leading-6 text-slate-600">
                                    {!! Str::limit(strip_tags($news->description), 150) !!}
                                </p>
                            @else
                                <p class="mb-6 text-sm italic leading-6 text-slate-400">
                                    Click to view more information about this update.
                                </p>
                            @endif

                            <div class="mt-auto flex items-center justify-between border-t border-slate-100 pt-5">
                                <span class="text-sm font-bold text-blue-800">
                                    Read full story
                                </span>
                                <span class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-50 text-blue-800 transition-all duration-300 group-hover:bg-orange-500 group-hover:text-white">
                                    <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </button>
                @endforeach
            </div>
        @else
            <div data-aos="fade-up" class="rounded-[28px] border border-dashed border-blue-200 bg-white px-6 py-20 text-center shadow-sm">
                <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-blue-50 text-blue-700">
                    <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v8a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-blue-950">No news available yet</h3>
                <p class="mt-3 text-slate-500">Please check again later for our latest news and events.</p>
            </div>
        @endif
    </div>
</section>

{{-- News Modal --}}
<div id="newsModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-950/80 p-4 opacity-0 backdrop-blur-md transition-opacity duration-300" aria-hidden="true">
    <div id="modalContent" role="dialog" aria-modal="true" aria-labelledby="modalTitle" class="relative max-h-[92vh] w-full max-w-5xl scale-95 overflow-y-auto rounded-[28px] bg-white shadow-2xl transition-transform duration-300">
        <button id="modalCloseButton" type="button" onclick="closeModal()" aria-label="Close" class="absolute right-4 top-4 z-20 flex h-11 w-11 items-center justify-center rounded-full bg-slate-950/70 text-white shadow-lg backdrop-blur-sm transition-colors hover:bg-red-600">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <div class="grid min-h-[480px] grid-cols-1 lg:grid-cols-2">
            <div id="modalImageContainer" class="relative min-h-[300px] overflow-hidden bg-slate-100 lg:min-h-full">
                <img id="modalImage" src="" alt="" class="absolute inset-0 h-full w-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/30 to-transparent"></div>
            </div>

            <div class="flex flex-col justify-center p-7 md:p-10 lg:p-12">
                <div class="mb-5 flex items-center gap-3">
                    <span class="h-1 w-10 rounded-full bg-orange-500"></span>
                    <span id="modalDate" class="text-sm font-bold uppercase tracking-wider text-orange-500"></span>
                </div>

                <h2 id="modalTitle" class="text-3xl font-black leading-tight text-[#081747] md:text-4xl"></h2>

                <div id="modalDesc" class="mt-6 text-base leading-7 text-slate-600"></div>

                <a id="modalLink" href="#" target="_blank" rel="noopener noreferrer" class="mt-9 inline-flex items-center justify-center gap-3 rounded-xl bg-[#173c9c] px-7 py-4 font-bold text-white shadow-lg transition-all duration-300 hover:-translate-y-1 hover:bg-orange-500 hover:shadow-xl">
                    View original post
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6m0 0v6m0-6L10 16M7 7H5a2 2 0 00-2 2v10a2 2 0 002-2h10a2 2 0 002-2v-2"></path>
                    </svg>
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

    let previouslyFocusedElement = null;

    function getSafeExternalUrl(url) {
        const fallbackUrl = 'https://www.facebook.com/LISOfficialPage';
        if (!url) return fallbackUrl;
        try {
            const parsedUrl = new URL(url, window.location.origin);
            if (parsedUrl.protocol === 'http:' || parsedUrl.protocol === 'https:') {
                return parsedUrl.href;
            }
        } catch (error) {
            return fallbackUrl;
        }
        return fallbackUrl;
    }

    function openModal(card) {
        previouslyFocusedElement = document.activeElement;

        const image = card.dataset.image || '';
        const title = card.dataset.title || 'News & Events';
        const date = card.dataset.date || 'Latest update';
        const link = card.dataset.link || '';
        const descHtml = card.querySelector('.news-full-description').innerHTML;

        modalImage.src = image;
        modalImage.alt = title;
        modalTitle.textContent = title;
        modalDescription.innerHTML = descHtml || 'No additional description is available for this update.';
        modalDate.textContent = date;
        modalLink.href = getSafeExternalUrl(link);

        if (image) {
            modalImageContainer.classList.remove('hidden');
        } else {
            modalImageContainer.classList.add('hidden');
        }

        newsModal.classList.remove('hidden');
        newsModal.classList.add('flex');
        newsModal.setAttribute('aria-hidden', 'false');
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
        newsModal.setAttribute('aria-hidden', 'true');

        setTimeout(() => {
            newsModal.classList.add('hidden');
            newsModal.classList.remove('flex');
            document.body.style.overflow = '';
            if (previouslyFocusedElement) previouslyFocusedElement.focus();
        }, 300);
    }

    newsModal.addEventListener('click', function (event) {
        if (event.target === newsModal) closeModal();
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && !newsModal.classList.contains('hidden')) {
            closeModal();
        }
    });
</script>

@endsection