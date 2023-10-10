<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'barang-list',
            'barang-create',
            'barang-edit',
            'barang-delete',

            'pengajuan-list',
            
            'vendor-list',


            'jenis_barang-list',
            'jenis_barang-create',
            'jenis_barang-edit',
            'jenis_barang-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            
        ];
       
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
        }
    }
}