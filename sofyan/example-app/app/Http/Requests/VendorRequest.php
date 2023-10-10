<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            'nama_vendor' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telphone' => 'required|string|max:15',
            'email' => 'required|email|unique:vendors,email',
            'kepemilikan' => 'required|string|max:255',
            'tahun_berdiri' => 'required|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'nama_vendor.required' => 'Nama vendor harus diisi.',
            'nama_vendor.max' => 'Nama vendor tidak boleh lebih dari :max karakter.',
            'alamat.required' => 'Alamat harus diisi.',
            'alamat.max' => 'Alamat tidak boleh lebih dari :max karakter.',
            'telphone.required' => 'Nomor telepon harus diisi.',
            'telphone.max' => 'Nomor telepon tidak boleh lebih dari :max karakter.',
            'email.required' => 'Alamat email harus diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.unique' => 'Alamat email sudah digunakan.',
            'kepemilikan.required' => 'Kepemilikan harus diisi.',
            'kepemilikan.max' => 'Kepemilikan tidak boleh lebih dari :max karakter.',
            'tahun_berdiri.required' => 'Tahun berdiri harus diisi.',
            'tahun_berdiri.max' => 'Tahun berdiri tidak boleh lebih dari :max karakter.',
        ];
    }
}
