<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\JenisBarangRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisBarangController extends Controller
{
    public function index() {
            // Queri ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
            $jenisbarang = DB::table('jenis_barang')->select('jenis_barang.*', 'name as created_by')->orderBy('jenis_barang.id', 'DESC')
                ->join('users', 'users.id', 'jenis_barang.created_by')
                ->paginate(5);
            // dd($jenisbarang);

        return view('backend.jenis_barang.index', compact('jenisbarang'));
    }

    public function create() {
        return view('backend.jenis_barang.create');
    }

    public function store(JenisBarangRequest $request) {
        // Tipe data $request adalah object

        // DD (die dump untuk memeriksa apakah ada value atau record di dalam variable $request yang diambil dari form inputan)
        // dd($request->all());

        DB::table('jenis_barang')->insert([
            'nama_barang' => $request->nama_jenis_barang,
            'deskripsi' => $request->deskripsi,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect()->route('jenis_barang')->with('message', 'Jenis Barang Berhasil Disimpan');
        
    }

    public function edit($id) {
        // apa tipe data dari $id ? tipe datanya string dengan value integer, example "8"
        // Menggunakan first karena kita mau ngambil data hanya 1 yang sesuai dengan ID

        $editJenisBarang =DB::table('data_barang')->where('id', $id)->first();

        return view('backend.data_barang.edit', compact('editDataBarang'));
    }

    public function update(JenisBarangRequest $request,$id) {
        DB::table('jenis_barang')->where('id',$id)->update([
            'nama_barang' => $request->nama_data_barang,
            'deskripsi' => $request->deskripsi,
            'updated_by' => 1,
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect()->route('jenis_barang')->with('message', 'Data Barang Berhasil di Update');      

    }

    public function destroy($id) {
        DB::table('data_barang')->where('id', $id)->delete();

        return redirect()->route('data_barang')->with('message', 'Data Barang Berhasil Dihapus');
    }
}
