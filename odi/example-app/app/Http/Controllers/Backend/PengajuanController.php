<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



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
        //
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
        //
    }
}