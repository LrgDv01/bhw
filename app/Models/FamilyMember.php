<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;

    protected $table = 'family_members'; // Ensure table name matches your database

    protected $fillable = [
        'house_no', 'first_name', 'middle_name', 'last_name', 'role_in_family', 
        'age', 'date_of_birth', 'senior_citizen', 'next_midwife_visit', 
        'next_clinic_visit', 'civil_status', 'registered_voter', 'four_ps_member', 
        'months_pregnant', 'next_checkup', 'family_planning', 'own_toilet', 
        'birth_plan', 'clean_water_source', 'hypertension_experience', 'pregnant', 
        'tb_symptoms', 'sputum_test', 'sputum_result', 'tb_treatment_partner'
    ];
}


