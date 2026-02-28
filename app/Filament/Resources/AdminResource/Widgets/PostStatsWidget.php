<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Models\Post;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PostStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalPosts = Post::count();
        $postsThisMonth = Post::whereMonth('date_posted', Carbon::now()->month)
            ->whereYear('date_posted', Carbon::now()->year)
            ->count();
        $postsThisWeek = Post::whereBetween('date_posted', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(),
        ])->count();

        // Hitung postingan bulan lalu untuk perbandingan
        $postsLastMonth = Post::whereMonth('date_posted', Carbon::now()->subMonth()->month)
            ->whereYear('date_posted', Carbon::now()->subMonth()->year)
            ->count();

        $monthDiff = $postsThisMonth - $postsLastMonth;
        $monthDescription = $monthDiff >= 0
            ? ($monthDiff . ' lebih banyak dari bulan lalu')
            : (abs($monthDiff) . ' lebih sedikit dari bulan lalu');
        $monthIcon = $monthDiff >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
        $monthColor = $monthDiff >= 0 ? 'success' : 'danger';

        return [
            Stat::make('Total Postingan', number_format($totalPosts))
                ->description('Keseluruhan data')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),

            Stat::make('Bulan Ini', number_format($postsThisMonth))
                ->description($monthDescription)
                ->descriptionIcon($monthIcon)
                ->color($monthColor),

            Stat::make('Minggu Ini', number_format($postsThisWeek))
                ->description('7 hari terakhir')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info'),
        ];
    }
}
