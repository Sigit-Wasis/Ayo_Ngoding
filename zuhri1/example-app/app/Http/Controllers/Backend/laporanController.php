<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Pdf;

class laporanController extends Controller
{
    public function index()
    {
        $laporans = DB::table('tr_pengajuan')->select('tr_pengajuan.*', 'name as created_by')
            ->orderBy('tr_pengajuan.id', 'DESC')
            // ->where('status_pengajuan_vendor', 1)
            ->join('users', 'users.id', 'tr_pengajuan.created_by')
            ->paginate(5);


        return view('backend.laporan.index', compact('laporans'));
    }
    public function cetak($id)
    {
        $data = DB::table('detail_pengajuan')
            ->select('nama_barang','tanggal_pengajuan','jumlah','total_per_barang','grand_total','satuan','nama_perusahaan','nama_jenis_barang','users.name as dibuat_oleh')
            ->join('barang', 'barang.id', 'detail_pengajuan.id_barang')
            ->join('jenis_barang','jenis_barang.id','barang.id_jenis_barang')
            ->join('vendor','vendor.id','barang.id_vendor')
            ->join('tr_pengajuan', 'tr_pengajuan.id', 'detail_pengajuan.id_tr_pengajuan')
            ->join('users','users.id','tr_pengajuan.created_by')
            ->where('detail_pengajuan.id_tr_pengajuan',$id)
            ->get()->toArray();


        $pdf = Pdf::loadView('backend.laporan.laporan', compact('data'));
        return $pdf->download('laporan_pengajuan.pdf');
    }

    public function otherlaporan()
    {
       $pdf = PDF::setOptions(['isRemoteEnabled' => true, 'chroot' => public_path('assets/images/')])
            ->loadView('backend.laporan.other_laporan')->setPaper('folio', 'portrait');

        return $pdf->stream('other_laporan.pdf');
    }
    }
