<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BarangRequest;
use App\Http\Requests\BarangUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DataBarangController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:data_barang-list|data_barang-create|data_barang-edit|data_barang-delete', ['only' => ['index', 'barangAdd']]);
        $this->middleware('permission:data_barang-create', ['only' => ['createBarang', 'barangAdd']]);
        $this->middleware('permission:data_barang-edit', ['only' => ['editBarang', 'updateBarang']]);
        $this->middleware('permission:data_barang-delete', ['only' => ['deleteBarang']]);
    }

    public function index(Request $request)
    {
        $dataBarang = DB::table('_m_s_t__barang')
            ->select(
                '_m_s_t__barang.*',
                'users.name as created_by',
                '_m_s_t__jenis__barang.nama as jenis' // Ubah menjadi 'nama' sesuai dengan alias yang Anda berikan
            )
            ->where('_m_s_t__jenis__barang.id', 'LIKE', "%{$request->jenis_barang}%")
            ->where('_m_s_t__barang.nama_barang', 'LIKE', "%{$request->nama_barang}%")
            ->where('_m_s_t__barang.kode_barang', 'LIKE', "%{$request->kode_barang}%")
            ->orderBy('_m_s_t__barang.id', 'DESC')
            ->join('users', 'users.id', '_m_s_t__barang.created_by')
            ->join('_m_s_t__jenis__barang', '_m_s_t__jenis__barang.id', '_m_s_t__barang.Id_jenis_barang') // Sesuaikan dengan kolom yang sesuai
            ->paginate(5);

        $searchBarang = DB::table('_m_s_t__jenis__barang')->select('id', 'nama')->get();

        return view('backend.data_barang.index', compact('dataBarang', 'searchBarang'));
    }

    public function createBarang()
    {
        // Mengambil data jenis barang dari tabel _m_s_t__jenis__barang
        $jenisBarang = DB::table('_m_s_t__jenis__barang')->get();
        $vendorName = DB::table('vendors')->get();

        // Menghitung jumlah total barang yang ada
        $totalBarang = DB::table('_m_s_t__barang')->count();

        // Membuat kode barang otomatis dengan format 'BRG-0001', 'BRG-0002', dst.
        $kodeBarang = 'BRG-' . str_pad($totalBarang + 1, 4, '0', STR_PAD_LEFT);

        return view('backend.data_barang.create', compact('jenisBarang', 'kodeBarang', 'vendorName'));
    }
    //tipe data request adalah object
    //DD (die dump untuk memeriksa apakah ada value atau record di dalam variabel $request yang di amabil dari form imputan)
    //dd($request->all());

    public function barangAdd(BarangRequest $request)
    {
        // dd($request->all());
        // Menghitung jumlah total barang yang ada
        $totalBarang = DB::table('_m_s_t__barang')->count();

        // Membuat kode barang otomatis dengan format 'BRG-0001', 'BRG-0002', dst.
        $kodeBarang = 'BRG-' . str_pad($totalBarang + 1, 4, '0', STR_PAD_LEFT);

        // Inisialisasi variabel untuk menyimpan nama file gambar
        $imageName = null;

        // Store the uploaded image in the public folder
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/dist/img'), $imageName); // Update the destination path to 'public'
        }

        // Menyimpan data barang dengan kode barang otomatis
        DB::table('_m_s_t__barang')->insert([
            'Id_jenis_barang' => $request->jenis_barang, // Gunakan jenis_barang sesuai dengan form input
            'Id_vendor' => $request->vendor_id,
            'kode_barang' => $kodeBarang, // Gunakan kode barang otomatis
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'satuan' => $request->satuan,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'image' => $imageName, // Simpan nama gambar ke database
            'created_by' => auth()->user()->id, // Menggunakan ID pengguna yang sedang login
            'updated_by' => auth()->user()->id, // Menggunakan ID pengguna yang sedang login
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect()->route('data_barang')->with('message', 'Barang Berhasil Disimpan!');
    }

    public function deleteBarang($id)
    {
        // Ambil nama file gambar yang akan dihapus
        $imageName = DB::table('_m_s_t__barang')->where('id', $id)->value('image');

        // Hapus gambar dari direktori jika ada
        if ($imageName) {
            $imagePath = public_path('assets/dist/img') . '/' . $imageName;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Hapus data barang dari database
        DB::table('_m_s_t__barang')->where('id', $id)->delete();

        return redirect()->route('data_barang')->with('message', 'Barang berhasil dihapus!');
    }

    public function editBarang($id)
    {
        // Mengambil data barang yang akan diedit berdasarkan ID
        $editBarang = DB::table('_m_s_t__barang')->where('id', $id)->first();

        if (!$editBarang) {
            return redirect()->route('data_barang')->with('error', 'Barang tidak ditemukan.');
        }


        // Ambil data jenis barang untuk dropdown
        $jenisBarang = DB::table('_m_s_t__jenis__barang')->get();

        // Mengambil data vendor untuk dropdown
        $vendorNames = DB::table('vendors')->get(); // Ganti variabel $vendorname menjadi $vendorName

        // Simpan data barang, jenis barang, dan vendor ke dalam sesi
        session(['edit_barang' => $editBarang]);

        // Arahkan ke halaman edit dengan membawa data jenis barang dan vendor
        return view('backend.data_barang.edit', compact('editBarang', 'jenisBarang', 'vendorNames')); // Ganti variabel $vendorname menjadi $vendorName
    }

    public function updateBarang(BarangUpdateRequest $request, $id)
    {
        // Ambil data dari request
        $data = [
            'Id_jenis_barang' => $request->jenis_barang,
            'Id_vendor' => $request->vendor_id,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'satuan' => $request->satuan,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
        ];

        // Jika ada file gambar yang diunggah, proses dan simpan ke dalam direktori
        if ($request->hasFile('image')) {
            // Ambil nama file gambar lama (jika ada)
            $oldImageName = DB::table('_m_s_t__barang')->where('id', $id)->value('image');

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/dist/img'), $imageName);

            // Hapus gambar lama jika ada
            if ($oldImageName) {
                $oldImagePath = public_path('assets/dist/img') . '/' . $oldImageName;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Simpan nama gambar ke dalam database
            $data['image'] = $imageName;
        }

        // Lakukan pembaruan data di database berdasarkan ID
        DB::table('_m_s_t__barang')
            ->where('id', $id)
            ->update($data);

        return redirect()->route('data_barang')->with('message', 'Barang berhasil diperbarui!');
    }

    public function detailBarang($id)
    {
        $detailBarang = DB::table('_m_s_t__barang')
            ->select(
                '_m_s_t__barang.*',
                'users.name as created_by',
                'users.name as updated_by',
                'vendors.nama as vendor_nama',
                '_m_s_t__jenis__barang.nama as jenis_barang' // Ubah menjadi 'nama' sesuai dengan alias yang Anda berikan
            )
            ->join('users', 'users.id', '_m_s_t__barang.created_by')
            ->join('vendors', 'vendors.id', '_m_s_t__barang.Id_vendor')
            ->join('_m_s_t__jenis__barang', '_m_s_t__jenis__barang.id', '_m_s_t__barang.Id_jenis_barang')
            ->where('_m_s_t__barang.id', $id) // Filter berdasarkan ID yang diberikan
            ->first(); // Ambil hasil pertama saja

        //dd($detailBarang);
        return view('backend.data_barang.detail_barang', compact('detailBarang'));
    }
    public function importBarang(Request $request)
    {
        $request->validate([
            'inportBarang' => 'required|file|mimes:xls,xlsx',
        ]);

        $file = $request->file('inportBarang');

        $spreadsheet = IOFactory::load($file->getRealPath());
        $worksheet = $spreadsheet->getActiveSheet();
        $row_limit = $worksheet->getHighestDataRow();
        $row_range = range(2, $row_limit);
        $startCount = 1;

        DB::beginTransaction();

        try {
            $totalBarang = DB::table('_m_s_t__barang')->count();
            $kodeBarang = 'BRG-' . str_pad($totalBarang + 1, 4, '0', STR_PAD_LEFT);

            foreach ($row_range as $rowIndex) {
                try {
                    DB::table('_m_s_t__barang')->insert([
                        'Id_jenis_barang' => $worksheet->getCell('A' . $rowIndex)->getValue(),
                        'Id_vendor' => $worksheet->getCell('B' . $rowIndex)->getValue(),
                        'kode_barang' => $kodeBarang,
                        'nama_barang' => $worksheet->getCell('C' . $rowIndex)->getValue(),
                        'harga' => $worksheet->getCell('D' . $rowIndex)->getValue(),
                        'satuan' => $worksheet->getCell('E' . $rowIndex)->getValue(),
                        'deskripsi' => $worksheet->getCell('F' . $rowIndex)->getValue(),
                        'stok' => $worksheet->getCell('G' . $rowIndex)->getValue(),
                        'image' => '-', // Sesuaikan jika Anda ingin menangani gambar
                        'created_by' => auth()->user()->id, // Sesuaikan dengan informasi pengguna yang sesuai
                        'updated_by' => auth()->user()->id, // Sesuaikan dengan informasi pengguna yang sesuai
                        'created_at' => now(), // Tanggal dan waktu saat ini
                        'updated_at' => now(), // Tanggal dan waktu saat ini
                    ]);
                } catch (\Throwable $th) {
                    // Tangani kesalahan pada setiap baris data
                    // Anda dapat melakukan logging kesalahan atau menangani sesuai kebutuhan
                    continue;
                }
                $startCount++;
            }

            DB::commit(); // Commit transaksi jika semuanya berhasil

            return redirect()->route('data_barang')->with('message', 'Data berhasil diimpor.');
        } catch (\Throwable $th) {
            // Gulirkan balik transaksi jika terjadi kesalahan pada tingkat transaksi
            DB::rollBack();

            // Tangani kesalahan pada tingkat transaksi
            // Anda dapat melakukan logging kesalahan atau menangani sesuai kebutuhan
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
