<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Site;

class SiteSeeder extends Seeder
{
    public function run(): void
    {
        $sites = collect([
            ['name' => 'Site Binuang', 'owner' => 'PT Adidaya Alam Borneo - Bangun Banua Persada Kalimantan', 'district' => 'Binuang', 'regency' => 'Tapin', 'province' => 'Kalimantan Selatan', 'description' => 'Tambang Batu Bara'],
            ['name' => 'Site Cilegon', 'owner' => 'PT Waskita Beton Precast Tbk', 'district' => 'Bojonegara', 'regency' => 'Serang', 'province' => 'Banten', 'description' => 'Kuari Andesit'],
            ['name' => 'Site Leuwikeris', 'owner' => 'PT PP (Persero) Tbk MARFRI - BBN KSO', 'district' => 'Manonjaya', 'regency' => 'Kab. Tasikmalaya', 'province' => 'Jawa Barat', 'description' => 'Pembangunan Bendungan Leuwikeris Paket 6'],
            ['name' => 'Site Mbay', 'owner' => 'PT Bumi Indah', 'district' => 'Aesesa Selatan', 'regency' => 'Kab. Nagekeo', 'province' => 'Nusa Tenggara Timur', 'description' => 'Pembangunan Bendungan Mbay'],
            ['name' => 'Site Medan', 'owner' => 'PT Wijaya Karya - PT Bumi Karsa KSO', 'district' => 'Biru-Biru', 'regency' => 'Deli Serdang', 'province' => 'Sumatera Utara', 'description' => 'Pembangunan Bendungan Lau Simeme Paket I'],
            ['name' => 'Site Sicincin', 'owner' => 'PT Hutama Karya Infrastruktur', 'district' => '2x11 Enam Lingkung', 'regency' => 'Padang Pariaman', 'province' => 'Sumatera Barat', 'description' => 'Pembangunan Tol Padang - Sicincin'],
            ['name' => 'Site Teluk Tapang', 'owner' => 'PT Wijaya Karya', 'district' => 'Sungai Beremas', 'regency' => 'Pasaman Barat', 'province' => 'Sumatera Barat', 'description' => 'Pembangunan Jalan Akses Pelabuhan Teluk Tapang'],
            ['name' => 'Site Probowangi', 'owner' => 'PT Wijaya Karya', 'district' => 'Banyuglugur', 'regency' => 'Situbondo', 'province' => 'Jawa Timur', 'description' => 'Pembangunan Tol Probolinggo - Banyuwangi Zona 2'],
            ['name' => 'Site Purworejo', 'owner' => 'PT Brantas Abipraya - PT Adhi Karya KSO', 'district' => 'Bener', 'regency' => 'Purworejo', 'province' => 'Jawa Tengah', 'description' => 'Pembangunan Bendungan Bener Paket 4'],
            ['name' => 'Site Taliabu', 'owner' => 'PT Adidaya Tangguh', 'district' => 'Taliabu Selatan', 'regency' => 'Pulau Taliabu', 'province' => 'Maluku Utara', 'description' => 'Tambang Bijih Besi'],
            ['name' => 'Site Trenggalek', 'owner' => 'PT PP (Persero) Tbk. - Jatiwangi KSO', 'district' => 'Bendungan', 'regency' => 'Trenggalek', 'province' => 'Jawa Timur', 'description' => 'Pembangunan Bendungan Bagong'],
            ['name' => 'Site Tulungagung', 'owner' => 'PT Waskita Karya (Persero) Tbk.', 'district' => 'Pucanglaban', 'regency' => 'Kab. Tulungagung', 'province' => 'Jawa Timur', 'description' => 'Pembangunan Jalan Lintas Selatan Lot 6b'],
        ]);

        $sites->each(function($data){
            $site = new Site;
            $site->name = $data['name'];
            $site->owner = $data['owner'];
            $site->district = $data['district'];
            $site->regency = $data['regency'];
            $site->province = $data['province'];
            $site->description = $data['description'];
            $site->saveQuietly();
        });
    }
}
