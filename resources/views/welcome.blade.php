@extends('layout')
@section('title', __('Home - Life International School'))
@section('content')

@php
    // 📍 ការពារ Error: បើអត់មានរូប ឱ្យវាលោតចេញរូបភាពទទេរជំនួស
    $bannerImage = $banner && $banner->image ? \Storage::disk('cloudinary')->url($banner->image) : null;
    $bannerVideo = $banner && $banner->video ? \Storage::disk('cloudinary')->url($banner->video) : null;
    $defaultImage = 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=2022&auto=format&fit=crop';
@endphp

<!-- ១. ផ្នែក Banner ខាងលើបង្អស់ -->
<div class="relative w-full h-[500px] md:h-[650px] overflow-hidden bg-[#0b1240] flex items-center">

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

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/60 z-10"></div>

    <!-- Content -->
    <div class="relative z-20 max-w-7xl mx-auto w-full px-6 flex flex-col md:flex-row items-center justify-between gap-8 md:gap-12 lg:gap-20">

        <!-- Title -->
        <div data-aos="fade-right" data-aos-duration="1000" class="w-full md:w-3/5 text-left mb-10 md:mb-0">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-4xl md:leading-[1.2] font-black text-white drop-shadow-lg tracking-wide uppercase break-words">
                {{ __($banner->title ?? 'Truth | Integrity | Love') }}
            </h1>
            <div class="w-20 h-1.5 bg-[#de8b8b] mt-6 rounded-full"></div>
        </div>

        <!-- Floating Image -->
        @if($bannerImage)
        <div data-aos="fade-left" data-aos-duration="1200" class="w-full md:w-2/5 justify-center md:justify-end hidden md:flex shrink-0">
            <div class="relative">
                <img src="{{ $bannerImage }}" class="w-[280px] h-[280px] lg:w-[380px] lg:h-[380px] object-cover rounded-3xl border-4 border-white/20 shadow-2xl rotate-3 hover:rotate-0 transition-transform duration-500">
            </div>
        </div>
        @endif
    </div>
</div>

<!-- ២. ផ្នែក ADMISSIONS -->
<div class="py-24 px-6 relative overflow-hidden" style="background: linear-gradient(90deg, #7a76ff 0%, #e2b2e0 50%, #faff4b 100%);">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center relative z-10">
        <!-- អត្ថបទ -->
        <div data-aos="fade-up" class="w-full md:w-1/2 text-white pr-0 md:pr-16 mb-12 md:mb-0">
            <h2 class="text-5xl md:text-6xl font-black mb-6 uppercase tracking-wider">{{ __($admission->title ?? 'ADMISSIONS') }}</h2>
            <p class="text-lg md:text-xl mb-10 leading-relaxed font-medium">
                {{ __($admission->description ?? 'Explore our admissions process, and let us guide you as you begin your transition into Life international school.') }}
            </p>
            <a href="/enrollment" class="inline-block border-2 border-white/80 px-10 py-4 text-sm font-bold uppercase tracking-widest hover:bg-white hover:text-[#7a76ff] transition-all duration-300">
                {{ __($admission->button_text ?? 'APPLY NOW') }}
            </a>
        </div>

        <!-- រូបភាពរាងកោង Blob -->
        <div data-aos="zoom-in" data-aos-delay="200" class="w-full md:w-1/2 relative flex justify-center items-center">
            <div class="relative w-[320px] h-[320px] md:w-[450px] md:h-[450px] overflow-hidden transition-transform duration-700 hover:scale-105" 
                 style="border-radius: 42% 58% 66% 34% / 43% 36% 64% 57%; box-shadow: 0 20px 50px rgba(0,0,0,0.15);">
                <img src="{{ isset($admission) && $admission->image ? \Storage::disk('cloudinary')->url($admission->image) : $defaultImage }}" class="w-full h-full object-cover">
            </div>
        </div>
    </div>
</div>

