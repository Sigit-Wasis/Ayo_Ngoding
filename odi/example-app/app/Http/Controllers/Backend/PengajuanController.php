<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;



class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Pengajuans = FacadesDB::table('pengajuan')->select('pengajuan.*','username as created_by')
        // ->orderBy('id','DESC')->paginate(5)
        ->orderBy('pengajuan.id', 'DESC')
        ->join('users','users.id','pengajuan.created_by')
        ->paginate(5);

        //  dd($Barang);

        return view ('backend.pengajuan.index', compact('Pengajuans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $Pengajuans = FacadesDB::table('pengajuan')->select('id','tanggal_pengajuan')->get();
        $vendors = FacadesDB::table('vendor')->select('id','nama_perusahaan')->get();
        // $permission = Permission::get();
       
        
        return view ('backend.pengajuan.create', compact('vendors'));
    }
    
    public function getBarangById(Request $request)
    {
        $dataBarang = FacadesDB::table('barang')->select('id','nama_barang')
        ->where ('id_vendor', (int) $request->id_vendor)
        ->get();

        return response()->json($dataBarang);

    }
    public function getHargaStokBarangById(Request $request)
    {
        $hargaStokBarang = FacadesDB::table('barang')->select('stok','harga')
        ->where ('id', $request->id_barang)
        ->first();

        return response()->json($hargaStokBarang);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) 
    { 
        // DB::beginTransaction(); 
 
        // try { 
            
            // Insert ke tr_pengajuan 
            $id_tr_pengajuan = DB::table('pengajuan')->insertGetId([ 
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
                    'created_by' => Auth::user()->id, 
                    'updated_by' => Auth::user()->id,  
                    'created_at' => \Carbon\Carbon::now(), 
                    'updated_at' => \Carbon\Carbon::now(), 
                ]); 
            // UPDATE STOK BARANG 
            DB::table('barang')->where('id', $request->id_barang[$i])->decrement('stok', $request->jumlah_barang[$i]);
                $grandTotal += $request->jumlah_barang[$i] * $request->harga_barang[$i]; 
            } 
 
            DB::table('pengajuan')->where('id', $id_tr_pengajuan)->update([ 
                'grand_total' => $grandTotal 
            ]); 
             
            // DB::commit(); 
 
            return redirect()->route('pengajuan')->with('message', 'Pengajuan Berhasil Diajukan'); 
            // all good 
        // } catch (\Exception $e) { 
        //     DB::rollback(); 
        //     // something went wrong 
        // } 
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Query untuk mengambil data dari pengajuan berdasarkan id pengajuan
        $Pengajuans = FacadesDB::table('pengajuan')
        ->select('pengajuan.*','username as created_by')
        ->where('pengajuan.id', $id)
        ->join('users','users.id','pengajuan.created_by')
        ->first();

        // query untuk mengambil data dari detail pengajuan berdasarkan id pengajuan join ke table barang 
        //dan barang join ke vendor
        $detailBarang = FacadesDB::table('detail_pengajuan')
            ->select('detail_pengajuan.*', 'nama_barang', 'harga', 'gambar', 'satuan', 'deskripsi', 'nama_perusahaan')
            ->join('barang', 'barang.id', 'detail_pengajuan.id_barang')
            ->join('vendor', 'vendor.id', 'barang.id_vendor')
            ->where('detail_pengajuan.id_tr_pengajuan',$id)
            ->get();
    
            return view ('backend.pengajuan.show', compact('detailBarang','Pengajuans'));
        }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        FacadesDB::table('pengajuan')->where('id', $id)->delete();

        return redirect()->route('pengajuan')->with('message','Data Pengajuan Berhasil Dihapus');
    }

    public function terimapengajuan($id)
    {
        FacadesDB::table('pengajuan')->where('id', $id)->update([
        'status_pengajuan_ap' => 1 //jika 1 maka diterima
        ]);

        return redirect()->route('show_pengajuan',$id)->with('message','Data Pengajuan Berhasil Diterima');
    }

    public function tolakpengajuan(Request $request, $id)
    {
        FacadesDB::table('pengajuan')->where('id', $id)->update([
        'status_pengajuan_ap' => 2, //jika 2 maka ditolak
        'keterangan_ditolak_ap' => $request->catatan, // catatan diambil dari name modal
        ]);

        return redirect()->route('show_pengajuan',$id)->with('message','Data Pengajuan Berhasil Ditolak');
    }
}