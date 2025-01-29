<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DutySchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_of_bhw',
        'barangay',
        'date',
        'time',
        'remark',
        'attendance',
    ];
}
