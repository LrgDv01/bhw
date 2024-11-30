<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\admin\PCA;
use App\Models\admin\DOA;
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
            // 'middle_name' => 'Admin',
            // 'last_name' => 'Admin',
            // 'address' => 'address'  
            'user_name' => 'Admin',
            'full_name' => 'Coco Spot Admin',
            'contact' => 'contact',
            'email' => 'admin@coco-spot.com',
            'password' => Hash::make('1234'),
            'user_type' => 0,
        ]);

        PCA::factory(25)->create();
        DOA::factory(25)->create();

    }
}
