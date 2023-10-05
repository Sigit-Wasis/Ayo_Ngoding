<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function index()
    {
        // query ini untuk mengambil data users secara keseluruhan dengan id secara descending( dari id terbesar ke terkecil )
        $users = DB::table('users')->select('users.*')->orderBy('users.id', 'DESC')
            ->paginate(10);

        return view('backend.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::pluck('name')->all();

        return view('backend.user.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {

        // DB::table('users')->insert([
        //     'name' => $request->name,
        //     'username' => $request->username,
        //     'email' => $request->email,
        //     'password' => bcrypt($request->password),
        // ]);

        $input = $request->all();   // mengambil semua value dari form create user
        $user = User::create($input); //menyimpan data user ke dalam database
        $user->assignRole($request->input('roles')); // menghubungkan antara user dengan role dari inputan

        return redirect()->route('user')->with('message', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // $editUser = DB::table('users')->where('id', $id)->first();
        $editUser = User::find($id);
        $roles = Role::pluck('name')->all();
        $userRole = $editUser->roles->pluck('name')->all();

        return view('backend.user.edit', compact('editUser', 'roles', 'userRole'));
    }
    public function update(UserUpdateRequest $request, $id)
    {

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));


        return redirect()->route('user')->with('message', 'User Berhasil Diperbarui');
    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('user')->with('message', 'User Berhasil Dihapus');
    }
}
