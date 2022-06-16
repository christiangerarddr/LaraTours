<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TourDate;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'itenerary', 'status'];

    protected $with = ['tourDates'];

    public function tourDates()
    {
        return $this->hasMany(TourDate::class);
    }
}
