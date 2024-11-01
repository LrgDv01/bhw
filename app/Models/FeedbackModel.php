<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackModel extends Model
{
    use HasFactory;
    public $table = 'feeback';
    protected $fillable = [
        'user_id',
        'book_id',
        'comment',
        'reaction'
    ];
    
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
