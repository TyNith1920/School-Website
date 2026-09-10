@extends('layout')

@section('title', 'Student Life - Life International School')

@section('content')

@php
    // 📍 មុខងារទាញរូបភាពពី Cloudinary ដោយសុវត្ថិភាព
    $getMediaUrl = function($path) {
        if (empty($path)) return null;
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) return $path;
        try { return \Storage::disk('cloudinary')->url($path); } 
        catch (\Exception $e) { return asset('storage/' . $path); }
    };
@endphp

{{-- Hero --}}
<section class="relative isolate flex min-h-[310px] items-center justify-center overflow-hidden bg-gradient-to-br from-[#081747] via-[#173c9c] to-[#2563eb] md:min-h-[380px]">
    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle, rgba(255,255,255,0.8) 1px, transparent 1px); background-size: 24px 24px;"></div>

    <div class="absolute -left-32 -top-32 h-80 w-80 rounded-full bg-blue-400/30 blur-3xl"></div>
    <div class="absolute -bottom-36 right-0 h-96 w-96 rounded-full bg-orange-400/20 blur-3xl"></div>

    <div class="relative z-10 mx-auto max-w-4xl px-6 py-16 text-center">
        <div data-aos="fade-down" class="mb-5 inline-flex items-center rounded-full border border-white/25 bg-white/10 px-5 py-2 text-sm font-semibold uppercase tracking-wider text-blue-50 backdrop-blur-sm">
            Beyond the Classroom
        </div>

        <h1 data-aos="fade-up" data-aos-delay="100" class="text-4xl font-black uppercase tracking-wide text-white drop-shadow-lg sm:text-5xl md:text-6xl">
            Student Life
        </h1>

        <div data-aos="zoom-in" data-aos-delay="200" class="mx-auto mt-6 h-1.5 w-24 rounded-full bg-orange-400 shadow-lg"></div>

        <p data-aos="fade-up" data-aos-delay="300" class="mx-auto mt-6 max-w-2xl text-base leading-relaxed text-blue-50/90 md:text-lg">
            Discover the activities, celebrations and experiences that make
            student life at LIS truly special.
        </p>
    </div>

    <div class="absolute -bottom-px left-0 h-10 w-full bg-slate-50 md:h-14" style="clip-path: polygon(0 70%, 100% 0, 100% 100%, 0 100%);"></div>
</section>

{{-- Main content --}}
<section class="bg-slate-50 px-5 py-16 md:px-8 md:py-20">
    <div class="mx-auto max-w-7xl">

        {{-- Heading --}}
        <div data-aos="fade-up" class="mx-auto mb-14 max-w-3xl text-center">
            <div class="mb-4 flex items-center justify-center gap-3">
                <span class="h-1 w-10 rounded-full bg-orange-500"></span>
                <span class="text-sm font-bold uppercase tracking-[0.18em] text-orange-500">
                    Explore Our Community
                </span>
                <span class="h-1 w-10 rounded-full bg-orange-500"></span>
            </div>

            <h2 class="text-3xl font-black leading-tight text-[#081747] md:text-4xl">
                Experience Life Beyond the Classroom
            </h2>

            <p class="mt-5 text-base leading-7 text-slate-600 md:text-lg">
                At Life International School, we believe in nurturing not just
                academic excellence, but also character, creativity and community.
                Discover the vibrant activities that make our school a second
                home for our students.
            </p>
        </div>

        {{-- Activity cards --}}
        @if(isset($activities) && count($activities) > 0)
            <div class="flex flex-wrap justify-center gap-8">
                @foreach($activities as $index => $activity)
                    @php
                        $rawImages = $activity->gallery_images;

                        if (is_array($rawImages)) {
                            $activityImages = $rawImages;
                        } elseif (is_string($rawImages)) {
                            $activityImages = json_decode($rawImages, true) ?? [];
                        } else {
                            $activityImages = [];
                        }

                        $photoCount = count($activityImages);
                    @endphp

                    <a
                        data-aos="fade-up"
                        data-aos-delay="{{ ($index % 3) * 150 }}"
                        href="{{ url('/student-life/' . $activity->id . '/gallery') }}"
                        class="group flex w-full max-w-[390px] flex-col overflow-hidden rounded-[24px] border border-slate-200 bg-white shadow-[0_10px_35px_rgba(15,23,42,0.08)] transition-all duration-300 hover:-translate-y-2 hover:border-blue-200 hover:shadow-[0_22px_50px_rgba(30,64,175,0.18)] sm:w-[calc(50%_-_1rem)] lg:w-[calc(33.333%_-_1.35rem)]"
                    >
                        {{-- Cover image --}}
                        <div class="relative aspect-[16/11] overflow-hidden bg-slate-100">
                            @if($activity->image)
                                <img
                                    src="{{ $getMediaUrl($activity->image) }}"
                                    alt="{{ $activity->title }}"
                                    loading="lazy"
                                    class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                                >
                            @else
                                <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-blue-100 to-slate-100">
                                    <svg class="h-16 w-16 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 16l4-4a2 2 0 012.8 0l2.2 2.2 2-2a2 2 0 012.8 0L21 15.4M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-[#081747]/80 via-transparent to-transparent opacity-60 transition-opacity duration-300 group-hover:opacity-80"></div>

                            {{-- Photo count --}}
                            <div class="absolute right-4 top-4 inline-flex items-center gap-2 rounded-full border border-white/30 bg-white/90 px-4 py-2 text-xs font-bold text-blue-900 shadow-lg backdrop-blur-md">
                                <svg class="h-4 w-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16l4-4a2 2 0 012.8 0l2.2 2.2 2-2a2 2 0 012.8 0L21 15.4M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $photoCount }}
                                {{ $photoCount === 1 ? 'Photo' : 'Photos' }}
                            </div>
                        </div>

                        {{-- Card content --}}
                        <div class="flex flex-grow flex-col p-6">
                            <div class="mb-3 flex items-center gap-2">
                                <span class="h-2 w-2 rounded-full bg-orange-500"></span>
                                <span class="text-xs font-bold uppercase tracking-wider text-blue-700">
                                    Student Activity
                                </span>
                            </div>

                            <h3 class="line-clamp-2 text-xl font-extrabold leading-snug text-[#081747] transition-colors duration-300 group-hover:text-blue-700">
                                {{ $activity->title }}
                            </h3>

                            @if($activity->description)
                                <p class="mt-3 line-clamp-3 text-sm leading-6 text-slate-600">
                                    {{ $activity->description }}
                                </p>
                            @else
                                <p class="mt-3 text-sm italic leading-6 text-slate-400">
                                    Explore photos from this student activity.
                                </p>
                            @endif

                            <div class="mt-6 flex items-center justify-between border-t border-slate-100 pt-5">
                                <span class="text-sm font-bold text-blue-800">
                                    View gallery
                                </span>

                                <span class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-50 text-blue-800 transition-all duration-300 group-hover:bg-orange-500 group-hover:text-white">
                                    <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div data-aos="fade-up" class="rounded-[28px] border border-dashed border-blue-200 bg-white px-6 py-20 text-center shadow-sm">
                <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-blue-50 text-blue-700">
                    <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 16l4-4a2 2 0 012.8 0l2.2 2.2 2-2a2 2 0 012.8 0L21 15.4M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>

                <h3 class="text-2xl font-bold text-blue-950">
                    No activities available yet
                </h3>

                <p class="mt-3 text-slate-500">
                    Please check again later for new student activities.
                </p>
            </div>
        @endif
        
    </div>
</section>

@endsection