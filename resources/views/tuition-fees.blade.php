@extends('layout')

@section('title', __('Tuition & Fees - Life International School'))

@section('content')

@php
    $themes = [
        'yellow' => [
            'accent' => '#f59e0b',
            'dark'   => '#b45309',
            'soft'   => '#fffbeb',
            'border' => '#fcd34d',
            'tag'    => 'bg-amber-100 text-amber-900 border-amber-300',
            'btn'    => 'bg-amber-500 hover:bg-amber-600',
        ],
        'green' => [
            'accent' => '#10b981',
            'dark'   => '#047857',
            'soft'   => '#ecfdf5',
            'border' => '#6ee7b7',
            'tag'    => 'bg-emerald-100 text-emerald-900 border-emerald-300',
            'btn'    => 'bg-emerald-500 hover:bg-emerald-600',
        ],
        'blue' => [
            'accent' => '#2563eb',
            'dark'   => '#1d4ed8',
            'soft'   => '#eff6ff',
            'border' => '#93c5fd',
            'tag'    => 'bg-blue-100 text-blue-900 border-blue-300',
            'btn'    => 'bg-blue-600 hover:bg-blue-700',
        ],
        'red' => [
            'accent' => '#ef4444',
            'dark'   => '#b91c1c',
            'soft'   => '#fef2f2',
            'border' => '#fca5a5',
            'tag'    => 'bg-rose-100 text-rose-900 border-rose-300',
            'btn'    => 'bg-rose-500 hover:bg-rose-600',
        ],
        'purple' => [
            'accent' => '#8b5cf6',
            'dark'   => '#6d28d9',
            'soft'   => '#f5f3ff',
            'border' => '#c4b5fd',
            'tag'    => 'bg-purple-100 text-purple-900 border-purple-300',
            'btn'    => 'bg-purple-600 hover:bg-purple-700',
        ],
    ];

    $categories = $tuitionFees->pluck('category')->unique()->filter()->values();
@endphp

