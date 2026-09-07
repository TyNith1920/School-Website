@extends('layout')

@section(
    'title',
    $activity->title . ' - Student Life Gallery - Life International School'
)

@section('content')

@php
    $rawImages = $activity->gallery_images;

    if (is_array($rawImages)) {
        $storedImages = $rawImages;
    } elseif (is_string($rawImages)) {
        $storedImages = json_decode($rawImages, true) ?? [];
    } else {
        $storedImages = [];
    }

    $galleryImages = collect($storedImages)
        ->filter()
        ->map(fn ($image) => asset('storage/' . $image))
        ->values()
        ->all();
@endphp

{{-- Detail hero --}}
<section class="relative isolate min-h-[430px] overflow-hidden bg-slate-950 md:min-h-[500px]">
    @if($activity->image)
        <img
            src="{{ Storage::url($activity->image) }}"
            alt="{{ $activity->title }}"
            class="absolute inset-0 h-full w-full object-cover"
        >
    @endif

    <div class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-slate-950/70 to-slate-950/20"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/50 via-transparent to-transparent"></div>

    <div class="relative z-10 mx-auto flex min-h-[430px] max-w-7xl items-center px-6 py-16 md:min-h-[500px] md:px-10">
        <div class="max-w-3xl">
            {{-- Back link --}}
            <a
                data-aos="fade-down"
                href="{{ url('/student-life') }}"
                class="mb-7 inline-flex items-center gap-2 rounded-full border border-white/25 bg-white/10 px-5 py-2.5 text-sm font-bold text-white backdrop-blur-sm transition-colors hover:bg-white hover:text-blue-950"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Student Life
            </a>

            <div data-aos="fade-up" data-aos-delay="100" class="mb-4 flex items-center gap-3">
                <span class="h-1 w-12 rounded-full bg-orange-500"></span>
                <span class="text-sm font-bold uppercase tracking-[0.2em] text-orange-400">
                    Student Life Gallery
                </span>
            </div>

            <h1 data-aos="fade-up" data-aos-delay="200" class="text-4xl font-black uppercase leading-tight tracking-wide text-white drop-shadow-lg md:text-6xl">
                {{ $activity->title }}
            </h1>

            @if($activity->description)
                <p data-aos="fade-up" data-aos-delay="300" class="mt-5 max-w-2xl text-base leading-7 text-slate-200 md:text-lg">
                    {{ $activity->description }}
                </p>
            @endif

            <div data-aos="fade-up" data-aos-delay="400" class="mt-8 flex flex-wrap items-center gap-4">
                @if($activity->link)
                    <a
                        href="{{ $activity->link }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-3 rounded-xl bg-orange-500 px-7 py-4 text-sm font-bold uppercase tracking-wider text-white shadow-lg transition-all duration-300 hover:-translate-y-1 hover:bg-orange-600 hover:shadow-xl"
                    >
                        View on Facebook
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6m0 0v6m0-6L10 16M7 7H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2"></path>
                        </svg>
                    </a>
                @endif

                <div class="inline-flex items-center gap-2 rounded-xl border border-white/25 bg-white/10 px-5 py-4 text-sm font-bold text-white backdrop-blur-sm">
                    <svg class="h-5 w-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16l4-4a2 2 0 012.8 0l2.2 2.2 2-2a2 2 0 012.8 0L21 15.4M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    {{ count($galleryImages) }}
                    {{ count($galleryImages) === 1 ? 'Photo' : 'Photos' }}
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Gallery --}}
<section class="bg-slate-50 px-5 py-16 md:px-8 md:py-20">
    <div class="mx-auto max-w-7xl">
        <div class="mb-12 flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
            <div data-aos="fade-right">
                <div class="mb-3 flex items-center gap-3">
                    <span class="h-1 w-10 rounded-full bg-orange-500"></span>
                    <span class="text-sm font-bold uppercase tracking-[0.18em] text-orange-500">
                        Memorable Moments
                    </span>
                </div>

                <h2 class="text-3xl font-black text-[#081747] md:text-4xl">
                    Photo Gallery
                </h2>

                <p class="mt-3 text-slate-600">
                    Click any photo to view it in full screen.
                </p>
            </div>

            <div data-aos="fade-left" class="inline-flex w-fit items-center rounded-full border border-blue-100 bg-white px-5 py-2.5 text-sm font-bold text-blue-900 shadow-sm">
                {{ count($galleryImages) }}
                {{ count($galleryImages) === 1 ? 'Image' : 'Images' }}
            </div>
        </div>

        @if(count($galleryImages) > 0)
            <div class="columns-1 gap-5 sm:columns-2 lg:columns-3">
                @foreach($galleryImages as $index => $image)
                    <button
                        data-aos="zoom-in"
                        data-aos-delay="{{ ($index % 3) * 150 }}"
                        type="button"
                        onclick="openStudentLightbox({{ $index }})"
                        class="group relative mb-5 block w-full break-inside-avoid overflow-hidden rounded-2xl bg-slate-200 text-left shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                    >
                        <img
                            src="{{ $image }}"
                            alt="{{ $activity->title }} photo {{ $index + 1 }}"
                            loading="lazy"
                            class="h-auto w-full object-cover transition-transform duration-700 group-hover:scale-105"
                        >

                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>

                        <div class="absolute bottom-4 left-4 translate-y-3 text-sm font-bold text-white opacity-0 transition-all duration-300 group-hover:translate-y-0 group-hover:opacity-100">
                            Photo {{ $index + 1 }}
                        </div>

                        <div class="absolute bottom-4 right-4 flex h-11 w-11 scale-75 items-center justify-center rounded-full bg-orange-500 text-white opacity-0 shadow-lg transition-all duration-300 group-hover:scale-100 group-hover:opacity-100">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5.2-5.2m2.2-5.3a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0zM10.5 7.5v6m-3-3h6"></path>
                            </svg>
                        </div>
                    </button>
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
                    No gallery photos yet
                </h3>

                <p class="mt-3 text-slate-500">
                    Photos for this activity will be available soon.
                </p>
            </div>
        @endif
    </div>
