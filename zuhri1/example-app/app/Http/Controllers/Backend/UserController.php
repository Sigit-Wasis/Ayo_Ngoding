<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
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
        $roles = Role::pluck('name')->all();

        return view('backend.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        // FacadesDB::table('users')->insert([
        //     'name' => $request->name,
        //     // 'deskripsi' =>$request->deskripsi,
        //     'username' => $request->username,
        //     'password' => bcrypt($request->password),
        //     'email' => $request->email,
        //     'created_at' => \Carbon\Carbon::now(),
        //     'updated_at' => \Carbon\Carbon::now(),

        $input = $request->all(); //mengambil semua value dari from create user
        $User = User::create($input); //menyimpan data user ke dalam database
        $User->assignRole($request->input('roles')); //menghubungkan antara user dengan role dari inputan

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
        // $edituser = FacadesDB::table('users')->where('id', $id)->first();
        $edituser = User::find($id);
        $roles = Role::pluck('name')->all();
        $userRole = $edituser->roles->pluck('name')->all();

        return view('backend.user.edit', compact('edituser', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        FacadesDB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));
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
