<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
   protected $fillable = [
        'name',
        'email',
        'phone',
        'department',
        'doctor_name',
        'appointment_date',
        'appointment_time',
    ];

}
