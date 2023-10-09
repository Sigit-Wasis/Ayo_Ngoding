<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Pengajuan_barangController extends Controller
{
    public function index() {
    //query ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
    $pengajuan_barang = DB::table('_t_r__pengajuan')->select('_t_r__pengajuan.*', 'name as created_by')
    ->orderBy('_t_r__pengajuan.id', 'DESC')
    ->join('users', 'users.id', '_t_r__pengajuan.created_by')
    ->paginate(5);


        return view('backend.pengajuan_barang.index',compact('pengajuan_barang'));
    }
}
