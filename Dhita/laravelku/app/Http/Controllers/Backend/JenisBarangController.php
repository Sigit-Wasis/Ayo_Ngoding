<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class JenisBarangController extends Controller
{
    public function index() {
        // query ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
        $jenisBarang = DB::table('mst_jenis_barang')->select('mst_jenis_barang.*', 'nama_lengkap as created_by')->orderBy('mst_jenis_barang.id', 'DESC')
            ->join('users', 'users.id', 'mst_jenis_barang.created_by')
            ->get();

        // dd($jenisBarang);

        return view('backend.jenis_barang.index', compact('jenisBarang'));
    }

    public function create() {
        return view('backend.jenis_barang.create');
    }

    public function store(Request $request) {
        DB::table('mst_jenis_barang')->insert([
                'nama' => $request->nama_jenis_barang,
                'deskripsi' => $request->deskripsi,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'Updated_at' => \Carbon\Carbon::now(),
        ]);
        
        return redirect()->route('jenis_barang')->with('message', 'Jenis Barang berhasil di Simpan!');
    }
    public function destroy($id) {
        DB::table('mst_jenis_barang')->where('id', $id)->delete();

        return redirect()->route('jenis_barang')->with('message', 'Jenis Barang berhasil dihapus');
    }
}
