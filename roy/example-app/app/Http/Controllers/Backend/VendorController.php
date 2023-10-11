<?php

namespace App\Http\Controllers\Backend;
use App\Http\Requests\VendorRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\VendorUpdateRequest;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // Queri ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
         $vendors = DB::table('vendor')->select('vendor.*', 'name as created_by')
         ->orderBy('vendor.id', 'DESC')
         ->join('users', 'users.id', 'vendor.created_by')
         ->paginate(5);
     // dd($jenisbarang);

 return view('backend.vendor.index', compact('vendors'));
}

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
            return view('backend.vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendorUpdateRequest $request)
    {
        // Tipe data $request adalah object

        // DD (die dump untuk memeriksa apakah ada value atau record di dalam variable $request yang diambil dari form inputan)
        // dd($request->all());

        DB::table('vendor')->insert([
            'nama_perusahaan' => $request->nama_perusahaan,
            'email' => $request->email,
            'nomor_telpon' => $request->nomor_telpon,
            'kepemilikan' => $request->kepemilikan,
            'tahun_berdiri' => $request->tahun_berdiri,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect()->route('vendor')->with('message', 'Vendor Berhasil Disimpan');
        
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // apa tipe data dari $id ? tipe datanya string dengan value integer, example "8"
        // Menggunakan first karena kita mau ngambil data hanya 1 yang sesuai dengan ID

        $editvendor =DB::table('vendor')->where('id', $id)->first();

        return view('backend.vendor.edit', compact('editvendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VendorRequest $request,$id)
     {
        DB::table('vendor')->where('id',$id)->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'email' => $request->email,
            'nomor_telpon' => $request->nomor_telpon,
            'kepemilikan' => $request->kepemilikan,
            'tahun_berdiri' => $request->tahun_berdiri,
            'updated_by' => 1,
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect()->route('vendor')->with('message', 'Vendor Berhasil di Update'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('vendor')->where('id', $id)->delete();

        return redirect()->route('vendor')->with('message', 'Vendor Berhasil Dihapus');
    }
    
}
