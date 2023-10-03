<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangRequest extends FormRequest
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
            'id_jenis_barang' => 'required|max:255',
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required',
            'satuan' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'stok' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'id_jenis_barang.required' => 'Nama Jenis Barang Wajib Diisi',
            'id_jenis_barang.max' => 'Nama Jenis Barang Tidak Boleh Banyak',
            'kode_barang.required' => 'Kode Barang Barang Wajib Diisi',
            'nama_barang.required' => 'Nama Barang Wajib Diisi',
            'harga.required' => 'Harga Barang Wajib Diisi',
            'satuan.required' => 'Satuan Barang Wajib Diisi',
            'deskripsi.required' => 'Deskripsi Barang Wajib Diisi',
            'gambar.required' => 'Gambar Barang Wajib Diisi',
            'gambar.mimes' => 'Gambar Barang Harus Format jpg, jpeg, png',
            'gambar.max' => 'Gambar Barang minimal 2 MB',
            'stok.required' => 'Stok Barang Wajib Diisi',
        ];
    
    }
}