<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangUpdateRequest extends FormRequest
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
            'jenis_barang' => 'required',
            'nama_barang' => 'required',
            'kode_barang' => 'required',
            'harga' => 'required|numeric',
            'satuan' => 'required',
            'deskripsi' => 'required',
            'stok' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'vendor_id' => 'required',
            'password' => 'nullable'
        ];
    }
    public function messages()
    {
        return [
            'jenis_barang.required' => 'Harap pilih jenis barang.',
            'nama_barang.required' => 'Nama barang harus diisi.',
            'nama_barang.max' => 'Nama barang tidak boleh lebih dari 255 karakter.',
            'harga.required' => 'Harga harus diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'satuan.required' => 'Satuan harus diisi.',
            'satuan.max' => 'Satuan tidak boleh lebih dari 50 karakter.',
            'deskripsi.required' => 'Deskripsi harus diisi.',
            'stok.required' => 'Stok harus diisi.',
            'stok.integer' => 'Stok harus berupa angka.',
            'stok.min' => 'Stok minimal 0.',
            'image.required' => 'Gambar harus diunggah.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'File gambar harus berformat jpeg, png, jpg, atau gif.',
            'image.max' => 'Ukuran file gambar tidak boleh lebih dari 2MB.',
            'vendor_id.required' => 'wajib memilih perusahaan'
        ];
    }
}
