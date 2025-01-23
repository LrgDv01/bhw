<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Bhwregister extends Authenticatable
{
    use HasFactory, Notifiable; // Add Notifiable here

    // Define fillable fields for mass assignment
    protected $fillable = [
        'username',
        'email',
        'password',
        'status',
        'phone_no',
        'first_name',
        'last_name',
        'middle_name',
        'catchment_area',
        'cover_type',
        'accreditation_count',
        'service_start_date',
        'household_covered',
        'accreditation_date',
    ];

    // Define hidden fields to exclude from JSON responses
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
