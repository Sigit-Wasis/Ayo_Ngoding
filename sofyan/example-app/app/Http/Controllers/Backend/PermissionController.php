<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function createpermission()
    {
        return view('backend.permission.createPermission');
    }

    public function permissionAdd(Request $request)
    {
        $request->validate([
            'nama_permision' => 'required',
        ], [
            'nama_permision.required' => 'Nama Permission harus diisi.',
        ]);

        DB::table('permissions')->insert([
            'name' => $request->nama_permision,
            'guard_name' => 'web',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect()->route('roles.index')->with('permission_message', 'Permission Berhasil Disimpan!');
    }

    public function deletepermission($id)
    {
        DB::table('permissions')->where('id', $id)->delete();
        return redirect()->route('roles.index')->with('permission_message', 'Permission Berhasil Dihapus!');
    }

    public function editpermission($id)
    {
        // Mengambil data jenis barang yang akan diedit berdasarkan ID
        $editPermission = DB::table('permissions')->where('id', $id)->first();

        if (!$editPermission) {
            return redirect()->route('roles.index')->with('error', 'Permission tidak ditemukan.');
        }

        // Simpan data jenis barang ke dalam sesi
        session(['edit_permission' => $editPermission]);

        // Arahkan ke halaman create
        return view('backend.permission.edit', compact('editPermission'));
    }


    public function updatepermission(Request $request, $id)
{
    DB::table('permissions')
        ->where('id', $id)
        ->update([
            'name' => $request->nama_permissions, // Perbaiki penamaan kolom
            'guard_name' => 'web',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

    return redirect()->route('roles.index')->with('permission_message', 'Permission berhasil diperbarui!');
}
}
