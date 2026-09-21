@extends('layout')

@section('title', $activity->title . ' - Student Life Gallery - Life International School')

@section('content')

@php
    // 📍 មុខងារទាញរូបភាពពី Cloudflare R2 (s3) គាំទ្រទាំង String និង Array
    $getMediaUrl = function($path) use (&$getMediaUrl) {
        if (empty($path)) return null;
        if (is_array($path)) {
            $first = reset($path);
            return $getMediaUrl($first);
        }
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) return$path;
        try { 
            return \Storage::disk('s3')->url($path); 
        } catch (\Exception $e) { 
            return asset('storage/' . $path); 
        }
    };

    $rawImages =$activity->gallery_images;

    if (is_array($rawImages)) {
        $storedImages =$rawImages;
    } elseif (is_string($rawImages)) {
        $storedImages = json_decode($rawImages, true) ?? [];
    } else {
        $storedImages = [];
    }

    $galleryImages = collect($storedImages)
        ->filter()
        ->map(fn ($image) => $getMediaUrl($image))
        ->values()
        ->all();
@endphp

<div class="min-h-screen bg-[#f8fafc] text-slate-800">

    {{-- 🎨 1. Top Navigation Bar (Sticky & Clean Glassmorphism) --}}
    <nav class="sticky top-0 z-30 border-b border-slate-200/80 bg-white/85 backdrop-blur-md transition-all py-4">
        <div class="mx-auto max-w-7xl px-5 md:px-8 flex items-center justify-between gap-4">
            
            {{-- Back Button --}}
            <a href="{{ url('/student-life') }}" 
               class="inline-flex items-center gap-2.5 px-4 py-2.5 rounded-2xl bg-slate-100 hover:bg-[#081747] text-slate-700 hover:text-white text-xs sm:text-sm font-bold transition-all duration-300 shadow-xs group">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span>Back to Student Life</span>
            </a>

            {{-- Action Pills --}}
            <div class="flex items-center gap-3">
                @if($activity->link)
                    <a href="{{ $activity->link }}" target="_blank" rel="noopener noreferrer" 
                       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-blue-50 hover:bg-blue-600 text-blue-700 hover:text-white text-xs sm:text-sm font-bold transition-all shadow-xs">
                        <span>Original Post</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                @endif

                <div class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-gradient-to-r from-amber-50 to-orange-50 text-amber-700 border border-amber-200/80 text-xs sm:text-sm font-black uppercase tracking-wider shadow-xs">
                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span>{{ count($galleryImages) }} High-Res Photos</span>
                </div>
            </div>

        </div>
    </nav>

    {{-- 🌟 2. Gallery Header Banner --}}
    <header class="relative overflow-hidden bg-white border-b border-slate-200 pt-12 pb-10">
        <div class="mx-auto max-w-7xl px-5 md:px-8">
            <div class="max-w-3xl">
                
                {{-- Category Pill --}}
                <div data-aos="fade-down" class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-50 border border-amber-200 text-amber-700 text-xs font-black uppercase tracking-widest mb-4">
                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-ping"></span>
                    Student Life Exhibition
                </div>

                {{-- Activity Title --}}
                <h1 data-aos="fade-up" data-aos-delay="100" class="text-3xl sm:text-5xl md:text-6xl font-black text-[#081747] uppercase tracking-tight leading-[1.1]">
                    {{ $activity->title }}
                </h1>

                <div data-aos="zoom-in" data-aos-delay="150" class="mt-4 mb-5 h-1.5 w-20 rounded-full bg-gradient-to-r from-amber-400 to-orange-500 shadow-sm"></div>

                @if($activity->description)
                    <p data-aos="fade-up" data-aos-delay="200" class="text-base sm:text-lg text-slate-600 leading-relaxed font-normal">
                        {{ $activity->description }}
                    </p>
                @endif

            </div>
        </div>
    </header>

    {{-- 📸 3. Photo Exhibition Grid (Masonry Columns) --}}
    <main class="mx-auto max-w-7xl px-5 md:px-8 py-12 md:py-16">
        @if(count($galleryImages) > 0)
            <div class="columns-1 sm:columns-2 lg:columns-3 gap-7 [column-fill:_balance] space-y-7">
                @foreach($galleryImages as $index =>$image)
                    <figure data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}"
                            onclick="openStudentLightbox({{ $index }})"
                            class="group relative break-inside-avoid overflow-hidden rounded-[2rem] bg-white border border-slate-200 shadow-sm hover:shadow-2xl transition-all duration-500 hover:-translate-y-1.5 cursor-pointer">
                        
                        {{-- Image Element --}}
                        <img src="{{ $image }}" 
                             alt="{{ $activity->title }} photo {{$index + 1 }}" 
                             class="h-auto w-full object-cover transition-transform duration-700 group-hover:scale-105"
                             loading="lazy">

                        {{-- Hover Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>

                        {{-- Photo Index Pill --}}
                        <div class="absolute bottom-5 left-5 text-white text-xs font-bold tracking-wider uppercase opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="inline-block bg-black/50 backdrop-blur-md px-3 py-1 rounded-full border border-white/20">
                                Image {{ $index + 1 }}
                            </span>
                        </div>

                        {{-- Zoom Button Icon --}}
                        <div class="absolute bottom-5 right-5 flex h-11 w-11 items-center justify-center rounded-2xl bg-amber-400 text-slate-950 shadow-xl opacity-0 group-hover:opacity-100 transition-all duration-300 scale-75 group-hover:scale-100">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-5.2-5.2m2.2-5.3a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0zM10.5 7.5v6m-3-3h6"/></svg>
                        </div>
                    </figure>
                @endforeach
            </div>
        @else
            {{-- Empty Gallery State --}}
            <div class="rounded-[2.5rem] border border-dashed border-slate-300 bg-white p-16 text-center shadow-sm">
                <div class="mx-auto w-16 h-16 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-2xl font-black text-[#081747]">No photos uploaded yet</h3>
                <p class="text-sm text-slate-500 mt-2">New gallery pictures from this activity will be added soon.</p>
            </div>
        @endif
    </main>

</div>

{{-- 🔍 4. Modern Cinematic Lightbox Modal --}}
@if(count($galleryImages) > 0)
    <div id="studentLightbox" 
         class="fixed inset-0 z-[150] hidden items-center justify-center bg-slate-950/95 p-4 opacity-0 backdrop-blur-md transition-opacity duration-300"
         aria-hidden="true">
        
        {{-- Close Button --}}
        <button type="button" 
                onclick="closeStudentLightbox()" 
                aria-label="Close" 
                class="absolute right-5 top-5 z-30 flex h-12 w-12 items-center justify-center rounded-full bg-white/10 hover:bg-amber-400 hover:text-slate-950 text-white transition-all shadow-lg">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        {{-- Next / Prev Buttons --}}
        @if(count($galleryImages) > 1)
            <button type="button" 
                    onclick="changeStudentPhoto(-1)" 
                    aria-label="Previous" 
                    class="absolute left-4 md:left-8 z-30 flex h-12 w-12 md:h-14 md:w-14 items-center justify-center rounded-full bg-white/10 hover:bg-amber-400 hover:text-slate-950 text-white transition-all shadow-lg">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </button>

            <button type="button" 
                    onclick="changeStudentPhoto(1)" 
                    aria-label="Next" 
                    class="absolute right-4 md:right-8 z-30 flex h-12 w-12 md:h-14 md:w-14 items-center justify-center rounded-full bg-white/10 hover:bg-amber-400 hover:text-slate-950 text-white transition-all shadow-lg">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </button>
        @endif

        {{-- Modal Image Box --}}
        <div id="studentLightboxContent" class="relative flex max-h-[90vh] max-w-[92vw] scale-95 items-center justify-center transition-transform duration-300">
            <img id="studentLightboxImage" src="" alt="{{ $activity->title }}" class="max-h-[85vh] max-w-full rounded-[2rem] object-contain shadow-2xl">
            <div id="studentLightboxCounter" class="absolute bottom-4 right-4 rounded-full bg-black/75 backdrop-blur-md px-4 py-1.5 text-xs font-black tracking-widest text-amber-300 shadow-lg border border-white/20"></div>
        </div>
    </div>
@endif

<script>
    const studentGalleryImages = @json($galleryImages);

    const studentLightbox = document.getElementById('studentLightbox');
    const studentLightboxContent = document.getElementById('studentLightboxContent');
    const studentLightboxImage = document.getElementById('studentLightboxImage');
    const studentLightboxCounter = document.getElementById('studentLightboxCounter');

    let currentStudentPhoto = 0;

    function showStudentPhoto() {
        if (!studentGalleryImages.length) return;
        studentLightboxImage.src = studentGalleryImages[currentStudentPhoto];
        studentLightboxCounter.textContent = `${currentStudentPhoto + 1} / ${studentGalleryImages.length}`;
    }

    function openStudentLightbox(index) {
        if (!studentLightbox) return;
        currentStudentPhoto = index;
        showStudentPhoto();

        studentLightbox.classList.remove('hidden');
        studentLightbox.classList.add('flex');
        studentLightbox.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';

        requestAnimationFrame(() => {
            studentLightbox.classList.remove('opacity-0');
            studentLightboxContent.classList.remove('scale-95');
            studentLightboxContent.classList.add('scale-100');
        });
    }

    function closeStudentLightbox() {
        if (!studentLightbox) return;
        studentLightbox.classList.add('opacity-0');
        studentLightboxContent.classList.remove('scale-100');
        studentLightboxContent.classList.add('scale-95');
        studentLightbox.setAttribute('aria-hidden', 'true');

        setTimeout(() => {
            studentLightbox.classList.add('hidden');
            studentLightbox.classList.remove('flex');
            document.body.style.overflow = '';
        }, 300);
    }

    function changeStudentPhoto(direction) {
        currentStudentPhoto = (currentStudentPhoto + direction + studentGalleryImages.length) % studentGalleryImages.length;
        showStudentPhoto();
    }

    if (studentLightbox) {
        studentLightbox.addEventListener('click', function(e) {
            if (e.target === studentLightbox) closeStudentLightbox();
        });
    }

    document.addEventListener('keydown', function(e) {
        if (!studentLightbox || studentLightbox.classList.contains('hidden')) return;
        if (e.key === 'Escape') closeStudentLightbox();
        if (e.key === 'ArrowLeft') changeStudentPhoto(-1);
        if (e.key === 'ArrowRight') changeStudentPhoto(1);
    });
</script>

@endsection