<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // QUIERY BUILDER
        DB::table('users')->insert([
            'name'=>'rifki alvareza',
            'email'=>'alva14lonte@gmail',
            'password'=> Hash::make('12345689')
        ]);
    }
}
