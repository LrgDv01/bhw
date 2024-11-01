<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPositionModel extends Model
{
    use HasFactory;
    
    public $table = 'user_position';
    protected $fillable = [
        'userID',
        'position',
    ];
}
