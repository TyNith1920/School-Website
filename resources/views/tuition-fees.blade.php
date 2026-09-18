@extends('layout')

@section('title', __('Tuition & Fees - Life International School'))

@section('content')

@php
    $themes = [
        'yellow' => [
            'accent' => '#f59e0b',
            'dark'   => '#b45309',
            'soft'   => '#fffbeb',
            'border' => '#fde68a',
            'badge'  => 'bg-amber-50 text-amber-800 border-amber-200',
        ],
        'green' => [
            'accent' => '#10b981',
            'dark'   => '#047857',
            'soft'   => '#ecfdf5',
            'border' => '#a7f3d0',
            'badge'  => 'bg-emerald-50 text-emerald-800 border-emerald-200',
        ],
        'blue' => [
            'accent' => '#2563eb',
            'dark'   => '#1d4ed8',
            'soft'   => '#eff6ff',
            'border' => '#bfdbfe',
            'badge'  => 'bg-blue-50 text-blue-800 border-blue-200',
        ],
        'red' => [
            'accent' => '#ef4444',
            'dark'   => '#b91c1c',
            'soft'   => '#fef2f2',
            'border' => '#fecaca',
            'badge'  => 'bg-rose-50 text-rose-800 border-rose-200',
        ],
        'purple' => [
            'accent' => '#8b5cf6',
            'dark'   => '#6d28d9',
            'soft'   => '#f5f3ff',
            'border' => '#ddd6fe',
            'badge'  => 'bg-purple-50 text-purple-800 border-purple-200',
        ],
    ];

    $categories = $tuitionFees->pluck('category')->unique()->filter()->values();
@endphp

