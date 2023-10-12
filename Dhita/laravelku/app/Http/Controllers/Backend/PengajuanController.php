<?php 
 
namespace App\Http\Controllers\Backend; 
 
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateVendorRequest;
use App\Http\Requests\VendorRequest; 
use App\Http\Requests\VendorUpdateRequest; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role; 
use App\Models\User; 
 
class PengajuanController extends Controller 
{ 
    public function index() 
    { 
        $pengajuan = DB::table('tr_pengajuan') 
            ->select( 
                'tr_pengajuan.*', 
                'users.nama_lengkap as created_by', 
                'detail_pengajuan.total_per_barang as total'
            ) 
            ->orderBy('tr_pengajuan.id', 'DESC') 
            ->join('users', 'users.id', 'tr_pengajuan.created_by') 
            ->join('detail_pengajuan', 'tr_pengajuan.id', 'detail_pengajuan.id_tr_pengajuan') 
            ->paginate(5); 
 
        return view('backend.pengajuan.index', compact('pengajuan')); 
    } 
 
    public function create() 
    { 
        $vendors = DB::table('vendor')->select('id', 'nama')->get();

        return view('backend.pengajuan.create', compact('vendors')); 
    } 

    public function getBarangById(Request $request) 
    { 
        $dataBarang = DB::table('mst_barang')->select('id', 'nama_barang')
            ->where('id_vendor',(int) $request->id_vendor)
            ->get();

        return response()->json($dataBarang); 
    } 

    public function getHargaStokBarangById(Request $request) 
    { 
        $hargaStokBarang = DB::table('mst_barang')->select('stok_barang', 'harga')
            ->where('id',(int) $request->id_barang)
            ->first();

        return response()->json($hargaStokBarang); 
    } 
    
 
    public function store(Request $request) 
    { 
        DB::beginTransaction(); 
 
        try { 
            
            // Insert ke tr_pengajuan 
            $id_tr_pengajuan = DB::table('tr_pengajuan')->insertGetId([ 
                'tanggal_pengajuan' => $request->tanggal_pengajuan, 
                'grand_total' => 0, 
                'status_pengajuan_ap' => 0, 
                'keterangan_ditolak_ap' => '', 
                'status_pengajuan_vendor' => 0, 
                'keterangan_ditolak_vendor' => '', 
                'created_by' => Auth::user()->id, 
                'updated_by' => Auth::user()->id, 
                'created_at' => \Carbon\Carbon::now(), 
                'updated_at' => \Carbon\Carbon::now(), 
            ]); 
 
            $grandTotal = 0; 
 
            $countData = count($request->id_barang); 
            for ($i=0; $i < $countData; $i++) {  
                DB::table('detail_pengajuan')->insert([ 
                    'id_barang' => $request->id_barang[$i], 
                    'jumlah' => $request->jumlah_barang[$i], 
                    'id_tr_pengajuan' => $id_tr_pengajuan, 
                    'total_per_barang' => $request->jumlah_barang[$i] * $request->harga_barang[$i], 
                    'created_at' => \Carbon\Carbon::now(), 
                    'updated_at' => \Carbon\Carbon::now(), 
                ]); 
 
                $grandTotal += $request->jumlah_barang[$i] * $request->harga_barang[$i]; 
            } 
 
            DB::table('tr_pengajuan')->where('id', $id_tr_pengajuan)->update([ 
                'grand_total' => $grandTotal 
            ]); 
             
            DB::commit(); 
 
            return redirect()->route('pengajuan.index')->with('message', 'Pengajuan Berhasil Diajukan'); 
            // all good 
        } catch (\Exception $e) { 
            DB::rollback(); 
            // something went wrong 
        } 
    }
 
}