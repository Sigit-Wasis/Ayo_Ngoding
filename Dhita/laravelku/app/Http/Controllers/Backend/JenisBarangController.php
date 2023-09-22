<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class JenisBarangController extends Controller
{
    public function index() {
        // query ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
        $jenisBarang = DB::table('mst_jenis_barang')->select('mst_jenis_barang.*', 'nama_lengkap as created_by')->orderBy('mst_jenis_barang.id', 'DESC')
            ->join('users', 'users.id', 'mst_jenis_barang.created_by')
            ->get();

        // dd($jenisBarang);

        return view('backend.home.index', compact('jenisBarang'));
    }
}
