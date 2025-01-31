<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BhwForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'followed_up_pregnant_women',
        'newborn_babies',
        'newborn_screened',
        'home_births',
        'clinic_births',
        'hospital_births',
        'sputum_collected',
        'followed_up_for_vaccination',
        'followed_up_patients',
        'followed_up_patient',
        'mbhw_meeting_attendance',
        'pfbhw_meeting_attendance',
        'referred_patients',
        'non_referred_patients',
        'surveyed_families',
        'iodized_salt_sold',
        'clean_larvae_habitats',
        'total_births_in_area',
        'total_deaths_in_area',
    ];
}
