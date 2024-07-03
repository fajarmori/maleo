<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Occupation;

class OccupationSeeder extends Seeder
{
    public function run(): void
    {
        $occupations = collect([
            ['name' => 'Admin HSE', 'department_id' => '5'],
            ['name' => 'Admin MEO', 'department_id' => '7'],
            ['name' => 'Admin Site', 'department_id' => '7'],
            ['name' => 'Admin Workshop', 'department_id' => '8'],
            ['name' => 'Asisten Blaster', 'department_id' => '7'],
            ['name' => 'Asisten Mekanik', 'department_id' => '7'],
            ['name' => 'Asisten Surveyor', 'department_id' => '7'],
            ['name' => 'Blaster', 'department_id' => '7'],
            ['name' => 'Blaster/Spv', 'department_id' => '7'],
            ['name' => 'Direktur', 'department_id' => '1'],
            ['name' => 'Direktur Utama', 'department_id' => '1'],
            ['name' => 'Driver Truck Anfo', 'department_id' => '7'],
            ['name' => 'Elektrikal', 'department_id' => '7'],
            ['name' => 'Engineer', 'department_id' => '7'],
            ['name' => 'Engineer/Spv', 'department_id' => '7'],
            ['name' => 'Foreman Drilling', 'department_id' => '7'],
            ['name' => 'Helper', 'department_id' => '7'],
            ['name' => 'Helper Drill dan Blast', 'department_id' => '7'],
            ['name' => 'Helper Mekanik', 'department_id' => '7'],
            ['name' => 'Helper Survey', 'department_id' => '7'],
            ['name' => 'IT', 'department_id' => '3'],
            ['name' => 'Junior Engineer', 'department_id' => '7'],
            ['name' => 'Junior Mekanik', 'department_id' => '7'],
            ['name' => 'Junior Operator', 'department_id' => '7'],
            ['name' => 'Junior Project Manajer', 'department_id' => '7'],
            ['name' => 'Komisaris', 'department_id' => '1'],
            ['name' => 'Kurir', 'department_id' => '3'],
            ['name' => 'Manager SCM', 'department_id' => '4'],
            ['name' => 'Manager Workshop', 'department_id' => '8'],
            ['name' => 'Manajer Finance & Tax', 'department_id' => '2'],
            ['name' => 'Manajer GA-IT', 'department_id' => '3'],
            ['name' => 'Manajer HSE', 'department_id' => '5'],
            ['name' => 'Mekanik', 'department_id' => '7'],
            ['name' => 'Office Boy', 'department_id' => '3'],
            ['name' => 'Operator', 'department_id' => '7'],
            ['name' => 'Operator Forklift', 'department_id' => '7'],
            ['name' => 'Operator HCR', 'department_id' => '7'],
            ['name' => 'Operator Loader/Exca', 'department_id' => '7'],
            ['name' => 'Operator Wheel Loader', 'department_id' => '7'],
            ['name' => 'Penanggung Jawab Operasional', 'department_id' => '7'],
            ['name' => 'Procurement', 'department_id' => '6'],
            ['name' => 'Project Manager', 'department_id' => '7'],
            ['name' => 'Quality Control Surveyor', 'department_id' => '9'],
            ['name' => 'Safety Engineer', 'department_id' => '5'],
            ['name' => 'Safety Man', 'department_id' => '5'],
            ['name' => 'Safety Officer', 'department_id' => '5'],
            ['name' => 'Security', 'department_id' => '3'],
            ['name' => 'Staff Finance & Tax', 'department_id' => '2'],
            ['name' => 'Staff GA', 'department_id' => '3'],
            ['name' => 'Staff HRD', 'department_id' => '4'],
            ['name' => 'Staff SCM', 'department_id' => '6'],
            ['name' => 'Surveyor', 'department_id' => '9'],
            ['name' => 'Technical Support', 'department_id' => '6'],
            ['name' => 'Umum', 'department_id' => '3'],
        ]);

        $occupations->each(function($data){
            $occupation = new Occupation;
            $occupation->name = $data['name'];
            $occupation->department_id = $data['department_id'];
            $occupation->saveQuietly();
        });
    }
}
