<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function index(){
        // query ini untuk mengambil data users secara keseluruhan dengan id secara descending(dari id terbesar ke terkecil)
        $users = DB::table('users')->select('users.*')->orderBy('users.id','DESC')
        ->paginate(10);

        return view('backend.user.index', compact('users'));
    }
}
