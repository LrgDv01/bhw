<?php

namespace App\Models\Farm;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmModel extends Model
{
    use HasFactory;

    public $table = 'farms';
    protected $fillable = [
        'user_id',
        'name',
        'location',
        'variety',
        'hectares',
        'tree_age',
        'planted_coconut',
        'soil_type',

        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
