<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorUpdateRequest extends FormRequest
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
            'email' => 'required|email',
            'kepemilikan' => 'required|string|max:255',
            'tahun_berdiri' => 'required|integer|min:1900|max:' . date('Y'),
        ];
    }

    public function messages()
    {
        return [
            'nama_vendor.required' => 'Nama perusahaan wajib diisi.',
            'nama_vendor.max' => 'Nama perusahaan tidak boleh lebih dari :max karakter.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.max' => 'Alamat tidak boleh lebih dari :max karakter.',
            'telphone.required' => 'Nomor telepon wajib diisi.',
            'telphone.max' => 'Nomor telepon tidak boleh lebih dari :max karakter.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Alamat email harus valid.',
            'kepemilikan.required' => 'Kepemilikan wajib diisi.',
            'kepemilikan.max' => 'Kepemilikan tidak boleh lebih dari :max karakter.',
            'tahun_berdiri.required' => 'Tahun berdiri wajib diisi.',
            'tahun_berdiri.integer' => 'Tahun berdiri harus berupa angka.',
            'tahun_berdiri.min' => 'Tahun berdiri tidak boleh kurang dari :min.',
            'tahun_berdiri.max' => 'Tahun berdiri tidak boleh lebih dari :max.',
        ];
    }

}
