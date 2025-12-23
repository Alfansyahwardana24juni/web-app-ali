<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendirianCV extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pendirian_cvs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_perusahaan',
        'province',
        'city',
        'district',
        'village',
        'alamat_lengkap',
        'kode_pos',
        'direktur_data',
        'komisaris_data',
        'kbli_selected',
        'selected_bank',
        'payment_proof_path',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'direktur_data' => 'array',
        'komisaris_data' => 'array',
        'kbli_selected' => 'array',
    ];
}
