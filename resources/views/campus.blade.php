@extends('layout')

@section('title', 'Campus Experience - Life International School')

@section('content')

<style>
    .campus-embed iframe {
        width: 100% !important;
        height: 100% !important;
        border: 0 !important;
        display: block !important;
    }
</style>

@php
    $campusTitle = $campus?->title ?: 'LIS Campus Tour';
    $campusDescription = $campus?->description
        ?: 'Discover our purpose-built learning spaces, world-class sports facilities, and welcoming Christian community in Sihanoukville.';
    $campusPhone = $campus?->phone ?: '+855 78 517 754';
    $campusPhoneLink = preg_replace('/[^0-9+]/', '', $campusPhone);
@endphp

<div class="w-full min-h-screen bg-[#060c1d] text-slate-100 selection:bg-orange-500 selection:text-white">

    {{-- 🎬 1. Cinema Theatre Lounge (លុបចោល Banner ខៀវចាស់ ដូរមកជា Theatre Mode ពេញភ្នែក) --}}
    <section class="relative pt-12 pb-20 md:py-20 overflow-hidden">
        
        {{-- Ambient Stage Glow --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[90vw] md:w-[1000px] h-[450px] bg-gradient-to-b from-blue-600/20 via-orange-500/10 to-transparent blur-[120px] pointer-events-none"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 md:px-10">
            
            {{-- Top Controls & Title Bar --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
                <div class="max-w-2xl">
                    <div data-aos="fade-down" class="inline-flex items-center gap-2 rounded-full border border-amber-400/30 bg-amber-400/10 px-4 py-1 text-xs font-black uppercase tracking-[0.2em] text-amber-300 backdrop-blur-md mb-4">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                        Virtual Campus Experience
                    </div>
                    <h1 data-aos="fade-up" data-aos-delay="100" class="text-3xl sm:text-5xl lg:text-6xl font-black uppercase tracking-tight text-white leading-none">
                        Inside <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-orange-400 to-amber-200">Our Campus</span>
                    </h1>
                    <p data-aos="fade-up" data-aos-delay="200" class="mt-4 text-sm sm:text-base text-slate-400 leading-relaxed max-w-xl">
                        {{ $campusDescription }}
                    </p>
                </div>

                {{-- Campus Key Stats Pills --}}
                <div data-aos="fade-left" data-aos-delay="200" class="flex flex-wrap gap-3">
                    <div class="px-5 py-3 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md">
                        <span class="block text-xs font-bold uppercase text-slate-400">Campus Status</span>
                        <span class="text-sm font-black text-emerald-400">Open for Tours</span>
                    </div>
                    <div class="px-5 py-3 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md">
                        <span class="block text-xs font-bold uppercase text-slate-400">Environment</span>
                        <span class="text-sm font-black text-amber-300">Christ-Centered</span>
                    </div>
                </div>
            </div>

            {{-- 📺 Cinema Screen Player Frame --}}
            <div data-aos="zoom-in" data-aos-duration="1000" class="relative rounded-[2.5rem] bg-gradient-to-b from-white/15 via-white/5 to-white/0 p-2 sm:p-3 md:p-4 shadow-[0_0_80px_rgba(30,58,138,0.25)] border border-white/15 backdrop-blur-xl">
                
                {{-- Screen Top Bar --}}
                <div class="flex items-center justify-between px-4 py-2.5 bg-slate-950/60 rounded-t-[2rem] border-b border-white/10">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-red-500/80"></span>
                        <span class="w-3 h-3 rounded-full bg-yellow-500/80"></span>
                        <span class="w-3 h-3 rounded-full bg-emerald-500/80"></span>
                        <span class="text-xs font-mono text-slate-400 ml-2 hidden sm:inline">LIS_CAMPUS_PREVIEW.MP4</span>
                    </div>
                    <div class="flex items-center gap-2 text-xs font-bold text-orange-400 uppercase tracking-widest">
                        <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                        HD 1080P TOUR
                    </div>
                </div>

                {{-- Actual Video Embed --}}
                <div class="relative aspect-video w-full overflow-hidden rounded-b-[2rem] bg-black shadow-inner">
                    @if(filled($campus?->video_url))
                        <div class="campus-embed w-full h-full">
                            {!! $campus->video_url !!}
                        </div>
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-center px-6">
                            <div class="w-16 h-16 rounded-full bg-white/10 text-white flex items-center justify-center mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.868v4.264a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <p class="text-white font-bold text-lg">Campus tour video is loading soon</p>
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </section>

    {{-- 🏫 2. Bento Grid: Campus Facilities & Highlights --}}
    <section class="relative bg-white text-slate-800 py-20 px-6 md:px-10 rounded-t-[3rem] -mt-8 z-20">
        <div class="max-w-7xl mx-auto">
            
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs font-black uppercase tracking-widest text-orange-500">World-Class Environment</span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-[#081747] uppercase tracking-tight mt-1">Designed For Excellence</h2>
                <p class="mt-3 text-slate-500 text-sm sm:text-base leading-relaxed">
                    Every corner of Life International School is purposefully built to nurture creativity, focus, and holistic student growth.
                </p>
            </div>

            {{-- 3-Column Modern Bento Features --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                {{-- Feature 1 --}}
                <div data-aos="fade-up" data-aos-delay="100" class="p-8 rounded-[2.5rem] bg-[#f8fafc] border border-slate-200/80 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center mb-6">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <h3 class="text-2xl font-black text-[#081747]">Interactive Classrooms</h3>
                        <p class="mt-3 text-slate-500 text-sm leading-relaxed">Equipped with air-conditioned spaces, digital interactive displays, and collaborative seating for modern learning.</p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-200/60 flex items-center gap-2 text-xs font-bold text-orange-600">
                        <span>Smart Audio-Visuals</span>
                    </div>
                </div>

                {{-- Feature 2 --}}
                <div data-aos="fade-up" data-aos-delay="200" class="p-8 rounded-[2.5rem] bg-[#f8fafc] border border-slate-200/80 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center mb-6">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h3 class="text-2xl font-black text-[#081747]">Athletics & Playgrounds</h3>
                        <p class="mt-3 text-slate-500 text-sm leading-relaxed">Dedicated sports courts and shaded outdoor play areas designed for physical development and teamwork.</p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-200/60 flex items-center gap-2 text-xs font-bold text-orange-600">
                        <span>Safe & Monitored Grounds</span>
                    </div>
                </div>

                {{-- Feature 3 --}}
                <div data-aos="fade-up" data-aos-delay="300" class="p-8 rounded-[2.5rem] bg-[#f8fafc] border border-slate-200/80 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center mb-6">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <h3 class="text-2xl font-black text-[#081747]">Safety & Security</h3>
                        <p class="mt-3 text-slate-500 text-sm leading-relaxed">24/7 guarded security, CCTV monitoring, and child safeguarding protocols ensuring a safe environment for all.</p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-200/60 flex items-center gap-2 text-xs font-bold text-emerald-600">
                        <span>ACSI Standard Safety</span>
                    </div>
                </div>

            </div>

            {{-- 🗺️ 3. Integrated Location & Direction Cockpit --}}
            <div class="mt-16 rounded-[2.5rem] bg-[#0b1240] text-white p-6 md:p-10 shadow-2xl relative overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                    
                    {{-- Left Details --}}
                    <div class="lg:col-span-5 flex flex-col justify-between h-full">
                        <div>
                            <span class="text-xs font-black uppercase tracking-widest text-amber-400">Campus Location</span>
                            <h3 class="text-2xl sm:text-3xl font-black text-white mt-1 mb-4">Plan Your In-Person Visit</h3>
                            <p class="text-slate-300 text-sm leading-relaxed mb-8">
                                Experience our welcoming Christian campus firsthand. Book a guided family tour or drop by our admissions desk.
                            </p>

                            <div class="space-y-4">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-white/10 text-orange-400 flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Address</p>
                                        <p class="text-sm font-bold text-white mt-0.5">Group 10, Mondol 3, Sangkat 2, Preah Sihanouk, Cambodia</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-white/10 text-emerald-400 flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Admissions Phone</p>
                                        <a href="tel:{{ $campusPhoneLink }}" class="text-sm font-black text-amber-300 hover:underline mt-0.5 block">
                                            {{ $campusPhone }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-white/10 flex flex-wrap gap-4">
                            <a href="{{ url('/contact-us') }}" class="inline-flex items-center gap-2 rounded-xl bg-orange-500 hover:bg-orange-600 px-6 py-3.5 text-xs font-bold uppercase tracking-wider text-white shadow-lg transition-all">
                                <span>Contact Us</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>

                    {{-- Right Interactive Map --}}
                    <div class="lg:col-span-7 h-[360px] md:h-[420px] rounded-[2rem] overflow-hidden border border-white/15 bg-slate-900 shadow-inner">
                        @if(filled($campus?->map_embed_url))
                            <div class="campus-embed w-full h-full">
                                {!! $campus->map_embed_url !!}
                            </div>
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-500 text-sm">
                                Interactive Map Coming Soon
                            </div>
                        @endif
                    </div>

                </div>
            </div>

        </div>
    </section>

</div>

@endsection