<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image_path',
        'description',
        'link',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get only active carousels
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get carousels ordered by order column
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}