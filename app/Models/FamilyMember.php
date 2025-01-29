<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;

    // Specify the table name (if it's not the default "family_members")
    protected $table = 'family_members';

    // Specify which fields are fillable
    protected $fillable = [
        'house_no', 'full_name', 'role', 'dob', 'age', 
        'is_4ps', 'is_senior_citizen', 'is_pregnant', 'pregnancy_months', 
        'birth_plan', 'civil_status', 'next_visit', 'family_planning_method', 
        'is_registered_voter', 'own_toilet', 'clean_water', 'hypertension', 
        'next_visit_clinic', 'has_tb_symptoms', 'sputum_test', 
        'sputum_result', 'treatment_partner', 'next_checkup'
    ];
}

