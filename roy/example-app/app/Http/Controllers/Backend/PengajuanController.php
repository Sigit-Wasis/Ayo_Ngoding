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
        $pengajuan = DB::table('tr_pengajuan')->where('id', $id)->first();

        if ($pengajuan->status_pengajuan_ap !== '1') {
            return redirect()->route('show_pengajuan', $id)->with('error', 'Admin Pengadaan belum memberikan ACC');
        }

        // Jika Admin Vendor menyetujui, maka status pengajuan "Admin Vendor" diubah menjadi 1 (diACC)
        DB::table('tr_pengajuan')->where('id', $id)->update([
            'status_pengajuan_vendor' => 1
        ]);

        return redirect()->route('show_pengajuan', $id)->with('message', 'Vendor Berhasil Diajukan');
    }
    public function tolakPengajuanVendor(Request $request, $id)
    {
        $pengajuan = DB::table('tr_pengajuan')->where('id', $id)->first();

        if ($pengajuan->status_pengajuan_ap != "1") {
            // Jika Admin Pengadaan belum memberikan ACC, maka Admin Vendor tidak dapat ACC
            return redirect()->route('show_pengajuan', $id)->with('error', 'Admin Pengadaan belum memberikan ACC atau telah menolak');
        }

        // Jika Admin Pengadaan menolak, maka Admin Vendor tidak dapat memberikan ACC
        if ($pengajuan->status_pengajuan_ap == "2") {
            return redirect()->route('show_pengajuan', $id)->with('error', 'Admin Pengadaan telah menolak pengajuan, sehingga Admin Vendor tidak dapat memberikan ACC.');
        }

        $keteranganVendor = DB::table('tr_pengajuan')->select('keterangan_ditolak_vendor')->where('id', $id)->first();

        if (!empty($keteranganVendor->keterangan_ditolak_vendor)) {
            // Periksa apakah keterangan_ditolak_vendor tidak kosong, kemudian tambahkan data baru ke dalam array
            $existingCatatan = json_decode($keteranganVendor->keterangan_ditolak_vendor, true);
        } else {
            $existingCatatan = [];
        }
        // Tambahkan catatan penolakan baru ke dalam array
        $catatanpenolakan = $request->catatan;

        $existingCatatan[] = $catatanpenolakan;

        // Konversi array ke format JSON sebelum memperbarui database
        $mergedCatatan = json_encode($existingCatatan);

        // Jika Admin Vendor menolak, maka Status Admin Pengadaan Kembali Ke Awal (0)
        // if ($pengajuan->status_pengajuan_vendor == "2") {
        // Kembalikan status Admin Pengadaan ke awal (0)
        DB::table('tr_pengajuan')->where('id', $id)->update([
            'status_pengajuan_ap' => 0,
            'status_pengajuan_vendor' => 2,
            'keterangan_ditolak_vendor' => $mergedCatatan,
        ]);
        // }

        return redirect()->route('show_pengajuan', $id)->with('message', 'Vendor Berhasil Ditolak');
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


        return view('backend.pengajuan.edit',
           compact('editPengajuan', 'vendors', 'detailBarang', 'barangs'));
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

        // dd($request->all());

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
                        'created_by' => Auth::user()->id, 
                        'updated_by' => Auth::user()->id,
                    ]);

                    //  update stok barang
                    DB::table ('mst_barang')->where('id', $request[$i])->decrement('stok_barang', $request->jumlah_barang[$i]);
                                
                } else {

                    // var_dump( $request->id_barang[$i]);
                    $jumlahSebelumDiupdate = DB::table('detail_pengajuan')
                        ->where('id_tr_pengajuan', $id)
                        ->where('id_barang', $request->id_barang[$i])->value('jumlah');

                    DB::table('detail_pengajuan')->where('id', $request->id_detail_barang[$i])->update([
                        'id_barang' => $request->id_barang[$i],
                        'jumlah' => $request->jumlah_barang[$i],
                        'id_tr_pengajuan' => $id,
                        'total_per_barang' => $request->jumlah_barang[$i] * $request->harga_barang[$i],
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);

                    // var_dump( (int) $request->jumlah_barang[$i]);
                    // var_dump( (int) $jumlahSebelumDiupdate);
                    // dd((int) $request->jumlah_barang[$i] > (int) $jumlahSebelumDiupdate);
                    // dd('s');
                    // var_dump($request->jumlah_barang[$i] > $jumlahSebelumDiupdate);
                    //jika jumlah barang lebih besar dari sebelumnya maka dikurang
                    // contoh awal jumlahnya 5 kemudian update menjadi 8 berarti stok barang (stok-8)
                    if ( $request->jumlah_barang[$i] > $jumlahSebelumDiupdate) {
                        $counter = $request->jumlah_barang[$i] - $jumlahSebelumDiupdate;

                        // dd($counter);

                        $stokSekarang = DB::table('mst_barang')->where('id', $request->id_barang[$i])->value('stok_barang');

                        // update stok barang
                        DB::table('mst_barang')->where('id', $request->id_barang[$i])
                        ->update([
                            'stok_barang' => $stokSekarang - $counter
                        ]);

                        // dd('masuk sini atas');

                        //jika jumlah barang kurang dari sebelumnya maka di tambah
                        // contoh awal jumlahnya 5 kemudian di update menjadi 3 berarti stok barang (stok-3)
                    } elseif ($request->jumlah_barang[$i] < $jumlahSebelumDiupdate) {

                        $counter = $jumlahSebelumDiupdate - $request->jumlah_barang[$i];

                        
                        $stokSekarang = DB::table('mst_barang')->where('id', $request->id_barang[$i])->value('stok_barang');
                        // dd($stokSekarang/);

                        // update stok barang
                        DB::table('mst_barang')->where('id', $request->id_barang[$i])
                        ->update([
                            'stok_barang' => $stokSekarang + $counter
                        ]);

                        // dd('masuk sini sdsd');

                    } else {
                        // 
                    }
                }
            
                // // UPDATE STOK BARANG
                // DB::table('mst_barang')->where('id', $request->id_barang[$i])
                //     ->decrement('stok_barang', $request->jumlah_barang[$i]);

                $grandTotal += $request->jumlah_barang[$i] * $request->harga_barang[$i];
            }

            // dd('keluar sini');

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
    public function destroyBarang($id_barang, $id_pengajuan)
    {
        DB::table('detail_pengajuan')->where('id', $id_barang)->delete();

        $editPengajuan =DB::table('tr_pengajuan')->select('tr_pengajuan.*', 'id_barang', 'nama_perusahaan', 'mst_barang.id_vendor as id_vendor')
            ->join('detail_pengajuan', 'detail_pengajuan.id_tr_pengajuan', 'tr_pengajuan.id')
            ->join('mst_barang', 'mst_barang.id', 'detail_pengajuan.id_barang')
            ->join('vendor', 'vendor.id', 'mst_barang.id_vendor')
            ->where('tr_pengajuan.id', $id_pengajuan)
            ->first();

        $vendors =DB::table('vendor')->select('id', 'nama_perusahaan')->get();
        $barangs =DB::table('mst_barang')
        ->where('id_vendor', $editPengajuan->id_vendor)
        ->select('id', 'nama_barang')->get();

        $detailBarang =DB::table('detail_pengajuan')
            ->join('tr_pengajuan', 'tr_pengajuan.id', 'detail_pengajuan.id_tr_pengajuan')
            ->join('mst_barang', 'mst_barang.id', 'detail_pengajuan.id_barang')
            ->select('detail_pengajuan.id as id_detail_pengajuan', 'id_barang', 'nama_barang', 'jumlah', 'harga', 'stok_barang')
            ->where('detail_pengajuan.id_tr_pengajuan', $id_pengajuan)
            ->get();


        return redirect()->route('edit_pengajuan', $id_pengajuan)->with(
            ['message', 'Barang Berhasil Dihapus!',
            'detailBarang' => $detailBarang,
            'barangs' => $barangs,
            'vendors' => $vendors,
            'editPengajuan' => $editPengajuan]);

        }
        
    }