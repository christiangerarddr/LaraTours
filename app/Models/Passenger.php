<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $fillable = ['given_name', 'surname', 'email', 'mobile', 'passport', 'birth_date', 'status'];

    public function getStatusAttribute($value)
    {
        return ($value) ? "Draft" : "Public" ;
    }
}
