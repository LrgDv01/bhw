<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'user_type' => 0,
            'user_name' => 'Admin',
            'full_name' => 'BHW President',
            'address' => 'At BHW Headquarters',
            'email' => 'super.admin@bhw.com',
            'password' => Hash::make('1234'),
            'remember_token' => Str::random(10), 
        ]);
    }
}
