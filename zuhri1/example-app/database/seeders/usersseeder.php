<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class usersseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Query Builder
        DB::table('users')->insert([
            'name'=> Str::random(10),
            'username'=>'zuhri',
            'password'=> hash::make('12345'),
            'email'=>'zuhri1@gmail.com',
           
        ]);
        }
}
