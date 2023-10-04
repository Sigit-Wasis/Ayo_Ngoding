<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserUpdateRequest;
use App\Models\user;


class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->select('users.*')->orderBy('users.id', 'DESC')->paginate(5);

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
        //     'email' => $request->email,
        //     'password' => bcrypt($request->password),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
        $input = $request->all(); //mengambil semua value dari form create user
        $user = User::create($input); // menyimpan data user kedalam database
        $user->assignRole($request->input('roles')); // menghubungkan antara user dengan role dengan inputan 

        return redirect()->route('user')->with('message', 'Pengguna berhasil ditambahkan');
    }

    public function edit($id)
    {
        $edituser = DB::table('users')->where('id', $id)->first();
        return view('backend.user.edit', compact('edituser'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        if ($request->password){
        DB::table('users')->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),

            'updated_at' => now(),
        ]);
    } else {
        DB::table('users')->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
        return redirect()->route('user')->with('message', 'Pengguna berhasil diupdate');
    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('user')->with('message', 'User berhasil dihapus');
    }
}
