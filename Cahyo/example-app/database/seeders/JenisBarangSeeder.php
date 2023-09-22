<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisBarang;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class JenisBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // for ($i = 0; $i < 5; $i++) {
        // DB::table('mst_jenis_barang')->insert([
           // 'nama_jenis_barang' => 'Pulpen' .($i +1),
           // 'deskripsi_barang' => 'Alat tulis yang digunakan untuk menuliskan tinta pada kertas atau permukaan lainnya',
           // 'created_by' => 1,
           // 'updated_by' => 1,
        //]);

        // QUERY UNTUK MENGAMBIL ID TERAKHIR DARI SEEDER TABLE USER
        $idTerakhir = DB::table('users')->latest('id')->first();
    
        $data = [
            [
                'nama_jenis_barang' => 'Pulpen2',
                'deskripsi_barang' => 'Alat tulis yang digunakan untuk menuliskan tinta pada kertas atau permukaan lainnya',
                'created_by' => $idTerakhir->id,
                'updated_by' => $idTerakhir->id,
            ],
            [
                'nama_jenis_barang' => 'Buku2',
                'deskripsi_barang' => 'Alat tulis yang digunakan untuk menulis',
                'created_by' => $idTerakhir->id,
                'updated_by' => $idTerakhir->id,
            ],
            [
                'nama_jenis_barang' => 'Penggaris2',
                'deskripsi_barang' => 'Alat tulis yang digunakan untuk mengaris',
                'created_by' => $idTerakhir->id,
                'updated_by' => $idTerakhir->id,
            ],
        ];
        JenisBarang::insert($data);
    }
}

