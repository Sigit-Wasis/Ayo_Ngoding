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
            'role-show',

            'barang-list',
            'barang-create',
            'barang-edit',
            'barang-delete',
            'barang-show',

            'jenis_barang-list',
            'jenis_barang-create',
            'jenis_barang-edit',
            'jenis_barang-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'vendor-list',
            'vendor-create',
            'vendor-edit',
            'vendor-show',
            'vendor-delete',

            'approve-ap',
            'approve-vendor',
            'tolak-ap',
            'tolak-vendor',

            'laporan-list',
            'laporan-cetak',
            'laporan-download',

            'pengajuan-list',
            'pengajuan-create',
            'pengajuan-edit',
            'pengajuan-delete',
            'pengajuan-show',
            
        ];
       
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
        }
    }
}