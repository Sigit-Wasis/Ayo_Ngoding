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
    public function show($id_tr_pengajuan)
    {
        //Query untuk mengambil data dari TR pengajuan berdasarkan id_pengajuan
        $pengajuan = DB::table('tr_pengajuan')
            ->select('tr_pengajuan.*', 'name as created_by')
            ->join('users', 'users.id', 'tr_pengajuan.created_by')
            ->where('tr_pengajuan.id', $id_tr_pengajuan)
            ->first();

        //query untuk mengambil data dari detail pengajuan berdasarkan id_pengajuan join ke table barang
        //dan barang joinke vendor
        $detail_pengajuan = DB::table('detail_pengajuan')
            ->select('detail_pengajuan.*', 'nama_barang', 'harga', 'gambar', 'satuan', 'deskripsi', 'nama_perusahaan')
            ->join('barang', 'barang.id', 'detail_pengajuan.id_barang')
            ->join('vendor', 'vendor.id', 'barang.id_vendor')
            ->where('detail_pengajuan.id_tr_pengajuan',  $id_tr_pengajuan)
            ->get();


        // Compact arahkan kedalam show.blade.php
        return view('backend.pengajuan_barang.show', compact('pengajuan', 'detail_pengajuan'));
    }

    public function terimaPengajuan($id)
    {
        DB::table('tr_pengajuan')->where('id', $id)->update([
            'status_pengajuan_ap' => 1 // jika 1 maka status diterima
        ]);
        return redirect()->route('show_pengajuan', $id)->with('message', 'pengajuan berhasil diterima');
    }
    public function tolakpengajuan(Request $request, $id)
    {
        $penolakanAP = DB::table('tr_pengajuan')->select('keterangan_ditolak_ap')->where('id', $id)->first();
        $array = [$request->catatan];

        if ($penolakanAP->keterangan_ditolak_ap !== "") {
            if ($penolakanAP->keterangan_ditolak_ap !== null || !empty($penolakanAP->keterangan_ditolak_ap)) {
                $catatanpenolakan = array_merge(json_decode($penolakanAP->keterangan_ditolak_ap), $array);
            }
        } else {
            $catatanpenolakan = $array;
        }


        DB::table('tr_pengajuan')->where('id', $id)->update([
            'status_pengajuan_ap' => 2, // jika 1 maka status ditolak
            'keterangan_ditolak_ap' => $catatanpenolakan, //panah catatan itu diambil
        ]);
        return redirect()->route('show_pengajuan', $id)->with('message', 'yahhh,,,,, pengajuan ditolak!');
    }

    public function tolakvendor(Request $request, $id)
    {
        $penolakanvendor = DB::table('tr_pengajuan')->select('keterangan_ditolak_vendor')->where('id', $id)->first();
        $array = [$request->catatan];

        if ($penolakanvendor->keterangan_ditolak_vendor !== "") {
            if ($penolakanvendor->keterangan_ditolak_vendor !== null || !empty($penolakanvendor->keterangan_ditolak_vendor)) {
                $catatanpenolakan = array_merge(json_decode($penolakanvendor->keterangan_ditolak_vendor), $array);
            }
        } else {
            $catatanpenolakan = $array;
        }

        DB::table('tr_pengajuan')->where('id', $id)->update([
            'status_pengajuan_vendor' => 2, // jika 1 maka status ditolak
            'keterangan_ditolak_vendor' => $catatanpenolakan, //panah catatan itu diambil
        ]);
        return redirect()->route('show_pengajuan', $id)->with('message', 'yahhh,,,,, vendor menolak!');
    }
    public function terimavendor($id)
    {
        DB::table('tr_pengajuan')->where('id', $id)->update([
            'status_pengajuan_vendor' => 1 // jika 1 maka status diterima
        ]);
        return redirect()->route('show_pengajuan', $id)->with('message', 'vendor berhasil diterima');
    }


    public function destroy($id)
    {

        try {
            //Cari pengajuan berdasarkan id
            $pengajuan = DB::table('tr_pengajuan')->where('id', $id)->first();

            if ($pengajuan) {
                //lakkan penghapusan pengajuan
                DB::table('tr_pengajuan')->where('id', $id)->delete();
                //hapus juga detail pengajuan yang terkait jika perlu
                DB::table('detail_pengajuan')->where('id_tr_pengajuan', '$id')->delete();

                //redirect dengan pesan sukses
                return redirect()->route('pengajuan')->with('message', 'pengajuan berhasil dihapus.');
            } else {
                //jika pengajuan tidak ditemukan,redirect dengan pesan error
                return redirect()->route('pengajuan')->with('erros', 'pengajuan tidak ditemukan');
            }
        } catch (\Exception $e) {
            //tangani kesalahan jika terjadi
            return redirect()->route('pengajuan')->with('eror', 'Terjadi kesalahan:' . $e->getMessage());
        }
    }
}
