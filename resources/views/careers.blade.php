@extends('layout')

@section('title', 'Careers - Life International School')

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
@endphp

<div class="min-h-screen bg-[#f8fafc] text-slate-800">

    {{-- 🚀 1. Hero Section --}}
    <section class="relative overflow-hidden bg-white border-b border-slate-200/80 pt-10 pb-16 lg:py-20">
        
        {{-- Subtle Background Decoration --}}
        <div class="absolute -top-24 right-0 w-[500px] h-[500px] bg-gradient-to-bl from-orange-100/60 via-amber-50/40 to-transparent rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 left-0 w-80 h-80 bg-blue-100/40 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 mx-auto max-w-7xl px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                
                {{-- Left Side: Headline & Actions --}}
                <div class="lg:col-span-6 flex flex-col justify-center text-left">
                    
                    <div data-aos="fade-down" class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-orange-50 border border-orange-200 text-orange-600 text-xs font-black uppercase tracking-widest w-fit mb-6 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                        Join Our Educational Mission
                    </div>

                    <h1 data-aos="fade-up" data-aos-delay="100" class="text-4xl sm:text-5xl lg:text-6xl font-black text-[#081747] uppercase tracking-tight leading-[1.08]">
                        Work With <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-amber-500">Purpose</span> & Passion.
                    </h1>

                    <p data-aos="fade-up" data-aos-delay="200" class="mt-6 text-base sm:text-lg text-slate-600 leading-relaxed font-normal">
                        At Life International School, our educators and staff empower students through biblical values and academic excellence. Discover a supportive workplace where your talent truly makes an impact.
                    </p>

                    {{-- Call to Actions --}}
                    <div data-aos="fade-up" data-aos-delay="300" class="mt-8 flex flex-wrap items-center gap-4">
                        <a href="#openings" class="inline-flex items-center gap-2.5 bg-[#081747] hover:bg-orange-500 text-white text-sm font-bold uppercase tracking-wider px-7 py-4 rounded-xl shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                            <span>Explore Open Roles</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                        </a>

                        <a href="mailto:lifeinternationalschool@gmail.com" class="inline-flex items-center gap-2.5 bg-slate-100 hover:bg-slate-200 text-slate-800 text-sm font-bold uppercase tracking-wider px-6 py-4 rounded-xl transition-all duration-200">
                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>Send Spontaneous CV</span>
                        </a>
                    </div>

                    {{-- Quick Features List --}}
                    <div data-aos="fade-up" data-aos-delay="400" class="mt-10 pt-8 border-t border-slate-200/80 grid grid-cols-3 gap-4 text-left">
                        <div>
                            <span class="block text-xl sm:text-2xl font-black text-[#081747]">100%</span>
                            <span class="text-xs font-semibold text-slate-500">Christ-Centered</span>
                        </div>
                        <div>
                            <span class="block text-xl sm:text-2xl font-black text-orange-500">Global</span>
                            <span class="text-xs font-semibold text-slate-500">Standard Faculty</span>
                        </div>
                        <div>
                            <span class="block text-xl sm:text-2xl font-black text-[#081747]">Growth</span>
                            <span class="text-xs font-semibold text-slate-500">Focused Career</span>
                        </div>
                    </div>

                </div>

                {{-- Right Side: Banner Card --}}
                <div data-aos="zoom-in" data-aos-delay="200" class="lg:col-span-6 relative">
                    <div class="relative overflow-hidden rounded-[2.5rem] bg-white border border-slate-200 shadow-[0_20px_60px_rgba(15,23,42,0.1)] p-3">
                        <div class="relative aspect-[4/3] w-full overflow-hidden rounded-[2rem] bg-slate-100">
                            @if(isset($banner) && $banner->image)
                                <img src="{{ $getMediaUrl($banner->image) }}" alt="Life International School Educators" class="h-full w-full object-cover">
                            @else
                                <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?q=80&w=2070&auto=format&fit=crop" alt="Life International School Educators" class="h-full w-full object-cover">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                        </div>

                        {{-- Floating Hiring Badge --}}
                        <div class="absolute bottom-8 left-8 inline-flex items-center gap-3 rounded-2xl bg-white/95 backdrop-blur-md px-5 py-3 shadow-xl border border-white/60">
                            <span class="flex h-3 w-3 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                            </span>
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-wider text-slate-400 leading-none">LIS Careers</p>
                                <p class="text-sm font-black text-[#081747] mt-0.5">We Are Hiring Educators</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- 📋 2. Application Guide Steps --}}
    <section class="mx-auto max-w-7xl px-6 md:px-10 py-16">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-xs font-black uppercase tracking-widest text-orange-500">Application Guide</span>
            <h2 class="text-3xl font-black text-[#081747] uppercase tracking-tight mt-1">How To Apply In 3 Steps</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div data-aos="fade-up" data-aos-delay="100" class="p-8 rounded-[2rem] bg-white border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow">
                <span class="w-10 h-10 rounded-2xl bg-orange-100 text-orange-600 font-black flex items-center justify-center text-base mb-5">1</span>
                <h4 class="font-black text-[#081747] text-lg">Select Open Position</h4>
                <p class="mt-2 text-sm text-slate-500 leading-relaxed">Review the available teaching or administrative roles below to find the best match for your experience.</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="200" class="p-8 rounded-[2rem] bg-white border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow">
                <span class="w-10 h-10 rounded-2xl bg-blue-100 text-blue-600 font-black flex items-center justify-center text-base mb-5">2</span>
                <h4 class="font-black text-[#081747] text-lg">Complete Form (PDF)</h4>
                <p class="mt-2 text-sm text-slate-500 leading-relaxed">Download our official application form PDF, fill out your details, and prepare your CV and credentials.</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="300" class="p-8 rounded-[2rem] bg-white border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow">
                <span class="w-10 h-10 rounded-2xl bg-emerald-100 text-emerald-600 font-black flex items-center justify-center text-base mb-5">3</span>
                <h4 class="font-black text-[#081747] text-lg">Submit via Email</h4>
                <p class="mt-2 text-sm text-slate-500 leading-relaxed">Send your application package directly to <strong class="text-[#081747]">lifeinternationalschool@gmail.com</strong>.</p>
            </div>
        </div>
    </section>

    {{-- 💼 3. Job Openings Board --}}
    <section id="openings" class="mx-auto max-w-7xl px-6 md:px-10 pb-24">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10 pb-4 border-b border-slate-200">
            <div>
                <span class="text-xs font-black uppercase tracking-widest text-orange-500">Opportunities</span>
                <h3 class="text-3xl font-black text-[#081747] uppercase tracking-tight mt-1">Available Positions</h3>
            </div>
            <span class="text-xs font-bold uppercase tracking-wider text-slate-500 bg-white border border-slate-200 px-4 py-2 rounded-xl shadow-sm self-start sm:self-auto">
                {{ isset($jobs) ? $jobs->count() : 0 }} Openings Found
            </span>
        </div>

        @if(isset($jobs) && $jobs->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($jobs as $index => $job)
                    <article data-aos="fade-up" data-aos-delay="{{ ($index % 2) * 150 }}"
                        class="group flex flex-col justify-between rounded-[2rem] bg-white border border-slate-200 p-8 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        
                        <div>
                            {{-- Header & Tag --}}
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
                                <span class="text-orange-600">Life International School</span>
                                <span>•</span>
                                <span>{{ isset($job->created_at) ? $job->created_at->format('M d, Y') : 'Active' }}</span>
                            </div>

                            <div class="text-sm text-slate-600 leading-relaxed line-clamp-3 mb-6">
                                {!! Str::limit(strip_tags($job->description), 160) !!}
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row gap-3">
                            @if($job->application_file)
                                <a href="{{ $getMediaUrl($job->application_file) }}" target="_blank" download
                                   class="inline-flex items-center justify-center gap-2 rounded-xl bg-orange-500 hover:bg-orange-600 px-5 py-3 text-xs sm:text-sm font-bold uppercase tracking-wider text-white shadow-md transition-all flex-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                    <span>Download Form</span>
                                </a>
                            @endif

                            <a href="mailto:lifeinternationalschool@gmail.com?subject=Application%20for%20{{ rawurlencode($job->title) }}"
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
                <div class="mx-auto w-16 h-16 rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                </div>
                <h4 class="text-2xl font-black text-[#081747]">No open positions at this time</h4>
                <p class="text-sm text-slate-500 mt-2">Please check back later or submit your resume to <a href="mailto:lifeinternationalschool@gmail.com" class="text-orange-600 font-bold underline">lifeinternationalschool@gmail.com</a>.</p>
            </div>
        @endif

    </section>

</div>

@endsection