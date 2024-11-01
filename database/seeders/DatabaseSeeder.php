<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\admin\QrModel;
use App\Models\Library\PdlModel;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory(100)
        ->has(QrModel::factory()->count(1), 'qrs')
        ->create();
        
        PdlModel::factory()->count(10)->create();
    }
}
