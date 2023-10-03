<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\JenisBarangRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisBarangController extends Controller
{
    public function index()
    {

        $jenisBarang = DB::table('mst_jenis_barang')->select('mst_jenis_barang.*', 'name as created_by')->orderBy('mst_jenis_barang.id', 'DESC')
            ->join('users', 'users.id', 'mst_jenis_barang.created_by')
            ->paginate(10);

        // dd($jenisBarang);

        return view('backend.jenis_barang.index', compact('jenisBarang'));
    }
    public function create()
    {
        return view('backend.jenis_barang.create');
    }

    public function store(JenisBarangRequest $request)
    {
        //Tipe data $request adalah objek

        //DD (DieDump untuk memeriksa apakah ada value atau record di dalam variabel $request yang diambil dari input)
        //dd($request->all());

        DB::table('mst_jenis_barang')->insert([
            'nama_jenis_barang' => $request->nama_jenis_barang,
            'deskripsi_barang' => $request->deskripsi_barang,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        return redirect()->route('jenis_barang')->with('message', 'Jenis Barang Berhasil Disimpan');
    }

    public function edit($id)
    {
        $editJenisBarang = DB::table('mst_jenis_barang')->where('id', $id)->first();

        return view('backend.jenis_barang.edit', compact('editJenisBarang'));
    }
    public function update(JenisBarangRequest $request, $id)
    {
        DB::table('mst_jenis_barang')
            ->where('id', $id)
            ->update([
                'nama_jenis_barang' => $request->nama_jenis_barang,
                'deskripsi_barang' => $request->deskripsi_barang,
                'updated_by' => 1,
                'updated_at' => \Carbon\Carbon::now(),
            ]);

        return redirect()->route('jenis_barang')->with('message', 'Jenis Barang Berhasil Diperbarui');
    }


    public function destroy($id)
    {
        DB::table('mst_jenis_barang')->where('id', $id)->delete();

        return redirect()->route('jenis_barang')->with('message', 'Jenis Barang Berhasil Dihapus');
    }
}
