<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
//use App\Http\Requests\UpdateBarangRequest;
use App\Http\Requests\PengajuanBarangRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengajuanBarangController extends Controller
{
    // function __construct()
    // {
    //      $this->middleware('permission:barang-list|barang-create|barang-edit|barang-delete', ['only' => ['index','store']]);
    //      $this->middleware('permission:barang-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:barang-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:barang-delete', ['only' => ['destroy']]);
    // }
    public function index()
    {
        //query ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
        $trBarang = DB::table('tr_pengajuan')
            ->select('tr_pengajuan.*', 'username as created_by')

            ->orderBy('tr_pengajuan.id', 'DESC')
            ->join('users', 'users.id', 'tr_pengajuan.created_by')
            ->paginate(5);

        // dd($jenisBarang);

        return view('backend.pengajuan.index', compact('trBarang'));
    }

    public function create()
    {
        // Ambil daftar vendor
        $vendors = DB::table('vendors')->select('id', 'nama')->get();



        return view('backend.pengajuan.create', compact('vendors'));
    }

    public function getBarangById(Request $request)
    {
        $databarang = DB::table('mts_barang')->select('id', 'nama_barang')
            ->where('id_vendor', (int) $request->id_vendor)
            ->get();

        return response()->json($databarang);
    }

    public function getHargaStokBarangById(Request $request)
    {

        $hargaStokBarang = DB::table('mts_barang')->select('Stok', 'harga')
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
                'status_ditolak_vendor' => '', 
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
                ]); 
                

                //UPDATE STOK BARANG
                DB::table('mts_barang')->where('id', $request->id_barang[$i])->decrement('Stok', $request->jumlah_barang[$i]);
 
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
            // Query untuk mengambil data dari TR_transaksi
            $pengajuan = DB::table('tr_pengajuan')
                ->select('tr_pengajuan')->select('tr_pengajuan.*', 'username as created_by', 'email')
                ->join("users", "users.id", 'tr_pengajuan.created_by')
                ->where('tr_pengajuan.id', $id_pengajuan)
                ->first();

            //Query untuk mengambil data dari detail pengajuan berdasarkan id_pengajuan join ke table barang
            //dan barang join ke vander
            $detailPengajuan = DB::table('detail_pengajuan')
            ->select('detail_pengajuan.*', 'nama_barang', 'harga','satuan', 'gambar', 'deskripsi', 'nama')
            ->join('mts_barang', 'mts_barang.id', 'detail_pengajuan.id_barang')
            ->join('vendors', 'vendors.id', 'mts_barang.id_vendor')
            ->where('detail_pengajuan.id_tr_pengajuan', $id_pengajuan)
            ->get();

            //Compact arahkan kedalam show.blade
            return view('backend.pengajuan.show', compact('pengajuan','detailPengajuan'));
        }


            public function terimaPengajuan($id)
            {
                DB::table('tr_pengajuan')->where('id', $id)->update([
                    'status_pengajuan_ap' =>1 //Jika satu maka status diterima
                ]);

                return redirect()->route('show_data_pengajuan',$id)->with('message', 'pengajuan berhasil diterima');
        
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
        
            return redirect()->route('show_data_pengajuan', $id)->with('message', 'Pengajuan ditolak');
        }
        
    public function terimavendor($id)
    {
        DB::table('tr_pengajuan')->where('id', $id)->update([
            'status_pengajuan_vendor' =>1 //Jika satu maka status diterima
        ]);

        return redirect()->route('show_data_pengajuan',$id)->with('message', 'Pengajuan Berhasil Diterima Vendor');

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
    
        return redirect()->route('show_data_pengajuan', $id)->with('message', 'Pengajuan ditolak oleh vendor');
    }
    
    public function destroy($id)
    {
        DB::table('tr_pengajuan')->where('id', $id)->delete();

        return redirect()->route('pengajuan')->with('message', 'Barang Berhasil dihapus');
    }

    public function edit($id)
    {
        //apa tipe data dari $id ?
        //menggunakan first karena kita mau mengambel hanya satu data yang sesuai dengan id
        $editpengajuan = DB::table('edit_data_pengajuan')->where('id', $id)->first();

        return view('backend.pengajuan.edit', compact('editpengajuan'));
    }

        }