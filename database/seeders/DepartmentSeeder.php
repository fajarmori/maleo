<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{

    public function run(): void
    {
        $departments = collect([
            ['name' => 'Direksi', 'code' => 'DIR'],
            ['name' => 'Finance', 'code' => 'FIN'],
            ['name' => 'General Affair Information Technology', 'code' => 'GAIT'],
            ['name' => 'Human Resources', 'code' => 'HRD'],
            ['name' => 'Health, Safety, and Environment', 'code' => 'HSE'],
            ['name' => 'Supply Chain Management', 'code' => 'SCM'],
            ['name' => 'Marketing, Engineering, and Operasional', 'code' => 'MEO'],
            ['name' => 'Workshop', 'code' => 'WOR'],
            ['name' => 'Surveyor', 'code' => 'SUR'],
        ]);

        $departments->each(function($department){
            Department::create([
                'name' => $department['name'],
                'code' => $department['code'],
            ]);
        });
    }
}
