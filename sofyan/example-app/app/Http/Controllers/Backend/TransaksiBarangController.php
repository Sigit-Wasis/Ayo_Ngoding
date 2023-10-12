<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrPengajuanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\auth;
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
                

            )
            ->orderBy('_t_r__pengajuan.id', 'DESC')
            ->join('users', 'users.id', '_t_r__pengajuan.created_by')
            ->paginate(5);

        return view('backend.tr_pengajuan.index', compact('trPengajuan'));
    }

    // public function createPengajuan()
    // {
    //     // Ambil daftar vendor
    //     $vendors = DB::table('vendors')->get();

    //     // Ambil daftar barang yang sesuai dengan vendor yang dipilih
    //     $barangPerVendor = [];

    //     foreach ($vendors as $vendor) {
    //         $barang = DB::table('_m_s_t__barang')
    //             ->where('vendor_id', $vendor->id)
    //             ->get();

    //         $barangPerVendor[$vendor->id] = $barang;
    //     }

    //     // Mengambil data harga dan satuan untuk setiap barang
    //     $dataHargaSatuan = [];

    //     foreach ($barangPerVendor as $vendorId => $barangList) {
    //         foreach ($barangList as $barang) {
    //             $barangData = DB::table('_m_s_t__barang')
    //                 ->select('harga', 'stok', 'image')
    //                 ->where('id', $barang->id)
    //                 ->first();

    //             $dataHargaSatuan[$vendorId][$barang->id] = [
    //                 'harga' => $barangData->harga,
    //                 'stok' => $barangData->stok,
    //                 'image' => $barangData->image,
    //             ];
    //         }
    //     }

    //     return view('backend.tr_pengajuan.create', compact('vendors', 'barangPerVendor', 'dataHargaSatuan'));
    // }



    //tipe data request adalah object
    //DD (die dump untuk memeriksa apakah ada value atau record di dalam variabel $request yang di amabil dari form imputan)
    //dd($request->all());

    // public function storePengajuan(TrPengajuanRequest $request)
    // {
    //     // Kode Anda yang ada untuk menyimpan catatan pengajuan utama di sini...
    //     // Simpan data pengajuan ke dalam tabel _t_r__pengajuan
    //     $trPengajuanId = DB::table('_t_r__pengajuan')->insertGetId([
    //         'tanggal_pengajuan' => $request->tanggal_pengajuan,
    //         'grand_total' => 0, // Default grand total
    //         'status_pengajuan_ap' => 1, //$request->status_pengajuan_ap,
    //         'keterangan_ditolak_ap' => '', //$request->keterangan_ditolak_ap,
    //         'status_pengajuan_vendor' => 0, //$request->status_pengajuan_vendor,
    //         'keterangan_ditolak_vendor' => '', //$request->keterangan_ditolak_vendor,
    //         'created_by' => auth()->user()->id,
    //         'updated_by' => auth()->user()->id,
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //     ]);

    //     // Mengelola beberapa item di sini
    //     $barang_ids = $request->input('barang_id');
    //     $jumlah = $request->input('jumlah');
    //     $harga = $request->input('harga');

    //     // Array untuk menyimpan total grand total dari semua item yang dipilih
    //     $grandTotal = 0;

    //     foreach ($barang_ids as $key => $barang_id) {
    //         $item_jumlah = $jumlah[$key];
    //         $item_harga = $harga[$key];

    //         // Menghitung total per item
    //         $totalPerBarang = $item_jumlah * $item_harga;

    //         // Mengakumulasikan grand total
    //         $grandTotal += $totalPerBarang;

    //         // Memasukkan detail item ke dalam tabel _detail__pengajuan Anda
    //         DB::table('_detail__pengajuan')->insert([
    //             'id_barang' => $barang_id,
    //             'jumlah' => $item_jumlah,
    //             'total_per_barang' => $totalPerBarang,
    //             'id_tr_pengajuan' => $trPengajuanId, // Dengan asumsi Anda memiliki variabel ini
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);

    //         // Memperbarui stok item yang dipilih (serupa dengan kode Anda yang ada)...
    //         DB::table('_m_s_t__barang')
    //         ->where('id', $barang_id)
    //             ->decrement('stok', $item_jumlah);
    //     }

    //     // Memperbarui grand total untuk catatan pengajuan utama
    //     DB::table('_t_r__pengajuan')
    //     ->where('id', $trPengajuanId)
    //         ->update(['grand_total' => $grandTotal]);

    //     // Redirect ke rute yang sesuai dengan pesan keberhasilan...
    //     return redirect()->route('tr_pengajuan')->with('message', 'Pengajuan Barang Berhasil Disimpan!');
    // }

    //transaksi
    public function create()
    {
        $vendors = DB::table('vendors')->select('id', 'nama')->get();

        return view('backend.tr_pengajuan.create', compact('vendors'));
    }

    public function getBarangById(Request $request)
    {
        $dataBarang = DB::table('_m_s_t__barang')->select('id', 'nama_barang')
            ->where('vendor_id', (int) $request->id_vendor)
            ->get();

        return response()->json($dataBarang);
    }

    public function getHargaStokBarangById(Request $request)
    {
        $hargaStokBarang = DB::table('_m_s_t__barang')->select('stok', 'harga')
            ->where('id', $request->id_barang)
            ->first();

        return response()->json($hargaStokBarang);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $trPengajuanId = DB::table('_t_r__pengajuan')->insertGetId([
                'tanggal_pengajuan' => $request->tanggal_pengajuan,
                'grand_total' => 0, // Default grand total
                'status_pengajuan_ap' => 1, //$request->status_pengajuan_ap,
                'keterangan_ditolak_ap' => '', //$request->keterangan_ditolak_ap,
                'status_pengajuan_vendor' => 0, //$request->status_pengajuan_vendor,
                'keterangan_ditolak_vendor' => '', //$request->keterangan_ditolak_vendor,
                'created_by' => auth::user()->id,
                'updated_by' => auth::user()->id,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),

            ]);
            // dd($request->all());

            $grandTotal = 0;

            $countData = count($request->id_barang);
            for ($i = 0; $i < $countData; $i++) {
                // Mengurangkan jumlah barang yang diajukan dari stok saat ini
                $barang = DB::table('_m_s_t__barang')->where('id', $request->id_barang[$i])->first();
                if ($barang) {
                    $stokSekarang = $barang->stok;
                    $stokBaru = $stokSekarang - $request->jumlah_barang[$i];

                    // Pastikan stok tidak negatif
                    if ($stokBaru < 0) {
                        throw new \Exception("Stok barang {$barang->nama_barang} tidak mencukupi.");
                    }

                    DB::table('_m_s_t__barang')->where('id', $request->id_barang[$i])->update([
                        'stok' => $stokBaru,
                    ]);

                    DB::table('_detail__pengajuan')->insert([
                        'id_barang' => $request->id_barang[$i],
                        'jumlah' => $request->jumlah_barang[$i],
                        'total_per_barang' => $request->jumlah_barang[$i] * $request->harga_barang[$i],
                        'id_tr_pengajuan' => $trPengajuanId, // Dengan asumsi Anda memiliki variabel ini
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);

                    $grandTotal += $request->jumlah_barang[$i] * $request->harga_barang[$i];
                } else {
                    throw new \Exception("Barang dengan ID {$request->id_barang[$i]} tidak ditemukan.");
                }
            }
            DB::table('_t_r__pengajuan')->where('id', $trPengajuanId)->update([
                'grand_total' => $grandTotal
            ]);


            DB::commit();
            return redirect()->route('pengajuan')->with('message', 'Pengajuan Berhasil Diajukan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    //show barang
    public function detailpengajuan($id)
    {
        $transaction = DB::table('_t_r__pengajuan')
            ->select(
                '_t_r__pengajuan.*',
                'created.name as created_by',
                'updated.name as updated_by',
                'vendors.nama as vendor_nama', // Select the vendor name
                '_m_s_t__barang.nama_barang',
                '_m_s_t__barang.harga',
                '_m_s_t__barang.satuan',
                '_detail__pengajuan.jumlah',
                '_detail__pengajuan.total_per_barang'
            )
            ->join('_detail__pengajuan', '_detail__pengajuan.id_tr_pengajuan', '_t_r__pengajuan.id')
            ->join('users as created', 'created.id', '_t_r__pengajuan.created_by')
            ->join('users as updated', 'updated.id', '_t_r__pengajuan.updated_by')
            ->join('_m_s_t__barang', '_m_s_t__barang.id', '_detail__pengajuan.id_barang')
            ->join('vendors', 'vendors.id', '_m_s_t__barang.vendor_id') // Join with 'vendors' to get vendor name
            ->where('_t_r__pengajuan.id', $id)
            ->first();



        if (!$transaction) {
            return redirect()->route('pengajuan')->with('error', 'Transaction not found.');
        }

        return view('backend.tr_pengajuan.show', compact('transaction'));
    }

    public function deletepengajuan($id)
    {
        try {
            // Cari pengajuan berdasarkan ID
            $pengajuan = DB::table('_t_r__pengajuan')->where('id', $id)->first();

            // Jika pengajuan ditemukan, Anda dapat menghapusnya
            if ($pengajuan) {
                // Lakukan penghapusan pengajuan
                DB::table('_t_r__pengajuan')->where('id', $id)->delete();
                // Hapus juga detail pengajuan yang terkait jika perlu
                DB::table('_detail__pengajuan')->where('id_tr_pengajuan', $id)->delete();

                // Redirect dengan pesan sukses
                return redirect()->route('pengajuan')->with('message', 'Pengajuan berhasil dihapus.');
            } else {
                // Jika pengajuan tidak ditemukan, redirect dengan pesan error
                return redirect()->route('pengajuan')->with('error', 'Pengajuan tidak ditemukan.');
            }
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return redirect()->route('pengajuan')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
