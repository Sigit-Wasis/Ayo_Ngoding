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
     */
    public function run(): void
    {
        // DB::table('jenis_barang')->insert([
        //     'nama_jenis_barang' => 'Alat Tulis f',
        //     'deskripsi' => ('Alat Tulis Kantor'),
        //     'created_by' => 1,
        //     'updated_by' => 1,
        // ]);

        $idterakhir = DB::table('users')->latest('id')->first();
    
    // ELEQUEN
    $data = [
        [
            'nama_jenis_barang' => 'Buku tulis',
            'deskripsi' => ('Alat Tulis Kantor'),
            'created_by' => $idterakhir->id,
            'updated_by' => $idterakhir->id,
        ],
        [
            'nama_jenis_barang' => 'Pulpen permanen',
            'deskripsi' => ('Alat Tulis Kantor'),
            'created_by' => 3,
            'updated_by' => 3,
        ],
    ];
    JenisBarang::insert($data);
}
}


