<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCensus extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_number',
        'complete_name',
        'role_in_family',
        'dob',
        'age',
        'vaccines', // This will be stored as a JSON array
    ];

    protected $casts = [
        'vaccines' => 'array', // This will cast vaccines to an array when fetched from the database
    ];
}
