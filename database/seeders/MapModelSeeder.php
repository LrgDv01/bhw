<?php

namespace Database\Seeders;
use App\Models\admin\MapModel;
use App\Models\FamilyMember;
use App\Models\ChildCensus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MapModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mapLocation = [
          
              [ 'name' => 'Adia',
              'population' => 25743,
              'women' => 512880,
              'child' => 348,
                'ages' => 4],

              [ 'name' => 'Bagong Pook',
              'population' => 53745,
              'women' => 2431,
              'child' => 834,
              'ages' => 7],

              [ 'name' => 'Bagumbayan',
              'population' => 53163,
              'women' => 76444,
              'child' => 745,
              'ages' => 17],

              [ 'name' => 'Bubucal',
              'population' => 62344,
              'women' => 2344,
              'child' => 623,
              'ages' => 15],

              [ 'name' => 'Cabooan',
              'population' => 65344,
              'women' => 2456,
              'child' => 234,
              'ages' => 2],

            //   [ 'name' => 'Calangay',
            //   'population' => 64454,
            //   'women' => 5434,
            //   'child' => 834,],

            //   [ 'name' => 'Cambuja',
            //   'population' => 23432,
            //   'women' => 2342,
            //   'child' => 544,],
              
            //   [ 'name' => 'Coralan',
            //   'population' => 43243,
            //   'women' => 2233,
            //   'child' => 544,],

            //   [ 'name' => 'Cueva',
            //   'population' => 22244,
            //   'women' => 2422,
            //   'child' => 342,],

            //   [ 'name' => 'Inayapan',
            //   'population' => 24322,
            //   'women' => 2432,
            //   'child' => 543,],

            //   [ 'name' => 'Jose P. Laurel, Sr.',
            //   'population' => 24343,
            //   'women' => 2343,
            //   'child' => 223,],

            //   [ 'name' => 'Jose Rizal',
            //   'population' => 35333,
            //   'women' => 3445,
            //   'child' => 554,],

            //   [ 'name' => 'Juan Santiago',
            //   'population' => 77554,
            //   'women' => 5336,
            //   'child' => 522,],

            //   [ 'name' => 'Kayhacat',
            //   'population' => 94263,
            //   'women' => 779,
            //   'child' => 834,],

            //   [ 'name' => 'Macasipac',
            //   'population' => 22434,
            //   'women' => 3533,
            //   'child' => 345,],

            //   [ 'name' => 'Masinao',
            //   'population' => 66633,
            //   'women' => 6344,
            //   'child' => 632,],

            //   [ 'name' => 'Matalinting',
            //   'population' => 65345,
            //   'women' => 7655,
            //   'child' => 252,],

            //   [ 'name' => 'Pao-o',
            //   'population' => 43253,
            //   'women' => 2432,
            //   'child' => 432,],

            //   [ 'name' => 'Parang ng Buho',
            //   'population' => 42166,
            //   'women' => 1132,
            //   'child' => 431,],

            //   [ 'name' => 'Poblacion Uno',
            //   'population' => 12341,
            //   'women' => 1123,
            //   'child' => 532,],

            //   [ 'name' => 'Poblacion Dos',
            //   'population' => 23421,
            //   'women' => 3325,
            //   'child' => 432,],

            //   [ 'name' => 'Poblacion Tres',
            //   'population' => 21412,
            //   'women' => 3453,
            //   'child' => 452,],

            //   [ 'name' => 'Poblacion Quatro',
            //   'population' => 53254,
            //   'women' => 2442,
            //   'child' => 632,],

            //   [ 'name' => 'Talangka',
            //   'population' => 24253,
            //   'women' => 5333,
            //   'child' => 623,],

            //   [ 'name' => 'Tungkod',
            //   'population' => 23453,
            //   'women' => 2344,
            //   'child' => 234,],
              
        ];

        foreach ($mapLocation as $location) {
            MapModel::create([
                'name' => $location['name'],
                'population' => $location['population'],
                'women' => $location['women'],
                'child' => $location['child'],
                'ages' => $location['ages'],
            ]);
        }

        $womensData = [
            [
                'house_no' => '102',
                'first_name' => 'Anna',
                'middle_name' => 'Lopez',
                'last_name' => 'Reyes',
                'role_in_family' => 'Spouse',
                'age' => 28,
                'date_of_birth' => '1996-03-22',
                'senior_citizen' => 'No',
                'next_midwife_visit' => '2024-10-20',
                'next_clinic_visit' => '2024-11-05',
                'civil_status' => 'Married',
                'registered_voter' => 'Yes',
                'four_ps_member' => 'No',
                'months_pregnant' => 5, 
                'next_checkup' => '2024-12-15',
                'family_planning' => 'None',
                'own_toilet' => 'Yes',
                'birth_plan' => 'Hospital delivery with doctor',
                'clean_water_source' => 'Yes',
                'hypertension_experience' => 'No',
                'pregnant' => 'Yes',
                'tb_symptoms' => 'No',
                'sputum_test' => 'negative',
                'sputum_result' => 'negative',
                'tb_treatment_partner' => 'No',
            ],
            [
                'house_no' => '103',
                'first_name' => 'Juan',
                'middle_name' => 'Dela',
                'last_name' => 'Cruz',
                'role_in_family' => 'Grandparent',
                'age' => 68,
                'date_of_birth' => '1956-08-10',
                'senior_citizen' => 'Yes', 
                'next_midwife_visit' => null, 
                'next_clinic_visit' => '2024-11-20',
                'civil_status' => 'Widowed',
                'registered_voter' => 'Yes',
                'four_ps_member' => 'No',
                'months_pregnant' => null, 
                'next_checkup' => '2025-02-05',
                'family_planning' => null, 
                'own_toilet' => 'Yes',
                'birth_plan' => null, 
                'clean_water_source' => 'Yes',
                'hypertension_experience' => 'Yes', 
                'pregnant' => 'No', 
                'tb_symptoms' => 'No',
                'sputum_test' => 'negative',
                'sputum_result' => 'negative',
                'tb_treatment_partner' => 'No',
            ],
            [
                'house_no' => '104',
                'first_name' => 'Carlos',
                'middle_name' => 'Manuel',
                'last_name' => 'Garcia',
                'role_in_family' => 'Son',
                'age' => 22,
                'date_of_birth' => '2002-04-25',
                'senior_citizen' => 'No',
                'next_midwife_visit' => null, 
                'next_clinic_visit' => '2024-12-10',
                'civil_status' => 'Single',
                'registered_voter' => 'Yes',
                'four_ps_member' => 'Yes',
                'months_pregnant' => null, 
                'next_checkup' => '2025-01-15',
                'family_planning' => 'Condoms', 
                'own_toilet' => 'Yes',
                'birth_plan' => null, 
                'clean_water_source' => 'Yes',
                'hypertension_experience' => 'No',
                'pregnant' => 'No', 
                'tb_symptoms' => 'Yes', 
                'sputum_test' => 'positive',
                'sputum_result' => 'positive',
                'tb_treatment_partner' => 'Yes', 
            ],
        ];
        
        foreach ($womensData as $womens) {
            FamilyMember::create([
                'house_no' => $womens['house_no'],
                'first_name' => $womens['first_name'],
                'middle_name' => $womens['middle_name'],
                'last_name' => $womens['last_name'],
                'role_in_family' => $womens['role_in_family'], 
                'age' => $womens['age'],
                'date_of_birth' => $womens['date_of_birth'], 
                'senior_citizen' => $womens['senior_citizen'], 
                'next_midwife_visit' => $womens['next_midwife_visit'],
                'next_clinic_visit' => $womens['next_clinic_visit'], 
                'civil_status' => $womens['civil_status'],
                'registered_voter' => $womens['registered_voter'], 
                'four_ps_member' => $womens['four_ps_member'], 
                'months_pregnant' => $womens['months_pregnant'], 
                'next_checkup' => $womens['next_checkup'],
                'family_planning' => $womens['family_planning'],
                'own_toilet' => $womens['own_toilet'],
                'birth_plan' => $womens['birth_plan'],
                'clean_water_source' => $womens['clean_water_source'], 
                'hypertension_experience' => $womens['hypertension_experience'], 
                'pregnant' => $womens['pregnant'], 
                'tb_symptoms' => $womens['tb_symptoms'], 
                'sputum_test' => $womens['sputum_test'],
                'sputum_result' => $womens['sputum_result'],
                'tb_treatment_partner' => $womens['tb_treatment_partner'],
            ]);
        }

        $childrensData = [
            [
                'house_number' => '201',
                'complete_name' => 'Alice Johnson',
                'role_in_family' => 'Mother',
                'dob' => '1988-06-25',
                'age' => 36,
                'vaccines' => 'COVID-19, Flu, Hepatitis B',
            ],
            [
                'house_number' => '202',
                'complete_name' => 'Robert Johnson',
                'role_in_family' => 'Father',
                'dob' => '1985-02-14',
                'age' => 39,
                'vaccines' => 'COVID-19, Flu',
            ],
            [
                'house_number' => '203',
                'complete_name' => 'Emma Johnson',
                'role_in_family' => 'Child',
                'dob' => '2015-09-30',
                'age' => 9,
                'vaccines' => 'MMR, Polio, Chickenpox',
            ],
            [
                'house_number' => '204',
                'complete_name' => 'John Doe',
                'role_in_family' => 'Grandfather',
                'dob' => '1945-03-10',
                'age' => 79,
                'vaccines' => 'COVID-19, Pneumonia, Shingles',
            ],
        ];
        
        foreach ($childrensData as $childrens) {
            ChildCensus::create([
                'house_number' => $childrens['house_number'],
                'complete_name' => $childrens['complete_name'],
                'role_in_family' => $childrens['role_in_family'],
                'dob' => $childrens['dob'],
                'age' => $childrens['age'],
                'vaccines' => $childrens['vaccines'],
            ]);
        }
    }
}
