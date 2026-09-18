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
            'dot'    => 'bg-amber-500',
            'badge'  => 'bg-amber-50 text-amber-800 border-amber-200',
        ],
        'green' => [
            'accent' => '#10b981',
            'dark'   => '#047857',
            'soft'   => '#ecfdf5',
            'border' => '#6ee7b7',
            'dot'    => 'bg-emerald-500',
            'badge'  => 'bg-emerald-50 text-emerald-800 border-emerald-200',
        ],
        'blue' => [
            'accent' => '#2563eb',
            'dark'   => '#1d4ed8',
            'soft'   => '#eff6ff',
            'border' => '#93c5fd',
            'dot'    => 'bg-blue-600',
            'badge'  => 'bg-blue-50 text-blue-800 border-blue-200',
        ],
        'red' => [
            'accent' => '#ef4444',
            'dark'   => '#b91c1c',
            'soft'   => '#fef2f2',
            'border' => '#fca5a5',
            'dot'    => 'bg-rose-500',
            'badge'  => 'bg-rose-50 text-rose-800 border-rose-200',
        ],
        'purple' => [
            'accent' => '#8b5cf6',
            'dark'   => '#6d28d9',
            'soft'   => '#f5f3ff',
            'border' => '#c4b5fd',
            'dot'    => 'bg-purple-600',
            'badge'  => 'bg-purple-50 text-purple-800 border-purple-200',
        ],
    ];

    $categories = $tuitionFees->pluck('category')->unique()->filter()->values();
@endphp

