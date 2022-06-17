<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['tour_id', 'tour_date', 'status'];

    protected $with = ['tour', 'passengers'];

    protected $appends = ['passengers_count'];

    protected $casts = [
        'tour_date' => 'date:Y-m-d'
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function passengers()
    {
        return $this->belongsToMany(Passenger::class, 'booking_passengers', 'booking_id', 'passenger_id')->withPivot('special_request');
    }

    public function getPassengersCountAttribute()
    {
        return $this->hasMany(BookingPassenger::class)->count();
    }
    public function getStatusAttribute($value)
    {
        switch ($value) {
            case $value == 1:
                return "Confirmed";
                break;
            case $value == 2:
                return "Submitted";
                break;
            case $value == 0:
                return "Cancelled";
                break;
        }
    }
}
