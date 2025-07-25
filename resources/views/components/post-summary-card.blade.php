<x-filament::widget>
    <x-filament::card>
        {{-- Bagian Header Kartu --}}
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                Rekap Postingan
            </h2>
            <x-heroicon-o-chart-bar class="w-6 h-6 text-gray-400 dark:text-gray-500" />
        </div>

        {{-- Angka Statistik Utama --}}
        <div class="mt-4 text-center">
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Postingan</p>
            <p class="text-5xl font-bold tracking-tight text-primary-600">
                {{ $totalPosts }}
            </p>
        </div>

        {{-- Garis Pemisah --}}
        <div class="my-6 border-t border-gray-200 dark:border-gray-700"></div>

        {{-- Bagian Rincian per Platform --}}
        <div>
            <h3 class="text-base font-medium text-gray-700 dark:text-gray-300">
                Rincian per Platform
            </h3>
            <ul class="mt-3 space-y-3">
                @forelse ($platformCounts as $item)
                    <li class="flex items-center justify-between text-sm">
                        <span class="flex items-center text-gray-600 dark:text-gray-400">
                            {{-- Anda bisa membuat helper untuk ikon di sini jika mau --}}
                            <x-dynamic-component :component="$this->getPlatformIcon($item->platform)" class="w-4 h-4 mr-3" />
                            {{ Str::headline($item->platform) }}
                        </span>
                        <span class="px-2 py-0.5 text-xs font-semibold text-primary-700 bg-primary-100 rounded-full">
                            {{ $item->total }}
                        </span>
                    </li>
                @empty
                    <li class="text-sm text-center text-gray-500">
                        Belum ada data postingan.
                    </li>
                @endforelse
            </ul>
        </div>
    </x-filament::card>
</x-filament::widget>