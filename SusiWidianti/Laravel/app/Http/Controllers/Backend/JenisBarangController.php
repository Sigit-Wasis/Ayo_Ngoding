<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\JenisBarangRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JenisBarangController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:jenis-barang-list|jenis-barang-create|jenis-barang-edit|jenis-barang-delete', ['only' => ['index','store']]);
         $this->middleware('permission:jenis-barang-create', ['only' => ['create','store']]);
         $this->middleware('permission:jenis-barang-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:jenis-barang-delete', ['only' => ['destroy']]);
    }

    public function index() {
        //query ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
        $jenisBarang = DB::table('jenis_barang')->select('jenis_barang.*','username as created_by')->orderBy('jenis_barang.id','DESC')
        ->join('users', 'users.id', 'jenis_barang.created_by')
        ->paginate(5);

        // dd($jenisBarang);

        return view ('backend.jenis_barang.index', compact('jenisBarang'));
    }

    public function create() {
         return view ('backend.jenis_barang.create');
    }

    public function store(JenisBarangRequest $request){
        // Tipe Data $request adalah object



        // DD (die dump untuk memeriksa apakah ada value atau record di dalam variabel $request yang di ambik dari form input)
        // dd($request->all());


        DB::table('jenis_barang')->insert([
            'nama_jenis_barang' => $request->nama_jenis_barang,
            'deskripsi_barang' =>$request->deskripsi_barang,
            'created_by' =>Auth::user()->id,
            'updated_by' =>Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        return redirect()->route('jenis_barang')->with('message', 'Jenis Barang Berhasil disimpan');
    }

    public function edit($id){
            //apa tipe data dari $id ?
           //menggunakan first karena kita mau mengambel hanya satu data yang sesuai dengan id
            $editJenisBarang = DB::table('jenis_barang')->where('id',$id)->first();
     
        return view('backend.jenis_barang.edit', compact ('editJenisBarang'));
}

public function update(JenisBarangRequest $request, $id){

    DB::table('jenis_barang')->where('id', $id)->update([
        'nama_jenis_barang' => $request->nama_jenis_barang,
        'deskripsi_barang' =>$request->deskripsi_barang,
        'updated_by' => 1,
        'updated_at' => \Carbon\Carbon::now(),

    ]);

    return redirect()->route('jenis_barang')->with('message', 'Jenis Barang Berhasil disimpan');


}

    public function destroy($id){
            DB::table('jenis_barang')->where('id',$id)->delete();

            return redirect()->route('jenis_barang')->with('message', 'Jenis Barang Berhasil dihapus');
        } 
}
