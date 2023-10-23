<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;



class PengajuanController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:pengajuan-list|pengajuan-create|pengajuan-edit|pengajuan-delete', ['only' => ['index','store']]);
         $this->middleware('permission:pengajuan-create', ['only' => ['create','store']]);
         $this->middleware('permission:pengajuan-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:pengajuan-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Pengajuans = FacadesDB::table('pengajuan')->select('pengajuan.*','username as created_by')
        // ->orderBy('id','DESC')->paginate(5)
        ->orderBy('pengajuan.id', 'DESC')
        ->join('users','users.id','pengajuan.created_by')
        ->paginate(5);

        //  dd($Barang);

        return view ('backend.pengajuan.index', compact('Pengajuans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $Pengajuans = FacadesDB::table('pengajuan')->select('id','tanggal_pengajuan')->get();
        $vendors = FacadesDB::table('vendor')->select('id','nama_perusahaan')->get();
        // $permission = Permission::get();
       
        
        return view ('backend.pengajuan.create', compact('vendors'));
    }
    
    public function getBarangById(Request $request)
    {
        $dataBarang = FacadesDB::table('barang')->select('id','nama_barang')
        ->where ('id_vendor', (int) $request->id_vendor)
        ->get();

        return response()->json($dataBarang);

    }
    public function getHargaStokBarangById(Request $request)
    {
        $hargaStokBarang = FacadesDB::table('barang')->select('stok','harga')
        ->where ('id', $request->id_barang)
        ->first();

        return response()->json($hargaStokBarang);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) 
    { 
        // DB::beginTransaction(); 
 
        // try { 
            
            // Insert ke tr_pengajuan 
            $id_tr_pengajuan = DB::table('pengajuan')->insertGetId([ 
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
                    'created_by' => Auth::user()->id, 
                    'updated_by' => Auth::user()->id,  
                    'created_at' => \Carbon\Carbon::now(), 
                    'updated_at' => \Carbon\Carbon::now(), 
                ]); 
            // UPDATE STOK BARANG 
            DB::table('barang')->where('id', $request->id_barang[$i])->decrement('stok', $request->jumlah_barang[$i]);
                $grandTotal += $request->jumlah_barang[$i] * $request->harga_barang[$i]; 
            } 
 
            DB::table('pengajuan')->where('id', $id_tr_pengajuan)->update([ 
                'grand_total' => $grandTotal 
            ]); 
             
            // DB::commit(); 
 
            return redirect()->route('pengajuan')->with('message', 'Pengajuan Berhasil Diajukan'); 
            // all good 
        // } catch (\Exception $e) { 
        //     DB::rollback(); 
        //     // something went wrong 
        // } 
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Query untuk mengambil data dari pengajuan berdasarkan id pengajuan
        $Pengajuans = FacadesDB::table('pengajuan')
        ->select('pengajuan.*','username as created_by')
        ->where('pengajuan.id', $id)
        ->join('users','users.id','pengajuan.created_by')
        ->first();

        // query untuk mengambil data dari detail pengajuan berdasarkan id pengajuan join ke table barang 
        //dan barang join ke vendor
        $detailBarang = FacadesDB::table('detail_pengajuan')
            ->select('detail_pengajuan.*', 'nama_barang', 'harga', 'gambar', 'satuan', 'deskripsi', 'nama_perusahaan')
            ->join('barang', 'barang.id', 'detail_pengajuan.id_barang')
            ->join('vendor', 'vendor.id', 'barang.id_vendor')
            ->where('detail_pengajuan.id_tr_pengajuan',$id)
            ->get();
    
            return view ('backend.pengajuan.show', compact('detailBarang','Pengajuans'));
        }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         // Query untuk mengambil data dari pengajuan berdasarkan id pengajuan
        $Pengajuans = FacadesDB::table('pengajuan')->select('pengajuan.*','id_barang', 'nama_perusahaan', 'barang.id_vendor as id_vendor')
            ->join('detail_pengajuan','detail_pengajuan.id_tr_pengajuan', 'pengajuan.id' )
            ->join('barang', 'barang.id', 'detail_pengajuan.id_barang')
            ->join('vendor', 'vendor.id', 'barang.id_vendor')
            ->where('pengajuan.id',$id)
            ->first();
 
         // query untuk mengambil data dari detail pengajuan berdasarkan id pengajuan join ke table barang 
         //dan barang join ke vendor
        $detailBarang = FacadesDB::table('detail_pengajuan')
             ->join('pengajuan', 'pengajuan.id', 'detail_pengajuan.id_tr_pengajuan')
             ->select('detail_pengajuan.id as id_detail_pengajuan','id_barang', 'nama_barang', 'harga', 'stok', 'jumlah')
             ->join('barang', 'barang.id', 'detail_pengajuan.id_barang')
             ->where('detail_pengajuan.id_tr_pengajuan',$id)
             ->get();
     
        $vendors = FacadesDB::table('vendor')->select('id','nama_perusahaan')->get();
        $Barang = FacadesDB::table('barang')
            ->where('id_vendor',$Pengajuans->id_vendor)
            ->select('id', 'nama_barang')
            ->get();

        
        return view ('backend.pengajuan.edit', compact('detailBarang','Pengajuans','vendors','Barang'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        FacadesDB::beginTransaction();

            try {
                FacadesDB::table('pengajuan')->where ('id',$id)->update([
                    'tanggal_pengajuan' =>$request->tanggal_pengajuan,
                    'updated_by' => Auth::user()->id,
                    'updated_at' => \Carbon\Carbon::now(),
        
                ]);

                $grandTotal = 0;

                $countData = count ($request->id_barang);

                for ($i=0; $i < $countData; $i++) {

                    if (!isset($request->id_detail_barang[$i])) {
                        FacadesDB::table('detail_pengajuan')->insert([
                            'id_barang' =>$request->id_barang[$i],
                            'jumlah' =>$request->jumlah_barang[$i],
                            'id_tr_pengajuan' =>$id,
                            'total_per_barang' =>$request->jumlah_barang[$i] * $request->harga_barang[$i],
                            'created_by' => Auth::user()->id, 
                            'updated_by' => Auth::user()->id,
                            'created_at' => \Carbon\Carbon::now(),
                            'updated_at' => \Carbon\Carbon::now(),
                        ]);

                        FacadesDB::table('barang')->where('id', $request->id_barang[$i])->decrement('stok', $request->jumlah_barang[$i]);
                        
                    }else{
                        $jumlahSebelumDiupdate = FacadesDB::table('detail_pengajuan')
                        ->where('id_tr_pengajuan',$id)
                        ->where('id_barang', $request->id_barang[$i])->value('jumlah');

                        FacadesDB::table('detail_pengajuan')->where('id', $request->id_detail_barang[$i])->update([
                            'id_barang' =>$request->id_barang[$i],
                            'jumlah' =>$request->jumlah_barang[$i],
                            'id_tr_pengajuan' =>$id,
                            'total_per_barang' =>$request->jumlah_barang[$i] * $request->harga_barang[$i],
                            'created_at' => \Carbon\Carbon::now(),
                            'updated_at' => \Carbon\Carbon::now(),
                        ]);
                        // jika jumlah barang lebih besar dari sebelumnya maka dikurang
                        // contoh awal jumlahnya 5 kemudian di update jadi 8 berarti stok berkurang 
                        if($request->jumlah_barang[$i] > $jumlahSebelumDiupdate) {
                            $counter = $request->jumlah_barang[$i] - $jumlahSebelumDiupdate;

                            $stokSekarang = FacadesDB::table('barang')->where('id', $request->id_barang[$i])->value('stok');

                            // UPDATE STOK BARANG
                            FacadesDB::table('barang')->where('id', $request->id_barang[$i])
                            ->update([
                                'stok' => $stokSekarang - $counter
                            ]);

                        // jika jumlah barang lebih besar dari sebelumnya maka dikurang
                        // contoh awal jumlahnya 5 kemudian di update jadi 8 berarti stok berkurang
                        }elseif ($request->jumlah_barang[$i] < $jumlahSebelumDiupdate) {
                            $counter = $jumlahSebelumDiupdate - $request->jumlah_barang[$i];

                            $stokSekarang = FacadesDB::table('barang')->where('id', $request->id_barang[$i])->value('stok');

                            // UPDATE STOK BARANG
                            FacadesDB::table('barang')->where('id', $request->id_barang[$i])
                            ->update([
                                'stok' => $stokSekarang + $counter
                            ]);

                            // $stokSebelum = FacadesDB::table('barang')->where('id', $request->id_barang[$i])->value('stok');
                            // DB::table('detail_pengajuan')->insert([
                            // 'barang_id' =>$request->id_barang[$i],
                            // 'stok_sebelum' =>$stokSebelum,
                            // 'stok_sesudah' =>$request->jumlah_barang[$i],
                            // 'stok_sekarang' =>$stokSebelum - $request->jumlah_barang[$i],
                            // 'created_at' => \Carbon\Carbon::now(),
                            // 'updated_at' => \Carbon\Carbon::now(),
                            // ]);

                        }else{

                        }
                    }
                    //     }
                    // }
                    // FacadesDB::table('barang')->where('id', $request->id_barang[$i])
                    // ->decrement('stok', $request->jumlah_barang[$i]);

                    $grandTotal += $request->jumlah_barang[$i] * $request->harga_barang[$i];
                }

                FacadesDB::table('pengajuan')->where ('id',$id)->update([
                    'grand_total' => $grandTotal
                ]);

                // return "OKEEE deh";

                FacadesDB::commit();

                return redirect()->route('pengajuan')->with('message', 'Pengajuan Berhasil Diupdate');

            } catch (\Exception $e) {
                FacadesDB::rollback();
                
                return $e->getMessage();
            }
    }    
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        FacadesDB::table('pengajuan')->where('id', $id)->delete();

        return redirect()->route('pengajuan')->with('message','Data Pengajuan Berhasil Dihapus');
    }

    public function destroyBarang($id_barang, $id_pengajuan)
    {
        DB::table('detail_pengajuan')->where('id',$id_barang)->delete();

        $Pengajuans = FacadesDB::table('pengajuan')
        ->select('pengajuan.*','id_barang', 'detail_pengajuan.id  as id_detail_pengajuan', 'nama_perusahaan', 'barang.id_vendor as id_vendor')
            ->join('detail_pengajuan','detail_pengajuan.id_tr_pengajuan', 'pengajuan.id' )
            ->join('barang', 'barang.id', 'detail_pengajuan.id_barang')
            ->join('vendor', 'vendor.id', 'barang.id_vendor')
            ->where('pengajuan.id',$id_pengajuan)
            ->first();
 
         // query untuk mengambil data dari detail pengajuan berdasarkan id pengajuan join ke table barang 
         //dan barang join ke vendor
        $detailBarang = FacadesDB::table('detail_pengajuan')
             ->join('pengajuan', 'pengajuan.id', 'detail_pengajuan.id_tr_pengajuan')
             ->select('detail_pengajuan.id as id_detail_pengajuan','id_barang', 'nama_barang', 'harga', 'stok', 'jumlah')
             ->join('barang', 'barang.id', 'detail_pengajuan.id_barang')
             ->where('detail_pengajuan.id_tr_pengajuan',$id_pengajuan)
             ->get();
     
        $vendors = FacadesDB::table('vendor')->select('id','nama_perusahaan')->get();
        $Barang = FacadesDB::table('barang')
            ->where('id_vendor',$Pengajuans->id_vendor)
            ->select('id', 'nama_barang')
            ->get();

        return redirect()->route('edit_pengajuan',$id_pengajuan)->with([
            'message', 'Barang Berhasil Dihapus',
            'detailBarang' => $detailBarang,
            'Barang' => $Barang,
            'vendors' => $vendors,
            'Pengajuans' => $Pengajuans
        ]);
    }

    public function terimapengajuan($id)
    {
        FacadesDB::table('pengajuan')->where('id', $id)->update([
        'status_pengajuan_ap' => 1 //jika 1 maka diterima
        ]);

        return redirect()->route('show_pengajuan',$id)->with('message','Data Pengajuan Berhasil Diterima');
    }

    public function tolakpengajuan(Request $request, $id)
    {
        $penolakanap = FacadesDB::table('pengajuan')->select('keterangan_ditolak_ap')->where('id', $id)->first();
        $array = [$request->catatan]; 

        // dd($penolakanap->keterangan_ditolak_ap);

        if ($penolakanap->keterangan_ditolak_ap !== "") {
            # code...
            if ($penolakanap->keterangan_ditolak_ap !== null || !empty($penolakanap->keterangan_ditolak_ap)) {
                $penolakanAP = array_merge(json_decode($penolakanap->keterangan_ditolak_ap), $array);
            }
        } else {
            $penolakanAP = $array;
        }
    
        FacadesDB::table('pengajuan')->where('id', $id)->update([
            'status_pengajuan_ap' => 2, // jika 2 maka ditolak
            'keterangan_ditolak_ap' => $penolakanAP, 
        ]);


        return redirect()->route('show_pengajuan',$id)->with('message','Status Pengajuan Berhasil Ditolak');
    }

    public function terimapengajuanvendor($id)
    {
        FacadesDB::table('pengajuan')->where('id', $id)->update([
        'status_pengajuan_vendor' => 1 //jika 1 maka diterima
        ]);

        return redirect()->route('show_pengajuan',$id)->with('message','Data Pengajuan Vendor Berhasil Diterima');
    }

    public function tolakpengajuanvendor(Request $request, $id)
    {
        $penolakanvendor = FacadesDB::table('pengajuan')->select('keterangan_ditolak_vendor')->where('id', $id)->first();
        $array = [$request->catatan]; 

        // dd($penolakanvendor->keterangan_ditolak_vendor);

        if ($penolakanvendor->keterangan_ditolak_vendor !== "") {
            # code...
            if ($penolakanvendor->keterangan_ditolak_vendor !== null || !empty($penolakanvendor->keterangan_ditolak_vendor)) {
                $penolakanVendor = array_merge(json_decode($penolakanvendor->keterangan_ditolak_vendor), $array);
            }
        } else {
            $penolakanVendor = $array;
        }
    
        FacadesDB::table('pengajuan')->where('id', $id)->update([
            'status_pengajuan_vendor' => 2, // jika 2 maka ditolak
            'keterangan_ditolak_vendor' => $penolakanVendor, 
        ]);

        return redirect()->route('show_pengajuan',$id)->with('message','Status Pengajuan Vendor Berhasil Ditolak');
    }
}