<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiPengajuanController extends Controller
    {
        public function index()
        {
            $transaksi_pengajuan = DB::table('tr_pengajuan')
            ->select('tr_pengajuan.*', 'name as created_by')
            ->orderBy('tr_pengajuan.id', 'DESC')
            ->join('users', 'users.id', 'tr_pengajuan.created_by')
            ->paginate(3);
            
            return view('backend.transaksi_pengajuan.index', compact('transaksi_pengajuan'));
        }
    
        public function create()
        {
            return view('transaksi_pengajuan.create');
        }
    
    }
    

