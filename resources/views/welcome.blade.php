@extends('layout')
@section('title', __('Home - Life International School'))
@section('content')

@php
    // Helper function សម្រាប់ពិនិត្យមើល URL រូបភាព (បើជា Full URL ស្រាប់ ឬជា Path ក្នុង R2)
    $getImageUrl = function($path, $fallback) {
        if (!$path) return $fallback;
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }
        return \Storage::disk('s3')->url($path);
    };

    $bannerImage = $banner && $banner->image ? $getImageUrl($banner->image, null) : null;
    $bannerVideo = $banner && $banner->video ? $getImageUrl($banner->video, null) : null;
    $defaultImage = 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=2022&auto=format&fit=crop';
@endphp

<!-- ១. ផ្នែក Banner ខាងលើបង្អស់ (Responsive & No-Image Centered Video) -->
<div class="relative w-full min-h-[520px] md:min-h-[650px] overflow-hidden bg-[#0b1240] flex items-center py-12 md:py-0">

    <!-- Background Video / Image -->
    @if($bannerVideo)
        <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover">
            <source src="{{ $bannerVideo }}" type="video/mp4">
        </video>
    @elseif($bannerImage)
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $bannerImage }}');"></div>
    @else
        <div class="absolute inset-0 bg-[#0b1240]"></div>
    @endif

    <!-- Overlay (ស្រាលជាងមុនបន្តិច ដើម្បីឱ្យឃើញវីដេអូច្បាស់) -->
    <div class="absolute inset-0 bg-black/45 z-10"></div>

    <!-- Content -->
    <div class="relative z-20 max-w-7xl mx-auto w-full px-6 flex flex-col md:flex-row items-center {{ $bannerImage ? 'justify-between' : 'justify-center text-center' }} gap-8 md:gap-12">

        <!-- Title & Subtitle (ពេលគ្មានរូប អក្សររត់មកចំកណ្តាលពេញអេក្រង់) -->
        <div data-aos="fade-up" data-aos-duration="1000" class="w-full {{ $bannerImage ? 'md:w-3/5 text-left' : 'max-w-4xl mx-auto text-center' }}">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 border border-white/20 text-blue-100 text-xs font-bold uppercase tracking-widest mb-5 backdrop-blur-md">
                Life International School
            </div>
            
            <h1 class="text-3xl sm:text-5xl md:text-6xl font-black text-white drop-shadow-2xl tracking-wide uppercase leading-tight">
                {{ __($banner->title ?? 'Truth | Integrity | Love') }}
            </h1>
            
            <div class="h-1.5 w-24 bg-[#de8b8b] mt-6 rounded-full {{ $bannerImage ? '' : 'mx-auto' }}"></div>
        </div>

        <!-- Floating Frame Image (បង្ហាញតែពេលណាមានរូបភាពប៉ុណ្ណោះ) -->
        @if($bannerImage)
            <div data-aos="fade-left" data-aos-duration="1200" class="w-full md:w-2/5 flex justify-center md:justify-end shrink-0 mt-4 md:mt-0">
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-orange-500 to-amber-400 rounded-3xl blur opacity-30 group-hover:opacity-60 transition duration-500"></div>
                    <img src="{{ $bannerImage }}" class="relative w-56 h-56 sm:w-64 sm:h-64 lg:w-[360px] lg:h-[360px] object-cover rounded-3xl border-4 border-white/20 shadow-2xl md:rotate-3 group-hover:rotate-0 transition-transform duration-500">
                </div>
            </div>
        @endif
    </div>
</div>

