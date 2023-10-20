<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class LaporanController extends Controller
{
    public function index()
    {
        $laporans = DB::table('tr_pengajuan')->select('tr_pengajuan.*', 'name as created_by')
            ->join('users', 'users.id', 'tr_pengajuan.created_by')
            ->where('status_pengajuan_vendor', 1) //pengajuan diterima vendor
            ->orderBy('tr_pengajuan.id', 'DESC')
            ->paginate(10);
        return view('backend.laporan.index', compact('laporans'));
    }

    public function cetak($id)
    {
        $data = DB::table('detail_pengajuan')
        ->select('mst_barang.nama_barang', 'tanggal_pengajuan', 'jumlah', 'total_per_barang', 
        'grand_total', 'nama_perusahaan', 'jenis_barang.nama_barang as nama_jenis_barang', 'users.nama as dibuat_oleh')
        ->join('mst_barang', 'mst_barang.id', 'detail_pengajuan.id_barang')
        ->join('jenis_barang', 'jenis_barang.id', 'mst_barang.id_jenis_barang')
        ->join('vendor', 'vendor.id', 'mst_barang.id_vendor')
        ->join('tr_pengajuan', 'tr_pengajuan.id', 'detail_pengajuan.id_tr_pengajuan')
        ->join('users', 'users.id', 'tr_pengajuan.created_by')
        ->where('detail_pengajuan.id_tr_pengajuan', $id)
        ->get()->toArray();

        $pdf = Pdf::loadView('backend.laporan.laporan', compact('data'));
        return $pdf->download('laporan_pengajuan.pdf');
    }
}
