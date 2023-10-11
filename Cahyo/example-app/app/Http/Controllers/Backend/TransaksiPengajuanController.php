<?php

    namespace App\Http\Controllers\Backend;
    
    use App\Http\Controllers\Controller;
    use App\Http\Requests\TransaksiPengajuanRequest ;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Spatie\Permission\Models\Role;
    use App\Models\User;
    
    
    class TransaksiPengajuanController extends Controller
    {
        public function index()
        {
            $transaksiPengajuan = DB::table('tr_pengajuan')
                ->select('*')
                ->orderBy('id', 'DESC')
                ->paginate(5);
    
            return view('backend.transaksi_pengajuan.index', compact('transaksiPengajuan'));
        }
    
        public function createPengajuan()
        {
            // Ambil daftar vendor
            $vendors = DB::table('vendors')->get();
    
            // Ambil daftar barang yang sesuai dengan vendor yang dipilih
            $barangPerVendor = [];
    
            foreach ($vendors as $vendor) {
                $barang = DB::table('mst_barang')
                    ->where('id_vendor', $vendor->id)
                    ->get();
    
                $barangPerVendor[$vendor->id] = $barang;
            }
    
            // Mengambil data harga dan satuan untuk setiap barang
            $dataHargaSatuan = [];
    
            foreach ($barangPerVendor as $vendorId => $barangList) {
                foreach ($barangList as $barang) {
                    $barangData = DB::table('mst_barang')
                        ->select('harga', 'stok_barang')
                        ->where('id', $barang->id)
                        ->first();
    
                    $dataHargaSatuan[$vendorId][$barang->id] = [
                        'harga' => $barangData->harga,
                        'stok_barang' => $barangData->stok_barang,
                    ];
                }
            }
    
            return view('backend.transaksi_pengajuan.create', compact('vendors', 'barangPerVendor', 'dataHargaSatuan'));
        }

        public function getBarangById(Request $request)
        {
            $dataBarang = DB::table('mst_barang')->select('id', 'nama_barang')
                ->where('id_vendor', (int) $request->id_vendor)
                ->get();

                return response()->json($dataBarang);
        }    

        public function getHargaStokBarangById (Request $request)
        {
            $hargaStokBarang = DB::table('mst_barang')->select('stok_barang', 'harga')
                ->where('id', (int) $request->id_barang)
                ->first();

                return response()->json($hargaStokBarang);
        }
    
        //tipe data request adalah object
        //DD (die dump untuk memeriksa apakah ada value atau record di dalam variabel $request yang di amabil dari form imputan)
        //dd($request->all());
    
    
        public function storePengajuan(TransaksiPengajuanRequest  $request)
        {
            // Menghitung total per barang berdasarkan jumlah dan harga
            $totalPerBarang = $request->jumlah * $request->harga;
    
            // Menghitung grand total berdasarkan total per barang
            $grandTotal = $totalPerBarang;
    
            // Menyimpan data pengajuan ke dalam tabel _t_r__pengajuan
            $trPengajuanId = DB::table('tr_pengajuan')->insertGetId([
                'tanggal_pengajuan' => $request->tanggal_pengajuan,
                'grand_total' => $grandTotal, // Menyimpan grand total
                'status_pengajuan_ap' =>1, //$request->status_pengajuan_ap,
                'keterangan_ditolak_ap' =>'', //$request->keterangan_ditolak_ap,
                'status_pengajuan_vendor' => 0,//$request->status_pengajuan_vendor,
                'keterangan_ditolak_vendor' => '',//$request->keterangan_ditolak_vendor,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            // Insert data ke dalam tabel detail_pengajuan
            DB::table('detail_pengajuan')->insert([
                'id_barang' => $trPengajuanId, // ID pengajuan yang baru saja disimpan
                'jumlah' => $request->jumlah,
                'total_per_barang' => $totalPerBarang, // Simpan total per barang
                'id_tr_pengajuan' => $trPengajuanId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            // Update stok_barang barang yang sesuai
            DB::table('mst_barang')
                ->where('id', $request->id_barang)
                ->decrement('stok_barang', $request->jumlah); // Pengurangan jumlah stok_barang berdasarkan jumlah yang dipesan
    
            return redirect()->route('tr_pengajuan')->with('message', 'Pengajuan Barang Berhasil Disimpan!');
        }
    }
    

