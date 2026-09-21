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

<div class="min-h-screen bg-[#fafbfc] text-slate-800" x-data="{ activeTab: 'all' }">

    {{-- 🎨 ១. Hero Section: Campus Life Scrapbook & Magazine Banner --}}
    <section class="relative overflow-hidden bg-[#061238] pt-14 pb-24 md:pt-20 md:pb-32 text-white">
        {{-- Background Kinetic Glows --}}
        <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-orange-500/20 blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-10 right-0 w-[500px] h-[500px] rounded-full bg-blue-600/15 blur-[140px] pointer-events-none"></div>
        
        <div class="relative z-10 mx-auto max-w-7xl px-6 md:px-10">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
                
                {{-- Left Text Info --}}
                <div class="max-w-2xl text-center lg:text-left">
                    <div data-aos="fade-down" class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-white/10 border border-white/20 text-amber-300 text-xs font-black uppercase tracking-[0.25em] backdrop-blur-md mb-6">
                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                        Campus Vibe & Community
                    </div>

                    <h1 data-aos="fade-up" data-aos-delay="100" class="text-4xl sm:text-6xl md:text-7xl font-black uppercase tracking-tight leading-[1.05]">
                        Beyond <br class="hidden sm:inline">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-orange-400 to-amber-200">The Classroom</span>
                    </h1>

                    <p data-aos="fade-up" data-aos-delay="200" class="mt-6 text-base sm:text-lg md:text-xl text-blue-100/90 leading-relaxed font-light">
                        Building faith, leadership, lifelong friendships, and creative passion through our dynamic school traditions and holistic student experiences.
                    </p>

                    {{-- Quick Pill Filter --}}
                    <div data-aos="fade-up" data-aos-delay="300" class="mt-8 flex flex-wrap justify-center lg:justify-start gap-2.5">
                        <button @click="activeTab = 'all'" :class="activeTab === 'all' ? 'bg-amber-400 text-slate-950 font-black shadow-lg scale-105' : 'bg-white/10 text-white hover:bg-white/20'" class="px-5 py-2.5 rounded-2xl text-xs uppercase tracking-wider transition-all duration-300">
                            🌟 All Moments
                        </button>
                        <button @click="activeTab = 'sports'" :class="activeTab === 'sports' ? 'bg-amber-400 text-slate-950 font-black shadow-lg scale-105' : 'bg-white/10 text-white hover:bg-white/20'" class="px-5 py-2.5 rounded-2xl text-xs uppercase tracking-wider transition-all duration-300">
                            ⚽ Sports & House League
                        </button>
                        <button @click="activeTab = 'arts'" :class="activeTab === 'arts' ? 'bg-amber-400 text-slate-950 font-black shadow-lg scale-105' : 'bg-white/10 text-white hover:bg-white/20'" class="px-5 py-2.5 rounded-2xl text-xs uppercase tracking-wider transition-all duration-300">
                            🎨 Arts & Culture
                        </button>
                    </div>
                </div>

                {{-- Right Scrapbook Polaroids (រូបថតជង់គ្នាទ្រេតបែប Scrapbook យុវវ័យ) --}}
                <div data-aos="zoom-in" data-aos-delay="250" class="relative w-full max-w-sm h-80 flex items-center justify-center">
                    {{-- Polaroid 1 (Back) --}}
                    <div class="absolute w-60 bg-white p-3 pb-6 rounded-2xl shadow-2xl transform -rotate-12 -translate-x-8 -translate-y-4 hover:rotate-0 transition-transform duration-500 z-10">
                        <div class="h-44 bg-slate-200 rounded-xl overflow-hidden">
                            @if($leadActivity && $leadActivity->image)
                                <img src="{{ $getMediaUrl($leadActivity->image) }}" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <p class="mt-2 text-center font-bold text-xs text-slate-700 font-mono">Memories #01</p>
                    </div>

                    {{-- Polaroid 2 (Front Accent) --}}
                    <div class="absolute w-64 bg-white p-3 pb-6 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.5)] transform rotate-6 translate-x-6 translate-y-6 hover:rotate-0 transition-transform duration-500 z-20 border-t-8 border-amber-400">
                        <div class="h-48 bg-gradient-to-br from-[#081747] to-[#1a3a8f] rounded-xl flex flex-col items-center justify-center text-white p-4 text-center">
                            <span class="text-4xl font-black text-amber-300">{{ $allActivities->count() }}+</span>
                            <span class="text-xs uppercase tracking-widest font-black mt-1">Campus Events</span>
                            <span class="text-[10px] text-blue-200 mt-2">Every Student Has a Story</span>
                        </div>
                        <p class="mt-2 text-center font-bold text-xs text-slate-700 font-mono">Life At LIS ✨</p>
                    </div>
                </div>

            </div>
        </div>

        {{-- 📍 Metallic Gold Curve Divider --}}
        <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none z-20 pointer-events-none">
            <svg class="relative block w-full h-12 sm:h-16 md:h-20" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="studentGoldWave" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#b45309" />
                        <stop offset="25%" stop-color="#f59e0b" />
                        <stop offset="50%" stop-color="#fde047" />
                        <stop offset="75%" stop-color="#f59e0b" />
                        <stop offset="100%" stop-color="#d97706" />
                    </linearGradient>
                </defs>
                <path d="M0,0 C160,85 380,-15 640,40 C890,95 1060,15 1200,50 L1200,120 L0,120 Z" fill="url(#studentGoldWave)"></path>
                <path d="M0,28 C200,85 450,22 700,58 C940,95 1100,32 1200,50 L1200,120 L0,120 Z" fill="#fafbfc"></path>
            </svg>
        </div>
    </section>

    {{-- 🌟 ២. Bento Magazine Showcase (លែងប្រើកាតធម្មតាដូចមុន) --}}
    <main class="mx-auto max-w-7xl px-6 md:px-10 py-12 md:py-20">

        @if($allActivities->isNotEmpty())

            {{-- 🏆 Lead Event Spotlight: Full-width Hero Panorama --}}
            @if($leadActivity)
                @php
                    $rawLeadImages = $leadActivity->gallery_images;
                    $leadGallery = is_array($rawLeadImages) ? $rawLeadImages : (is_string($rawLeadImages) ? json_decode($rawLeadImages, true) ?? [] : []);
                    $leadCount = count($leadGallery);
                @endphp

                <div data-aos="fade-up" class="mb-20">
                    <div class="relative overflow-hidden rounded-[2.5rem] bg-white border border-slate-200/90 shadow-2xl group">
                        
                        {{-- Top Panorama Image with Vignette --}}
                        <div class="relative h-[380px] sm:h-[480px] md:h-[540px] w-full overflow-hidden bg-slate-950">
                            @if($leadActivity->image)
                                <img src="{{ $getMediaUrl($leadActivity->image) }}" alt="{{ $leadActivity->title }}" class="h-full w-full object-cover transition-transform duration-1000 group-hover:scale-105" loading="lazy">
                            @endif

                            {{-- Multi-gradient Overlay --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                            
                            {{-- Top Badges --}}
                            <div class="absolute top-6 left-6 right-6 flex items-center justify-between">
                                <span class="inline-flex items-center gap-2 rounded-full bg-amber-400 text-slate-950 px-4 py-1.5 text-xs font-black uppercase tracking-wider shadow-lg">
                                    ★ Primary Spotlight
                                </span>
                                @if($leadCount > 0)
                                    <span class="inline-flex items-center gap-2 rounded-full bg-black/60 backdrop-blur-md border border-white/20 px-4 py-1.5 text-xs font-bold text-white shadow-lg">
                                        📸 {{ $leadCount }} Full Album Photos
                                    </span>
                                @endif
                            </div>

                            {{-- Bottom Floating Content on Top of the Picture --}}
                            <div class="absolute bottom-0 left-0 right-0 p-8 sm:p-12 text-white">
                                <div class="max-w-4xl">
                                    <span class="text-amber-400 text-xs font-black uppercase tracking-[0.2em]">Featured Campus Experience</span>
                                    <h2 class="text-3xl sm:text-5xl md:text-6xl font-black uppercase tracking-tight mt-2 leading-tight drop-shadow-lg">
                                        {{ $leadActivity->title }}
                                    </h2>
                                    <p class="mt-4 text-sm sm:text-base md:text-lg text-slate-200 line-clamp-2 max-w-2xl font-light leading-relaxed">
                                        {{ $leadActivity->description ?: 'Celebrating student triumphs, creativity, and collective leadership at Life International School.' }}
                                    </p>

                                    <div class="mt-8 flex flex-wrap items-center gap-4">
                                        <a href="{{ url('/student-life/' . $leadActivity->id . '/gallery') }}" class="inline-flex items-center gap-3 bg-gradient-to-r from-amber-400 to-orange-500 hover:from-amber-300 hover:to-orange-400 text-slate-950 font-black text-xs sm:text-sm uppercase tracking-wider px-8 py-4 rounded-2xl shadow-xl hover:-translate-y-1 transition-all duration-300">
                                            <span>Open Photo Exhibition</span>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                        </a>

                                        @if($leadActivity->link)
                                            <a href="{{ $leadActivity->link }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 text-white font-bold text-xs sm:text-sm uppercase tracking-wider px-6 py-4 rounded-2xl transition-all">
                                                <span>External Story</span>
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endif

            {{-- 📸 More Events: Magazine Masonry Cards (រៀបបែបសៀវភៅទស្សនាវដ្តី) --}}
            @if($subActivities->isNotEmpty())
                <div class="mb-10 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 border-b border-slate-200 pb-6">
                    <div>
                        <span class="text-xs font-black uppercase tracking-widest text-orange-500">Student Chronicle</span>
                        <h3 class="text-3xl font-black uppercase text-[#081747] mt-1">Campus Life & Happenings</h3>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">
                        {{ $subActivities->count() }} Additional Programs
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($subActivities as $index => $activity)
                        @php
                            $rawImages = $activity->gallery_images;
                            $images = is_array($rawImages) ? $rawImages : (is_string($rawImages) ? json_decode($rawImages, true) ?? [] : []);
                            $photoCount = count($images);
                        @endphp

                        <article data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}"
                            class="group relative flex flex-col justify-between overflow-hidden rounded-[2.2rem] bg-white border border-slate-200 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                            
                            {{-- Top Image with Floating Stamp --}}
                            <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
                                @if($activity->image)
                                    <img src="{{ $getMediaUrl($activity->image) }}" alt="{{ $activity->title }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110" loading="lazy">
                                @else
                                    <div class="flex h-full w-full items-center justify-center bg-blue-50 text-blue-300 font-black">LIS Event</div>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                                {{-- Modern Photo Count Pill --}}
                                @if($photoCount > 0)
                                    <div class="absolute top-4 right-4 bg-black/60 backdrop-blur-md border border-white/20 text-white text-[11px] font-black px-3 py-1.5 rounded-full flex items-center gap-1.5 shadow-lg">
                                        <svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <span>{{ $photoCount }} Photos</span>
                                    </div>
                                @endif
                            </div>

                            {{-- Content Body --}}
                            <div class="p-7 flex flex-col flex-1 justify-between">
                                <div>
                                    <div class="flex items-center gap-2 text-[11px] font-black uppercase tracking-wider text-orange-500 mb-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>
                                        Student Enrichment
                                    </div>

                                    <h4 class="text-xl font-black text-[#081747] leading-snug group-hover:text-orange-500 transition-colors">
                                        {{ $activity->title }}
                                    </h4>

                                    <p class="mt-3 text-sm text-slate-500 line-clamp-3 leading-relaxed font-normal">
                                        {{ $activity->description ?: 'Explore inspiring student teamwork, creative expression, and active participation.' }}
                                    </p>
                                </div>

                                <div class="mt-8 pt-5 border-t border-slate-100 flex items-center justify-between">
                                    <a href="{{ url('/student-life/' . $activity->id . '/gallery') }}" class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-wider text-[#081747] group-hover:text-orange-500 transition-colors">
                                        <span>Explore Gallery</span>
                                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>

                                    @if($activity->link)
                                        <a href="{{ $activity->link }}" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-blue-600 transition-colors" title="Read more">
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
                <p class="text-sm text-slate-500 mt-2">New campus memories and events will appear here soon.</p>
            </div>
        @endif

    </main>
</div>

@endsection