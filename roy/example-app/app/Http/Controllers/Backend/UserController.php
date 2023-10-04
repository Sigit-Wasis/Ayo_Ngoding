<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        // Queri ini untuk mengambil data users  secara keseluruhan dengan id secara discending (dari id terbesar ke terkecil)
        $users = DB::table('users')->select('users.*')->orderBy('users.id', 'DESC')->paginate(5);
    
        return view('backend.user.index', compact('users'));
    }

    public function create() {
        $roles = Role::pluck('name')->all();
        return view('backend.user.create', compact('roles'));
    }
        
    public function store(UserRequest $request) {
        // DB::table('users')->insert([
        //     'name' => $request->name,
        //     'user_name' => $request->user_name,
        //     'email' => $request->email,
        //     'password' => bcrypt ($request->password), // ini buat enkripsi pasword
        //     'created_at' => \Carbon\Carbon::now(),
        //     'created_at' => \Carbon\Carbon::now(),
        // ]);

        $input = $request->all(); // mengmabil semua value dari from create user
        $user = User::create($input); // menyimpan data user ke dalam database
        $user->assignRole($request->input('roles')); // menghubungkan antara user dangan role dan input

        return redirect()->route('user')->with('message', 'User Berhasil di Simpan');
    }
    public function edit($id) {
        // apa tipe data dari $id ? tipe datanya string dengan value integer, example "8"
        // Menggunakan first karena kita mau ngambil data hanya 1 yang sesuai dengan ID

        $editUser =DB::table('users')->where('id', $id)->first();

        return view('backend.User.edit', compact('editUser'));
    }

    public function update(UserUpdateRequest $request,$id)
     {
        if ($request->password) {
        DB::table('users')->where('id',$id)->update([
            'name' => $request->name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // ini buat enkripsi pasword
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    } else {
    }
        return redirect()->route('user')->with('message', 'User Berhasil di Update');      

    }
    public function destroy($id) {
        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('user')->with('message', 'User Berhasil Dihapus');
    }
}


