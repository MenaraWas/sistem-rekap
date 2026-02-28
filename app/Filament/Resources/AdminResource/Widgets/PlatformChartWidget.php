<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PlatformChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Statistik Bulanan';

    protected static ?string $maxHeight = '280px';

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        $data = DB::table('posts')
            ->selectRaw("MONTH(date_posted) as month, COUNT(*) as total")
            ->whereYear('date_posted', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = [];
        $values = [];

        foreach (range(1, 12) as $month) {
            $labels[] = now()->setMonth($month)->format('M');
            $values[] = $data->firstWhere('month', $month)->total ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Postingan',
                    'data' => $values,
                    'borderColor' => '#f59e0b',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                    'pointBackgroundColor' => '#f59e0b',
                    'pointBorderColor' => '#fff',
                    'pointBorderWidth' => 2,
                    'pointRadius' => 4,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
