<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use Barryvdh\DomPDF\Facade\Pdf;


class LaporanController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:laporan-list|laporan-cetak', ['only' => ['index','cetak']]);
         $this->middleware('permission:laporan-cetak', ['only' => ['cetak']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporans = FacadesDB::table('pengajuan')->select('pengajuan.*','username as created_by')
        ->orderBy('pengajuan.id', 'DESC')
        ->join('users','users.id','pengajuan.created_by')
        ->where('status_pengajuan_vendor', 1) //pengajuan diterima vendor
        ->paginate(5);

        //  dd($Barang);

        return view ('backend.laporan.index', compact('laporans'));
    }

    public function cetak($id)
    {
        $data = FacadesDB::table('detail_pengajuan')
        ->select('nama_barang', 'tanggal_pengajuan', 'jumlah', 'total_per_barang', 'harga', 'grand_total', 'nama_perusahaan', 'nama_jenis_barang', 'users.username as dibuat_oleh')
        ->join('barang', 'barang.id', 'detail_pengajuan.id_barang')
        ->join('jenis_barang', 'jenis_barang.id', 'barang.id_jenis_barang')
        ->join('vendor', 'vendor.id', 'barang.id_vendor')
        ->join('pengajuan', 'pengajuan.id', 'detail_pengajuan.id_tr_pengajuan')
        ->join('users','users.id','pengajuan.created_by')
        ->where('detail_pengajuan.id_tr_pengajuan', $id)
        ->get()->toArray();

        $pdf = Pdf::loadView('backend.laporan.laporan', compact('data'));
        return $pdf->download('laporan-pengajauan.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function otherLaporan()
    {
        $pdf = Pdf::setOptions(['isRemoteEnabled' => true, 'chroot' => public_path('assets/images/')])
            ->loadView('backend.laporan.laporan1')->setPaper('folio', 'portrait');

        return $pdf->stream('other-laporan.pdf');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
