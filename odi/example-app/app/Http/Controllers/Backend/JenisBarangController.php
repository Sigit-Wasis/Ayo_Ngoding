<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\JenisBarangRequest;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class JenisBarangController extends Controller
{
    public function index() {
        
        $jenisBarang = FacadesDB::table('jenis_barang')->select('jenis_barang.*','name as created_by')->orderBy('jenis_barang.id', 'DESC')
        ->join('users', 'users.id', 'jenis_barang.created_by')
        ->paginate(10);

        // dd($jenisBarang);

        return view ('backend.jenis_barang.index', compact('jenisBarang'));
    }

    public function create(){
        return view ('backend.jenis_barang.create');
    }

    public function store (JenisBarangRequest $request){
        // tipe data $request adalah objek

        // DD (die dump untuk meriksa apakah ada value atau record di dalam variabel $request yang diambil dari form inputan)
        // dd($request->all());

        FacadesDB::table('jenis_barang')->insert([
            'nama_jenis_barang' =>$request->nama_jenis_barang,
            'deskripsi' =>$request->deskripsi,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        return redirect()->route('jenis_barang')->with('message','Jenis Barang Berhasil Disimpan');
    }

    public function edit($id) {

        // menggunakan first karna kita mau ngambil data hanya 1 sesuai dengan id
        $editJenisBarang = FacadesDB::table('jenis_barang')->where('id', $id)->first();

        return view('backend.jenis_barang.edit', compact('editJenisBarang'));
    }

    public function update(JenisBarangRequest $request, $id) {

        FacadesDB::table('jenis_barang')->where ('id',$id)->update([
            'nama_jenis_barang' =>$request->nama_jenis_barang,
            'deskripsi' =>$request->deskripsi,
            'updated_by' => 1,
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        return redirect()->route('jenis_barang')->with('message','Jenis Barang Berhasil Diupdate');
    }

    public function destroy($id) {
        FacadesDB::table('jenis_barang')->where('id', $id)->delete();

        return redirect()->route('jenis_barang')->with('message','Jenis Barang Berhasil Dihapus');
    }
}