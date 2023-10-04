<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\UsersRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class UserController extends Controller
{
    public function index()
    {
        // query ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
        $userS = DB::table('users')->select('users.*', 'name as created_by')->orderBy('users.id', 'DESC')
            ->paginate(5);

        //dd($jenisBarang);

        return view('backend.userS.index', compact('userS'));
    }

    public function createUser()
    {
       // $roles = Role::pluck('roles')->all(); //data yang di akses dakam sekala kecil
        $roles = DB::table('roles')->get(); // data yang di akses dalam sekala besar lebih stabil
        // dd($roles);
        return view('backend.users.create', compact('roles'));
    }
    //tipe data request adalah object
    //DD (die dump untuk memeriksa apakah ada value atau record di dalam variabel $request yang di amabil dari form imputan)
    //dd($request->all());

    public function userAdd(UsersRequest $request)
    {
        // DB::table('users')->insert([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'username' => $request->username,
        //     'password' => bcrypt($request->password),
        //     'created_at' => \Carbon\Carbon::now(),
        //     'updated_at' => \Carbon\Carbon::now(),
        // ]);
        $input = $request->all();
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        return redirect()->route('user')->with('message', 'Users Berhasil Disimpan!');
    }

    public function deleteUser($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('user')->with('message', 'User Berhasil Dihapus!');
    }

    public function update(UserUpdateRequest $request, $id)
    {
        // Perbarui password jika password baru dan konfirmasi password cocok
        if ($request->password) {
            DB::table('users')->where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => bcrypt($request->password), // Menggunakan => bukan =
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        } else {
            DB::table('users')->where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

        return redirect()->route('user')->with('message', 'User berhasil diperbarui!');
    }

    public function edit($id)
    {
        // Mengambil data user yang akan diedit berdasarkan ID
        $edituser = DB::table('users')->where('id', $id)->first();
        // Arahkan ke halaman create
        return view('backend.users.edit', compact('edituser'));
    }
}
