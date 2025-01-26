<?php

namespace App\Models\admin\admin_mdwf;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';
    protected $fillable = [
        'activities',
        'date',
        'assigned',
        'address',
        'target',
    ];
}
