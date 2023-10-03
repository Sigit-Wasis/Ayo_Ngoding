<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mst_barang')->insert([
            'kode_barang' => 'KD01',
            'nama_barang' => 'Buku',
            'harga' => '10.000',
            'satuan' => '1 Pcs',
            'deskripsi' => 'Alat Tulis Kantor',
            'gambar' => '',
            'stok_barang' => 'tersedia',
        ]);
    }
}
