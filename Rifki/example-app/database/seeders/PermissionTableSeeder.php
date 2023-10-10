<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

  
class PermissionTableSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'barang-list',
            'barang-create',
            'barang-edit',
            'barang-show',
            'barang-delete',
            

            'jenis-barang-list',
            'jenis-barang-create',
            'jenis-barang-edit',
            'jenis-barang-delete',

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
