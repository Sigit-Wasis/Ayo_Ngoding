<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        // Query untuk mengambil data user secara keseluruhan dengan ID secara descending (dari yang terbesar ke yang terkecil)
        $users = DB::table('users')
            ->select('users.*', 'nama_lengkap as created_by')
            ->orderBy('users.id', 'DESC')
            ->paginate(5);

        return view('backend.users.index', compact('users'));
    }

    public function create()
    {
        return view('backend.users.create');
    }

    public function store(UserStoreRequest $request)
    {
        // Validasi request menggunakan UserRequest

        // Memeriksa apakah 'username' ada dalam request
        // Data pengguna baru disimpan dalam tabel 'users'
        DB::table('users')->insert([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('users')->with('message', 'User berhasil disimpan');
    }

    public function edit($id)
    {
        //apa tipe data dari $id ?
        //menggunakan first karena kita mau mengambel hanya satu data yang sesuai dengan id
        $editusers = DB::table('users')->where('id', $id)->first();

        return view('backend.users.edit', compact('editusers'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        
        DB::table('users')
            ->where('id', $id)->update([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'nama_lengkap' => $request->nama_lengkap,
                'alamat' => $request->alamat,
                'nomor_telepon' => $request->nomor_telepon,
                'email' => $request->email,
                'updated_at' => Carbon::now(),
            ]);

        return redirect()->route('users')->with('message', 'users Berhasil disimpan');
    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('users')->with('message', 'users Berhasil dihapus');
    }
}
