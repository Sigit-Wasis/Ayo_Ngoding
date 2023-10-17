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
    function __construct()
    {
        $this->middleware('permission:pengajuan-list|pengajuan-create|pengajuan-edit|pengajuan-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:pengajuan-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:pengajuan-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:pengajuan-delete', ['only' => ['destroy']]);
    }

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
            ->where('Id_vendor', (int) $request->id_vendor)
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
            ->join('vendors', 'vendors.id', '=', '_m_s_t__barang.Id_vendor')
            ->where('_detail__pengajuan.id_tr_pengajuan', $id_pengajuan)
            ->get();
        // dd($detailPengajuan);
        return view('backend.tr_pengajuan.show', compact('pengajuan', 'detailPengajuan'));
    }

    public function terimapengajuan($id)
    {
        DB::table('_t_r__pengajuan')->where('id', $id)->update([
            'status_pengajuan_ap' => 1
        ]);

        return redirect()->route('detail_pengajuan', $id)->with('message', 'Pengajuan Berhasil Diajukan');
    }

    public function tolakpengajuan(Request $request, $id)
    {
        $penolakanAP = DB::table('_t_r__pengajuan')->select('keterangan_ditolak_ap')->where('id', $id)->first();

        if (!empty($penolakanAP->keterangan_ditolak_ap)) {
            $existingCatatan = json_decode($penolakanAP->keterangan_ditolak_ap, true);
        } else {
            $existingCatatan = [];
        }

        $newCatatan = $request->catatan;

        // Tambahkan data baru ke dalam array yang ada
        $existingCatatan[] = $newCatatan;

        // Konversi array ke format JSON sebelum memperbarui database
        $mergedCatatan = json_encode($existingCatatan);

        DB::table('_t_r__pengajuan')->where('id', $id)->update([
            'status_pengajuan_ap' => 2,
            'keterangan_ditolak_ap' => $mergedCatatan,
        ]);

        return redirect()->route('detail_pengajuan', $id)->with('message', 'Pengajuan Berhasil Ditolak');
    }

    public function terimavendor($id)
    {
        DB::table('_t_r__pengajuan')->where('id', $id)->update([
            'status_pengajuan_vendor' => 1
        ]);

        return redirect()->route('detail_pengajuan', $id)->with('message', 'Vendor Berhasil Diajukan');
    }

    public function tolakvendor(Request $request, $id)
    {
        $keteranganVendor = DB::table('_t_r__pengajuan')->select('keterangan_ditolak_vendor')->where('id', $id)->first();

        if (!empty($keteranganVendor->keterangan_ditolak_vendor)) {
            // Periksa apakah keterangan_ditolak_vendor tidak kosong, kemudian tambahkan data baru ke dalam array
            $existingCatatan = json_decode($keteranganVendor->keterangan_ditolak_vendor, true);
        } else {
            $existingCatatan = [];
        }
        // Tambahkan catatan penolakan baru ke dalam array
        $catatanpenolakan = $request->catatanVendor;

        $existingCatatan[] = $catatanpenolakan;

        // Konversi array ke format JSON sebelum memperbarui database
        $mergedCatatan = json_encode($existingCatatan);

        DB::table('_t_r__pengajuan')->where('id', $id)->update([
            'status_pengajuan_vendor' => 2,
            'keterangan_ditolak_vendor' => $mergedCatatan,
        ]);

        return redirect()->route('detail_pengajuan', $id)->with('message', 'Vendor Berhasil Ditolak');
    }
    public function deletepengajuan($id)
    {
        DB::table('_t_r__pengajuan')->where('id', $id)->delete();
        return redirect()->route('pengajuan')->with('message', 'Pengajuan Berhasil Dihapus!');
    }


    public function editpengajuan($id)
    {
        $editpengajuan = DB::table('_t_r__pengajuan')
            ->select('_t_r__pengajuan.*', 'nama', 'id_barang', '_m_s_t__barang.Id_vendor as id_vendor')
            ->join('_detail__pengajuan', '_detail__pengajuan.id_tr_pengajuan', '_t_r__pengajuan.id')
            ->join('_m_s_t__barang', '_m_s_t__barang.id', '_detail__pengajuan.id_barang')
            ->join('vendors', 'vendors.id', '_m_s_t__barang.id_vendor')
            ->where('_t_r__pengajuan.id', $id)
            ->first();

        // Ambil data jenis barang untuk dropdown
        $detailP = DB::table('_detail__pengajuan')
            ->join('_t_r__pengajuan', '_t_r__pengajuan.id', '_detail__pengajuan.id_tr_pengajuan')
            ->join('_m_s_t__barang', '_m_s_t__barang.id', '_detail__pengajuan.id_barang')
            ->select('_detail__pengajuan.id as id_detail_pengajuan', 'nama_barang', 'stok', 'harga', 'id_barang', 'jumlah')
            ->where('_detail__pengajuan.id_tr_pengajuan', $id)
            ->get();

        $barangs = DB::table('_m_s_t__barang')
            ->where('Id_vendor', $editpengajuan->id_vendor)
            ->select('id', 'nama_barang')
            ->get();


        // Mengambil data vendor untuk dropdown
        $vendors = DB::table('vendors')
            ->select('id', 'nama')
            ->get();

        // Simpan data jenis barang ke dalam sesi
        session(['edit_pengajuan' => $editpengajuan]);

        // Arahkan ke halaman create
        return view('backend.tr_pengajuan.edit', compact('editpengajuan', 'vendors', 'detailP', 'barangs'));
    }

    public function updatepengajuan(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // Update data pengajuan
            DB::table('_t_r__pengajuan')
                ->where('id', $id)
                ->update([
                    'tanggal_pengajuan' => $request->tanggal_pengajuan,
                    'updated_by' => Auth::user()->id,
                    'updated_at' => \Carbon\Carbon::now(),
                    // Tambahkan kolom-kolom lain yang perlu diperbarui
                ]);

            $grandTotal = 0;

            $countData = count($request->id_barang);

            for ($i = 0; $i < $countData; $i++) {
                if (!isset($request->id_detail_barang[$i])) {
                    DB::table('_detail__pengajuan')->insert([
                        'id_tr_pengajuan' => $id,
                        'id_barang' => $request->id_barang[$i],
                        'total_per_barang' => $request->jumlah_barang[$i] * $request->harga_barang[$i],
                        'jumlah' => $request->jumlah_barang[$i],
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);
                } else {
                    DB::table('_detail__pengajuan')->where('id', $request->id_detail_barang[$i])->update([
                        'id_tr_pengajuan' => $id,
                        'id_barang' => $request->id_barang[$i],
                        'total_per_barang' => $request->jumlah_barang[$i] * $request->harga_barang[$i],
                        'jumlah' => $request->jumlah_barang[$i],
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);
                }
                DB::table('_m_s_t__barang')
                    ->where('id', $request->id_barang[$i])
                    ->decrement('stok', $request->jumlah_barang[$i]);

                $grandTotal += $request->jumlah_barang[$i] * $request->harga_barang[$i];
            }

            DB::table('_t_r__pengajuan')
                ->where('id', $id)->update(['grand_total' => $grandTotal]);


            DB::commit();

            return redirect()->route('pengajuan')->with('message', 'Pengajuan berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();

            return  $e->getMessage();
        }
    }
}
