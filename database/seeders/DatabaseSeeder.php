<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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

      // Call multiple seeders here
      $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            FarmSeeder::class,
            AppInfoSeeder::class,
            module_access::class,
        ]);

    }
}
