<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Life International School')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Moul&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }

        /* 📍 លាក់ Google Translate មិនឱ្យរំខាន */
        .goog-te-banner-frame.skiptranslate { display: none !important; }
        body { top: 0px !important; }
        .goog-tooltip { display: none !important; }
        .goog-tooltip:hover { display: none !important; }
        .goog-text-highlight { background-color: transparent !important; border: none !important; box-shadow: none !important; }
        #google_translate_element { display: none !important; }
        .skiptranslate { display: none !important; }

        /* 📍 Animation សម្រាប់ខ្សែបន្ទាត់អក្សររត់ខាងលើបង្អស់ */
        @keyframes marquee {
            0% { transform: translateX(0%); }
            100% { transform: translateX(-50%); }
        }
        .animate-marquee {
            display: inline-flex;
            animation: marquee 20s linear infinite;
        }
    </style>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans flex flex-col min-h-screen">

    @php
        $siteSetting = \App\Models\SiteSetting::first();$footer = \App\Models\Footer::first();
    @endphp

    {{-- 🌟 Top Announcement Marquee Bar (Full Width & Clean Left Badge) --}}
    @if(isset($siteSetting) && $siteSetting->show_announcement && !empty($siteSetting->announcement_text))
        <div class="relative z-[120] w-full bg-[#081747] text-white border-b border-amber-400/20 overflow-hidden select-none">
            <div class="w-full px-3 sm:px-6 flex items-center h-8 sm:h-9 text-[11px] sm:text-xs">
                
                {{-- ស្លាកពាក្យ Badge ខាងឆ្វេង (មាន Background ការពារអក្សររត់កាត់) --}}
                <div class="relative z-20 flex items-center gap-1.5 bg-gradient-to-r from-amber-400 to-orange-500 text-slate-950 font-black px-2.5 py-0.5 rounded text-[9px] sm:text-xs uppercase tracking-wider shrink-0 shadow-md mr-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-slate-950 animate-ping"></span>
                    <span>{{ __($siteSetting->announcement_badge ?? 'ANNOUNCEMENT') }}</span>
                </div>

                {{-- ផ្នែកអក្សររត់ (Full-Width Marquee Container) --}}
                <div class="relative w-full overflow-hidden group flex-1">
                    <div class="flex whitespace-nowrap animate-marquee group-hover:[animation-play-state:paused] gap-12 items-center text-blue-100">
                        <span class="font-medium tracking-wide">
                            {{ __($siteSetting->announcement_text) }}
                        </span>
                        <span class="text-amber-400 font-bold">✦</span>
                        <span class="font-medium tracking-wide" aria-hidden="true">
                            {{ __($siteSetting->announcement_text) }}
                        </span>
                        <span class="text-amber-400 font-bold">✦</span>
                        <span class="font-medium tracking-wide" aria-hidden="true">
                            {{ __($siteSetting->announcement_text) }}
                        </span>
                        <span class="text-amber-400 font-bold">✦</span>
                        <span class="font-medium tracking-wide" aria-hidden="true">
                            {{ __($siteSetting->announcement_text) }}
                        </span>
                    </div>
                </div>

            </div>
        </div>
   {{-- 🌟 Top Announcement Marquee Bar (មានតែមួយគត់ ពេញទទឹងស្អាត) --}}
    @if(isset($siteSetting) && $siteSetting->show_announcement && !empty($siteSetting->announcement_text))
        <div class="relative z-[120] w-full bg-[#081747] text-white border-b border-amber-400/20 overflow-hidden select-none">
            <div class="w-full px-4 sm:px-6 flex items-center h-8 sm:h-9 text-[11px] sm:text-xs">
                
                {{-- ស្លាកពាក្យ Badge ខាងឆ្វេង --}}
                <div class="relative z-20 flex items-center gap-1.5 bg-gradient-to-r from-amber-400 to-orange-500 text-slate-950 font-black px-2.5 py-0.5 rounded text-[9px] sm:text-xs uppercase tracking-wider shrink-0 shadow-md mr-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-slate-950 animate-ping"></span>
                    <span>{{ __($siteSetting->announcement_badge ?? 'ANNOUNCEMENT') }}</span>
                </div>

                {{-- ផ្នែកអក្សររត់ --}}
                <div class="relative w-full overflow-hidden group flex-1">
                    <div class="flex whitespace-nowrap animate-marquee group-hover:[animation-play-state:paused] gap-12 items-center text-blue-100">
                        <span class="font-medium tracking-wide">
                            {{ __($siteSetting->announcement_text) }}
                        </span>
                        <span class="text-amber-400 font-bold">✦</span>
                        <span class="font-medium tracking-wide" aria-hidden="true">
                            {{ __($siteSetting->announcement_text) }}
                        </span>
                        <span class="text-amber-400 font-bold">✦</span>
                        <span class="font-medium tracking-wide" aria-hidden="true">
                            {{ __($siteSetting->announcement_text) }}
                        </span>
                    </div>
                </div>

            </div>
        </div>
    {{-- 🌟 Top Announcement Marquee Bar --}}
    @if(isset($siteSetting) && $siteSetting->show_announcement && !empty($siteSetting->announcement_text))
        <div class="relative z-[120] w-full bg-[#081747] text-white border-b border-amber-400/20 overflow-hidden select-none">
            <div class="w-full px-4 sm:px-6 flex items-center h-8 sm:h-9 text-[11px] sm:text-xs">
                
                {{-- ស្លាក Badge ខាងឆ្វេង --}}
                <div class="relative z-20 flex items-center gap-1.5 bg-gradient-to-r from-amber-400 to-orange-500 text-slate-950 font-black px-2.5 py-0.5 rounded text-[9px] sm:text-xs uppercase tracking-wider shrink-0 shadow-md mr-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-slate-950 animate-ping"></span>
                    <span>{{ __($siteSetting->announcement_badge ?? 'ANNOUNCEMENT') }}</span>
                </div>

                {{-- ផ្នែកអក្សររត់ Full Width --}}
                <div class="relative w-full overflow-hidden group flex-1">
                    <div class="flex whitespace-nowrap animate-marquee group-hover:[animation-play-state:paused] gap-12 items-center text-blue-100">
                        <span class="font-medium tracking-wide">
                            {{ __($siteSetting->announcement_text) }}
                        </span>
                        <span class="text-amber-400 font-bold">✦</span>
                        <span class="font-medium tracking-wide" aria-hidden="true">
                            {{ __($siteSetting->announcement_text) }}
                        </span>
                        <span class="text-amber-400 font-bold">✦</span>
                        <span class="font-medium tracking-wide" aria-hidden="true">
                            {{ __($siteSetting->announcement_text) }}
                        </span>
                    </div>
                </div>

            </div>
        </div>
    @endif
    <!-- MASTER NAVBAR -->
    <nav x-data="{ mobileMenuOpen: false }" class="notranslate flex items-center justify-between px-6 py-4 bg-[#e8e6e1] shadow-md sticky top-0 z-[100] transition-all duration-300">
        
        <!-- ផ្នែកខាងឆ្វេង: Logo -->
        <div class="flex items-center shrink-0">
            <a href="/" class="notranslate group flex items-center gap-3 transition">
                <img src="{{ asset('images/logo.png') }}" class="h-12 lg:h-14 xl:h-16 w-auto transition-transform duration-500 group-hover:scale-105" alt="Logo">
                <div class="flex flex-col justify-center transition-all duration-300">
                    <span class="text-[#0b1240] text-lg lg:text-xl xl:text-2xl leading-none mb-1 drop-shadow-sm group-hover:text-[#e06d64] transition-colors duration-300" 
                          style="font-family: 'Moul', 'Khmer OS Muol', cursive;">
                        សាលាអន្តរជាតិ ឡាយហ្វ
                    </span>
                    <span class="text-[#0b1240] font-bold text-xs lg:text-sm xl:text-[15px] tracking-[0.2em] uppercase drop-shadow-sm mt-0.5 group-hover:text-[#e06d64] transition-colors duration-300" 
                          style="font-family: 'Times New Roman', Times, serif;">
                        LIFE INTERNATIONAL SCHOOL
                    </span>
                </div>
            </a>
        </div>

        <!-- Mobile Button -->
        <div class="block lg:hidden">
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-[#0b1240] hover:text-[#e06d64] focus:outline-none transition-colors duration-300">
                <svg x-show="!mobileMenuOpen" class="w-8 h-8 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                <svg x-cloak x-show="mobileMenuOpen" class="w-8 h-8 transition-transform duration-300 rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- ផ្នែកខាងស្តាំ: Menu -->
        <div :class="mobileMenuOpen ? 'flex' : 'hidden'" class="absolute top-full left-0 w-full bg-[#e8e6e1]/95 backdrop-blur-md flex-col px-6 pb-6 shadow-xl lg:static lg:flex lg:flex-row lg:items-center lg:space-x-4 xl:space-x-6 lg:w-auto lg:bg-transparent lg:p-0 lg:shadow-none uppercase font-bold text-[11px] xl:text-sm tracking-wider z-50 transition-all duration-300 ease-in-out">
            
            <!-- ABOUT Dropdown -->
            <div class="relative w-full lg:w-auto mt-4 lg:mt-0" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <a @click="open = !open" class="group hover:text-[#e06d64] py-2 lg:py-4 block w-full flex justify-between items-center cursor-pointer transition-colors duration-300 {{ request()->is('history*', 'accreditations*', 'campus*', 'child-safeguarding*') ? 'text-[#e06d64]' : 'text-[#0b1240]' }}">
                    {{ __('ABOUT') }}
                    <svg :class="open ? 'rotate-180 text-[#e06d64]' : ''" class="w-4 h-4 lg:hidden transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </a>
                <div x-cloak x-show="open" class="lg:absolute left-0 top-full lg:pt-2 w-full lg:w-60 z-50">
                    <div class="bg-white/95 backdrop-blur-sm lg:shadow-xl py-2 text-gray-700 lg:border-t-2 lg:border-[#e06d64] ml-4 lg:ml-0 border-l-2 border-[#e06d64] lg:border-l-0 rounded-b-lg lg:rounded-none overflow-hidden">
                        <a href="/history" class="block px-4 py-2.5 hover:bg-orange-50 hover:text-[#e06d64] transition-all duration-300 {{ request()->is('history*') ? 'text-[#e06d64] bg-orange-50/50' : '' }}">{{ __('HISTORY') }}</a>
                        <a href="/accreditations" class="block px-4 py-2.5 hover:bg-orange-50 hover:text-[#e06d64] transition-all duration-300 {{ request()->is('accreditations*') ? 'text-[#e06d64] bg-orange-50/50' : '' }}">{{ __('ACREDITATIONS') }}</a>
                        <a href="/campus" class="block px-4 py-2.5 hover:bg-orange-50 hover:text-[#e06d64] transition-all duration-300 {{ request()->is('campus*') ? 'text-[#e06d64] bg-orange-50/50' : '' }}">{{ __('CAMPUS') }}</a>
                        <a href="/child-safeguarding" class="block px-4 py-2.5 hover:bg-orange-50 hover:text-[#e06d64] transition-all duration-300 {{ request()->is('child-safeguarding*') ? 'text-[#e06d64] bg-orange-50/50' : '' }}">{{ __('CHILD SAFEGUARDING') }}</a>
                    </div>
                </div>
            </div>

            <!-- ADMISSIONS Dropdown -->
            <div class="relative w-full lg:w-auto" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <a @click="open = !open" class="group hover:text-[#e06d64] py-2 lg:py-4 block w-full flex justify-between items-center cursor-pointer transition-colors duration-300 {{ request()->is('enrollment*', 'tuition-fees*') ? 'text-[#e06d64]' : 'text-[#0b1240]' }}">
                    {{ __('ADMISSIONS') }}
                    <svg :class="open ? 'rotate-180 text-[#e06d64]' : ''" class="w-4 h-4 lg:hidden transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </a>
                <div x-cloak x-show="open" class="lg:absolute left-0 top-full lg:pt-2 w-full lg:w-48 z-50">
                    <div class="bg-white/95 backdrop-blur-sm lg:shadow-xl py-2 text-gray-700 lg:border-t-2 lg:border-[#e06d64] ml-4 lg:ml-0 border-l-2 border-[#e06d64] lg:border-l-0 rounded-b-lg lg:rounded-none overflow-hidden">
                        <a href="/enrollment" class="block px-4 py-2.5 hover:bg-orange-50 hover:text-[#e06d64] transition-all duration-300 {{ request()->is('enrollment*') ? 'text-[#e06d64] bg-orange-50/50' : '' }}">{{ __('ENROLLMENT') }}</a>
                        <a href="/tuition-fees" class="block px-4 py-2.5 hover:bg-orange-50 hover:text-[#e06d64] transition-all duration-300 {{ request()->is('tuition-fees*') ? 'text-[#e06d64] bg-orange-50/50' : '' }}">{{ __('TUITION FEES') }}</a>
                    </div>
                </div>
            </div>

            <!-- ACADEMICS Dropdown -->
            <div class="relative w-full lg:w-auto" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <a @click="open = !open" class="group hover:text-[#e06d64] py-2 lg:py-4 block w-full flex justify-between items-center cursor-pointer transition-colors duration-300 {{ request()->is('ece*', 'elementary-school*', 'secondary-school*') ? 'text-[#e06d64]' : 'text-[#0b1240]' }}">
                    {{ __('ACADEMICS') }}
                    <svg :class="open ? 'rotate-180 text-[#e06d64]' : ''" class="w-4 h-4 lg:hidden transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </a>
                <div x-cloak x-show="open" class="lg:absolute left-0 top-full lg:pt-2 w-full lg:w-56 z-50">
                    <div class="bg-white/95 backdrop-blur-sm lg:shadow-xl py-2 text-gray-700 lg:border-t-2 lg:border-[#e06d64] ml-4 lg:ml-0 border-l-2 border-[#e06d64] lg:border-l-0 rounded-b-lg lg:rounded-none overflow-hidden">
                        <a href="/ece" class="block px-4 py-2.5 hover:bg-orange-50 hover:text-[#e06d64] transition-all duration-300 {{ request()->is('ece*') ? 'text-[#e06d64] bg-orange-50/50' : '' }}">{{ __('ECE') }}</a>
                        <a href="/elementary-school" class="block px-4 py-2.5 hover:bg-orange-50 hover:text-[#e06d64] transition-all duration-300 {{ request()->is('elementary-school*') ? 'text-[#e06d64] bg-orange-50/50' : '' }}">{{ __('ELEMENTARY') }}</a>
                        <a href="/secondary-school" class="block px-4 py-2.5 hover:bg-orange-50 hover:text-[#e06d64] transition-all duration-300 {{ request()->is('secondary-school*') ? 'text-[#e06d64] bg-orange-50/50' : '' }}">{{ __('SECONDARY') }}</a>
                    </div>
                </div>
            </div>

            <!-- COMMUNITY Dropdown -->
            <div class="relative w-full lg:w-auto" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <a @click="open = !open" class="group hover:text-[#e06d64] py-2 lg:py-4 block w-full flex justify-between items-center cursor-pointer transition-colors duration-300 {{ request()->is('news-events*', 'student-life*') ? 'text-[#e06d64]' : 'text-[#0b1240]' }}">
                    {{ __('COMMUNITY') }}
                    <svg :class="open ? 'rotate-180 text-[#e06d64]' : ''" class="w-4 h-4 lg:hidden transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </a>
                <div x-cloak x-show="open" class="lg:absolute left-0 top-full lg:pt-2 w-full lg:w-48 z-50">
                    <div class="bg-white/95 backdrop-blur-sm lg:shadow-xl py-2 text-gray-700 lg:border-t-2 lg:border-[#e06d64] ml-4 lg:ml-0 border-l-2 border-[#e06d64] lg:border-l-0 rounded-b-lg lg:rounded-none overflow-hidden">
                        <a href="/news-events" class="block px-4 py-2.5 hover:bg-orange-50 hover:text-[#e06d64] transition-all duration-300 {{ request()->is('news-events*') ? 'text-[#e06d64] bg-orange-50/50' : '' }}">{{ __('NEWS & EVENTS') }}</a>
                        <a href="/student-life" class="block px-4 py-2.5 hover:bg-orange-50 hover:text-[#e06d64] transition-all duration-300 {{ request()->is('student-life*') ? 'text-[#e06d64] bg-orange-50/50' : '' }}">{{ __('STUDENT LIFE') }}</a>
                    </div>
                </div>
            </div>

            <!-- CAREERS & CONTACT US -->
            <a href="/careers" class="hover:text-[#e06d64] py-2 lg:py-4 block w-full lg:w-auto uppercase transition-colors duration-300 {{ request()->is('careers*') ? 'text-[#e06d64]' : 'text-[#0b1240]' }}">{{ __('CAREERS') }}</a>
            <a href="/contact-us" class="hover:text-[#e06d64] py-2 lg:py-4 block w-full lg:w-auto uppercase transition-colors duration-300 {{ request()->is('contact-us*') ? 'text-[#e06d64]' : 'text-[#0b1240]' }}">{{ __('CONTACT US') }}</a>

            <div class="hidden lg:block h-6 w-px bg-gray-400 mx-2 xl:mx-4"></div>

            <!-- 📍 ប៊ូតុងប្តូរភាសា -->
            <div class="relative py-4 lg:py-0 lg:ml-6 notranslate" x-data="{ langOpen: false }" @click.away="langOpen = false">
                <button @click="langOpen = !langOpen" class="flex items-center gap-2 text-[#0b1240] hover:text-[#e06d64] font-bold text-xs lg:text-sm uppercase transition-colors duration-300 cursor-pointer">
                    @if(session('locale') == 'km')
                        <img src="https://flagcdn.com/w40/kh.png" alt="Khmer" class="w-5 h-auto rounded-[2px] shadow-sm">
                        <span>LANGUAGE</span>
                    @else
                        <img src="https://flagcdn.com/w40/gb.png" alt="English" class="w-5 h-auto rounded-[2px] shadow-sm">
                        <span>LANGUAGE</span>
                    @endif
                    <svg class="w-4 h-4 transition-transform duration-300" :class="langOpen ? 'rotate-180 text-[#e06d64]' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                
                <div x-cloak x-show="langOpen" class="absolute left-0 lg:left-auto lg:right-0 mt-3 w-40 bg-white/95 backdrop-blur-md rounded-xl shadow-xl py-2 border border-gray-100 z-[100] overflow-hidden">
                    <a href="{{ route('lang.switch', 'km') }}" onclick="setGoogleTranslateCookie('km')" class="flex items-center gap-3 px-4 py-2.5 text-sm font-bold transition-all duration-300 hover:translate-x-1.5 {{ session('locale') == 'km' ? 'bg-orange-50 text-[#e06d64]' : 'text-gray-600 hover:bg-orange-50 hover:text-[#e06d64]' }}">
                        <img src="https://flagcdn.com/w40/kh.png" alt="Khmer Flag" class="w-6 h-auto rounded-sm shadow-md border border-gray-100">
                        <span>ភាសាខ្មែរ</span>
                    </a>
                    <a href="{{ route('lang.switch', 'en') }}" onclick="setGoogleTranslateCookie('en')" class="flex items-center gap-3 px-4 py-2.5 text-sm font-bold transition-all duration-300 hover:translate-x-1.5 {{ session('locale') != 'km' ? 'bg-orange-50 text-[#e06d64]' : 'text-gray-600 hover:bg-orange-50 hover:text-[#e06d64]' }}">
                        <img src="https://flagcdn.com/w40/gb.png" alt="UK Flag" class="w-6 h-auto rounded-sm shadow-md border border-gray-100">
                        <span>English</span>
                    </a>
                </div>
            </div>

            <!-- Social Links -->
            <div class="flex items-center space-x-5 xl:space-x-6 py-4 lg:py-0 lg:ml-2 text-[#0b1240] w-full lg:w-auto">
                <a href="{{ $siteSetting->facebook ?? '#' }}" target="_blank" class="hover:text-[#e06d64] hover:-translate-y-1 transition-all duration-300"><svg class="w-5 h-5 lg:w-4 lg:h-4 xl:w-5 xl:h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg></a>
                <a href="{{ $siteSetting->instagram ?? '#' }}" target="_blank" class="hover:text-[#e06d64] hover:-translate-y-1 transition-all duration-300"><svg class="w-5 h-5 lg:w-4 lg:h-4 xl:w-5 xl:h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg></a>
                <a href="mailto:{{ $siteSetting->email ?? 'info@life.edu.kh' }}" class="hover:text-[#e06d64] hover:-translate-y-1 transition-all duration-300"><svg class="w-5 h-5 lg:w-4 lg:h-4 xl:w-5 xl:h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg></a>
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- MASTER FOOTER -->
    @php
        $getFooterImg = function($path) {
            if (empty($path)) return null;
            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) return $path;
            try {
                return \Storage::disk('s3')->url($path);
            } catch (\Exception $e) {
                return asset('storage/' . $path);
            }
        };
    @endphp

    <footer class="notranslate bg-[#0b1240] text-white pt-10 pb-8 mt-12 border-t-4 border-[#e06d64]">
        <div class="max-w-7xl mx-auto px-6">
            
            <div class="mb-8">
                <form action="{{ route('search') }}" method="GET" class="relative max-w-full">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input type="text" name="query" value="{{ request('query') }}" placeholder="Search..." class="w-full bg-white/10 border border-gray-600 rounded-md py-3 pl-12 pr-4 focus:outline-none focus:border-[#e06d64] text-sm text-white placeholder-gray-400 transition">
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8 text-gray-300 text-sm">
                <div class="lg:col-span-1 overflow-hidden">
                    <div class="flex items-center space-x-4 mb-6">
                        <h3 class="font-black text-lg tracking-wide text-[#e06d64] uppercase">{{ __('Truth | Integrity | Love') }}</h3>
                    </div>
                    
                    {{-- 📍 Foreach logos ដែលមាន space ត្រឹមត្រូវ --}}
                    <div class="flex items-center gap-4 mt-5">
                        @if(isset($footer) && !empty($footer->logos_image))
                            @php
                                $rawLogos =$footer->logos_image;
                                $logos = is_array($rawLogos) ? $rawLogos : (is_string($rawLogos) ? json_decode($rawLogos, true) ?? [$rawLogos] : []);
                            @endphp
                            
                            @foreach($logos as $logo)
                                @if($logo)
                                    <img src="{{ $getFooterImg($logo) }}" alt="Logo" class="h-8 md:h-10 w-auto shrink-0 object-contain hover:scale-110 transition-transform duration-300">
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>

                <div>
                    <h3 class="font-bold text-[#e06d64] mb-3">{{ __('Office Hours') }}</h3>
                    <p class="font-bold text-white">{{ __('Monday–Friday') }}</p>
                    <p class="mb-3">{{ $footer->weekdays_time ?? '08:00am-04:00pm' }}</p>
                    <p class="font-bold text-white">{{ __('Saturday') }}</p>
                    <p>{{ $footer->weekend_time ?? '08:00am-11:30am' }}</p>
                </div>

                <div>
                    <h3 class="font-bold text-[#e06d64] mb-3">{{ __('Contact & Location') }}</h3>
                    <p class="mb-1"><span class="font-bold text-white">{{ __('Telegram') }}:</span> {{ $footer->telegram ?? '' }}</p>
                    <p class="mb-1"><span class="font-bold text-white">{{ __('Phone') }}:</span> {{ $footer->phone ?? '' }}</p>
                    <p class="mb-4"><span class="font-bold text-white">{{ __('Email') }}:</span> {{ $footer->email ?? '' }}</p>
                    <p class="font-bold text-white mb-1">{{ __('Address') }}:</p>
                    <p class="text-gray-400 text-xs leading-relaxed pr-4">{{ $footer->address ?? '' }}</p>
                </div>

                <div class="flex flex-col items-start lg:items-center">
                    <h3 class="font-bold text-[#e06d64] mb-3">{{ __('Scan to Telegram') }}</h3>
                    @if(isset($footer) &&$footer->telegram_qr)
                        <div class="bg-white p-2 rounded-lg shadow-lg hover:scale-105 transition-transform duration-300">
                            <img src="{{ $getFooterImg($footer->telegram_qr) }}" alt="Telegram QR" class="w-24 h-24 md:w-28 md:h-28 object-contain">
                        </div>
                    @endif
                </div>
            </div>

            <hr class="border-gray-700 mb-8">

            <div class="flex flex-col md:flex-row justify-center items-center space-y-4 md:space-y-0 md:space-x-12 mb-4">
                <a href="/history" class="w-full md:w-auto border-2 border-[#e06d64] text-[#e06d64] font-bold py-2 px-16 rounded-full text-center hover:bg-[#e06d64] hover:text-white transition uppercase tracking-wider">{{ __('ABOUT') }}</a>
                <a href="/contact-us" class="w-full md:w-auto border-2 border-[#e06d64] text-[#e06d64] font-bold py-2 px-16 rounded-full text-center hover:bg-[#e06d64] hover:text-white transition uppercase tracking-wider">{{ __('CONTACT US') }}</a>
                <a href="/enrollment" class="w-full md:w-auto border-2 border-[#e06d64] text-[#e06d64] font-bold py-2 px-16 rounded-full text-center hover:bg-[#e06d64] hover:text-white transition uppercase tracking-wider">{{ __('ADMISSIONS') }}</a>
            </div>

            <div class="text-center text-gray-500 text-xs mt-8">
                &copy; {{ date('Y') }} Life International School. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- 📍 Google Translate Script -->
    <div id="google_translate_element"></div>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'km,en',
                autoDisplay: false
            }, 'google_translate_element');
        }

        function setGoogleTranslateCookie(lang) {
            document.cookie = `googtrans=/en/${lang}; path=/`;
            document.cookie = `googtrans=/en/${lang}; path=/; domain=${window.location.hostname}`;
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <!-- Scroll To Top Button -->
    <button onclick="scrollToTop()" id="scrollTopBtn" title="ត្រឡប់ទៅលើវិញ">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5z"/>
        </svg>
    </button>
    <style>
        #scrollTopBtn { display: none; position: fixed; bottom: 20px; right: 20px; z-index: 9999; border: none; outline: none; background-color: #1d00af; color: white; cursor: pointer; padding: 12px; border-radius: 50%; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.3); transition: background-color 0.3s, transform 0.3s; }
        #scrollTopBtn:hover { background-color: #150080; transform: translateY(-3px); }
    </style>
    <script>
        let mybutton = document.getElementById("scrollTopBtn");
        window.onscroll = function() { scrollFunction() };
        function scrollFunction() { if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) { mybutton.style.display = "block"; } else { mybutton.style.display = "none"; } }
        function scrollToTop() { window.scrollTo({ top: 0, behavior: 'smooth' }); }
    </script>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 800, once: true, offset: 100, easing: 'ease-out-cubic' });</script>

</body> 
</html>