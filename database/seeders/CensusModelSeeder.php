<?php

namespace Database\Seeders;

use App\Models\HouseHoldModel;
use App\Models\FamilyMemberModel;
use Illuminate\Database\Seeder;

class CensusModelSeeder extends Seeder
{
    public function run(): void
    {
        $householdsData = [
            [
                'house_no' => "123",
                'head_of_fam' => "Juan Dela Cruz",
                'toilet_facility' => 'Yes',
                'water_source' => 'Yes',
            ],
            [
                'house_no' => "124",
                'head_of_fam' => "Pedro Santos",
                'toilet_facility' => 'No',
                'water_source' => 'Yes',
            ],
        ];

        $households = [];
        foreach ($householdsData as $hh) {
            $households[] = HouseHoldModel::create($hh);
        }

        $family_members = [
            [
                'full_name' => "Maria Dela Cruz",
                'relation_to_hfam' => "Wife",
                'birthday' => "1990-05-15",
                'age' => 32,
                'civil_status' => "Married",
                'sex' => "Female",
                'edu_attainment' => "College Graduate",
                'religion' => "Catholic",
                'fam_planning' => "None",
                'phihealth_no' => "123456789012",
                'membership_type' => "Dependent",
                'voters' => 'Yes',
                'medical_history' => "Hypertension"
            ],
            [
                'full_name' => "Pedro Dela Cruz",
                'relation_to_hfam' => "Son",
                'birthday' => "2015-08-20",
                'age' => 7,
                'civil_status' => "Single",
                'sex' => "Male",
                'edu_attainment' => "Elementary",
                'religion' => "Catholic",
                'fam_planning' => "N/A",
                'phihealth_no' => "123456789013",
                'membership_type' => "Dependent",
                'voters' => 'No',
                'medical_history' => "None"
            ],
        ];

        $households[0]->familyMembers()->create($family_members[0]); 
        $households[1]->familyMembers()->create($family_members[1]); 
    }
}