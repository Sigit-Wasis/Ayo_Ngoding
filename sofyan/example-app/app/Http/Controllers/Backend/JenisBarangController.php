<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class JenisBarangController extends Controller
{
    public function index() {
        // query ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
        $jenisBarang = DB::table('_m_s_t__jenis__barang')->select('_m_s_t__jenis__barang.*','name as created_by')->orderBy('_m_s_t__jenis__barang.id', 'DESC')
        ->join('users','users.id','_m_s_t__jenis__barang.created_by')
        ->get();
        //dd($jenisBarang);

        return view ('backend.home.index', compact('jenisBarang'));

    }
}
