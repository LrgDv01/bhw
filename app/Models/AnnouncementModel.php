<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementModel extends Model
{
    use HasFactory;
    
    public $table = "announcement";
    
    protected $fillable = [
        'userID',
        'image',
        'title',
        'content',
        'status'
    ];
}
