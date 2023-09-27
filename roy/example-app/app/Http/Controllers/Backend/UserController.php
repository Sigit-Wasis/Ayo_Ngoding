<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB; // <- tambahkan DB

class UserController extends Controller
{
    public function index() {
        // Queri ini untuk mengambil data users  secara keseluruhan dengan id secara discending (dari id terbesar ke terkecil)
        $users = DB::table('users')->select('users.*')->orderBy('users.id', 'DESC')->paginate(5);
    
        return view('backend.user.index', compact('users'));
    }

    public function create() {
        return view('backend.user.create');
    }
}
