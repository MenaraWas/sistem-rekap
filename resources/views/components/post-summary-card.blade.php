<x-filament::widget>
    <x-filament::card>
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white">Jumlah per Platform</h3>
            <x-heroicon-o-squares-2x2 class="w-5 h-5 text-gray-400" />
        </div>

        <div class="space-y-3">
            @forelse ($platformCounts as $item)
                @php
                    $platform = $platforms[$item->platform] ?? null;
                    $badgeColor = 'bg-white text-gray-700 dark:bg-white/10 dark:text-gray-300 ring-1 ring-gray-200 dark:ring-gray-600';
                @endphp
                <div
                    class="flex items-center justify-between py-1.5 border-b border-gray-100 dark:border-gray-700 last:border-0">
                    <div class="flex items-center gap-2.5">
                        @if($platform)
                            <x-dynamic-component :component="$platform->icon"
                                class="w-4 h-4 text-gray-500 dark:text-gray-400 shrink-0" />
                        @endif
                        <span class="text-sm text-gray-700 dark:text-gray-300">
                            {{ $platform->name ?? Str::headline($item->platform) }}
                        </span>
                    </div>
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $badgeColor }}">
                        {{ $item->total }}
                    </span>
                </div>
            @empty
                <div class="text-center py-6">
                    <x-heroicon-o-inbox class="w-8 h-8 text-gray-300 dark:text-gray-600 mx-auto" />
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Belum ada data</p>
                </div>
            @endforelse
        </div>
    </x-filament::card>
</x-filament::widget>