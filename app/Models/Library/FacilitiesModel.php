<?php

namespace App\Models\Library;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilitiesModel extends Model
{
    use HasFactory;
    
    public $table = 'facilities';
    
    protected $fillable = [
        'facility_name',
        'status',
    ];
}
