<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'data_barang-list',
            'data_barang-create',
            'data_barang-detail',
            'data_barang-edit',
            'data_barang-delete',

            'jenis_barang-list',
            'jenis_barang-create',
            'jenis_barang-edit',
            'jenis_barang-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'vendors-list',
            'vendors-create',
            'vendors-edit',
            'vendors-delete',

            'pengajuan-list',
            'pengajuan-create',
            'pengajuan-detail',
            'pengajuan-edit',
            'pengajuan-delete',

            'laporan_list',
            'laporan_cetak',
            'laporan_download',

            'approve_vendor',
            'approve_ap',
            'tolak_vendor',
            'tolak_ap',

            'import_barang'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
