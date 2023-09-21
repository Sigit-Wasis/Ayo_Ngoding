<?php

namespace Database\Seeders;

use Illiminate\Database\Console\Seeds\withoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // QUERY BULDER
        DB::table('users')->insert([
            'name' => 'Royqu',
            'user_name' => 'enakkk',
            'email' => 'akussewwwasds22@gmail.com',
            'password' => Hash::make('12345678')
            
        ]);
    }
}
