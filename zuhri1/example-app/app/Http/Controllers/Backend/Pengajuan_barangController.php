<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Permission;

class Pengajuan_barangController extends Controller
{
    public function index()
    {
        //query ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
        $pengajuan_barang = DB::table('_t_r__pengajuan')->select('_t_r__pengajuan.*', 'name as created_by')
            ->orderBy('_t_r__pengajuan.id', 'DESC')
            ->join('users', 'users.id', '_t_r__pengajuan.created_by')
            ->paginate(5);


        return view('backend.pengajuan_barang.index', compact('pengajuan_barang'));
    }
    public function create()
    {
        //    $pengajuan = DB::table('_t_r__pengajuan')->select('id','tanggal_pengajuan')->get();
        $vendors = DB::table('vendor')->select('id', 'nama_perusahaan')->get();

        return view('backend.pengajuan_barang.create', compact('vendors'));
    }
    public function getBarangById(Request $request)
    {
        $dataBarang = DB::table('barang')->select('id', 'nama_barang')
            ->where('id_vendor', (int)$request->id_vendor)
            ->get();
        return response()->json($dataBarang);
    }

    public function getHargaBarangStokById(Request $request)
    {
        $hargaStokBarang = DB::table('barang')->select('stok', 'harga')
            ->where('id', $request->id_barang)
            ->first();

        return response()->json($hargaStokBarang);
    }
}
