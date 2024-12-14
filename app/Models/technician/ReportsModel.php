<?php

namespace App\Models\technician;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportsModel extends Model
{
    use HasFactory;

    public $table = 'reports';
    protected $fillable = [
        'farmer_name',
        'contact_no',
        'recipient',
        'farm_location',
        'farm_size',
        'coconut_trees',
        'coconut_variety',
        'soil_type',
        'disease_type',
        'note',
    ];
}

