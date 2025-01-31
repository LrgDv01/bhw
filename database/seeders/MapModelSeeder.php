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
              'child' => 348,],

              [ 'name' => 'Bagong Pook',
              'population' => 5375,
              'women' => 2431,
              'child' => 834,],

              [ 'name' => 'Bagumbayan',
              'population' => 53163,
              'women' => 76444,
              'child' => 745,], 

              [ 'name' => 'Bubucal',
              'population' => 62344,
              'women' => 2344,
              'child' => 623,],

              [ 'name' => 'Cabooan',
              'population' => 65344,
              'women' => 2456,
              'child' => 234,],

              [ 'name' => 'Calangay',
              'population' => 64454,
              'women' => 5434,
              'child' => 834,],

              [ 'name' => 'Cambuja',
              'population' => 23432,
              'women' => 2342,
              'child' => 544,],
              
              [ 'name' => 'Coralan',
              'population' => 43243,
              'women' => 2233,
              'child' => 544,],

              [ 'name' => 'Cueva',
              'population' => 22244,
              'women' => 2422,
              'child' => 342,],

              [ 'name' => 'Inayapan',
              'population' => 24322,
              'women' => 2432,
              'child' => 543,],

              [ 'name' => 'Jose P. Laurel, Sr.',
              'population' => 24343,
              'women' => 2343,
              'child' => 223,],

              [ 'name' => 'Jose Rizal',
              'population' => 35333,
              'women' => 3445,
              'child' => 554,],

              [ 'name' => 'Juan Santiago',
              'population' => 77554,
              'women' => 5336,
              'child' => 522,],

              [ 'name' => 'Kayhacat',
              'population' => 94263,
              'women' => 779,
              'child' => 834,],

              [ 'name' => 'Macasipac',
              'population' => 22434,
              'women' => 3533,
              'child' => 345,],

              [ 'name' => 'Masinao',
              'population' => 66633,
              'women' => 6344,
              'child' => 632,],

              [ 'name' => 'Matalinting',
              'population' => 65345,
              'women' => 7655,
              'child' => 252,],

              [ 'name' => 'Pao-o',
              'population' => 43253,
              'women' => 2432,
              'child' => 432,],

              [ 'name' => 'Parang ng Buho',
              'population' => 42166,
              'women' => 1132,
              'child' => 431,],

              [ 'name' => 'Poblacion Uno',
              'population' => 12341,
              'women' => 1123,
              'child' => 532,],

              [ 'name' => 'Poblacion Dos',
              'population' => 23421,
              'women' => 3325,
              'child' => 432,],

              [ 'name' => 'Poblacion Tres',
              'population' => 21412,
              'women' => 3453,
              'child' => 452,],

              [ 'name' => 'Poblacion Quatro',
              'population' => 53254,
              'women' => 2442,
              'child' => 632,],

              [ 'name' => 'Talangka',
              'population' => 24253,
              'women' => 5333,
              'child' => 623,],

              [ 'name' => 'Tungkod',
              'population' => 23453,
              'women' => 2344,
              'child' => 234,],
              
        ];

        foreach ($mapLocation as $location) {
            MapModel::create([
                'name' => $location['name'],
                'population' => $location['population'],
                'women' => $location['women'],
                'child' => $location['child'],
            ]);
        }

        // $womensData = [
        //     [
        //         'house_no' => '101',
        //         'full_name' => 'Sofia Andres',
        //         'role' => 'Head of Family',
        //         'dob' => '1980-05-15',
        //         'age' => 25,
        //         'is_4ps' => 'Yes',
        //         'is_senior_citizen' => 'No',
        //         'is_pregnant' => 'Yes',
        //         'pregnancy_months' => '3',
        //         'birth_plan' => 'Buy neccesary for my Baby',
        //         'civil_status' => 'Married',
        //         'next_visit' => '2025-02-10',
        //         'family_planning_method' => 'Pills',
        //         'is_registered_voter' => "Yes",
        //         'own_toilet' => "Yes",
        //         'clean_water' => "Yes",
        //         'hypertension' => "No",
        //         'next_visit_clinic' => '2025-03-05',
        //         'has_tb_symptoms' => "No",
        //         'sputum_test' => 'negative',
        //         'sputum_result' => 'negative',
        //         'treatment_partner' => 'Yes',
        //         'next_checkup' => '2025-04-01',
        //     ],
        //     [
        //         'house_no' => '101',
        //         'full_name' => 'Jane Valdez',
        //         'role' => 'Head of Family',
        //         'dob' => '1980-05-15',
        //         'age' => 29,
        //         'is_4ps' => 'Yes',
        //         'is_senior_citizen' => 'No',
        //         'is_pregnant' => 'Yes',
        //         'pregnancy_months' => '4',
        //         'birth_plan' => 'Buy neccesary for my Baby',
        //         'civil_status' => 'Married',
        //         'next_visit' => '2025-02-10',
        //         'family_planning_method' => 'Pills',
        //         'is_registered_voter' => "Yes",
        //         'own_toilet' => "Yes",
        //         'clean_water' => "Yes",
        //         'hypertension' => "No",
        //         'next_visit_clinic' => '2025-03-05',
        //         'has_tb_symptoms' => "No",
        //         'sputum_test' => 'negative',
        //         'sputum_result' => 'negative',
        //         'treatment_partner' => 'Yes',
        //         'next_checkup' => '2025-04-01',
        //     ],
        //     [
        //         'house_no' => '101',
        //         'full_name' => 'Melisa Melina',
        //         'role' => 'Head of Family',
        //         'dob' => '1980-05-15',
        //         'age' => 23,
        //         'is_4ps' => 'Yes',
        //         'is_senior_citizen' => 'No',
        //         'is_pregnant' => 'Yes',
        //         'pregnancy_months' => '5',
        //         'birth_plan' => 'Buy neccesary for my Baby',
        //         'civil_status' => 'Married',
        //         'next_visit' => '2025-02-10',
        //         'family_planning_method' => 'Pills',
        //         'is_registered_voter' => "Yes",
        //         'own_toilet' => "Yes",
        //         'clean_water' => "Yes",
        //         'hypertension' => "No",
        //         'next_visit_clinic' => '2025-03-05',
        //         'has_tb_symptoms' => "No",
        //         'sputum_test' => 'negative',
        //         'sputum_result' => 'negative',
        //         'treatment_partner' => 'Yes',
        //         'next_checkup' => '2025-04-01',
        //     ],
        // ];
        
        // foreach ($womensData as $womens) {
        //     FamilyMember::create([
        //         'house_no' => $womens['house_no'],
        //         'first_name' => $womens['first_name'],
        //         'middle_name' => $womens['middle_name'],
        //         'last_name' => $womens['last_name'],
        //         'role' => $womens['role'],
        //         'dob' => $womens['dob'],
        //         'age' => $womens['age'],
        //         'is_4ps' => $womens['is_4ps'],
        //         'is_senior_citizen' => $womens['is_senior_citizen'],
        //         'is_pregnant' => $womens['is_pregnant'],
        //         'pregnancy_months' => $womens['pregnancy_months'],
        //         'birth_plan' => $womens['birth_plan'],
        //         'civil_status' => $womens['civil_status'],
        //         'next_visit' => $womens['next_visit'],
        //         'family_planning_method' => $womens['family_planning_method'],
        //         'is_registered_voter' => $womens['is_registered_voter'],
        //         'own_toilet' => $womens['own_toilet'],
        //         'clean_water' => $womens['clean_water'],
        //         'hypertension' => $womens['hypertension'],
        //         'next_visit_clinic' => $womens['next_visit_clinic'],
        //         'has_tb_symptoms' => $womens['has_tb_symptoms'],
        //         'sputum_test' => $womens['sputum_test'],
        //         'sputum_result' => $womens['sputum_result'],
        //         'treatment_partner' => $womens['treatment_partner'],
        //         'next_checkup' => $womens['next_checkup'],
        //     ]);
        // }

        // $childrensData = [
        //     [
        //         'house_number' => '201',
        //         'complete_name' => 'Alice Johnson',
        //         'role_in_family' => 'Mother',
        //         'dob' => '1988-06-25',
        //         'age' => 36,
        //         'vaccines' => 'COVID-19, Flu, Hepatitis B',
        //     ],
        //     [
        //         'house_number' => '202',
        //         'complete_name' => 'Robert Johnson',
        //         'role_in_family' => 'Father',
        //         'dob' => '1985-02-14',
        //         'age' => 39,
        //         'vaccines' => 'COVID-19, Flu',
        //     ],
        //     [
        //         'house_number' => '203',
        //         'complete_name' => 'Emma Johnson',
        //         'role_in_family' => 'Child',
        //         'dob' => '2015-09-30',
        //         'age' => 9,
        //         'vaccines' => 'MMR, Polio, Chickenpox',
        //     ],
        //     [
        //         'house_number' => '204',
        //         'complete_name' => 'John Doe',
        //         'role_in_family' => 'Grandfather',
        //         'dob' => '1945-03-10',
        //         'age' => 79,
        //         'vaccines' => 'COVID-19, Pneumonia, Shingles',
        //     ],
        // ];
        
        // foreach ($childrensData as $childrens) {
        //     ChildCensus::create([
        //         'house_number' => $childrens['house_number'],
        //         'complete_name' => $childrens['complete_name'],
        //         'role_in_family' => $childrens['role_in_family'],
        //         'dob' => $childrens['dob'],
        //         'age' => $childrens['age'],
        //         'vaccines' => $childrens['vaccines'],
        //     ]);
        // }
    }
}
