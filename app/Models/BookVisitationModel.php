<?php

namespace App\Models;

use App\Models\admin\VisitorModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookVisitationModel extends Model
{
    use HasFactory;
    
    public $table = "book_visitation";
    protected $fillable = [
        'transaction_number',
        'pdl_id',
        'start_visit',
        'end_visit',
        'start_time',
        'end_time',
        'type',
        'status',
        'cancel_reason',
        'valid_id',
        'verification_docs',
    ];
    
    public function visitors()
    {
        return $this->belongsToMany(VisitorModel::class, 'booking_visitor', 'booking_id', 'visitor_id');
    }
}
