<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyPlanning extends Model
{
    use HasFactory;

    protected $table = 'family_planning';

    protected $fillable = [
        'family_serial_no',
        'name',
        'address',
        'age_dob',
        'se_status',
        'client_type',
        'source',
        'previous_method',
        'month',
        'schedule_date',
        'actual_date',
        'dropout_date',
        'dropout_reason',
    ];
}
