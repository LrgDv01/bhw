<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingVisitor extends Model
{
    use HasFactory;
    
    public $table = 'booking_visitor';
    
    protected $fillable = [
        'visitor_id',
        'booking_id',
    ];
}
