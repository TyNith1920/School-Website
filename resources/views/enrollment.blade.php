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

    $cleanHeroTitle = strip_tags($enrollment?->hero_title ?? 'Warmest Welcome to Our Students');
@endphp

<div class="w-full min-h-screen bg-[#fcfaf6] text-slate-800">

    {{-- 🏛️ 1. Official Registrar Academic Hero (ផ្ទៃពណ៌ Cream/Ivory ថ្លៃថ្នូរ មិនប្រើ Split Card ដូច Careers ឡើយ) --}}
    <section class="relative pt-16 pb-20 md:py-24 px-6 border-b border-amber-900/10 overflow-hidden bg-gradient-to-b from-[#f9f5ed] via-[#fcfaf6] to-[#fcfaf6]">
        
        {{-- Elegant Watermark Seal --}}
        <div class="absolute -top-16 -right-16 w-96 h-96 rounded-full border-[24px] border-amber-600/5 pointer-events-none"></div>
        <div class="absolute top-1/2 -left-20 w-80 h-80 rounded-full border-[16px] border-blue-900/5 pointer-events-none"></div>

        <div class="relative z-10 max-w-4xl mx-auto text-center">
            
            {{-- Official Registrar Seal Pill --}}
            <div data-aos="fade-down" class="inline-flex items-center gap-2 px-5 py-1.5 rounded-full bg-amber-100/70 border border-amber-300/60 text-amber-900 text-xs font-bold uppercase tracking-[0.25em] mb-6 shadow-xs">
                <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Office of Admissions & Registrar
            </div>

            {{-- Title --}}
            <h1 data-aos="fade-up" data-aos-delay="100" class="text-3xl sm:text-5xl md:text-6xl font-black text-[#0b1240] tracking-tight uppercase leading-[1.15]">
                {{ $cleanHeroTitle }}
            </h1>

            <div data-aos="zoom-in" data-aos-delay="200" class="mx-auto mt-6 mb-6 h-1 w-20 bg-amber-500 rounded-full"></div>

            <p data-aos="fade-up" data-aos-delay="300" class="text-base sm:text-lg md:text-xl text-slate-600 leading-relaxed font-light max-w-2xl mx-auto">
                {{ $enrollment?->hero_subtitle ?? 'Let the learning journey begin! We are excited to guide your family through the transition into Life International School.' }}
            </p>

            {{-- Quick Checklist Strip --}}
            <div data-aos="fade-up" data-aos-delay="400" class="mt-10 inline-flex flex-wrap items-center justify-center gap-6 py-3 px-8 rounded-2xl bg-white border border-amber-200/60 shadow-xs text-xs font-semibold text-slate-600">
                <span class="flex items-center gap-2"><svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Rolling Admissions</span>
                <span class="text-slate-300">•</span>
                <span class="flex items-center gap-2"><svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Nursery to Grade 12</span>
                <span class="text-slate-300">•</span>
                <span class="flex items-center gap-2"><svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> ACSI Member School</span>
            </div>

        </div>
    </section>

    {{-- 🛤️ 2. Connected Milestone Roadmap (លុបប្រអប់ Step 1, 2, 3 ដាច់ៗចោល ដូរមកជា Timeline តគ្នាផ្តេក) --}}
    <section class="max-w-6xl mx-auto px-6 py-20">
        
        <div class="text-center max-w-xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-amber-700">Admissions Pathway</span>
            <h2 class="text-2xl sm:text-4xl font-black text-[#0b1240] tracking-tight uppercase mt-1">Enrollment Journey</h2>
        </div>

        {{-- Connected Stepper Layout --}}
        <div class="relative">
            
            {{-- Connecting Line (សម្រាប់ Desktop) --}}
            <div class="hidden md:block absolute top-7 left-12 right-12 h-0.5 bg-dashed border-t-2 border-dashed border-amber-300/80 z-0"></div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative z-10">
                
                {{-- Step 1 --}}
                <div data-aos="fade-up" data-aos-delay="100" class="flex flex-col items-center md:items-start text-center md:text-left">
                    <div class="w-14 h-14 rounded-full bg-white border-2 border-amber-500 text-amber-700 font-black text-lg flex items-center justify-center shadow-md mb-5 ring-8 ring-[#fcfaf6]">
                        01
                    </div>
                    <h3 class="font-black text-slate-900 text-base mb-1">Download & Apply</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Complete the student application and attach previous academic transcripts.</p>
                </div>

                {{-- Step 2 --}}
                <div data-aos="fade-up" data-aos-delay="200" class="flex flex-col items-center md:items-start text-center md:text-left">
                    <div class="w-14 h-14 rounded-full bg-white border-2 border-blue-900 text-blue-900 font-black text-lg flex items-center justify-center shadow-md mb-5 ring-8 ring-[#fcfaf6]">
                        02
                    </div>
                    <h3 class="font-black text-slate-900 text-base mb-1">Readiness Evaluation</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Age-appropriate placement assessment in English literacy and Mathematics.</p>
                </div>

                {{-- Step 3 --}}
                <div data-aos="fade-up" data-aos-delay="300" class="flex flex-col items-center md:items-start text-center md:text-left">
                    <div class="w-14 h-14 rounded-full bg-white border-2 border-emerald-600 text-emerald-700 font-black text-lg flex items-center justify-center shadow-md mb-5 ring-8 ring-[#fcfaf6]">
                        03
                    </div>
                    <h3 class="font-black text-slate-900 text-base mb-1">Parent Dialogue</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">A brief, friendly meeting with school directors to align on student growth and values.</p>
                </div>

                {{-- Step 4 --}}
                <div data-aos="fade-up" data-aos-delay="400" class="flex flex-col items-center md:items-start text-center md:text-left">
                    <div class="w-14 h-14 rounded-full bg-[#0b1240] text-amber-300 font-black text-lg flex items-center justify-center shadow-md mb-5 ring-8 ring-[#fcfaf6]">
                        ✓
                    </div>
                    <h3 class="font-black text-slate-900 text-base mb-1">Official Welcome</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Final registration confirmation, uniform fitting, and class scheduling.</p>
                </div>

            </div>

        </div>

    </section>

    {{-- 📁 3. Official Registrar Dossier & Document Center --}}
    <section class="max-w-5xl mx-auto px-6 pb-24">
        <div class="rounded-3xl bg-white border border-amber-900/10 shadow-xl overflow-hidden">
            
            {{-- Top File Folder Header --}}
            <div class="bg-[#0b1240] px-8 py-6 text-white flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-400/10 text-amber-300 flex items-center justify-center border border-amber-400/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-mono tracking-widest text-amber-300">Official Form</span>
                        <h3 class="text-lg font-black text-white">Student Enrollment Dossier</h3>
                    </div>
                </div>

                <span class="text-xs font-bold text-blue-200 bg-white/10 px-3.5 py-1.5 rounded-full border border-white/10 w-fit">
                    Academic Year Form
                </span>
            </div>

            <div class="p-8 md:p-12 grid grid-cols-1 md:grid-cols-12 gap-10 items-center">
                
                {{-- Left: Description --}}
                <div class="md:col-span-7">
                    <h4 class="text-2xl font-black text-slate-900 mb-3">
                        {{ $enrollment?->section_title ?? 'Application for Admission' }}
                    </h4>
                    <p class="text-sm text-slate-600 leading-relaxed mb-6 font-normal">
                        {{ $enrollment?->section_description ?? 'Download the official enrollment application form. Please complete all sections and submit the signed copy to our admissions desk along with health records.' }}
                    </p>

                    <div class="space-y-2 text-xs text-slate-500">
                        <p class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                            Includes Parent Consent & Emergency Medical Release
                        </p>
                        <p class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                            Fillable on digital devices or print directly
                        </p>
                    </div>
                </div>

                {{-- Right: Direct Download Box --}}
                <div class="md:col-span-5 flex flex-col items-center justify-center p-6 rounded-2xl bg-amber-50/50 border border-amber-200/60 text-center">
                    <div class="w-14 h-14 rounded-2xl bg-red-100 text-red-600 flex items-center justify-center mb-3">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    </div>

                    <p class="font-black text-slate-900 text-sm mb-1">Enrollment_Form.pdf</p>
                    <p class="text-[11px] text-slate-400 mb-5">Verified Official Document</p>

                    @if($enrollment?->pdf_file)
                        <a href="{{ $getMediaUrl($enrollment->pdf_file) }}" 
                           target="_blank" 
                           rel="noopener noreferrer" 
                           class="w-full inline-flex items-center justify-center gap-2 bg-[#0b1240] hover:bg-amber-600 text-white font-bold text-xs uppercase tracking-wider py-3.5 px-6 rounded-xl shadow-md transition-colors">
                            <span>Download PDF Form</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        </a>
                    @else
                        <span class="text-xs font-bold text-slate-400 py-2">Document in preparation</span>
                    @endif
                </div>

            </div>

        </div>
    </section>

</div>

@endsection