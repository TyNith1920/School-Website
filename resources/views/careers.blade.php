@extends('layout')

@section('title', 'Careers - Life International School')

@section('content')

@php
    // 📍 មុខងារទាញយករូបភាព និង File ពី Cloudflare R2 (s3)
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

<div class="min-h-screen bg-[#fcfdfd] text-slate-800">

    {{-- 🌟 1. Purpose-Driven Careers Hero --}}
    <section class="relative overflow-hidden bg-gradient-to-b from-[#061238] via-[#0b1b4f] to-[#081747] text-white pt-20 pb-28 md:pb-36">
        
        {{-- Subtle Grid & Ambient Lighting --}}
        <div class="absolute inset-0 opacity-15 pointer-events-none" 
             style="background-image: radial-gradient(circle, rgba(255,255,255,0.85) 1px, transparent 1px); background-size: 26px 26px;"></div>
        <div class="absolute -top-24 -left-20 h-96 w-96 rounded-full bg-orange-500/20 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-20 right-0 h-96 w-96 rounded-full bg-blue-400/20 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 mx-auto max-w-5xl px-6 text-center">
            
            <div data-aos="fade-down" class="mb-5 inline-flex items-center gap-2 rounded-full border border-amber-300/30 bg-amber-400/10 px-5 py-1.5 text-xs md:text-sm font-bold uppercase tracking-[0.2em] text-amber-300 backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                Work With Purpose
            </div>

            <h1 data-aos="fade-up" data-aos-delay="100" class="text-4xl sm:text-6xl md:text-7xl font-black uppercase tracking-tight text-white leading-tight">
                Shape the Future <br class="hidden sm:inline">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-orange-300 to-amber-400">At Life International School</span>
            </h1>

            <p data-aos="fade-up" data-aos-delay="200" class="mx-auto mt-6 max-w-2xl text-base sm:text-lg text-blue-100/90 leading-relaxed font-light">
                Join our dedicated team of international educators, mentors, and professionals shaping young minds with Christian values and academic excellence.
            </p>

            {{-- Value Pillars Badges --}}
            <div data-aos="fade-up" data-aos-delay="300" class="mt-8 flex flex-wrap items-center justify-center gap-3 text-xs md:text-sm">
                <div class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-4 py-2 border border-white/15 backdrop-blur-sm">
                    <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    <span>Christ-Centered Community</span>
                </div>
                <div class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-4 py-2 border border-white/15 backdrop-blur-sm">
                    <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    <span>Professional Growth</span>
                </div>
                <div class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-4 py-2 border border-white/15 backdrop-blur-sm">
                    <svg class="w-4 h-4 text-cyan-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    <span>Supportive & Caring Team</span>
                </div>
            </div>

        </div>

        {{-- Smooth Bottom Wave Transition with Metallic Gold Ribbon --}}
        <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none z-20 pointer-events-none">
            <svg class="relative block w-full h-14 sm:h-18 md:h-24" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0 C160,85 380,-15 640,40 C890,95 1060,15 1200,50 L1200,120 L0,120 Z" fill="rgba(251, 191, 36, 0.3)"></path>
                <path d="M0,28 C200,85 450,22 700,58 C940,95 1100,32 1200,50 L1200,120 L0,120 Z" fill="#fcfdfd"></path>
            </svg>
        </div>
    </section>

    {{-- 📸 2. Team Culture & Banner Showcase --}}
    <section class="relative -mt-16 md:-mt-24 z-20 mx-auto max-w-6xl px-6">
        <div data-aos="zoom-in" class="overflow-hidden rounded-[2.5rem] bg-white border border-slate-200/80 shadow-[0_25px_60px_rgba(15,23,42,0.14)] p-3 md:p-4">
            <div class="relative aspect-[16/9] md:aspect-[21/9] w-full overflow-hidden rounded-[2rem] bg-slate-100">
                @if(isset($banner) && $banner->image)
                    <img src="{{ $getMediaUrl($banner->image) }}" alt="Life International School Team" class="h-full w-full object-cover">
                @else
                    <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?q=80&w=2070&auto=format&fit=crop" alt="Life International School Team" class="h-full w-full object-cover">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-[#081747]/80 via-transparent to-transparent"></div>
                
                <div class="absolute bottom-6 left-6 right-6 md:bottom-8 md:left-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
                    <div class="text-white">
                        <span class="text-xs font-black uppercase tracking-widest text-amber-400">Our Community</span>
                        <h3 class="text-xl md:text-3xl font-black">Dedicated to Every Student's Journey</h3>
                    </div>
                    <a href="mailto:careers@life.edu.kh" class="inline-flex items-center gap-2 rounded-xl bg-orange-500 hover:bg-orange-600 px-5 py-2.5 text-xs md:text-sm font-bold uppercase tracking-wider text-white shadow-lg transition-all w-fit">
                        <span>Send Your CV</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- 📋 3. 3-Step Simple Application Roadmap --}}
    <section class="mx-auto max-w-6xl px-6 pt-20 pb-12">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-xs font-black uppercase tracking-widest text-orange-500">How to Apply</span>
            <h2 class="text-3xl font-black text-[#081747] uppercase tracking-tight mt-1">Simple 3-Step Process</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div data-aos="fade-up" data-aos-delay="100" class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-sm relative">
                <span class="w-8 h-8 rounded-full bg-orange-100 text-orange-600 font-black flex items-center justify-center text-sm mb-4">1</span>
                <h4 class="font-black text-[#081747] text-lg">Choose Your Role</h4>
                <p class="mt-2 text-sm text-slate-500 leading-relaxed">Review our current openings below and select the position matching your passion and qualifications.</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="200" class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-sm relative">
                <span class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 font-black flex items-center justify-center text-sm mb-4">2</span>
                <h4 class="font-black text-[#081747] text-lg">Download Application</h4>
                <p class="mt-2 text-sm text-slate-500 leading-relaxed">Download our official application form PDF, fill in your details and prepare your resume and references.</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="300" class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-sm relative">
                <span class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 font-black flex items-center justify-center text-sm mb-4">3</span>
                <h4 class="font-black text-[#081747] text-lg">Submit via Email</h4>
                <p class="mt-2 text-sm text-slate-500 leading-relaxed">Email your completed form and credentials directly to <strong class="text-[#081747]">careers@life.edu.kh</strong>.</p>
            </div>
        </div>
    </section>

    {{-- 💼 4. Job Board (Current Openings) --}}
    <section class="mx-auto max-w-6xl px-6 py-14">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10 pb-4 border-b border-slate-200">
            <div>
                <span class="text-xs font-black uppercase tracking-widest text-orange-500">Join Our Team</span>
                <h3 class="text-3xl font-black text-[#081747] uppercase tracking-tight mt-1">Current Open Positions</h3>
            </div>
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400 bg-slate-100 px-4 py-1.5 rounded-full self-start sm:self-auto">
                {{ isset($jobs) ? $jobs->count() : 0 }} Available {{ isset($jobs) && $jobs->count() === 1 ? 'Role' : 'Roles' }}
            </span>
        </div>

        @if(isset($jobs) && $jobs->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($jobs as $index => $job)
                    <article data-aos="fade-up" data-aos-delay="{{ ($index % 2) * 150 }}"
                        class="group flex flex-col justify-between rounded-[2rem] bg-white border border-slate-200 p-8 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        
                        <div>
                            {{-- Header & Badges --}}
                            <div class="flex items-start justify-between gap-4 mb-4">
                                <h4 class="text-2xl font-black text-[#081747] group-hover:text-orange-500 transition-colors leading-snug">
                                    {{ $job->title }}
                                </h4>
                                
                                @if($job->job_type)
                                    <span class="shrink-0 rounded-full px-3 py-1 text-xs font-black uppercase tracking-wider 
                                        {{ $job->job_type === 'Full-Time' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-blue-50 text-blue-700 border border-blue-200' }}">
                                        {{ $job->job_type }}
                                    </span>
                                @endif
                            </div>

                            <div class="flex items-center gap-2 text-xs font-bold text-slate-400 mb-5">
                                <span>Life International School</span>
                                <span>•</span>
                                <span>{{ $job->created_at?->format('M d, Y') ?? 'Recently' }}</span>
                            </div>

                            <div class="text-sm text-slate-600 leading-relaxed line-clamp-3 mb-6">
                                {!! Str::limit(strip_tags($job->description), 160) !!}
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row gap-3">
                            @if($job->application_file)
                                {{-- 📍 ទាញយក Application Form PDF ផ្ទាល់ពី Cloudflare R2 --}}
                                <a href="{{ $getMediaUrl($job->application_file) }}" target="_blank" download
                                   class="inline-flex items-center justify-center gap-2 rounded-xl bg-orange-500 hover:bg-orange-600 px-5 py-3 text-xs sm:text-sm font-bold uppercase tracking-wider text-white shadow-md transition-all flex-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                    <span>Download Form (PDF)</span>
                                </a>
                            @endif

                            <a href="mailto:careers@life.edu.kh?subject=Application for {{ rawurlencode($job->title) }}"
                               class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#081747] hover:bg-blue-900 px-5 py-3 text-xs sm:text-sm font-bold uppercase tracking-wider text-white shadow-md transition-all {{ $job->application_file ? '' : 'w-full' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <span>Apply via Email</span>
                            </a>
                        </div>

                    </article>
                @endforeach
            </div>
        @else
            <div data-aos="fade-up" class="rounded-[2.5rem] border border-dashed border-slate-300 bg-white p-16 text-center shadow-sm">
                <div class="mx-auto w-16 h-16 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                </div>
                <h4 class="text-2xl font-black text-[#081747]">No open positions at this time</h4>
                <p class="text-sm text-slate-500 mt-2">Please check back later or submit a speculative application to <a href="mailto:careers@life.edu.kh" class="text-orange-600 font-bold underline">careers@life.edu.kh</a>.</p>
            </div>
        @endif

    </section>

</div>

@endsection