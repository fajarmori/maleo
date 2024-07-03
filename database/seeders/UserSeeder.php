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
            ['Maleo Rachma Indo Abadi', 'admin@mria.co.id', 0, 'MaleO2014!', NULL],
            ['Rachma Farida Mardiani', 'rachma.farida@mria.co.id', 0, 'MRIA3022#', 1],
            ['Mohamad Rizki Fajar', 'fajar@mria.co.id', 1, 'MRIA5060#', 155],
            ['Raka Nursatrio Nugraha', 'raka.nursatrio@mria.co.id', 2, 'MRIA9032#', 168],
            ['Raihan Farid Rachmaditya', 'raihan.farid@mria.co.id', 1, 'MRIA4010#', 111],
            ['Adella Putri Grimuarti', 'adella.putri@mria.co.id', 1, 'MRIA9042#', 193],
            ['Alfarri Febriana', 'alfarri@mria.co.id', 2, 'MRIA2071#', 240],
            ['Agung Wicaksono', 'agung.wicaksono@mria.co.id', 2, 'MRIA2190#', 284],
            ['Site MRIA 01', 'sitemria01@mria.co.id', 1, 'MRIA1001#', NULL],
            ['Site MRIA 02', 'sitemria02@mria.co.id', 1, 'MRIA2002#', NULL],
            ['Site MRIA 03', 'sitemria03@mria.co.id', 1, 'MRIA3003#', NULL],
            ['Site MRIA 04', 'sitemria04@mria.co.id', 1, 'MRIA4004#', NULL],
            ['Site MRIA 05', 'sitemria05@mria.co.id', 1, 'MRIA5005#', NULL],
            ['Site MRIA 06', 'sitemria06@mria.co.id', 1, 'MRIA6006#', NULL],
            ['Site MRIA 07', 'sitemria07@mria.co.id', 1, 'MRIA7007#', NULL],
            ['Site MRIA 08', 'sitemria08@mria.co.id', 1, 'MRIA8008#', NULL],
            ['Site MRIA 09', 'sitemria09@mria.co.id', 1, 'MRIA9009#', NULL],
            ['Site MRIA 10', 'sitemria10@mria.co.id', 1, 'MRIA0110#', NULL],
            ['Site MRIA 11', 'sitemria11@mria.co.id', 1, 'MRIA1111#', NULL],
            ['Site MRIA 12', 'sitemria12@mria.co.id', 1, 'MRIA2112#', NULL],
            ['Site MRIA 13', 'sitemria13@mria.co.id', 1, 'MRIA3113#', NULL],
            ['Site MRIA 14', 'sitemria14@mria.co.id', 1, 'MRIA4114#', NULL],
            ['Site MRIA 15', 'sitemria15@mria.co.id', 1, 'MRIA5115#', NULL],
            ['Achmad Jayadi Suardi', 'achmad.jayadi@mria.co.id', 1, 'MRIA1030#', 130],
            ['Adang Sahroni', 'adang.sahroni@mria.co.id', 1, 'MRIA4090#', 11],
            ['Ade Wahyudin', 'ade.wahyudin@mria.co.id', 1, 'MRIA0141#', 29],
            ['Ahmad Jauhari', 'ahmad.jauhari@mria.co.id', 1, 'MRIA4052#', 86],
            ['Angga Wardhana', 'angga.wardhana@mria.co.id', 1, 'MRIA6002#', 7],
            ['Anggi Gilang', 'anggi.gilang@mria.co.id', 1, 'MRIA6092#', 77],
            ['Annisa Noorraya', 'annisa.noorraya@mria.co.id', 1, 'MRIA5080#', 343],
            ['Ardiyansah', 'ardiyansah@mria.co.id', 1, 'MRIA9022#', 171],
            ['Muhamad Bagas Perdana Rosidin', 'bagas.perdana@mria.co.id', 1, 'MRIA1141#', 143],
            ['Bemby Maulana S', 'bemby.maulana@mria.co.id', 2, 'MRIA0142#', 339],
            ['Davik Budiyana', 'davik@mria.co.id', 2, 'MRIA0102#', 181],
            ['Dwi Yuda Meliady Kusuma', 'dwi.yuda@mria.co.id', 1, 'MRIA3050#', 286],
            ['Muhammad Farhan Fadhilah', 'farhan.fadhilah@mria.co.id', 1, 'MRIA2150#', 144],
            ['Herdis', 'herdis@mria.co.id', 1, 'MRIA3020#', 28],
            ['Kharina Utami', 'kharina.utami@mria.co.id', 1, 'MRIA5061#', 8],
            ['Mohamad Hasan', 'moh.hasan@mria.co.id', 1, 'MRIA0102#', 239],
            ['Muny Malinda', 'muny.malinda@mria.co.id', 1, 'MRIA4030#', 318],
            ['Nendi Rohendi', 'nendi.rohendi@mria.co.id', 1, 'MRIA1030#', 73],
            ['Nur Amaliah Hasanah', 'nur.amaliah@mria.co.id', 1, 'MRIA2110#', 65],
            ['Paul Armando', 'paul.armando@mria.co.id', 1, 'MRIA5013#', 234],
            ['Hammam Priyadi Sadan', 'priyadi.sadan@mria.co.id', 1, 'MRIA6010#', 114],
            ['Risa Sri Wahyuni', 'risa.sri@mria.co.id', 2, 'MRIA1112#', 371],
            ['Sepgian Maulana Risnandar', 'sepgian.maulana@mria.co.id', 2, 'MRIA9062#', 39],
            ['Sera Indriani Sari', 'sera.indriani@mria.co.id', 1, 'MRIA8010#', 341],
            ['Wawang Rusmawan', 'wawang.rusmawan@mria.co.id', 1, 'MRIA9002#', 96],
            ['Yadi Supriyadi', 'yadi.supriyadi@mria.co.id', 0, 'MRIA1020#', 3],
            ['Zulkifliyadi', 'zulkifliyadi@mria.co.id', 1, 'MRIA6050#', 70],
        ]);

        $users->each(function($data){
            $user = new User;
            $user->name = $data[0];
            $user->email = $data[1];
            $user->type = $data[2];
            $user->password = Hash::make('password');
            $user->saveQuietly();

            if(!empty($data[4])){
                $detail = DetailEmployee::query()->where('id',$data[4])->first();
                $detail->update(['user_id' => $user->id]);
            }
        });
    }
}
