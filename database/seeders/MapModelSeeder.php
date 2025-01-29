<?php

namespace Database\Seeders;
use App\Models\admin\MapModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MapModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    //
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
              'child' => 348,],

              [ 'name' => 'Bubucal',
              'population' => 70793,
              'women' => 3990,
              'child' => 834,],

              [ 'name' => 'Cabooan',
              'population' => 94263,
              'women' => 779,
              'child' => 834,],

              [ 'name' => 'Calangay',
              'population' => 94263,
              'women' => 779,
              'child' => 834,],

              [ 'name' => 'Cambuja',
              'population' => 94263,
              'women' => 779,
              'child' => 834,],
              
              [ 'name' => 'Coralan',
              'population' => 94263,
              'women' => 779,
              'child' => 834,],

              [ 'name' => 'Cueva',
              'population' => 94263,
              'women' => 779,
              'child' => 834,],

              [ 'name' => 'Inayapan',
              'population' => 94263,
              'women' => 779,
              'child' => 834,],

              [ 'name' => 'Jose P. Laurel, Sr.',
              'population' => 94263,
              'women' => 779,
              'child' => 834,],

              [ 'name' => 'Jose Rizal',
              'population' => 94263,
              'women' => 779,
              'child' => 834,],

              [ 'name' => 'Juan Santiago',
              'population' => 94263,
              'women' => 779,
              'child' => 834,],

              [ 'name' => 'Kayhacat',
              'population' => 94263,
              'women' => 779,
              'child' => 834,],

              [ 'name' => 'Macasipac',
              'population' => 94263,
              'women' => 779,
              'child' => 834,],

              [ 'name' => 'Masinao',
              'population' => 94263,
              'women' => 779,
              'child' => 834,],

              [ 'name' => 'Matalinting',
              'population' => 94263,
              'women' => 779,
              'child' => 834,],

              [ 'name' => 'Pao-o',
              'population' => 94263,
              'women' => 779,
              'child' => 834,],

              [ 'name' => 'Parang ng Buho',
              'population' => 94263,
              'women' => 779,
              'child' => 834,],

              [ 'name' => 'Poblacion Uno',
              'population' => 94263,
              'women' => 779,
              'child' => 834,],

              [ 'name' => 'Poblacion Dos',
              'population' => 94263,
              'women' => 779,
              'child' => 834,],

              [ 'name' => 'Poblacion Tres',
              'population' => 94263,
              'women' => 779,
              'child' => 834,],

              [ 'name' => 'Poblacion Quatro',
              'population' => 94263,
              'women' => 779,
              'child' => 834,],

              [ 'name' => 'Talangka',
              'population' => 94263,
              'women' => 779,
              'child' => 834,],

              [ 'name' => 'Tungkod',
              'population' => 94263,
              'women' => 779,
              'child' => 834,],
              
        ];

        foreach ($mapLocation as $location) {
            MapModel::create([
                'name' => $location['name'],
                'population' => $location['population'],
                'women' => $location['women'],
                'child' => $location['child'],
            ]);
        }
    }
}
