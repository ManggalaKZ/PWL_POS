<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class PenjualanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['user_id' => 1, 'pembeli' => 'Bengkel A', 'penjualan_kode' => 'BR001', 'penjualan_tanggal' => Carbon::now()->subDays(10)->format('Y-m-d')],
            ['user_id' => 1, 'pembeli' => 'Bengkel B', 'penjualan_kode' => 'BR009', 'penjualan_tanggal' => Carbon::now()->subDays(9)->format('Y-m-d')],
            ['user_id' => 1, 'pembeli' => 'Bengkel C', 'penjualan_kode' => 'BR007', 'penjualan_tanggal' => Carbon::now()->subDays(8)->format('Y-m-d')],
            ['user_id' => 2, 'pembeli' => 'Bengkel D', 'penjualan_kode' => 'BR007', 'penjualan_tanggal' => Carbon::now()->subDays(7)->format('Y-m-d')],
            ['user_id' => 2, 'pembeli' => 'Bengkel E', 'penjualan_kode' => 'BR006', 'penjualan_tanggal' => Carbon::now()->subDays(6)->format('Y-m-d')],
            ['user_id' => 2, 'pembeli' => 'Bengkel F', 'penjualan_kode' => 'BR005', 'penjualan_tanggal' => Carbon::now()->subDays(5)->format('Y-m-d')],
            ['user_id' => 2, 'pembeli' => 'Bengkel G', 'penjualan_kode' => 'BR004', 'penjualan_tanggal' => Carbon::now()->subDays(4)->format('Y-m-d')],
            ['user_id' => 3, 'pembeli' => 'Bengkel H', 'penjualan_kode' => 'BR003', 'penjualan_tanggal' => Carbon::now()->subDays(3)->format('Y-m-d')],
            ['user_id' => 3, 'pembeli' => 'Bengkel I', 'penjualan_kode' => 'BR002', 'penjualan_tanggal' => Carbon::now()->subDays(2)->format('Y-m-d')],
            ['user_id' => 3, 'pembeli' => 'Bengkel J', 'penjualan_kode' => 'BR002', 'penjualan_tanggal' => Carbon::now()->subDays(1)->format('Y-m-d')],
        ];

        foreach ($data as $entry) {
            DB::table('t_penjualan')->insert($entry);
        }
    }
}