<!-- ២. ផ្នែក ADMISSIONS (Responsive & No Text Cut-off) -->
<div class="py-16 sm:py-20 md:py-24 px-6 relative overflow-hidden" style="background: linear-gradient(135deg, #7a76ff 0%, #d4a5d8 50%, #facc15 100%);">
    <div class="max-w-7xl mx-auto flex flex-col-reverse md:flex-row items-center justify-between gap-10 md:gap-16 relative z-10">
        
        <!-- អត្ថបទ -->
        <div data-aos="fade-up" class="w-full md:w-1/2 text-white text-left">
            <div class="inline-block text-xs font-black uppercase tracking-widest text-yellow-200 mb-2">Join Our Family</div>
            <h2 class="text-3xl sm:text-4xl md:text-6xl font-black mb-4 sm:mb-6 uppercase tracking-wider drop-shadow-md">
                {{ __($admission->title ?? 'ADMISSIONS') }}
            </h2>
            <p class="text-base sm:text-lg md:text-xl mb-8 leading-relaxed font-medium text-white/95 max-w-xl">
                {{ __($admission->description ?? 'Explore our admissions process, and let us guide you as you begin your transition into Life international school.') }}
            </p>
            <a href="/enrollment" class="inline-flex items-center gap-3 bg-white text-[#7a76ff] hover:bg-[#0b1240] hover:text-white px-8 py-3.5 text-xs sm:text-sm font-black uppercase tracking-widest rounded-xl transition-all duration-300 shadow-xl hover:-translate-y-0.5">
                <span>{{ __($admission->button_text ?? 'APPLY NOW') }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

        <!-- រូបភាពរាងកោង Blob (ទំហំសមស្របលើ Mobile) -->
        <div data-aos="zoom-in" data-aos-delay="200" class="w-full md:w-1/2 relative flex justify-center items-center">
            <div class="relative w-64 h-64 sm:w-80 sm:h-80 md:w-[420px] md:h-[420px] overflow-hidden transition-transform duration-700 hover:scale-105" 
                 style="border-radius: 42% 58% 66% 34% / 43% 36% 64% 57%; box-shadow: 0 20px 50px rgba(0,0,0,0.2);">
                <img src="{{ $getImageUrl($admission->image ?? null, $defaultImage) }}" class="w-full h-full object-cover">
            </div>
        </div>
    </div>
</div>

<!-- ៣. ផ្នែក Recent News -->
<div class="bg-[#fdf4eb] py-20 px-6" x-data="{ imgModal: false, imgModalSrc: '', modalTitle: '', modalDesc: '' }">
    <div class="max-w-7xl mx-auto text-center">
        <h2 data-aos="fade-up" class="text-3xl sm:text-4xl md:text-5xl font-black text-[#e87c75] mb-12 uppercase tracking-wide">{{ __('Recent News') }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-left">
            @if(isset($news) && count($news) > 0)
                @foreach($news as $index => $item)
                @php
                    $newsImg = $getImageUrl($item->image, $defaultImage);
                    $cleanDesc = strip_tags($item->description ?? '');
                @endphp
                <div data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 150 }}" 
                     class="bg-white p-4 shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer group rounded-2xl overflow-hidden flex flex-col justify-between border border-orange-100"
                     @click="imgModalSrc = '{{ $newsImg }}'; 
                             modalTitle = {{ json_encode(__($item->title)) }}; 
                             modalDesc = {{ json_encode($cleanDesc) }}; 
                             imgModal = true">

                    <div>
                        <div class="w-full h-48 overflow-hidden rounded-xl mb-4 bg-slate-100">
                            <img src="{{ $newsImg }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <h3 class="font-black text-[#081747] group-hover:text-[#e87c75] text-base sm:text-lg mb-2 line-clamp-2 transition-colors">{{ __($item->title) }}</h3>
                    </div>
                    <p class="text-xs text-slate-500 line-clamp-3 mt-2 leading-relaxed">{{ $cleanDesc }}</p>
                </div>
                @endforeach
            @endif
        </div>
        <div data-aos="fade-up" data-aos-offset="50" class="mt-12">
            <a href="https://www.facebook.com/LISOfficialPage" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 border-2 border-[#e87c75] text-[#e87c75] font-black px-8 py-3 text-xs sm:text-sm uppercase tracking-wider hover:bg-[#e87c75] hover:text-white rounded-xl transition-all shadow-sm">
                <span>{{ __('VISIT OUR FACEBOOK') }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
        </div>
    </div>

    <!-- ផ្ទាំង Modal -->
    <template x-teleport="body">
        <div x-show="imgModal" x-transition.opacity.duration.300ms class="fixed inset-0 z-[9999] bg-black/80 flex items-center justify-center p-4 md:p-10" @click="imgModal = false" style="display: none;">
            <button @click="imgModal = false" class="absolute top-4 right-4 md:top-8 md:right-8 text-white hover:text-[#e87c75] transition z-50">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <div class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full max-h-[90vh] flex flex-col overflow-hidden relative" @click.stop>
                <div class="w-full h-60 sm:h-80 md:h-[400px] bg-gray-100 flex-shrink-0">
                    <img :src="imgModalSrc" class="w-full h-full object-cover">
                </div>
                <div class="p-6 md:p-8 overflow-y-auto">
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-black text-[#081747] mb-4" x-text="modalTitle"></h3>
                    <p class="text-slate-600 text-sm md:text-base leading-relaxed whitespace-pre-wrap" x-text="modalDesc"></p>
                </div>
            </div>
        </div>
    </template>
</div>

<!-- ៤. ផ្នែក Why Choose LIS -->
<div class="bg-[#ebebeb] py-20 px-6">
    <div class="max-w-6xl mx-auto text-center">
        <h2 data-aos="fade-down" class="text-3xl sm:text-4xl md:text-5xl font-black text-[#081747] uppercase tracking-wide mb-16">{{ __('Why Choose LIS') }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
            @if(isset($whyChooseUs) && count($whyChooseUs) > 0)
                @foreach($whyChooseUs as $index => $feature)
                <div data-aos="zoom-in" data-aos-delay="{{ ($index % 4) * 150 }}" class="flex flex-col items-center text-center p-6 rounded-2xl bg-white/50 border border-white/60 shadow-sm">
                    @if($feature->image)
                        <img src="{{ $getImageUrl($feature->image, $defaultImage) }}" class="w-16 h-16 sm:w-20 sm:h-20 object-contain mb-4">
                    @else
                        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gray-200 rounded-full mb-4 flex items-center justify-center text-gray-500 text-xs">No Icon</div>
                    @endif

                    <h3 class="font-black text-[#081747] text-sm sm:text-base mb-2 uppercase">{{ __($feature->title) }}</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">{{ __($feature->description) }}</p>
                </div>
                @endforeach
            @else
                <p class="col-span-4 text-gray-500">{{ __('Please add "Why Choose Us" features from the Dashboard.') }}</p>
            @endif
        </div>
    </div>
</div>

<!-- ៥. ផ្នែក STUDENT LIFE Banner -->
<div class="py-24 sm:py-28 px-6 text-center text-white relative overflow-hidden" style="background: linear-gradient(135deg, #f6b382 0%, #e2c0c5 100%);">
    <div class="max-w-3xl mx-auto relative z-10">
        <h2 data-aos="fade-up" class="text-3xl sm:text-4xl md:text-5xl font-black uppercase tracking-wider mb-6 drop-shadow-sm">{{ __('STUDENT LIFE') }}</h2>
        <p data-aos="fade-up" data-aos-delay="150" class="text-sm sm:text-base font-semibold leading-relaxed mb-10 text-white/95">
            {{ __('Life International School offers amazing classes in a variety of subjects with teachers from many countries all over the world. Our teachers teach their students to be full of love and joy.') }}
        </p>
        <div data-aos="fade-up" data-aos-delay="300">
            <a href="/student-life" class="inline-flex items-center gap-2 border-2 border-white px-8 py-3.5 text-xs font-black uppercase tracking-widest hover:bg-white hover:text-[#f6b382] rounded-xl transition-all shadow-md">
                <span>{{ __('MORE ABOUT STUDENT LIFE') }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
    </div>
</div>

<!-- ៦. ផ្នែក FAQs -->
<div class="bg-[#f9f5f0] py-20 px-6">
    <div class="max-w-4xl mx-auto">
        <h2 data-aos="fade-up" class="text-3xl sm:text-4xl md:text-5xl font-black text-center text-[#081747] uppercase tracking-wide mb-12">{{ __('FAQs') }}</h2>
        <div class="space-y-4">
            @if(isset($faqs) && count($faqs) > 0)
                @foreach($faqs as $index => $faq)
                <details data-aos="fade-left" data-aos-delay="{{ ($index % 5) * 100 }}" class="group bg-white rounded-2xl border border-slate-200/80 p-5 cursor-pointer shadow-sm">
                    <summary class="flex justify-between items-center font-bold text-base sm:text-lg text-[#081747] list-none">
                        <span>{{ __($faq->question) }}</span>
                        <span class="ml-4 transition group-open:rotate-180 shrink-0 text-orange-500">
                            <svg fill="none" height="20" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" viewBox="0 0 24 24" width="20"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </summary>
                    <div class="text-slate-600 mt-4 text-sm leading-relaxed prose prose-sm max-w-none pt-3 border-t border-slate-100">
                        {!! $faq->answer !!}
                    </div>
                </details>
                @endforeach
            @else
                <p class="text-center text-gray-500">{{ __('Please add FAQs from the Dashboard.') }}</p>
            @endif
        </div>
    </div>
</div>

@endsection