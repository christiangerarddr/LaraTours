<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id', 'amount', 'status'];

    public function getStatusAttribute($value)
    {
        switch ($value) {
            case $value == 1:
                return "Unpaid";
                break;
            case $value == 2:
                return "Paid";
                break;
            case $value == 0:
                return "Cancelled";
                break;
        }
    }
}
