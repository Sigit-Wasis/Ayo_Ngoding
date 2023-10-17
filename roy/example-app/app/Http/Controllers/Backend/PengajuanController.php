<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Queri ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
        $Pengajuan = DB::table('tr_pengajuan')->select('tr_pengajuan.*', 'name as created_by')
            ->orderBy('tr_pengajuan.id', 'DESC')
            ->join('users', 'users.id', 'tr_pengajuan.created_by')
            ->paginate(5);
        // dd($jenisbarang);


        return view('backend.pengajuan.index', compact('Pengajuan'));
    }
    public function getBarangById(Request $request)
    {
        $dataBarang = DB::table('mst_barang')->select('id', 'nama_barang')
            ->where('id_vendor', (int) $request->id_vendor)
            ->get();

        return response()->json($dataBarang);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = DB::table('vendor')->select('id', 'nama_perusahaan')->get();
        return view('backend.pengajuan.create', compact('vendors'));
    }

    public function getHargaStokBarangById(Request $request)
    {
        $hargaStokBarang = DB::table('mst_barang')->select('stok_barang', 'harga')
            ->where('id', $request->id_barang)
            ->first();

        return response()->json($hargaStokBarang);
    }

    public function store(Request $request) 
    { 
        DB::beginTransaction(); 
 
        try { 
            
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
            for ($i=0; $i < $countData; $i++) {  
                DB::table('detail_pengajuan')->insert([ 
                    'id_barang' => $request->id_barang[$i], 
                    'jumlah' => $request->jumlah_barang[$i], 
                    'id_tr_pengajuan' => $id_tr_pengajuan, 
                    'total_per_barang' => $request->jumlah_barang[$i] * $request->harga_barang[$i], 
                    'created_at' => \Carbon\Carbon::now(), 
                    'updated_at' => \Carbon\Carbon::now(), 
                    'created_by' => Auth::user()->id, 
                    'updated_by' => Auth::user()->id,
                ]); 
 

                // UPDATE STOK BARANG
                DB::table('mst_barang')->where('id', $request->id_barang[$i])->decrement('stok_barang', $request->jumlah_barang[$i]);

                $grandTotal += $request->jumlah_barang[$i] * $request->harga_barang[$i]; 
            } 
 
            DB::table('tr_pengajuan')->where('id', $id_tr_pengajuan)->update([ 
                'grand_total' => $grandTotal 
            ]); 
             
            DB::commit(); 
 
            return redirect()->route('pengajuan')->with('message', 'Pengajuan Berhasil Diajukan'); 
            // all good 
        } catch (\Exception $e) { 
            DB::rollback(); 
            // something went wrong 

            dd($e->getMessage());
        } 
    }

    public function show($id_pengajuan)
     {
        // Query untuk mengambil data dari TR pengajuan berdasarkan id_pengajuan
        $pengajuan = DB::table('tr_pengajuan')
        ->select('tr_pengajuan.*', 'name as created_by', 'email')
        ->join("users", "users.id", 'tr_pengajuan.created_by')
        ->where('tr_pengajuan.id', $id_pengajuan)
        ->first();

        // Query untuk mengambil data dari detail pengajuan berdasarkan Id_pengajuan join ke table barang
        // dan barang join ke vendor
        $detailPengajuan =DB::table('detail_pengajuan')
        ->select('detail_pengajuan.*', 'nama_barang', 'harga', 'gambar', 'satuan', 'deskripsi', 'nama_perusahaan')
        ->join('mst_barang', 'mst_barang.id', 'detail_pengajuan.id_barang')
        ->join('vendor', 'vendor.id', 'mst_barang.id_vendor')  
        ->where('detail_pengajuan.id_tr_pengajuan', $id_pengajuan)
        ->get();

        // Compact arahkan ke dalam show.blade.php
        return view('backend.pengajuan.show', compact('pengajuan', 'detailPengajuan'));
     }  
    
     public function terimaPengajuan($id)
     {
        DB::table('tr_pengajuan')->where('id', $id)->update([
            'status_pengajuan_ap' => 1 //jika 1 maka status diterima
        ]);
        return redirect()->route('show_pengajuan', $id)->with('message', 'Pengajuan berhasil diterima');
     }
  
     public function tolakPengajuan(Request $request, $id)
     {
        $keteranganPenolakanAP = Db::table ('tr_pengajuan')->select('keterangan_ditolak_ap')->where('id', $id)->first();     
        $array = [$request->catatan];

        if ($keteranganPenolakanAP->keterangan_ditolak_ap !== "") {
            if ($keteranganPenolakanAP->keterangan_ditolak_ap !== null || ! empty($keteranganPenolakanAP->keterangan_ditolak_ap)) {
                $penolakan = array_merge(json_decode($keteranganPenolakanAP->keterangan_ditolak_ap), $array);
            }
        } else {
            $penolakan = $array;
        }

        DB::table('tr_pengajuan')->where('id', $id)->update([
            'status_pengajuan_ap' => 2, // Jika 2 maka status ditolak
            'keterangan_ditolak_ap' => $penolakan, //panah catatan itu diambil dari nama modal tolal
        ]);

        // DB::table('tr_pengajuan')->where('id', $id)->update([
        //     'status_pengajuan_ap' => 2, //jika 1 maka status ditolak
        //     'keterangan_ditolak_ap' => $request->catatan, // panah catatan itu diambil dari nama modal tolak
        // ]);
            return redirect()->route('show_pengajuan', $id)->with('message', 'Maaf,,, Pengajuan Ditolak!');
     }

     public function terimaPengajuanVendor($id)
     {
        DB::table('tr_pengajuan')->where('id', $id)->update([
            'status_pengajuan_vendor' => 1 //jika 1 maka status diterima
        ]);
        return redirect()->route('show_pengajuan', $id)->with('message', 'Pengajuan berhasil diterima');
     }
  
     public function tolakPengajuanVendor(Request $request, $id)
     {
        DB::table('tr_pengajuan')->where('id', $id)->update([
            'status_pengajuan_vendor' => 2, //jika 1 maka status ditolak
            'keterangan_ditolak_vendor' => $request->catatan, // panah catatan itu diambil dari nama modal tolak
        ]);
            return redirect()->route('show_pengajuan', $id)->with('message', 'Maaf,,, Pengajuan Ditolak!');
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editPengajuan =DB::table('tr_pengajuan')->select('tr_pengajuan.*', 'id_barang', 'nama_perusahaan', 'mst_barang.id_vendor as id_vendor')
            ->join('detail_pengajuan', 'detail_pengajuan.id_tr_pengajuan', 'tr_pengajuan.id')
            ->join('mst_barang', 'mst_barang.id', 'detail_pengajuan.id_barang')
            ->join('vendor', 'vendor.id', 'mst_barang.id_vendor')
            ->where('tr_pengajuan.id', $id)
            ->first();

        $vendors =DB::table('vendor')->select('id', 'nama_perusahaan')->get();
        $barangs =DB::table('mst_barang')
        ->where('id_vendor', $editPengajuan->id_vendor)
        ->select('id', 'nama_barang')->get();

        $detailBarang =DB::table('detail_pengajuan')
            ->join('tr_pengajuan', 'tr_pengajuan.id', 'detail_pengajuan.id_tr_pengajuan')
            ->join('mst_barang', 'mst_barang.id', 'detail_pengajuan.id_barang')
            ->select('detail_pengajuan.id as id_detail_pengajuan', 'id_barang', 'nama_barang', 'jumlah', 'harga', 'stok_barang')
            ->where('detail_pengajuan.id_tr_pengajuan', $id)
            ->get();

        return view('backend.pengajuan.edit', compact('editPengajuan', 'vendors', 'detailBarang', 'barangs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // insert ke tr_pengajuan
            DB::table('tr_pengajuan')->where('id', $id)->update([
                'tanggal_pengajuan' => $request->tanggal_pengajuan,
                'updated_by' => Auth::user()->id,
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            $grandTotal = 0;

            $countData = count($request->id_barang);

            for ($i=0; $i < $countData; $i++) {
            if (!isset($request->id_detail_barang[$i])) {
                DB::table('detail_pengajuan')->insert([
                    'id_barang' => $request->id_barang[$i],
                    'jumlah' => $request->jumlah_barang[$i],
                    'id_tr_pengajuan' => $id,
                    'total_per_barang' => $request->jumlah_barang[$i] * $request->harga_barang[$i],
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            
        } else {
            DB::table('detail_pengajuan')->where('id', $request->id_detail_barang[$i])->update([
                    'id_barang' => $request->id_barang[$i],
                    'jumlah' => $request->jumlah_barang[$i],
                    'id_tr_pengajuan' => $id,
                    'total_per_barang' => $request->jumlah_barang[$i] * $request->harga_barang[$i],
                    'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

        // UPDATE STOK BARANG
        DB::table('mst_barang')->where('id', $request->id_barang[$i])
            ->decrement('stok_barang', $request->jumlah_barang[$i]);

            $grandTotal += $request->jumlah_barang[$i] * $request->harga_barang[$i];
    }

    DB::table('tr_pengajuan')->where('id', $id)->update([
        'grand_total' => $grandTotal
    ]);

    DB::commit();

    return redirect()->route('pengajuan')->with('message', 'pengajuan berhasil diajukan');

} catch (\Exception $e) {
    DB::rollBack();
    // something went wrong

    return $e->getMessage();
}
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('tr_pengajuan')->where('id', $id)->delete();

        return redirect()->route('pengajuan')->with('message', 'Transaksi Berhasil dihapus');
    }
}
