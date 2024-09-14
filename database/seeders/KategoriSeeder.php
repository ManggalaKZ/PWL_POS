<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kategori_id' => 1,
                'kategori_kode' => 'KT101',
                'kategori_nama' => 'Peralatan Bengkel',
            ],
            [
                'kategori_id' => 2,
                'kategori_kode' => 'KT102',
                'kategori_nama' => 'Perlengkapan Mobil',
            ],
            [
                'kategori_id' => 3,
                'kategori_kode' => 'KT103',
                'kategori_nama' => 'Suku Cadang Motor',
            ],
            [
                'kategori_id' => 4,
                'kategori_kode' => 'KT104',
                'kategori_nama' => 'Elektronik Kendaraan',
            ],
            [
                'kategori_id' => 5,
                'kategori_kode' => 'KT105',
                'kategori_nama' => 'Peralatan Keselamatan',
            ],
            [
                'kategori_id' => 6,
                'kategori_kode' => 'KT106',
                'kategori_nama' => 'Pelumas dan Cairan',
            ],
            [
                'kategori_id' => 7,
                'kategori_kode' => 'KT107',
                'kategori_nama' => 'Body Kit dan Modifikasi',
            ],
        ];
        
        DB::table('m_kategori')->insert($data);
        
    }
}
