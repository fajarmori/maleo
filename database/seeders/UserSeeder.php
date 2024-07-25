<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\DetailEmployee;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = collect([
            ['Maleo Rachma Indo Abadi', 'admin@mria.co.id', 0, 'MaleO2014!', NULL, 1],
            ['Rachma Farida Mardiani', 'rachma.farida@mria.co.id', 0, 'MRIA3022#', 1, 1],
            ['Mohamad Rizki Fajar', 'fajar@mria.co.id', 1, 'MRIA5060#', 155, 3],
            ['Raka Nursatrio Nugraha', 'raka.nursatrio@mria.co.id', 2, 'MRIA9032#', 168, 3],
            ['Raihan Farid Rachmaditya', 'raihan.farid@mria.co.id', 1, 'MRIA4010#', 111, 1],
            ['Adella Putri Grimuarti', 'adella.putri@mria.co.id', 1, 'MRIA9042#', 193, 4],
            ['Alfarri Febriana', 'alfarri@mria.co.id', 2, 'MRIA2071#', 240, 4],
            ['Agung Wicaksono', 'agung.wicaksono@mria.co.id', 2, 'MRIA2190#', 284, 4],
            ['Site MRIA 01', 'sitemria01@mria.co.id', 1, 'MRIA1001#', NULL, 2],
            ['Site MRIA 02', 'sitemria02@mria.co.id', 1, 'MRIA2002#', NULL, 2],
            ['Site MRIA 03', 'sitemria03@mria.co.id', 1, 'MRIA3003#', NULL, 2],
            ['Site MRIA 04', 'sitemria04@mria.co.id', 1, 'MRIA4004#', NULL, 2],
            ['Site MRIA 05', 'sitemria05@mria.co.id', 1, 'MRIA5005#', NULL, 2],
            ['Site MRIA 06', 'sitemria06@mria.co.id', 1, 'MRIA6006#', NULL, 2],
            ['Site MRIA 07', 'sitemria07@mria.co.id', 1, 'MRIA7007#', NULL, 2],
            ['Site MRIA 08', 'sitemria08@mria.co.id', 1, 'MRIA8008#', NULL, 2],
            ['Site MRIA 09', 'sitemria09@mria.co.id', 1, 'MRIA9009#', NULL, 2],
            ['Site MRIA 10', 'sitemria10@mria.co.id', 1, 'MRIA0110#', NULL, 2],
            ['Site MRIA 11', 'sitemria11@mria.co.id', 1, 'MRIA1111#', NULL, 2],
            ['Site MRIA 12', 'sitemria12@mria.co.id', 1, 'MRIA2112#', NULL, 2],
            ['Site MRIA 13', 'sitemria13@mria.co.id', 1, 'MRIA3113#', NULL, 2],
            ['Site MRIA 14', 'sitemria14@mria.co.id', 1, 'MRIA4114#', NULL, 2],
            ['Site MRIA 15', 'sitemria15@mria.co.id', 1, 'MRIA5115#', NULL, 2],
            ['Achmad Jayadi Suardi', 'achmad.jayadi@mria.co.id', 1, 'MRIA1030#', 130, 10],
            ['Adang Sahroni', 'adang.sahroni@mria.co.id', 1, 'MRIA4090#', 11, 3],
            ['Ade Wahyudin', 'ade.wahyudin@mria.co.id', 1, 'MRIA0141#', 29, 6],
            ['Ahmad Jauhari', 'ahmad.jauhari@mria.co.id', 1, 'MRIA4052#', 86, 8],
            ['Angga Wardhana', 'angga.wardhana@mria.co.id', 1, 'MRIA6002#', 7, 6],
            ['Anggi Gilang', 'anggi.gilang@mria.co.id', 1, 'MRIA6092#', 77, 7],
            ['Annisa Noorraya', 'annisa.noorraya@mria.co.id', 1, 'MRIA5080#', 343, 8],
            ['Ardiyansah', 'ardiyansah@mria.co.id', 1, 'MRIA9022#', 171, 8],
            ['Muhamad Bagas Perdana Rosidin', 'bagas.perdana@mria.co.id', 1, 'MRIA1141#', 143, 3],
            ['Bemby Maulana S', 'bemby.maulana@mria.co.id', 2, 'MRIA0142#', 339, 7],
            ['Davik Budiyana', 'davik@mria.co.id', 2, 'MRIA0102#', 181, 6],
            ['Dwi Yuda Meliady Kusuma', 'dwi.yuda@mria.co.id', 1, 'MRIA3050#', 286, 10],
            ['Muhammad Farhan Fadhilah', 'farhan.fadhilah@mria.co.id', 1, 'MRIA2150#', 144, 6],
            ['Herdis', 'herdis@mria.co.id', 1, 'MRIA3020#', 28, 9],
            ['Kharina Utami', 'kharina.utami@mria.co.id', 1, 'MRIA5061#', 8, 7],
            ['Mohamad Hasan', 'moh.hasan@mria.co.id', 1, 'MRIA0102#', 239, 9],
            ['Muny Malinda', 'muny.malinda@mria.co.id', 1, 'MRIA4030#', 318, 8],
            ['Nendi Rohendi', 'nendi.rohendi@mria.co.id', 1, 'MRIA1030#', 73, 6],
            ['Nur Amaliah Hasanah', 'nur.amaliah@mria.co.id', 1, 'MRIA2110#', 65, 5],
            ['Paul Armando', 'paul.armando@mria.co.id', 1, 'MRIA5013#', 234, 6],
            ['Hammam Priyadi Sadan', 'priyadi.sadan@mria.co.id', 1, 'MRIA6010#', 114, 5],
            ['Risa Sri Wahyuni', 'risa.sri@mria.co.id', 2, 'MRIA1112#', 371, 7],
            ['Sepgian Maulana Risnandar', 'sepgian.maulana@mria.co.id', 2, 'MRIA9062#', 39, 3],
            ['Sera Indriani Sari', 'sera.indriani@mria.co.id', 1, 'MRIA8010#', 341, 8],
            ['Wawang Rusmawan', 'wawang.rusmawan@mria.co.id', 1, 'MRIA9002#', 96, 5],
            ['Yadi Supriyadi', 'yadi.supriyadi@mria.co.id', 0, 'MRIA1020#', 3, 1],
            ['Zulkifliyadi', 'zulkifliyadi@mria.co.id', 1, 'MRIA6050#', 70, 8],
        ]);

        $users->each(function($data){
            $user = new User;
            $user->name = $data[0];
            $user->email = $data[1];
            $user->type = $data[2];
            $user->department_id = $data[5];
            $user->password = Hash::make($data[3]);
            $user->saveQuietly();

            if(!empty($data[4])){
                $detail = DetailEmployee::query()->where('id',$data[4])->first();
                $detail->update(['user_id' => $user->id]);
            }
        });
    }
}
