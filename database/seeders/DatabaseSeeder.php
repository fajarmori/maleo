<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SiteSeeder::class,
            DepartmentSeeder::class,
            OccupationSeeder::class,
            EmployeeSeeder::class,
            UserSeeder::class,
        ]);
    }
}
