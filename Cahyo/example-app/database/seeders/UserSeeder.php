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
     *
     * @return void
     */
    public function run()
    {
        //QUERY BUILDER
        DB::table('users')->insert([
            'name' => 'Cahyoa',
            'username' => 'cahyoa',
            'email' => 'cah@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
