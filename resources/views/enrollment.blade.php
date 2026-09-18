@extends('layout')

@section('title', 'Student Enrollment - Life International School')

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

    // 📍 សម្អាត tag HTML ដែលខូចចេញឱ្យនៅសល់តែអក្សរសុទ្ធស្អាត
    $cleanHeroTitle = strip_tags($enrollment?->hero_title ?? 'Warmest Welcome to Our Students');
@endphp

<div class="w-full min-h-screen bg-[#f7f9fc] text-slate-800">

    {{-- 🎓 1. Split Editorial Hero (ប្លែកដាច់ មិនប្រើ Banner ខៀវចាស់ទៀតឡើយ) --}}
    <section class="relative bg-white border-b border-slate-200/80 pt-12 pb-16 md:py-20 overflow-hidden">
        
        {{-- Background Soft Accent Gradients --}}
        <div class="absolute top-0 right-0 w-[550px] h-[550px] bg-gradient-to-bl from-orange-100/60 via-amber-50/40 to-transparent rounded-full blur-3xl pointer-events-none -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-blue-50/70 rounded-full blur-3xl pointer-events-none -ml-20 -mb-20"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 md:px-12">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                
                {{-- Left: Modern Editorial Typography --}}
                <div class="lg:col-span-7 text-left">
                    
                    <div data-aos="fade-down" class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-orange-50 border border-orange-200 text-orange-600 text-xs font-black uppercase tracking-[0.2em] mb-6">
                        <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                        Admissions Open • Academic Year
                    </div>

                    {{-- ចំណងជើងធំ គ្មានបញ្ហាអក្សរ HTML ធ្លាយទៀតទេ --}}
                    <h1 data-aos="fade-up" data-aos-delay="100" class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight text-[#081747] leading-[1.12] uppercase">
                        {{ $cleanHeroTitle }}
                    </h1>

                    <div data-aos="zoom-in" data-aos-delay="200" class="mt-5 mb-6 h-1.5 w-20 rounded-full bg-gradient-to-r from-orange-500 to-amber-400"></div>

                    <p data-aos="fade-up" data-aos-delay="300" class="text-base sm:text-lg text-slate-600 leading-relaxed max-w-xl font-normal">
                        {{ $enrollment?->hero_subtitle ?? 'Let the learning journey begin! We are excited to guide your family through the transition into Life International School.' }}
                    </p>

                    {{-- Badges Info --}}
                    <div data-aos="fade-up" data-aos-delay="400" class="mt-8 flex flex-wrap items-center gap-3 text-xs font-bold text-slate-700">
                        <span class="px-4 py-2 rounded-xl bg-slate-100 border border-slate-200">Early Childhood – Grade 12</span>
                        <span class="px-4 py-2 rounded-xl bg-slate-100 border border-slate-200">ACSI Accredited</span>
                        <span class="px-4 py-2 rounded-xl bg-slate-100 border border-slate-200">Christian Values</span>
                    </div>

                </div>

                {{-- Right: Application Passport Showcase Card --}}
                <div data-aos="fade-left" data-aos-delay="200" class="lg:col-span-5 relative">
                    <div class="relative rounded-[2.5rem] bg-gradient-to-b from-[#081747] to-[#0e276b] p-8 sm:p-10 text-white shadow-[0_25px_60px_rgba(8,23,71,0.22)] overflow-hidden">
                        
                        <div class="absolute -right-12 -top-12 w-44 h-44 rounded-full bg-orange-500/20 blur-2xl"></div>

                        <div class="flex items-center justify-between border-b border-white/15 pb-5 mb-6">
                            <div>
                                <span class="text-[10px] font-mono text-amber-400 uppercase tracking-widest">Enrolling Form</span>
                                <h3 class="text-xl font-black text-white mt-0.5">Application Portal</h3>
                            </div>
                            <span class="w-10 h-10 rounded-2xl bg-white/10 flex items-center justify-center text-amber-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </span>
                        </div>

                        <p class="text-xs text-blue-100 leading-relaxed mb-8">
                            Download the official student enrollment packet, complete the necessary details, and submit it directly to our admissions office.
                        </p>

                        @if($enrollment?->pdf_file)
                            <a href="{{ $getMediaUrl($enrollment->pdf_file) }}" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="group w-full inline-flex items-center justify-between bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white px-6 py-4 rounded-2xl font-black text-xs uppercase tracking-wider shadow-lg hover:shadow-orange-500/40 transition-all">
                                <span>Download PDF Application</span>
                                <span class="w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center group-hover:translate-y-0.5 transition-transform">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                </span>
                            </a>
                        @else
                            <div class="py-3 px-4 rounded-xl bg-white/10 text-center text-xs text-slate-300">Form will be available soon</div>
                        @endif

                        <div class="mt-6 pt-5 border-t border-white/10 flex items-center justify-between text-xs text-slate-300">
                            <span>Questions?</span>
                            <a href="{{ url('/contact-us') }}" class="font-bold text-amber-300 hover:underline">Contact Admissions →</a>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

    {{-- 🧭 2. Progression Timeline (រចនាជាខ្សែបន្ទាត់ជំហានបែប Track មិនមែនប្រអប់ការ៉ូ 4 ដូចមុនទេ) --}}
    <section class="max-w-7xl mx-auto px-6 py-20">
        
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-xs font-black uppercase tracking-widest text-orange-600">How It Works</span>
            <h2 class="text-3xl sm:text-4xl font-black text-[#081747] uppercase tracking-tight mt-1">Four Steps to Enrollment</h2>
            <p class="mt-3 text-slate-500 text-sm sm:text-base leading-relaxed">A clear and straightforward pathway to joining the Life International School family.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
            
            {{-- Step 1 --}}
            <div data-aos="fade-up" data-aos-delay="100" class="relative bg-white p-7 rounded-[2rem] border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 font-mono font-black text-lg flex items-center justify-center mb-6">01</div>
                    <h3 class="font-black text-[#081747] text-lg">Download & Apply</h3>
                    <p class="mt-2 text-xs text-slate-500 leading-relaxed">Fill out the official registration form and gather previous report cards.</p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100 text-[11px] font-bold text-amber-600 uppercase tracking-wider">Step One</div>
            </div>

            {{-- Step 2 --}}
            <div data-aos="fade-up" data-aos-delay="200" class="relative bg-white p-7 rounded-[2rem] border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 font-mono font-black text-lg flex items-center justify-center mb-6">02</div>
                    <h3 class="font-black text-[#081747] text-lg">Readiness Check</h3>
                    <p class="mt-2 text-xs text-slate-500 leading-relaxed">Age-appropriate academic evaluation in English and Mathematics.</p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100 text-[11px] font-bold text-blue-600 uppercase tracking-wider">Step Two</div>
            </div>

            {{-- Step 3 --}}
            <div data-aos="fade-up" data-aos-delay="300" class="relative bg-white p-7 rounded-[2rem] border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 font-mono font-black text-lg flex items-center justify-center mb-6">03</div>
                    <h3 class="font-black text-[#081747] text-lg">Family Dialogue</h3>
                    <p class="mt-2 text-xs text-slate-500 leading-relaxed">A conversation between school leadership and parents to align on values.</p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100 text-[11px] font-bold text-emerald-600 uppercase tracking-wider">Step Three</div>
            </div>

            {{-- Step 4 --}}
            <div data-aos="fade-up" data-aos-delay="400" class="relative bg-white p-7 rounded-[2rem] border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 font-mono font-black text-lg flex items-center justify-center mb-6">04</div>
                    <h3 class="font-black text-[#081747] text-lg">Formal Welcome</h3>
                    <p class="mt-2 text-xs text-slate-500 leading-relaxed">Receive acceptance letter, arrange uniforms, and start orientation.</p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100 text-[11px] font-bold text-rose-600 uppercase tracking-wider">Final Step</div>
            </div>

        </div>

    </section>

    {{-- 📸 3. Interactive Student Life Preview Section --}}
    <section class="max-w-7xl mx-auto px-6 pb-24">
        <div class="rounded-[2.5rem] bg-white border border-slate-200/90 p-8 md:p-14 shadow-sm">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                {{-- Framed Student Photo --}}
                <div data-aos="fade-right" class="lg:col-span-6">
                    @if($enrollment?->image)
                        <div class="relative aspect-[4/3] rounded-[2rem] overflow-hidden bg-slate-100 shadow-lg border-2 border-slate-100">
                            <img src="{{ $getMediaUrl($enrollment->image) }}" alt="Student Enrollment" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="aspect-[4/3] rounded-[2rem] bg-slate-900 flex items-center justify-center text-white text-center p-6">
                            <p class="text-sm font-bold text-slate-400">Life International School</p>
                        </div>
                    @endif
                </div>

                {{-- Content --}}
                <div data-aos="fade-left" class="lg:col-span-6">
                    <span class="text-xs font-black uppercase tracking-widest text-orange-600">Official Package</span>
                    <h2 class="text-3xl font-black text-[#081747] uppercase tracking-tight mt-1 mb-4">
                        {{ $enrollment?->section_title ?? 'Student Enrollment' }}
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed mb-8">
                        {{ $enrollment?->section_description ?? 'Download the official enrollment application form. Please complete all sections and submit the signed copy to our admissions desk.' }}
                    </p>

                    @if($enrollment?->pdf_file)
                        <div class="flex items-center gap-4">
                            <a href="{{ $getMediaUrl($enrollment->pdf_file) }}" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="inline-flex items-center gap-3 bg-[#081747] hover:bg-orange-600 text-white font-black text-xs uppercase tracking-wider px-8 py-4 rounded-xl shadow-md transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <span>Get Enrollment PDF</span>
                            </a>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </section>

</div>

@endsection