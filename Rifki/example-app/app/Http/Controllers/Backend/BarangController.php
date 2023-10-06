<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BarangStoreRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use function Laravel\Prompts\select;

class BarangController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:barang-list|barang-create|barang-edit|barang-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:barang-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:barang-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:barang-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $barangs = DB::table('mst_barang')
            ->select('mst_barang.*', 'name as created_by', 'mst_jenis_barang.nama_barang')
            ->orderBy('mst_barang.id', 'DESC')
            ->join('mst_jenis_barang', 'mst_jenis_barang.id', 'mst_barang.id_jenis_barang')
            ->join('users', 'users.id', 'mst_barang.created_by')
            ->paginate(5);

        return view('backend.barang.index', compact('barangs'));
    }

    public function create()
    {
        $jenisBarang = DB::table('mst_jenis_barang')->select('id', 'nama_barang')->get();

        $uniqid = uniqid();
        $rand_start = rand(1, 5);
        $rand_8_char = substr($uniqid, $rand_start, 8);

        return view('backend.barang.create', compact('jenisBarang', 'rand_8_char'));
    }

    public function store(BarangStoreRequest $request)
    {
        // SIMPAN FILE GAMBAR
        $imageName = time() . '.' . $request->gambar_barang->extension();
        $request->gambar_barang->move(public_path('assets/image/'), $imageName);

        // QUERY INSERT DATA BARANG
        DB::table('mst_barang')->insert([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga_barang,
            'satuan' => $request->satuan_barang,
            'deskripsi' => $request->deskripsi_barang,
            'gambar' => 'assets/image/' . $imageName,
            'stok_barang' => $request->stok_barang,
            'id_jenis_barang' => $request->id_jenis_barang,
            'created_by' => Auth::user()->id,
            'upadated_by' => Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        return redirect()->route('barang.index')->with('message', 'Barang Berhasil Disimpan');
    }

    public function show($id)
    {
        $detailbarang = DB::table('mst_barang')
            ->select('mst_barang.*', 'name as created_by', 'mst_jenis_barang.nama_barang')
            ->where('mst_barang.id', $id)
            ->join('mst_jenis_barang', 'mst_jenis_barang.id', 'mst_barang.id_jenis_barang')
            ->join('users', 'users.id', 'mst_barang.created_by')
            ->first();

        return view('backend.barang.show', compact('detailbarang'));
    }
    public function delete($id)
    {

        DB::table('mst_barang')->where('id', $id)->delete();


        return redirect()->route('barang.index')->with('message', 'Barang berhasil dihapus');
    }


    public function edit($id)
    {

        $barang = DB::table('mst_barang')->find($id);


        if (!$barang) {
            return redirect()->route('barang.index')->with('error', 'Barang tidak ditemukan');
        }

        $jenisBarang = DB::table('mst_jenis_barang')->select('id', 'nama_barang')->get();

        return view('backend.barang.edit', compact('barang', 'jenisBarang'));
    }
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'id_jenis_barang' => 'required',
            'kode_barang' => 'required|unique:mst_barang,kode_barang,' . $id,
            'nama_barang' => 'required',
            'harga_barang' => 'required|numeric',
            'satuan_barang' => 'required',
            'deskripsi_barang' => 'required',
            'gambar_barang' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'stok_barang' => 'required|numeric',
        ]);
    
        $barang = DB::table('mst_barang')->where('id', $id)->first();
    
        if ($request->hasFile('gambar_barang')) {
            $imageName = time() . '.' . $request->gambar_barang->extension();
            $request->gambar_barang->move(public_path('assets/image/'), $imageName);
            
            if (file_exists(public_path($barang->gambar))) {
                unlink(public_path($barang->gambar));
            }
            
            $gambarPath = 'assets/image/' . $imageName;
        } else {
            $gambarPath = $barang->gambar;
        }
    
        DB::table('mst_barang')->where('id', $id)->update([
            'id_jenis_barang' => $request->id_jenis_barang,
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga_barang,
            'satuan' => $request->satuan_barang,
            'deskripsi' => $request->deskripsi_barang,
            'gambar' => $gambarPath,
            'stok_barang' => $request->stok_barang,
            'updated_at' => now(),
        ]);
    
        return redirect()->route('barang.index')->with('message', 'Barang berhasil diperbarui');
    }

    

}
