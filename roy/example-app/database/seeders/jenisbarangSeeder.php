<?php

namespace Database\Seeders;

use Illiminate\Database\Console\Seeds\withoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisBarang;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class jenisbarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //QUERY BUILDER
        //  DB::table('jenis_barang')->insert([
         //     'nama_barang' => 'alat tulis',
         //     'deskripsi' => 'alat tulis kantor',
         //     'created_by' => 1,
        //      'updated_by' => 1,

        // ]);

        // QUERY UNTUK MENGAMBIL ID TERAKHIR DARI SEEDER TABLE USER
        $idTerakhir = DB::table('users')->latest('id')->first();

        //ELEQUENT
        $data = [
            [
                'nama_barang' => 'Buku `12',
                'deskripsi' => 'buat catatan',
                'created_by' => $idTerakhir->id, // mengambil id terakhir
                'updated_by' => $idTerakhir->id,
            ],
            [
                'nama_barang' => 'Bolpoin 322',
                'deskripsi' => 'Alat tulis kantor',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [

                'nama_barang' => 'Kertas F4 6',
                'deskripsi' => 'kertas printer',
                'created_by' => 1,
                'updated_by' => 1,   

            ],
        ];
        //JenisBarang adalah MODEL
        /*
            PASTIKAN MODEL JENISBARANG SUDAH DI GANERATE
            DAN SUDAH DI USE ATAU IMPORT DI ATAS
            */
        JenisBarang::insert($data);
    }
}
