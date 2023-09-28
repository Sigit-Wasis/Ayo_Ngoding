<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB; // <- TAMBAHKAN DB

class UserController extends Controller
{
    public function index() {
        // query ini untuk mengambil data users secara keseluruhan dengan id secara discending (dari id terbesar ke terkecil)
        $users = DB::table('users')->select('users.*', 'nama_lengkap as created_by')->orderBy('users.id', 'DESC')->paginate(5);

        // dd($jenisBarang);

        return view('backend.user.index', compact('users'));
    }

}
