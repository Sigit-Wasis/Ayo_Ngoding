<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisBarang;
use Illuminate\Support\Facades\DB;

class jenis_barangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        // $jumlahData = 10; //Ubah sesuai data yang diinginkan
        // for ($i =2; $i <= $jumlahData; $i++){
        
        // DB::table('jenis_barang')->insert([
        //     'nama_jenis_barang' => 'Pena' . ($i+1),
        //     'deskripsi_barang' =>'alat tulis',
        //     'craeted_by' => 1,
        //     'updated_by' => 1,

        // ]);
        
        //QUERY UNTUK MENGAMBIL ID TERAKHIR DARI SEEDER TABLE USER
        $idTerakhir= DB::table('users')->latest('id')->first();
    

      $data = [
        [
            'nama_jenis_barang' => 'Laravel 2',
            'deskripsi_barang' =>'Buku',
            'craeted_by' => $idTerakhir->id, // mengambil id terakhir
            'updated_by' => $idTerakhir->id, // mengambil id terakhir
        ],
        [
            'nama_jenis_barang' => 'Laravel 3',
            'deskripsi_barang' =>'Pensil',
             'craeted_by' => 1,
             'updated_by' => 1,
        ],
        [
            'nama_jenis_barang' => 'Laravel 4',
            'deskripsi_barang' =>'Penggaris',
            'craeted_by' => 1,
            'updated_by' => 1,
        ],
    ];
    //JenisBarang adalah Model
    /*
     PASTIKAN MODEL JENIS BARANG SUDAH DI GENERATE
     DAN SUDAH DI USE ATAU IMPORT DI ATAS
     */
    JenisBarang::insert($data);

    }
}
