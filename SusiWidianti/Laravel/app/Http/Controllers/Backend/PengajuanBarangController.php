<?php

    namespace App\Http\Controllers\Backend;
    
    use App\Http\Controllers\Controller;
    //use App\Http\Requests\UpdateBarangRequest;
    use App\Http\Requests\PengajuanBarangRequest;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    
    class PengajuanBarangController extends Controller
    {
        // function __construct()
        // {
        //      $this->middleware('permission:barang-list|barang-create|barang-edit|barang-delete', ['only' => ['index','store']]);
        //      $this->middleware('permission:barang-create', ['only' => ['create','store']]);
        //      $this->middleware('permission:barang-edit', ['only' => ['edit','update']]);
        //      $this->middleware('permission:barang-delete', ['only' => ['destroy']]);
        // }
        public function index()
        {
            //query ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
            $trBarang = DB::table('tr_pengajuan')
            ->select('tr_pengajuan.*', 'username as created_by')

                ->orderBy('tr_pengajuan.id', 'DESC')
                ->join('users', 'users.id', 'tr_pengajuan.created_by')
                ->paginate(5);
    
            // dd($jenisBarang);
    
            return view('backend.pengajuan.index', compact('trBarang'));
        }
    
        public function create()
        {
            // Ambil daftar vendor
            $vendors = DB::table('vendors')->select('id','nama')->get();
    
        
    
            return view('backend.pengajuan.create', compact('vendors'));
        }

        public function getBarangById(Request $request)
        {
            $databarang = DB::table('mts_barang')->select('id', 'nama_barang')
                ->where('id_vendors', (int) $request->id_vendors)
                ->get();
                
                return response()->json($databarang);
        }
    
        public function getHargaStokBarangById(Request $request)
        {

        $hargaStokBarang = DB::table('mts_barang')->select('Stok', 'harga')
        ->where('id', $request->id_barang)
        ->first();

        return response()->json($hargaStokBarang);

        }
    
    
       
    }