<?php

namespace App\Models\Library;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdlModel extends Model
{
    use HasFactory;
    
    public $table = "pdl_data";
    
    protected $fillable = [
        'pdl_id',
        'facility_id',
        'profile_img',
        'name',
        'gender',
        'remark',
        'birthday',
        'crimeCategory',
        'specify_case',
        'status',
    ];
}
