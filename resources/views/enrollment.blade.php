@extends('layout')

<!-- បង្ហាញឈ្មោះនៅលើ Tab Browser -->
@section('title', 'Enrollment - Life International School')

@section('content')

@php
    // 📍 មុខងារឆ្លាតវៃសម្រាប់ទាញរូបភាពពី Cloudinary
    $getMediaUrl = function($path) {
        if (empty($path)) return null;
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) return $path;
        try { return \Storage::disk('cloudinary')->url($path); } 
        catch (\Exception $e) { return asset('storage/' . $path); }
    };
@endphp

{{-- 📍 ផ្នែកខាងលើ (Hero Section) --}}
<section class="relative w-full py-24 px-6 md:py-32 md:px-20 bg-[#081747] overflow-hidden">
    
    <!-- Background Gradients & Patterns (ស៊ីគ្នាជាមួយទំព័រ Contact) -->
    <div class="absolute inset-0 bg-gradient-to-br from-[#081747] via-[#173c9c] to-[#2563eb] opacity-90"></div>
    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle, rgba(255,255,255,0.8) 1px, transparent 1px); background-size: 24px 24px;"></div>
    
    <!-- ពន្លឺជះពណ៌ទឹកក្រូចពីក្រោម -->
    <div class="absolute -bottom-24 -right-24 h-96 w-96 rounded-full bg-[#e06d64]/40 blur-[100px]"></div>
    
    <div class="max-w-6xl mx-auto relative z-10 text-center">
        <!-- Badge តូចខាងលើចំណងជើង -->
        <div data-aos="fade-down" class="mb-5 inline-flex items-center rounded-full border border-white/25 bg-white/10 px-6 py-2 text-sm font-bold uppercase tracking-widest text-blue-50 backdrop-blur-md shadow-sm">
            Admissions
        </div>
        
        <!-- 📍 បន្ថែមសញ្ញា ? ការពារ Error (Nullsafe) -->
        <h1 data-aos="fade-up" data-aos-delay="100" class="text-4xl md:text-5xl lg:text-7xl font-black text-white mb-6 uppercase drop-shadow-2xl" style="line-height: 1.7;">
            {!! __($enrollment?->hero_title ?? 'WARMEST WELCOME TO OUR STUDENT!') !!}
        </h1>
        
        <!-- បន្ទាត់ពណ៌ទឹកក្រូចកាត់កណ្តាល -->
        <div data-aos="zoom-in" data-aos-delay="200" class="mx-auto mt-6 mb-8 h-1.5 w-24 rounded-full bg-[#e06d64] shadow-[0_0_15px_rgba(224,109,100,0.5)]"></div>
        
        <!-- 📍 បន្ថែមសញ្ញា ? ការពារ Error (Nullsafe) -->
        <p data-aos="fade-up" data-aos-delay="300" class="text-blue-100 text-xl md:text-2xl max-w-3xl mx-auto leading-relaxed font-medium">
            {{ $enrollment?->hero_subtitle ?? 'Let the learning journey begin! We are excited to welcome you to our school community.' }}
        </p>
    </div>
    
    <!-- គែមរាងបញ្ឆិតនៅខាងក្រោម (Slanted Divider) -->
    <div class="absolute -bottom-px left-0 h-10 w-full bg-slate-50 md:h-16" style="clip-path: polygon(0 70%, 100% 0, 100% 100%, 0 100%);"></div>
</section>

{{-- 📍 ផ្នែកព័ត៌មាន និងទាញយកឯកសារ (Content Section) --}}
<section class="bg-slate-50 px-5 py-16 md:py-24">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
        
        <!-- រូបភាពខាងឆ្វេង (Image Side) -->
        <!-- 📍 បន្ថែមសញ្ញា ? ការពារ Error (Nullsafe) -->
        @if($enrollment?->image)
            <div data-aos="fade-right" class="relative group">
                <!-- ស្រមោលបញ្ចេញពន្លឺពេលយក Mouse ដាក់ពីលើ -->
                <div class="absolute -inset-4 rounded-[2.5rem] bg-gradient-to-r from-[#e06d64] to-orange-400 opacity-20 blur-xl transition duration-500 group-hover:opacity-40"></div>
                
                <!-- រូបភាព -->
                <div class="relative rounded-[2rem] overflow-hidden shadow-2xl border-4 border-white">
                    <img src="{{ $getMediaUrl($enrollment?->image) }}" alt="Student Enrollment" class="w-full h-auto object-cover transform transition duration-700 group-hover:scale-105">
                </div>
                
                <!-- Icon តុបតែងបន្ថែម -->
                <div class="absolute -bottom-6 -left-6 h-20 w-20 md:h-24 md:w-24 rounded-full bg-[#0b1240] flex items-center justify-center shadow-xl border-4 border-white transition-transform duration-500 group-hover:-translate-y-2 group-hover:rotate-12">
                    <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </div>
        @endif

        <!-- អត្ថបទ និងប៊ូតុងខាងស្តាំ (Content & Button Side) -->
        <div data-aos="fade-left" data-aos-delay="200" class="relative">
            <div class="mb-4 flex items-center gap-3">
                <span class="h-1 w-10 rounded-full bg-[#e06d64]"></span>
                <span class="text-sm font-bold uppercase tracking-[0.18em] text-[#e06d64]">
                    Join Us Today
                </span>
            </div>
            
            <h2 class="text-4xl md:text-5xl font-black text-[#0b1240] mb-6 leading-tight drop-shadow-sm">
                {{ $enrollment?->section_title ?? 'Student Enrollment' }}
            </h2>
            
            <p class="text-lg text-slate-600 mb-10 leading-relaxed">
                {{ $enrollment?->section_description ?? 'Click to download LIS Re-Enrollment Form. Please fill it out and send your completed PDF copy to our school officers.' }}
            </p>
            
            <!-- 📍 បន្ថែមសញ្ញា ? ការពារ Error (Nullsafe) -->
            @if($enrollment?->pdf_file)
                <!-- ប៊ូតុង Download ជំនាន់ថ្មី -->
                <!-- 📍 កែប្រែ Link ទីនេះ ឱ្យវាទាញយកពី Local (public disk) វិញ -->
                <a href="{{ asset('storage/' . $enrollment->pdf_file) }}" 
                    target="_blank" class="group inline-flex items-center gap-4 bg-[#e06d64] text-white font-bold px-8 py-4 md:py-5 rounded-full shadow-[0_10px_30px_rgba(224,109,100,0.3)] hover:bg-[#c95b53] hover:shadow-[0_15px_40px_rgba(224,109,100,0.4)] hover:-translate-y-1 transition-all duration-300 uppercase tracking-widest text-sm md:text-base w-full sm:w-auto justify-center">
                    <span>Download Form</span>
                    
                    <!-- Icon ព្រួញទាញចុះ ដែលមានចលនាពេល Hover -->
                    <span class="bg-white/20 p-2.5 rounded-full transition-transform duration-300 group-hover:translate-y-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                    </span>
                </a>
            @endif
        </div>
        
    </div>
</section>

@endsection