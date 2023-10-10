<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrPengajuanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\User;


class TransaksiBarangController extends Controller
{
    public function index()
    {
        $trPengajuan = DB::table('_t_r__pengajuan')
            ->select(
                '_t_r__pengajuan.*',
                'users.name as created_by',
                '_m_s_t__jenis__barang.nama as jenis_barang' // Ubah menjadi 'nama' sesuai dengan alias yang Anda berikan
            )
            ->orderBy('_t_r__pengajuan.id', 'DESC')
            ->join('users', 'users.id', '_t_r__pengajuan.created_by')
            ->paginate(5);

        return view('backend.tr_pengajuan.index', compact('trPengajuan'));
    }

    public function createPengajuan()
    {
        $vendors = DB::table('vendors')->get();

        return view('backend.tr_pengajuan.create', compact('vendors'));
    }
    //tipe data request adalah object
    //DD (die dump untuk memeriksa apakah ada value atau record di dalam variabel $request yang di amabil dari form imputan)
    //dd($request->all());

    // public function barangAdd(TrPengajuanRequest $request)
    // {
    //     // dd($request->all());
    //     // Menghitung jumlah total barang yang ada
    //     $totalBarang = DB::table('_m_s_t__barang')->count();

    //     // Membuat kode barang otomatis dengan format 'BRG-0001', 'BRG-0002', dst.
    //     $kodeBarang = 'BRG-' . str_pad($totalBarang + 1, 4, '0', STR_PAD_LEFT);

    //     // Inisialisasi variabel untuk menyimpan nama file gambar
    //     $imageName = null;

    //     // Store the uploaded image in the public folder
    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $imageName = time() . '.' . $image->getClientOriginalExtension();
    //         $image->move(public_path('assets/dist/img'), $imageName); // Update the destination path to 'public'
    //     }

    //     // Menyimpan data barang dengan kode barang otomatis
    //     DB::table('_m_s_t__barang')->insert([
    //         'Id_jenis_barang' => $request->jenis_barang, // Gunakan jenis_barang sesuai dengan form input
    //         'kode_barang' => $kodeBarang, // Gunakan kode barang otomatis
    //         'nama_barang' => $request->nama_barang,
    //         'harga' => $request->harga,
    //         'satuan' => $request->satuan,
    //         'deskripsi' => $request->deskripsi,
    //         'stok' => $request->stok,
    //         'image' => $imageName, // Simpan nama gambar ke database
    //         'created_by' => auth()->user()->id, // Menggunakan ID pengguna yang sedang login
    //         'updated_by' => auth()->user()->id, // Menggunakan ID pengguna yang sedang login
    //         'created_at' => \Carbon\Carbon::now(),
    //         'updated_at' => \Carbon\Carbon::now(),
    //     ]);

    //     return redirect()->route('data_barang')->with('message', 'Barang Berhasil Disimpan!');
    // }
}
