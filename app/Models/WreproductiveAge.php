<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WreproductiveAge extends Model
{
    use HasFactory;

    protected $table = 'wreproductive_ages';
    protected $fillable = [
        'name',
        'birthday',
        'age',
        'status',
        'fp_used',
        'address',
        'nhts'
    ];
}
