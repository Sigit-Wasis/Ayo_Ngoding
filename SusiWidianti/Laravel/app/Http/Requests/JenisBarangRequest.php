<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JenisBarangRequest extends FormRequest
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
            'nama_jenis_barang' =>'required|max:255',
            'deskripsi_barang' => 'required'
        ];
    }

    public function messages()
    {
        return[


        'nama_jenis_barang.required' => 'Nama Jenis Barang Harus Diisi Terlebih dahulu',
        'nama_jenis_barang.max' =>'Nama Jenis Barang Tidak Boleh Melebihi 255 Karakter',
        'deskripsi_barang.required' => 'Deskripsi Barang Harus Diisi terlebih dahulu'

        ];

    }
    

}
