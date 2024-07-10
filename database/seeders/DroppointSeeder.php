<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Droppoint;

class DroppointSeeder extends Seeder
{
    public function run(): void
    {
        $droppoints = collect([
            ['DIVISI SCM - HEAD OFFICE','Jl. Raya Pasir Maung RT 002 RW 005, Desa Cijayanti, Kec. Babakan Madang, Kab. Bogor, Jawa Barat - 16810',NULL],
            ['DIVISI HSE - HEAD OFFICE','Jl. Raya Pasir Maung RT 002 RW 005, Desa Cijayanti, Kec. Babakan Madang, Kab. Bogor, Jawa Barat - 16810',NULL],
            ['DIVISI GAIT - HEAD OFFICE','Jl. Raya Pasir Maung RT 002 RW 005, Desa Cijayanti, Kec. Babakan Madang, Kab. Bogor, Jawa Barat - 16810',NULL],
            ['DIVISI WORKSHOP - HEAD OFFICE','Jl. Raya Pasir Maung RT 002 RW 005, Desa Cijayanti, Kec. Babakan Madang, Kab. Bogor, Jawa Barat - 16810',NULL],
            ['SITE PURWOREJO','Jl. Guntur, Kec. Bener, Kab. Purworejo, Jawa Tengah - 54183',NULL],
            ['SITE LAUSIMEME','Dusun IV Suku Rakyat Desa Mbaruai, Kec. Sibiru biru, Kab. Deli Serdang, No 28, Medan - 20358',NULL],
            ['SITE TALIABU ','Air Kalimar, Taliabu Utara, Taliabu Island Regency, North Maluku.',NULL],
            ['SITE LEUWIKERIS','Jl. Manonjaya – Banjar No 142, Pasir Batang, Kec. Manonjaya, Kab. Tasikmalaya, Jawa Barat - 46197',NULL],
            ['SITE PADANG PANGKALAN','Pangkalan 50 Kota',NULL],
            ['SITE MBAY','Proyek Bendungan Mbay/Lambo Desa Rendu Butowe Kecamatan Aesesa Selatan, Kabupaten Nagekeo Flores - NTT',NULL],
            ['SITE TULUNGAGUNG','Dsn Puser Semberdadap Ds. Kebon, Pucanglaban Tulung Agung - 66284',NULL],
            ['SITE TELUK TAPANG','Proyek Pembangunan Jalan Dermaga Teluk Tapang, Kecamatan Sungai Beremas Kabupaten Pasaman Barat, Sumatera Barat 26573',NULL],
            ['SITE PROBOWANGI ','Jl. Nasional 1, Krajan, Banyuglugur, Rt 01 / Rw 02 Kec. Banyuglugur, Kabupaten Sitobondo, Jawa Timur 68359','Warung Bu Lih depan Benur Samudra Pagar Merah Putih'],
            ['SITE PADANG SICINCIN','Pasa dama, parit malintang, enam lingkung, kab. Padang pariaman, sumatera barat',NULL],
            ['SITE BINUANG ','Jl. Raya Timur RT 007, RW 002, Kel. Kambang Kuning, Kec. Hatungun, Kab. Tapin, Kalsel - 71183',NULL],
            ['SITE TRENGGALEK ','Kantor PT PP Proyek Bendungan Bagong Paket 2 Jeruk Srabah, Bendungan, Trenggalek Regency,  Jawa Timur 66351',NULL],
            ['SITE CILEGON WBP','Kp. Kernaden Rt 02/ Rw 02 Desa Ukirsari – Kec. Bojonegara Kab. Serang Banten',NULL],
            ['SITE RAOS','Jl Taman Nasional Ujung Kulon, Kertajaya, Kabupaten Pandeglang, Banten',NULL],
            ['SITE CILEGON KAP','Site Cilegon KAP',NULL],
            ['SITE JENELATA','Site Jenelata',NULL],
        ]);

        $droppoints->each(function($data){
            $droppoint = new Droppoint;
            $droppoint->name = $data[0];
            $droppoint->address = $data[1];
            $droppoint->notes = $data[2];
            $droppoint->saveQuietly();
        });
    }
}
