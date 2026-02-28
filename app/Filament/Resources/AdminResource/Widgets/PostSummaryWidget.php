<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Models\Platform;
use App\Models\Post;
use Filament\Widgets\Widget;

class PostSummaryWidget extends Widget
{
    protected static string $view = 'components.post-summary-card';

    protected static ?string $pollingInterval = '30s';

    protected function getViewData(): array
    {
        return [
            'totalPosts' => Post::count(),
            'platformCounts' => Post::selectRaw('platform, COUNT(*) as total')
                ->groupBy('platform')
                ->orderByDesc('total')
                ->get(),
        ];
    }

    /**
     * Helper untuk memilih ikon berdasarkan nama platform.
     * Mengambil dari database, fallback ke default.
     */
    public function getPlatformIcon(string $platformCode): string
    {
        $platform = Platform::where('code', $platformCode)->first();

        return $platform?->icon ?? 'heroicon-o-document-text';
    }
}