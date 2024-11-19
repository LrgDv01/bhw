<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\admin\PCA;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'first_name' => 'Admin',
            'middle_name' => 'Admin',
            'last_name' => 'Admin',
            'contact' => 'contact',
            'address' => 'address',
            'email' => 'admin@coco-spot.com',
            'password' => Hash::make('1234'),
            'user_type' => '0',
        ]);

        // PCA::create([
        //     'coco_seed' => 1000000,
        //     'fertilizer',
        // ]);

        PCA::factory(25)->create();

    }
}
