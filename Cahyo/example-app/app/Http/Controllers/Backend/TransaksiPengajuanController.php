<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransaksiPengajuanController extends Controller
{
    public function index()
    {
        $transaksiPengajuan = DB::table('tr_pengajuan')->select('tr_pengajuan.*', 'username as created_by')
        ->orderBy('tr_pengajuan.id', 'DESC')
        ->join('users', 'users.id', 'tr_pengajuan.created_by')
        ->paginate(5);

        return view('backend.transaksi_pengajuan.index', compact('transaksiPengajuan'));
    }

    public function create()
    {
        $vendors = DB::table('vendors')->select('id', 'nama')->get();

        return view('backend.transaksi_pengajuan.create', compact('vendors'));
    }

    public function getBarangById(Request $request)
    {
        $dataBarang = DB::table('mst_barang')->select('id', 'nama_barang')
            ->where('id_vendor', (int) $request->id_vendor)
            ->get();

        return response()->json($dataBarang);
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
            for ($i = 0; $i < $countData; $i++) {
                DB::table('detail_pengajuan')->insert([
                    'id_barang' => $request->id_barang[$i],
                    'jumlah' => $request->jumlah_barang[$i],
                    'id_tr_pengajuan' => $id_tr_pengajuan,
                    'total_per_barang' => $request->jumlah_barang[$i] * $request->harga_barang[$i],
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);

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

            return $e->getMessage();
        }
    }

    public function show($id_pengajuan)
    {
        // Query untuk mengambil data dari TR_transaksi berdasarkan id_pengajuan 
        $pengajuan = DB::table('tr_pengajuan')
            ->select('tr_pengajuan')->select('tr_pengajuan.*', 'username as created_by', 'email')
            ->join("users", "users.id", 'tr_pengajuan.created_by')
            ->where('tr_pengajuan.id', $id_pengajuan)
            ->first();

        //Query untuk mengambil data dari detail pengajuan berdasarkan id_pengajuan join ke table barang
        //dan barang join ke vander
        $detailPengajuan = DB::table('detail_pengajuan')
            ->select('detail_pengajuan.*', 'nama_barang', 'harga', 'satuan', 'gambar', 'deskripsi', 'nama')
            ->join('mst_barang', 'mst_barang.id', 'detail_pengajuan.id_barang')
            ->join('vendors', 'vendors.id', 'mst_barang.id_vendor')
            ->where('detail_pengajuan.id_tr_pengajuan', $id_pengajuan)
            ->get();

        //Compact arahkan kedalam show.blade
        return view('backend.transaksi_pengajuan.show', compact('pengajuan', 'detailPengajuan'));
    }


    public function terimaPengajuan($id)
    {
        DB::table('tr_pengajuan')->where('id', $id)->update([
            'status_pengajuan_ap' => 1 //Jika satu maka status diterima
        ]);

        return redirect()->route('show_pengajuan', $id)->with('message', 'pengajuan berhasil diterima');
    }

    public function tolakPengajuan(Request $request, $id)
    {
        // Ambil data keterangan_ditolak_ap dari tabel tr_pengajuan
        $penolakanAP = DB::table('tr_pengajuan')->select('keterangan_ditolak_ap')->where('id', $id)->first();

        // Ambil catatan dari request
        $catatan = $request->catatan;

        if ($penolakanAP) {
            // Jika keterangan_ditolak_ap ada, gabungkan dengan catatan
            $existingCatatan = json_decode($penolakanAP->keterangan_ditolak_ap, true);

            if (is_array($existingCatatan)) {
                // Gabungkan catatan dengan yang sudah ada
                $existingCatatan[] = $catatan;
            } else {
                // Jika keterangan_ditolak_ap tidak berisi array valid, buat array baru
                $existingCatatan = [$catatan];
            }

            // Simpan kembali ke database
            DB::table('tr_pengajuan')->where('id', $id)->update([
                'status_pengajuan_ap' => 2, // Jika satu maka status diterima
                'keterangan_ditolak_ap' => json_encode($existingCatatan), // Simpan sebagai JSON
            ]);
        } else {
            // Jika data tidak ditemukan, tangani sesuai kebutuhan aplikasi Anda
            // Misalnya, tampilkan pesan kesalahan atau lakukan tindakan lain yang sesuai.
        }

        return redirect()->route('show_pengajuan', $id)->with('message', 'Pengajuan ditolak');
    }

    public function terimavendor($id)
    {
        DB::table('tr_pengajuan')->where('id', $id)->update([
            'status_pengajuan_vendor' => 1 //Jika satu maka status diterima
        ]);

        return redirect()->route('show_pengajuan', $id)->with('message', 'Pengajuan Berhasil Diterima Vendor');
    }
    public function tolakvendor(Request $request, $id)
    {
        $penolakanVendor = DB::table('tr_pengajuan')->select('status_ditolak_vendor')->where('id', $id)->first();

        // Ambil catatan dari request
        $catatan = $request->catatan;

        if ($penolakanVendor) {
            // Jika keterangan_ditolak_ap ada, gabungkan dengan catatan
            $existingCatatan = json_decode($penolakanVendor->status_ditolak_vendor, true);

            if (is_array($existingCatatan)) {
                // Gabungkan catatan dengan yang sudah ada
                $existingCatatan[] = $catatan;
            } else {
                // Jika keterangan_ditolak_ap tidak berisi array valid, buat array baru
                $existingCatatan = [$catatan];
            }

            // Simpan kembali ke database
            DB::table('tr_pengajuan')->where('id', $id)->update([
                'status_pengajuan_vendor' => 2, // Jika satu maka status diterima
                'status_ditolak_vendor' => json_encode($existingCatatan), // Simpan sebagai JSON
            ]);
        } else {
            // Jika data tidak ditemukan, tangani sesuai kebutuhan aplikasi Anda
            // Misalnya, tampilkan pesan kesalahan atau lakukan tindakan lain yang sesuai.
        }

        return redirect()->route('show_pengajuan', $id)->with('message', 'Pengajuan ditolak oleh vendor');
    }

    public function destroy($id)
    {
        DB::table('tr_pengajuan')->where('id', $id)->delete();

        return redirect()->route('pengajuan')->with('message', 'Barang Berhasil dihapus');
    }

    public function destroyBarang($id_barang, $id_pengajuan)
    {
        DB::table('detail_pengajuan')->where('id', $id_barang)->delete();

        $editpengajuan = DB::table('tr_pengajuan')
        ->select('tr_pengajuan.*', 'id_barang', 'detail_pengajuan.id as id_detail-pengajuan ','nama','mst_barang.id_vendor as id_vendor')
        ->join('detail_pengajuan', 'detail_pengajuan.id_tr_pengajuan', 'tr_pengajuan.id')
        ->join('mst_barang', 'mst_barang.id', 'detail_pengajuan.id_barang')
        ->join('vendors', 'vendors.id', 'mst_barang.id_vendor')
        ->where('tr_pengajuan.id', $id_pengajuan)
        ->first();

    $vendors = DB::table('vendors')->select('id', 'nama')->get();

    $barangs = DB::table('mst_barang')
        ->where('id_vendor', $editpengajuan->id_vendor)
        ->select('id', 'nama_barang')->get();

    $detailBarang = DB::table('detail_pengajuan')
        ->join('tr_pengajuan', 'tr_pengajuan.id', 'detail_pengajuan.id_tr_pengajuan')
        ->join('mst_barang', 'mst_barang.id', 'detail_pengajuan.id_barang')
        ->select('detail_pengajuan.id as id_detail_pengajuan', 'nama_barang', 'jumlah', 'harga', 'stok_barang')
        ->where('detail_pengajuan.id_tr_pengajuan', $id_pengajuan)
        ->get();

        return redirect()->route('edit_pengajuan', $id_pengajuan)->with(
            ['message', 'Barang Berhasil dihapus',
            'detailBarang' => $detailBarang,
            'barangs' => $barangs,
            'vendors' => $vendors,
            'editpengajuan' => $editpengajuan]);
    }

    public function edit($id)
    {

        $editpengajuan = DB::table('tr_pengajuan')
            ->select('tr_pengajuan.*', 'id_barang', 'detail_pengajuan.id as id_detail-pengajuan ','nama','mst_barang.id_vendor as id_vendor')
            ->join('detail_pengajuan', 'detail_pengajuan.id_tr_pengajuan', 'tr_pengajuan.id')
            ->join('mst_barang', 'mst_barang.id', 'detail_pengajuan.id_barang')
            ->join('vendors', 'vendors.id', 'mst_barang.id_vendor')
            ->where('tr_pengajuan.id', $id)
            ->first();

        $vendors = DB::table('vendors')->select('id', 'nama')->get();

        $barangs = DB::table('mst_barang')
            ->where('id_vendor', $editpengajuan->id_vendor)
            ->select('id', 'nama_barang')->get();

        $detailBarang = DB::table('detail_pengajuan')
            ->join('tr_pengajuan', 'tr_pengajuan.id', 'detail_pengajuan.id_tr_pengajuan')
            ->join('mst_barang', 'mst_barang.id', 'detail_pengajuan.id_barang')
            ->select('detail_pengajuan.id as id_detail_pengajuan', 'id_barang', 'nama_barang', 'jumlah', 'harga', 'stok_barang')
            ->where('detail_pengajuan.id_tr_pengajuan', $id)
            ->get();

        return view('backend.transaksi_pengajuan.edit', compact('editpengajuan', 'vendors', 'detailBarang', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        DB::beginTransaction();

        try {
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
                                   
                    // UPDATE STOK BARANG
                    DB::table('mst_barang')->where('id', $request->id_barang[$i])->decrement('stok_barang', $request->jumlah_barang[$i]);

                } else {
                    $jumlahSebelumDiupdate = DB::table('detail_pengajuan')
                    ->where('id_tr_pengajuan', $id)
                    ->where('id_barang', $request->id_barang[$i])->value('jumlah');

                    DB::table('detail_pengajuan')->where('id',$request->id_detail_barang[$i])->update([
                        'id_barang' => $request->id_barang[$i],
                        'jumlah' => $request->jumlah_barang[$i],
                        'id_tr_pengajuan' => $id,
                        'total_per_barang' => $request->jumlah_barang[$i] * $request->harga_barang[$i],
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);

                // jika barang lebih besar dari seblumnya maka dikurang
                // contoh awal jumlahnya 5 kemudian update menjadi 8 berarti stok barang (stok -8)
                if ($request->jumlah_barang[$i] > $jumlahSebelumDiupdate) {
                    $counter = $request->jumlah_barang[$i] -$jumlahSebelumDiupdate;
                    $stokSekarang = DB::table('mst_barang')->where('id', $request->id_barang[$i])->value('stok_barang');

                    // UPDATE STOK BARANG
                    DB::table('mst_barang')->where('id',$request->id_barang[$i])
                    ->update([
                    'stok_barang' => $stokSekarang - $counter
                    ]);

                // jika barang lebih besar dari seblumnya maka dikurang
                // contoh awal jumlahnya 5 kemudian update menjadi 3 berarti stok barang (stok +3)
                } elseif  ($request->jumlah_barang[$i] < $jumlahSebelumDiupdate) {
                    $counter = $jumlahSebelumDiupdate - $request->jumlah_barang[$i];

                    $stokSekarang = DB::table('mst_barang')->where('id', $request->id_barang[$i])->latest()->value('stok_barang');

                    // UPDATE STOK BARANG
                    DB::table('mst_barang')->where('id',$request->id_barang[$i])
                    ->update([
                    'stok_barang' => $stokSekarang + $counter
                    ]);

                    // $stokSebelum = DB::table('mst_barang')->where('id',$request->id_barang[$i])->value('stok_barang');
                    // DB::table('history_stok_barang')->insert([
                    //     'barang_id' => $request->id_barang[$i],
                    //     'stok_sebelum' => $stokSebelum,
                    //     'stok_sesudah' => $request->jumlah_barang[$i],
                    //     'stok_sekarang' =>  $stokSebelum - $request->jumlah_barang[$i],
                    //     'created_at' => \Carbon\Carbon::now(),
                    //     'updated_at' => \Carbon\Carbon::now()
                    // ]);
                } else {
                    // continue;
                }
            }

                $grandTotal += $request->jumlah_barang[$i] * $request->harga_barang[$i];


            } 
            DB::table('tr_pengajuan')->where('id', $id)->update([
                'grand_total' => $grandTotal
            ]);

            DB::commit();

            return redirect()->route('pengajuan')->with('message', 'Pengajuan Berhasil Diajukan');

        } catch (\Exception $e) {
            DB::rollBack();
            // something went wrong

            return $e->getMessage();
        }
    }
}
