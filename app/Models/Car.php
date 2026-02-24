<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'year',
        'transmission',
        'fuel_type',
        'seats',
        'price_per_day',
        'rfid_type',
        'is_available',
        'is_featured',
        'description',
    ];
    protected $casts = [
        'is_available' => 'boolean',
        'is_featured' => 'boolean',
        'year' => 'integer',
        'seats' => 'integer',
        'price_per_day' => 'decimal:2'
    ];

    public function images()
    {
        return $this->hasMany(CarImage::class)->orderBy('sort_order');
    }

    /**
     * Get the primary image
     */
    public function primaryImage()
    {
        return $this->hasOne(CarImage::class)->where('is_primary', true);
    }

    /**
     * Get the first image as fallback
     */
    public function getFirstImageAttribute()
    {
        $primary = $this->primaryImage;
        if ($primary) {
            return $primary;
        }
        
        return $this->images->first();
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function isAvailableForDates($start_date, $end_date)
    {
        return !$this->bookings()
            ->where(function ($query) use ($start_date, $end_date) {
                $query->whereBetween('start_date', [$start_date, $end_date])
                    ->orWhereBetween('end_date', [$start_date, $end_date])
                    ->orWhere(function ($q) use ($start_date, $end_date) {
                        $q->where('start_date', '<=', $start_date)
                            ->where('end_date', '>=', $end_date);
                    });
            })
            ->whereIn('status', ['pending', 'approved'])
            ->exists();
    }

    public function calculateTotalDays($start_date, $end_date)
    {
        $start = \Carbon\Carbon::parse($start_date);
        $end = \Carbon\Carbon::parse($end_date);
        return $start->diffInDays($end) + 1;
    }


}
