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
        'vaccines', 
    ];

    protected $casts = [
        'vaccines' => 'array',
    ];
}