<div x-data="{ activeTab: 'all' }" class="min-h-screen bg-[#fafbfc] text-slate-800">

    {{-- 🏛️ 1. Header Section --}}
    <section class="border-b border-slate-200 bg-white pt-16 pb-14 px-6">
        <div class="max-w-6xl mx-auto text-center">
            
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-slate-100 border border-slate-200 text-slate-600 text-xs font-bold uppercase tracking-[0.2em] mb-4">
                Academic Year Investment
            </div>

            <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-[#081747] uppercase leading-tight">
                Tuition <span class="text-amber-500">&</span> Schedules
            </h1>

            <p class="mt-4 max-w-2xl mx-auto text-sm sm:text-base text-slate-500 leading-relaxed font-normal">
                Transparent and comprehensive tuition schedules for our ACSI-accredited international academic programs.
            </p>

            {{-- Category Filter Bar --}}
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

    {{-- 📊 2. Master Institutional Ledger Table --}}
    <main class="max-w-6xl mx-auto px-6 py-12">
        
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            
            {{-- 📍 Table Control Bar ជាមួយ Logo ធំច្បាស់នៅផ្នែកខាងស្ដាំ --}}
            <div class="px-8 py-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-slate-50/70">
                
                {{-- Left Info --}}
                <div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-amber-600">Official Schedule</span>
                    <h3 class="text-xl font-black text-[#081747] mt-0.5">Tuition & Fee Structure</h3>
                    <p class="text-xs text-slate-500 mt-1">All fees are quoted in USD ($) • Academic Year</p>
                </div>

                {{-- Right: Logo ធំច្បាស់ និងប៊ូតុង Actions --}}
                <div class="flex flex-wrap items-center gap-4">
                    
                    {{-- Logo LIS & ACSI --}}
                    <div class="flex items-center gap-3.5 bg-white px-4 py-2 rounded-2xl border border-slate-200/90 shadow-xs">
                        <img src="{{ asset('images/lis-logo.png') }}" alt="Life International School" class="h-10 w-auto object-contain" />
                        <span class="h-6 w-px bg-slate-200"></span>
                        <img src="{{ asset('images/acsi-logo.png') }}" alt="ACSI Member" class="h-9 w-auto object-contain" />
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center gap-2.5">
                        <button onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-700 hover:bg-slate-50 transition-colors shadow-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                            <span class="hidden sm:inline">Print</span>
                        </button>
                        <a href="{{ url('/enrollment') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold uppercase tracking-wider transition-colors shadow-sm">
                            <span>Apply Online</span>
                        </a>
                    </div>

                </div>
            </div>

            {{-- The Comparison Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50/50 text-[11px] font-black uppercase tracking-wider text-slate-500">
                            <th class="py-4 px-6">Program / Level</th>
                            <th class="py-4 px-6">Schedule / Hours</th>
                            <th class="py-4 px-6 text-center">Monthly Tuition</th>
                            <th class="py-4 px-6 text-center">Annual Tuition</th>
                            <th class="py-4 px-6 text-center">Lunch Program</th>
                            <th class="py-4 px-6 text-center">After School</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($tuitionFees as $fee)
                            @php
                                $theme = $themes[$fee->theme_color] ?? $themes['yellow'];
                                $slugCat = Str::slug($fee->category);
                            @endphp
                            <tr x-show="activeTab === 'all' || activeTab === '{{ $slugCat }}'" 
                                class="hover:bg-slate-50/80 transition-colors">
                                
                                {{-- Program Name ជាមួយអុជពណ៌តាម Theme Color ជាក់ស្តែង --}}
                                <td class="py-5 px-6">
                                    <div class="flex items-center gap-3">
                                        <span class="w-2.5 h-2.5 rounded-full shrink-0" style="background-color: {{ $theme['accent'] }};"></span>
                                        <div>
                                            <p class="font-black text-[#081747] text-base leading-snug">{{ $fee->program_name }}</p>
                                            <span class="inline-block mt-0.5 px-2.5 py-0.5 rounded-md text-[10px] font-black uppercase tracking-wider border {{ $theme['badge'] }}">
                                                {{ $fee->category }}
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                {{-- Schedule --}}
                                <td class="py-5 px-6">
                                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 bg-slate-100 px-3 py-1.5 rounded-lg">
                                        <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ $fee->time_schedule ?: 'Full Schedule' }}
                                    </span>
                                </td>

                                {{-- 📍 Monthly Fee Box លេងពណ៌តាម Theme Color ដើមរបស់កាតនីមួយៗ --}}
                                <td class="py-5 px-6 text-center">
                                    <span class="inline-block font-black text-xl px-4 py-1.5 rounded-xl border-2 shadow-xs"
                                          style="background-color: {{ $theme['soft'] }}; color: {{ $theme['dark'] }}; border-color: {{ $theme['border'] }};">
                                        {{ $fee->monthly_fee }}
                                    </span>
                                    <span class="block text-[10px] text-slate-400 font-medium mt-1">per month</span>
                                </td>

                                {{-- Annual Fee --}}
                                <td class="py-5 px-6 text-center font-black text-base text-slate-900">
                                    {{ $fee->annual_fee ?: '—' }}
                                </td>

                                {{-- Lunch Fee --}}
                                <td class="py-5 px-6 text-center font-bold text-slate-700">
                                    {{ $fee->lunch_fee ?: '—' }}
                                </td>

                                {{-- After School Fee --}}
                                <td class="py-5 px-6 text-center font-bold text-slate-700">
                                    {{ $fee->after_school_fee ?: '—' }}
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-slate-400 font-bold">
                                    No tuition information available.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Table Footer Note --}}
            <div class="p-6 bg-slate-50 border-t border-slate-100 text-xs text-slate-500 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <p>• Tuition fees cover standard instructional materials and classroom digital access.</p>
                <a href="{{ url('/enrollment') }}" class="font-bold text-orange-600 hover:underline">Download Full Enrollment Package →</a>
            </div>

        </div>

    </main>

    {{-- 📜 3. Official Billing Policy & Payment Regulations (លេងពណ៌កាត 3) --}}
    <section class="max-w-6xl mx-auto px-6 pb-24">
        <div class="rounded-[2.5rem] bg-white border border-slate-200/90 shadow-[0_15px_40px_rgba(15,23,42,0.06)] overflow-hidden">
            
            {{-- Top Header Banner --}}
            <div class="bg-gradient-to-r from-[#071330] via-[#0d2256] to-[#122e70] px-8 py-6 text-white flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-amber-400/20">
                <div class="flex items-center gap-3.5">
                    <div class="w-11 h-11 rounded-2xl bg-amber-400/10 text-amber-300 border border-amber-400/30 flex items-center justify-center shrink-0 shadow-inner">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-[0.25em] text-amber-300">Accounting Terms</span>
                        <h3 class="text-xl sm:text-2xl font-black text-white mt-0.5">Billing & Payment Policies</h3>
                    </div>
                </div>

                {{-- Partner Accreditation Info --}}
                <div class="inline-flex items-center gap-2 bg-white/10 px-4 py-2 rounded-2xl border border-white/10 backdrop-blur-md self-start sm:self-auto text-xs font-bold text-blue-100">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span>Standard Financial Governance</span>
                </div>
            </div>

            {{-- 3 Colored Policy Cards --}}
            <div class="p-8 md:p-10">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    {{-- Card 01: Blue Sapphire (Due Date) --}}
                    <div class="relative rounded-2xl p-6 bg-gradient-to-br from-blue-50/80 via-white to-blue-50/30 border border-blue-200/80 shadow-xs hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-10 h-10 rounded-xl bg-blue-600 text-white font-black text-sm flex items-center justify-center shadow-md shadow-blue-500/20">
                                01
                            </span>
                            <span class="text-[10px] font-black uppercase tracking-wider text-blue-700 bg-blue-100/70 px-2.5 py-1 rounded-full border border-blue-200">
                                Schedule
                            </span>
                        </div>
                        <h4 class="font-black text-slate-900 text-base mb-1.5">Monthly Due Date</h4>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Payments are due strictly on the <strong class="text-blue-900 font-bold">1st of every month</strong>. Invoices are issued one week prior to ensure smooth settlement.
                        </p>
                    </div>

                    {{-- Card 02: Emerald Green (Grace Period) --}}
                    <div class="relative rounded-2xl p-6 bg-gradient-to-br from-emerald-50/80 via-white to-emerald-50/30 border border-emerald-200/80 shadow-xs hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-10 h-10 rounded-xl bg-emerald-600 text-white font-black text-sm flex items-center justify-center shadow-md shadow-emerald-500/20">
                                02
                            </span>
                            <span class="text-[10px] font-black uppercase tracking-wider text-emerald-700 bg-emerald-100/70 px-2.5 py-1 rounded-full border border-emerald-200">
                                Courtesy
                            </span>
                        </div>
                        <h4 class="font-black text-slate-900 text-base mb-1.5">Grace Period</h4>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            A courtesy grace window of <strong class="text-emerald-900 font-bold">7 calendar days</strong> is provided to families before late procedures take effect.
                        </p>
                    </div>

                    {{-- Card 03: Amber Orange (Late Penalty) --}}
                    <div class="relative rounded-2xl p-6 bg-gradient-to-br from-amber-50/80 via-white to-orange-50/30 border border-amber-200/80 shadow-xs hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-10 h-10 rounded-xl bg-amber-500 text-white font-black text-sm flex items-center justify-center shadow-md shadow-amber-500/20">
                                03
                            </span>
                            <span class="text-[10px] font-black uppercase tracking-wider text-amber-800 bg-amber-100/70 px-2.5 py-1 rounded-full border border-amber-200">
                                Surcharge
                            </span>
                        </div>
                        <h4 class="font-black text-slate-900 text-base mb-1.5">Late Penalty</h4>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            A <strong class="text-amber-900 font-bold">10% surcharge fee</strong> applies automatically to any account balances overdue beyond the courtesy grace window.
                        </p>
                    </div>

                </div>

                {{-- Non-Refundable Notice Strip --}}
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