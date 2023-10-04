<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BarangStoreRequest;
use App\Http\Requests\BarangUpdateRequest;
use Database\Seeders\jenis_barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DataBarangController extends Controller
{
    public function index()
    {
        $DataBarang = DB::table('barang')->select('barang.*', 'name as created_by', 'nama_jenis_barang')->orderBy('barang.id', 'DESC')
            ->join('users', 'users.id', 'barang.created_by')
            ->join('jenis_barang', 'jenis_barang.id', 'barang.id_jenis_barang')
            ->paginate(3);

            // dd($DataBarang);

        return view('backend.barang.index', compact('DataBarang'));
    }
    public function create()
    {
        //Query ini fungsinnya untuk mengambil jenis barang yang nantinnya akan di looping pada view create.blade.php
        $jenisBarang = DB::table('jenis_barang')->get();

        //Generate kode barang
        $uniqid = uniqid();
        $rand_start = rand(1,5);
        $rand_8_char = substr($uniqid,$rand_start,8);

        return view('backend.barang.create', compact('jenisBarang','rand_8_char'));
    }

    public function edit($id){
        
        $editBarang = DB::table('barang')->where('id',$id)->first();
        $jenisBarang = DB::table('jenis_barang')->get();

        //Generate kode barang
        $uniqid = uniqid();
        $rand_start = rand(1,5);
        $rand_8_char = substr($uniqid,$rand_start,8);

        return view('backend.barang.editt',compact('editBarang', 'jenisBarang','rand_8_char'));
    }

    public function update(BarangUpdateRequest $request, $id)
    {
        if ($request->gambar) {
            // Simpan File Gambar di dalam folder public/assets/image
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('assets/image/'), $imageName);

            $file = DB::table('barang')->select('gambar')->where('id', $id)->first();

            if (file_exists(public_path($file->gambar))) {
                unlink(public_path($file->gambar));
            }

            // Query insert Data Barang
            DB::table('barang')->where('id', $id)->update([
                'id_jenis_barang' => $request->id_jenis_barang,
                'nama_barang' => $request->nama_barang,
                'kode_barang' => $request->kode_barang,
                'stok' => $request->stok,
                'harga' => $request->harga,
                'satuan' => $request->satuan,
                'deskripsi' => $request->deskripsi,
                'gambar' => 'assets/image/'. $imageName,
                'updated_by' => Auth::user()->id,
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        } else {
            // Query insert Data Barang
            DB::table('barang')->where('id', $id)->update([
                'id_jenis_barang' => $request->id_jenis_barang,
                'nama_barang' => $request->nama_barang,
                'kode_barang' => $request->kode_barang,
                'stok' => $request->stok,
                'harga' => $request->harga,
                'satuan' => $request->satuan,
                'deskripsi' => $request->deskripsi,
                'updated_by' => Auth::user()->id,
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

        return redirect()->route('DataBarang')->with('messages', 'Data Barang Berhasil Diupdate');
    }

    public function store(BarangStoreRequest $request)

    {
        // dd($request->all());
        // simpan file gambar
        $imageName = time() . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('assets/image/'), $imageName);

        //query insert data barang

        DB::table('barang')->insert([
            'id_jenis_barang' => $request->id_jenis_barang,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'kode_barang' => $request->kode_barang,
            'satuan' => $request->satuan,
            'deskripsi' => $request->deskripsi,
            'gambar' =>'assets/image/' .$imageName,
            'stok' => $request->stok,
            'created_by' => Auth::user()->id,
            'updated_by' =>Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
    

        ]);

        return redirect()->route('DataBarang')->with('message', 'Barang Berhasil Disimpan!');
        
        
    }
    public function show($id)
    {
    $detailBarang = DB::table('barang')->select('barang.*', 'name as created_by', 'nama_jenis_barang')
    ->where('barang.id', $id)//tambahin where dimana id barang itu sesuai dengan yang dipilih
    ->join('users', 'users.id', 'barang.created_by')
    ->join('jenis_barang', 'jenis_barang.id', 'barang.id_jenis_barang')
    ->first();

    
    
    return view('backend.barang.show', compact('detailBarang'));

}
public function destroy($id)
    {
        if ($id) {
            $file = DB::table('barang')->select('gambar')->where('id', $id)->first();

            if ($file->gambar != "") {
                if (file_exists(public_path($file->gambar))) {
                    unlink(public_path($file->gambar));
                }
            }

            DB::table('barang')->where('id', $id)->delete();
    
            return redirect()->route('DataBarang')->with('messages', 'Sukses');
        }
    }
}