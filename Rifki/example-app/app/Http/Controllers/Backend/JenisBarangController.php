<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class JenisBarangController extends Controller
{
    public function index() {

            $jenisbarang = DB::table('mst_jenis_barang')->select('mst_jenis_barang.*', 'name as created_by')->orderBy('mst_jenis_barang.id','DESC')
            ->join('users', 'users.id', 'mst_jenis_barang.created_by')
            ->get();
             // dd($jenisbarang);

            return view('backend.jenis_barang.index', compact('jenisbarang'));
    }

    public function create(){
        return view('backend.jenis_barang.create');
    }
    
    public function store(Request $request){



        DB::table('mst_jenis_barang')->insert([
            'nama_barang' => $request->nama_jenis_barang,
            'deskripsi' => $request->deskripsi,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        return redirect()->route('jenis_barang')->with('message', 'Jenis Barang Berhasil Disimpan' );
    }
    public function destroy($id){
        DB::table('mst_jenis_barang')->where('id', $id)->delete();

        return redirect()->route('jenis_barang')->with('message', 'Jenis Barang Berhasil Dihapus' );
    }
}
