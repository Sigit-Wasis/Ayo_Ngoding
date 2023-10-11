<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PengajuanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuan = DB::table('tr_pengajuan')
            ->select(
                'tr_pengajuan.*',
                'users.name as created_by',
                'detail_pengajuan.total_per_barang as total' // Ubah 'total' menjadi 'total_per_barang'
            )
            ->orderBy('tr_pengajuan.id', 'DESC')
            ->join('users', 'users.id', 'tr_pengajuan.created_by')
            ->join('detail_pengajuan', 'detail_pengajuan.id_tr_pengajuan', '=', 'tr_pengajuan.id') // Tambah join dengan pengajuan_barang
            ->paginate(3);

        return view('backend.pengajuan.index', compact('pengajuan'));
    }

    public function create()
    {
        // Ambil daftar vendor
        $vendors = DB::table('vendors')->get();

        // Ambil daftar barang yang sesuai dengan vendor yang dipilih
        $barangPerVendor = [];

        foreach ($vendors as $vendor) {
            $barang = DB::table('mst_barang')
                ->where('id_vendor', $vendor->id)
                ->get();

            $barangPerVendor[$vendor->id] = $barang;
        }

        // Mengambil data harga dan satuan untuk setiap barang
        $dataHargaSatuan = [];

        foreach ($barangPerVendor as $vendorId => $barangList) {
            foreach ($barangList as $barang) {
                $barangData = DB::table('mst_barang')
                    ->select('harga', 'stok_barang')
                    ->where('id', $barang->id)
                    ->first();

                    $dataHargaSatuan[$vendorId][$barang->id] = [
                        'harga' => $barangData->harga,
                        'stok_barang' => $barangData->stok_barang,
                    ];
                    
            }
        }

        return view('backend.pengajuan.create', compact('vendors', 'barangPerVendor', 'dataHargaSatuan'));
    }
    public function getBarangById(Request $request){
        $dataBarang = DB::table('mst_barang')->select('id', 'nama_barang')
        ->where('id_vendor', (int) $request->id_vendor)
        ->get();
        
        return response()->json($dataBarang);
    }

    public function store(PengajuanRequest $request)
    {
        $totalPerBarang = $request->jumlah * $request->harga;

        // Menghitung grand total berdasarkan total per barang
        $grandTotal = $totalPerBarang;

        // Menyimpan data pengajuan ke dalam tabel tr_pengajuan
        $trPengajuanId = DB::table('tr_pengajuan')->insertGetId([
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'grand_total' => $grandTotal,
            'status_pengajuan_ap' => 1,
            'keterangan_ditolak_ap' => '',
            'status_pengajuan_vendor' => 0,
            'keterangan_ditolak_vendor' => '',
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert data ke dalam tabel pengajuan_barang
        DB::table('pengajuan_barang')->insert([
            'id_barang' => $request->id_barang,
            'jumlah' => $request->jumlah,
            'total_per_barang' => $totalPerBarang,
            'id_tr_pengajuan' => $trPengajuanId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Kurangi jumlah stok berdasarkan jumlah yang dipesan
        DB::table('mst_barang')
            ->where('id', $request->id_barang)
            ->decrement('stok', $request->jumlah);

        return redirect()->route('pengajuan.index')->with('message', 'Pengajuan Barang Berhasil Disimpan!');    }

        public function getHargaStokBarangById(Request $request)
    {
        $hargaStokBarang = DB::table('mst_barang')->select('stok_barang', 'harga')
        ->where('id', $request->id_barang)
        ->first();
        
        return response()->json($hargaStokBarang);
    }

    public function show($id)
    {
        // Your code for displaying a single Pengajuan
    }

    public function edit($id)
    {
        // Your code for displaying the edit page for Pengajuan
    }

    public function update(Request $request, $id)
    {
        // Your code for updating Pengajuan data
    }

    public function destroy($id)
    {
        // Your code for deleting a Pengajuan
    }
}
