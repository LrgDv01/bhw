<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapModel extends Model
{
    use HasFactory;

    protected $table = 'map_locations';
    protected $fillable = [
        'name',
        'coordinates',
        'color',
        'population',
        'women',
        'child',
    ];
}
