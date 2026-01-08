<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kbli extends Model
{
    protected $table = 'kbli';

    protected $primaryKey = 'KODE';

    public $incrementing = false; // karena KODE bukan auto increment
    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'KODE',
        'JUDUL',
        'URAIAN',
    ];
}
