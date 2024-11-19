<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\admin\QrModel;
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
        User::factory(100)
        ->has(QrModel::factory()->count(1), 'qrs')
        ->create();

        PdlModel::factory()->count(10)->create();
    }
}
