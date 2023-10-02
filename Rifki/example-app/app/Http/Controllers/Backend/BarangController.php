<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BarangStoreRequest;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function index(){
        $barang = DB::table('mst_barang')->select('mst_barang.*','name as created_by','nama_jenis_barang')
        ->orderBy('mst_barang.id', 'DESC')
        ->join('mst_Jenis_barang','mst_jenis_barang.id','mst_barang.id_jenis_barang')
        ->join('users','users.id','mst_barang.created_by')
        ->paginate(5);

        return view('backend.barang.index', compact('barang'));
    }

    public function create()
    {
        // Ambil data jenis barang untuk ditampilkan dalam form
        $jenisBarang = DB::table('mst_jenis_barang')->select('id','nama_jenis_barang')->get();

        return view('backend.barang.create', compact('jenisBarang'));
    }

    public function store(BarangStoreRequest $request)
    {
        // SIMPAN FILE GAMBAR
        $imageName = time().'.'.$request->gambar_barang->extension();
        $request->gambar_barang->move(public_path('assets/image/'),$imageName);

        // QUERY INSERT DATA BARANG
        DB::table('mst_barang')->insert([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'satuan' => $request->satuan,
            'deskripsi' => $request->deskripsi,
            'gambar' => 'assets/image'.$imageName,
            'stok_barang' => $request->stok_barang,
            'id_jenis_barang' => $request->id_jenis_barang,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        // Validasi input
        // $request->validate([
        //     'kode_barang' => 'required|unique:mst_barang',
        //     'nama_barang' => 'required',
        //     'harga' => 'required',
        //     'satuan' => 'required',
        //     'deskripsi' => 'required',
        //     'gambar' => 'required',
        //     'stok_barang' => 'required',
        //     'id_jenis_barang' => 'required',
        // ]);

        // // Simpan data ke dalam database
        // DB::table('mst_barang')->insert([
        //     'kode_barang' => $request->kode_barang,
        //     'nama_barang' => $request->nama_barang,
        //     'harga' => $request->harga,
        //     'satuan' => $request->satuan,
        //     'deskripsi' => $request->deskripsi,
        //     'gambar' => $request->gambar,
        //     'stok_barang' => $request->stok_barang,
        //     'id_jenis_barang' => $request->id_jenis_barang,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

      
        return redirect()->route('barang.index')->with('message', 'Barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $editbarang = DB::table('mst_barang')->where('id', $id)->first();
        return view('backend.barang.edit', compact('editbarang'));
    }

    public function update(BarangStoreRequest $request, $id)
    {
        if ($request->password) {
            DB::table('mst_barang')->where('id', $id)->update([
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'harga' => $request->harga,
                'satuan' => $request->satuan,
                'deskripsi' => $request->deskripsi,
                'gambar' => $request->gambar,
                'stok_barang' => $request->stok_barang,
                'id_jenis_barang' => $request->id_jenis_barang,
                'updated_at' => now(),
            ]);
        } else {
            DB::table('mst_barang')->where('id', $id)->update([
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'harga' => $request->harga,
                'satuan' => $request->satuan,
                'deskripsi' => $request->deskripsi,
                'gambar' => $request->gambar,
                'stok_barang' => $request->stok_barang,
                'id_jenis_barang' => $request->id_jenis_barang, 
                'updated_at' => now(),
            ]);
        }
        return redirect()->route('barang.index')->with('message', 'Barang berhasil diupdate');
    }

    public function destroy($id)
    {
        DB::table('mst_barang')->where('id', $id)->delete();

        return redirect()->route('barang.index')->with('message', 'Barang berhasil dihapus');
    }
}
