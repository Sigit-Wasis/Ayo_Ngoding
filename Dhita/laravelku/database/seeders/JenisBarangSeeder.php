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
     */
    public function run(): void
    {
        // for ($h=1; $h <= 10; $h++) {

        //     DB::table('mst_jenis_barang')->insert([
        //     'nama' => 'Buku' . ($h+ 1),
        //     'deskripsi' => 'Alat Tulis Kantor',
        //     'created_by' => 1,
        //     'updated_by' => 1,
        // ]);

        $IdTerakhir = DB::table('users')->latest('id')->first();

    //ELEQUENT
    $data = [
       [
        'nama' => 'Laravel 123',
        'deskripsi' => 'Alat Tulis Kantor',
        'created_by' => $IdTerakhir->id,
        'updated_by' => $IdTerakhir->id,
       ],
       [
        'nama' => 'Laravel 16',
        'deskripsi' => 'Alat Tulis Kantor',
        'created_by' => 1,
        'updated_by'=> 1,
       ],
       [
        'nama' => 'Laravel 17',
        'deskripsi' => 'Alat Tulis Kantor',
        'created_by' => 1,
        'updated_by' => 1,
       ],
    ];
    // JenisBarang adalah Model
    // pastikan model jenis barang sudah di generate dan sudah di use atau import di atasnya
    JenisBarang::insert($data);

    }
}     

