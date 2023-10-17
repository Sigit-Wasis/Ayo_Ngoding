<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <- TAMBAHKAN DB
use Spatie\Permission\Contracts\Permission;

class UserController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    
    public function index() {
        // query ini untuk mengambil data users secara keseluruhan dengan id secara discending (dari id terbesar ke terkecil)
        // $users = DB::table('users')->select('users.*', 'nama_lengkap as created_by')->orderBy('users.id', 'DESC')->paginate(5);
        $users = User::with('roles')->paginate(5);
        // dd($jenisBarang);

        return view('backend.user.index', compact('users'));
    }

    public function create() 
    {
        $roles = Role::pluck('name')->all();

        return view('backend.user.create', compact('roles'));
    }

    public function store(UserUpdateRequest $request)
    {

        $input = $request->all(); //mengambil semua value dari form create user
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input); //menyimpan data user ke dalam database
        $user->assignRole($request->input('roles')); //menghubungkan antara user ddengan role dari inputan

        return redirect()->route('user')->with('message', 'User berhasil di Simpan!');
    }

    public function edit($id)
    {
        // apa tipe data dari $id? STRING
        // Menggunakan first karena kita mau mengambil data hanya 1 yang sesuai dengan ID

        $editUser = User::find($id);
        $roles = Role::pluck('name')->all();
        $userRole = $editUser->roles->pluck('name')->all();

        // session(['edit_user' => $editUser]);

        return view('backend.user.edit', compact('editUser','roles', 'userRole'));

        // return redirect()->route('edit_jenis_barang')->with('message', 'Jenis Barang berhasil dihapus');
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $input = $request->all();
        if  (!empty($input['password'])) {
            $input['password'] = bcrypt($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

            $user = User::find($id);
            $user->update($input);
            DB::table('model_has_roles')->where('model_id',$id)->delete();

            $user->assignRole($request->input('roles'));

            return redirect()->route('user')->with('message', 'user berhasil di update');
        }
    
        
        // $request->validate([
        //     'username' => 'required',
        //     'nama_lengkap' => 'required',
        //     'alamat' => 'required',
        //     'no_telephone' => 'required',
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);

        // DB::table('users')
        //     ->where('id', $id)->update([
        //         'username' => $request->username,
        //         'nama_lengkap' => $request->nama_lengkap,
        //         'alamat' => $request->alamat,
        //         'no_telephone' => $request->no_telephone,
        //         'email' => $request->email,
        //         'password' => bcrypt($request->password), // ini buat enkripsi password
        //         'updated_at' => \Carbon\carbon::now(),
        //     ]);

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('user')->with('message', 'User berhasil dihapus');
    }

}
