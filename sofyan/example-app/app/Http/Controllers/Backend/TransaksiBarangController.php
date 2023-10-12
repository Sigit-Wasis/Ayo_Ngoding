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
                '_detail__pengajuan.total_per_barang as total',

            )
            ->orderBy('_t_r__pengajuan.id', 'DESC')
            ->join('_detail__pengajuan', '_detail__pengajuan.id_tr_pengajuan', '_t_r__pengajuan.id')
            ->join('users', 'users.id', '_t_r__pengajuan.created_by')
            ->paginate(5);

        return view('backend.tr_pengajuan.index', compact('trPengajuan'));
    }

    public function createPengajuan()
    {
        // Ambil daftar vendor
        $vendors = DB::table('vendors')->get();

        // Ambil daftar barang yang sesuai dengan vendor yang dipilih
        $barangPerVendor = [];

        foreach ($vendors as $vendor) {
            $barang = DB::table('_m_s_t__barang')
                ->where('vendor_id', $vendor->id)
                ->get();

            $barangPerVendor[$vendor->id] = $barang;
        }

        // Mengambil data harga dan satuan untuk setiap barang
        $dataHargaSatuan = [];

        foreach ($barangPerVendor as $vendorId => $barangList) {
            foreach ($barangList as $barang) {
                $barangData = DB::table('_m_s_t__barang')
                    ->select('harga', 'stok', 'image')
                    ->where('id', $barang->id)
                    ->first();

                $dataHargaSatuan[$vendorId][$barang->id] = [
                    'harga' => $barangData->harga,
                    'stok' => $barangData->stok,
                    'image' => $barangData->image,
                ];
            }
        }

        return view('backend.tr_pengajuan.create', compact('vendors', 'barangPerVendor', 'dataHargaSatuan'));
    }



    //tipe data request adalah object
    //DD (die dump untuk memeriksa apakah ada value atau record di dalam variabel $request yang di amabil dari form imputan)
    //dd($request->all());


    public function storePengajuan(TrPengajuanRequest $request)
    {

        // Menghitung total per barang berdasarkan jumlah dan harga
        $totalPerBarang = $request->jumlah * $request->harga;

        // Menghitung grand total berdasarkan total per barang
        $grandTotal = $totalPerBarang;

        // Menyimpan data pengajuan ke dalam tabel _t_r__pengajuan
        $trPengajuanId = DB::table('_t_r__pengajuan')->insertGetId([
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'grand_total' => $grandTotal, // Menyimpan grand total
            'status_pengajuan_ap' => 1, //$request->status_pengajuan_ap,
            'keterangan_ditolak_ap' => '', //$request->keterangan_ditolak_ap,
            'status_pengajuan_vendor' => 0, //$request->status_pengajuan_vendor,
            'keterangan_ditolak_vendor' => '', //$request->keterangan_ditolak_vendor,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert data ke dalam tabel _detail__pengajuan
        DB::table('_detail__pengajuan')->insert([
            'id_barang' => $trPengajuanId, // ID pengajuan yang baru saja disimpan
            'jumlah' => $request->jumlah,
            'total_per_barang' => $totalPerBarang, // Simpan total per barang
            'id_tr_pengajuan' => $trPengajuanId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Update stok barang yang sesuai
        DB::table('_m_s_t__barang')
            ->where('id', $request->barang_id)
            ->decrement('stok', $request->jumlah); // Pengurangan jumlah stok berdasarkan jumlah yang dipesan

        return redirect()->route('tr_pengajuan')->with('message', 'Pengajuan Barang Berhasil Disimpan!');
    }

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
            return redirect()->route('tr_pengajuan')->with('error', 'Transaction not found.');
        }

        return view('backend.tr_pengajuan.show', compact('transaction'));
    }
}
