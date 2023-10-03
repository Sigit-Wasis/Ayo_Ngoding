<?php

namespace App\Http\Controllers\Backend;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <- TAMBAHKAN DB

class UserController extends Controller
{
    public function index() {
        // query ini untuk mengambil data users secara keseluruhan dengan id secara discending (dari id terbesar ke terkecil)
        $users = DB::table('users')->select('users.*', 'nama_lengkap as created_by')->orderBy('users.id', 'DESC')->paginate(5);

        // dd($jenisBarang);

        return view('backend.user.index', compact('users'));
    }

    public function create() {
        return view('backend.user.create');
    }

    public function store(UserUpdateRequest $request)
    {
        // Tipe data $request adalah object

        // DD (die dump untuk memeriksa apakahvalue atau rcord didalam variabel $request yang diambil dari form inputan)
        // dd($request->all());

        DB::table('users')->insert([
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat,
            'no_telephone' => $request->no_telephone,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
            'created_at' => \Carbon\Carbon::now(),
            'Updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect()->route('user')->with('message', 'User berhasil di Simpan!');
    }

    public function edit($id)
    {
        // apa tipe data dari $id? STRING
        // Menggunakan first karena kita mau mengambil data hanya 1 yang sesuai dengan ID

        $editUser = DB::table('users')->where('id', $id)->first();

        session(['edit_user' => $editUser]);

        return view('backend.user.edit', compact('editUser'));

        // return redirect()->route('edit_jenis_barang')->with('message', 'Jenis Barang berhasil dihapus');
    }

    public function update(UserUpdateRequest $request, $id)
    {
        // $request->validate([
        //     'username' => 'required',
        //     'nama_lengkap' => 'required',
        //     'alamat' => 'required',
        //     'no_telephone' => 'required',
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);

        DB::table('users')
            ->where('id', $id)->update([
                'username' => $request->username,
                'nama_lengkap' => $request->nama_lengkap,
                'alamat' => $request->alamat,
                'no_telephone' => $request->no_telephone,
                'email' => $request->email,
                'password' => bcrypt($request->password), // ini buat enkripsi password
                'updated_at' => \Carbon\carbon::now(),
            ]);

        return redirect()->route('user')->with('message', 'user berhasil di update');
    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('user')->with('message', 'User berhasil dihapus');
    }

}
