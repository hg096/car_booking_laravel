<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $fillable = ['name', 'brand', 'car_size'];

    public function bookingDate()
    {
        return $this->hasMany(BookingDate::class);
    }
}
