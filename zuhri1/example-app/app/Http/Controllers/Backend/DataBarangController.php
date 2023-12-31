<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BarangStoreRequest;
use App\Http\Requests\BarangUpdateRequest;
use Database\Seeders\jenis_barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

use Illuminate\Routing\Controller as BaseController;

class DataBarangController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:barang-list|barang-create|barang-edit|barang-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:barang-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:barang-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:barang-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {

        $DataBarang = DB::table('barang')->select('barang.*', 'name as created_by', 'nama_jenis_barang')
            ->orderBy('barang.id', 'DESC')
            ->where('jenis_barang.id', 'LIKE', "%{$request->jenis_barang}%")
            ->where('nama_barang', 'LIKE', "%{$request->nama_barang}%")
            ->where('kode_barang', 'LIKE', "%{$request->nama_barang}%")
            ->join('users', 'users.id', 'barang.created_by')
            ->join('jenis_barang', 'jenis_barang.id', 'barang.id_jenis_barang')
            ->paginate(10);

        $jenisBarang = DB::table('jenis_barang')->select('id', 'nama_jenis_barang')->get();
        // dd($DataBarang);

        return view('backend.barang.index', compact('DataBarang', 'jenisBarang'));
    }
    public function create()
    {
        //Query ini fungsinnya untuk mengambil jenis barang yang nantinnya akan di looping pada view create.blade.php
        $jenisBarang = DB::table('jenis_barang')->get();
        $vendors = DB::table('vendor')->select('id', 'nama_perusahaan')->get();

        //Generate kode barang
        $uniqid = uniqid();
        $rand_start = rand(1, 5);
        $rand_8_char = substr($uniqid, $rand_start, 8);

        return view('backend.barang.create', compact('jenisBarang', 'rand_8_char', 'vendors'));
    }

    public function edit($id)
    {

        $editBarang = DB::table('barang')->where('id', $id)->first();
        $jenisBarang = DB::table('jenis_barang')->get();
        $vendors = DB::table('vendor')->select('id', 'nama_perusahaan')->get();

        //Generate kode barang
        $uniqid = uniqid();
        $rand_start = rand(1, 5);
        $rand_8_char = substr($uniqid, $rand_start, 8);

        return view('backend.barang.editt', compact('editBarang', 'jenisBarang', 'rand_8_char', 'vendors'));
    }

    public function update(BarangUpdateRequest $request, $id)
    {
        if ($request->gambar) {
            // Simpan File Gambar di dalam folder public/assets/image
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('assets/image/'), $imageName);

            $file = DB::table('barang')->select('gambar')->where('id', $id)->first();

            if (file_exists(public_path($file->gambar))) {
                unlink(public_path($file->gambar));
            }

            // Query insert Data Barang
            DB::table('barang')->where('id', $id)->update([
                'id_jenis_barang' => $request->id_jenis_barang,
                'nama_barang' => $request->nama_barang,
                'kode_barang' => $request->kode_barang,
                'stok' => $request->stok,
                'harga' => $request->harga,
                'satuan' => $request->satuan,
                'deskripsi' => $request->deskripsi,
                'gambar' => 'assets/image/' . $imageName,
                'id_vendor' => $request->id_vendor,
                'updated_by' => Auth::user()->id,
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        } else {
            // Query insert Data Barang
            DB::table('barang')->where('id', $id)->update([
                'id_jenis_barang' => $request->id_jenis_barang,
                'nama_barang' => $request->nama_barang,
                'kode_barang' => $request->kode_barang,
                'stok' => $request->stok,
                'harga' => $request->harga,
                'satuan' => $request->satuan,
                'deskripsi' => $request->deskripsi,
                'id_vendor' => $request->id_vendor,
                'updated_by' => Auth::user()->id,
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

        return redirect()->route('DataBarang')->with('messages', 'Data Barang Berhasil Diupdate');
    }

    public function store(BarangStoreRequest $request)

    {
        // dd($request->all());
        // simpan file gambar
        $imageName = time() . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('assets/image/'), $imageName);

        //query insert data barang

        DB::table('barang')->insert([
            'id_jenis_barang' => $request->id_jenis_barang,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'kode_barang' => $request->kode_barang,
            'satuan' => $request->satuan,
            'deskripsi' => $request->deskripsi,
            'gambar' => 'assets/image/' . $imageName,
            'id_vendor' => $request->id_vendor,
            'stok' => $request->stok,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),


        ]);

        return redirect()->route('DataBarang')->with('message', 'Barang Berhasil Disimpan!');
    }
    public function show($id)
    {
        $detailBarang = DB::table('barang')->select('barang.*', 'name as created_by', 'nama_jenis_barang', 'nama_perusahaan')
            ->where('barang.id', $id) //tambahin where dimana id barang itu sesuai dengan yang dipilih
            ->join('users', 'users.id', 'barang.created_by')
            ->join('jenis_barang', 'jenis_barang.id', 'barang.id_jenis_barang')
            ->join('vendor', 'vendor.id', 'barang.id_vendor')
            ->first();



        return view('backend.barang.show', compact('detailBarang'));
    }
    public function destroy($id)
    {
        if ($id) {
            $file = DB::table('barang')->select('gambar')->where('id', $id)->first();

            if ($file->gambar != "") {
                if (file_exists(public_path($file->gambar))) {
                    unlink(public_path($file->gambar));
                }
            }

            DB::table('barang')->where('id', $id)->delete();

            return redirect()->route('DataBarang')->with('messages', 'Sukses');
        }
    }
    public function import(Request $request)
    {
        $this->validate($request, [
            'file_barang' => 'required|file|mimes:xls,xlsx,csv'
        ]);

        $the_file = $request->file('file_barang');

        $spreadsheet = IOFactory::load($the_file->getRealPath());

        $sheet = $spreadsheet->getActiveSheet();
        $row_limit = $sheet->getHighestDataRow();
        $row_range = range(2, $row_limit);
        $startcount = 1;

        DB::beginTransaction();

        try {
            foreach ($row_range as $row) {
                try {
                    //Generate kode barang
                    $uniqid = uniqid();
                    $rand_start = rand(1, 5);
                    $kodeBarang = substr($uniqid, $rand_start, 8);

                    DB::table('barang')->insert([
                        'id_jenis_barang' => $sheet->getCell('A' . $row)->getValue(),
                        'nama_barang' => $sheet->getCell('C' . $row)->getValue(),
                        'harga' =>  $sheet->getCell('D' . $row)->getValue(),
                        'kode_barang' =>  $kodeBarang,
                        'satuan' =>  $sheet->getCell('E' . $row)->getValue(),
                        'deskripsi' =>  $sheet->getCell('F' . $row)->getValue(),
                        'gambar' => '_',
                        'id_vendor' => $sheet->getCell('B' . $row)->getValue(),
                        'stok' => $sheet->getCell('G' . $row)->getValue(),
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
            DB::commit();

            return redirect()->route('barang')->with('message','jadi dong !!!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
