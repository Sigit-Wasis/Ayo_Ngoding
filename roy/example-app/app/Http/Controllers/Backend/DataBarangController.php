<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BarangStoreRequest;
use App\Http\Requests\BarangUpdateRequest;
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

        // Generate Kode Barang
        $uniqid = uniqid();
        $rand_start = rand(1,5);
        $rand_8_char = substr($uniqid, $rand_start, 8);

        return view('backend.barang.create', compact('jenisbarang', 'rand_8_char'));
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

        return redirect()->route('barang')->with('messages', 'Data Barang Berhasil Disimpan');

     } 
     public function show($id)
     {
        $detailbarang = DB::table('mst_barang')->select('mst_barang.*', 'name as created_by', 'mst_barang.nama_barang as nama_jenis_barang')
        ->where('mst_barang.id', $id) // tambahin where dimana id barang itu sesuai dengan yang dipilih
        ->join('jenis_barang', 'jenis_barang.id', 'mst_barang.id_jenis_barang')
        ->join('users', 'users.id', 'mst_barang.created_by')    
        ->first(); // dari paginate ganti jadi first()

        return view('backend.barang.show', compact('detailbarang'));
     }  
     
     public function destroy($id)
    {
        if ($id) {
            $file = DB::table('mst_barang')->select('gambar')->where('id', $id)->first();

            if ($file->gambar != "") {
                if (file_exists(public_path($file->gambar))) {
                    unlink(public_path($file->gambar));
                }
            }

            DB::table('mst_barang')->where('id', $id)->delete();
    
            return redirect()->route('barang')->with('messages', 'Sukses');
        }
    }


public function edit($id)
    {
        $editBarang = DB::table('mst_barang')->select('*')->where('id', $id)->first();
        $jenisBarang = DB::table('jenis_barang')->select('id', 'nama_barang')->get(); 

        return view('backend.barang.edit', compact('editBarang', 'jenisBarang'));
    }

public function update(BarangUpdateRequest $request, $id)
    {
        if ($request->gambar) {
            // Simpan File Gambar di dalam folder public/assets/image
            $imageName = time().'.'.$request->gambar_barang->extension();
            $request->gambar_barang->move(public_path('assets/image/'), $imageName);

            $file = DB::table('mst_barang')->select('gambar')->where('id', $id)->first();

            if (file_exists(public_path($file->gambar))) {
                unlink(public_path($file->gambar));
            }

            // Query insert Data Barang
            DB::table('mst_barang')->where('id', $id)->update([
                'id_jenis_barang' => $request->id_jenis_barang,
                'nama_barang' => $request->nama_barang,
                'kode_barang' => $request->kode_barang,
                'stok_barang' => $request->stok_barang,
                'harga' => $request->harga,
                'satuan' => $request->satuan,
                'deskripsi' => $request->deskripsi,
                'gambar' => 'assets/image/'. $imageName,
                'updated_by' => Auth::user()->id,
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        } else {
            // Query insert Data Barang
            DB::table('mst_barang')->where('id', $id)->update([
                'id_jenis_barang' => $request->id_jenis_barang,
                'nama_barang' => $request->nama_barang,
                'kode_barang' => $request->kode_barang,
                'stok_barang' => $request->stok_barang,
                'harga' => $request->harga,
                'satuan' => $request->satuan,
                'deskripsi' => $request->deskripsi,
                'updated_by' => Auth::user()->id,
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

        return redirect()->route('barang')->with('messages', 'Data Barang Berhasil Diupdate');
    }
    
}
    