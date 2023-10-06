<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\JenisBarangRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JenisBarangController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:jenis-barang-list|jenis-barang-create|jenis-barang-edit|jenis-barang-delete', ['only' => ['index','store']]);
         $this->middleware('permission:jenis-barang-create', ['only' => ['create','store']]);
         $this->middleware('permission:jenis-barang-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:jenis-barang-delete', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        // query ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
        $jenisBarang = DB::table('mst_jenis_barang')->select('mst_jenis_barang.*', 'nama_lengkap as created_by')->orderBy('mst_jenis_barang.id', 'DESC')
            ->join('users', 'users.id', 'mst_jenis_barang.created_by')
            ->paginate(5);

        // dd($jenisBarang);

        return view('backend.jenis_barang.index', compact('jenisBarang'));
    }

    public function create()
    {
        return view('backend.jenis_barang.create');
    }

    public function store(JenisBarangRequest $request)
    {
        // Tipe data $request adalah object

        // DD (die dump untuk memeriksa apakahvalue atau rcord didalam variabel $request yang diambil dari form inputan)
        // dd($request->all());

        DB::table('mst_barang')->insert([   
            'nama_barang' => $request->nama_barang,
            'kode_barang' => $request->kodebarang,
            'harga' => $request->kode,
            'satuan' => $request->satuan,
            'deskripsi' => $request->deskripsi,
            'gambar' => $request->gambar,
            'stok_barang' => $request->stok_barang,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'Updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect()->route('_barang')->with('message', 'Jenis Barang berhasil di Simpan!');
    }

    
    public function edit($id)
    {
        // apa tipe data dari $id? STRING
        // Menggunakan first karena kita mau mengambil data hanya 1 yang sesuai dengan ID

        $editJenisBarang = DB::table('mst_jenis_barang')->where('id', $id)->first();

        session(['edit_jenis_barang' => $editJenisBarang]);

        return view('backend.jenis_barang.edit', compact('editJenisBarang'));

        // return redirect()->route('edit_jenis_barang')->with('message', 'Jenis Barang berhasil dihapus');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jenis_barang' => 'required',
            'deskripsi' => 'required',
        ]);
        DB::table('mst_jenis_barang')
            ->where('id', $id)->update([
                'nama' => $request->nama_jenis_barang,
                'deskripsi' => $request->deskripsi,
                'updated_by' => 1,
                'updated_at' => \Carbon\carbon::now(),
            ]);

        return redirect()->route('jenis_barang')->with('message', 'jenis barang berhasil di update');
    }

    public function destroy($id)
    {
        DB::table('mst_jenis_barang')->where('id', $id)->delete();

        return redirect()->route('jenis_barang')->with('message', 'Jenis Barang berhasil dihapus');
    }
}
