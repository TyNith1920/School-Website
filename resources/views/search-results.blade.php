@extends('layout')

@section('title', 'Search Results - ' . ($query ?? ''))

@section('content')
<!-- Banner ក្បាលទំព័រ -->
<div class="bg-[#0b1240] py-16 text-center text-white border-b-4 border-[#e06d64]">
    <h1 class="text-3xl md:text-5xl font-black uppercase tracking-wider">Search Results</h1>
    <p class="text-gray-300 mt-2 text-sm md:text-base">Search results for: <span class="text-[#e06d64] font-bold">"{{ $query }}"</span></p>
</div>

<div class="max-w-7xl mx-auto px-6 py-12 min-h-[50vh]">
    
    @if($totalResults == 0)
        <!-- ករណីរកមិនឃើញលទ្ធផល -->
        <div class="text-center py-16">
            <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <h2 class="text-2xl font-bold text-gray-700">Sorry! No results found</h2>
            <p class="text-gray-500 mt-2">Please try searching with different keywords.</p>
            <a href="/" class="inline-block mt-6 bg-[#0b1240] text-white px-8 py-3 rounded-full hover:bg-[#e06d64] transition">Back to Home</a>
        </div>
    @else
        <p class="text-gray-600 mb-8">Total results found: <span class="font-bold text-[#e06d64]">{{ $totalResults }}</span></p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- 1. លទ្ធផលពី ទំព័រគោល (ដូចជា Child Safeguarding) -->
            @if(isset($matchedStaticPages))
                @foreach($matchedStaticPages as $static)
                    <div class="bg-[#f8f9fa] border-l-4 border-[#0b1240] p-6 rounded-r-xl shadow-sm hover:shadow-md transition">
                        <span class="text-xs font-bold text-[#e06d64] uppercase">Main Page</span>
                        <h3 class="text-xl font-bold text-[#0b1240] mt-1 mb-2">{{ $static['title'] }}</h3>
                        <p class="text-gray-500 text-sm mt-2">{{ $static['desc'] }}</p>
                        <a href="{{ $static['url'] }}" class="inline-block mt-4 text-[#e06d64] font-bold hover:underline text-sm">View this page &rarr;</a>
                    </div>
                @endforeach
            @endif

            <!-- 2. លទ្ធផលពី Pages ទូទៅ -->
            @foreach($pages as $page)
                <div class="bg-white border border-gray-200 p-6 rounded-xl shadow-sm hover:shadow-md transition">
                    <span class="text-xs font-bold text-[#e06d64] uppercase">Academics</span>
                    <h3 class="text-xl font-bold text-gray-800 mt-1 mb-2">{{ $page->title }}</h3>
                    <p class="text-gray-500 text-sm mt-2 line-clamp-2">{{ strip_tags($page->content) }}</p>
                    <a href="/{{ $page->slug }}" class="inline-block mt-4 text-[#e06d64] font-bold hover:underline text-sm">View this page &rarr;</a>
                </div>
            @endforeach

            <!-- 3. លទ្ធផលពី News -->
            @foreach($news as $item)
                <div class="bg-white border border-gray-200 p-6 rounded-xl shadow-sm hover:shadow-md transition">
                    <span class="text-xs font-bold text-[#e06d64] uppercase">News & Events</span>
                    <h3 class="text-xl font-bold text-gray-800 mt-1 mb-2">{{ $item->title }}</h3>
                    <p class="text-gray-500 text-sm mt-2 line-clamp-2">{{ strip_tags($item->description) }}</p>
                    <a href="/news-events" class="inline-block mt-4 text-[#e06d64] font-bold hover:underline text-sm">Read more &rarr;</a>
                </div>
            @endforeach

            <!-- 4. លទ្ធផលពី Careers -->
            @foreach($careers as $job)
                <div class="bg-white border border-gray-200 p-6 rounded-xl shadow-sm hover:shadow-md transition">
                    <span class="text-xs font-bold text-[#e06d64] uppercase">Careers</span>
                    <h3 class="text-xl font-bold text-gray-800 mt-1 mb-2">{{ $job->title }}</h3>
                    <p class="text-gray-500 text-sm mt-2 line-clamp-2">{{ strip_tags($job->description) }}</p>
                    <a href="/careers" class="inline-block mt-4 text-[#e06d64] font-bold hover:underline text-sm">View details &rarr;</a>
                </div>
            @endforeach

            <!-- 5. លទ្ធផលពី Student Life -->
            @foreach($studentLife as $activity)
                <div class="bg-white border border-gray-200 p-6 rounded-xl shadow-sm hover:shadow-md transition">
                    <span class="text-xs font-bold text-[#e06d64] uppercase">Student Life</span>
                    <h3 class="text-xl font-bold text-gray-800 mt-1 mb-2">{{ $activity->title }}</h3>
                    <p class="text-gray-500 text-sm mt-2 line-clamp-2">{{ strip_tags($activity->description) }}</p>
                    <a href="/student-life" class="inline-block mt-4 text-[#e06d64] font-bold hover:underline text-sm">Read more &rarr;</a>
                </div>
            @endforeach

            <!-- 6. លទ្ធផលពី FAQs -->
            @foreach($faqs as $faq)
                <div class="bg-white border border-gray-200 p-6 rounded-xl shadow-sm hover:shadow-md transition">
                    <span class="text-xs font-bold text-[#e06d64] uppercase">FAQ</span>
                    <h3 class="text-xl font-bold text-gray-800 mt-1 mb-2">{{ $faq->question }}</h3>
                    <p class="text-gray-500 text-sm mt-2 line-clamp-2">{{ strip_tags($faq->answer) }}</p>
                    <a href="/#faqs" class="inline-block mt-4 text-[#e06d64] font-bold hover:underline text-sm">Read more &rarr;</a>
                </div>
            @endforeach

            <!-- 7. លទ្ធផលពី Why Choose Us -->
            @foreach($whyChooseUs as $reason)
                <div class="bg-white border border-gray-200 p-6 rounded-xl shadow-sm hover:shadow-md transition">
                    <span class="text-xs font-bold text-[#e06d64] uppercase">Why Choose Us</span>
                    <h3 class="text-xl font-bold text-gray-800 mt-1 mb-2">{{ $reason->title }}</h3>
                    <p class="text-gray-500 text-sm mt-2 line-clamp-2">{{ strip_tags($reason->description) }}</p>
                    <a href="/" class="inline-block mt-4 text-[#e06d64] font-bold hover:underline text-sm">Back to Home &rarr;</a>
                </div>
            @endforeach

        </div>
    @endif
</div>
@endsection