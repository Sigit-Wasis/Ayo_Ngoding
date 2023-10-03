<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BarangStoreRequest;
use Illuminate\Support\Facades\Auth;

class DataBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Queri ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
        $barangs = DB::table('mst_barang')->select('mst_barang.*', 'name as created_by', 'mst_barang.nama_barang as nama_jenis_barang')
        ->orderBy('mst_barang.id', 'DESC')
        ->join('jenis_barang', 'jenis_barang.id', 'mst_barang.id_jenis_barang')
        ->join('users', 'users.id', 'mst_barang.created_by')    
        ->paginate(5);
    // dd($jenisbarang);

return view('backend.barang.index', compact('barangs'));
    }


    public function create()
    {
        // Query ini fungsinya untuk mengambil jenis barang yang nantinya akan di looping pada view create.blade.php
        $jenisbarang = DB::table('jenis_barang')->select('id', 'nama_barang')->get();

        return view('backend.barang.create', compact('jenisbarang'));
    }

    public function store(BarangStoreRequest $request)
     {
        // simpan file gambar
        $imageName = time().'.'.$request->gambar_barang->extension();
        $request->gambar_barang->move(public_path('assets/image/'), $imageName);


        // query insert data barang
        DB::table('mst_barang')->insert([
            'id_jenis_barang' => $request->id_jenis_barang,
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'satuan' => $request->satuan,
            'deskripsi' => $request->deskripsi,
            'gambar' => 'assets/image/'. $imageName,
            'stok_barang' => $request->stok_barang,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            'created_at' => \carbon\Carbon::now(),
            'updated_at' => \carbon\Carbon::now(),
            
        ]);

        return "OK";

     }     
}
    