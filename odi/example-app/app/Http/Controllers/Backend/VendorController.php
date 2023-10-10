<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Auth;



class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = FacadesDB::table('vendor')->select('vendor.*','name as created_by')->orderBy('users.id', 'DESC')
        ->join('users', 'users.id', 'vendor.created_by')
        ->paginate(10);

        // dd($jenisBarang);

        return view ('backend.vendor.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('backend.vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        FacadesDB::table('vendor')->insert([
            'nama_perusahaan' =>$request->nama_perusahaan,
            'email' =>$request->email,
            'nomor_telpon' =>$request->nomor_telpon,
            'kepemilikan' =>$request->kepemilikan,
            'tahun_berdiri' =>$request->tahun_dibuat,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        return redirect()->route('vendor')->with('message','Vendor Berhasil Disimpan');
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
        $editvendor = FacadesDB::table('vendor')->where('id', $id)->first();

        return view('backend.vendor.edit', compact('editvendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        FacadesDB::table('vendor')->where ('id',$id)->update([
            'nama_perusahaan' =>$request->nama_perusahaan,
            'email' =>$request->email,
            'nomor_telpon' =>$request->nomor_telpon,
            'kepemilikan' =>$request->kepemilikan,
            'tahun_berdiri' =>$request->tahun_dibuat,
            

        ]);

        return redirect()->route('vendor')->with('message','Vendor Berhasil Diupdate');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        FacadesDB::table('vendor')->where('id', $id)->delete();

        return redirect()->route('vendor')->with('message','Vendor Berhasil Dihapus');
    }
}