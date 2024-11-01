<?php

namespace App\Models\admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrModel extends Model
{
    use HasFactory;
    
    public $table = 'unique_qr';
    
    protected $fillable = [
        'userID',
        'code',
        'is_deleted',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
