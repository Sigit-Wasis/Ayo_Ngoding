<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BarangStoreRequest;
use App\Http\Requests\BarangUpdateRequest;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DataBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:barang-list|barang-create|barang-edit|barang-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:barang-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:barang-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:barang-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {


        // Queri ini untuk mengambil data jenis barang secara keseluruhan dengan id secara discending
        $barangs = DB::table('mst_barang')->select('mst_barang.*', 'name as created_by', 'jenis_barang.nama_barang as nama_jenis_barang')
            ->where('mst_barang.id', 'LIKE', "%{$request->jenis_barang}%")
            ->where('mst_barang.nama_barang', 'LIKE', "%{$request->nama_barang}%")
            ->where('kode_barang', 'LIKE', "%{$request->kode_barang}%")
            ->orderBy('mst_barang.id', 'DESC')
            ->join('jenis_barang', 'jenis_barang.id', 'mst_barang.id_jenis_barang')
            ->join('users', 'users.id', 'mst_barang.created_by')
            ->paginate(5);

        $jenisBarang = DB::table('jenis_barang')->select('id', 'nama_barang')->get();

        return view('backend.barang.index', compact('barangs', 'jenisBarang'));
    }


    public function create()
    {
        // Query ini fungsinya untuk mengambil jenis barang yang nantinya akan di looping pada view create.blade.php
        $jenisbarang = DB::table('jenis_barang')->select('id', 'nama_barang')->get();
        $vendors = DB::table('vendor')->select('id', 'nama_perusahaan')->get();
        // Generate Kode Barang
        $uniqid = uniqid();
        $rand_start = rand(1, 5);
        $rand_8_char = substr($uniqid, $rand_start, 8);

        return view('backend.barang.create', compact('jenisbarang', 'rand_8_char', 'vendors'));
    }

    public function store(BarangStoreRequest $request)
    {
        // simpan file gambar
        $imageName = time() . '.' . $request->gambar_barang->extension();
        $request->gambar_barang->move(public_path('assets/image/'), $imageName);


        // query insert data barang
        DB::table('mst_barang')->insert([
            'id_jenis_barang' => $request->id_jenis_barang,
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'satuan' => $request->satuan,
            'deskripsi' => $request->deskripsi,
            'gambar' => 'assets/image/' . $imageName,
            'id_vendor' => $request->id_vendor,
            'stok_barang' => $request->stok_barang,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            'created_at' => \carbon\Carbon::now(),
            'updated_at' => \carbon\Carbon::now(),

        ]);

        return redirect()->route('barang')->with('messages', 'Data Barang Berhasil Disimpan');
    }
    public function show($id)
    {
        $detailbarang = DB::table('mst_barang')->select('mst_barang.*', 'name as created_by', 'mst_barang.nama_barang as nama_jenis_barang',  'nama_perusahaan')
            ->where('mst_barang.id', $id) // tambahin where dimana id barang itu sesuai dengan yang dipilih
            ->join('jenis_barang', 'jenis_barang.id', 'mst_barang.id_jenis_barang',)
            ->join('vendor', 'vendor.id', 'mst_barang.id_vendor')
            ->join('users', 'users.id', 'mst_barang.created_by')
            ->first(); // dari paginate ganti jadi first()

        return view('backend.barang.show', compact('detailbarang'));
    }

    public function destroy($id)
    {
        if ($id) {
            $file = DB::table('mst_barang')->select('gambar')->where('id', $id)->first();

            if ($file->gambar != "") {
                if (file_exists(public_path($file->gambar))) {
                    unlink(public_path($file->gambar));
                }
            }

            DB::table('mst_barang')->where('id', $id)->delete();

            return redirect()->route('barang')->with('messages', 'Sukses');
        }
    }


    public function edit($id)
    {
        $editBarang = DB::table('mst_barang')->select('*')->where('id', $id)->first();
        $jenisBarang = DB::table('jenis_barang')->select('id', 'nama_barang')->get();
        $vendors = DB::table('vendor')->select('id', 'nama_perusahaan')->get();

        return view('backend.barang.edit', compact('editBarang', 'jenisBarang', 'vendors'));
    }

    public function update(BarangUpdateRequest $request, $id)
    {
        if ($request->gambar_barang) {
            // Simpan File Gambar di dalam folder public/assets/image
            $imageName = time() . '.' . $request->gambar_barang->extension();
            $request->gambar_barang->move(public_path('assets/image/'), $imageName);

            $file = DB::table('mst_barang')->select('gambar')->where('id', $id)->first();

            if (file_exists(public_path($file->gambar))) {
                unlink(public_path($file->gambar));
            }

            // Query insert Data Barang
            DB::table('mst_barang')->where('id', $id)->update([
                'id_jenis_barang' => $request->id_jenis_barang,
                'nama_barang' => $request->nama_barang,
                'kode_barang' => $request->kode_barang,
                'stok_barang' => $request->stok_barang,
                'harga' => $request->harga,
                'satuan' => $request->satuan,
                'deskripsi' => $request->deskripsi,
                'gambar' => 'assets/image/' . $imageName,
                'updated_by' => Auth::user()->id,
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        } else {
            // Query insert Data Barang
            DB::table('mst_barang')->where('id', $id)->update([
                'id_jenis_barang' => $request->id_jenis_barang,
                'nama_barang' => $request->nama_barang,
                'kode_barang' => $request->kode_barang,
                'stok_barang' => $request->stok_barang,
                'harga' => $request->harga,
                'satuan' => $request->satuan,
                'deskripsi' => $request->deskripsi,
                'updated_by' => Auth::user()->id,
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

        return redirect()->route('barang')->with('messages', 'Data Barang Berhasil Diupdate');
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file_barang' => 'required|file|mimes:xls,xlsx,csv'
        ]);

        $the_file = $request->file('file_barang');

        $spreadsheet = IOfactory::load($the_file->getRealPath());
        $sheet = $spreadsheet->getActivesheet();
        $row_limit = $sheet->getHighestDataRow();
        $row_range = range(2, $row_limit);
        $starcount = 1;

        DB::beginTransaction();

        try {
            foreach ($row_range as $row) {
                try {
                    // Generate Kode Barang
                    $uniqid = uniqid();
                    $rand_start = rand(1, 5);
                    $kodeBarang = substr($uniqid, $rand_start, 8);

                    DB::table('mst_barang')->insert([
                        'id_jenis_barang' => $sheet->getCell('A' . $row)->getValue(),
                        'kode_barang' => $kodeBarang,
                        'nama_barang' => $sheet->getCell('C' . $row)->getValue(),
                        'harga' => $sheet->getCell('D' . $row)->getValue(),
                        'satuan' => $sheet->getCell('E' . $row)->getValue(),
                        'deskripsi' => $sheet->getCell('F' . $row)->getValue(),
                        'gambar' => '-',
                        'id_vendor' => $sheet->getCell('B' . $row)->getValue(),
                        'stok_barang' => $sheet->getCell('G' . $row)->getValue(),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                        'created_at' => \carbon\Carbon::now(),
                        'updated_at' => \carbon\Carbon::now(),
                    ]);
                } catch (\Throwable $th) {
                    continue;
                }

                $starcount++;
            }

            DB::commit();

            return redirect()->route('barang')->with('message', 'Jadi dong!!!');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
