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
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            // Queri ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
            $Pengajuan = FacadesDB::table('tr_pengajuan')->select('tr_pengajuan.*', 'name as created_by')
            ->orderBy('.id', 'DESC')
                ->join('users', 'users.id', 'tr_pengajuan.created_by')
                ->paginate(5);
            // dd($jenisbarang);
       

        return view('backend.pengajuan.index', compact('Pengajuan'));


    }
        public function getBarangById(Request $request)
        {
            $dataBarang = FacadesDB::table('mst_barang')->select('id', 'nama_barang')
            ->where('id_vendor', (int) $request->id_vendor)
            ->get();

            return response()->json($dataBarang);
        }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = FacadesDB::table('vendor')->select('id', 'nama_perusahaan')->get();
        return view('backend.pengajuan.create', compact('vendors'));
    }

    public function getHargaStokBarangById(Request $request)
    {
        $hargaStokBarang = FacadesDB::table('mst_barang')->select('stok_barang', 'harga')
        ->where('id', $request->id_barang)
        ->first();

        return response()->json($hargaStokBarang);
    }
     
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
