<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama_barang' => 'required|max:255',
            'id_jenis_barang' => 'required',
            'kode_barang' => 'required|unique:mst_barang',
            'harga' => 'required',
            'satuan' => 'required',
            'deskripsi' => 'required',
            'gambar_barang' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'stok_barang' => 'required'
        ];
    }

    public function messages()
    {
        return[
            'nama_barang.required' => 'Nama Jenis Barang Harus Diisi Alias Wajib',
            'nama_barang.max' => 'Nama Barang Tidak Boleh Melebihi 255 Karakter',
            'id_jenis_barang.max' => 'Nama Jenis Barang Tidak Boleh Melbihi 255 Karakter',
            'kode_barang.unique' => 'Kode barang sudah ada sebelumnya',
            'nama_barang.required' => 'Nama barang harus di isi alias wajib',
            'harga_barang.required'=> 'harga barang harus di isi alias wajib',
            'satuan_barang.required'=> 'Satuan barang harus di isi alias wajib',
            'deskripsi.required' => 'Deskripsi Barang Harus Diisi Alias Wajib',
            'gambar_barang.max' => 'Gambar Barang maksimal 2 MB',
            'stok_barang.required' => 'Stok Barang Harus Diisi Alias Wajib',
        ];
    }
}
