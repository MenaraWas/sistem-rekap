<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'domain',
        'category',
        'icon',
        'title_selector',
        'date_selector',
        'date_format',
    ];
}
