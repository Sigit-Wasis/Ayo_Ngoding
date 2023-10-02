<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = FacadesDB::table('users')->select('users.*')->orderBy('users.id', 'DESC')
        ->paginate(10);

        // dd($jenisBarang);

        return view ('backend.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        FacadesDB::table('users')->insert([
            'name' =>$request->name,
            'username' =>$request->username,
            'password' =>bcrypt($request->password),
            'nama_lengkap' =>$request->nama_lengkap,
            'alamat' =>$request->alamat,
            'nomor_telpon' =>$request->nomor_telpon,
            'email' =>$request->email,
        ]);

        return redirect()->route('user')->with('message','User Berhasil Disimpan');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edituser = FacadesDB::table('users')->where('id', $id)->first();

        return view('backend.user.edit', compact('edituser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, $id)
    {
        if($request->password) {
        FacadesDB::table('users')->where ('id',$id)->update([
            'name' =>$request->name,
            'username' =>$request->username,
            'password' =>bcrypt($request->password),
            'nama_lengkap' =>$request->nama_lengkap,
            'alamat' =>$request->alamat,
            'nomor_telpon' =>$request->nomor_telpon,
            'email' =>$request->email,
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        }else{
            FacadesDB::table('users')->where ('id',$id)->update([
                'name' =>$request->name,
                'username' =>$request->username,
                'nama_lengkap' =>$request->nama_lengkap,
                'alamat' =>$request->alamat,
                'nomor_telpon' =>$request->nomor_telpon,
                'email' =>$request->email,
                'updated_at' => \Carbon\Carbon::now(),
        
        ]);
    }
        return redirect()->route('user')->with('message','User Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        FacadesDB::table('users')->where('id', $id)->delete();

        return redirect()->route('user')->with('message','User Berhasil Dihapus');  
      }

      

}