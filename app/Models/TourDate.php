<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourDate extends Model
{
    use HasFactory;

    protected $casts = [
        'date' => 'date:Y-m-d'
    ];

    protected $fillable = ['tour_id', 'date', 'status'];
}
