<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('backend.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        DB::table("permissions")->insert([
            'name' => $request->name,
            'guard_name' => 'web',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect()->route('roles.index')->with('message','Permission successfully');
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
    public function edit($id)
    {  
            $editPermission = DB::table('permissions')->where('id', $id)->first();
    
            return view('backend.permission.edit', compact('editPermission'));
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',    
        ]);
        
        DB::table("permissions")->where('id', $id)->update([
            'name' => $request->name,
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect()->route('roles.index')->with('message', 'Permission Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('permissions')->where('id', $id)->delete();

        return redirect()->route('roles.index')->with('message', 'Permission Berhasil Dihapus!');
    }
}
