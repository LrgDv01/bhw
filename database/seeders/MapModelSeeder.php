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
          
              [ 'name' => 'J. Rizal',
              'coordinates' => [121.409, 14.281],
              'color' => 'green',
              'population' => 25743,
              'women' => 512880,
              'child' => 348,],

              [ 'name' => 'J. Santiago',
              'coordinates' => [121.409, 14.281],
              'color' => 'green',
              'population' => 5375,
              'women' => 2431,
              'child' => 834,],

              [ 'name' => 'Dos',
              'coordinates' => [121.409, 14.281],
              'color' => 'green',
              'population' => 53163,
              'women' => 76444,
              'child' => 348,],

              [ 'name' => 'Tres',
              'coordinates' => [121.409, 14.281],
              'color' => 'green',
              'population' => 70793,
              'women' => 3990,
              'child' => 834,],

              [ 'name' => 'Cambuja',
              'coordinates' => [121.409, 14.281],
              'color' => 'green',
              'population' => 94263,
              'women' => 779,
              'child' => 834,],
        ];

        foreach ($mapLocation as $location) {
            MapModel::create([
                'name' => $location['name'],
                'coordinates' => json_encode($location['coordinates']), // Convert to JSON
                'color' => $location['color'],
                'population' => $location['population'],
                'women' => $location['women'],
                'child' => $location['child'],
            ]);
        }
    }
}
