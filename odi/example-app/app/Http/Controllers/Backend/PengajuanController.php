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
        $Pengajuan = FacadesDB::table('pengajuan')->select('pengajuan.*','name as created_by')
        ->orderBy('pengajuan.id', 'DESC')
        
        ->join('users','users.id','pengajuan.created_by')
        ->paginate(5);

        //  dd($Barang);

        return view ('backend.pengajuan.index', compact('Pengajuan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Pengajuan = FacadesDB::table('pengajuan')->select('id','tanggal_pengajuan')->get();
        $vendor = Role::pluck('name')->all();
        $permission = Permission::get();
       
        
        return view ('backend.pengajuan.create', compact('Pengajuan','vendor','permission'));
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