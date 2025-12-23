<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kbli extends Model
{
    protected $table = 'kblis'; // nama tabel di MySQL
    public $timestamps = false; // karena tabel tidak punya created_at dan updated_at

    protected $fillable = [
        'judul',
        'uraian',
        'id_resiko',
        'kbli',
        'id_ruang_lingkup',
        'kd_skala_usaha',
        'kd_resiko',
        'sektor',
    ];
}