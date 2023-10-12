<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Contracts\Permission;

class Pengajuan_barangController extends Controller
{
    public function index()
    {
        //query ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
        $pengajuan_barang = DB::table('tr_pengajuan')->select('tr_pengajuan.*', 'name as created_by')
            ->orderBy('tr_pengajuan.id', 'DESC')
            ->join('users', 'users.id', 'tr_pengajuan.created_by')
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

    public function getHargaStokBarangById(Request $request)
    {
        $hargaStokBarang = DB::table('barang')->select('stok', 'harga')
            ->where('id', $request->id_barang)
            ->first();

        return response()->json($hargaStokBarang);
    }
    public function store(Request $request)
    {
        // DB::beginTransaction(); 

        // try { 

        // Insert ke tr_pengajuan 
        $id_tr_pengajuan = DB::table('tr_pengajuan')->insertGetId([
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'grand_total' => 0,
            'status_pengajuan_ap' => 0,
            'keterangan_ditolak_ap' => '',
            'status_pengajuan_vendor' => 0,
            'keterangan_ditolak_vendor' => '',
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        $grandTotal = 0;

        $countData = count($request->id_barang);
        for ($i = 0; $i < $countData; $i++) {
            DB::table('detail_pengajuan')->insert([
                'id_barang' => $request->id_barang[$i],
                'jumlah' => $request->jumlah_barang[$i],
                'id_tr_pengajuan' => $id_tr_pengajuan,
                'total_per_barang' => $request->jumlah_barang[$i] * $request->harga_barang[$i],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
            // UPDATE STOK BARANG 
            DB::table('barang')->where('id', $request->id_barang[$i])->decrement('stok', $request->jumlah_barang[$i]);
            $grandTotal += $request->jumlah_barang[$i] * $request->harga_barang[$i];
        }

        DB::table('tr_pengajuan')->where('id', $id_tr_pengajuan)->update([
            'grand_total' => $grandTotal
        ]);

        //     DB::commit(); 

        return redirect()->route('pengajuan')->with('message', 'Pengajuan Berhasil Diajukan');
        //     // all good 
        // } catch (\Exception $e) { 
        //     DB::rollback(); 
        //     // something went wrong 
        // } 
    }
}
