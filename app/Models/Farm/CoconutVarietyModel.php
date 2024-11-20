<?php

namespace App\Models\Farm;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoconutVarietyModel extends Model
{
    use HasFactory;

    public $table = 'coconut_variety';
    protected $fillable = [
        'user_id',
        'name',
        'location',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
