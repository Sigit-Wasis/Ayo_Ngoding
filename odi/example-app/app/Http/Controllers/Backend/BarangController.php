<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BarangRequest;
use App\Http\Requests\BarangUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Routing\Controller as BaseController;
use PhpOffice\PhpSpreadsheet\IOFactory;

class BarangController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
         $this->middleware('permission:barang-list|barang-create|barang-edit|barang-delete', ['only' => ['index','store']]);
         $this->middleware('permission:barang-create', ['only' => ['create','store']]);
         $this->middleware('permission:barang-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:barang-delete', ['only' => ['destroy']]);
    }
    
    public function index(Request $request)
    {
        $Barang = FacadesDB::table('barang')->select('barang.*','name as created_by','nama_jenis_barang')
        ->orderBy('barang.id', 'DESC')
        ->where('jenis_barang.id', 'LIKE', "%{$request->jenis_barang}%")
        ->where('nama_barang', 'LIKE', "%{$request->nama_barang}%")
        ->where('kode_barang', 'LIKE', "%{$request->kode_barang}%")
        ->join('jenis_barang', 'jenis_barang.id', 'barang.id_jenis_barang')
        ->join('users','users.id','jenis_barang.created_by')
        ->paginate(5);

        //  dd($Barang);

        $jenisBarang = FacadesDB::table('jenis_barang')->select('id', 'nama_jenis_barang')->get();
        
        //   dd($jenisBarang);
        
        return view ('backend.barang.index', compact('Barang','jenisBarang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisBarang = FacadesDB::table('jenis_barang')->get();
        $vendors = FacadesDB::table('vendor')->select('id', 'nama_perusahaan')->get();

        //Generate kode barang
        $uniqid = uniqid();
        $rand_start = rand(1,5);
        $rand_8_char = substr($uniqid, $rand_start, 8);

        return view('backend.barang.create', compact('jenisBarang', 'rand_8_char', 'vendors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BarangRequest $request)
    {
        $imageName = time().'.'.$request->gambar->extension();
        $request->gambar->move(public_path('asset/image/'),$imageName);
        
        FacadesDB::table('barang')->insert([
            'id_jenis_barang' =>$request->id_jenis_barang,
            'kode_barang' =>$request->kode_barang,
            'nama_barang' =>$request->nama_barang,
            'harga' =>$request->harga,
            'satuan' =>$request->satuan,
            'deskripsi' =>$request->deskripsi,
            'gambar' =>'asset/image/'.$imageName,
            'stok' =>$request->stok,
            'id_vendor' => $request->id_vendor,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ]);

        return redirect()->route('barang')->with('message','Barang Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $detailBarang = FacadesDB::table('barang')
        ->where('barang.id',$id)
        ->select('barang.*', 'name as created_by', 'nama_jenis_barang','nama_perusahaan')
        ->join('jenis_barang', 'jenis_barang.id', 'barang.id_jenis_barang')
        ->join('vendor', 'vendor.id', 'barang.id_vendor')
        ->join('users','users.id','jenis_barang.created_by')
        ->first();

        return view ('backend.barang.show', compact('detailBarang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $editBarang = FacadesDB::table('barang')->select('*')->where('id', $id)->first();
        $jenisBarang = FacadesDB::table('jenis_barang')->select('id', 'nama_jenis_barang')->get(); 
        $vendors = FacadesDB::table('vendor')->select('id', 'nama_perusahaan')->get();

        //Generate kode barang
        $uniqid = uniqid();
        $rand_start = rand(1,5);
        $rand_8_char = substr($uniqid, $rand_start, 8);

        return view('backend.barang.edit', compact('editBarang', 'jenisBarang', 'rand_8_char','vendors'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(BarangUpdateRequest $request, $id)
    {
        if ($request->gambar) {
            // Simpan File Gambar di dalam folder public/assets/image
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('asset/image/'), $imageName);

            $file = FacadesDB::table('barang')->select('gambar')->where('id', $id)->first();

            if (file_exists(public_path($file->gambar))) {
                unlink(public_path($file->gambar));
            }

            // Query insert Data Barang
            FacadesDB::table('barang')->where('id', $id)->update([
                'id_jenis_barang' => $request->id_jenis_barang,
                'nama_barang' => $request->nama_barang,
                'kode_barang' => $request->kode_barang,
                'stok' => $request->stok,
                'harga' => $request->harga,
                'satuan' => $request->satuan,
                'id_vendor' => $request->id_vendor,
                'deskripsi' => $request->deskripsi,
                'gambar' => 'asset/image/'. $imageName,
                'updated_by' => Auth::user()->id,
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        } else {
            // Query insert Data Barang
            FacadesDB::table('barang')->where('id', $id)->update([
                'id_jenis_barang' => $request->id_jenis_barang,
                'nama_barang' => $request->nama_barang,
                'kode_barang' => $request->kode_barang,
                'stok' => $request->stok,
                'harga' => $request->harga,
                'satuan' => $request->satuan,
                'deskripsi' => $request->deskripsi,
                'updated_by' => Auth::user()->id,
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

        return redirect()->route('barang')->with('message', 'Data Barang Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
            if ($id) {
                $file = FacadesDB::table('barang')->select('gambar')->where('id', $id)->first();
    
                if ($file->gambar != "") {
                    if (file_exists(public_path($file->gambar))) {
                        unlink(public_path($file->gambar));
                    }
                }
    
                FacadesDB::table('barang')->where('id', $id)->delete();
        
                return redirect()->route('barang')->with('messages', 'Sukses');
            }
        }

      
    public function import(Request $request)
    {
        $this->validate($request,[ 
            'file_barang'=> 'required|file|mimes:xls,xlsx,csv' 
        ]); 

        $the_file = $request->file('file_barang'); 

        $spreadsheet = IOFactory::load($the_file->getRealPath()); 

        $sheet = $spreadsheet->getActiveSheet(); 
        $row_limit = $sheet->getHighestDataRow(); 
        $row_range = range(2, $row_limit); 
        $startcount = 1; 

        FacadesDB::beginTransaction(); 

        try { 
        foreach ($row_range as $row) {
            try{
                //Generate kode barang
                $bytes = random_bytes(8);
 
                FacadesDB::table('barang')->insert([ 
                    'id_jenis_barang' => $sheet->getCell('A'.$row)->getValue(),
                    'kode_barang' => bin2hex($bytes),
                    'nama_barang' => $sheet->getCell('C'.$row)->getValue(),
                    'harga' => $sheet->getCell('D'.$row)->getValue(),                  
                    'satuan' => $sheet->getCell('E'.$row)->getValue(),                   
                    'deskripsi' => $sheet->getCell('F'.$row)->getValue(),
                    'gambar' =>'-',
                    'stok' => $sheet->getCell('G'.$row)->getValue(),                 
                    'id_vendor' => $sheet->getCell('B'.$row)->getValue(),
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]); 
        

        } catch (\Throwable $th) { 
                continue; 
        } 

        $startcount++; 
        } 
            FacadesDB::commit(); 

            return redirect()->route('barang')->with('message','Data Berhasil Diimport !!!');
        } catch (\Throwable $th) { 
            FacadesDB::rollBack(); 
            return redirect()->back()->with('error', $th->getMessage()); 
        } 
    }
}



        //     public function destroy(string $id)
        // {
        //     if ($id) {
        //         $file = FacadesDB::table('barang')->select('gambar')->where('id', $id)->first();
                
        //         if ($file) {
        //             // Check if 'gambar' property exists and is not empty
        //             if (property_exists($file, 'gambar') && $file->gambar != "") {
        //                 if (file_exists(public_path($file->gambar))) {
        //                     unlink(public_path($file->gambar));
        //                 }
        //             }
        //         }

        //         FacadesDB::table('barang')->where('id', $id)->delete();

        //         return redirect()->route('barang')->with('messages', 'Sukses');
        //     }
        // }

    