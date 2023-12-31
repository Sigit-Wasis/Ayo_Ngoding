<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BarangStoreRequest;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use function Laravel\Prompts\select;

class BarangController extends Controller
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
        $barangs = DB::table('mst_barang')
            ->select('mst_barang.*', 'name as created_by', 'mst_jenis_barang.nama_barang as nama_jenis_barang')
            ->orderBy('mst_barang.id', 'DESC')
            ->where('mst_jenis_barang.id', 'LIKE', "%{$request->jenis_barang}%")
            ->where('mst_barang.nama_barang', 'LIKE', "%{$request->jenis_barang}%")
            ->where('kode_barang', 'LIKE', "%{$request->jenis_barang}%")
            ->join('mst_jenis_barang', 'mst_jenis_barang.id', 'mst_barang.id_jenis_barang')
            ->join('users', 'users.id', 'mst_barang.created_by')
            ->paginate(5);

        $jenisBarang = DB::table('mst_jenis_barang')->select('id', 'nama_barang')->get();

        return view('backend.barang.index', compact('barangs', 'jenisBarang'));
    }

    public function create()
    {
        $jenisBarang = DB::table('mst_jenis_barang')->select('id', 'nama_barang')->get();

        $uniqid = uniqid();
        $rand_start = rand(1, 5);
        $rand_8_char = substr($uniqid, $rand_start, 8);


        $vendors = DB::table('vendors')->select('id', 'nama')->get();

        return view('backend.barang.create', compact('jenisBarang', 'rand_8_char', 'vendors',));
    }


    public function store(BarangStoreRequest $request)
    {
        // SIMPAN FILE GAMBAR
        $imageName = time() . '.' . $request->gambar_barang->extension();
        $request->gambar_barang->move(public_path('assets/image/'), $imageName);

        // QUERY INSERT DATA BARANG
        DB::table('mst_barang')->insert([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga_barang,
            'satuan' => $request->satuan_barang,
            'deskripsi' => $request->deskripsi_barang,
            'gambar' => 'assets/image/' . $imageName,
            'id_vendor' => $request->vendor,
            'stok_barang' => $request->stok_barang,
            'id_jenis_barang' => $request->id_jenis_barang,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        return redirect()->route('barang.index')->with('message', 'Barang Berhasil Disimpan');
    }

    public function show($id)
    {
        $detailbarang = DB::table('mst_barang')
            ->select('mst_barang.*', 'name as created_by', 'mst_jenis_barang.nama_barang', 'vendors.nama as nama_perusahaan')
            ->where('mst_barang.id', $id)
            ->join('mst_jenis_barang', 'mst_jenis_barang.id', 'mst_barang.id_jenis_barang')
            ->join('vendors', 'vendors.id', 'mst_barang.id_vendor')
            ->join('users', 'users.id', 'mst_barang.created_by')
            ->first();

        return view('backend.barang.show', compact('detailbarang'));
    }

    public function delete($id)
    {

        DB::table('mst_barang')->where('id', $id)->delete();


        return redirect()->route('barang.index')->with('message', 'Barang berhasil dihapus');
    }


    public function edit($id)
    {

        $barang = DB::table('mst_barang')->find($id);


        if (!$barang) {
            return redirect()->route('barang.index')->with('error', 'Barang tidak ditemukan');
        }

        $jenisBarang = DB::table('mst_jenis_barang')->select('id', 'nama_barang')->get();
        $vendors = DB::table('vendors')->select('id', 'nama')->get();
        return view('backend.barang.edit', compact('barang', 'jenisBarang', 'vendors'));
    }
    public function update(Request $request, $id)
    {

        $request->validate([
            'id_jenis_barang' => 'required',
            'kode_barang' => 'required|unique:mst_barang,kode_barang,' . $id,
            'nama_barang' => 'required',
            'harga_barang' => 'required|numeric',
            'satuan_barang' => 'required',
            'deskripsi_barang' => 'required',
            'id_vendor' => 'required',
            'gambar_barang' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'stok_barang' => 'required|numeric',
        ]);

        $barang = DB::table('mst_barang')->where('id', $id)->first();

        if ($request->hasFile('gambar_barang')) {
            $imageName = time() . '.' . $request->gambar_barang->extension();
            $request->gambar_barang->move(public_path('assets/image/'), $imageName);

            if (file_exists(public_path($barang->gambar))) {
                unlink(public_path($barang->gambar));
            }

            $gambarPath = 'assets/image/' . $imageName;
        } else {
            $gambarPath = $barang->gambar;
        }

        DB::table('mst_barang')->where('id', $id)->update([
            'id_jenis_barang' => $request->id_jenis_barang,
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga_barang,
            'satuan' => $request->satuan_barang,
            'deskripsi' => $request->deskripsi_barang,
            'gambar' => $gambarPath,
            'id_vendor' => $request->id_vendor,
            'stok_barang' => $request->stok_barang,
            'updated_at' => now(),
        ]);

        return redirect()->route('barang.index')->with('message', 'Barang berhasil diperbarui');
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file_barang' => 'required|file|mimes:xls,xlsx,csv'
        ]);

        $the_file = $request->file('file_barang');

        $spreadsheet = IOFactory::load($the_file->getRealPath());
        $sheet =  $spreadsheet->getActiveSheet();
        $row_limit = $sheet->getHighestDataRow();
        $row_range = range(2, $row_limit);
        $startcount = 1;

        DB::beginTransaction();

        try {
            foreach ($row_range as $row) {
                try {

                    $uniqid = uniqid();
                    $rand_start = rand(1, 5);
                    $kodeBarang = substr($uniqid, $rand_start, 8);

                    DB::table('mst_barang')->insert([
                        'id_jenis_barang' => $sheet->getCell('A' . $row)->getValue(),
                        'nama_barang' => $sheet->getCell('C' . $row)->getValue(),
                        'kode_barang' => $kodeBarang,
                        'stok_barang' => $sheet->getCell('G' . $row)->getValue(),
                        'harga' => $sheet->getCell('D' . $row)->getValue(),
                        'satuan' => $sheet->getCell('E' . $row)->getValue(),
                        'deskripsi' => $sheet->getCell('F' . $row)->getValue(),
                        'gambar' => '_',
                        'id_vendor' => $sheet->getCell('B' . $row)->getValue(),
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    ]);
                } catch (\Throwable $th) {
                    continue;
                }
                $startcount++;
            }

            DB::commit();

            return redirect()->route('barang')->with('message', 'anjayyy jadi');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage);
        }
    }
}
