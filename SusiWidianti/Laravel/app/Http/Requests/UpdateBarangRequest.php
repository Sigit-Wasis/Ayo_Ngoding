<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBarangRequest extends FormRequest
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
            'nama_barang' =>'required|max:255',
            'id_jenis_barang' =>'required',
            'kode_barang' =>'required',
            'harga' =>'required',
            'satuan' =>'required',
            'deskripsi' => 'required',
            'stok' =>'required'
        ];
    }

    public function messages()
    {
        return[


            'nama_barang.required' => 'Nama barang harus diisi terlebih dahulu',
            'nama_barang.max' =>'nama barang tidak boleh melebihi 255 karakter',
            'id_jenis_barang.required' => 'id jenis barang harus diisi terlebih dahulu',
            'id_jenis_barang.max' =>'id jenis barang tidak boleh melebihi 255 karakter',
            'kode_barang.required' => 'kode barang harus diisi terlebih dahulu',
            'kode_barang.max' =>'kode barang tidak boleh melebihi 255 karakter',
            'harga.required' => 'harga barang harus diisi terlebih dahulu',
            'harga.max' =>'harga barang tidak boleh melebihi 255 karakter',
            'satuan.required' => ' harus diisi satuan lebih dahulu',
            'satuan.max' =>'satuan tidak boleh melebihi 255 karakter',
            'deskripsi.required' => 'deskripsi barang harus diisi terlebih dahulu',
            'deskripsi.max' =>'deskripsi barang tidak boleh melebihi 255 karakter',
            'stok.required' => 'stok barang harus diisi terlebih dahulu',
            'stok.max' =>'stok barang tidak boleh melebihi 255 karakter'



            
    
            ];
    
        }
}
