<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PostsExportFromCollection implements FromCollection, WithHeadings
{
    protected $posts;

    public function __construct(Collection $posts)
    {
        $this->posts = $posts;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->posts->map(function ($post) {
            return [
                $post->title,
                $post->link,
                $post->date_posted,
                $post->category,
                $post->platform,
            ];
        });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Judul',
            'Link', 
            'Tanggal',
            'Kategori',
            'Platform',
        ];
    }
}