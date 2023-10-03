<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BarangStoreRequest;
use App\Http\Requests\DataBarangRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DataBarangController extends Controller
{
    public function index()
    {
        // query ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
        $dataBarang = DB::table('mst_barang')->select('mst_barang.*', 'nama_barang as created_by')->orderBy('mst_barang.id', 'DESC')
            ->join('mst_jenis_barang', 'mst_jenis_barang.id', 'mst_barang.id_jenis_barang')
            ->join('users','users.id','mst_barang.created_by')
            ->paginate(5);

        // dd($dataBarang);

        return view('backend.barang.index', compact('dataBarang'));
    }

    public function create()
    {
        $jenisBarang = DB::table('mst_jenis_barang')->select('id', 'nama')->get();

        return view('backend.barang.create' , compact('jenisBarang'));
    }

    public function store(BarangStoreRequest $request)
    {
        // Tipe data $request adalah object

        // DD (die dump untuk memeriksa apakahvalue atau rcord didalam variabel $request yang diambil dari form inputan)
        // dd($request->all());

            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('assets/image/'), $imageName);

        DB::table('mst_barang')->insert([
            'id_jenis_barang' => $request->id_jenis_barang,
            'nama_barang' => $request->nama_barang,
            'kode_barang' => $request->kode_barang,
            'harga' => $request->harga,
            'satuan' => $request->satuan,
            'deskripsi' => $request->deskripsi,
            'gambar' => 'assets/image/'. $imageName,
            'stok_barang' => $request->stok_barang,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'Updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect()->route('data_barang')->with('message', 'Barang berhasil di Simpan!');
    }
    
    // public function edit($id)
    // {
    //     // apa tipe data dari $id? STRING
    //     // Menggunakan first karena kita mau mengambil data hanya 1 yang sesuai dengan ID

    //     $editDataBarang = DB::table('mst_barang')->where('id', $id)->first();

    //     session(['edit_barang' => $editDataBarang]);

    //     return view('backend.data_barang.edit', compact('editDataBarang'));

    //     // return redirect()->route('edit_jenis_barang')->with('message', 'Jenis Barang berhasil dihapus');
    // }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'nama_data_barang' => 'required',
    //         'deskripsi' => 'required',
    //     ]);
    //     DB::table('mst_jenis_barang')
    //         ->where('id', $id)->update([
    //             'nama' => $request->nama_jenis_barang,
    //             'deskripsi' => $request->deskripsi,
    //             'update_by' => 1,
    //             'update_at' => \Carbon\carbon::now(),
    //         ]);

    //     return redirect()->route('jenis_barang')->with('message', 'jenis barang berhasil di update');
    // }

    // public function destroy($id)
    // {
    //     DB::table('mst_jenis_barang')->where('id', $id)->delete();

    //     return redirect()->route('jenis_barang')->with('message', 'Jenis Barang berhasil dihapus');
    // }
}
