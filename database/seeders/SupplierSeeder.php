<?php

namespace Database\Seeders;

use App\Models\m_supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'supplier_id' => 1,
                'supplier_kode' => 'SP101',
                'supplier_nama' => 'PT Mekanik Utama',
                'supplier_alamat' => 'Medan, Indonesia',
            ],
            [
                'supplier_id' => 2,
                'supplier_kode' => 'SP102',
                'supplier_nama' => 'CV Jaya Mandiri',
                'supplier_alamat' => 'Yogyakarta, Indonesia',
            ],
            [
                'supplier_id' => 3,
                'supplier_kode' => 'SP103',
                'supplier_nama' => 'PT Auto Parts Nusantara',
                'supplier_alamat' => 'Semarang, Indonesia',
            ],
            [
                'supplier_id' => 4,
                'supplier_kode' => 'SP104',
                'supplier_nama' => 'CV Prima Motorindo',
                'supplier_alamat' => 'Denpasar, Indonesia',
            ],
            [
                'supplier_id' => 5,
                'supplier_kode' => 'SP105',
                'supplier_nama' => 'PT Sumber Berkah',
                'supplier_alamat' => 'Makassar, Indonesia',
            ],
        ];
        
        DB::table('m_supplier')->insert($data);
        
    }
}