<!-- ៣. ផ្នែក Recent News -->
<div class="bg-[#fdf4eb] py-20 px-6" x-data="{ imgModal: false, imgModalSrc: '', modalTitle: '', modalDesc: '' }">
    <div class="max-w-7xl mx-auto text-center">
        <h2 data-aos="fade-up" class="text-5xl font-black text-[#e87c75] mb-12">{{ __('Recent News') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-left">
            @if(isset($news) && count($news) > 0)
                @foreach($news as $index => $item)
                <div data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 150 }}" 
                     class="bg-white p-4 shadow-sm hover:shadow-lg transition-shadow cursor-pointer group"
                     @click="imgModalSrc = '{{ $item->image ? \Storage::disk('cloudinary')->url($item->image) : $defaultImage }}'; 
                             modalTitle = {{ json_encode(__($item->title)) }}; 
                             modalDesc = {{ json_encode(__($item->description)) }}; 
                             imgModal = true">

                    <!-- 📍 ត្រួតពិនិត្យរូបភាព News -->
                    <img src="{{ $item->image ? \Storage::disk('cloudinary')->url($item->image) : $defaultImage }}" 
                         class="w-full h-48 object-cover mb-4 group-hover:opacity-80 transition-opacity">

                    <h3 class="font-bold text-[#e87c75] text-lg mb-2 text-center">{{ __($item->title) }}</h3>
                    <p class="text-xs text-center text-gray-500 line-clamp-2">{{ __($item->description) }}</p>
                </div>
                @endforeach
            @endif
        </div>
        <div data-aos="fade-up" data-aos-offset="50" class="mt-10">
            <a href="https://www.facebook.com/LISOfficialPage" class="inline-block border border-[#e87c75] text-[#e87c75] font-bold px-8 py-3 text-sm hover:bg-[#e87c75] hover:text-white transition">{{ __('GO TO FACEBOOK') }}</a>
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
            <div class="bg-white rounded-xl shadow-2xl max-w-3xl w-full max-h-[90vh] flex flex-col overflow-hidden relative" @click.stop>
                <div class="w-full h-60 sm:h-80 md:h-[400px] bg-gray-100 flex-shrink-0">
                    <img :src="imgModalSrc" class="w-full h-full object-cover">
                </div>
                <div class="p-6 md:p-8 overflow-y-auto">
                    <h3 class="text-2xl md:text-3xl font-black text-[#e87c75] mb-4" x-text="modalTitle"></h3>
                    <p class="text-gray-700 text-sm md:text-base leading-relaxed whitespace-pre-wrap" x-text="modalDesc"></p>
                </div>
            </div>
        </div>
    </template>
</div>

<!-- ៤. ផ្នែក Why Choose LIS -->
<div class="bg-[#ebebeb] py-20 px-6">
    <div class="max-w-6xl mx-auto text-center">
        <h2 data-aos="fade-down" class="text-5xl font-serif text-[#111] mb-16">{{ __('Why Choose LIS') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-x-8 gap-y-12">
            @if(isset($whyChooseUs) && count($whyChooseUs) > 0)
                @foreach($whyChooseUs as $index => $feature)
                <div data-aos="zoom-in" data-aos-delay="{{ ($index % 4) * 150 }}" class="flex flex-col items-center text-center">
                    
                    <!-- 📍 ត្រួតពិនិត្យរូបភាព Why Choose Us (កន្លែងដែល Error មុននេះ) -->
                    @if($feature->image)
                        <img src="{{ \Storage::disk('cloudinary')->url($feature->image) }}" class="w-20 h-20 object-contain mb-4">
                    @else
                        <div class="w-20 h-20 bg-gray-300 rounded-full mb-4 flex items-center justify-center text-gray-500 text-xs">No Icon</div>
                    @endif

                    <h3 class="font-black text-sm mb-2 uppercase">{{ __($feature->title) }}</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">{{ __($feature->description) }}</p>
                </div>
                @endforeach
            @else
                <p class="col-span-4 text-gray-500">{{ __('Please add "Why Choose Us" features from the Dashboard.') }}</p>
            @endif
        </div>
    </div>
</div>

<!-- ៥. ផ្នែក STUDENT LIFE Banner -->
<div class="py-32 px-6 text-center text-white relative overflow-hidden" style="background: linear-gradient(135deg, #f6b382 0%, #e2c0c5 100%);">
    <div class="max-w-3xl mx-auto relative z-10">
        <h2 data-aos="fade-up" class="text-5xl font-black uppercase tracking-wider mb-6">{{ __('STUDENT LIFE') }}</h2>
        <p data-aos="fade-up" data-aos-delay="150" class="text-sm font-bold leading-relaxed mb-10">
            {{ __('Life International School offers amazing classes in a variety of subjects with teachers from many countries all over the world. Our teachers teach their students to be full of love and joy.') }}
        </p>
        <div data-aos="fade-up" data-aos-delay="300">
            <a href="/student-life" class="inline-block border border-white px-8 py-4 text-xs font-bold uppercase tracking-widest hover:bg-white hover:text-[#f6b382] transition">
                {{ __('MORE ABOUT STUDENT LIFE') }}
            </a>
        </div>
    </div>
</div>

<!-- ៦. ផ្នែក FAQs -->
<div class="bg-[#f9f5f0] py-20 px-6">
    <div class="max-w-4xl mx-auto">
        <h2 data-aos="fade-up" class="text-5xl font-black text-center mb-12">{{ __('FAQs') }}</h2>
        <div class="space-y-4">
            @if(isset($faqs) && count($faqs) > 0)
                @foreach($faqs as $index => $faq)
                <details data-aos="fade-left" data-aos-delay="{{ ($index % 5) * 100 }}" class="group border-b border-gray-300 pb-4 cursor-pointer">
                    <summary class="flex justify-between items-center font-bold text-lg list-none">
                        {{ __($faq->question) }}
                        <span class="transition group-open:rotate-180">
                            <svg fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" w="24" xmlns="http://www.w3.org/2000/svg"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </summary>
                    <p class="text-gray-600 mt-4 text-sm leading-relaxed">{{ __($faq->answer) }}</p>
                </details>
                @endforeach
            @else
                <p class="text-center text-gray-500">{{ __('Please add FAQs from the Dashboard.') }}</p>
            @endif
        </div>
    </div>
</div>

@endsection