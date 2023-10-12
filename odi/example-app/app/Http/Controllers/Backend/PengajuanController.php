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
        $Pengajuans = FacadesDB::table('pengajuan')->select('*')
        ->orderBy('id','DESC')->paginate(10);
        // ->orderBy('pengajuan.id', 'DESC')
        // ->join('users','users.id','pengajuan.created_by')
        // ->paginate(5);

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
        //
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
}