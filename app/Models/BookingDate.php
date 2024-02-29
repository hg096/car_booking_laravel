<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDate extends Model
{
    use HasFactory;

    protected $table = 'booking_date';

    protected $fillable = ['start_date', 'end_date', 'name', 'phone_num', 'user_email','car_id', 'user_id'];

    public function cars()
    {
        return $this->belongsTo(Cars::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
