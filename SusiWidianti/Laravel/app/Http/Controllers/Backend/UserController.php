<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        // Query untuk mengambil data user secara keseluruhan dengan ID secara descending (dari yang terbesar ke yang terkecil)
        // $users = DB::table('users')
        //     ->select('users.*', 'nama_lengkap as created_by')
        //     ->orderBy('users.id', 'DESC')
        //     ->paginate(5);
        $users = User::with('roles')->paginate(5);

        return view('backend.users.index', compact('users'));
    }

    public function create()
    {
        $roles =Role::pluck('name')->all();

        return view('backend.users.create', compact('roles'));
    }

    public function store(UserStoreRequest $request)
    {
        // Validasi request menggunakan UserRequest

        // Memeriksa apakah 'username' ada dalam request
        // Data pengguna baru disimpan dalam tabel 'users'
        // DB::table('users')->insert([
        //     'username' => $request->username,
        //     'password' => bcrypt($request->password),
        //     'nama_lengkap' => $request->nama_lengkap,
        //     'alamat' => $request->alamat,
        //     'nomor_telepon' => $request->nomor_telepon,
        //     'email' => $request->email,
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        //]);

        $input =$request->all();        //mengambil semua value dari form created user
        $user=User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users')->with('message', 'User berhasil disimpan');
    }

    public function edit($id)
    {
        //apa tipe data dari $id ?
        //menggunakan first karena kita mau mengambel hanya satu data yang sesuai dengan id
        // $editusers = DB::table('users')->where('id', $id)->first();
        $editusers= User::find($id);
        $roles =Role::pluck('name')->all();
        $userRole = $editusers->roles->pluck('name')->all();

        return view('backend.users.edit', compact('editusers', 'roles', 'userRole'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $input = $request->all();
        if(!empty($input['password'])){$input['password'] = Hash::make($input['password']);
        }else{
             $input = Arr::except($input,array('password'));
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));

        return redirect()->route('users')->with('message', 'users Berhasil disimpan');
    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('users')->with('message', 'users Berhasil dihapus');
    }
}
