<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Pdf;

class LaporanController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:laporan-lis|laporan-cetak', ['only' => ['index', 'cetak']]);
        $this->middleware('permission:laporan-cetak', ['only' => ['cetak']]);
    }

    public function index()
    {
        $laporans = DB::table('tr_pengajuan')->select('tr_pengajuan.*', 'username as created_by')
            ->join("users", "users.id", 'tr_pengajuan.created_by')
            ->where('status_pengajuan_vendor', 1)
            ->orderBy('tr_pengajuan.id', 'DESC')
            ->paginate(10);


        return view('backend.laporan.index', compact('laporans'));
    }

    public function cetak($id)
    {
        $data = DB::table('detail_pengajuan')
        ->select('nama_barang', 'tanggal_pengajuan', 'jumlah', 'total_per_barang', 'satuan', 'grand_total', 'nama', 'nama_jenis_barang', 'users.name as dibuat_oleh')
        ->join('mst_barang', 'mst_barang.id', 'detail_pengajuan.id_barang')
        ->join('mst_jenis_barang', 'mst_jenis_barang.id', 'mst_barang.id_jenis_barang')
        ->join('vendors', 'vendors.id', 'mst_barang.id_vendor')
        ->join('tr_pengajuan', 'tr_pengajuan.id', 'detail_pengajuan.id_tr_pengajuan')
        ->join('users', 'users.id', 'tr_pengajuan.created_by')
        ->where('detail_pengajuan.id_tr_pengajuan', $id)
        ->get()->toArray();

        $pdf = Pdf::loadView('backend.laporan.laporan', compact('data'));
        return $pdf->download('laporan_pengajuan.pdf');
    }
    public function otherLaporan()
    {
        $pdf = PDF::setOptions(['isRemoteEnabled' => true, 'chroot' => public_path('assets/images/')])
            ->loadView('backend.laporan.other_laporan')->setPaper('folio', 'portrait');

        return $pdf->stream('other_laporan.pdf');
    }
}
