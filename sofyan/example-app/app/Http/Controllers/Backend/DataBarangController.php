<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BarangRequest;
use App\Http\Requests\BarangUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataBarangController extends Controller
{
    public function index()
    {
        $dataBarang = DB::table('_m_s_t__barang')
            ->select(
                '_m_s_t__barang.*',
                'users.name as created_by',
                '_m_s_t__jenis__barang.nama as jenis_barang' // Ubah menjadi 'nama' sesuai dengan alias yang Anda berikan
            )
            ->orderBy('_m_s_t__barang.id', 'DESC')
            ->join('users', 'users.id', '_m_s_t__barang.created_by')
            ->join('_m_s_t__jenis__barang', '_m_s_t__jenis__barang.id', '_m_s_t__barang.Id_jenis_barang') // Sesuaikan dengan kolom yang sesuai
            ->paginate(5);

        return view('backend.data_barang.index', compact('dataBarang'));
    }

    public function createBarang()
    {
        // Mengambil data jenis barang dari tabel _m_s_t__jenis__barang
        $jenisBarang = DB::table('_m_s_t__jenis__barang')->get();

        // Menghitung jumlah total barang yang ada
        $totalBarang = DB::table('_m_s_t__barang')->count();

        // Membuat kode barang otomatis dengan format 'BRG-0001', 'BRG-0002', dst.
        $kodeBarang = 'BRG-' . str_pad($totalBarang + 1, 4, '0', STR_PAD_LEFT);

        return view('backend.data_barang.create', compact('jenisBarang', 'kodeBarang'));
    }
    //tipe data request adalah object
    //DD (die dump untuk memeriksa apakah ada value atau record di dalam variabel $request yang di amabil dari form imputan)
    //dd($request->all());

    public function barangAdd(BarangRequest $request)
    {
        // dd($request->all());
        // Menghitung jumlah total barang yang ada
        $totalBarang = DB::table('_m_s_t__barang')->count();

        // Membuat kode barang otomatis dengan format 'BRG-0001', 'BRG-0002', dst.
        $kodeBarang = 'BRG-' . str_pad($totalBarang + 1, 4, '0', STR_PAD_LEFT);

        // Inisialisasi variabel untuk menyimpan nama file gambar
        $imageName = null;

        // Store the uploaded image in the public folder
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/dist/img'), $imageName); // Update the destination path to 'public'
        }

        // Menyimpan data barang dengan kode barang otomatis
        DB::table('_m_s_t__barang')->insert([
            'Id_jenis_barang' => $request->jenis_barang, // Gunakan jenis_barang sesuai dengan form input
            'kode_barang' => $kodeBarang, // Gunakan kode barang otomatis
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'satuan' => $request->satuan,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'image' => $imageName, // Simpan nama gambar ke database
            'created_by' => auth()->user()->id, // Menggunakan ID pengguna yang sedang login
            'updated_by' => auth()->user()->id, // Menggunakan ID pengguna yang sedang login
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect()->route('data_barang')->with('message', 'Barang Berhasil Disimpan!');
    }

    public function deleteBarang($id)
    {
        DB::table('_m_s_t__barang')->where('id', $id)->delete();
        return redirect()->route('data_barang')->with('message', 'User Berhasil Dihapus!');
    }

    public function edit($id)
    {
        // Mengambil data jenis barang yang akan diedit berdasarkan ID
        $editBarang = DB::table('_m_s_t__barang')->where('id', $id)->first();

        if (!$editBarang) {
            return redirect()->route('jenis-barang')->with('error', 'Jenis Barang tidak ditemukan.');
        }

        // Simpan data jenis barang ke dalam sesi
        session(['edit_barang' => $editBarang]);

        // Arahkan ke halaman create
        return view('backend.data_barang.edit', compact('editBarang'));
    }


    public function update(BarangUpdateRequest $request, $id)
    {
        // jika menggunakan Request saja maka kode ini di aktifkan
        // // Validasi data yang dikirimkan oleh formulir
        // $request->validate([
        //     'nama_jenis_barang' => 'required',
        //     'deskripsi' => 'required',

        // ]);
        // Lakukan pembaruan data di database berdasarkan $id
        DB::table('_m_s_t__barang')
            ->where('id', $id)
            ->update([
                'nama' => $request->nama_jenis_barang,
                'deskripsi' => $request->deskripsi,
                'updated_by' => 1,
                'updated_at' => \Carbon\Carbon::now(),

            ]);

        return redirect()->route('jenis-barang')->with('message', 'Jenis Barang berhasil diperbarui!');
    }

}
