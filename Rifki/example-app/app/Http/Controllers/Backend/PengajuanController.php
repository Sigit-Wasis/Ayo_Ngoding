<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function index()
    {
        $transaksiPengajuan = DB::table('tr_pengajuan')
            ->select(
                'tr_pengajuan.*',
                'users.name as created_by',
                

            )
            ->orderBy('tr_pengajuan.id', 'DESC')
            ->join('users', 'users.id', 'tr_pengajuan.created_by')
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
                'upadated_by' => Auth::user()->id,
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
                    'total_barang' => $request->jumlah_barang[$i] * $request->harga_barang[$i],
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
        ->select('tr_pengajuan.*', 'name as created_by')
        ->join("users","users.id",'tr_pengajuan.created_by')
        ->where('tr_pengajuan.id', $id_pengajuan)
        ->first();

        $detailPengajuan = DB::table('detail_pengajuan')
        ->select('detail_pengajuan.*', 'nama_barang', 'harga','satuan','gambar','deskripsi','nama')
        ->join('mst_barang', 'mst_barang.id', 'detail_pengajuan.id_barang')
        ->join('vendors', 'vendors.id', 'mst_barang.id_vendor')
        ->where('detail_pengajuan.id_tr_pengajuan', $id_pengajuan)
        ->get();

        return view('backend.pengajuan.show', compact('pengajuan','detailPengajuan'));

        // return redirect()->route('edit_barang')->with('message', 'Barang berhasil diedit');
    }
    public function tolakpengajuan($id)
    {
        $request = request();
        $keterangan = $request->input('catatan');

        DB::table('tr_pengajuan')->where('id', $id)->update([
            'status_pengajuan_ap' => 2,
            'keterangan_ditolak_ap' => $keterangan
        ]);

        return redirect()->route('show_pengajuan', $id)->with('message', 'Pengajuan Berhasil Ditolak');
    }

    public function destroy(string $id) 
    { 
       DB::table('tr_pengajuan')->where('id', $id)->delete(); 
 
        return redirect()->route('pengajuan.index')->with('message','Data Pengajuan Berhasil Dihapus'); 
    }
    public function terimapengajuan($id)
    {
        DB::table('tr_pengajuan')->where('id', $id)->update([
        'status_pengajuan_ap' => 1
    ]);
    return redirect()->route('show_pengajuan', $id)->with('message','Pengajuan berhasil diterima'); 
    }


    
}
