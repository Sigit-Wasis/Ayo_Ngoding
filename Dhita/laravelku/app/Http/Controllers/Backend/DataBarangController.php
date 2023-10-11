<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BarangStoreRequest;
use App\Http\Requests\BarangUpdateRequest;
use App\Http\Requests\DataBarangRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DataBarangController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:barang-list|barang-create|barang-edit|barang-delete', ['only' => ['index','store']]);
         $this->middleware('permission:barang-create', ['only' => ['create','store']]);
         $this->middleware('permission:barang-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:barang-delete', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        // query ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
        $dataBarang = DB::table('mst_barang')->select('mst_barang.*', 'nama_lengkap as created_by','nama')
        ->orderBy('mst_barang.id', 'DESC')
            ->join('mst_jenis_barang', 'mst_jenis_barang.id', 'mst_barang.id_jenis_barang')
            ->join('users','users.id','mst_barang.created_by')
            ->paginate(5);

        // dd($dataBarang);

        return view('backend.barang.index', compact('dataBarang'));
    }

    public function create()
    {
        // query ini fungsinya untuk mengambil jenis barang yang nantinya akan di looping pada view create.blade.php
        $jenisBarang = DB::table('mst_jenis_barang')->select('id', 'nama')->get();
        $vendors = DB::table('vendor')->select('id','nama')->get();

        // generate kode barang
        $uniqid = uniqid();
        $rand_start = rand(1,5);
        $rand_8_char = substr($uniqid, $rand_start, 8);

        return view('backend.barang.create' , compact('jenisBarang', 'rand_8_char', 'vendors'));
    }

    public function store(BarangStoreRequest $request)
    {
        // Tipe data $request adalah object

        // DD (die dump untuk memeriksa apakahvalue atau rcord didalam variabel $request yang diambil dari form inputan)
        // dd($request->all());

            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('assets/image/'), $imageName);

        DB::table('mst_barang')->insert([
            'id_vendor' => $request->id_vendor,
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

    public function show($id)
    {
        // apa tipe data dari $id? STRING
        // Menggunakan first karena kita mau mengambil data hanya 1 yang sesuai dengan ID

        $detailBarang = DB::table('mst_barang')->select('mst_barang.*', 'nama_lengkap as created_by', 'vendor.nama as nama_perusahaan')
        ->where('mst_barang.id', $id)
        ->join('mst_jenis_barang', 'mst_jenis_barang.id', 'mst_barang.id_jenis_barang')
        ->join('vendor', 'vendor.id', 'mst_barang.id_vendor')
        ->join('users','users.id','mst_barang.created_by')
        ->first();

        return view('backend.barang.show', compact('detailBarang'));

        // return redirect()->route('edit_barang')->with('message', 'Barang berhasil diedit');
    }

    
    public function edit($id)
    {
        // apa tipe data dari $id? STRING
        // Menggunakan first karena kita mau mengambil data hanya 1 yang sesuai dengan ID

        $editBarang = DB::table('mst_barang')->where('id', $id)->first();
        $jenisBarang = DB::table('mst_jenis_barang')->select('id', 'nama')->get();
        $vendors = DB::table('vendor')->select('id','nama')->get();

        return view('backend.barang.edit', compact('editBarang','jenisBarang', 'vendors'));

        // return redirect()->route('edit_barang')->with('message', 'Barang berhasil diedit');
    }


    public function update(BarangUpdateRequest $request, $id)
    {
        if ($request->gambar_barang) {
            // Simpan File Gambar di dalam folder public/assets/image
            $imageName = time().'.'.$request->gambar_barang->extension();
            $request->gambar_barang->move(public_path('assets/image/'), $imageName);

            $file = DB::table('mst_barang')->select('gambar')->where('id', $id)->first();

            if (file_exists(public_path($file->gambar))) {
                unlink(public_path($file->gambar));
            }

            // Query insert Data Barang
            DB::table('mst_barang')->where('id', $id)->update([
                'id_vendor' => $request->id_vendor,
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
                'id_vendor' => $request->id_vendor,
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

        return redirect()->route('data_barang')->with('messages', 'Data Barang Berhasil Diupdate');
    }

    public function destroy($id)
    {
        DB::table('mst_barang')->where('id', $id)->delete();

        return redirect()->route('data_barang')->with('message', 'Jenis Barang berhasil dihapus');
    }
}
