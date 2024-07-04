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
            ['Site Binuang', 'BNG', 'PT Adidaya Alam Borneo - Bangun Banua Persada Kalimantan', 'Binuang', 'Tapin', 'Kalimantan Selatan', 'Tambang Batu Bara'],
            ['Site Cilegon', 'CLG', 'PT Waskita Beton Precast Tbk', 'Bojonegara', 'Serang', 'Banten', 'Kuari Andesit'],
            ['Site Leuwikeris', 'LWK', 'PT PP (Persero) Tbk MARFRI - BBN KSO', 'Manonjaya', 'Kab. Tasikmalaya', 'Jawa Barat', 'Pembangunan Bendungan Leuwikeris Paket 6'],
            ['Site Mbay', 'MBY', 'PT Bumi Indah', 'Aesesa Selatan', 'Kab. Nagekeo', 'Nusa Tenggara Timur', 'Pembangunan Bendungan Mbay'],
            ['Site Medan', 'LWS', 'PT Wijaya Karya - PT Bumi Karsa KSO', 'Biru-Biru', 'Deli Serdang', 'Sumatera Utara', 'Pembangunan Bendungan Lau Simeme Paket I'],
            ['Site Sicincin', 'SCN', 'PT Hutama Karya Infrastruktur', '2x11 Enam Lingkung', 'Padang Pariaman', 'Sumatera Barat', 'Pembangunan Tol Padang - Sicincin'],
            ['Site Teluk Tapang', 'TPG', 'PT Wijaya Karya', 'Sungai Beremas', 'Pasaman Barat', 'Sumatera Barat', 'Pembangunan Jalan Akses Pelabuhan Teluk Tapang'],
            ['Site Probowangi', 'PRB', 'PT Wijaya Karya', 'Banyuglugur', 'Situbondo', 'Jawa Timur', 'Pembangunan Tol Probolinggo - Banyuwangi Zona 2'],
            ['Site Purworejo', 'PWR', 'PT Brantas Abipraya - PT Adhi Karya KSO', 'Bener', 'Purworejo', 'Jawa Tengah', 'Pembangunan Bendungan Bener Paket 4'],
            ['Site Taliabu', 'TLB', 'PT Adidaya Tangguh', 'Taliabu Selatan', 'Pulau Taliabu', 'Maluku Utara', 'Tambang Bijih Besi'],
            ['Site Trenggalek', 'TRK', 'PT PP (Persero) Tbk. - Jatiwangi KSO', 'Bendungan', 'Trenggalek', 'Jawa Timur', 'Pembangunan Bendungan Bagong'],
            ['Site Tulungagung', 'TLG',  'PT Waskita Karya (Persero) Tbk.', 'Pucanglaban', 'Kab. Tulungagung', 'Jawa Timur', 'Pembangunan Jalan Lintas Selatan Lot 6b'],
        ]);

        $sites->each(function($data){
            $site = new Site;
            $site->name = $data[0];
            $site->code = $data[1];
            $site->owner = $data[2];
            $site->district = $data[3];
            $site->regency = $data[4];
            $site->province = $data[5];
            $site->description = $data[6];
            $site->saveQuietly();
        });
    }
}
