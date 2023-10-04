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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id_jenis_barang' => 'required',
            'kode_barang' => 'required|unique:mst_barang',
            'nama_barang' => 'required|max:255',
            'harga' => 'required',
            'satuan' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'stok_barang' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'id_jenis_barang.required' => 'Jenis Barang Harus Diisi Alias Wajibe',
            'nama_barang.required' => 'Nama  Barang Harus Diisi Alias Wajibe',
            'nama_barang.max' => 'Nama Barang Aja Dawa Dawa Cok',
            'kode_barang.required' => 'Kode Barang Harus Diisi Alias Wajibe',
            'kode_barang.unique' => 'Kode Barang sudah ada',
            'satuan.required' => 'Satuan Barang Harus Diisi Alias Wajibe',
            'stok_barang.required' => 'Stok Barang Harus Diisi Alias Wajibe',
            'deskripsi.required' => 'Deskripsi Barang Harus Diisi Alias Wajibe',
            'gambar.required' => 'Gambar Barang Harus Diisi Alias Wajibe',
            'gambar.mimes' => 'Gambar Barang Format Harus png, jpg, jpeg',
            'gambar.max' => 'Gambar Barang Maximal 2 MB',
            'harga.required' => 'Harga Barang Harus Diisi Alias Wajibe'
        ];
    }
}
