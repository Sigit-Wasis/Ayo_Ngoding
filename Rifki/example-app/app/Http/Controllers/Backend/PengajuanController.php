<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\select;

class PengajuanController extends Controller
{
    public function index()
    {
        $transaksiPengajuan = DB::table('tr_pengajuan')
            ->select(
                'tr_pengajuan.*',
                'users.name as created_by'
            )
            ->orderBy('tr_pengajuan.id', 'DESC')
            ->join('users', 'users.id', '=', 'tr_pengajuan.created_by')
            ->paginate(5);

        return view('backend.pengajuan.index', compact('transaksiPengajuan'));
    }

    public function create()
    {
        $vendors = DB::table('vendors')->select('id', 'nama')->get();

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
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $grandTotal = 0;

            $countData = count($request->id_barang);
            for ($i = 0; $i < $countData; $i++) {
                DB::table('detail_pengajuan')->insert([
                    'id_barang' => $request->id_barang[$i],
                    'jumlah' => $request->jumlah_barang[$i],
                    'id_tr_pengajuan' => $id_tr_pengajuan,
                    'total_barang' => $request->jumlah_barang[$i] * $request->harga_barang[$i],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::table('mst_barang')->where('id', $request->id_barang[$i])->decrement('stok_barang', $request->jumlah_barang[$i]);

                $grandTotal += $request->jumlah_barang[$i] * $request->harga_barang[$i];
            }

            DB::table('tr_pengajuan')->where('id', $id_tr_pengajuan)->update([
                'grand_total' => $grandTotal,
            ]);

            DB::commit();

            return redirect()->route('pengajuan.index')->with('message', 'Pengajuan Berhasil Diajukan');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }

    public function show($id_pengajuan)
    {
        $pengajuan = DB::table('tr_pengajuan')
            ->select('tr_pengajuan.*', 'name as created_by')
            ->join('users', 'users.id', '=', 'tr_pengajuan.created_by')
            ->where('tr_pengajuan.id', $id_pengajuan)
            ->first();

        $detailPengajuan = DB::table('detail_pengajuan')
            ->select('detail_pengajuan.*', 'nama_barang', 'harga', 'satuan', 'gambar', 'deskripsi', 'nama')
            ->join('mst_barang', 'mst_barang.id', '=', 'detail_pengajuan.id_barang')
            ->join('vendors', 'vendors.id', '=', 'mst_barang.id_vendor')
            ->where('detail_pengajuan.id_tr_pengajuan', $id_pengajuan)
            ->get();

        return view('backend.pengajuan.show', compact('pengajuan', 'detailPengajuan'));
    }

    public function tolakPengajuan(Request $request, $id)
    {
        $penolakanAP = DB::table('tr_pengajuan')->select('keterangan_ditolak_ap')->where('id', $id)->first();
        $array = [$request->catatan];

        if ($penolakanAP->keterangan_ditolak_ap != null) {
            $catatanPenolakan = json_decode($penolakanAP->keterangan_ditolak_ap);

            if (is_array($catatanPenolakan)) {
                $catatanPenolakan = array_merge($catatanPenolakan, $array);
            } else {
                $catatanPenolakan = $array;
            }
        } else {
            $catatanPenolakan = $array;
        }

        DB::table('tr_pengajuan')->where('id', $id)->update([
            'status_pengajuan_ap' => 2, // jika 2 maka status ditolak
            'keterangan_ditolak_ap' => json_encode($catatanPenolakan), // panah catatan itu diambil dari nama modal tolak
        ]);

        return redirect()->route('show_pengajuan', $id)->with('message', 'Pengajuan berhasil ditolak');
    }



    public function destroy(string $id)
    {
        DB::table('tr_pengajuan')->where('id', $id)->delete();

        return redirect()->route('pengajuan.index')->with('message', 'Data Pengajuan Berhasil Dihapus');
    }

    public function terimaPengajuan($id)
    {
        DB::table('tr_pengajuan')->where('id', $id)->update([
            'status_pengajuan_ap' => 1,
        ]);

        return redirect()->route('show_pengajuan', $id)->with('message', 'Pengajuan berhasil diterima');
    }

    public function tolakPengajuanVendor($id, Request $request)
    {
        $penolakanVendor = $request->input('catatan'); // Mengambil catatan penolakan dari request

        // Ambil data pengajuan untuk update status dan catatan penolakan
        $pengajuan = DB::table('tr_pengajuan')->where('id', $id)->first();

        // Cek apakah catatan penolakan sebelumnya sudah ada
        if ($pengajuan->keterangan_ditolak_vendor != null) {
            $catatanPenolakan = json_decode($pengajuan->keterangan_ditolak_vendor);

            if (is_array($catatanPenolakan)) {
                $catatanPenolakan[] = $penolakanVendor;
            } else {
                $catatanPenolakan = [$penolakanVendor];
            }
        } else {
            $catatanPenolakan = [$penolakanVendor];
        }

        // Update data pengajuan dengan status dan catatan penolakan
        DB::table('tr_pengajuan')->where('id', $id)->update([
            'status_pengajuan_vendor' => 2, // 2 menunjukkan status ditolak oleh vendor
            'keterangan_ditolak_vendor' => json_encode($catatanPenolakan),
        ]);

        return redirect()->route('show_pengajuan', $id)->with('message', 'Pengajuan berhasil ditolak oleh Vendor');
    }

    public function edit($id)
    {
        // apa tipe data dari $id? STRING
        // Menggunakan first karena kita mau mengambil data hanya 1 yang sesuai dengan ID

        $editPengajuan = DB::table('tr_pengajuan')->select('tr_pengajuan.*','id_barang', 'nama', 'mst_barang.id_vendor as id_vendor')
        ->join('detail_pengajuan','detail_pengajuan.id_tr_pengajuan','tr_pengajuan.id')
        ->join('mst_barang','mst_barang.id','detail_pengajuan.id_barang')
        ->join('vendors','vendors.id','mst_barang.id_vendor')
        ->where('tr_pengajuan.id',$id)
        ->first();

        $vendors = DB::table('vendors')->select('id', 'nama' )->get();
        $barangs = DB::table('mst_barang')
        ->where('id_vendor', $editPengajuan->id_vendor )
        ->select('id','nama_barang')->get();

        $detailBarang = DB::table('detail_pengajuan')
        ->join('tr_pengajuan', 'tr_pengajuan.id', 'detail_pengajuan.id_tr_pengajuan')
        ->join('mst_barang','mst_barang.id','detail_pengajuan.id_barang')
        ->select('detail_pengajuan.id as id_detail_pengajuan', 'id_barang', 'nama_barang', 'jumlah', 'harga', 'stok_barang' )
        // ->select('detail_pengajuan.id','nama_barang','jumlah','harga','stok_barang')
        ->where('detail_pengajuan.id_tr_pengajuan', $id)
        ->get();
        

        return view('backend.pengajuan.edit', compact('editPengajuan', 'vendors', 'detailBarang','barangs'));

    }
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            DB::table('tr_pengajuan')->where('id', $id)->update([
                'tanggal_pengajuan' =>$request->tanggal_pengajuan,
                'updated_by' => Auth::user()->id,
                'updated_at' =>\Carbon\Carbon::now(),
            ]);

            $grandTotal = 0;
            $countData = count($request->id_barang);

            for ($i=0; $i < $countData; $i++) {

                if (!isset($request->id_detail_barang[$i])) {
                    DB::table('detail_pengajuan')->insert([
                        'id_barang' => $request->id_barang[$i],
                        'jumlah' => $request->jumlah_barang[$i],
                        'id_tr_pengajuan' => $id,
                        'total_barang' => $request->jumlah_barang[$i] * $request->harga_barang[$i],
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);
                } else {
                    DB::table('detail_pengajuan')->where('id', $request->id_detail_barang[$i])->update([
                        'id_barang' => $request->id_barang[$i],
                        'jumlah' => $request->jumlah_barang[$i],
                        'id_tr_pengajuan' => $id,
                        'total_barang' => $request->jumlah_barang[$i] * $request->harga_barang[$i],
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);
                }
                DB::table('mst_barang')->where('id', $request->id_barang[$i])
                ->decrement('stok_barang', $request->jumlah_barang[$i]);

                $grandTotal += $request->jumlah_barang[$i] * $request->harga_barang[$i];
            }
            DB::table('tr_pengajuan')->where('id', $id)->update([
                'grand_total'=> $grandTotal
            ]);
            DB::commit();

            return redirect()->route('pengajuan.index')->with('message', 'pengajuan berhasil diajukan');

        }  catch (\Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }

}
