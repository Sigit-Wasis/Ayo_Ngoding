<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BarangStoreRequest;
use App\Http\Requests\BarangUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DataBarangController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:barang-list|barang-create|barang-edit|barang-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:barang-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:barang-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:barang-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {

        $Barang = DB::table('mst_barang')
            ->select('mst_barang.*', 'name as created_by', 'nama_jenis_barang')
            ->orderBy('mst_barang.id', 'DESC')
            ->where('mst_jenis_barang.id', 'LIKE', "%{$request->jenis_barang}%")
            ->where('nama_barang', 'LIKE', "%{$request->nama_barang}%")
            ->where('kode_barang', 'LIKE', "%{$request->kode_barang}%")
            ->join('mst_jenis_barang', 'mst_jenis_barang.id', 'mst_barang.id_jenis_barang')
            ->join('users', 'users.id', 'mst_barang.created_by')
            ->paginate(5);

        $jenisBarang = DB::table('mst_jenis_barang')->select('id', 'nama_jenis_barang')->get();

        // dd($jenisBarang);

        return view('backend.barang.index', compact('Barang', 'jenisBarang'));
    }
    public function create()
    {
        // Query ini fungsinya untuk mengambiljenis barang yang nantinya akan di looping pada view create.blade.php
        $createBarang = DB::table('mst_jenis_barang')->select('id', 'nama_jenis_barang')->get();
        $vendors = DB::table('vendors')->select('id', 'nama')->get();

        // Generate kode barang
        $uniqid = uniqid();
        $rand_star = rand(1, 5);
        $rand_8_char = substr($uniqid, $rand_star, 8);

        return view('backend.barang.create', compact('createBarang', 'rand_8_char', 'vendors'));
    }

    public function store(BarangStoreRequest $request)
    {
        //Tipe data $request adalah objek

        //DD (DieDump untuk memeriksa apakah ada value atau record di dalam variabel $request yang diambil dari input)
        //dd($request->all());

        // simpan file gambar di dalam folder public/assets/image
        $imageName = time() . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('assets/image/'), $imageName);

        // Query insert data barang
        DB::table('mst_barang')->insert([
            'id_jenis_barang' => $request->id_jenis_barang,
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'satuan' => $request->satuan,
            'deskripsi' => $request->deskripsi,
            'gambar' => 'assets/image/' . $imageName,
            'id_vendor' => $request->id_vendor,
            'stok_barang' => $request->stok_barang,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()

        ]);

        return redirect()->route('barang')->with('message', 'Jenis Barang Berhasil Disimpan');
    }
    public function show($id)
    {
        $detailBarang = DB::table('mst_barang')
            ->select('mst_barang.*', 'name as created_by', 'nama_jenis_barang', 'vendors.nama as nama_perusahaan')
            ->where('mst_barang.id', $id) //Tambahin where dimana id barang itu sesuai barang yang dipilih
            ->join('mst_jenis_barang', 'mst_jenis_barang.id', 'mst_barang.id_jenis_barang')
            ->join('vendors', 'vendors.id', 'mst_barang.id_vendor')
            ->join('users', 'users.id', 'mst_barang.created_by')
            ->first();

        return view('backend.barang.show', compact('detailBarang'));
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

            return redirect()->route('barang')->with('message', 'Sukses');
        }
    }


    public function edit($id)
    {
        $editBarang = DB::table('mst_barang')->select('*')->where('id', $id)->first();
        $jenisBarang = DB::table('mst_jenis_barang')->select('id', 'nama_jenis_barang')->get();
        $vendors = DB::table('vendors')->select('id', 'nama')->get();

        return view('backend.barang.edit', compact('editBarang', 'jenisBarang', 'vendors'));
    }
    public function update(BarangUpdateRequest $request, $id)
    {
        if ($request->gambar) {
            // Simpan File Gambar di dalam folder public/assets/image
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('assets/image/'), $imageName);

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
                'id_vendor' => $request->id_vendor,
                'gambar' => 'assets/image/' . $imageName,
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
                'id_vendor' => $request->id_vendor,
                'updated_by' => Auth::user()->id,
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

        return redirect()->route('barang')->with('message', 'Data Barang Berhasil Diupdate');
    }


    // public function destroy($id)
    // {
    //     DB::table('mst_jenis_barang')->where('id', $id)->delete();

    //     return redirect()->route('jenis_barang')->with('message', 'Jenis Barang Berhasil Dihapus');
    // }
}
