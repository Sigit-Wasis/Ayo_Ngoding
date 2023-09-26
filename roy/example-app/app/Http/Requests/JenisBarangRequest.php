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
     * @return array
     */
    public function rules()
    {
        return [
            'nama_jenis_barang' => 'required|max:255',
            'deskripsi' => 'required'
        ];
    }

    public function messages()
    {
        return[
            'nama_jenis_barang.required' => 'Nama Jenis Barang Harus Diisi Alias Wajib',
            'nama_jenis_barang.max' => 'Nama Jenis Barang Tidak Boleh Melbihi 255 Karakter',
            'deskripsi.required' => 'Deskripsi Barang Harus Diisi Alias Wajib'
        ];
    }
}
