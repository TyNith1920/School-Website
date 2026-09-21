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

    {{-- 🌟 ១. CINEMATIC HERO GATEWAY WITH METALLIC GOLD WAVE --}}
    <section class="relative isolate min-h-[580px] md:min-h-[720px] overflow-hidden bg-[#061238] flex items-center justify-center text-white">
        
        {{-- Background Video / Image --}}
        @if($bannerVideo)
            <video autoplay loop muted playsinline class="absolute inset-0 h-full w-full object-cover">
                <source src="{{ $bannerVideo }}" type="video/mp4">
            </video>
        @elseif($bannerImage)
            <img src="{{ $bannerImage }}" alt="LIS Banner" class="absolute inset-0 h-full w-full object-cover object-center scale-105 transition-transform duration-1000">
        @else
            <img src="https://images.unsplash.com/photo-1541829070764-84a7d30dd3f3?q=80&w=2069&auto=format&fit=crop" class="absolute inset-0 h-full w-full object-cover">
        @endif

        {{-- Cinematic Vignette Overlay --}}
        <div class="absolute inset-0 bg-[#061238]/75 backdrop-blur-[1px] z-10"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#061238] via-transparent to-[#061238]/80 z-10"></div>

        {{-- Glowing Orbs --}}
        <div class="absolute -top-20 left-1/4 h-80 w-80 rounded-full bg-amber-500/20 blur-3xl pointer-events-none z-10"></div>
        <div class="absolute bottom-20 right-1/4 h-80 w-80 rounded-full bg-blue-500/20 blur-3xl pointer-events-none z-10"></div>

        {{-- Hero Content --}}
        <div class="relative z-20 mx-auto max-w-5xl px-6 pt-20 pb-36 md:pb-44 text-center">
            
            <div data-aos="fade-down" class="mb-6 inline-flex items-center gap-2.5 rounded-full border border-amber-300/30 bg-amber-400/10 px-5 py-2 text-xs md:text-sm font-black uppercase tracking-[0.25em] text-amber-300 backdrop-blur-md shadow-lg">
                <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                {{ __('Life International School • Sihanoukville') }}
            </div>

            <h1 data-aos="fade-up" data-aos-delay="100" class="text-4xl sm:text-6xl md:text-7xl lg:text-8xl font-black uppercase tracking-tight leading-[1.05] drop-shadow-2xl">
                {{ __($banner->title ?? 'Truth • Integrity • Love') }}
            </h1>

            <div data-aos="zoom-in" data-aos-delay="200" class="mx-auto mt-5 mb-6 h-1.5 w-24 rounded-full bg-gradient-to-r from-amber-400 to-orange-500 shadow-[0_0_20px_rgba(251,191,36,0.8)]"></div>

            <p data-aos="fade-up" data-aos-delay="300" class="mx-auto max-w-2xl text-base sm:text-lg md:text-xl font-light leading-relaxed text-blue-100/95 drop-shadow">
                {{ __('Equipping future generations with world-class academic excellence, authentic Christian values, and a global perspective.') }}
            </p>

            {{-- Action CTAs --}}
            <div data-aos="fade-up" data-aos-delay="400" class="mt-10 flex flex-wrap items-center justify-center gap-4">
                <a href="/enrollment" class="inline-flex items-center gap-3 rounded-xl bg-gradient-to-r from-amber-400 to-orange-500 px-8 py-4 text-xs sm:text-sm font-black uppercase tracking-wider text-slate-950 shadow-xl hover:from-amber-300 hover:to-orange-400 hover:-translate-y-1 transition-all duration-300">
                    <span>{{ __('Admissions & Enrollment') }}</span>
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
                <a href="/contact-us" class="inline-flex items-center gap-2.5 rounded-xl border border-white/25 bg-white/10 px-8 py-4 text-xs sm:text-sm font-bold uppercase tracking-wider text-white backdrop-blur-md hover:bg-white/20 transition-all">
                    <span>{{ __('Campus Tour & Inquiries') }}</span>
                </a>
            </div>

        </div>

        {{-- Metallic Gold Wave Transition --}}
        <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none z-20 pointer-events-none">
            <svg class="relative block w-full h-16 sm:h-20 md:h-28" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="homeGoldWave" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#b45309" />
                        <stop offset="25%" stop-color="#f59e0b" />
                        <stop offset="50%" stop-color="#fde047" />
                        <stop offset="75%" stop-color="#f59e0b" />
                        <stop offset="100%" stop-color="#d97706" />
                    </linearGradient>
                </defs>
                <path d="M0,0 C160,85 380,-15 640,40 C890,95 1060,15 1200,50 L1200,120 L0,120 Z" fill="url(#homeGoldWave)"></path>
                <path d="M0,28 C200,85 450,22 700,58 C940,95 1100,32 1200,50 L1200,120 L0,120 Z" fill="#f8fafc"></path>
            </svg>
        </div>
    </section>

    {{-- 🌟 ២. INSTITUTIONAL HIGHLIGHTS & WHY CHOOSE US BENTO --}}
    <section class="max-w-7xl mx-auto px-6 py-16 md:py-24">
        
        <div data-aos="fade-up" class="text-center max-w-3xl mx-auto mb-16">
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

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @if(isset($whyChooseUs) && count($whyChooseUs) > 0)
                @foreach($whyChooseUs as $index => $feature)
                    <div data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 100 }}"
                         class="group relative overflow-hidden rounded-[2rem] bg-white border border-slate-200/90 p-8 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">
                        
                        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-amber-400 to-orange-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>

                        <div>
                            <div class="w-16 h-16 rounded-2xl bg-amber-50 group-hover:bg-[#081747] text-[#081747] group-hover:text-amber-400 flex items-center justify-center mb-6 transition-colors shadow-sm">
                                @if($feature->image)
                                    <img src="{{ $getImageUrl($feature->image, $defaultImage) }}" class="w-9 h-9 object-contain">
                                @else
                                    <span class="text-xl font-black">LIS</span>
                                @endif
                            </div>

                            <h3 class="text-lg font-black text-[#081747] uppercase tracking-wide group-hover:text-orange-500 transition-colors">
                                {{ __($feature->title) }}
                            </h3>

                            <p class="mt-3 text-sm text-slate-500 leading-relaxed font-normal">
                                {{ __($feature->description) }}
                            </p>
                        </div>

                        <div class="mt-6 pt-4 border-t border-slate-100 text-xs font-bold text-amber-600 uppercase tracking-widest">
                            LIS Standard
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-4 rounded-3xl border border-dashed border-slate-300 bg-white p-12 text-center text-slate-500">
                    {{ __('Please configure "Why Choose Us" features in the admin dashboard.') }}
                </div>
            @endif
        </div>

    </section>

    {{-- 🌟 ៣. ADMISSIONS CALLOUT BANNER (LUXURY CONTRAST) --}}
    <section class="max-w-7xl mx-auto px-6 mb-20">
        <div class="relative overflow-hidden rounded-[2.5rem] bg-gradient-to-br from-[#081747] via-[#0d276b] to-[#122e7a] text-white p-8 sm:p-12 lg:p-16 shadow-2xl">
            
            {{-- Background Decors --}}
            <div class="absolute -right-20 -top-20 h-80 w-80 rounded-full bg-amber-400/20 blur-3xl pointer-events-none"></div>
            <div class="absolute -left-20 -bottom-20 h-80 w-80 rounded-full bg-blue-400/20 blur-3xl pointer-events-none"></div>

            <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <div class="lg:col-span-7">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/20 text-amber-300 text-xs font-black uppercase tracking-widest mb-5">
                        {{ __('Admissions Open') }}
                    </div>

                    <h2 class="text-3xl sm:text-5xl font-black uppercase tracking-tight leading-tight">
                        {{ __($admission->title ?? 'Begin Your Journey at LIS') }}
                    </h2>

                    <p class="mt-5 text-base sm:text-lg text-blue-100/90 leading-relaxed font-light max-w-xl">
                        {{ __($admission->description ?? 'Explore our admissions process and let us guide you through joining our international school family in Sihanoukville.') }}
                    </p>

                    <div class="mt-8 flex flex-wrap items-center gap-4">
                        <a href="/enrollment" class="inline-flex items-center gap-3 bg-gradient-to-r from-amber-400 to-orange-500 hover:from-amber-300 hover:to-orange-400 text-slate-950 px-8 py-4 rounded-xl text-xs sm:text-sm font-black uppercase tracking-wider shadow-lg hover:-translate-y-0.5 transition-all">
                            <span>{{ __($admission->button_text ?? 'Apply Now') }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        <a href="/tuition-fees" class="inline-flex items-center gap-2 border border-white/30 bg-white/10 hover:bg-white/20 text-white px-7 py-4 rounded-xl text-xs sm:text-sm font-bold uppercase tracking-wider backdrop-blur-sm transition-all">
                            <span>{{ __('Tuition & Fees') }}</span>
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-5 flex justify-center">
                    <div class="relative w-64 h-64 sm:w-80 sm:h-80 rounded-[2.5rem] overflow-hidden border-4 border-white/20 shadow-2xl rotate-2 hover:rotate-0 transition-transform duration-500">
                        <img src="{{ $getImageUrl($admission->image ?? null, $defaultImage) }}" class="h-full w-full object-cover">
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- 🌟 ៤. RECENT NEWS & HAPPENINGS --}}
    <section class="bg-white border-y border-slate-200 py-16 md:py-24 px-6" x-data="{ imgModal: false, imgModalSrc: '', modalTitle: '', modalDesc: '' }">
        <div class="max-w-7xl mx-auto">
            
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12">
                <div>
                    <span class="text-xs font-black uppercase tracking-widest text-amber-600">{{ __('Campus Stories') }}</span>
                    <h2 class="text-3xl sm:text-5xl font-black uppercase tracking-tight text-[#081747] mt-1">
                        {{ __('Recent News & Events') }}
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
                                    <span class="text-[11px] font-bold uppercase tracking-wider text-amber-600">{{ __('Article') }}</span>
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

        {{-- News Modal --}}
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

    {{-- 🌟 ៥. STUDENT LIFE IMMERSIVE STRIP --}}
    <section class="relative overflow-hidden bg-gradient-to-r from-amber-500 to-orange-500 py-20 px-6 text-white text-center">
        <div class="relative z-10 max-w-4xl mx-auto">
            <span class="inline-block text-xs font-black uppercase tracking-[0.25em] text-amber-100 mb-3">
                {{ __('Beyond Academics') }}
            </span>
            <h2 class="text-3xl sm:text-5xl font-black uppercase tracking-tight leading-tight">
                {{ __('Discover Student Life at LIS') }}
            </h2>
            <p class="mt-4 text-base sm:text-lg text-amber-50 max-w-2xl mx-auto leading-relaxed font-light">
                {{ __('Life International School offers amazing classes and enrichment activities with teachers from across the globe, nurturing love, joy, and lifelong character.') }}
            </p>
            <div class="mt-8">
                <a href="/student-life" class="inline-flex items-center gap-3 bg-[#081747] hover:bg-slate-950 text-white px-8 py-4 rounded-xl text-xs sm:text-sm font-black uppercase tracking-wider shadow-xl transition-all hover:-translate-y-0.5">
                    <span>{{ __('Explore Student Life') }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- 🌟 ៦. MODERN MINIMALIST FAQS --}}
    <section class="max-w-4xl mx-auto px-6 py-20">
        <div class="text-center mb-12">
            <span class="text-xs font-black uppercase tracking-widest text-amber-600">{{ __('Questions & Answers') }}</span>
            <h2 class="text-3xl sm:text-4xl font-black uppercase text-[#081747] mt-1">{{ __('Frequently Asked Questions') }}</h2>
        </div>

        <div class="space-y-4">
            @if(isset($faqs) && count($faqs) > 0)
                @foreach($faqs as $index => $faq)
                    <details data-aos="fade-up" data-aos-delay="{{ ($index % 5) * 80 }}"
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