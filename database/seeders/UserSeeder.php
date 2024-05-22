<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = collect([
            ['name' => 'Maleo Rachma', 'email' => 'admin@mria.co.id', 'type' => 2, 'password' => 'password'],
            ['name' => 'Indo Abadi', 'email' => 'info@mria.co.id', 'type' => 1, 'password' => 'password'],
            ['name' => 'Mohamad Rizki Fajar', 'email' => 'fajar@mria.co.id', 'type' => 0, 'password' => 'password'],
        ]);

        $users->each(function($user){
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'type' => $user['type'],
                'password' => Hash::make($user['password']),
            ]);
        });
    }
}
