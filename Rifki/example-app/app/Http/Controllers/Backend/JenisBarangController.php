<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\JenisBarangRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JenisBarangController extends Controller
{
    public function index() {
        $jenisbarang = DB::table('mst_jenis_barang')
            ->select('mst_jenis_barang.*', 'name as created_by')
            ->orderBy('mst_jenis_barang.id', 'DESC')
            ->join('users', 'users.id', 'mst_jenis_barang.created_by')
            ->paginate(3);

        return view('backend.jenis_barang.index', compact('jenisbarang'));
    }

    public function create(){
        return view('backend.jenis_barang.create');
    }
    
    public function store(JenisBarangRequest $request){
        DB::table('mst_jenis_barang')->insert([
            'nama_barang' => $request->nama_jenis_barang,
            'deskripsi' => $request->deskripsi,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('jenis_barang')->with('message', 'Jenis Barang Berhasil Disimpan' );
    }

    public function edit($id){
        $editJenisBarang = DB::table('mst_jenis_barang')->where('id', $id)->first();
        return view('backend.jenis_barang.edit', compact('editJenisBarang'));
    }

    public function update(JenisBarangRequest $request, $id){
        DB::table('mst_jenis_barang')->where('id', $id)->update([
            'nama_barang' => $request->nama_jenis_barang,
            'deskripsi' => $request->deskripsi,
            'updated_by' => 1,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('jenis_barang')->with('message', 'Jenis Barang Berhasil Update' );
    }

    public function destroy($id){
        DB::table('mst_jenis_barang')->where('id', $id)->delete();

        return redirect()->route('jenis_barang')->with('message', 'Jenis Barang Berhasil Dihapus' );
        
    }

    public function show()
{

}

}
