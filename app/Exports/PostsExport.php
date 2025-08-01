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

    protected $category;
    protected $platform;

    public function __construct($category = null, $platform = null)
    {
        $this->category = $category;
        $this->platform = $platform;
    }

    public function collection()
    {
        return Post::query()
            ->when($this->category, fn ($q) => $q->where('category', $this->category))
            ->when($this->platform, fn ($q) => $q->where('platform', $this->platform))
            ->select('title', 'link', 'date_posted', 'category', 'platform')
            ->get();
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
