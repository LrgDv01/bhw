<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorModel extends Model
{
    use HasFactory;
    
    public $table = "visitor_pdl";
    protected $fillable = [
        'userID',
        'pdlID',
        'name',
        'gender',
        'contact_number',
        'email',
    ];
}
