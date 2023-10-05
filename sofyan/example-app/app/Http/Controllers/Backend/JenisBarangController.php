<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\JenisBarangRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



class JenisBarangController extends Controller
{
    public function index()
    {
        // query ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
        $jenisBarang = DB::table('_m_s_t__jenis__barang')->select('_m_s_t__jenis__barang.*', 'name as created_by')->orderBy('_m_s_t__jenis__barang.id', 'DESC')
            ->join('users', 'users.id', '_m_s_t__jenis__barang.created_by')
            ->paginate(5);

        //dd($jenisBarang);

        return view('backend.jenis_barang.index', compact('jenisBarang'));
    }

    public function create()
    {
        return view('backend.jenis_barang.create');
    }
    //tipe data request adalah object
    //DD (die dump untuk memeriksa apakah ada value atau record di dalam variabel $request yang di amabil dari form imputan)
    //dd($request->all());

    public function store(JenisBarangRequest $request)
    {
        DB::table('_m_s_t__jenis__barang')->insert([
            'nama' => $request->nama_jenis_barang,
            'deskripsi' => $request->deskripsi,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        return redirect()->route('jenis-barang')->with('message', 'Jenis BArang Berhasil Disimpan!');
    }

    public function destroy($id)
    {
        DB::table('_m_s_t__jenis__barang')->where('id', $id)->delete();
        return redirect()->route('jenis-barang')->with('message', 'Jenis Barang Berhasil Dihapus!');
    }

    public function edit($id)
    {
        // Mengambil data jenis barang yang akan diedit berdasarkan ID
        $editJenisBarang = DB::table('_m_s_t__jenis__barang')->where('id', $id)->first();

        if (!$editJenisBarang) {
            return redirect()->route('jenis-barang')->with('error', 'Jenis Barang tidak ditemukan.');
        }

        // Simpan data jenis barang ke dalam sesi
        session(['edit_jenis_barang' => $editJenisBarang]);

        // Arahkan ke halaman create
        return view('backend.jenis_barang.edit', compact('editJenisBarang'));
    }


    public function update(JenisBarangRequest $request, $id)
    {
        // jika menggunakan Request saja maka kode ini di aktifkan
        // // Validasi data yang dikirimkan oleh formulir
        // $request->validate([
        //     'nama_jenis_barang' => 'required',
        //     'deskripsi' => 'required',

        // ]);
        // Lakukan pembaruan data di database berdasarkan $id
        DB::table('_m_s_t__jenis__barang')
            ->where('id', $id)
            ->update([
                'nama' => $request->nama_jenis_barang,
                'deskripsi' => $request->deskripsi,
                'updated_by'=> auth()->user()->id,
                'updated_at' => \Carbon\Carbon::now(),

            ]);

        return redirect()->route('jenis-barang')->with('message', 'Jenis Barang berhasil diperbarui!');
    }
}
