<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class MonthlyPostCart extends ChartWidget
{
    protected static ?string $heading = 'Statistik Post';

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
            $labels[] = now()->setMonth($month)->format('M'); // Jan, Feb, dst
            $values[] = $data->firstWhere('month', $month)->total ?? 0;
        }

        return [
            //
            'datasets' => [
                [
                    'label' => 'Jumlah Postingan',
                    'data' => $values,
                    'backgroundColor' => '#3b82f6', // biru
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
