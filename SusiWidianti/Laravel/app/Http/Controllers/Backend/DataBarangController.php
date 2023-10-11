<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBarangRequest;
use App\Http\Requests\DataBarangRequest;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

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
        //query ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
        $DataBarang = DB::table('mts_barang')->select('mts_barang.*', 'username as created_by', 'nama_jenis_barang')
            ->orderBy('mts_barang.id', 'DESC')
            ->join('jenis_barang', 'jenis_barang.id', 'mts_barang.id_jenis_barang')
            ->join('users', 'users.id', 'mts_barang.created_by')
            ->paginate(5);

        // dd($jenisBarang);

        return view('backend.barang.index', compact('DataBarang'));
    }

    public function create()
    {
        $jenis_barang = DB::table('jenis_barang')->select('id', 'nama_jenis_barang')->get();
        $vendors = DB::table('vendors')->select('id', 'nama')->get();

        //Generat Kode Barang
        $uniqid = uniqid();
        $rand_star = rand(1, 5);
        $rand_8_char = substr($uniqid, $rand_star, 8);

        return view('backend.barang.create', compact('jenis_barang', 'rand_8_char', 'vendors'));
    }


    public function store(DataBarangRequest $request)
    {


        //DD (die dump untuk memeriksa apakah ada value atau record di dalam variabel $request yang di ambik dari form input)
        //  dd($request->all());

        // Simpan file Gambar
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('assets/image/'), $imageName);

        //Query insert data Barang
        DB::table('mts_barang')->insert([
            'id_jenis_barang' => $request->id_jenis_barang,
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'satuan' => $request->satuan,
            'deskripsi' => $request->deskripsi,
            'gambar' => 'assets/image/' . $imageName,
            'id_vendors' => $request->id_vendors,
            'stok' => $request->stok,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        return redirect()->route('data_barang')->with('message', ' Barang Berhasil disimpan');
    }



    public function show($id)
    {
        $detailBarang = DB::table('mts_barang')->select('mts_barang.*', 'username as created_by', 'nama_jenis_barang', 'vendors.nama as nama_perusahaan')
            ->where('mts_barang.id', $id) //tambahin where dimana id barang itu sesuai dengan yang dipilih
            ->join('jenis_barang', 'jenis_barang.id', 'mts_barang.id_jenis_barang')
            ->join('vendors', 'vendors.id', 'mts_barang.id_vendors')
            ->join('users', 'users.id', 'mts_barang.created_by')
            ->first(); //dari paginate ganti jadi firsh()

        return view('backend.barang.show', compact('detailBarang'));
    }
    public function edit($id)
    {
        $editbarang = DB::table('mts_barang')->where('id', $id)->first();
        $jenisBarang = DB::table('jenis_barang')->select('id', 'nama_jenis_barang')->get();
        $vendors = DB::table('vendors')->select('id', 'nama')->get();

        return view('backend.barang.edit', compact('editbarang','jenisBarang', 'vendors'));
    }




    public function update(UpdateBarangRequest $request, $id)
    {
        if ($request->gambar_barang) {
            // Simpan File Gambar di dalam folder public/assets/image
            $imageName = time() . '.' . $request->gambar_barang->extension();
            $request->gambar_barang->move(public_path('assets/image/'), $imageName);

            $file = DB::table('mts_barang')->select('gambar')->where('id', $id)->first();

            if (file_exists(public_path($file->gambar))) {
                unlink(public_path($file->gambar));
            }

            // Query insert Data Barang
            DB::table('mts_barang')->where('id', $id)->update([
                'id_jenis_barang' => $request->id_jenis_barang,
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'harga' => $request->harga,
                'satuan' => $request->satuan,
                'deskripsi' => $request->deskripsi,
                'gambar' => 'assets/image/' . $imageName,
                'id_vendors' => $request->id_vendors,
                'stok' => $request->stok,
                'updated_by' => Auth::user()->id,
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        } else {
            // Query insert Data Barang
            DB::table('mts_barang')->where('id', $id)->update([
                'id_jenis_barang' => $request->id_jenis_barang,
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'harga' => $request->harga,
                'satuan' => $request->satuan,
                'deskripsi' => $request->deskripsi,
                'stok' => $request->stok,
                'id_vendors' => $request->id_vendors,
                'updated_by' => Auth::user()->id,
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

        return redirect()->route('data_barang')->with('messages', 'Data Barang Berhasil Diupdate');
    }

    public function destroy($id)
    {
        DB::table('mts_barang')->where('id', $id)->delete();

        return redirect()->route('data_barang')->with('message', 'Barang Berhasil dihapus');
    }
}
