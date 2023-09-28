<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\DB;

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

        return view('backend.user.create');
    }

    public function store(UserRequest $request)
    {

        DB::table('users')->insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('user')->with('message', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $editUser = DB::table('users')->where('id', $id)->first();

        return view('backend.user.edit', compact('editUser'));
    }
    public function update(UserUpdateRequest $request, $id)
    {

        if ($request->password) {
            DB::table('users')
                ->where('id', $id)
                ->update([
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]);
        } else {
            DB::table('users')
                ->where('id', $id)
                ->update([
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                ]);
        }


        return redirect()->route('user')->with('message', 'User Berhasil Diperbarui');
    }


    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('user')->with('message', 'User Berhasil Dihapus');
    }
}
