<?php

namespace App\Models;

use App\Models\Car;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'car_id',
        'start_date',
        'end_date',
        'total_days',
        'total_price',
        'status',
    ];

    protected $dates = ['start_date', 'end_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    protected $appends = ['formatted_total_days', 'formatted_dates'];

    public function getFormattedTotalDaysAttribute()
    {
        return $this->total_days . ' ' . Str::plural('day', $this->total_days);
    }

    public function getFormattedDatesAttribute()
    {
        return $this->start_date->format('M d, Y') . ' - ' . $this->end_date->format('M d, Y');
    }
}
