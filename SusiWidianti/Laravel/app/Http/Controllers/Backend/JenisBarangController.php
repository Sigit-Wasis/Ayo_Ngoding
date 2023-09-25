<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class JenisBarangController extends Controller
{
    public function index() {
        //query ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
        $jenisBarang = DB::table('jenis_barang')->select('jenis_barang.*','username as craeted_by')->orderBy('jenis_barang.id','DESC')
        ->join('users', 'users.id', 'jenis_barang.craeted_by')
        ->get();

        // dd($jenisBarang);

        return view ('backend.jenis_barang.index', compact('jenisBarang'));
    }

    public function create() {
         return view ('backend.jenis_barang.create');
    }

    public function store(Request $request){

        // dd($request->all());
        DB::table('jenis_barang')->insert([
            'nama_jenis_barang' => $request->nama_jenis_barang,
            'deskripsi_barang' =>$request->deskripsi_barang,
            'craeted_by' => 1,
            'updated_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        return redirect()->route('jenis_barang')->with('message', 'Jenis Barang Berhasil disimpan');
    }
        public function destroy($id){
            DB::table('jenis_barang')->where('id',$id)->delete();

            return redirect()->route('jenis_barang')->with('message', 'Jenis Barang Berhasil dihapus');
        }
}
