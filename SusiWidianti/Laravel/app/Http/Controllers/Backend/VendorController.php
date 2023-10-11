<?php 
 
namespace App\Http\Controllers\Backend; 
 
use App\Http\Controllers\Controller; 
use App\Http\Requests\VendorRequest; 
use App\Http\Requests\VendorUpdateRequest; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB; 
use Spatie\Permission\Models\Role; 
use App\Models\User; 
 
class VendorController extends Controller 
{ 
    public function index() 
    { 
        $vendors = DB::table('vendors') 
            ->select( 
                'vendors.*', 
                'username as created_by', 
            ) 
            ->orderBy('vendors.id', 'DESC') 
            ->join('users', 'users.id', 'vendors.created_by') 
            ->paginate(5); 
 
        return view('backend.vendor.index', compact('vendors')); 
    } 
 
    public function create() 
    { 
        return view('backend.vendor.create'); 
    } 
 
    public function store(VendorRequest $request) 
    { 
        DB::table('vendors')->insert([ 
            'nama' => $request->nama, 
            'alamat' => $request->alamat, 
            'telphone' => $request->telphone, 
            'email' => $request->email, 
            'kepemilikan' => $request->kepemilikan, 
            'tahun_berdiri' => $request->tahun_berdiri, 
            'created_by' => auth()->user()->id, 
            'updated_by' => auth()->user()->id, 
            'created_at' => \Carbon\Carbon::now(), 
            'updated_at' => \Carbon\Carbon::now(), 
        ]); 
        return redirect()->route('vendor')->with('message', 'Vendor Berhasil Disimpan!'); 
    } 


    public function destroy($id) 
    { 
        DB::table('vendors')->where('id', $id)->delete(); 
        return redirect()->route('vendor')->with('message', 'Jenis Barang Berhasil Dihapus!'); 
    } 


    public function edit($id) 
    { 
        $editVendor = DB::table('vendors')->where('id', $id)->first(); 
 
        if (!$editVendor) { 
            return redirect()->route('vendor')->with('error', 'Vendor tidak ditemukan.'); 
        } 
 
        session(['edit' => $editVendor]); 
 
        return view('backend.vendor.edit', compact('editVendor')); 
    } 
 
    public function update(VendorUpdateRequest $request, $id) 
    { 
        DB::table('vendors') 
            ->where('id', $id) 
            ->update([ 
                'nama' => $request->nama, 
                'alamat' => $request->alamat, 
                'telphone' => $request->telphone, 
                'email' => $request->email, 
                'kepemilikan' => $request->kepemilikan, 
                'tahun_berdiri' => $request->tahun_berdiri, 
                'updated_by' => auth()->user()->id, 
                'updated_at' => \Carbon\Carbon::now(), 
            ]); 
 
        return redirect()->route('vendor')->with('message', 'Vendor berhasil diperbarui!'); 
    } 
 
 
}