</section>

{{-- Lightbox --}}
@if(count($galleryImages) > 0)
    <div
        id="studentLightbox"
        class="fixed inset-0 z-[150] hidden items-center justify-center bg-slate-950/95 p-4 opacity-0 backdrop-blur-md transition-opacity duration-300"
        aria-hidden="true"
    >
        <button
            type="button"
            onclick="closeStudentLightbox()"
            aria-label="Close gallery"
            class="absolute right-4 top-4 z-20 flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-white transition-colors hover:bg-red-600 md:right-8 md:top-6"
        >
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        @if(count($galleryImages) > 1)
            <button
                type="button"
                onclick="changeStudentPhoto(-1)"
                aria-label="Previous photo"
                class="absolute left-3 z-20 flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-white transition-colors hover:bg-orange-500 md:left-8 md:h-14 md:w-14"
            >
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            <button
                type="button"
                onclick="changeStudentPhoto(1)"
                aria-label="Next photo"
                class="absolute right-3 z-20 flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-white transition-colors hover:bg-orange-500 md:right-8 md:h-14 md:w-14"
            >
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        @endif

        <div id="studentLightboxContent" class="relative flex max-h-[90vh] max-w-[90vw] scale-95 items-center justify-center transition-transform duration-300">
            <img
                id="studentLightboxImage"
                src=""
                alt="{{ $activity->title }}"
                class="max-h-[85vh] max-w-full rounded-xl object-contain shadow-2xl"
            >
            <div id="studentLightboxCounter" class="absolute bottom-4 right-4 rounded-full bg-slate-950/70 px-4 py-2 text-sm font-bold text-white backdrop-blur-sm"></div>
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
        if (!studentGalleryImages.length) {
            return;
        }

        studentLightboxImage.src = studentGalleryImages[currentStudentPhoto];
        studentLightboxCounter.textContent = `${currentStudentPhoto + 1} / ${studentGalleryImages.length}`;
    }

    function openStudentLightbox(index) {
        if (!studentLightbox) {
            return;
        }

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
        if (!studentLightbox) {
            return;
        }

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
        studentLightbox.addEventListener('click', function (event) {
            if (event.target === studentLightbox) {
                closeStudentLightbox();
            }
        });
    }

    document.addEventListener('keydown', function (event) {
        if (!studentLightbox || studentLightbox.classList.contains('hidden')) {
            return;
        }

        if (event.key === 'Escape') {
            closeStudentLightbox();
        }

        if (event.key === 'ArrowLeft') {
            changeStudentPhoto(-1);
        }

        if (event.key === 'ArrowRight') {
            changeStudentPhoto(1);
        }
    });
</script>

@endsection