<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function index() {
        // Query ini untuk mengambil data semua pengguna (users) dengan urutan dari id terbesar ke terkecil.
        $users = DB::table('users')->select('users.*')->orderBy('users.id','DESC')->paginate(5);

        return view('backend.user.index', compact('users'));
    }
}
