<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tour;

class TourDate extends Model
{
    use HasFactory;

    protected $fillable = ['tour_id', 'date'];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

}
