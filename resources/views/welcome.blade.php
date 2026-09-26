@extends('layout')

@section('title', __('Home - Life International School'))

@section('content')

@php
    $getImageUrl = function($path, $fallback = null) use (&$getImageUrl) {
        if (!$path) return $fallback;
        if (is_array($path)) {
            $first = reset($path);
            return $getImageUrl($first, $fallback);
        }
        if (is_string($path) && (str_starts_with($path, '[') || str_starts_with($path, '{'))) {
            $decoded = json_decode($path, true);
            if (is_array($decoded)) {
                $first = reset($decoded);
                return $getImageUrl($first, $fallback);
            }
        }
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }
        try {
            return \Storage::disk('s3')->url($path);
        } catch (\Exception $e) {
            return asset('storage/' . $path);
        }
    };

    $bannerImage = $banner && $banner->image ? $getImageUrl($banner->image, null) : null;
    $bannerVideo = $banner && $banner->video ? $getImageUrl($banner->video, null) : null;
    $defaultImage = 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop';
@endphp

<div class="min-h-screen bg-[#f8fafc] text-slate-800 selection:bg-amber-400 selection:text-slate-950">

    {{-- 🌟 ១. HERO BANNER (វីដេអូបង្ហាញពេញលេញ Full Cover & អក្សររត់ឆ្វេងមិនបាំងមុខសិស្ស) --}}
    <section class="relative isolate w-full h-[75vh] min-h-[560px] md:h-[88vh] md:min-h-[640px] overflow-hidden bg-black flex items-center text-white">
        
        {{-- Background Video ឬ Image (លាតពេញផ្ទៃ ១០០%) --}}
        @if($bannerVideo)
            <video autoplay loop muted playsinline class="absolute inset-0 h-full w-full object-cover object-center pointer-events-none">
                <source src="{{ $bannerVideo }}" type="video/mp4">
            </video>
        @elseif($bannerImage)
            <img src="{{ $bannerImage }}" alt="LIS Banner" class="absolute inset-0 h-full w-full object-cover object-center pointer-events-none">
        @else
            <img src="https://images.unsplash.com/photo-1541829070764-84a7d30dd3f3?q=80&w=2069&auto=format&fit=crop" class="absolute inset-0 h-full w-full object-cover pointer-events-none">
        @endif

        {{-- Dark Gradient Overlay បាំងបន្តិចដើម្បីឱ្យអក្សរច្បាស់ស្អាត --}}
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent pointer-events-none z-10"></div>

        {{-- ខ្លឹមសាររត់មកខាងឆ្វេងពេញអេក្រង់ មិនគាបមកកណ្តាល --}}
        <div class="relative z-20 w-full px-6 sm:px-10 lg:px-16 pt-16 pb-28 md:pb-32 flex flex-col items-start text-left">
            <div class="max-w-xl md:max-w-2xl">
            
            <div class="max-w-xl md:max-w-2xl">
                {{-- Small Badge --}}
                <div data-aos="fade-down" class="mb-4 inline-flex items-center gap-2 rounded-full border border-amber-300/60 bg-black/60 px-4 py-1.5 text-[11px] sm:text-xs font-black uppercase tracking-[0.2em] text-amber-300 backdrop-blur-md shadow-2xl">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                    {{ __('LIFE INTERNATIONAL SCHOOL • SIHANOUKVILLE') }}
                </div>

              {{-- Title (ប្រើ xl:whitespace-nowrap និងសម្រួលទំហំអក្សរឱ្យនៅមួយជួរស្អាត) --}}
                <h1 data-aos="fade-up" data-aos-delay="100" class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-black uppercase tracking-tight leading-tight text-white drop-shadow-[0_4px_16px_rgba(0,0,0,1)] xl:whitespace-nowrap">
                    {{ __($banner->title ?? 'TRUTH | INTEGRITY | LOVE') }}
                </h1>

                <div data-aos="zoom-in" data-aos-delay="200" class="mt-3 mb-5 h-1.5 w-20 rounded-full bg-gradient-to-r from-amber-400 to-orange-500 shadow-[0_0_20px_rgba(251,191,36,0.9)]"></div>

                <p data-aos="fade-up" data-aos-delay="300" class="text-sm sm:text-base font-bold leading-relaxed text-white drop-shadow-[0_2px_8px_rgba(0,0,0,1)] max-w-xl">
                    {{ __('Equipping future generations with world-class academic excellence, authentic Christian values, and a global perspective.') }}
                </p>

                {{-- Action Buttons --}}
                <div data-aos="fade-up" data-aos-delay="400" class="mt-8 flex flex-wrap items-center gap-3.5">
                    <a href="/enrollment" class="inline-flex items-center gap-2.5 rounded-xl bg-gradient-to-r from-amber-400 to-orange-500 px-6 sm:px-7 py-3.5 text-xs sm:text-sm font-black uppercase tracking-wider text-slate-950 shadow-2xl hover:from-amber-300 hover:to-orange-400 hover:-translate-y-0.5 transition-all">
                        <span>{{ __('ADMISSIONS & ENROLLMENT') }}</span>
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="/contact-us" class="inline-flex items-center gap-2.5 rounded-xl border border-white/40 bg-black/60 px-6 sm:px-7 py-3.5 text-xs sm:text-sm font-bold uppercase tracking-wider text-white backdrop-blur-md hover:bg-black/80 hover:border-amber-400 transition-all shadow-2xl">
                        <span>{{ __('CAMPUS TOUR & INQUIRIES') }}</span>
                    </a>
                </div>
            </div>

        </div>

        {{-- 🌟 បន្ទាត់ពណ៌មាស នៅបាតក្រោមបង្អស់ (Bottom-0) --}}
        <div class="absolute inset-x-0 bottom-0 w-full h-2 sm:h-2.5 bg-gradient-to-r from-amber-600 via-amber-300 via-yellow-400 to-amber-600 z-30 shadow-[0_-2px_10px_rgba(245,158,11,0.5)]"></div>
    </section>

    {{-- 🌟 ២. ផ្នែក ADMISSIONS --}}
    <section class="max-w-7xl mx-auto px-6 pt-10 pb-16">
        <div class="relative overflow-hidden rounded-[2.5rem] bg-white border border-slate-200/90 shadow-[0_20px_50px_rgba(15,23,42,0.06)] p-8 sm:p-12 lg:p-16">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
                
                {{-- Text Content --}}
                <div class="lg:col-span-7">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-50 border border-amber-200 text-amber-700 text-xs font-black uppercase tracking-widest mb-4">
                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                        {{ __('JOIN OUR FAMILY') }}
                    </div>

                    <h2 class="text-3xl sm:text-5xl font-black uppercase tracking-tight text-[#081747] leading-tight">
                        {{ __($admission->title ?? 'ADMISSIONS') }}
                    </h2>

                    <div class="mt-3 mb-5 h-1.5 w-16 rounded-full bg-gradient-to-r from-amber-400 to-orange-500"></div>

                    <p class="text-base sm:text-lg text-slate-600 font-normal leading-relaxed max-w-xl">
                        {{ __($admission->description ?? 'Explore our admissions process, and let us guide you as you begin your transition into Life International School.') }}
                    </p>

                    <div class="mt-8 flex flex-wrap items-center gap-4">
                        <a href="/enrollment" class="inline-flex items-center gap-3 bg-[#081747] hover:bg-orange-500 text-white px-8 py-4 rounded-xl text-xs sm:text-sm font-black uppercase tracking-wider shadow-md hover:-translate-y-0.5 transition-all">
                            <span>{{ __($admission->button_text ?? 'APPLY NOW') }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        <a href="/tuition-fees" class="inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-800 px-6 py-4 rounded-xl text-xs sm:text-sm font-bold uppercase tracking-wider transition-all">
                            <span>{{ __('Tuition & Fees') }}</span>
                        </a>
                    </div>
                </div>

                {{-- Clean Frame Image --}}
                <div class="lg:col-span-5 flex justify-center">
                    <div class="relative w-64 h-64 sm:w-80 sm:h-80 md:w-[380px] md:h-[380px] overflow-hidden rounded-[2.5rem] border-4 border-slate-100 shadow-2xl transition-transform duration-700 hover:scale-105">
                        <img src="{{ $getImageUrl($admission->image ?? null, $defaultImage) }}" class="h-full w-full object-cover">
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- 🌟 ៣. ផ្នែក RECENT NEWS (ទូលាយតាមអេក្រង់ធំ និងមាន Padding សមាមាត្រ) --}}
    <section class="bg-white border-y border-slate-200/80 py-16 md:py-24 px-6 sm:px-10 lg:px-16" x-data="{ imgModal: false, imgModalSrc: '', modalTitle: '', modalDesc: '' }">
        <div class="max-w-[1600px] w-full mx-auto">
            
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12">
                <div>
                    <span class="text-xs font-black uppercase tracking-widest text-amber-600">{{ __('Campus Stories') }}</span>
                    <h2 class="text-3xl sm:text-5xl font-black uppercase tracking-tight text-[#081747] mt-1">
                        {{ __('Recent News') }}
                    </h2>
                </div>
                <a href="/news-events" class="inline-flex items-center gap-2 text-xs sm:text-sm font-black uppercase tracking-wider text-[#081747] hover:text-orange-500 transition-colors">
                    <span>{{ __('View All Stories') }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @if(isset($news) && count($news) > 0)
                    @foreach($news as $index => $item)
                        @php
                            $newsImg = $getImageUrl($item->image, $defaultImage);
                            $cleanDesc = strip_tags($item->description ?? '');
                        @endphp
                        <article data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 100 }}" 
                                 class="group flex flex-col justify-between overflow-hidden rounded-[2rem] bg-slate-50 border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 cursor-pointer"
                                 @click="imgModalSrc = '{{ $newsImg }}'; 
                                         modalTitle = {{ json_encode(__($item->title)) }}; 
                                         modalDesc = {{ json_encode($cleanDesc) }}; 
                                         imgModal = true">

                            <div>
                                <div class="relative aspect-[16/10] overflow-hidden bg-slate-200">
                                    <img src="{{ $newsImg }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                </div>

                                <div class="p-6">
                                    <span class="text-[11px] font-bold uppercase tracking-wider text-amber-600">{{ __('News Release') }}</span>
                                    <h3 class="font-black text-[#081747] group-hover:text-orange-500 text-base sm:text-lg mt-1 mb-2 line-clamp-2 transition-colors">
                                        {{ __($item->title) }}
                                    </h3>
                                    <p class="text-xs text-slate-500 line-clamp-3 leading-relaxed font-normal">
                                        {{ $cleanDesc }}
                                    </p>
                                </div>
                            </div>

                            <div class="px-6 pb-6 pt-2">
                                <span class="text-xs font-black uppercase tracking-wider text-[#081747] group-hover:text-orange-500 inline-flex items-center gap-1.5">
                                    {{ __('Read Story') }} →
                                </span>
                            </div>

                        </article>
                    @endforeach
                @endif
            </div>

        </div>

        {{-- Modal Lightbox --}}
        <template x-teleport="body">
            <div x-show="imgModal" x-transition.opacity.duration.300ms class="fixed inset-0 z-[9999] bg-black/85 flex items-center justify-center p-4 md:p-10" @click="imgModal = false" style="display: none;">
                <button @click="imgModal = false" class="absolute top-5 right-5 text-white hover:text-amber-400 transition z-50">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                <div class="bg-white rounded-[2.5rem] shadow-2xl max-w-3xl w-full max-h-[90vh] flex flex-col overflow-hidden relative" @click.stop>
                    <div class="w-full h-64 sm:h-80 md:h-[400px] bg-slate-900 shrink-0">
                        <img :src="imgModalSrc" class="w-full h-full object-cover">
                    </div>
                    <div class="p-8 overflow-y-auto">
                        <h3 class="text-xl sm:text-2xl md:text-3xl font-black text-[#081747] mb-4" x-text="modalTitle"></h3>
                        <p class="text-slate-600 text-sm md:text-base leading-relaxed whitespace-pre-wrap" x-text="modalDesc"></p>
                    </div>
                </div>
            </div>
        </template>
    </section>

    {{-- 🌟 ៤. ផ្នែក WHY CHOOSE LIS (ទូលាយតាមអេក្រង់ធំ) --}}
    <section class="max-w-[1600px] w-full mx-auto px-6 sm:px-10 lg:px-16 py-20 md:py-28">
        
        <div data-aos="fade-up" class="text-center max-w-3xl mx-auto mb-16 md:mb-20">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-50 border border-amber-200 text-amber-700 text-xs font-black uppercase tracking-widest mb-3">
                {{ __('Distinction & Values') }}
            </div>
            <h2 class="text-3xl sm:text-5xl font-black uppercase tracking-tight text-[#081747]">
                {{ __('Why Choose LIS') }}
            </h2>
            <p class="mt-4 text-base sm:text-lg text-slate-600 font-normal leading-relaxed">
                {{ __('An inspiring educational environment where every student is challenged, nurtured, and empowered to reach their highest potential.') }}
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 md:gap-12 text-center">
            @if(isset($whyChooseUs) && count($whyChooseUs) > 0)
                @foreach($whyChooseUs as $index => $feature)
                    <div data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 100 }}" class="group flex flex-col items-center">
                        <div class="mb-5 flex h-24 w-24 sm:h-28 sm:w-28 items-center justify-center rounded-3xl bg-slate-50 border border-slate-100 p-4 shadow-sm transition-all duration-300 group-hover:scale-110 group-hover:shadow-md group-hover:border-amber-200">
                            @if($feature->image)
                                <img src="{{ $getImageUrl($feature->image, $defaultImage) }}" class="h-16 w-16 sm:h-20 sm:w-20 object-contain">
                            @else
                                <span class="text-2xl font-black text-[#081747]">LIS</span>
                            @endif
                        </div>

                        <h3 class="text-base sm:text-lg font-black uppercase tracking-wide text-[#081747] transition-colors group-hover:text-orange-500">
                            {{ __($feature->title) }}
                        </h3>

                        <p class="mt-2.5 text-xs sm:text-sm leading-relaxed text-slate-500 font-normal max-w-xs">
                            {{ __($feature->description) }}
                        </p>
                    </div>
                @endforeach
            @else
                <div class="col-span-4 rounded-3xl border border-dashed border-slate-300 p-12 text-center text-slate-400">
                    {{ __('Please add "Why Choose Us" features from the Dashboard.') }}
                </div>
            @endif
        </div>

    </section>

    {{-- 🌟 ៥. ផ្នែក STUDENT LIFE BANNER (Full Width Background & ទូលាយល្មមអានស្រួល) --}}
    <section class="relative w-full overflow-hidden bg-gradient-to-r from-amber-500 to-orange-500 py-20 md:py-24 px-6 sm:px-10 lg:px-16 text-white text-center">
        <div class="relative z-10 max-w-5xl mx-auto">
            <span class="inline-block text-xs font-black uppercase tracking-[0.25em] text-amber-100 mb-3">
                {{ __('Beyond Academics') }}
            </span>
            <h2 class="text-3xl sm:text-5xl font-black uppercase tracking-tight leading-tight">
                {{ __('STUDENT LIFE') }}
            </h2>
            <p class="mt-4 text-base sm:text-lg text-amber-50 max-w-2xl mx-auto leading-relaxed font-light">
                {{ __('Life International School offers amazing classes in a variety of subjects with teachers from many countries all over the world. Our teachers teach their students to be full of love and joy.') }}
            </p>
            <div class="mt-8">
                <a href="/student-life" class="inline-flex items-center gap-3 bg-[#081747] hover:bg-slate-950 text-white px-8 py-4 rounded-xl text-xs sm:text-sm font-black uppercase tracking-wider shadow-xl transition-all hover:-translate-y-0.5">
                    <span>{{ __('MORE ABOUT STUDENT LIFE') }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- 🌟 ៦. ផ្នែក FAQS (រីកទូលាយសមាមាត្រលើអេក្រង់ធំ) --}}
    <section class="max-w-6xl w-full mx-auto px-6 sm:px-10 lg:px-16 py-20 md:py-28">
        <div class="text-center mb-12">
            <span class="text-xs font-black uppercase tracking-widest text-amber-600">{{ __('Questions & Answers') }}</span>
            <h2 class="text-3xl sm:text-4xl font-black uppercase text-[#081747] mt-1">{{ __('FAQs') }}</h2>
        </div>

        <div class="space-y-4">
            @if(isset($faqs) && count($faqs) > 0)
                @foreach($faqs as $faq)
                    <details data-aos="fade-up" data-aos-delay="{{ ($loop->index % 5) * 80 }}"
                             class="group rounded-2xl bg-white border border-slate-200/90 p-6 cursor-pointer shadow-xs transition-shadow hover:shadow-md">
                        <summary class="flex justify-between items-center font-black text-base sm:text-lg text-[#081747] list-none">
                            <span>{{ __($faq->question) }}</span>
                            <span class="ml-4 transition-transform group-open:rotate-180 text-amber-500 shrink-0">
                                <svg fill="none" height="20" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" viewBox="0 0 24 24" width="20"><polyline points="6 9 12 15 18 9"/></svg>
                            </span>
                        </summary>
                        <div class="mt-4 pt-4 border-t border-slate-100 text-sm text-slate-600 leading-relaxed font-normal prose prose-slate max-w-none">
                            {!! $faq->answer !!}
                        </div>
                    </details>
                @endforeach
            @else
                <p class="text-center text-slate-400 text-sm">{{ __('Please add FAQs from the Dashboard.') }}</p>
            @endif
        </div>
    </section>

</div>

@endsection