<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;  // <-tambahkan DB

class UserController extends Controller
{
    public function index() {
        //query ini untuk mengambil data user secara keseluruhan dengan id secara discending(dari yang terbesar ke id yang terkecil)
        $users = DB::table('users')->select('users.*','nama_lengkap as created_by')->orderBy('users.id','DESC')
        ->paginate(5);



        return view ('backend.users.index', compact('users'));
    }

}