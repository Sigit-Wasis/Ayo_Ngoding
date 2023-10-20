<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = DB::table('tr_pengajuan')
            ->select('tr_pengajuan.*','users.nama_lengkap as created_by', )
            ->where('status_pengajuan_vendor', 1)
            ->orderBy('tr_pengajuan.id', 'DESC')
            ->join('users', 'users.id', 'tr_pengajuan.created_by')
            ->paginate(5);

        return view('backend.laporan.index', compact('laporan'));
    }


    public function cetak($id)
    {
        $data = DB::table('detail_pengajuan')
        ->select('nama_barang','tanggal_pengajuan','jumlah','total_per_barang','grand_total','vendor.nama',
         'mst_jenis_barang.nama as nama_jenis_barang','satuan','users.nama_lengkap as dibuat_oleh')
        ->join('mst_barang', 'mst_barang.id', 'detail_pengajuan.id_barang')
        ->join('mst_jenis_barang', 'mst_jenis_barang.id', 'mst_barang.id_jenis_barang')
        ->join('vendor', 'vendor.id', 'mst_barang.id_vendor')
        ->join('tr_pengajuan', 'tr_pengajuan.id', 'detail_pengajuan.id_tr_pengajuan')
        ->join('users','users.id','tr_pengajuan.created_by')
        ->where('detail_pengajuan.id_tr_pengajuan', $id)
        ->get()->toArray();

        $pdf = PDF::loadView('backend.laporan.laporan', compact('data'));
        return $pdf->download('laporan_pengajuan.pdf');
    }
}
