<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\JenisBarangRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JenisBarangController extends Controller
{
    public function index() {
//query ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
        $jenisBarang = DB::table('jenis_barang')->select('jenis_barang.*', 'name as created_by')->orderBy('jenis_barang.id','DESC')
 ->join('users','users.id','jenis_barang.created_by')
 ->paginate(3);

        return view('backend.jenis_barang.index',compact('jenisBarang'));
    }

    public function create () {
        return view ('backend.jenis_barang.create');
        //TIPE DATA $Request adalah object
        //DD (die dump untuk memeriksa apakah ada value atau record didalam variabel $request yang diambil dari from inputan )
        // dd($request->all());
    }
    public function store(JenisBarangRequest $request) {
        DB::table('jenis_barang')->insert([
            'nama_jenis_barang' => $request->nama_jenis_barang,
            // 'deskripsi' =>$request->deskripsi,
            'deskripsi' => $request->deskripsi,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            
        ]);

        return redirect()->route('jenis_barang')->with('message','Jenis Barang Berhasil Disimpan!');
    }

    public function edit($id){
        //apa tipe data dari $id ?
        //menggunakan first karena kita mau ngambil datamhanya 1 yang sesuai dengan ID
        $editJenisBarang = DB::table('jenis_barang')->where('id',$id)->first();

        return view('backend.jenis_barang.edit',compact('editJenisBarang'));
    }

    public function update(JenisBarangRequest $request, $id) {
        DB::table('jenis_barang')->where('id', $id)->update([
            'nama_jenis_barang' => $request->nama_jenis_barang,
            // 'deskripsi' =>$request->deskripsi,
            'deskripsi' => $request->deskripsi,
            'updated_by' => 1,
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect()->route('jenis_barang')->with('message','Jenis Barang Berhasil Disimpan!');
    }

    public function destroy($id) {
        DB::table('jenis_barang')->where('id',$id)->delete();
     

     return redirect()->route('jenis_barang')->with('message','Jenis Barang Berhasil Dihapus!');

    }
}
