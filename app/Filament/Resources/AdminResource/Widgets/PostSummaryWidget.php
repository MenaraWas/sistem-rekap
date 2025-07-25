<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Models\Post;
use Filament\Widgets\Widget; // Diubah dari StatsOverviewWidget
use Illuminate\Support\Str;

class PostSummaryWidget extends Widget // Diubah dari BaseWidget
{
    // Arahkan widget untuk menggunakan file view yang baru kita buat
    protected static string $view = 'components.post-summary-card';

    // Properti ini mengatur seberapa sering widget akan refresh (polling)
    protected static ?string $pollingInterval = '30s';
    
    /**
     * Metode ini akan mengirim data dari backend ke view.
     * Menggantikan metode getCards().
     */
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
     * Fungsi ini harus public agar bisa diakses dari view.
     */
    public function getPlatformIcon(string $platform): string
    {
        return match ($platform) {
            'instagram'   => 'heroicon-o-camera',
            'facebook'    => 'heroicon-o-thumb-up',
            'kompasiana',
            'retizen'     => 'heroicon-o-newspaper',
            'man_2_bantul'  => 'heroicon-o-academic-cap',
            default       => 'heroicon-o-document-text',
        };
    }
}