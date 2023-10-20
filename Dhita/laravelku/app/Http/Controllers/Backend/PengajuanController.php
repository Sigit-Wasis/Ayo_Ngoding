<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePengajuanRequest;
use App\Http\Requests\UpdateVendorRequest;
use App\Http\Requests\VendorRequest;
use App\Http\Requests\VendorUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PengajuanController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:pengajuan-list|pengajuan-create|pengajuan-edit|pengajuan-delete', ['only' => ['index','store']]);
         $this->middleware('permission:pengajuan-create', ['only' => ['create','store']]);
         $this->middleware('permission:pengajuan-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:pengajuan-delete', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        $pengajuan = DB::table('tr_pengajuan')
            ->select(
                'tr_pengajuan.*',
                'users.nama_lengkap as created_by',
                // 'detail_pengajuan.total_per_barang as total'
            )
            ->orderBy('tr_pengajuan.id', 'DESC')
            ->join('users', 'users.id', 'tr_pengajuan.created_by')
            // ->join('detail_pengajuan', 'tr_pengajuan.id', 'detail_pengajuan.id_tr_pengajuan')
            ->paginate(5);

        return view('backend.pengajuan.index', compact('pengajuan'));
    }

    public function create()
    {
        $vendors = DB::table('vendor')->select('id', 'nama')->get();

        return view('backend.pengajuan.create', compact('vendors'));
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
            ->where('id', (int) $request->id_barang)
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

                DB::table('mst_barang')->where('id', $request->id_barang[$i])->decrement('stok_barang', $request->jumlah_barang[$i]);

                $grandTotal += $request->jumlah_barang[$i] * $request->harga_barang[$i];
            }

            DB::table('tr_pengajuan')->where('id', $id_tr_pengajuan)->update([
                'grand_total' => $grandTotal
            ]);

            DB::commit();

            return redirect()->route('pengajuan.index')->with('message', 'Pengajuan Berhasil Diajukan');
            // all good 
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong 

            dd($e->getMessage());
        }
    }

    public function show($id_pengajuan)
    {
        // apa tipe data dari $id? STRING
        // Menggunakan first karena kita mau mengambil data hanya 1 yang sesuai dengan ID

        $pengajuan = DB::table('tr_pengajuan')
            ->select('tr_pengajuan.*', 'nama_lengkap as created_by')
            ->join("users", "users.id", 'tr_pengajuan.created_by')
            ->where('tr_pengajuan.id', $id_pengajuan)
            ->first();

        $detailPengajuan = DB::table('detail_pengajuan')
            ->select('detail_pengajuan.*', 'nama_barang', 'harga', 'gambar', 'satuan', 'deskripsi', 'nama')
            ->join('mst_barang', 'mst_barang.id', 'detail_pengajuan.id_barang')
            ->join('vendor', 'vendor.id', 'mst_barang.id_vendor')
            ->where('detail_pengajuan.id_tr_pengajuan', $id_pengajuan)
            ->get();

        return view('backend.pengajuan.show', compact('pengajuan', 'detailPengajuan'));

        // return redirect()->route('edit_barang')->with('message', 'Barang berhasil diedit');
    }
    public function destroy($id_pengajuan)
    {
        DB::table('tr_pengajuan')->where('id', $id_pengajuan)->delete();

        return redirect()->route('pengajuan.index')->with('message', 'Pengajuan berhasil dihapus');
    }

    public function terimaPengajuan($id)
    {
        DB::table('tr_pengajuan')->where('id', $id)->update([
            'status_pengajuan_ap' => 1 // jika 1 maka status diterima
        ]);

        return redirect()->route('show_pengajuan', $id)->with('message', 'Pengajuan berhasil di terima');
    }

    public function tolakPengajuan(Request $request, $id)
    {
        $penolakanAP = Db::table('tr_pengajuan')->select('keterangan_ditolak_ap')->where('id', $id)->first();
        $catatan = [$request->catatan];

        if ($penolakanAP) {
            $CatatanPenolakan = json_decode($penolakanAP->keterangan_ditolak_ap, true);
            if (is_array($CatatanPenolakan)) {
                $CatatanPenolakan[] = $catatan;
            } else {
                $CatatanPenolakan = [$catatan];
            }

            DB::table('tr_pengajuan')->where('id', $id)->update([
                'status_pengajuan_ap' => 2, // jika 1 maka status ditolak
                'keterangan_ditolak_ap' => json_encode($CatatanPenolakan), // panah catatan itu diambil dari namr modal tolak

            ]);
        } else {
        }

        return redirect()->route('show_pengajuan', $id)->with('message', 'Pengajuan berhasil di tolak');
    }


    public function terimavendor($id)
    {
        DB::table('tr_pengajuan')->where('id', $id)->update([
            'status_pengajuan_vendor' => 1 // jika 1 maka status diterima
        ]);

        return redirect()->route('show_pengajuan', $id)->with('message', 'Vendor berhasil di terima');
    }

    public function tolakvendor(Request $request, $id)
    {
        $penolakan_vendor = Db::table('tr_pengajuan')->select('keterangan_ditolak_vendor')->where('id', $id)->first();
        $catatan = [$request->catatan];

        if ($penolakan_vendor) {
            $CatatanPenolakanVendor = json_decode($penolakan_vendor->keterangan_ditolak_vendor, true);
            if (is_array($CatatanPenolakanVendor)) {
                $CatatanPenolakanVendor[] = $catatan;
            } else {
                $CatatanPenolakanVendor = [$catatan];
            }

            DB::table('tr_pengajuan')->where('id', $id)->update([
                'status_pengajuan_vendor' => 2, // jika 1 maka status ditolak
                'keterangan_ditolak_vendor' => json_encode($CatatanPenolakanVendor), // panah catatan itu diambil dari namr modal tolak

            ]);
        } else {
        }
        return redirect()->route('show_pengajuan', $id)->with('message', 'Pengajuan berhasil di tolak');
    }

    public function edit($id)
    {
        // apa tipe data dari $id? STRING
        // Menggunakan first karena kita mau mengambil data hanya 1 yang sesuai dengan ID

        $editPengajuan = DB::table('tr_pengajuan')->select('tr_pengajuan.*', 'id_barang', 'nama', 'mst_barang.id_vendor as id_vendor')
            ->join('detail_pengajuan', 'detail_pengajuan.id_tr_pengajuan', 'tr_pengajuan.id')
            ->join('mst_barang', 'mst_barang.id', 'detail_pengajuan.id_barang')
            ->join('vendor', 'vendor.id', 'mst_barang.id_vendor')
            ->where('tr_pengajuan.id', $id)
            ->first();

        $vendors = DB::table('vendor')->select('id', 'nama')->get();
        $barangs = DB::table('mst_barang')
            ->where('id_vendor', $editPengajuan->id_vendor)
            ->select('id', 'nama_barang')->get();

        $detailBarang = DB::table('detail_pengajuan')
            ->join('tr_pengajuan', 'tr_pengajuan.id', 'detail_pengajuan.id_tr_pengajuan')
            ->join('mst_barang', 'mst_barang.id', 'detail_pengajuan.id_barang')
            ->select('detail_pengajuan.id as id_detail_pengajuan', 'id_barang', 'nama_barang', 'jumlah', 'harga', 'stok_barang')
            ->where('detail_pengajuan.id_tr_pengajuan', $id)
            ->get();


        return view('backend.pengajuan.edit', compact('editPengajuan', 'vendors', 'detailBarang', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            DB::table('tr_pengajuan')->where('id', $id)->update([
                'tanggal_pengajuan' => $request->tanggal_pengajuan,
                'updated_by' => Auth::user()->id,
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            $grandTotal = 0;
            $countData = count($request->id_barang);

            for ($i = 0; $i < $countData; $i++) {

                if (!isset($request->id_detail_barang[$i])) {
                    DB::table('detail_pengajuan')->insert([
                        'id_barang' => $request->id_barang[$i],
                        'jumlah' => $request->jumlah_barang[$i],
                        'id_tr_pengajuan' => $id,
                        'total_per_barang' => $request->jumlah_barang[$i] * $request->harga_barang[$i],
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);

                    DB::table('mst_barang')->where('id', $request->id_barang[$i])->decrement('stok_barang', $request->jumlah_barang[$i]);
                } else {
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

                    if ($request->jumlah_barang[$i] > $jumlahSebelumDiupdate) {
                        $counter = $request->jumlah_barang[$i] - $jumlahSebelumDiupdate;
                        $stokSekarang = DB::table('mst_barang')->where('id', $request->id_barang[$i])->value('stok_barang');

                        DB::table('mst_barang')->where('id', $request->id_barang[$i])
                        ->update([
                            'stok_barang' => $stokSekarang - $counter
                        ]);
                    } elseif ($request->jumlah_barang[$i] < $jumlahSebelumDiupdate) {
                        $counter = $jumlahSebelumDiupdate - $request->jumlah_barang[$i];
                        $stokSekarang = DB::table('mst_barang')->where('id', $request->id_barang[$i])->latest()->value('stok_barang');

                        DB::table('mst_barang')->where('id', $request->id_barang[$i])
                        ->update([
                            'stok_barang' => $stokSekarang + $counter
                        ]);

                        // $stokSekarang = DB::table('mst_barang')->where('id', $request->id_barang[$i])->value('stok_barang');
                        // DB::table('history_stok_barang')->insert([
                        //     'barang_id' => $request->id_barang[$i],
                        //     'stok_sebelum' => $stokSebelum,
                        //     'stok_sesudah' => $request->jumlah_barang[$i],
                        //     'stok_sekarang' => $stokSebelum - $request->jumlah_barang[$i] ,// stok yang berkurang
                        //     'created_at' => \Carbon\Carbon::now(),
                        //     'updated_at' =>\Carbon\Carbon::now()
                        // ]);
                    } else {
                        // continue;
                    }
                }
                 $grandTotal += $request->jumlah_barang[$i] * $request->harga_barang[$i];
            }
            //     DB::table('mst_barang')->where('id', $request->id_barang[$i])
            //         ->decrement('stok_barang', $request->jumlah_barang[$i]);

            //     $grandTotal += $request->jumlah_barang[$i] * $request->harga_barang[$i];
            // }
            DB::table('tr_pengajuan')->where('id', $id)->update([
                'grand_total' => $grandTotal
            ]);
            DB::commit();

            return redirect()->route('pengajuan.index')->with('message', 'pengajuan berhasil diajukan');
        } catch (\Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }


    public function destroyBarang($id_barang, $id_pengajuan)
    {
        DB::table('detail_pengajuan')->where('id', $id_barang)->delete();

        $editpengajuan = DB::table('tr_pengajuan')
            ->select('tr_pengajuan.*', 'id_barang', 'detail_pengajuan.id as id_detail-pengajuan ', 'nama', 'mst_barang.id_vendor as id_vendor')
            ->join('detail_pengajuan', 'detail_pengajuan.id_tr_pengajuan', 'tr_pengajuan.id')
            ->join('mst_barang', 'mst_barang.id', 'detail_pengajuan.id_barang')
            ->join('vendor', 'vendor.id', 'mst_barang.id_vendor')
            ->where('tr_pengajuan.id', $id_pengajuan)
            ->first();

        $vendors = DB::table('vendor')->select('id', 'nama')->get();

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
            [
                'message', 'Barang Berhasil dihapus',
                'detailBarang' => $detailBarang,
                'barangs' => $barangs,
                'vendors' => $vendors,
                'editpengajuan' => $editpengajuan
            ]
        );
    }
}
