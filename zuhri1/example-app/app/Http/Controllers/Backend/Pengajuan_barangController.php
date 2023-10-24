<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Contracts\Permission;

use function Laravel\Prompts\select;

class Pengajuan_barangController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:transaksi-pengajuan-list|transaksi-pengajuan-create|transaksi-pengajuan-edit|transaksi-pengajuan-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:transaksi-pengajuan-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:transaksi-pengajuan-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:transaksi-pengajuan-delete', ['only' => ['destroy']]);
    }



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
    public function edit($id)
    {

        $editpengajuan = DB::table('tr_pengajuan')
            ->select('tr_pengajuan.id', 'id_barang', 'detail_pengajuan.id as id_detail_pengajuan', 'tanggal_pengajuan', 'nama_perusahaan', 'barang.id_vendor as id_vendor')
            ->join('detail_pengajuan', 'detail_pengajuan.id_tr_pengajuan', 'tr_pengajuan.id')
            ->join('barang', 'barang.id', 'detail_pengajuan.id_barang')
            ->join('vendor', 'vendor.id', 'barang.id_vendor')
            ->where('tr_pengajuan.id', $id)
            ->first();

        $vendors = DB::table('vendor')->select('id', 'nama_perusahaan')->get();
        $barangs = DB::table('barang')
            ->where('id_vendor', $editpengajuan->id_vendor)
            ->select('id', 'nama_barang')->get();

        $detailBarang = DB::table('detail_pengajuan')
            ->join('tr_pengajuan', 'tr_pengajuan.id', 'detail_pengajuan.id_tr_pengajuan')
            ->join('barang', 'barang.id', 'detail_pengajuan.id_barang')
            ->select('detail_pengajuan.id as id_detail_pengajuan', 'id_barang', 'nama_barang', 'jumlah', 'harga', 'stok')
            ->where('detail_pengajuan.id_tr_pengajuan', $id)
            ->get();

        return view('backend.pengajuan_barang.edit', compact('editpengajuan', 'vendors', 'detailBarang', 'barangs'));
    }
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            //Insert ke tr_pengajuan
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

                     //UPDATE STOK BARANG
                DB::table('barang')->where('id', $request->id_barang[$i])->decrement('stok', $request->jumlah_barang[$i]);

                } else {
                    $jumlahSebelumDiupdate = DB::table('detail_pengajuan')
                    ->where ('id_tr_pengajuan',$id)
                    ->where('id_barang',$request->id_barang[$i])->value('jumlah');

                    DB::table('detail_pengajuan')->where('id', $request->id_detail_barang[$i])->update([
                        'id_barang' => $request->id_barang[$i],
                        'jumlah' => $request->jumlah_barang[$i],
                        'id_tr_pengajuan' => $id,
                        'total_per_barang' => $request->jumlah_barang[$i] * $request->harga_barang[$i],
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);
                
                 // jika jumlah barang lebih besar dari sebelumnya maka dikurang
                 // contoh awal jumlahnya 5 kemudian update menjadi 8 berarti stok barang (stok -8)
                 if ($request->jumlah_barang[$i] > $jumlahSebelumDiupdate) {
                    $counter = $request->jumlah_barang[$i]- $jumlahSebelumDiupdate;

                    $stokSekarang = DB::table('barang')->where('id',$request->id_barang[$i])->value('stok');
                     
                    //update stok barang
                    DB::table('barang')->where('id',$request->id_barang[$i])
                    ->update([
                        'stok' => $stokSekarang - $counter
                    ]);

                    //jika jumlah barang kurang daris ebelumnya maka ditambah
                    // contoh awal jumlahnya 5 kemudian update menjadi 3 berarti stok barang(stok +3)

                } elseif ($request->jumlah_barang[$i] < $jumlahSebelumDiupdate) {
                    $counter = $jumlahSebelumDiupdate - $request->jumlah_barang[$i];

                    $stokSekarang = DB ::table('barang')->where('id',$request->id_barang[$i])->value('stok');

                    //update stok barang
                    DB::table('barang')->where('id', $request->id_barang[$i])
                    ->update([
                        'stok'=>$stokSekarang + $counter

                    ]);
                } else {
                    //continue;
                }
            }
            $grandTotal += $request->jumlah_barang[$i] * $request->harga_barang[$i];
        }
            DB::table('tr_pengajuan')->where('id', $id)->update([
                'grand_total' => $grandTotal
            ]);

            DB::commit();

            return redirect()->route('pengajuan')->with('message', 'pengajuan berhasil diajukan');

        } catch (\Exception $e) {
            DB::rollback();
            //something went wrong

            return $e->getMessage();
        }
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

    public function destroybarang($id_barang, $id_pengajuan)
    {
        DB::table('detail_pengajuan')->where('id', $id_barang)->delete();

        $editpengajuan = DB::table('tr_pengajuan')
            ->select('tr_pengajuan.*', 'id_barang', 'detail_pengajuan.id as id_detail_pengajuan', 'nama_perusahaan', 'barang.id_vendor as id_vendor')
            ->join('detail_pengajuan', 'detail_pengajuan.id_tr_pengajuan', 'tr_pengajuan.id')
            ->join('barang', 'barang.id', 'detail_pengajuan.id_barang')
            ->join('vendor', 'vendor.id', 'barang.id_vendor')
            ->where('tr_pengajuan.id', $id_pengajuan)
            ->first();


        $detailBarang = DB::table('detail_pengajuan')
            ->join('tr_pengajuan', 'tr_pengajuan.id', 'detail_pengajuan.id_tr_pengajuan')
            ->select('detail_pengajuan.id as id_detail_pengajuan', 'id_barang', 'nama_barang', 'harga', 'stok', 'jumlah')
            ->join('barang', 'barang.id', 'detail_pengajuan.id_barang')
            ->where('detail_pengajuan.id_tr_pengajuan', $id_pengajuan)
            ->get();
        $vendors = DB::table('vendor')->select('id', 'nama_perusahaan')->get();
        $barang = DB::table('barang')
            ->where('id_vendor', $editpengajuan->id_vendor)
            ->select('id', 'nama_barang')
            ->get();

        return redirect()->route('edit_pengajuan', $id_pengajuan)->with([
            'messages', 'Barang berhasil dihapus',
            'detailBarang' => $detailBarang,
            'barangs' => $barang,
            'vendors' => $vendors,
            'editpengajuan' => $editpengajuan
        ]);
    }
}
