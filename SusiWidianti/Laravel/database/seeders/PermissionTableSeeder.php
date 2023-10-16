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
            'barang-show',
            'barang-delete',

            'pengajuan-list',
            'pengajuan-create',
            'pengajuan-edit',
            'pengajuan-show',
            'pengajuan-delete',

            'vendor-list',
            'vendor-create',
            'vendor-edit',
            'vendor-show',
            'vendor-delete',

            'terima-ap',
            'terima-vendor',
            'tolak-ap',
            'tolak-vendor',

            'laporan-lis',
            'laporan-cetak',
            'laporan-download',

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
