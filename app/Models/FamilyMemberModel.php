<?php

namespace App\Models;

use App\Models\HouseHoldModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMemberModel extends Model
{
    use HasFactory;

    protected $table = 'family_members'; 
    protected $fillable = [
        'household_id',
        'full_name',
        'relation_to_hfam',
        'birthday',
        'age',
        'civil_status',
        'sex',
        'edu_attainment',
        'religion',
        'fam_planning',
        'phihealth_no',
        'membership_type',
        'medical_history',
        'voters',
    ];

    public function household()
    {
        return $this->belongsTo(HouseHoldModel::class, 'household_id');
    }
}
