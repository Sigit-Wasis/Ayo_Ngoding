<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrPengajuanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\auth;
use Spatie\Permission\Models\Role;
use App\Models\User;


class TransaksiBarangController extends Controller
{
    public function index()
    {
        $trPengajuan = DB::table('_t_r__pengajuan')
            ->select(
                '_t_r__pengajuan.*',
                'users.name as created_by',


            )
            ->orderBy('_t_r__pengajuan.id', 'DESC')
            ->join('users', 'users.id', '_t_r__pengajuan.created_by')
            ->paginate(5);

        return view('backend.tr_pengajuan.index', compact('trPengajuan'));
    }

    
    //transaksi
    public function create()
    {
        $vendors = DB::table('vendors')->select('id', 'nama')->get();

        return view('backend.tr_pengajuan.create', compact('vendors'));
    }

    public function getBarangById(Request $request)
    {
        $dataBarang = DB::table('_m_s_t__barang')->select('id', 'nama_barang')
            ->where('vendor_id', (int) $request->id_vendor)
            ->get();

        return response()->json($dataBarang);
    }

    public function getHargaStokBarangById(Request $request)
    {
        $hargaStokBarang = DB::table('_m_s_t__barang')->select('stok', 'harga')
            ->where('id', $request->id_barang)
            ->first();

        return response()->json($hargaStokBarang);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $trPengajuanId = DB::table('_t_r__pengajuan')->insertGetId([
                'tanggal_pengajuan' => $request->tanggal_pengajuan,
                'grand_total' => 0, // Default grand total
                'status_pengajuan_ap' => 1, //$request->status_pengajuan_ap,
                'keterangan_ditolak_ap' => '', //$request->keterangan_ditolak_ap,
                'status_pengajuan_vendor' => 0, //$request->status_pengajuan_vendor,
                'keterangan_ditolak_vendor' => '', //$request->keterangan_ditolak_vendor,
                'created_by' => auth::user()->id,
                'updated_by' => auth::user()->id,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),

            ]);
            // dd($request->all());

            $grandTotal = 0;

            $countData = count($request->id_barang);
            for ($i = 0; $i < $countData; $i++) {
                // Mengurangkan jumlah barang yang diajukan dari stok saat ini
                $barang = DB::table('_m_s_t__barang')->where('id', $request->id_barang[$i])->first();
                if ($barang) {
                    $stokSekarang = $barang->stok;
                    $stokBaru = $stokSekarang - $request->jumlah_barang[$i];

                    // Pastikan stok tidak negatif
                    if ($stokBaru < 0) {
                        throw new \Exception("Stok barang {$barang->nama_barang} tidak mencukupi.");
                    }

                    DB::table('_m_s_t__barang')->where('id', $request->id_barang[$i])->update([
                        'stok' => $stokBaru,
                    ]);

                    DB::table('_detail__pengajuan')->insert([
                        'id_barang' => $request->id_barang[$i],
                        'jumlah' => $request->jumlah_barang[$i],
                        'total_per_barang' => $request->jumlah_barang[$i] * $request->harga_barang[$i],
                        'id_tr_pengajuan' => $trPengajuanId, // Dengan asumsi Anda memiliki variabel ini
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);

                    $grandTotal += $request->jumlah_barang[$i] * $request->harga_barang[$i];
                } else {
                    throw new \Exception("Barang dengan ID {$request->id_barang[$i]} tidak ditemukan.");
                }
            }
            DB::table('_t_r__pengajuan')->where('id', $trPengajuanId)->update([
                'grand_total' => $grandTotal
            ]);


            DB::commit();
            return redirect()->route('pengajuan')->with('message', 'Pengajuan Berhasil Diajukan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function detailpengajuan($id_pengajuan)
    {
        $pengajuan = DB::table('_t_r__pengajuan')
            ->select('_t_r__pengajuan.*', 'name')
            ->join('users', 'users.id', '=', '_t_r__pengajuan.created_by')
            ->where('_t_r__pengajuan.id', $id_pengajuan)
            ->first();

        $detailPengajuan = DB::table('_detail__pengajuan')
            ->select('_detail__pengajuan.*', 'nama_barang', 'harga', 'satuan', 'image', 'deskripsi', 'nama')
            ->join('_m_s_t__barang', '_m_s_t__barang.id', '=', '_detail__pengajuan.id_barang')
            ->join('vendors', 'vendors.id', '=', '_m_s_t__barang.vendor_id')
            ->where('_detail__pengajuan.id_tr_pengajuan', $id_pengajuan)
            ->get();
            // dd($detailPengajuan);
        return view('backend.tr_pengajuan.show', compact('pengajuan', 'detailPengajuan'));
    }

    public function terimapengajuan($id){
        DB::table('_t_r__pengajuan')->where('id',$id)->update([
            'status_pengajuan_ap'=>1
        ]);

        return redirect()->route('detail_pengajuan',$id)->with('message', 'Pengajuan Berhasil Diajukan');
    }

    public function tolakpengajuan($id)
    {
        $request = request();
        $keterangan = $request->input('catatan');

        DB::table('_t_r__pengajuan')->where('id', $id)->update([
            'status_pengajuan_ap' => 2,
            'keterangan_ditolak_ap' => $keterangan
        ]);

        return redirect()->route('detail_pengajuan', $id)->with('message', 'Pengajuan Berhasil Ditolak');
    }

    public function deletepengajuan($id)
    {
        try {
            // Cari pengajuan berdasarkan ID
            $pengajuan = DB::table('_t_r__pengajuan')->where('id', $id)->first();

            // Jika pengajuan ditemukan, Anda dapat menghapusnya
            if ($pengajuan) {
                // Lakukan penghapusan pengajuan
                DB::table('_t_r__pengajuan')->where('id', $id)->delete();
                // Hapus juga detail pengajuan yang terkait jika perlu
                DB::table('_detail__pengajuan')->where('id_tr_pengajuan', $id)->delete();

                // Redirect dengan pesan sukses
                return redirect()->route('pengajuan')->with('message', 'Pengajuan berhasil dihapus.');
            } else {
                // Jika pengajuan tidak ditemukan, redirect dengan pesan error
                return redirect()->route('pengajuan')->with('error', 'Pengajuan tidak ditemukan.');
            }
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return redirect()->route('pengajuan')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


}
