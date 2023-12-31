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
        $this->middleware('permission:pengajuan-edit', ['only' => ['editpengajuan', 'updatepengajuan']]);
        $this->middleware('permission:pengajuan-delete', ['only' => ['deletepengajuan']]);
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
                'status_pengajuan_ap' => 0,
                'keterangan_ditolak_ap' => '',
                'status_pengajuan_vendor' => 0,
                'keterangan_ditolak_vendor' => '',
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
        $pengajuan = DB::table('_t_r__pengajuan')->where('id', $id)->first();

        if ($pengajuan->status_pengajuan_ap !== '1') {
            return redirect()->route('detail_pengajuan', $id)->with('error', 'Admin Pengadaan belum memberikan ACC');
        }

        // Jika Admin Vendor menyetujui, maka status pengajuan "Admin Vendor" diubah menjadi 1 (diACC)
        DB::table('_t_r__pengajuan')->where('id', $id)->update([
            'status_pengajuan_vendor' => 1
        ]);

        return redirect()->route('detail_pengajuan', $id)->with('message', 'Vendor Berhasil Diajukan');
    }



    public function tolakvendor(Request $request, $id)
    {
        $pengajuan = DB::table('_t_r__pengajuan')->where('id', $id)->first();

        if ($pengajuan->status_pengajuan_ap != "1") {
            // Jika Admin Pengadaan belum memberikan ACC, maka Admin Vendor tidak dapat ACC
            return redirect()->route('detail_pengajuan', $id)->with('error', 'Admin Pengadaan belum memberikan ACC atau telah menolak');
        }

        // Jika Admin Pengadaan menolak, maka Admin Vendor tidak dapat memberikan ACC
        if ($pengajuan->status_pengajuan_ap == "2") {
            return redirect()->route('detail_pengajuan', $id)->with('error', 'Admin Pengadaan telah menolak pengajuan, sehingga Admin Vendor tidak dapat memberikan ACC.');
        }

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

        // Jika Admin Vendor menolak, maka Status Admin Pengadaan Kembali Ke Awal (0)
        // if ($pengajuan->status_pengajuan_vendor == "2") {
        // Kembalikan status Admin Pengadaan ke awal (0)
        DB::table('_t_r__pengajuan')->where('id', $id)->update([
            'status_pengajuan_ap' => 0,
            'status_pengajuan_vendor' => 2,
            'keterangan_ditolak_vendor' => $mergedCatatan,
        ]);
        // }

        return redirect()->route('detail_pengajuan', $id)->with('message', 'Vendor Berhasil Ditolak');
    }

    public function deletepengajuan($id)
    {
        DB::table('_t_r__pengajuan')->where('id', $id)->delete();
        return redirect()->route('pengajuan')->with('message', 'Pengajuan Berhasil Dihapus!');
    }

    public function deletedetailpengajuan($id_barang, $id_pengajuan)
    {
        // Hapus detail pengajuan berdasarkan $id_barang
        DB::table('_detail__pengajuan')->where('id', $id_barang)->delete();

        // Cek apakah pengajuan ditemukan
        $editpengajuan = DB::table('_t_r__pengajuan')
            ->select('_t_r__pengajuan.*', 'nama', '_m_s_t__barang.Id_vendor as id_vendor')
            ->join('_detail__pengajuan', '_detail__pengajuan.id_tr_pengajuan', '_t_r__pengajuan.id')
            ->join('_m_s_t__barang', '_m_s_t__barang.id', '_detail__pengajuan.id_barang')
            ->join('vendors', 'vendors.id', '_m_s_t__barang.id_vendor')
            ->where('_t_r__pengajuan.id', $id_pengajuan)
            ->first();

        if ($editpengajuan) {
            // Ambil data jenis barang untuk dropdown
            $detailP = DB::table('_detail__pengajuan')
                ->join('_t_r__pengajuan', '_t_r__pengajuan.id', '_detail__pengajuan.id_tr_pengajuan')
                ->join('_m_s_t__barang', '_m_s_t__barang.id', '_detail__pengajuan.id_barang')
                ->select('_detail__pengajuan.id as id_detail_pengajuan', 'nama_barang', 'stok', 'harga', 'id_barang', 'jumlah')
                ->where('_detail__pengajuan.id_tr_pengajuan', $id_pengajuan)
                ->get();

            // Mengambil data barang untuk dropdown
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

            return redirect()->route('edit_pengajuan', $id_pengajuan)->with(
                [
                    'message' => 'Detail Pengajuan Berhasil Dihapus!',
                    'detailBarang' => $detailP,
                    'editpengajuan' => $editpengajuan,
                    'barangs' => $barangs,
                    'vendors' => $vendors
                ]
            );
        } else {
            // Handle jika data pengajuan tidak ditemukan
            return redirect()->route('edit_pengajuan', $id_pengajuan)->with(['error' => 'Data pengajuan tidak ditemukan']);
        }
    }

    public function editpengajuan(string $id)
    {

        $editpengajuan = DB::table('_t_r__pengajuan')
            ->select('_t_r__pengajuan.*', 'nama', 'id_barang', '_m_s_t__barang.Id_vendor as id_vendor')
            ->join('_detail__pengajuan', '_detail__pengajuan.id_tr_pengajuan', '_t_r__pengajuan.id')
            ->join('_m_s_t__barang', '_m_s_t__barang.id', '_detail__pengajuan.id_barang')
            ->join('vendors', 'vendors.id', '_m_s_t__barang.Id_vendor')
            ->where('_t_r__pengajuan.id', $id)
            ->first();


        // Ambil data jenis barang untuk dropdown
        $detailP = DB::table('_detail__pengajuan')
            ->join('_t_r__pengajuan', '_t_r__pengajuan.id', '_detail__pengajuan.id_tr_pengajuan')
            ->join('_m_s_t__barang', '_m_s_t__barang.id', '_detail__pengajuan.id_barang')
            ->select('_detail__pengajuan.id as id_detail_pengajuan', 'nama_barang', 'stok', 'harga', 'id_barang', 'jumlah')
            ->where('_detail__pengajuan.id_tr_pengajuan', $id)
            ->get();

        // Mengambil data barang untuk dropdown
        $barangs = DB::table('_m_s_t__barang')
            ->where('Id_vendor', $editpengajuan->id_vendor)
            ->select('id', 'nama_barang')
            ->get();


        // Mengambil data vendor untuk dropdown
        $vendors = DB::table('vendors')
            ->select('id', 'nama')
            ->get();

        // Simpan data jenis barang ke dalam sesi
        // session(['edit_pengajuan' => $editpengajuan]);

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

                    //UPDATE STOK BARANG
                    DB::table('_m_s_t__barang')->where('id', $request->id_barang[$i])->decrement('stok', $request->jumlah_barang[$i]);
                } else {
                    $jumlahSebelumUpdate = DB::table('_detail__pengajuan')
                        ->where('id_tr_pengajuan', $id)
                        ->where('id_barang', $request->id_barang[$i])->value('jumlah');

                    DB::table('_detail__pengajuan')->where('id', $request->id_detail_barang[$i])->update([
                        'id_tr_pengajuan' => $id,
                        'id_barang' => $request->id_barang[$i],
                        'total_per_barang' => $request->jumlah_barang[$i] * $request->harga_barang[$i],
                        'jumlah' => $request->jumlah_barang[$i],
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);

                    if ($request->jumlah_barang[$i] > $jumlahSebelumUpdate) {
                        $counter = $request->jumlah_barang[$i] - $jumlahSebelumUpdate;
                        $stokSekarang =  DB::table('_m_s_t__barang')->where('id', $request->id_barang[$i])->value('stok');

                        //update stok barang
                        DB::table('_m_s_t__barang')->where('id', $request->id_barang[$i])
                            ->update([
                                'stok' => $stokSekarang - $counter
                            ]);
                    } elseif ($request->jumlah_barang[$i] < $jumlahSebelumUpdate) {
                        $counter = $jumlahSebelumUpdate - $request->jumlah_barang[$i];
                        $stokSekarang =  DB::table('_m_s_t__barang')->where('id', $request->id_barang[$i])->value('stok');
                        //update stok barang
                        DB::table('_m_s_t__barang')->where('id', $request->id_barang[$i])
                            ->update([
                                'stok' => $stokSekarang + $counter
                            ]);
                    } else {
                    }
                    // DB::table('_m_s_t__barang')
                    //     ->where('id', $request->id_barang[$i])
                    //     ->decrement('stok', $request->jumlah_barang[$i]);

                }
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
