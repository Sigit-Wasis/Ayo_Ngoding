<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\vendorUpdateRequest;
use App\Http\Requests\vendorRequest;
use Illuminate\Http\Request;

class vendorController extends Controller
{
    public function index() {
        //query ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
        $vendors = DB::table('vendor')->select('vendor.*', 'name as created_by')
        ->orderBy('users.id', 'DESC')
        ->join('users', 'users.id', 'vendor.created_by')
        ->paginate(5);
    
    
            return view('backend.vendor.index',compact('vendors'));
    }
    public function create () {
        return view ('backend.vendor.create');
        
    }
    public function store(Request $request) {
        DB::table('vendor')->insert([
            'nama_perusahaan' => $request->nama_perusahaan,
            'email' => $request->email,
            'nomot_telepon' => $request->nomor_telepon,
            'kepemilikan' => $request->kepemilikan,
            'tahun_berdiri' => $request->tahun_berdiri,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            
        ]);
        return redirect()->route('vendor')->with('message','vendor Berhasil Disimpan!');

    }
        public function edit($id){
            //apa tipe data dari $id ?
            //menggunakan first karena kita mau ngambil datamhanya 1 yang sesuai dengan ID
            $editvendor = DB::table('vendor')->where('id',$id)->first();
    
            return view('backend.vendor.edit',compact('editvendor'));
        }
    
        public function update(Request $request, $id) {
            DB::table('vendor')->where('id', $id)->update([
            // 'vendor' => $request->vendor,
            'nama_perusahaan' => $request->nama_perusahaan,
            'email' => $request->email,
            'nomot_telepon' => $request->nomor_telepon,
            'kepemilikan' => $request->kepemilikan,
            'tahun_berdiri' => $request->tahun_berdiri,
           
            ]);
            
            return redirect()->route('vendor')->with('message',' Berhasil Disimpan!');
        }

        public function destroy($id) {
            DB::table('vendor')->where('id',$id)->delete();
         
    
         return redirect()->route('vendor')->with('message','Jenis Barang Berhasil Dihapus!');
    
        }
       
        }
