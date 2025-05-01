<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengurus extends Model
{
    use SoftDeletes;

    protected $table = 'pengurus';

    protected $fillable = [
        'foto',
        'nama',
        'email',
        'alamat',
        'nomor_telepon',
        'divisi',
    ];

    protected $dates = ['deleted_at'];
}
