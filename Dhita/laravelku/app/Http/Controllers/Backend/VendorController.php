<?php 
 
namespace App\Http\Controllers\Backend; 
 
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateVendorRequest;
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
        $vendor = DB::table('vendor') 
            ->select( 
                'vendor.*', 
                'nama as created_by', 
            ) 
            ->orderBy('vendor.id', 'DESC') 
            ->join('users', 'users.id', 'vendor.created_by') 
            ->paginate(5); 
 
        return view('backend.vendor.index', compact('vendor')); 
    } 
 
    public function create() 
    { 
        return view('backend.vendor.create'); 
    } 
 
    public function store(VendorRequest $request) 
    { 
        DB::table('vendor')->insert([ 
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
        return redirect()->route('vendor.index')->with('message', 'Vendor Berhasil Disimpan!'); 
    } 


    public function destroy($id) 
    { 
        DB::table('vendor')->where('id', $id)->delete(); 
        return redirect()->route('vendor.index')->with('message', 'Jenis Barang Berhasil Dihapus!'); 
    } 


    public function edit($id) 
    { 
        $editVendor = DB::table('vendor')->where('id', $id)->first(); 
 
        if (!$editVendor) { 
            return redirect()->route('vendor.index')->with('error', 'Vendor tidak ditemukan.'); 
        } 
 
        session(['edit' => $editVendor]); 
 
        return view('backend.vendor.edit', compact('editVendor')); 
    } 
 
    public function update(UpdateVendorRequest $request, $id) 
    { 
        DB::table('vendor') 
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
 
        return redirect()->route('vendor.index')->with('message', 'Vendor berhasil diperbarui!'); 
    } 
 
 
}