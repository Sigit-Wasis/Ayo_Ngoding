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
            ->where('id_vendors', (int) $request->id_vendors)
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
                ]); 


                //UPDATE STOK BARANG
                DB::table('mts_barang')->where('id', $request->id_barang[$i])->decrement('Stok', $request->jumlah_barang);
 
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
            ->join('vendors', 'vendors.id', 'mts_barang.id_vendors')
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
            DB::table('tr_pengajuan')->where('id', $id)->update([
                'status_pengajuan_ap' =>2, //Jika satu maka status diterima
                'Keterangan_ditolak_ap' =>$request->catatan, //panah catatan itu diambil dari nama modal
            ]);

            return redirect()->route('show_data_pengajuan',$id)->with('message', 'pengajuan di tolak');
    
    }
        
        }
    