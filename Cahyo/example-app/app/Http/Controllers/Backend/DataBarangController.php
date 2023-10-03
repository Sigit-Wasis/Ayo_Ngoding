<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BarangStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DataBarangController extends Controller
{
    public function index()
    {

        $Barang = DB::table('mst_barang')->select('mst_barang.*','name as created_by', 'nama_jenis_barang')->orderBy('mst_barang.id', 'DESC')
        ->join('mst_jenis_barang', 'mst_jenis_barang.id', 'mst_barang.id_jenis_barang' )
        ->join('users', 'users.id', 'mst_barang.created_by')
        ->paginate(5);

        // dd($jenisBarang);

        return view('backend.barang.index', compact('Barang'));
    }
    public function create()
    {
        $jenisBarang=DB::table('mst_jenis_barang')->select('id', 'nama_jenis_barang')->get();

        return view('backend.barang.create', compact('jenisBarang'));
    }

    public function store(BarangStoreRequest $request)
    {
        //Tipe data $request adalah objek

        //DD (DieDump untuk memeriksa apakah ada value atau record di dalam variabel $request yang diambil dari input)
        //dd($request->all());

        // simpan file gambar
        $imageName = time().'.'.$request->gambar->extension();
        $request->gambar->move(public_path('assets/image/'),$imageName);

        // Query insert data barang
        DB::table('mst_barang')->insert([
            'id_jenis_barang' => $request->id_jenis_barang,
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'satuan' => $request->satuan,
            'deskripsi' => $request->deskripsi,
            'gambar' => 'assets/image'.$imageName,
            'stok_barang' => $request->stok_barang,
            'created_by' => Auth::user()->id, 
            'updated_by' => Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()

        ]);

        return redirect()->route('jenis_barang')->with('message', 'Jenis Barang Berhasil Disimpan');
    }

    // public function edit($id)
    // {
    //     $editJenisBarang = DB::table('mst_jenis_barang')->where('id', $id)->first();

    //     return view('backend.jenis_barang.edit', compact('editJenisBarang'));
    // }
    // public function update(BarangStoreRequest $request, $id)
    // {
    //     DB::table('mst_jenis_barang')
    //         ->where('id', $id)
    //         ->update([
    //             'nama_jenis_barang' => $request->nama_jenis_barang,
    //             'deskripsi_barang' => $request->deskripsi_barang,
    //             'updated_by' => 1,
    //             'updated_at' => \Carbon\Carbon::now(),
    //         ]);

    //     return redirect()->route('jenis_barang')->with('message', 'Jenis Barang Berhasil Diperbarui');
    // }


    // public function destroy($id)
    // {
    //     DB::table('mst_jenis_barang')->where('id', $id)->delete();

    //     return redirect()->route('jenis_barang')->with('message', 'Jenis Barang Berhasil Dihapus');
    // }
}
