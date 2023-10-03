<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BarangRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Barang = FacadesDB::table('barang')->select('barang.*','name as created_by','nama_jenis_barang')->orderBy('barang.id', 'DESC')
        ->join('jenis_barang', 'jenis_barang.id', 'barang.id_jenis_barang')
        ->join('users','users.id','jenis_barang.created_by')
        ->paginate(5);

        //  dd($Barang);

        return view ('backend.barang.index', compact('Barang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisBarang = FacadesDB::table('jenis_barang')->get();
        return view ('backend.barang.create', compact('jenisBarang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BarangRequest $request)
    {
        $imageName = time().'.'.$request->gambar->extension();
        $request->gambar->move(public_path('asset/image/'),$imageName);
        
        FacadesDB::table('barang')->insert([
            'id_jenis_barang' =>$request->id_jenis_barang,
            'kode_barang' =>$request->kode_barang,
            'nama_barang' =>$request->nama_barang,
            'harga' =>$request->harga,
            'satuan' =>$request->satuan,
            'deskripsi' =>$request->deskripsi,
            'gambar' =>'asset/image/'.$imageName,
            'stok' =>$request->stok,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        return redirect()->route('barang')->with('message','Barang Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jenisBarang = FacadesDB::table('jenis_barang')->get();
        return view ('backend.barang.create', compact('jenisBarang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BarangRequest $request, $id)
    {
        FacadesDB::table('barang')->where ('id',$id)->update([
            'id_jenis_barang' =>$request->id_jenis_barang,
            'kode_barang' =>$request->kode_barang,
            'nama_barang' =>$request->nama_barang,
            'harga' =>$request->harga,
            'satuan' =>$request->satuan,
            'deskripsi' =>$request->deskripsi,
            'gambar' =>$request->gambar,
            'stok' =>$request->stok,
            'updated_by' => 1,
            'updated_at' => \Carbon\Carbon::now(),


        ]);

        return redirect()->route('barang')->with('message','Jenis Barang Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            FacadesDB::table('barang')->where('id', $id)->delete();
    
            return redirect()->route('barang')->with('message','Jenis Barang Berhasil Dihapus');
    }
}