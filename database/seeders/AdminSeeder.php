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
            'user_name' => 'Admin',
            'full_name' => 'Coco-Spot Admin',
            'contact' => fake()->unique()->e164PhoneNumber(),
            'address' => 'At Coco-Spot Headquarters',
            'email' => 'admin@coco-spot.com',
            'password' => Hash::make('1234'),
            'user_type' => 0,
            'remember_token' => Str::random(10), 
        ]);
        PCA::factory(3)->create();
        DOA::factory(3)->create();
    }
}
