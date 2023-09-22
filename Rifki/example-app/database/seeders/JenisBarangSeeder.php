<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisBarang;
use Illuminate\Support\Facades\DB;


class JenisBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     */
    public function run(): void
    {
       // QUIERY BUILDER
    //    DB::table('mst_jenis_barang')->insert([
        // 'nama_barang' =>'Alat Tulis',
        // 'deskripsi' =>'Alat Tulis Kantor',
        // 'created_by' => 1,
        // 'updated_by' => 1,
        
    // ]);

    // QUERY UNTUK MENGAMBIL ID TERAKHIR DARI TABLE USER
    $idTerakhir = DB::table('users')->latest('id')->first();
    
    //ELEQUENT
    $data = [
        [
        'nama_barang' =>'Alat Tulis65',
        'deskripsi' =>'Alat Tulis Kantor65',
        'created_by' => $idTerakhir->id, // mengambil id terakhir
        'updated_by' => $idTerakhir->id, // mengambil id terakhir
        ],
    [
        'nama_barang' =>'Alat Tulis',
        'deskripsi' =>'Alat Tulis Kantor',
        'created_by' => 1,
        'updated_by' => 1,
    ],
    [
        'nama_barang' =>'Alat Tulis',
        'deskripsi' =>'Alat Tulis Kantor',
        'created_by' => 1,
        'updated_by' => 1,
    ],
    
    ];
    
    // JenisBarang adalah Model
    // Pastikan 
    JenisBarang::insert($data);
}
}
