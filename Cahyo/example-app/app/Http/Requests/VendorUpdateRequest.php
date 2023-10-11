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
                'tahun_berdiri' => 'required|date',
            ];
        }
    
        public function messages()
        {
            return [
                'nama_vendor.required' => 'Nama tidak boleh kosong',
                'nama_vendor.max' => 'Nama maksimal 255 karakter',
                'alamat.required' => 'Alamat tidak boleh kosong',
                'alamat.max' => 'Alamat maksimal 255 karakter',
                'telphone.required' => 'Nomor telepon tidak boleh kosong',
                'telphone.max' => 'Nomor telepon maksimal 15 karakter',
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Email yang Anda masukan tidak valid',
                
                'kepemilikan.required' => 'Kepemilikan tidak boleh kosong',
                'kepemilikan.max' => 'Kepemilikan maksimal 255 karakter',
                'tahun_berdiri.required' => 'Tahun berdiri tidak boleh kosong',
                'tahun_berdiri.date' => 'Tahun berdiri harus dalam format tanggal yang benar',
            
        ];
    }
}
