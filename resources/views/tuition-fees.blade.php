@extends('layout')

@section('title', __('Tuition & Fees - Life International School'))

@section('content')

@php
    $categories = $tuitionFees->pluck('category')->unique()->filter()->values();
@endphp

<div x-data="{ activeTab: 'all' }" class="min-h-screen bg-[#fafbfc] text-slate-800">

    {{-- 🏛️ 1. Clean Academic Header (សាមញ្ញ ថ្លៃថ្នូរ មិនដដែលៗ) --}}
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

    {{-- 📊 2. Master Institutional Ledger Table (ស្តង់ដារតារាងប្រៀបធៀបច្បាស់លាស់) --}}
    <main class="max-w-6xl mx-auto px-6 py-12">
        
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            
            {{-- Table Control Bar --}}
            <div class="px-8 py-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
                <div>
                    <h3 class="text-base font-black text-[#081747]">Tuition Fee Schedule</h3>
                    <p class="text-xs text-slate-500">All prices are quoted in USD ($)</p>
                </div>
                <div class="flex items-center gap-3">
                    <button onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-700 hover:bg-slate-50 transition-colors shadow-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        <span>Print Schedule</span>
                    </button>
                    <a href="{{ url('/enrollment') }}" class="inline-flex items-center gap-2 px-5 py-2 rounded-xl bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold uppercase tracking-wider transition-colors shadow-sm">
                        <span>Apply Online</span>
                    </a>
                </div>
            </div>

            {{-- The Comparison Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50 text-[11px] font-black uppercase tracking-wider text-slate-500">
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
                                $slugCat = Str::slug($fee->category);
                            @endphp
                            <tr x-show="activeTab === 'all' || activeTab === '{{ $slugCat }}'" 
                                class="hover:bg-amber-50/40 transition-colors">
                                
                                {{-- Program Name & Badge --}}
                                <td class="py-5 px-6">
                                    <div class="flex items-center gap-3">
                                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                        <div>
                                            <p class="font-black text-[#081747] text-base leading-snug">{{ $fee->program_name }}</p>
                                            <span class="text-[11px] font-bold text-slate-400 uppercase">{{ $fee->category }}</span>
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

                                {{-- Monthly Fee (Highlighted) --}}
                                <td class="py-5 px-6 text-center">
                                    <span class="inline-block font-black text-lg text-emerald-700 bg-emerald-50 border border-emerald-200/60 px-3.5 py-1 rounded-xl">
                                        {{ $fee->monthly_fee }}
                                    </span>
                                    <span class="block text-[10px] text-slate-400 mt-0.5">per month</span>
                                </td>

                                {{-- Annual Fee --}}
                                <td class="py-5 px-6 text-center font-bold text-slate-800">
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

    {{-- 📜 3. Clear Financial Terms Section --}}
    <section class="max-w-6xl mx-auto px-6 pb-24">
        <div class="rounded-3xl bg-white border border-slate-200 p-8 md:p-10 shadow-xs">
            
            <div class="flex items-center justify-between border-b border-slate-100 pb-6 mb-8">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-600">Accounting Terms</span>
                    <h3 class="text-xl font-black text-[#081747] mt-0.5">Billing & Payment Policies</h3>
                </div>
                <div class="flex items-center gap-4">
                    <img src="{{ asset('images/lis-logo.png') }}" alt="LIS" class="h-8 w-auto object-contain opacity-80">
                    <img src="{{ asset('images/acsi-logo.png') }}" alt="ACSI" class="h-8 w-auto object-contain opacity-80">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-xs text-slate-600">
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100">
                    <span class="font-bold text-slate-900 block text-sm mb-1">01. Monthly Due Date</span>
                    Payments are due on the <strong>1st of every month</strong>. Invoices are issued one week prior.
                </div>
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100">
                    <span class="font-bold text-slate-900 block text-sm mb-1">02. Grace Period</span>
                    A courtesy grace period of <strong>7 calendar days</strong> is provided before penalty assessment.
                </div>
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100">
                    <span class="font-bold text-slate-900 block text-sm mb-1">03. Late Penalty</span>
                    A <strong>10% late surcharge</strong> is automatically applied to accounts overdue beyond the grace period.
                </div>
            </div>

            <p class="mt-6 pt-6 border-t border-slate-100 text-[11px] text-slate-400 text-center">
                All tuition payments, lunch services, and co-curricular program fees are strictly non-refundable. For special fee inquiries, contact the finance office.
            </p>

        </div>
    </section>

</div>

@endsection