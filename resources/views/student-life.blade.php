@extends('layout')

@section('title', 'Student Life - Life International School')

@section('content')

@php
    // 📍 មុខងារទាញយករូបភាពពី Cloudflare R2 (s3)
    $getMediaUrl = function($path) {
        if (empty($path)) return null;
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

<div class="min-h-screen bg-[#fcfdfd] text-slate-800">

    {{-- 🎨 Creative Student Life Hero (Vibrant & Expressive) --}}
    <section class="relative overflow-hidden bg-gradient-to-b from-blue-50/60 via-slate-50 to-[#fcfdfd] pt-16 pb-14 border-b border-slate-200/70">
        
        {{-- Floating colorful blobs --}}
        <div class="absolute -top-20 -left-20 w-80 h-80 rounded-full bg-orange-400/10 blur-3xl pointer-events-none"></div>
        <div class="absolute top-10 right-10 w-96 h-96 rounded-full bg-blue-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-10 left-1/3 w-72 h-72 rounded-full bg-amber-300/15 blur-2xl pointer-events-none"></div>

        <div class="relative z-10 mx-auto max-w-7xl px-6 md:px-10">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-10">
                
                {{-- Text Content --}}
                <div class="max-w-2xl">
                    <div data-aos="fade-down" class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border border-slate-200/80 text-orange-600 text-xs font-black uppercase tracking-widest shadow-sm mb-5">
                        <span class="w-2 h-2 rounded-full bg-orange-500 animate-ping"></span>
                        Beyond the Classroom
                    </div>

                    <h1 data-aos="fade-up" data-aos-delay="100" class="text-4xl sm:text-5xl md:text-6xl font-black text-[#081747] uppercase tracking-tight leading-[1.08]">
                        Life <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-amber-500">at LIS</span>
                    </h1>

                    <p data-aos="fade-up" data-aos-delay="200" class="mt-5 text-base sm:text-lg text-slate-600 leading-relaxed font-normal">
                        Nurturing not just academic rigor, but creativity, character, and lifelong friendships through our rich array of clubs, cultural days, sports, and leadership experiences.
                    </p>

                    <div data-aos="fade-up" data-aos-delay="300" class="mt-8 flex flex-wrap items-center gap-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                        <div class="flex items-center gap-2 bg-white px-4 py-2 rounded-xl border border-slate-200 shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Active Clubs & Sports
                        </div>
                        <div class="flex items-center gap-2 bg-white px-4 py-2 rounded-xl border border-slate-200 shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                            Community Service
                        </div>
                        <div class="flex items-center gap-2 bg-white px-4 py-2 rounded-xl border border-slate-200 shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            Leadership & Arts
                        </div>
                    </div>
                </div>

                {{-- Visual Polaroid Stacks --}}
                <div data-aos="zoom-in" data-aos-delay="250" class="hidden lg:flex items-center justify-center relative w-[420px] h-[280px]">
                    @if($leadActivity && $leadActivity->image)
                        <div class="absolute transform -rotate-6 hover:rotate-0 transition-transform duration-500 rounded-2xl bg-white p-3 shadow-xl border border-slate-200 w-64">
                            <img src="{{ $getMediaUrl($leadActivity->image) }}" class="rounded-xl h-36 w-full object-cover" alt="Student Life Moments">
                            <p class="mt-2.5 text-center text-xs font-bold text-slate-700 truncate">{{ $leadActivity->title }}</p>
                        </div>
                    @endif
                    <div class="absolute transform rotate-6 translate-x-12 translate-y-6 hover:rotate-0 transition-transform duration-500 rounded-2xl bg-white p-3 shadow-xl border border-slate-200 w-60">
                        <div class="h-36 w-full bg-gradient-to-br from-orange-400 to-amber-500 rounded-xl flex items-center justify-center text-white text-3xl font-black">
                            {{ $allActivities->count() }}+
                        </div>
                        <p class="mt-2.5 text-center text-xs font-bold text-slate-700">Exciting Activities</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Main Activities Showcase --}}
    <main class="mx-auto max-w-7xl px-6 md:px-10 py-16">

        @if($allActivities->isNotEmpty())

            {{-- 🌟 1. Primary Highlight Activity (Bento Lead Card) --}}
            @if($leadActivity)
                @php
                    $rawLeadImages = $leadActivity->gallery_images;
                    $leadGallery = is_array($rawLeadImages) ? $rawLeadImages : (is_string($rawLeadImages) ? json_decode($rawLeadImages, true) ?? [] : []);
                    $leadPhotoCount = count($leadGallery);
                @endphp

                <div data-aos="fade-up" class="mb-14">
                    <div class="group relative overflow-hidden rounded-[2.5rem] bg-white border border-slate-200 shadow-[0_15px_45px_rgba(15,23,42,0.06)] hover:shadow-[0_25px_60px_rgba(234,88,12,0.12)] transition-all duration-500">
                        <div class="grid grid-cols-1 lg:grid-cols-12 items-stretch">
                            
                            {{-- Image Cover --}}
                            <div class="relative lg:col-span-7 aspect-[16/10] lg:aspect-auto min-h-[350px] overflow-hidden bg-slate-100">
                                @if($leadActivity->image)
                                    <img src="{{ $getMediaUrl($leadActivity->image) }}" alt="{{ $leadActivity->title }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>

                                {{-- Floating Pill --}}
                                <div class="absolute top-6 left-6 inline-flex items-center gap-2 rounded-full bg-orange-500/95 backdrop-blur-md px-4 py-1.5 text-xs font-black uppercase tracking-wider text-white shadow-lg">
                                    ★ Featured Program
                                </div>

                                @if($leadPhotoCount > 0)
                                    <div class="absolute bottom-6 left-6 inline-flex items-center gap-2 rounded-full bg-white/95 backdrop-blur-md px-4 py-2 text-xs font-bold text-[#081747] shadow-xl">
                                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16l4-4a2 2 0 012.8 0l2.2 2.2 2-2a2 2 0 012.8 0L21 15.4M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ $leadPhotoCount }} Gallery Photos
                                    </div>
                                @endif
                            </div>

                            {{-- Content Side --}}
                            <div class="lg:col-span-5 p-8 sm:p-10 lg:p-12 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-orange-600 mb-3">
                                        <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                                        Campus Spotlight
                                    </div>

                                    <h2 class="text-2xl sm:text-3xl font-black text-[#081747] leading-tight group-hover:text-orange-500 transition-colors">
                                        {{ $leadActivity->title }}
                                    </h2>

                                    <p class="mt-4 text-sm sm:text-base leading-relaxed text-slate-600 line-clamp-4">
                                        {{ $leadActivity->description ?: 'Explore inspiring moments, interactive sessions, and collaborative work from this core campus event.' }}
                                    </p>
                                </div>

                                <div class="mt-8 pt-6 border-t border-slate-100 flex flex-wrap items-center gap-4">
                                    <a href="{{ url('/student-life/' . $leadActivity->id . '/gallery') }}" class="inline-flex items-center gap-3 bg-[#081747] hover:bg-orange-500 text-white text-sm font-bold uppercase tracking-wider px-6 py-3.5 rounded-xl shadow-md hover:-translate-y-0.5 transition-all">
                                        <span>View Photo Gallery</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>

                                    @if($leadActivity->link)
                                        <a href="{{ $leadActivity->link }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-orange-500 transition-colors">
                                            <span>Learn more</span>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        </a>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif

            {{-- 📸 2. Activity Grid Cards --}}
            @if($subActivities->isNotEmpty())
                <div class="mb-10 flex items-center justify-between">
                    <div>
                        <span class="text-xs font-black uppercase tracking-widest text-orange-500">More Happenings</span>
                        <h3 class="text-2xl font-black uppercase text-[#081747] mt-1">Activities & Community Programs</h3>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">{{ $subActivities->count() }} Programs</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($subActivities as $index => $activity)
                        @php
                            $rawImages = $activity->gallery_images;
                            $images = is_array($rawImages) ? $rawImages : (is_string($rawImages) ? json_decode($rawImages, true) ?? [] : []);
                            $photoCount = count($images);
                        @endphp

                        <article data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}"
                            class="group flex flex-col overflow-hidden rounded-[2rem] bg-white border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300">
                            
                            {{-- Cover Image --}}
                            <div class="relative aspect-[16/10] overflow-hidden bg-slate-100">
                                @if($activity->image)
                                    <img src="{{ $getMediaUrl($activity->image) }}" alt="{{ $activity->title }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                                @else
                                    <div class="flex h-full w-full items-center justify-center bg-blue-50 text-blue-300 font-bold">LIS Activity</div>
                                @endif

                                {{-- Photo Badge --}}
                                @if($photoCount > 0)
                                    <div class="absolute top-4 right-4 inline-flex items-center gap-1.5 rounded-full bg-white/95 backdrop-blur-sm px-3 py-1.5 text-xs font-bold text-[#081747] shadow-md border border-white/50">
                                        <svg class="w-3.5 h-3.5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ $photoCount }}
                                    </div>
                                @endif
                            </div>

                            {{-- Body --}}
                            <div class="flex flex-1 flex-col p-6 sm:p-7 justify-between">
                                <div>
                                    <span class="text-[11px] font-bold uppercase tracking-wider text-orange-600">Student Activity</span>
                                    <h4 class="mt-2 text-lg sm:text-xl font-black text-[#081747] line-clamp-2 leading-snug group-hover:text-orange-500 transition-colors">
                                        {{ $activity->title }}
                                    </h4>
                                    <p class="mt-3 text-sm text-slate-500 line-clamp-3 leading-relaxed">
                                        {{ $activity->description ?: 'Discover more about our student enrichment programs and club activities.' }}
                                    </p>
                                </div>

                                <div class="mt-6 pt-5 border-t border-slate-100 flex items-center justify-between">
                                    <a href="{{ url('/student-life/' . $activity->id . '/gallery') }}" class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-wider text-[#081747] group-hover:text-orange-500 transition-colors">
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
                <div class="mx-auto w-16 h-16 rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-2xl font-black text-[#081747]">No student activities added yet</h3>
                <p class="text-sm text-slate-500 mt-2">New student life events and gallery photos will appear here soon.</p>
            </div>
        @endif

    </main>
</div>

@endsection