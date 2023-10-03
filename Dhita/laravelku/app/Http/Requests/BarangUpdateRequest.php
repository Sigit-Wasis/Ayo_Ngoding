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
                'nama_barang' => 'required |max:255',
                'id_jenis_barang' => 'required',
                'kode_barang' =>   'required' ,         
                'harga' =>'required',
                'satuan' =>'required',
                'deskripsi' =>'required',
                'gambar' =>'nullable | image | mimes :jpg, jpeg,png|max:2048',
                'stok_barang' =>'required',
            ];
        }
    
        public function messages()
        {
            return [
                'nama_barang.required' => 'Nama Barang Harus di Isi',
                'nama_barang.max' => 'Nama Barang tidak boleh melebihi 255 karakter',
                'id_jenis_barang.required' => 'ID Jenis Barang Harus di Isi',
                'kode_barang.required' => 'Kode Barang Harus di Isi',
                'harga.required' => 'Harga Barang Harus di Isi',
                'satuan.required' => 'Satuan Barang Harus di Isi',
                'deskripsi.required' => 'Deskripsi Barang Harus di Isi',
                'gambar.nullable' => 'Gambar Barang Harus di Isi',
                'gambar.mimes' => 'Gambar Barang Harus di Isi',
                'gambar.max' => 'Gambar Barang Harus di Isi',
                'stok_barang.required' => 'Stok Barang Harus di Isi',
            ];
        }
}
