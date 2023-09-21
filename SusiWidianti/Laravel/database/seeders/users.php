<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // QUERY BUILDER
        DB::table('users')->insert([
            'username' => 'susi',
            'password' => Hash::make ('12345678'),
            'nama_lengkap' =>'Susi widianti',
            'alamat' => 'Mesuji',
            'nomor_telepon' => '085789471231',
            'email' => 'widiantisusi@gmail.com'

        ]);
    }
}
