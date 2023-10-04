<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Odi Adrian',
            'username' => 'Odi',
            'password' =>bcrypt('123123'),
            'nama_lengkap' => 'Odi Adrian',
            'alamat' => 'Tanggamus',
            'nomor_telpon' => '082278890881',
            'email' => 'oadrian@gmail.com',
        ]);
      
        $role = Role::create(['name' => 'Admin']);
       
        $permissions = Permission::pluck('id','id')->all();
     
        $role->syncPermissions($permissions);
       
        $user->assignRole([$role->id]);
    
    }
}