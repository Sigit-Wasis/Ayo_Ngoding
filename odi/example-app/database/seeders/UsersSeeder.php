<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Odi Adrian',
            'username' => 'Odi',
            'password' => Hash::make('123123'),
            'nama_lengkap' => 'Odi Adrian',
            'alamat' => 'Tanggamus',
            'nomor_telpon' => '082278890881',
            'email' => 'adrian@gmail.com',
        ]);

    }
    
}