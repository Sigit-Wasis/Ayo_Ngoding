<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\JenisBarang;

class JenisBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$jumlahData = 10; // Ubah sesuai dengan jumlah data yang diinginkan
    
        for ($i = 0; $i < $jumlahData; $i++) {
            DB::table('_m_s_t__jenis__barang')->insert([
                'nama' => 'Penggaris ' . ($i + 1),
                'deskripsi' => 'alat pengukur dan alat bantu gambar untuk menggambar garis lurus',
                'created_by' => 1,
                'updated_by' => 1,
            ]);
        }*/

        // QUERY UNTUK MENGAMBIL ID TERAKHIR TABEL USER
        $inTerakhir = DB::table('users')->latest('id')->first();

        //ELEQUENT
        $data = [
            [
                'nama' => 'Penggaris ',
                'deskripsi' => 'alat pengukur dan alat bantu gambar untuk menggambar garis lurus',
                'created_by' => $inTerakhir->id,
                'updated_by' => $inTerakhir->id,

            ],
            [
                'nama' => 'Penggaris ',
                'deskripsi' => 'alat pengukur dan alat bantu gambar untuk menggambar garis lurus',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'nama' => 'Penggaris ',
                'deskripsi' => 'alat pengukur dan alat bantu gambar untuk menggambar garis lurus',
                'created_by' => 1,
                'updated_by' => 1,

            ],
        ];

        // JenisBarang adalah MOdel
        // Pastikan Model JenisBarang Sudah di Generate
        JenisBarang::insert($data);
    }
    
    }
