<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PostsExport;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('export_excel')
            ->label('Ekspor ke Excel')
            ->icon('heroicon-o-arrow-down-tray')
            ->action(function () {
                // Ambil data hasil filter dari tabel Filament
                $filteredPosts = $this->getFilteredTableQuery()->get();

                return response()->streamDownload(function () use ($filteredPosts) {
                    echo Excel::raw(new \App\Exports\PostsExportFromCollection($filteredPosts), \Maatwebsite\Excel\Excel::XLSX);
                }, 'rekap-postingan.xlsx');
            }),

        ];
    }
}
