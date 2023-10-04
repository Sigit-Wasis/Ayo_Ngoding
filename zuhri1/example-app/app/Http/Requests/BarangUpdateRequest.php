<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nama_barang' => 'required|max:255',
            'id_jenis_barang' => 'required',
            'kode_barang' =>'required',
            'satuan' => 'required',
            'stok' =>'required',
            'deskripsi'=>'required',
            'gambar' =>'nullable |image|mimes:jpg,jpeg,png|max:2048',
            'harga'=>'required',

        ];
    }
    public function messages()
    {
        return [
            'nama_barang.required' => 'Nama barang harus diisi alias wajib',
            'nama_barang.max' => 'Nama barang barang harus diisi alias wajib',
            'id_jenis_barang.required' => 'Nama jenis barang harus diisi alias wajib',
            'kode_barang.required' => 'kode barang harus diisi alias wajib',
            'satuan.required' => 'satuan barang harus diisi alias wajib',
            'stok.required' => ' stok harus diisi alias wajib',
            'deskripsi.required' => 'deskripsi harus diisi alias wajib',
            'gambar.required' => 'gambar barang harus diisi alias wajib',
            'gambar.mimes' => 'gambar harus diisi alias wajib',
            'gambar.max' => 'gambar barang harus diisi alias wajib',
            'harga.required' => 'harga harus diisi alias wajib',
        ];
    }
}
