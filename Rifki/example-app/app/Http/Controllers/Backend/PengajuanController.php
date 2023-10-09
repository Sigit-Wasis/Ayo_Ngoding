<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuan = DB::table('tr_pengajuan')
        ->select('tr_pengajuan.*', 'name as created_by')
        ->orderBy('tr_pengajuan.id', 'DESC')
        ->join('users', 'users.id', 'tr_pengajuan.created_by')
        ->paginate(3);

    return view('backend.pengajuan.index', compact('pengajuan'));
    }

    public function create()
    {
        return view('backend.pengajuan.create');
    }
    

    public function store(Request $request)
    {
        // Your code for storing Pengajuan data
    }

    public function show($id)
    {
        // Your code for displaying a single Pengajuan
    }

    public function edit($id)
    {
        // Your code for displaying the edit page for Pengajuan
    }

    public function update(Request $request, $id)
    {
        // Your code for updating Pengajuan data
    }

    public function destroy($id)
    {
        // Your code for deleting a Pengajuan
    }
}
