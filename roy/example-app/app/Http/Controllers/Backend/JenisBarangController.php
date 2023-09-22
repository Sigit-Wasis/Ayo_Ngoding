<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class JenisBarangController extends Controller
{
    public function index() {
            // Queri ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
            $jenisbarang = DB::table('jenis_barang')->select('jenis_barang.*', 'name as created_by')->orderBy('jenis_barang.id', 'DESC')
                ->join('users', 'users.id', 'jenis_barang.created_by')
                ->get();
            // dd($jenisbarang);

        return view('backend.home.index', compact('jenisbarang'));
    }
}
