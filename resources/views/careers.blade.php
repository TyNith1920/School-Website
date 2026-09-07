@extends('layout')

@section('title', 'Careers - Life International School')

@section('content')

<!-- ផ្នែកទី ១៖ ពណ៌សាច់ (Light Peach) -->
<div class="bg-[#fdf4eb] pt-32 pb-24 md:pb-36 text-center relative overflow-hidden z-0">
    
    <!-- ចំណងជើងធំ -->
    <h1
        data-aos="fade-down"
        class="relative z-10 text-5xl md:text-8xl font-black text-[#de8b8b] uppercase tracking-wider drop-shadow-sm"
    >
        JOIN OUR TEAM
    </h1>

    <!-- ទម្រង់រលកថ្មី (Smooth Curve Wave) ធានាថាកោងស្អាតមិនជ្រុង -->
    <div class="absolute bottom-0 left-0 w-full leading-none translate-y-[1px] z-0">
        <svg
            viewBox="0 0 1440 120"
            class="w-full h-[60px] md:h-[120px]"
            preserveAspectRatio="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                d="M0,64L60,74.7C120,85,240,107,360,101.3C480,96,600,64,720,53.3C840,43,960,53,1080,64C1200,75,1320,85,1380,90.7L1440,96L1440,120L1380,120C1320,120,1200,120,1080,120C960,120,840,120,720,120C600,120,480,120,360,120C240,120,120,120,60,120L0,120Z"
                fill="#0b1240"
            ></path>
        </svg>
    </div>
</div>

<!-- ផ្នែកទី ២៖ ពណ៌ខៀវចាស់ (Dark Blue) -->
<div class="bg-[#0b1240] pb-24 px-6 text-center">
    <div class="max-w-5xl mx-auto pt-4 md:pt-10">

        <h2
            data-aos="fade-up"
            class="text-4xl md:text-5xl font-black text-white uppercase tracking-wider mb-6"
        >
            APPLY TODAY!
        </h2>

        <p
            data-aos="fade-up"
            data-aos-delay="100"
            class="text-white text-xs md:text-sm tracking-widest uppercase mb-12 font-semibold leading-relaxed"
        >
            INTERESTED IN JOINING OUR TEAM? FILL OUT THE APPLICATION BELOW AND EMAIL A COPY TO <br class="hidden md:block">
            <a
                href="mailto:careers@life.edu.kh"
                class="underline hover:text-[#de8b8b] transition-colors decoration-2 underline-offset-4"
            >
                CAREERS@LIFE.EDU.KH
            </a>
        </p>

        <!-- រូបភាព -->
        <div
            data-aos="zoom-in"
            data-aos-delay="200"
            class="max-w-4xl mx-auto rounded-3xl overflow-hidden shadow-2xl border-4 border-white/5 relative group"
        >
            @if($banner && $banner->image)
                <img
                    src="{{ Storage::url($banner->image) }}"
                    alt="Life International School Team"
                    class="w-full h-[300px] md:h-[450px] object-cover group-hover:scale-105 transition-transform duration-700"
                >
            @else
                <!-- រូបភាពគំរូ ក្នុងករណី Admin មិនទាន់បាន Upload -->
                <img
                    src="https://images.unsplash.com/photo-1577896851231-70ef18881754?q=80&w=2070&auto=format&fit=crop"
                    alt="Life International School Team"
                    class="w-full h-[300px] md:h-[450px] object-cover group-hover:scale-105 transition-transform duration-700"
                >
            @endif
        </div>

    </div>
</div>

<!-- ផ្នែកទី ៣៖ កាតបង្ហាញការងារ (Current Openings) -->
<div class="bg-gray-50 py-20 px-6">
    <div class="max-w-5xl mx-auto">

        <div data-aos="fade-up" class="flex justify-center w-full mb-12">
            <h3 class="text-3xl font-black text-[#0b1240] text-center uppercase border-b-4 border-[#de8b8b] pb-4 inline-block">
                Current Openings
            </h3>
        </div>

        @if($jobs->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($jobs as $index => $job)
                    <div
                        data-aos="fade-up"
                        data-aos-delay="{{ ($index % 2) * 150 }}"
                        class="bg-white rounded-2xl shadow-md border border-gray-100 p-8 hover:shadow-xl hover:-translate-y-1 transition-all duration-300"
                    >
                        <div class="flex justify-between items-start mb-4">
                            <h4 class="text-2xl font-bold text-[#0b1240]">
                                {{ $job->title }}
                            </h4>
                            <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                {{ $job->job_type }}
                            </span>
                        </div>

                        <div class="text-gray-600 mb-6 prose prose-sm max-w-none line-clamp-3">
                            {!! $job->description !!}
                        </div>

                        <div class="flex items-center space-x-4 pt-4 border-t border-gray-100">
                            @if($job->application_file)
                                <a
                                    href="{{ Storage::url($job->application_file) }}"
                                    target="_blank"
                                    class="bg-[#de8b8b] hover:bg-[#c97474] text-white font-bold py-3 px-6 rounded-lg transition-colors text-sm w-full text-center"
                                >
                                    Download Application
                                </a>
                            @else
                                <a
                                    href="mailto:careers@life.edu.kh?subject=Application for {{ $job->title }}"
                                    class="bg-[#0b1240] hover:bg-blue-900 text-white font-bold py-3 px-6 rounded-lg transition-colors text-sm w-full text-center"
                                >
                                    Apply via Email
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div data-aos="fade-up" class="text-center text-gray-500 py-16 bg-white shadow-sm border border-gray-100 rounded-2xl">
                <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <p class="text-xl font-bold text-gray-400">
                    There are currently no open positions.
                </p>
                <p class="text-md mt-2">
                    Please check back later!
                </p>
            </div>
        @endif

    </div>
</div>

@endsection