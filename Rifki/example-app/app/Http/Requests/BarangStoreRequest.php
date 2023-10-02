<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class BarangStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama_barang' => 'required|max:255',
            'id_jenis_barang' => 'required',
            'kode_barang' => 'required',
            'satuan_barang' => 'required',
            'stok_barang' => 'required',
            'deskripsi_barang' => 'required',
            'gambar_barang' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'harga_barang' => 'required'
        ];
    }
    public function messages()
    {
        return[
            'nama_barang.required' => 'Nama Jenis Barang Harus Diisi',
            'nama_barang.max' => 'Nama Barang tidak boleh melebihi 255 karakter',
            'id_jenis_barang.required' => 'ID jenis barang harus di isi',
            'kode_barang.required' => 'Kode barang harus di isi',
            'satuan_barang.required' => 'Satuan barang Harus Diisi',
            'stok_barang.required' => 'Stok barang harus di isi',
            'deskripsi_barang.required' => 'Deskripsi barang harus di isi',
            'gambar_barang.required' => 'Gambar Barang harus di isi',
            'gambar_barang.mimes' => 'Gambar Barang harus di isi',
            'gambar_barang.max' => 'Gambar Barang harus di isi',
            'harga_barang.required' => 'Harga Barang Harus Diisi',

            
            
        ];
    }
}
