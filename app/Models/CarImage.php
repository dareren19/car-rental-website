<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CarImage extends Model
{
    protected $fillable = [
        'car_id',
        'image_path',
        'is_primary',
        'sort_order'
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'sort_order' => 'integer'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function getUrlAttribute()
    {
        return Storage::url($this->image_path);
    }

    /**
     * Delete image file when model is deleted
     */
    protected static function booted()
    {
        static::deleting(function ($image) {
            Storage::disk('public')->delete($image->image_path);
        });
    }
}