<div x-data="{ activeTab: 'all' }" class="min-h-screen bg-[#f8fafc] text-slate-800">

    {{-- 🏛️ 1. Executive Investment Header (រចនាបថបែប Financial Ledger ថ្លៃថ្នូរ) --}}
    <section class="relative bg-[#071330] text-white pt-16 pb-24 md:py-24 px-6 overflow-hidden border-b border-white/10">
        
        {{-- Subtle Luxury Lighting --}}
        <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[900px] h-[400px] bg-gradient-to-b from-amber-500/15 via-blue-600/10 to-transparent blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 rounded-full bg-blue-500/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 max-w-5xl mx-auto text-center">
            
            <div data-aos="fade-down" class="inline-flex items-center gap-2 px-5 py-1.5 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-300 text-xs font-bold uppercase tracking-[0.25em] mb-6 backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                Academic Year Investment Guide
            </div>

            <h1 data-aos="fade-up" data-aos-delay="100" class="text-3xl sm:text-5xl md:text-6xl lg:text-7xl font-black uppercase tracking-tight text-white leading-tight">
                Tuition <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-orange-300 to-amber-200">&</span> Schedules
            </h1>

            <p data-aos="fade-up" data-aos-delay="200" class="mt-6 max-w-2xl mx-auto text-base sm:text-lg text-slate-300 leading-relaxed font-light">
                Transparent, high-value investment in your child’s spiritual character, globally accredited education, and future leadership.
            </p>

            {{-- 📍 Filter Pills (ចុច Filter មើលតាម Category ភ្លាមៗ) --}}
            @if(count($categories) > 1)
                <div data-aos="fade-up" data-aos-delay="300" class="mt-10 flex flex-wrap items-center justify-center gap-2 p-1.5 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md max-w-fit mx-auto">
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

    {{-- 💳 2. Tiered Programs Showcase Grid --}}
    <section class="max-w-7xl mx-auto px-6 -mt-8 relative z-20 pb-20">
        
        @if(count($tuitionFees) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7">
                @foreach($tuitionFees as $fee)
                    @php
                        $theme = $themes[$fee->theme_color] ?? $themes['yellow'];
                        $slugCat = Str::slug($fee->category);
                    @endphp

                    <div x-show="activeTab === 'all' || activeTab === '{{ $slugCat }}'"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="bg-white rounded-[2rem] border border-slate-200/90 shadow-[0_15px_35px_rgba(15,23,42,0.06)] hover:shadow-[0_25px_50px_rgba(15,23,42,0.12)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                        
                        <div>
                            {{-- Card Top Badge & Icon --}}
                            <div class="p-6 pb-4 border-b border-slate-100 flex items-start justify-between gap-3">
                                <div>
                                    <span class="inline-block px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider {{ $theme['badge'] }} border">
                                        {{ $fee->category }}
                                    </span>
                                    <h3 class="text-xl font-black text-[#071330] mt-3 group-hover:text-amber-600 transition-colors">
                                        {{ $fee->program_name }}
                                    </h3>
                                </div>
                                <div class="w-10 h-10 rounded-2xl flex items-center justify-center shrink-0" style="background-color: {{ $theme['soft'] }}; color: {{ $theme['dark'] }};">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                </div>
                            </div>

                            {{-- Schedule Pill --}}
                            @if(filled($fee->time_schedule))
                                <div class="px-6 pt-4">
                                    <div class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 bg-slate-50 border border-slate-200/70 rounded-xl px-3 py-1.5 w-full">
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span class="truncate">{{ $fee->time_schedule }}</span>
                                    </div>
                                </div>
                            @endif

                            {{-- Primary Monthly Fee Box --}}
                            <div class="p-6">
                                <div class="p-5 rounded-2xl text-center border" style="background-color: {{ $theme['soft'] }}; border-color: {{ $theme['border'] }};">
                                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 block">Monthly Rate</span>
                                    <div class="text-4xl font-black tracking-tight mt-1" style="color: {{ $theme['dark'] }};">
                                        {{ $fee->monthly_fee }}
                                    </div>
                                    <span class="text-[11px] text-slate-500 font-medium block mt-0.5">billed on 1st of month</span>
                                </div>

                                {{-- Other Fees Breakdown --}}
                                <div class="mt-5 divide-y divide-slate-100 text-xs">
                                    @if(filled($fee->annual_fee))
                                        <div class="py-2.5 flex items-center justify-between">
                                            <span class="text-slate-500">Annual Tuition</span>
                                            <span class="font-bold text-slate-900">{{ $fee->annual_fee }}</span>
                                        </div>
                                    @endif

                                    @if(filled($fee->lunch_fee))
                                        <div class="py-2.5 flex items-center justify-between">
                                            <span class="text-slate-500">{{ $fee->lunch_fee_label ?: 'Lunch Program' }}</span>
                                            <span class="font-bold text-slate-900">{{ $fee->lunch_fee }}</span>
                                        </div>
                                    @endif

                                    @if(filled($fee->after_school_fee))
                                        <div class="py-2.5 flex items-center justify-between">
                                            <span class="text-slate-500">After School Club</span>
                                            <span class="font-bold text-slate-900">{{ $fee->after_school_fee }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Apply Button --}}
                        <div class="p-6 pt-0">
                            <a href="{{ url('/enrollment') }}" 
                               class="w-full inline-flex items-center justify-center gap-2 py-3 px-4 rounded-xl text-xs font-bold uppercase tracking-wider text-white shadow-md transition-all hover:brightness-95"
                               style="background-color: {{ $theme['accent'] }};">
                                <span>Enroll In This Program</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
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

    {{-- 📜 3. Official Billing Policy & Payment Regulations (រចនាបថស្អាត មិនបង្កអារម្មណ៍ភ័យខ្លាច) --}}
    <section class="max-w-6xl mx-auto px-6 pb-24">
        <div class="rounded-[2.5rem] bg-white border border-slate-200/80 p-8 md:p-12 shadow-sm overflow-hidden relative">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-8 border-b border-slate-100 mb-8">
                <div>
                    <span class="text-xs font-black uppercase tracking-widest text-amber-600">Standard Regulations</span>
                    <h3 class="text-2xl font-black text-[#071330] mt-1">Payment Policies & Terms</h3>
                </div>
                <div class="flex items-center gap-4">
                    <img src="{{ asset('images/lis-logo.png') }}" alt="Life International School" class="h-9 w-auto object-contain">
                    <img src="{{ asset('images/acsi-logo.png') }}" alt="ACSI" class="h-9 w-auto object-contain">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                {{-- Rule 1 --}}
                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 font-mono font-black text-sm flex items-center justify-center mb-4">
                            01
                        </div>
                        <h4 class="font-black text-[#071330] text-sm mb-1">Due Date</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">Tuition fees are strictly due on the <strong>1st day of each month</strong> to maintain continuous enrollment.</p>
                    </div>
                </div>

                {{-- Rule 2 --}}
                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 font-mono font-black text-sm flex items-center justify-center mb-4">
                            02
                        </div>
                        <h4 class="font-black text-[#071330] text-sm mb-1">Grace Period</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">A courtesy window of <strong>7 calendar days</strong> is provided before late accounting procedures take effect.</p>
                    </div>
                </div>

                {{-- Rule 3 --}}
                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-700 font-mono font-black text-sm flex items-center justify-center mb-4">
                            03
                        </div>
                        <h4 class="font-black text-[#071330] text-sm mb-1">Late Penalty</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">A <strong>10% surcharge</strong> applies automatically to outstanding balances exceeding the 7-day grace period.</p>
                    </div>
                </div>

            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 text-xs text-slate-500">
                <p class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Please note: All tuition, meal programs, and extracurricular fees are non-refundable.</span>
                </p>
                <a href="{{ url('/contact-us') }}" class="font-bold text-[#071330] hover:text-amber-600 transition-colors shrink-0">
                    Contact Finance Office →
                </a>
            </div>

        </div>
    </section>

</div>

@endsection