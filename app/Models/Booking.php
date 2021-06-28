<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function trips()
    {
        $this->belongsTo(Trip::class);
    }

    public function courses()
    {
        $this->belongsTo(Course::class);
    }
}
