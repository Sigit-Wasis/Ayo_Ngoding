<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class JenisBarangController extends Controller
{
    public function index() {
        // query ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
        $jenisBarang = DB::table('_m_s_t__jenis__barang')->select('_m_s_t__jenis__barang.*','name as created_by')->orderBy('_m_s_t__jenis__barang.id', 'DESC')
        ->join('users','users.id','_m_s_t__jenis__barang.created_by')
        ->get();
        //dd($jenisBarang);

        return view ('backend.jenis_barang.index', compact('jenisBarang'));

    }

    public function create(){
        return view('backend.jenis_barang.create');
    }

     public function store(Request $request){
        DB::table('_m_s_t__jenis__barang')->insert([
            'nama'=>$request->nama_jenis_barang,
            'deskripsi'=>$request->deskripsi,
            'created_by'=>1,
            'updated_by'=>1,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
        ]);
        return redirect()->route('jenis-barang')->with('message','Jenis BArang Berhasil Disimpan!');
    }

    public function destroy($id){
        DB::table('_m_s_t__jenis__barang')->where('id',$id)->delete();
        return redirect()->route('jenis-barang')->with('message','Jenis Barang Berhasil Dihapus!');
    }
}
