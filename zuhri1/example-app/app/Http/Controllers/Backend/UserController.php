<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB; //<-tambahkan DB

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //query ini untuk mengambil data users secara keseluruhan dengan id secara discending (dari id terbesar ke terkecil)
        $users = DB::table('users')->select('users.*')->orderBy('users.id','DESC')->paginate(3);
        
        return view('backend.user.index',compact('users'));   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
