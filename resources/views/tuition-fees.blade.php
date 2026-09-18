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
            'tag'    => 'bg-amber-100 text-amber-900 border-amber-300',
            'btn'    => 'bg-amber-500 hover:bg-amber-600',
        ],
        'green' => [
            'accent' => '#10b981',
            'dark'   => '#047857',
            'soft'   => '#ecfdf5',
            'border' => '#a7f3d0',
            'tag'    => 'bg-emerald-100 text-emerald-900 border-emerald-300',
            'btn'    => 'bg-emerald-500 hover:bg-emerald-600',
        ],
        'blue' => [
            'accent' => '#2563eb',
            'dark'   => '#1d4ed8',
            'soft'   => '#eff6ff',
            'border' => '#bfdbfe',
            'tag'    => 'bg-blue-100 text-blue-900 border-blue-300',
            'btn'    => 'bg-blue-600 hover:bg-blue-700',
        ],
        'red' => [
            'accent' => '#ef4444',
            'dark'   => '#b91c1c',
            'soft'   => '#fef2f2',
            'border' => '#fecaca',
            'tag'    => 'bg-rose-100 text-rose-900 border-rose-300',
            'btn'    => 'bg-rose-500 hover:bg-rose-600',
        ],
        'purple' => [
            'accent' => '#8b5cf6',
            'dark'   => '#6d28d9',
            'soft'   => '#f5f3ff',
            'border' => '#ddd6fe',
            'tag'    => 'bg-purple-100 text-purple-900 border-purple-300',
            'btn'    => 'bg-purple-600 hover:bg-purple-700',
        ],
    ];

    $categories = $tuitionFees->pluck('category')->unique()->filter()->values();
@endphp

