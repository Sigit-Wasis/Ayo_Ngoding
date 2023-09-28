<?php

namespace App\Http\Controllers\Backend;
use App\Http\Requests\UsersRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;

use DB;

class UserController extends Controller
{
     public function index() {
        // query ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
        $userS = DB::table('users')->select('users.*','name as created_by')->orderBy('users.id', 'DESC')
        ->paginate(5);
        
        //dd($jenisBarang);

        return view ('backend.userS.index', compact('userS'));
    }

    public function createUser(){
        return view('backend.users.create');
    }
        //tipe data request adalah object
        //DD (die dump untuk memeriksa apakah ada value atau record di dalam variabel $request yang di amabil dari form imputan)
        //dd($request->all());

     public function userAdd(UsersRequest $request){
        DB::table('users')->insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'username'=>$request->username,
            'password'=>$request->password,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
        ]);
        return redirect()->route('user')->with('message','Users Berhasil Disimpan!');
    }
}
