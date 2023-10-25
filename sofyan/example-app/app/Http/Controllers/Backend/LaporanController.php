<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrPengajuanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\auth;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:laporan_list', ['only' => ['index', 'cetak']]);
        $this->middleware('permission:laporan_cetak', ['only' => ['cetak']]);
    }

    public function index()
    {
        $laporan = DB::table('_t_r__pengajuan')
            ->select(
                '_t_r__pengajuan.*',
                'users.name as created_by'
            )
            ->orderBy('_t_r__pengajuan.id', 'DESC')
            ->where('status_pengajuan_vendor', 1)
            ->join('users', 'users.id', '_t_r__pengajuan.created_by')
            ->paginate(5);

        return view('backend.Laporan.index', compact('laporan'));
    }

    public function cetak($id)
    {
        $data = DB::table('_detail__pengajuan')
            ->select(
                '_detail__pengajuan.*',
                'nama_barang',
                'tanggal_pengajuan',
                'jumlah',
                'total_per_barang',
                'grand_total',
                '_m_s_t__jenis__barang.nama as nama_jenis',
                'vendors.nama as nama_perusahaan',
                'users.name as dibuatoleh'
            )
            ->join('_m_s_t__barang', '_m_s_t__barang.id', '=', '_detail__pengajuan.id_barang')
            ->join('_m_s_t__jenis__barang', '_m_s_t__jenis__barang.id', '=', '_m_s_t__barang.Id_jenis_barang')
            ->join('_t_r__pengajuan', '_t_r__pengajuan.id', '_detail__pengajuan.id_tr_pengajuan')
            ->join('vendors', 'vendors.id', '=', '_m_s_t__barang.Id_vendor')
            ->join('users', 'users.id', '_t_r__pengajuan.created_by')
            ->where('_detail__pengajuan.id_tr_pengajuan', $id)
            ->get()->toArray();

        // dd($data);

        // Konversi koleksi menjadi array
        $pdf = Pdf::loadView('backend.Laporan.laporan', compact('data'));
        return $pdf->download('laporan_pengajuan.pdf');
    }
}
