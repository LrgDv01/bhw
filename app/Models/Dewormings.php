<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dewormings extends Model
{
    use HasFactory;

    protected $table = 'dewormings';
    protected $fillable = [
        'name',
        'age'
    ];
}
