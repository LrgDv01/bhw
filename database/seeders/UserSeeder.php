<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\TechnicianModel;
use App\Models\Library\PdlModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();
        User::where('user_type', 2)->each(function ($user) {
            TechnicianModel::factory(1)->create(['user_id' => $user->id]);
        });
    }
}

