<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicianModel extends Model
{
    use HasFactory;
    public $table = "technicians_info";
    
    protected $fillable = [
        'technician_id',
        'years_in_service',
        'services',
    ];
}
