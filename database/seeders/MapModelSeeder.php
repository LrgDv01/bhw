<?php

namespace Database\Seeders;
use App\Models\admin\MapModel;
use App\Models\Deworming;
use App\Models\WreproductiveAge;
// use App\Models\MotherCensus;
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
                'population' => 500,
                'women' => 500,
                'child' => 500,
                'age' => 4],

              [ 'name' => 'Bagong Pook',
                'population' => 500,
                'women' => 500,
                'child' => 500,
                'age' => 4],

              [ 'name' => 'Bagumbayan',
                'population' => 500,
                'women' => 500,
                'child' => 500,
                'age' => 4],

              [ 'name' => 'Bubucal',
                'population' => 500,
                'women' => 500,
                'child' => 500,
                'age' => 4],

              [ 'name' => 'Cabooan',
                'population' => 65344,
                'women' => 2456,
                'child' => 234,
                'age' => 4],

            //   [ 'name' => 'Calangay',
            //     'population' => 64454,
            //     'women' => 5434,
            //     'child' => 834,
            //     'ages' => 2],

            //   [ 'name' => 'Cambuja',
            //     'population' => 23432,
            //     'women' => 2342,
            //     'child' => 544,
            //     'ages' => 3],
                
            //   [ 'name' => 'Coralan',
            //     'population' => 43243,
            //     'women' => 2233,
            //     'child' => 544,
            //     'ages' => 3],

            //   [ 'name' => 'Cueva',
            //     'population' => 22244,
            //     'women' => 2422,
            //     'child' => 342,
            //     'ages' => 1],

            //   [ 'name' => 'Inayapan',
            //     'population' => 24322,
            //     'women' => 2432,
            //     'child' => 543,
            //     'ages' => 6],

            //   [ 'name' => 'Jose P. Laurel, Sr.',
            //     'population' => 24343,
            //     'women' => 2343,
            //     'child' => 223,
            //     'ages' => 19],

            //   [ 'name' => 'Jose Rizal',
            //     'population' => 35333,
            //     'women' => 3445,
            //     'child' => 554,
            //     'ages' => 15],

            //   [ 'name' => 'Juan Santiago',
            //     'population' => 77554,
            //     'women' => 5336,
            //     'child' => 522,
            //     'ages' => 13],

            //   [ 'name' => 'Kayhacat',
            //     'population' => 94263,
            //     'women' => 779,
            //     'child' => 834,
            //     'ages' => 17],

            //   [ 'name' => 'Macasipac',
            //     'population' => 22434,
            //     'women' => 3533,
            //     'child' => 345,
            //     'ages' => 9],

            //   [ 'name' => 'Masinao',
            //     'population' => 66633,
            //     'women' => 6344,
            //     'child' => 632,
            //     'ages' => 10],

            //   [ 'name' => 'Matalinting',
            //     'population' => 65345,
            //     'women' => 7655,
            //     'child' => 252,
            //     'ages' => 8],

            //   [ 'name' => 'Pao-o',
            //     'population' => 43253,
            //     'women' => 2432,
            //     'child' => 432,
            //     'ages' => 5],

            //   [ 'name' => 'Parang ng Buho',
            //     'population' => 42166,
            //     'women' => 1132,
            //     'child' => 431,
            //     'ages' => 7],

            //   [ 'name' => 'Poblacion Uno',
            //     'population' => 12341,
            //     'women' => 1123,
            //     'child' => 532,
            //     'ages' => 3],

            //   [ 'name' => 'Poblacion Dos',
            //     'population' => 23421,
            //     'women' => 3325,
            //     'child' => 432,
            //     'ages' => 7],

            //   [ 'name' => 'Poblacion Tres',
            //     'population' => 21412,
            //     'women' => 3453,
            //     'child' => 9,
            //     'ages' => 7],

            //   [ 'name' => 'Poblacion Quatro',
            //     'population' => 53254,
            //     'women' => 2442,
            //     'child' => 632,
            //     'ages' => 7],

            //   [ 'name' => 'Talangka',
            //     'population' => 24253,
            //     'women' => 5333,
            //     'child' => 623,
            //     'ages' => 9],

            //   [ 'name' => 'Tungkod',
            //     'population' => 23453,
            //     'women' => 2344,
            //     'child' => 234,
            //     'ages' => 7],
              
        ];

        foreach ($mapLocation as $location) {
            MapModel::create([
                'name' => $location['name'],
                'population' => $location['population'],
                'women' => $location['women'],
                'child' => $location['child'],
                'age' => $location['age']
            ]);
        }

        $dewormings = [
            [
                'full_name' => "john Daron Salvuena",
                'age' => "12 months",
                'gender' => 'male'
            ],
            [
                'full_name' => "john Daron Salvuena",
                'age' => "15 months",
                'gender' => 'male'
            ],
            [
                'full_name' => "john Daron Salvuena",
                'age' => "15 months",
                'gender' => 'male'
            ],
            [
                'full_name' => "john Daron Salvuena",
                'age' => "15 months",
                'gender' => 'male'
            ],
            [
                'full_name' => "john Daron Salvuena",
                'age' => "23 months",
                'gender' => 'male'
            ],
            [
                'full_name' => "john Daron Salvuena",
                'age' => "24 months",
                'gender' => 'male'
            ],
            [
                'full_name' => "john Daron Salvuena",
                'age' => "27 months",
                'gender' => 'male'
            ],
            [
                'full_name' => "john Daron Salvuena",
                'age' => "40 months",
                'gender' => 'male'
            ],
            [
                'full_name' => "john Daron Salvuena",
                'age' => "5 years",
                'gender' => 'male'
            ],
            [
                'full_name' => "john Daron Salvuena",
                'age' => "7 years",
                'gender' => 'male'
            ],
            [
                'full_name' => "john Daron Salvuena",
                'age' => "9 years",
                'gender' => 'male'
            ],
            [
                'full_name' => "john Daron Salvuena",
                'age' => "10 years",
                'gender' => 'male'
            ],
            [
                'full_name' => "john Daron Salvuena",
                'age' => "12 years",
                'gender' => 'male'
            ],
            [
                'full_name' => "john Daron Salvuena",
                'age' => "17 years",
                'gender' => 'male'
            ],
            [
                'full_name' => "john Daron Salvuena",
                'age' => "12 years",
                'gender' => 'male'
            ],
        ];

        foreach ($dewormings as $d) {
            Deworming::create([
                'full_name' => $d['full_name'],
                'age' => $d['age'],
                'gender' => $d['gender']
            ]);
        }

        $womens = [
            [
                'name' => "Jane",
                'birthday' => "2011-05-15",
                'age' => 15,
                'status' => "Single",
                'fp_used' => "None",
                'address' => "123 Main St",
                'nhts' => "None"
            ],
            [
                'name' => "Jane",
                'birthday' => "2009-08-20",
                'age' => 15,
                'status' => "Single",
                'fp_used' => "None",
                'address' => "123 Main St",
                'nhts' => "None"
            ],
            [
                'name' => "Jane",
                'birthday' => "2008-03-10",
                'age' => 15,
                'status' => "Single",
                'fp_used' => "None",
                'address' => "123 Main St",
                'nhts' => "None"
            ],
            
        ];
        
        foreach ($womens as $w) {
            WreproductiveAge::create([
                'name' => $w['name'],
                'birthday' => $w['birthday'],
                'age' => $w['age'],
                'status' => $w['status'],
                'fp_used' => $w['fp_used'],
                'address' => $w['address'],
                'nhts' => $w['nhts']
            ]);
        }

        // $mother_census = [
        //     [
        //         'house_no' => '102',
        //         'first_name' => 'Anna',
        //         'middle_name' => 'Lopez',
        //         'last_name' => 'Reyes',
        //         'role_in_family' => 'Spouse',
        //         'age' => 28,
        //         'date_of_birth' => '1996-03-22',
        //         'senior_citizen' => 'No',
        //         'next_midwife_visit' => '2024-10-20',
        //         'next_clinic_visit' => '2024-11-05',
        //         'civil_status' => 'Married',
        //         'registered_voter' => 'Yes',
        //         'four_ps_member' => 'No',
        //         'months_pregnant' => 5, 
        //         'next_checkup' => '2024-12-15',
        //         'family_planning' => 'None',
        //         'own_toilet' => 'Yes',
        //         'birth_plan' => 'Hospital delivery with doctor',
        //         'clean_water_source' => 'Yes',
        //         'hypertension_experience' => 'No',
        //         'pregnant' => 'Yes',
        //         'tb_symptoms' => 'No',
        //         'sputum_test' => 'negative',
        //         'sputum_result' => 'negative',
        //         'tb_treatment_partner' => 'No',
        //     ],
        //     [
        //         'house_no' => '103',
        //         'first_name' => 'Juan',
        //         'middle_name' => 'Dela',
        //         'last_name' => 'Cruz',
        //         'role_in_family' => 'Grandparent',
        //         'age' => 68,
        //         'date_of_birth' => '1956-08-10',
        //         'senior_citizen' => 'Yes', 
        //         'next_midwife_visit' => null, 
        //         'next_clinic_visit' => '2024-11-20',
        //         'civil_status' => 'Widowed',
        //         'registered_voter' => 'Yes',
        //         'four_ps_member' => 'No',
        //         'months_pregnant' => null, 
        //         'next_checkup' => '2025-02-05',
        //         'family_planning' => null, 
        //         'own_toilet' => 'Yes',
        //         'birth_plan' => null, 
        //         'clean_water_source' => 'Yes',
        //         'hypertension_experience' => 'Yes', 
        //         'pregnant' => 'No', 
        //         'tb_symptoms' => 'No',
        //         'sputum_test' => 'negative',
        //         'sputum_result' => 'negative',
        //         'tb_treatment_partner' => 'No',
        //     ],
        //     [
        //         'house_no' => '104',
        //         'first_name' => 'Carlos',
        //         'middle_name' => 'Manuel',
        //         'last_name' => 'Garcia',
        //         'role_in_family' => 'Son',
        //         'age' => 22,
        //         'date_of_birth' => '2002-04-25',
        //         'senior_citizen' => 'No',
        //         'next_midwife_visit' => null, 
        //         'next_clinic_visit' => '2024-12-10',
        //         'civil_status' => 'Single',
        //         'registered_voter' => 'Yes',
        //         'four_ps_member' => 'Yes',
        //         'months_pregnant' => null, 
        //         'next_checkup' => '2025-01-15',
        //         'family_planning' => 'Condoms', 
        //         'own_toilet' => 'Yes',
        //         'birth_plan' => null, 
        //         'clean_water_source' => 'Yes',
        //         'hypertension_experience' => 'No',
        //         'pregnant' => 'No', 
        //         'tb_symptoms' => 'Yes', 
        //         'sputum_test' => 'positive',
        //         'sputum_result' => 'positive',
        //         'tb_treatment_partner' => 'Yes', 
        //     ],
        // ];
        
        // foreach ($mother_census as $ms) {
        //     MotherCensus::create([
        //         'house_no' => $ms['house_no'],
        //         'first_name' => $ms['first_name'],
        //         'middle_name' => $ms['middle_name'],
        //         'last_name' => $ms['last_name'],
        //         'role_in_family' => $ms['role_in_family'], 
        //         'age' => $ms['age'],
        //         'date_of_birth' => $ms['date_of_birth'], 
        //         'senior_citizen' => $ms['senior_citizen'], 
        //         'next_midwife_visit' => $ms['next_midwife_visit'],
        //         'next_clinic_visit' => $ms['next_clinic_visit'], 
        //         'civil_status' => $ms['civil_status'],
        //         'registered_voter' => $ms['registered_voter'], 
        //         'four_ps_member' => $ms['four_ps_member'], 
        //         'months_pregnant' => $ms['months_pregnant'], 
        //         'next_checkup' => $ms['next_checkup'],
        //         'family_planning' => $ms['family_planning'],
        //         'own_toilet' => $ms['own_toilet'],
        //         'birth_plan' => $ms['birth_plan'],
        //         'clean_water_source' => $ms['clean_water_source'], 
        //         'hypertension_experience' => $ms['hypertension_experience'], 
        //         'pregnant' => $ms['pregnant'], 
        //         'tb_symptoms' => $ms['tb_symptoms'], 
        //         'sputum_test' => $ms['sputum_test'],
        //         'sputum_result' => $ms['sputum_result'],
        //         'tb_treatment_partner' => $ms['tb_treatment_partner'],
        //     ]);
        // }

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
