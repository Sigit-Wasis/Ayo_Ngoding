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
            'nama_jenis_barang' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ];
    }

    public function messages()
    {
    return [
        'nama_jenis_barang.required' => 'Kolom nama jenis barang harus diisi.',
        'nama_jenis_barang.max' => 'nama jenis barang terlalu panjang.',
        'deskripsi.required' => 'Kolom deskripsi harus diisi.',
    ];
    }
}
