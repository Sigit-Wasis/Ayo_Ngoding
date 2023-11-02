<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function create()
    {
        return view('backend.permission.create');
    }
    public function store(Request $request)
{
    $this->validate($request,[
        'name'=> 'required',
    ]);

    DB::table('permissions')->insert([
        'name'=> $request->name,
        'guard_name'=>'web',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at'=> \Carbon\Carbon::now(),
    ]);
    return redirect()->route('roles.index')->with('message', 'Permission berhasil disimpan');
}
public function edit($id) {   
    $editPermission = DB::table('permissions')->where('id', $id)->first();

    return view('backend.permission.edit', compact('editPermission'));
}

public function update(Request $request, $id)
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

public function destroy($id) 
{
    DB::table('permissions')->where('id', $id)->delete();

    return redirect()->route('roles.index')->with('message', 'Permission Berhasil Dihapus!');
}
}
