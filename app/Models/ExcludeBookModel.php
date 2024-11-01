<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcludeBookModel extends Model
{
    use HasFactory;
    public $table = 'excluded_booking';
    protected $fillable = [
        'userID',
        'pdlID',
        'transaction_number',
        'type',
        'start_event',
        'is_deleted',
        'remark'
    ];
}
