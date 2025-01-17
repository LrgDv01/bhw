<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Farm\FarmModel;
use App\Models\Farm\CoconutVarietyModel;
use App\Models\Farm\DiseasesModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FarmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::where('user_type', 1)->each(function ($user) {
            FarmModel::factory(3)->create(['farmer_id' => $user->id]); 
        });
        User::where('user_type', 2)->each(function ($user) {
            DiseasesModel::factory()->create(['farm_id' => $user->id]); 
            CoconutVarietyModel::factory()->create(['farm_id' => $user->id]); 
        });
    }
}
