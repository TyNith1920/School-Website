@extends('layout')

@section('title', 'Enrollment - Life International School')

@section('content')

@php
    // 📍 មុខងារទាញយករូបភាព និងឯកសារ PDF ពី Cloudflare R2 (s3)
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

<div class="w-full min-h-screen bg-[#fcfdfd] text-slate-800">

    {{-- 🌟 1. Hero Banner with Metallic Gold Wave Transition --}}
    <section class="relative isolate overflow-hidden bg-gradient-to-br from-[#061238] via-[#0d276b] to-[#173c9c] text-white pt-16 pb-28 md:pb-36">
        
        {{-- Ambient Glow & Grid --}}
        <div class="absolute inset-0 opacity-15 pointer-events-none" 
             style="background-image: radial-gradient(circle, rgba(255,255,255,0.85) 1px, transparent 1px); background-size: 26px 26px;"></div>
        <div class="absolute -top-24 -left-20 h-96 w-96 rounded-full bg-cyan-400/20 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 right-0 h-96 w-96 rounded-full bg-orange-500/20 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 mx-auto max-w-5xl px-6 text-center">
            
            {{-- Badge --}}
            <div data-aos="fade-down" class="inline-flex items-center gap-2 rounded-full border border-amber-400/30 bg-amber-400/10 px-5 py-1.5 text-xs md:text-sm font-bold uppercase tracking-[0.2em] text-amber-300 backdrop-blur-md mb-6 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                Now Enrolling for Academic Year
            </div>

            <h1 data-aos="fade-up" data-aos-delay="100" class="text-3xl sm:text-5xl md:text-6xl lg:text-7xl font-black uppercase tracking-tight text-white leading-tight drop-shadow-2xl">
                {{ __($enrollment?->hero_title ?? 'Warmest Welcome to Our Students') }}
            </h1>

            <div data-aos="zoom-in" data-aos-delay="200" class="mx-auto mt-5 mb-6 h-1.5 w-24 rounded-full bg-gradient-to-r from-amber-400 to-orange-500 shadow-[0_0_15px_rgba(251,191,36,0.6)]"></div>

            <p data-aos="fade-up" data-aos-delay="300" class="mx-auto max-w-2xl text-base sm:text-lg md:text-xl text-blue-100/90 leading-relaxed font-light">
                {{ $enrollment?->hero_subtitle ?? 'Begin an inspiring educational journey rooted in Truth, Integrity, and Love. Secure your child’s place today.' }}
            </p>

            {{-- Quick Stats Pills --}}
            <div data-aos="fade-up" data-aos-delay="400" class="mt-8 flex flex-wrap items-center justify-center gap-3 text-xs md:text-sm">
                <div class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-4 py-2 border border-white/15 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span>Early Childhood – Grade 12</span>
                </div>
                <div class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-4 py-2 border border-white/15 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                    <span>ACSI Accredited Program</span>
                </div>
                <div class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-4 py-2 border border-white/15 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                    <span>International Curriculum</span>
                </div>
            </div>

        </div>

        {{-- 📍 Dual-Layer Rich Metallic Gold Wave Transition --}}
        <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none z-20 pointer-events-none">
            <svg class="relative block w-full h-16 sm:h-20 md:h-28" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="enrollmentGoldGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#b45309" />
                        <stop offset="25%" stop-color="#f59e0b" />
                        <stop offset="50%" stop-color="#fde047" />
                        <stop offset="75%" stop-color="#f59e0b" />
                        <stop offset="100%" stop-color="#d97706" />
                    </linearGradient>
                </defs>

                {{-- ស្រទាប់ទី ១: រលកពណ៌មាស --}}
                <path d="M0,0 C160,85 380,-15 640,40 C890,95 1060,15 1200,50 L1200,120 L0,120 Z" fill="url(#enrollmentGoldGradient)"></path>
                {{-- ស្រទាប់ទី ២: រលកពណ៌ផ្ទៃខាងក្រោម (#fcfdfd) --}}
                <path d="M0,28 C200,85 450,22 700,58 C940,95 1100,32 1200,50 L1200,120 L0,120 Z" fill="#fcfdfd"></path>
            </svg>
        </div>
    </section>

    {{-- 🧭 2. Admissions Roadmap (ជំហានងាយៗទាំង ៤ ក្នុងការចុះឈ្មោះ) --}}
    <section class="relative -mt-10 md:-mt-14 z-20 max-w-6xl mx-auto px-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <div data-aos="fade-up" data-aos-delay="100" class="p-6 rounded-[2rem] bg-white border border-slate-200/80 shadow-[0_15px_35px_rgba(15,23,42,0.06)] hover:-translate-y-1 transition-all">
                <span class="text-xs font-black text-amber-500 uppercase tracking-widest">Step 01</span>
                <h4 class="font-black text-[#081747] text-lg mt-1">Submit Form</h4>
                <p class="mt-2 text-xs text-slate-500 leading-relaxed">Download and complete the registration form with student academic records.</p>
            </div>

            <div data-aos="fade-up" data-aos-delay="200" class="p-6 rounded-[2rem] bg-white border border-slate-200/80 shadow-[0_15px_35px_rgba(15,23,42,0.06)] hover:-translate-y-1 transition-all">
                <span class="text-xs font-black text-blue-600 uppercase tracking-widest">Step 02</span>
                <h4 class="font-black text-[#081747] text-lg mt-1">Placement Test</h4>
                <p class="mt-2 text-xs text-slate-500 leading-relaxed">Age-appropriate academic readiness evaluation in English and Mathematics.</p>
            </div>

            <div data-aos="fade-up" data-aos-delay="300" class="p-6 rounded-[2rem] bg-white border border-slate-200/80 shadow-[0_15px_35px_rgba(15,23,42,0.06)] hover:-translate-y-1 transition-all">
                <span class="text-xs font-black text-emerald-600 uppercase tracking-widest">Step 03</span>
                <h4 class="font-black text-[#081747] text-lg mt-1">Family Interview</h4>
                <p class="mt-2 text-xs text-slate-500 leading-relaxed">A brief session with our leadership to discuss curriculum and core values.</p>
            </div>

            <div data-aos="fade-up" data-aos-delay="400" class="p-6 rounded-[2rem] bg-white border border-slate-200/80 shadow-[0_15px_35px_rgba(15,23,42,0.06)] hover:-translate-y-1 transition-all">
                <span class="text-xs font-black text-rose-500 uppercase tracking-widest">Step 04</span>
                <h4 class="font-black text-[#081747] text-lg mt-1">Welcome Aboard</h4>
                <p class="mt-2 text-xs text-slate-500 leading-relaxed">Receive formal acceptance, schedule uniforms, and meet teachers.</p>
            </div>

        </div>
    </section>

    {{-- 📄 3. Main Download & Showcase Section --}}
    <main class="max-w-6xl mx-auto px-6 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            {{-- Image Showcase (រូបភាពបែប Framed Studio) --}}
            <div data-aos="fade-right" class="lg:col-span-6 relative">
                @if($enrollment?->image)
                    <div class="relative group">
                        <div class="absolute -inset-4 rounded-[2.5rem] bg-gradient-to-r from-orange-400 to-amber-300 opacity-20 blur-xl transition duration-500 group-hover:opacity-40"></div>
                        <div class="relative aspect-[4/3] rounded-[2.5rem] overflow-hidden shadow-2xl border-4 border-white bg-slate-100">
                            <img src="{{ $getMediaUrl($enrollment->image) }}" alt="Student Enrollment" class="w-full h-full object-cover transform transition duration-700 group-hover:scale-105" loading="lazy">
                        </div>
                    </div>
                @else
                    <div class="aspect-[4/3] rounded-[2.5rem] bg-gradient-to-br from-blue-900 to-slate-900 flex items-center justify-center text-white p-8 text-center shadow-xl">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-widest text-amber-300">Life International School</span>
                            <h3 class="text-2xl font-black mt-2">Nurturing Leaders for Tomorrow</h3>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Text & Document Action Card --}}
            <div data-aos="fade-left" class="lg:col-span-6 flex flex-col justify-between">
                <div>
                    <span class="text-xs font-black uppercase tracking-widest text-orange-500">Admissions Package</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-[#081747] uppercase tracking-tight mt-1 mb-4">
                        {{ $enrollment?->section_title ?? 'Student Enrollment Form' }}
                    </h2>

                    <p class="text-slate-600 text-base leading-relaxed mb-8">
                        {{ $enrollment?->section_description ?? 'Download the official enrollment application form. Please complete all sections and submit the signed copy along with previous transcripts to our admissions office.' }}
                    </p>

                    {{-- Document Box --}}
                    @if($enrollment?->pdf_file)
                        <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm mb-8 flex items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-red-50 text-red-600 flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-black text-slate-800 text-sm">Enrollment_Application_Form.pdf</h4>
                                    <p class="text-xs text-slate-400 mt-0.5">Official Admission Document • PDF</p>
                                </div>
                            </div>

                            <a href="{{ $getMediaUrl($enrollment->pdf_file) }}" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="inline-flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white font-bold px-6 py-3 rounded-xl text-xs uppercase tracking-wider shadow-md hover:-translate-y-0.5 transition-all shrink-0">
                                <span>Download</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            </a>
                        </div>
                    @endif

                    {{-- Contact Support Box --}}
                    <div class="p-6 rounded-2xl bg-blue-50/60 border border-blue-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <p class="text-xs font-bold text-blue-900 uppercase tracking-wider">Need assistance with your application?</p>
                            <p class="text-xs text-blue-700 mt-0.5">Our admissions counselors are ready to help walk you through the process.</p>
                        </div>
                        <a href="{{ url('/contact-us') }}" class="text-xs font-black text-orange-600 hover:text-orange-700 uppercase tracking-wider inline-flex items-center gap-1 shrink-0">
                            <span>Contact Office</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </main>

</div>

@endsection