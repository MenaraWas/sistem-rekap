<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class PostsExport implements FromCollection, withHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Post::select('title', 'link', 'date_posted', 'category', 'platform')->get();
    }

    public function headings(): array
    {
        return [
            'Judul',
            'Link',
            'Tanggal Posting',
            'Kategori',
            'Platform',
        ];
    }
}
