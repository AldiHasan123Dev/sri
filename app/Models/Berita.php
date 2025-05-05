<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'slug',
        'stts',
        'isi',
        'kategori',
        'penulis',
        'gambar',
        'video',
        'published_at',
    ];

    protected $dates = ['published_at'];
}
