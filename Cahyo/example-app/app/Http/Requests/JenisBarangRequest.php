<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JenisBarangRequest extends FormRequest
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
            'nama_jenis_barang' => 'required|max:255',
            'deskripsi_barang' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'nama_jenis_barang.required' => 'Nama Jenis Barang Harus Diisi Alias Wajibe',
            'nama_jenis_barang.max' => 'Nama Jenis Barang Aja Dawa Dawa Cok',
            'deskripsi_barang.required' => 'Deskripsi Barang Harus Diisi Alias Wajibe'
        ];
    }
}
