<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deworming extends Model
{
    use HasFactory;

    protected $table = 'dewormings';
    protected $fillable = [
        'full_name',
        'age',
        'gender'
    ];
}
