<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Models\Platform;
use App\Models\Post;
use Filament\Widgets\Widget;

class PostSummaryWidget extends Widget
{
    protected static string $view = 'components.post-summary-card';

    protected static ?string $pollingInterval = '30s';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 1;

    protected function getViewData(): array
    {
        $platformCounts = Post::selectRaw('platform, COUNT(*) as total')
            ->groupBy('platform')
            ->orderByDesc('total')
            ->get();

        $platforms = Platform::all()->keyBy('code');

        return [
            'platformCounts' => $platformCounts,
            'platforms' => $platforms,
        ];
    }
}