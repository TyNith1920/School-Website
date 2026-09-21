@extends('layout')

@section('title', 'Student Life - Life International School')

@section('content')

@php
    // 📍 មុខងារទាញយករូបភាពពី Cloudflare R2 (s3) គាំទ្រទាំង String និង Array
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

    {{-- 🌟 1. Dynamic Vibrant Hero ជាមួយ School Spirit & Metallic Gold Wave --}}
    <section class="relative isolate overflow-hidden bg-gradient-to-br from-[#061238] via-[#0b1d54] to-[#122e7a] text-white pt-16 pb-28 md:pt-20 md:pb-36">
        
        {{-- Ambient Floating Glows --}}
        <div class="absolute -top-24 -left-20 h-96 w-96 rounded-full bg-orange-500/20 blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/3 -right-24 h-96 w-96 rounded-full bg-amber-400/15 blur-3xl pointer-events-none"></div>
        <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 28px 28px;"></div>

        <div class="relative z-10 mx-auto max-w-7xl px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                {{-- Left Side: Text Info --}}
                <div class="lg:col-span-7">
                    <div data-aos="fade-down" class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-white/10 border border-white/20 text-amber-300 text-xs font-black uppercase tracking-[0.2em] backdrop-blur-md mb-6 shadow-sm">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-400 animate-ping"></span>
                        Vibrant Campus Life
                    </div>

                    <h1 data-aos="fade-up" data-aos-delay="100" class="text-4xl sm:text-6xl md:text-7xl font-black uppercase tracking-tight leading-[1.05] drop-shadow-2xl">
                        Life <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-orange-300 to-amber-200">at LIS</span>
                    </h1>

                    <div data-aos="zoom-in" data-aos-delay="200" class="mt-4 mb-6 h-1.5 w-24 rounded-full bg-gradient-to-r from-amber-400 to-orange-500 shadow-[0_0_15px_rgba(251,191,36,0.6)]"></div>

                    <p data-aos="fade-up" data-aos-delay="300" class="text-base sm:text-lg md:text-xl text-blue-100/90 max-w-xl font-light leading-relaxed">
                        Where learning expands beyond four walls. Through athletics, creative arts, Christian fellowship, and community service, our students build lifelong memories and character.
                    </p>

                    {{-- Activity Category Badges --}}
                    <div data-aos="fade-up" data-aos-delay="400" class="mt-8 flex flex-wrap items-center gap-3 text-xs font-bold uppercase tracking-wider">
                        <span class="inline-flex items-center gap-2 bg-white/10 border border-white/20 backdrop-blur-md px-4 py-2 rounded-xl text-white">
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span> Sports & Athletics
                        </span>
                        <span class="inline-flex items-center gap-2 bg-white/10 border border-white/20 backdrop-blur-md px-4 py-2 rounded-xl text-white">
                            <span class="w-2 h-2 rounded-full bg-amber-400"></span> Visual Arts & Drama
                        </span>
                        <span class="inline-flex items-center gap-2 bg-white/10 border border-white/20 backdrop-blur-md px-4 py-2 rounded-xl text-white">
                            <span class="w-2 h-2 rounded-full bg-orange-400"></span> Spiritual Growth & Clubs
                        </span>
                    </div>
                </div>

                {{-- Right Side: Dynamic Student Photo Stack --}}
                <div data-aos="zoom-in" data-aos-delay="300" class="lg:col-span-5 flex justify-center relative">
                    <div class="relative w-full max-w-[380px] h-[340px]">
                        {{-- Background Accent Card --}}
                        <div class="absolute inset-0 bg-gradient-to-br from-amber-400 to-orange-500 rounded-[2.5rem] rotate-6 opacity-30 blur-md"></div>
                        
                        {{-- Top Card --}}
                        <div class="absolute inset-0 bg-white/10 backdrop-blur-md rounded-[2.5rem] border border-white/30 p-4 shadow-2xl flex flex-col justify-between overflow-hidden">
                            <div class="relative h-56 w-full rounded-2xl overflow-hidden bg-slate-900">
                                @if($leadActivity && $leadActivity->image)
                                    <img src="{{ $getMediaUrl($leadActivity->image) }}" class="h-full w-full object-cover" alt="Student Moments">
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-white/50 text-sm font-bold">Campus Memories</div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                <span class="absolute bottom-3 left-4 text-xs font-bold text-white bg-black/40 backdrop-blur-sm px-3 py-1 rounded-full border border-white/20">
                                    📸 Daily Highlights
                                </span>
                            </div>

                            <div class="flex items-center justify-between px-2 pt-2 text-white">
                                <div>
                                    <h4 class="font-black text-sm uppercase text-amber-300">Active Campus</h4>
                                    <p class="text-xs text-blue-100 font-light">{{ $allActivities->count() }}+ Activities Documented</p>
                                </div>
                                <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-amber-400 text-slate-950 font-black text-sm shadow-md">
                                    ★
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- 📍 Metallic Gold Wave Transition --}}
        <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none z-20 pointer-events-none">
            <svg class="relative block w-full h-14 sm:h-18 md:h-24" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="studentGoldGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#b45309" />
                        <stop offset="25%" stop-color="#f59e0b" />
                        <stop offset="50%" stop-color="#fde047" />
                        <stop offset="75%" stop-color="#f59e0b" />
                        <stop offset="100%" stop-color="#d97706" />
                    </linearGradient>
                </defs>
                <path d="M0,0 C160,85 380,-15 640,40 C890,95 1060,15 1200,50 L1200,120 L0,120 Z" fill="url(#studentGoldGrad)"></path>
                <path d="M0,28 C200,85 450,22 700,58 C940,95 1100,32 1200,50 L1200,120 L0,120 Z" fill="#f8fafc"></path>
            </svg>
        </div>
    </section>

    {{-- 📍 Main Showcase --}}
    <main class="mx-auto max-w-7xl px-6 md:px-10 py-12 md:py-16">

        @if($allActivities->isNotEmpty())

            {{-- 🌟 2. Featured Spotlight Activity (Bento Editorial Card) --}}
            @if($leadActivity)
                @php
                    $rawLeadImages = $leadActivity->gallery_images;
                    $leadGallery = is_array($rawLeadImages) ? $rawLeadImages : (is_string($rawLeadImages) ? json_decode($rawLeadImages, true) ?? [] : []);
                    $leadPhotoCount = count($leadGallery);
                @endphp

                <div data-aos="fade-up" class="mb-16">
                    <div class="group relative overflow-hidden rounded-[2.5rem] bg-white border border-slate-200/90 shadow-[0_20px_50px_rgba(15,23,42,0.06)] hover:shadow-[0_25px_60px_rgba(245,158,11,0.12)] transition-all duration-500">
                        <div class="grid grid-cols-1 lg:grid-cols-12 items-stretch">
                            
                            {{-- Image Cover --}}
                            <div class="relative lg:col-span-7 aspect-[16/10] lg:aspect-auto min-h-[360px] md:min-h-[440px] overflow-hidden bg-slate-950">
                                @if($leadActivity->image)
                                    <img src="{{ $getMediaUrl($leadActivity->image) }}" alt="{{ $leadActivity->title }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-transparent to-transparent pointer-events-none"></div>

                                {{-- Floating Badges --}}
                                <div class="absolute top-6 left-6 inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-amber-500 to-orange-500 px-4 py-1.5 text-xs font-black uppercase tracking-wider text-white shadow-lg">
                                    ★ Highlighted Event
                                </div>

                                @if($leadPhotoCount > 0)
                                    <div class="absolute bottom-6 left-6 inline-flex items-center gap-2 rounded-full bg-black/60 backdrop-blur-md border border-white/20 px-4 py-2 text-xs font-bold text-white shadow-xl">
                                        <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ $leadPhotoCount }} Album Photos
                                    </div>
                                @endif
                            </div>

                            {{-- Content Side --}}
                            <div class="lg:col-span-5 p-8 sm:p-10 lg:p-12 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center gap-2 text-xs font-black uppercase tracking-wider text-amber-600 mb-3">
                                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-ping"></span>
                                        Campus Life Spotlight
                                    </div>

                                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#081747] leading-tight group-hover:text-amber-600 transition-colors">
                                        {{ $leadActivity->title }}
                                    </h2>

                                    <p class="mt-4 text-sm sm:text-base leading-relaxed text-slate-600 line-clamp-4 font-normal">
                                        {{ $leadActivity->description ?: 'Experience the rich community moments, student dedication, and collaborative spirit from this campus milestone.' }}
                                    </p>
                                </div>

                                <div class="mt-8 pt-6 border-t border-slate-100 flex flex-wrap items-center gap-4">
                                    <a href="{{ url('/student-life/' . $leadActivity->id . '/gallery') }}" class="inline-flex items-center gap-3 bg-[#081747] hover:bg-gradient-to-r hover:from-amber-500 hover:to-orange-500 text-white text-xs sm:text-sm font-black uppercase tracking-wider px-6 py-3.5 rounded-xl shadow-md hover:-translate-y-0.5 transition-all duration-300">
                                        <span>View Photo Gallery</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>

                                    @if($leadActivity->link)
                                        <a href="{{ $leadActivity->link }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-slate-500 hover:text-amber-600 transition-colors">
                                            <span>Learn more</span>
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        </a>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif

            {{-- 🌟 3. Activities Bento Grid Cards --}}
            @if($subActivities->isNotEmpty())
                <div class="mb-10 flex items-center justify-between">
                    <div>
                        <span class="text-xs font-black uppercase tracking-widest text-amber-600">Explore Memories</span>
                        <h3 class="text-2xl sm:text-3xl font-black uppercase text-[#081747] mt-1">Activities & Student Programs</h3>
                    </div>
                    <span class="hidden sm:inline-block text-xs font-bold uppercase tracking-wider text-slate-400 bg-white border border-slate-200 px-3.5 py-1.5 rounded-full shadow-xs">
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
                            class="group flex flex-col overflow-hidden rounded-[2rem] bg-white border border-slate-200/90 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300">
                            
                            {{-- Cover Image --}}
                            <div class="relative aspect-[16/10] overflow-hidden bg-slate-100">
                                @if($activity->image)
                                    <img src="{{ $getMediaUrl($activity->image) }}" alt="{{ $activity->title }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                                @else
                                    <div class="flex h-full w-full items-center justify-center bg-blue-50 text-blue-300 font-bold text-sm">LIS Activity</div>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>

                                {{-- Photo Badge --}}
                                @if($photoCount > 0)
                                    <div class="absolute top-4 right-4 inline-flex items-center gap-1.5 rounded-full bg-white/95 backdrop-blur-sm px-3 py-1 text-xs font-bold text-[#081747] shadow-md border border-white/50">
                                        <svg class="w-3.5 h-3.5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ $photoCount }}
                                    </div>
                                @endif
                            </div>

                            {{-- Body --}}
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
            {{-- Empty State --}}
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