<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
//<-tambahkan DB

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //query ini untuk mengambil data users secara keseluruhan dengan id secara discending (dari id terbesar ke terkecil)
        $users = FacadesDB::table('users')->select('users.*')->orderBy('users.id', 'DESC')->paginate(3);

        return view('backend.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()

    {
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        FacadesDB::table('users')->insert([
            'name' => $request->name,
            // 'deskripsi' =>$request->deskripsi,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        return redirect()->route('user')->with('message', 'User Berhasil Disimpan!');
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
        $edituser = FacadesDB::table('users')->where('id', $id)->first();

        return view('backend.user.edit', compact('edituser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        if ($request->password) {

            FacadesDB::table('users')->where('id', $id)->update([
                'name' => $request->name,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'email' => $request->email,
                'updated_at' => \Carbon\Carbon::now(),

            ]);
        } else {
            FacadesDB::table('users')->where('id', $id)->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'updated_at' => \Carbon\Carbon::now(),

            ]);
        }
        return redirect()->route('user')->with('message', 'User Berhasil Disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        FacadesDB::table('users')->where('id', $id)->delete();

        return redirect()->route('user')->with('message', 'User Berhasil Dihapus');
    }
}
