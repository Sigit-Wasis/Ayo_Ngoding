<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserUpdateRequest;
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
    public function index()
    {
        // $users = DB::table('users')->select('users.*')->orderBy('users.id', 'DESC')->paginate(5);
        $users= User::with('roles')->paginate(5);
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
        $input ['password'] = bcrypt($input['password']);
        $user = User::create($input); // menyimpan data user kedalam database
        $user->assignRole($request->input('roles')); // menghubungkan antara user dengan role dengan inputan 

        return redirect()->route('user')->with('message', 'Pengguna berhasil ditambahkan');
    }

    public function edit($id)
    {
        $edituser = User::find($id);
        
        $roles = Role::pluck('name')->all();
        $userRole = $edituser->roles->pluck('name')->all();

        return view('backend.user.edit', compact('edituser','roles','userRole'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $input = $request->all();
        if(!empty($input['password'])){                
            $input['password'] = Hash::make($input['password']);
                    }else{
                        $input = Arr::except($input,array('password'));
                    }
        
                    $user = User::find($id);
                    $user->update($input);
                    DB::table('model_has_roles')->where('model_id',$id)->delete();
        
                    $user->assignRole($request->input('roles'));
        
        return redirect()->route('user')->with('message', 'Pengguna berhasil diupdate');
    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('user')->with('message', 'User berhasil dihapus');
    }
}
