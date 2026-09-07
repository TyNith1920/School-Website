<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex flex-col gap-y-6 sm:flex-row sm:items-center sm:justify-between">
            
            {{-- ផ្នែកខាងឆ្វេង: រូប Profile និងអត្ថបទស្វាគមន៍ --}}
            <div class="flex items-center gap-x-4">
                
                <!-- 📍 រូប Logo ត្រូវបានចាក់សោទំហំយ៉ាងតឹងរ៉ឹង (Locked Size) មិនឱ្យរីកធំបានទៀតទេ -->
                <div class="relative flex h-16 w-16 min-w-[64px] shrink-0 items-center justify-center overflow-hidden rounded-full border border-gray-200 bg-white p-1 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <img 
                        src="{{ asset('images/logo.png') }}" 
                        alt="School Logo" 
                        class="h-full w-full object-contain"
                        style="max-width: 100%; height: auto;"
                    >
                </div>
                
                <div>
                    <h2 class="text-xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-2xl">
                        Welcome back, {{ auth()->user()->name ?? 'Admin' }}! 👋
                    </h2>
                    <p class="mt-1 text-sm font-medium text-gray-500 dark:text-gray-400">
                        Life International School Management System
                    </p>
                </div>
            </div>

            {{-- ផ្នែកខាងស្តាំ: ប៊ូតុង Shortcut ងាយៗ --}}
            <div class="flex flex-wrap items-center gap-3">
                
                <!-- ប៊ូតុងទៅមើលវេបសាយខាងមុខ (Frontend) -->
                <x-filament::button 
                    tag="a" 
                    href="{{ url('/') }}" 
                    target="_blank" 
                    color="gray" 
                    icon="heroicon-m-globe-alt"
                >
                    View Website
                </x-filament::button>

                <!-- ប៊ូតុងបង្កើតពត៌មានថ្មី (Add News) រហ័ស -->
                <x-filament::button 
                    tag="a" 
                    href="{{ \App\Filament\Resources\NewsResource::getUrl('create') }}" 
                    color="primary" 
                    icon="heroicon-m-newspaper"
                >
                    Add New News
                </x-filament::button>

            </div>
            
        </div>
    </x-filament::section>
</x-filament-widgets::widget>