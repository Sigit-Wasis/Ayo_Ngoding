<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\UsersRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\User;


class UserController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    // public function index()
    // {
    //     // Query ini untuk mengambil data pengguna dengan informasi roles
    //     // $userS = DB::table('users')
    //     // ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
    //     // ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
    //     // ->select('users.*', 'users.name as created_by', 'roles.name as role_name')
    //     // ->orderBy('users.id', 'DESC');

    //     $userS = User::with('roles')->paginate(5);

    //     return view('backend.users.index', compact('userS'));
    // }
    public function index()
    {
        $userS = User::with('roles')->paginate(5);

        // Menggunakan metode map untuk membuat alias role_name
        $userS->map(function ($user) {
            $user->role_name = $user->roles->pluck('name')->implode(', ');
            return $user;
        });

        return view('backend.users.index', compact('userS'));
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
        if ($request->has('password') && $request->password) {
            DB::table('users')->where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => bcrypt($request->password), // Menggunakan => bukan =
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            // Atur ulang peran pengguna (roles) jika ada input roles dalam request
            if ($request->has('roles')) {
                $user = User::find($id);
                $user->syncRoles($request->input('roles'));
            }
        } else {
            DB::table('users')->where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            // Atur ulang peran pengguna (roles) jika ada input roles dalam request
            if ($request->has('roles')) {
                $user = User::find($id);
                $user->syncRoles($request->input('roles'));
            }
        }

        return redirect()->route('user')->with('message', 'User berhasil diperbarui!');
    }

    public function edit($id)
    {
        // Mengambil data user yang akan diedit berdasarkan ID menggunakan model User
        $edituser = User::find($id);

        // Mengambil semua roles yang tersedia
        $roles = Role::pluck('name', 'id'); // Menggunakan id sebagai value

        // Mengambil roles yang dimiliki oleh pengguna yang akan diedit
        $userRole = $edituser->roles->pluck('id')->all();

        // Arahkan ke halaman edit dengan data pengguna, roles, dan userRole
        return view('backend.users.edit', compact('edituser', 'roles', 'userRole'));
    }
}