<div x-data="{ activeTab: 'all' }" class="min-h-screen bg-[#f8fafc] text-slate-800">

    {{-- 🏛️ 1. Header Section --}}
    <section class="relative bg-[#071330] text-white pt-16 pb-24 md:py-24 px-6 overflow-hidden border-b border-white/10">
        
        <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[900px] h-[400px] bg-gradient-to-b from-amber-500/15 via-blue-600/10 to-transparent blur-[120px] pointer-events-none"></div>

        <div class="relative z-10 max-w-5xl mx-auto text-center">
            
            <div data-aos="fade-down" class="inline-flex items-center gap-2 px-5 py-1.5 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-300 text-xs font-bold uppercase tracking-[0.25em] mb-6 backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                Official Investment Schedule
            </div>

            <h1 data-aos="fade-up" data-aos-delay="100" class="text-3xl sm:text-5xl md:text-6xl lg:text-7xl font-black uppercase tracking-tight text-white leading-tight">
                Tuition <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-orange-300 to-amber-200">&</span> Schedules
            </h1>

            <p data-aos="fade-up" data-aos-delay="200" class="mt-5 max-w-2xl mx-auto text-base sm:text-lg text-slate-300 leading-relaxed font-light">
                Transparent and comprehensive fee structure for academic programs from Nursery to Grade 12.
            </p>

            {{-- Filter Pills --}}
            @if(count($categories) > 1)
                <div data-aos="fade-up" data-aos-delay="300" class="mt-10 flex flex-wrap items-center justify-center gap-2 p-1.5 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-md max-w-fit mx-auto">
                    <button @click="activeTab = 'all'" 
                            :class="activeTab === 'all' ? 'bg-amber-400 text-slate-950 shadow-md font-black' : 'text-slate-300 hover:text-white font-semibold'"
                            class="px-5 py-2 rounded-xl text-xs uppercase tracking-wider transition-all">
                        All Programs
                    </button>
                    @foreach($categories as $cat)
                        <button @click="activeTab = '{{ Str::slug($cat) }}'" 
                                :class="activeTab === '{{ Str::slug($cat) }}' ? 'bg-amber-400 text-slate-950 shadow-md font-black' : 'text-slate-300 hover:text-white font-semibold'"
                                class="px-5 py-2 rounded-xl text-xs uppercase tracking-wider transition-all">
                            {{ $cat }}
                        </button>
                    @endforeach
                </div>
            @endif

        </div>
    </section>

    {{-- 💳 2. Tuition Cards Grid (អក្សរធំច្បាស់ និងរចនាបថទូលាយ) --}}
    <section class="max-w-7xl mx-auto px-6 -mt-10 relative z-20 pb-20">
        
        @if(count($tuitionFees) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($tuitionFees as $fee)
                    @php
                        $theme = $themes[$fee->theme_color] ?? $themes['yellow'];
                        $slugCat = Str::slug($fee->category);
                    @endphp

                    <div x-show="activeTab === 'all' || activeTab === '{{ $slugCat }}'"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="bg-white rounded-[2.2rem] border-2 border-slate-200/90 shadow-[0_15px_40px_rgba(15,23,42,0.06)] hover:shadow-[0_25px_55px_rgba(15,23,42,0.12)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between overflow-hidden">
                        
                        <div>
                            {{-- Header --}}
                            <div class="p-7 pb-5 border-b border-slate-100">
                                <div class="flex items-center justify-between gap-3 mb-3">
                                    <span class="inline-block px-3.5 py-1.5 rounded-full text-xs font-black uppercase tracking-wider {{ $theme['tag'] }} border">
                                        {{ $fee->category }}
                                    </span>
                                    <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 border" style="background-color: {{ $theme['soft'] }}; color: {{ $theme['dark'] }}; border-color: {{ $theme['border'] }};">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    </div>
                                </div>

                                <h3 class="text-2xl font-black text-[#0b1240] uppercase tracking-tight">
                                    {{ $fee->program_name }}
                                </h3>

                                @if(filled($fee->time_schedule))
                                    <div class="mt-3 flex items-center gap-2 text-xs font-bold text-slate-600 bg-slate-100/90 rounded-xl px-3.5 py-2">
                                        <svg class="w-4 h-4 text-slate-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span class="truncate">{{ $fee->time_schedule }}</span>
                                    </div>
                                @endif
                            </div>

                            {{-- Monthly Highlight Box --}}
                            <div class="p-7 pt-6">
                                <div class="p-6 rounded-2xl text-center border-2" style="background-color: {{ $theme['soft'] }}; border-color: {{ $theme['border'] }};">
                                    <span class="text-xs font-black uppercase tracking-[0.2em] text-slate-500 block">Monthly Tuition</span>
                                    <div class="text-5xl font-black tracking-tight mt-1" style="color: {{ $theme['dark'] }};">
                                        {{ $fee->monthly_fee }}
                                    </div>
                                    <span class="text-xs text-slate-500 font-bold block mt-1">Due on 1st of every month</span>
                                </div>

                                {{-- 📍 ផ្នែកអក្សរធំច្បាស់តាមការចង់បាន (Annual, Lunch, After School) --}}
                                <div class="mt-6 space-y-3">
                                    
                                    {{-- Annual Tuition --}}
                                    @if(filled($fee->annual_fee))
                                        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/80 flex items-center justify-between">
                                            <div class="flex items-center gap-2.5">
                                                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                                                <span class="text-sm font-bold text-slate-700 uppercase tracking-wide">Annual Tuition</span>
                                            </div>
                                            <span class="text-lg font-black text-slate-900 tracking-tight">{{ $fee->annual_fee }}</span>
                                        </div>
                                    @endif

                                    {{-- Lunch Fee --}}
                                    @if(filled($fee->lunch_fee))
                                        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/80 flex items-center justify-between">
                                            <div class="flex items-center gap-2.5">
                                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                                <span class="text-sm font-bold text-slate-700 uppercase tracking-wide">{{ $fee->lunch_fee_label ?: 'Lunch / Snack' }}</span>
                                            </div>
                                            <span class="text-lg font-black text-slate-900 tracking-tight">{{ $fee->lunch_fee }}</span>
                                        </div>
                                    @endif

                                    {{-- After School Fee --}}
                                    @if(filled($fee->after_school_fee))
                                        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/80 flex items-center justify-between">
                                            <div class="flex items-center gap-2.5">
                                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                                <span class="text-sm font-bold text-slate-700 uppercase tracking-wide">After School Club</span>
                                            </div>
                                            <span class="text-lg font-black text-slate-900 tracking-tight">{{ $fee->after_school_fee }}</span>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>

                        {{-- Action Button --}}
                        <div class="p-7 pt-0">
                            <a href="{{ url('/enrollment') }}" 
                               class="w-full inline-flex items-center justify-center gap-2 py-4 px-6 rounded-xl text-sm font-black uppercase tracking-wider text-white shadow-md transition-all hover:brightness-95 {{ $theme['btn'] }}">
                                <span>Apply for This Program</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <div class="rounded-3xl border border-dashed border-slate-300 bg-white p-16 text-center shadow-sm max-w-2xl mx-auto">
                <p class="text-slate-500 font-bold">Tuition and fee schedules will be published soon.</p>
            </div>
        @endif

    </section>

    {{-- 📜 3. Official Billing Policy & Regulations --}}
    <section class="max-w-6xl mx-auto px-6 pb-24">
        <div class="rounded-[2.5rem] bg-white border-2 border-slate-200/80 p-8 md:p-12 shadow-sm">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-8 border-b border-slate-100 mb-8">
                <div>
                    <span class="text-xs font-black uppercase tracking-widest text-amber-600">Standard Terms</span>
                    <h3 class="text-2xl font-black text-[#071330] mt-1">Tuition & Payment Regulations</h3>
                </div>
                <div class="flex items-center gap-4">
                    <img src="{{ asset('images/lis-logo.png') }}" alt="Life International School" class="h-9 w-auto object-contain">
                    <img src="{{ asset('images/acsi-logo.png') }}" alt="ACSI" class="h-9 w-auto object-contain">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200/80">
                    <span class="w-9 h-9 rounded-xl bg-blue-100 text-blue-700 font-mono font-black text-sm flex items-center justify-center mb-4">01</span>
                    <h4 class="font-black text-slate-900 text-base mb-1">Due Date</h4>
                    <p class="text-xs text-slate-600 leading-relaxed">Tuition fees are due on the <strong>1st of every month</strong>.</p>
                </div>

                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200/80">
                    <span class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 font-mono font-black text-sm flex items-center justify-center mb-4">02</span>
                    <h4 class="font-black text-slate-900 text-base mb-1">Grace Period</h4>
                    <p class="text-xs text-slate-600 leading-relaxed">A grace period of <strong>7 calendar days</strong> is provided.</p>
                </div>

                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200/80">
                    <span class="w-9 h-9 rounded-xl bg-rose-100 text-rose-700 font-mono font-black text-sm flex items-center justify-center mb-4">03</span>
                    <h4 class="font-black text-slate-900 text-base mb-1">Late Penalty</h4>
                    <p class="text-xs text-slate-600 leading-relaxed">A <strong>10% penalty fee</strong> applies to payments made after the grace period.</p>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 text-xs text-slate-500">
                <p>Note: All tuition, lunch, and after-school fees are non-refundable.</p>
                <a href="{{ url('/contact-us') }}" class="font-bold text-[#071330] hover:text-amber-600 transition-colors">
                    Contact Finance Office →
                </a>
            </div>

        </div>
    </section>

</div>

@endsection