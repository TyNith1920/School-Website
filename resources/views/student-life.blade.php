@extends('layout')

@section('title', 'Student Life - Life International School')

@section('content')

@php
    $getMediaUrl = function($path) use (&$getMediaUrl) {
        if (empty($path)) return null;
        if (is_array($path)) {
            $first = reset($path);
            return $getMediaUrl($first);
        }
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) return $path;
        try { 
            return \Storage::disk('s3')->url($path); 
        } catch (\Exception $e) { 
            return asset('storage/' . $path); 
        }
    };

    $allActivities = collect($activities ?? []);
    $leadActivity = $allActivities->first();
    $subActivities = $allActivities->slice(1);
@endphp

<div class="min-h-screen bg-[#f8fafc] text-slate-800">

    {{-- 🌟 ១. Fresh Editorial Magazine Hero (ភ្លឺ ស្រស់ថ្លា និងស្អាតប្លែកភ្នែក) --}}
    <section class="relative overflow-hidden bg-white border-b border-slate-200/80 pt-14 pb-16 md:pt-20 md:pb-24">
        
        {{-- Soft Warm Glows --}}
        <div class="absolute -top-24 right-1/4 h-80 w-80 rounded-full bg-amber-400/10 blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 -left-20 h-72 w-72 rounded-full bg-blue-400/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 mx-auto max-w-7xl px-6 md:px-10 text-center">
            
            {{-- Category Pill --}}
            <div data-aos="fade-down" class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-amber-50 border border-amber-200/80 text-amber-700 text-xs font-black uppercase tracking-[0.2em] shadow-xs mb-6">
                <span class="w-2 h-2 rounded-full bg-amber-500 animate-ping"></span>
                Life International School • Campus Life
            </div>

            {{-- Main Modern Heading --}}
            <h1 data-aos="fade-up" data-aos-delay="100" class="text-4xl sm:text-6xl md:text-7xl font-black uppercase tracking-tight text-[#081747] leading-[1.05]">
                Vibrant <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-500 via-orange-500 to-amber-600">Student Life</span>
            </h1>

            <div data-aos="zoom-in" data-aos-delay="150" class="mx-auto mt-4 mb-6 h-1.5 w-24 rounded-full bg-gradient-to-r from-amber-400 to-orange-500 shadow-sm"></div>

            <p data-aos="fade-up" data-aos-delay="200" class="mx-auto max-w-2xl text-base sm:text-lg md:text-xl text-slate-600 font-normal leading-relaxed">
                ការលូតលាស់ទាំងចំណេះដឹង សីលធម៌ ជំនឿគ្រីស្ទាន និងមិត្តភាពរឹងមាំ តាមរយៈក្លឹបសិក្សា សកម្មភាពកីឡា សិល្បៈ និងភាពជាអ្នកដឹកនាំ។
            </p>

            {{-- 📸 ២. Interactive Story Bubbles (ស្ទីលដូច Story Highlight លើបណ្តាញសង្គម) --}}
            <div data-aos="fade-up" data-aos-delay="300" class="mt-12 flex items-center justify-center gap-4 sm:gap-8 overflow-x-auto pb-4 pt-2">
                
                <div class="flex flex-col items-center gap-2 group cursor-pointer shrink-0">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full p-1 bg-gradient-to-tr from-amber-400 to-orange-500 shadow-md group-hover:scale-105 transition-transform">
                        <div class="w-full h-full rounded-full bg-white flex items-center justify-center text-xl sm:text-2xl shadow-inner">
                            ⚽
                        </div>
                    </div>
                    <span class="text-xs font-black uppercase tracking-wider text-slate-700">Athletics</span>
                </div>

                <div class="flex flex-col items-center gap-2 group cursor-pointer shrink-0">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full p-1 bg-gradient-to-tr from-orange-400 to-rose-500 shadow-md group-hover:scale-105 transition-transform">
                        <div class="w-full h-full rounded-full bg-white flex items-center justify-center text-xl sm:text-2xl shadow-inner">
                            🎨
                        </div>
                    </div>
                    <span class="text-xs font-black uppercase tracking-wider text-slate-700">Arts & Drama</span>
                </div>

                <div class="flex flex-col items-center gap-2 group cursor-pointer shrink-0">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full p-1 bg-gradient-to-tr from-blue-500 to-indigo-600 shadow-md group-hover:scale-105 transition-transform">
                        <div class="w-full h-full rounded-full bg-white flex items-center justify-center text-xl sm:text-2xl shadow-inner">
                            ✝️
                        </div>
                    </div>
                    <span class="text-xs font-black uppercase tracking-wider text-slate-700">Chapel & Faith</span>
                </div>

                <div class="flex flex-col items-center gap-2 group cursor-pointer shrink-0">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full p-1 bg-gradient-to-tr from-emerald-400 to-teal-600 shadow-md group-hover:scale-105 transition-transform">
                        <div class="w-full h-full rounded-full bg-white flex items-center justify-center text-xl sm:text-2xl shadow-inner">
                            🌿
                        </div>
                    </div>
                    <span class="text-xs font-black uppercase tracking-wider text-slate-700">Community</span>
                </div>

                <div class="flex flex-col items-center gap-2 group cursor-pointer shrink-0">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full p-1 bg-gradient-to-tr from-amber-300 to-yellow-500 shadow-md group-hover:scale-105 transition-transform">
                        <div class="w-full h-full rounded-full bg-[#081747] text-amber-300 flex items-center justify-center text-sm font-black shadow-inner">
                            {{ $allActivities->count() }}+
                        </div>
                    </div>
                    <span class="text-xs font-black uppercase tracking-wider text-slate-700">Total Events</span>
                </div>

            </div>

        </div>
    </section>

    {{-- 🌟 ៣. Activities Gallery Showcase --}}
    <main class="mx-auto max-w-7xl px-6 md:px-10 py-14 md:py-20">

        @if($allActivities->isNotEmpty())

            {{-- 🏆 Lead Spotlight Card (រូបភាពនៅឆ្វេងភ្លឺច្បាស់ អក្សរនៅស្តាំ មិនបាំងមុខមនុស្ស) --}}
            @if($leadActivity)
                @php
                    $rawLeadImages = $leadActivity->gallery_images;
                    $leadGallery = is_array($rawLeadImages) ? $rawLeadImages : (is_string($rawLeadImages) ? json_decode($rawLeadImages, true) ?? [] : []);
                    $leadCount = count($leadGallery);
                @endphp

                <div data-aos="fade-up" class="mb-20">
                    <div class="overflow-hidden rounded-[2.5rem] bg-white border border-slate-200 shadow-[0_20px_60px_rgba(15,23,42,0.06)] hover:shadow-2xl transition-all duration-500">
                        <div class="grid grid-cols-1 lg:grid-cols-12 items-stretch">
                            
                            {{-- Image Side (រូបភាពធំច្បាស់ធម្មជាតិ) --}}
                            <div class="relative lg:col-span-7 min-h-[360px] md:min-h-[460px] bg-slate-900 overflow-hidden group">
                                @if($leadActivity->image)
                                    <img src="{{ $getMediaUrl($leadActivity->image) }}" alt="{{ $leadActivity->title }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
                                @endif
                                
                                <div class="absolute top-6 left-6 inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-amber-500 to-orange-500 px-4 py-1.5 text-xs font-black uppercase tracking-wider text-white shadow-lg">
                                    ★ Featured Program
                                </div>

                                @if($leadCount > 0)
                                    <div class="absolute bottom-6 left-6 bg-black/60 backdrop-blur-md border border-white/20 px-4 py-1.5 rounded-full text-white text-xs font-bold shadow-lg flex items-center gap-2">
                                        <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ $leadCount }} Full Album Photos
                                    </div>
                                @endif
                            </div>

                            {{-- Content Side --}}
                            <div class="lg:col-span-5 p-8 sm:p-10 lg:p-12 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center gap-2 text-xs font-black uppercase tracking-wider text-amber-600 mb-3">
                                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                        Spotlight Experience
                                    </div>

                                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#081747] leading-tight">
                                        {{ $leadActivity->title }}
                                    </h2>

                                    <p class="mt-5 text-sm sm:text-base leading-relaxed text-slate-600 font-normal">
                                        {{ $leadActivity->description ?: 'Explore memorable moments, student achievements, and collaborative activities from this core school event.' }}
                                    </p>
                                </div>

                                <div class="mt-8 pt-6 border-t border-slate-100 flex flex-wrap items-center gap-4">
                                    <a href="{{ url('/student-life/' . $leadActivity->id . '/gallery') }}" class="inline-flex items-center gap-3 bg-[#081747] hover:bg-orange-500 text-white text-xs sm:text-sm font-black uppercase tracking-wider px-7 py-3.5 rounded-xl shadow-md hover:-translate-y-0.5 transition-all duration-300">
                                        <span>View Photo Gallery</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>

                                    @if($leadActivity->link)
                                        <a href="{{ $leadActivity->link }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-slate-500 hover:text-orange-500 transition-colors">
                                            <span>Original Link</span>
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        </a>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif

            {{-- 📸 ៤. Other Campus Events Grid --}}
            @if($subActivities->isNotEmpty())
                <div class="mb-10 flex items-center justify-between">
                    <div>
                        <span class="text-xs font-black uppercase tracking-widest text-amber-600">Explore Memories</span>
                        <h3 class="text-2xl sm:text-3xl font-black uppercase text-[#081747] mt-1">Activities & Student Programs</h3>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400 bg-white border border-slate-200 px-3.5 py-1.5 rounded-full shadow-xs">
                        {{ $subActivities->count() }} Experiences
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($subActivities as $index => $activity)
                        @php
                            $rawImages = $activity->gallery_images;
                            $images = is_array($rawImages) ? $rawImages : (is_string($rawImages) ? json_decode($rawImages, true) ?? [] : []);
                            $photoCount = count($images);
                        @endphp

                        <article data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}"
                            class="group flex flex-col justify-between overflow-hidden rounded-[2rem] bg-white border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300">
                            
                            {{-- Image Cover --}}
                            <div class="relative aspect-[16/10] overflow-hidden bg-slate-100">
                                @if($activity->image)
                                    <img src="{{ $getMediaUrl($activity->image) }}" alt="{{ $activity->title }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                                @else
                                    <div class="flex h-full w-full items-center justify-center bg-blue-50 text-blue-300 font-bold text-sm">LIS Activity</div>
                                @endif

                                @if($photoCount > 0)
                                    <div class="absolute top-4 right-4 inline-flex items-center gap-1.5 rounded-full bg-white/95 backdrop-blur-sm px-3 py-1 text-xs font-bold text-[#081747] shadow-md border border-white/50">
                                        <svg class="w-3.5 h-3.5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ $photoCount }}
                                    </div>
                                @endif
                            </div>

                            {{-- Content Body --}}
                            <div class="flex flex-1 flex-col p-6 sm:p-7 justify-between">
                                <div>
                                    <span class="text-[11px] font-black uppercase tracking-wider text-amber-600">Enrichment Program</span>
                                    
                                    <h4 class="mt-2 text-lg sm:text-xl font-black text-[#081747] line-clamp-2 leading-snug group-hover:text-amber-600 transition-colors">
                                        {{ $activity->title }}
                                    </h4>
                                    
                                    <p class="mt-3 text-sm text-slate-500 line-clamp-3 leading-relaxed font-normal">
                                        {{ $activity->description ?: 'Discover student projects, interactive clubs, and exciting community moments.' }}
                                    </p>
                                </div>

                                <div class="mt-6 pt-5 border-t border-slate-100 flex items-center justify-between">
                                    <a href="{{ url('/student-life/' . $activity->id . '/gallery') }}" class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-wider text-[#081747] group-hover:text-amber-600 transition-colors">
                                        <span>Explore Gallery</span>
                                        <svg class="w-3.5 h-3.5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                    </a>

                                    @if($activity->link)
                                        <a href="{{ $activity->link }}" target="_blank" rel="noopener noreferrer" class="text-xs text-slate-400 hover:text-blue-600 transition-colors" title="External link">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        </a>
                                    @endif
                                </div>
                            </div>

                        </article>
                    @endforeach
                </div>
            @endif

        @else
            <div class="rounded-[2.5rem] border border-dashed border-slate-300 bg-white p-16 text-center shadow-sm">
                <div class="mx-auto w-16 h-16 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-2xl font-black text-[#081747]">No student activities added yet</h3>
                <p class="text-sm text-slate-500 mt-2">New student life events and gallery photos will appear here soon.</p>
            </div>
        @endif

    </main>
</div>

@endsection