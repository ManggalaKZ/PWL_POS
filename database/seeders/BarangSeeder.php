<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{public function run(): void
    {
        $data = [
            [
                'barang_id' => 1,
                'kategori_id' => 1,
                'barang_kode' => 'BR001',
                'barang_nama' => 'Mesin V8',
                'harga_beli' => 5000000,
                'harga_jual' => 5500000,
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 2,
                'barang_kode' => 'BR002',
                'barang_nama' => 'Knalpot Racing',
                'harga_beli' => 1000000,
                'harga_jual' => 1200000,
            ],
            [
                'barang_id' => 3,
                'kategori_id' => 3,
                'barang_kode' => 'BR003',
                'barang_nama' => 'Aki Kering',
                'harga_beli' => 800000,
                'harga_jual' => 850000,
            ],
            [
                'barang_id' => 4,
                'kategori_id' => 4,
                'barang_kode' => 'BR004',
                'barang_nama' => 'Velg Racing 18 Inch',
                'harga_beli' => 3000000,
                'harga_jual' => 3500000,
            ],
            [
                'barang_id' => 5,
                'kategori_id' => 5,
                'barang_kode' => 'BR005',
                'barang_nama' => 'Shockbreaker Racing',
                'harga_beli' => 2500000,
                'harga_jual' => 2700000,
            ],
            [
                'barang_id' => 6,
                'kategori_id' => 1,
                'barang_kode' => 'BR006',
                'barang_nama' => 'Mesin Inline-4',
                'harga_beli' => 4000000,
                'harga_jual' => 4500000,
            ],
            [
                'barang_id' => 7,
                'kategori_id' => 2,
                'barang_kode' => 'BR007',
                'barang_nama' => 'Jok Kulit Premium',
                'harga_beli' => 1500000,
                'harga_jual' => 1750000,
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 3,
                'barang_kode' => 'BR008',
                'barang_nama' => 'Alternator 12V',
                'harga_beli' => 950000,
                'harga_jual' => 1100000,
            ],
            [
                'barang_id' => 9,
                'kategori_id' => 4,
                'barang_kode' => 'BR009',
                'barang_nama' => 'Ban Tubeless 17 Inch',
                'harga_beli' => 1200000,
                'harga_jual' => 1400000,
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 5,
                'barang_kode' => 'BR010',
                'barang_nama' => 'Stabilizer Bar',
                'harga_beli' => 2000000,
                'harga_jual' => 2200000,
            ],
            [
                'barang_id' => 11,
                'kategori_id' => 1,
                'barang_kode' => 'BR011',
                'barang_nama' => 'Mesin Boxer',
                'harga_beli' => 6000000,
                'harga_jual' => 6500000,
            ],
            [
                'barang_id' => 12,
                'kategori_id' => 2,
                'barang_kode' => 'BR012',
                'barang_nama' => 'Lampu LED Headlight',
                'harga_beli' => 750000,
                'harga_jual' => 900000,
            ],
            [
                'barang_id' => 13,
                'kategori_id' => 3,
                'barang_kode' => 'BR013',
                'barang_nama' => 'Kabel Busi Racing',
                'harga_beli' => 450000,
                'harga_jual' => 500000,
            ],
            [
                'barang_id' => 14,
                'kategori_id' => 4,
                'barang_kode' => 'BR014',
                'barang_nama' => 'Velg Chrome 20 Inch',
                'harga_beli' => 4000000,
                'harga_jual' => 4500000,
            ],
            [
                'barang_id' => 15,
                'kategori_id' => 5,
                'barang_kode' => 'BR015',
                'barang_nama' => 'Coilover Suspension',
                'harga_beli' => 3000000,
                'harga_jual' => 3200000,
            ],
        ];
        
        DB::table('m_barang')->insert($data);
               
    }
}
