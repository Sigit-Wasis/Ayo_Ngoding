<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisBarang;
use Illuminate\Support\Facades\DB;

class jenis_barang extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //query builder
    //     $jumlahData = 10; //ubah sesuai dengan jumlah data yang diinginkan

    //     for ($i = 0; $i < $jumlahData; $i++){
    //     DB::table('jenis_barang')->insert([
    //         'nama_jenis_barang' => 'Alat Tulis'. ($i + 1),
    //         'deskripsi' => 'Alat Tulis Kantor',
    //         'created_by' => 1,
    //         'updated_by' => 1,
    //     ]);
    // }
    // QUERY UNTUK MENGAMBIL ID TERAKHIR DARI SEDER TABLE USER
    $idTerakhir = DB::table('users')->latest('id')->first();

    $data = [
        [
            'nama_jenis_barang' => 'Penggaris 11',
            'deskripsi' => 'ado',
            'created_by' => $idTerakhir->id,
            'updated_by' => $idTerakhir->id,
        ],
        [
            'nama_jenis_barang' => 'Laptop',
            'deskripsi' => 'kosong',
            'created_by' => 1,
            'updated_by' => 1,
        ],
        [
           'nama_jenis_barang'=> 'Buku',
            'deskripsi' => 'banyak',
            'created_by' => 1,
            'updated_by' => 1,
        ],
    ];
    //jenis barang adalah model
    /*
    / pastikan modeljenisbarang sudah di generete dan sudah diuse atau import diatas
   */
  JenisBarang::insert($data);
}
}