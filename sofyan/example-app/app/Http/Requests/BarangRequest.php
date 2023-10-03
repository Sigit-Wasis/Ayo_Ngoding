<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangRequest extends FormRequest
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
            'nama_barang' => 'required', // Tambahkan aturan validasi ini
            'harga' => 'required',
            'kode_barang' => 'required|unique:_m_s_t__barang',
            'satuan' => 'required',
            'deskripsi' => 'required',
            'stok' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Contoh aturan validasi untuk gambar
        ];
    }
    public function messages()
    {
        return [
            'jenis_barang.required' => 'Bidang Jenis Barang wajib diisi.',
            'nama_barang.required' => 'Bidang Nama Barang wajib diisi.', // Pesan kustom untuk 'nama'
            'harga.required' => 'Bidang Harga wajib diisi.',
            'satuan.required' => 'Bidang Satuan wajib diisi.',
            'deskripsi.required' => 'Bidang Deskripsi wajib diisi.',
            'kode_barang.required' => 'Bidang Kode barang wajib diisi.',
            'kode_barang.unique' => 'Bidang Kode barang sudah ada yang menggunakan.',
            'stok.required' => 'Bidang Stok wajib diisi.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'File gambar hanya boleh dalam format: jpeg, png, jpg, gif.',
            'image.max' => 'Ukuran file gambar tidak boleh lebih dari 2MB.',
        ];
    }

}