<div x-data="{ activeTab: 'all' }" class="min-h-screen bg-[#f8fafc] text-slate-800">

    {{-- 🏛️ 1. Header Section ជាមួយ Logo ធំច្បាស់ --}}
    <section class="border-b border-slate-200 bg-white pt-16 pb-14 px-6">
        <div class="max-w-6xl mx-auto text-center">
            
            {{-- Accreditation Logos --}}
            <div class="inline-flex items-center gap-5 bg-slate-50 px-6 py-2.5 rounded-2xl border border-slate-200 shadow-xs mb-6">
                <img src="{{ asset('images/lis-logo.png') }}" alt="Life International School" class="h-10 sm:h-12 w-auto object-contain" />
                <span class="h-7 w-px bg-slate-300"></span>
                <img src="{{ asset('images/acsi-logo.png') }}" alt="ACSI Member" class="h-9 sm:h-11 w-auto object-contain" />
            </div>

            <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-[#081747] uppercase leading-tight">
                Tuition <span class="text-amber-500">&</span> Schedules
            </h1>

            <p class="mt-4 max-w-2xl mx-auto text-sm sm:text-base text-slate-500 leading-relaxed font-normal">
                Transparent fee structures for each educational stage from Early Learning to Secondary School.
            </p>

            {{-- Filter Tabs --}}
            @if(count($categories) > 1)
                <div class="mt-8 flex flex-wrap items-center justify-center gap-2">
                    <button @click="activeTab = 'all'"
                            :class="activeTab === 'all' ? 'bg-[#081747] text-white shadow-md' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                            class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider transition-all">
                        All Programs ({{ count($tuitionFees) }})
                    </button>
                    @foreach($categories as $cat)
                        <button @click="activeTab = '{{ Str::slug($cat) }}'"
                                :class="activeTab === '{{ Str::slug($cat) }}' ? 'bg-[#081747] text-white shadow-md' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                                class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider transition-all">
                            {{ $cat }}
                        </button>
                    @endforeach
                </div>
            @endif

        </div>
    </section>

    {{-- 💳 2. Tuition Fee Card Boxes (ទម្រង់ប្រអប់ធំៗ ងាយស្រួលមើល) --}}
    <main class="max-w-7xl mx-auto px-6 py-14">
        
        @if(count($tuitionFees) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($tuitionFees as $fee)
                    @php
                        $theme = $themes[$fee->theme_color] ?? $themes['yellow'];
                        $slugCat = Str::slug($fee->category);
                    @endphp

                    <div x-show="activeTab === 'all' || activeTab === '{{ $slugCat }}'"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-3"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="bg-white rounded-[2.2rem] border-2 border-slate-200/90 shadow-[0_15px_35px_rgba(15,23,42,0.06)] hover:shadow-[0_25px_50px_rgba(15,23,42,0.12)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between overflow-hidden">
                        
                        <div>
                            {{-- Card Top Strip --}}
                            <div class="h-2.5 w-full" style="background-color: {{ $theme['accent'] }};"></div>

                            {{-- Card Header --}}
                            <div class="p-7 pb-4">
                                <div class="flex items-center justify-between gap-3 mb-3">
                                    <span class="inline-block px-3.5 py-1 rounded-full text-xs font-black uppercase tracking-wider border {{ $theme['tag'] }}">
                                        {{ $fee->category }}
                                    </span>
                                    <div class="w-10 h-10 rounded-xl flex items-center justify-center border" style="background-color: {{ $theme['soft'] }}; color: {{ $theme['dark'] }}; border-color: {{ $theme['border'] }};">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    </div>
                                </div>

                                <h3 class="text-2xl font-black text-[#081747] uppercase tracking-tight">
                                    {{ $fee->program_name }}
                                </h3>

                                @if(filled($fee->time_schedule))
                                    <div class="mt-3 flex items-center gap-2 text-xs font-bold text-slate-600 bg-slate-100 rounded-xl px-3.5 py-2">
                                        <svg class="w-4 h-4 text-slate-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span class="truncate">{{ $fee->time_schedule }}</span>
                                    </div>
                                @endif
                            </div>

                            {{-- Monthly Tuition Highlight Box --}}
                            <div class="px-7 py-3">
                                <div class="p-6 rounded-2xl text-center border-2" style="background-color: {{ $theme['soft'] }}; border-color: {{ $theme['border'] }};">
                                    <span class="text-xs font-black uppercase tracking-[0.2em] text-slate-500 block">Monthly Tuition</span>
                                    <div class="text-5xl font-black tracking-tight mt-1" style="color: {{ $theme['dark'] }};">
                                        {{ $fee->monthly_fee }}
                                    </div>
                                    <span class="text-xs text-slate-500 font-bold block mt-1">Due on 1st of every month</span>
                                </div>
                            </div>

                            {{-- 📍 Additional Breakdown Fees (អក្សរធំ និងច្បាស់) --}}
                            <div class="p-7 pt-3 space-y-3">
                                
                                {{-- Annual Fee --}}
                                @if(filled($fee->annual_fee))
                                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/80 flex items-center justify-between">
                                        <div class="flex items-center gap-2.5">
                                            <span class="w-2.5 h-2.5 rounded-full bg-blue-600"></span>
                                            <span class="text-sm font-bold text-slate-700 uppercase tracking-wide">Annual Tuition</span>
                                        </div>
                                        <span class="text-lg font-black text-slate-900">{{ $fee->annual_fee }}</span>
                                    </div>
                                @endif

                                {{-- Lunch Fee --}}
                                @if(filled($fee->lunch_fee))
                                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/80 flex items-center justify-between">
                                        <div class="flex items-center gap-2.5">
                                            <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                                            <span class="text-sm font-bold text-slate-700 uppercase tracking-wide">{{ $fee->lunch_fee_label ?: 'Lunch / Snack' }}</span>
                                        </div>
                                        <span class="text-lg font-black text-slate-900">{{ $fee->lunch_fee }}</span>
                                    </div>
                                @endif

                                {{-- After School Fee --}}
                                @if(filled($fee->after_school_fee))
                                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/80 flex items-center justify-between">
                                        <div class="flex items-center gap-2.5">
                                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                            <span class="text-sm font-bold text-slate-700 uppercase tracking-wide">After School Club</span>
                                        </div>
                                        <span class="text-lg font-black text-slate-900">{{ $fee->after_school_fee }}</span>
                                    </div>
                                @endif

                            </div>
                        </div>

                        {{-- Apply Button --}}
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
                <p class="text-slate-500 font-bold">Tuition schedules will be available soon.</p>
            </div>
        @endif

    </main>

    {{-- 📜 3. Official Billing Policy & Payment Regulations --}}
    <section class="max-w-6xl mx-auto px-6 pb-24">
        <div class="rounded-[2.5rem] bg-white border border-slate-200/90 shadow-[0_15px_40px_rgba(15,23,42,0.06)] overflow-hidden">
            
            <div class="bg-gradient-to-r from-[#071330] via-[#0d2256] to-[#122e70] px-8 py-6 text-white flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-amber-400/20">
                <div class="flex items-center gap-3.5">
                    <div class="w-11 h-11 rounded-2xl bg-amber-400/10 text-amber-300 border border-amber-400/30 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-[0.25em] text-amber-300">Accounting Terms</span>
                        <h3 class="text-xl sm:text-2xl font-black text-white mt-0.5">Billing & Payment Policies</h3>
                    </div>
                </div>

                <div class="inline-flex items-center gap-2 bg-white/10 px-4 py-2 rounded-2xl border border-white/10 backdrop-blur-md text-xs font-bold text-blue-100">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span>Standard Financial Governance</span>
                </div>
            </div>

            <div class="p-8 md:p-10">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    {{-- 01. Due Date --}}
                    <div class="relative rounded-2xl p-6 bg-gradient-to-br from-blue-50/80 via-white to-blue-50/30 border border-blue-200/80">
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-10 h-10 rounded-xl bg-blue-600 text-white font-black text-sm flex items-center justify-center shadow-md shadow-blue-500/20">01</span>
                            <span class="text-[10px] font-black uppercase tracking-wider text-blue-700 bg-blue-100/70 px-2.5 py-1 rounded-full border border-blue-200">Schedule</span>
                        </div>
                        <h4 class="font-black text-slate-900 text-base mb-1.5">Monthly Due Date</h4>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Payments are due strictly on the <strong class="text-blue-900 font-bold">1st of every month</strong>. Invoices are issued one week prior.
                        </p>
                    </div>

                    {{-- 02. Grace Period --}}
                    <div class="relative rounded-2xl p-6 bg-gradient-to-br from-emerald-50/80 via-white to-emerald-50/30 border border-emerald-200/80">
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-10 h-10 rounded-xl bg-emerald-600 text-white font-black text-sm flex items-center justify-center shadow-md shadow-emerald-500/20">02</span>
                            <span class="text-[10px] font-black uppercase tracking-wider text-emerald-700 bg-emerald-100/70 px-2.5 py-1 rounded-full border border-emerald-200">Courtesy</span>
                        </div>
                        <h4 class="font-black text-slate-900 text-base mb-1.5">Grace Period</h4>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            A courtesy grace window of <strong class="text-emerald-900 font-bold">7 calendar days</strong> is provided before late procedures apply.
                        </p>
                    </div>

                    {{-- 03. Late Penalty --}}
                    <div class="relative rounded-2xl p-6 bg-gradient-to-br from-amber-50/80 via-white to-orange-50/30 border border-amber-200/80">
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-10 h-10 rounded-xl bg-amber-500 text-white font-black text-sm flex items-center justify-center shadow-md shadow-amber-500/20">03</span>
                            <span class="text-[10px] font-black uppercase tracking-wider text-amber-800 bg-amber-100/70 px-2.5 py-1 rounded-full border border-amber-200">Surcharge</span>
                        </div>
                        <h4 class="font-black text-slate-900 text-base mb-1.5">Late Penalty</h4>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            A <strong class="text-amber-900 font-bold">10% surcharge fee</strong> applies automatically to overdue balances beyond the 7-day window.
                        </p>
                    </div>

                </div>

                <div class="mt-8 p-4 rounded-2xl bg-[#fcfaf6] border border-amber-200/70 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                    <div class="flex items-center gap-2.5 text-slate-600">
                        <span class="w-2 h-2 rounded-full bg-amber-500 shrink-0"></span>
                        <span><strong>Policy Notice:</strong> All tuition payments, meal subscriptions, and extracurricular fees are non-refundable.</span>
                    </div>
                    <a href="{{ url('/contact-us') }}" class="font-bold text-[#071330] hover:text-amber-600 transition-colors uppercase tracking-wider text-[11px] shrink-0">
                        Finance Inquiry →
                    </a>
                </div>
            </div>

        </div>
    </section>

</div>

@endsection