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
    function __construct()
    {
        $this->middleware('permission:pengajuan-list|pengajuan-create|pengajuan-edit|pengajuan-delete', ['only' => ['index', 'storevendor']]);
        $this->middleware('permission:pengajuan-create', ['only' => ['createvendor', 'storevendor']]);
        $this->middleware('permission:pengajuan-edit', ['only' => ['editVendor', 'updateVendor']]);
        $this->middleware('permission:pengajuan-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $vendors = DB::table('vendors')
            ->select(
                'vendors.*',
                'users.name as created_by',
            )
            ->orderBy('vendors.id', 'DESC')
            ->join('users', 'users.id', 'vendors.created_by')
            ->paginate(5);

        return view('backend.vendor.index', compact('vendors'));
    }

    public function createvendor()
    {
        return view('backend.vendor.create');
    }

    public function storevendor(VendorRequest $request)
    {
        DB::table('vendors')->insert([
            'nama' => $request->nama_vendor,
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
        return redirect()->route('vendors')->with('message', 'Vendor Berhasil Disimpan!');
    }

    public function destroy($id)
    {
        DB::table('vendors')->where('id', $id)->delete();
        return redirect()->route('vendors')->with('message', 'Jenis Barang Berhasil Dihapus!');
    }
    public function editVendor($id)
    {
        $editVendor = DB::table('vendors')->where('id', $id)->first();

        if (!$editVendor) {
            return redirect()->route('vendors')->with('error', 'Vendor tidak ditemukan.');
        }

        session(['edit_vendor' => $editVendor]);

        return view('backend.vendor.edit', compact('editVendor'));
    }

    public function updateVendor(VendorUpdateRequest $request, $id)
    {
        DB::table('vendors')
            ->where('id', $id)
            ->update([
                'nama' => $request->nama_vendor,
                'alamat' => $request->alamat,
                'telphone' => $request->telphone,
                'email' => $request->email,
                'kepemilikan' => $request->kepemilikan,
                'tahun_berdiri' => $request->tahun_berdiri,
                'updated_by' => auth()->user()->id,
                'updated_at' => \Carbon\Carbon::now(),
            ]);

        return redirect()->route('vendors')->with('message', 'Vendor berhasil diperbarui!');
    }


}
