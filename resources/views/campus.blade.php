@extends('layout')

@section('title', 'Campus Tour & Facilities - Life International School')

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

    $campusPhoneLink = preg_replace(
        '/[^0-9+]/',
        '',
        $campusPhone
    );
@endphp

<div class="w-full min-h-screen bg-[#fcfdfd] text-slate-800">

    {{-- 🌟 1. Cinematic Hero Banner with Gold Gradient Wave --}}
    <section class="relative isolate overflow-hidden bg-gradient-to-br from-[#061238] via-[#0d276b] to-[#173c9c] text-white pt-14 pb-28 md:pb-36">
        
        {{-- Subtle Grid & Ambient Lighting --}}
        <div class="absolute inset-0 opacity-15 pointer-events-none" 
             style="background-image: radial-gradient(circle, rgba(255,255,255,0.85) 1px, transparent 1px); background-size: 26px 26px;"></div>
        <div class="absolute -top-24 -left-20 h-96 w-96 rounded-full bg-cyan-400/20 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 right-0 h-96 w-96 rounded-full bg-orange-500/20 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 mx-auto max-w-7xl px-6 md:px-10 text-center">
            
            {{-- Breadcrumb --}}
            <nav data-aos="fade-down" class="inline-flex items-center gap-2 text-xs md:text-sm text-blue-200 font-bold uppercase tracking-wider mb-6 bg-white/10 px-4 py-1.5 rounded-full border border-white/15 backdrop-blur-md">
                <a href="{{ url('/') }}" class="hover:text-amber-300 transition-colors">Home</a>
                <span class="text-blue-300">•</span>
                <span class="text-amber-400">Campus Experience</span>
            </nav>

            <h1 data-aos="fade-up" data-aos-delay="100" class="text-4xl sm:text-6xl md:text-7xl font-black uppercase tracking-tight text-white leading-tight drop-shadow-2xl">
                Explore <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-orange-300 to-amber-400">Our Campus</span>
            </h1>

            <div data-aos="zoom-in" data-aos-delay="200" class="mx-auto mt-5 mb-6 h-1.5 w-24 rounded-full bg-gradient-to-r from-amber-400 to-orange-500 shadow-[0_0_15px_rgba(251,191,36,0.6)]"></div>

            <p data-aos="fade-up" data-aos-delay="300" class="mx-auto max-w-3xl text-base sm:text-lg md:text-xl text-blue-100/90 leading-relaxed font-light">
                {{ $campusDescription }}
            </p>

            {{-- Campus Feature Highlights Badges --}}
            <div data-aos="fade-up" data-aos-delay="400" class="mt-8 flex flex-wrap items-center justify-center gap-3 text-xs md:text-sm">
                <div class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-4 py-2 border border-white/15 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span>Modern Smart Classrooms</span>
                </div>
                <div class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-4 py-2 border border-white/15 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                    <span>Science & STEM Lab</span>
                </div>
                <div class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-4 py-2 border border-white/15 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                    <span>Multi-Sport Arenas</span>
                </div>
            </div>

        </div>

        {{-- 📍 Dual-Layer Rich Metallic Gold Wave Transition --}}
        <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none z-20 pointer-events-none">
            <svg class="relative block w-full h-16 sm:h-20 md:h-28" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="campusGoldGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#b45309" />
                        <stop offset="25%" stop-color="#f59e0b" />
                        <stop offset="50%" stop-color="#fde047" />
                        <stop offset="75%" stop-color="#f59e0b" />
                        <stop offset="100%" stop-color="#d97706" />
                    </linearGradient>
                </defs>

                {{-- ស្រទាប់ទី ១: រលកពណ៌មាស --}}
                <path d="M0,0 C160,85 380,-15 640,40 C890,95 1060,15 1200,50 L1200,120 L0,120 Z" fill="url(#campusGoldGradient)"></path>
                {{-- ស្រទាប់ទី ២: រលកពណ៌ផ្ទៃខាងក្រោម (#fcfdfd) --}}
                <path d="M0,28 C200,85 450,22 700,58 C940,95 1100,32 1200,50 L1200,120 L0,120 Z" fill="#fcfdfd"></path>
            </svg>
        </div>
    </section>

    {{-- 🎬 2. Interactive Virtual Tour Video Studio Showcase (អណ្តែតជាប់ Banner ខាងលើ) --}}
    <section class="relative -mt-16 md:-mt-24 z-20 mx-auto max-w-6xl px-6">
        <div data-aos="zoom-in" data-aos-duration="1000" class="overflow-hidden rounded-[2.5rem] bg-white border border-slate-200 shadow-[0_25px_60px_rgba(15,23,42,0.14)] p-3 md:p-4">
            
            {{-- Header of the Video Player Frame --}}
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 px-4 md:px-6 py-3 mb-2 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <span class="flex h-3 w-3 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                    </span>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-wider text-orange-600 leading-none">Virtual Campus Tour</p>
                        <h3 class="text-base sm:text-lg font-black text-[#081747] mt-0.5">Life International School Tour Experience</h3>
                    </div>
                </div>

                <div class="inline-flex items-center gap-2 rounded-full bg-orange-50 px-3.5 py-1 text-xs font-bold text-orange-600 border border-orange-200 w-fit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    <span>High Definition</span>
                </div>
            </div>

            {{-- Video Embed Container --}}
            <div class="relative aspect-video w-full overflow-hidden rounded-[2rem] bg-slate-900 shadow-inner">
                @if(filled($campus?->video_url))
                    <div class="campus-embed w-full h-full">
                        {!! $campus->video_url !!}
                    </div>
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-center px-6">
                        <div class="w-16 h-16 rounded-full bg-white/10 text-white flex items-center justify-center mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.868v4.264a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <p class="text-white font-bold text-lg">Campus tour video will be published soon</p>
                    </div>
                @endif
            </div>

        </div>
    </section>

    {{-- 🏫 3. Information & Interactive Map Section --}}
    <main class="max-w-6xl mx-auto px-6 py-20">
        
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-xs font-black uppercase tracking-widest text-orange-500">Visit Us in Person</span>
            <h2 class="text-3xl sm:text-4xl font-black text-[#081747] uppercase tracking-tight mt-1">Campus Location & Details</h2>
            <p class="mt-3 text-slate-500 text-sm sm:text-base leading-relaxed">
                Come explore our modern classrooms, sports grounds, and green spaces. Our admissions office is open Monday through Friday.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
            
            {{-- Contact Information Card --}}
            <div data-aos="fade-right" class="lg:col-span-5 bg-white p-8 md:p-10 rounded-[2.5rem] border border-slate-200/80 shadow-[0_15px_45px_rgba(15,23,42,0.06)] flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>

                    <span class="text-xs font-black uppercase tracking-wider text-orange-500">Sihanoukville Campus</span>
                    <h3 class="text-2xl font-black text-[#081747] mt-1 mb-6">Life International School</h3>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Address</p>
                                <p class="text-sm font-bold text-slate-700 mt-0.5">Preah Sihanouk, Cambodia</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Admissions Hotline</p>
                                <a href="tel:{{ $campusPhoneLink }}" class="text-sm font-black text-slate-800 hover:text-orange-500 transition-colors mt-0.5 block">
                                    {{ $campusPhone }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100 flex flex-col gap-3">
                    <a href="{{ url('/contact-us') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#081747] hover:bg-orange-500 text-white font-bold text-xs uppercase tracking-wider py-3.5 px-6 shadow-md hover:-translate-y-0.5 transition-all">
                        <span>Schedule a Campus Tour</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

            {{-- Interactive Google Map Card --}}
            <div data-aos="fade-left" class="lg:col-span-7 bg-white p-3 rounded-[2.5rem] border border-slate-200/80 shadow-[0_15px_45px_rgba(15,23,42,0.06)] min-h-[420px] flex flex-col">
                <div class="relative w-full h-full min-h-[400px] overflow-hidden rounded-[2rem] bg-slate-100 flex-1">
                    @if(filled($campus?->map_embed_url))
                        <div class="campus-embed w-full h-full absolute inset-0">
                            {!! $campus->map_embed_url !!}
                        </div>
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-center p-6">
                            <p class="text-slate-400 font-bold">Map will be available soon.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>

    </main>

</div>

@endsection