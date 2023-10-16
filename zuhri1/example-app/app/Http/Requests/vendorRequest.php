<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class vendorRequest extends FormRequest
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
            'nama_perusahaan' => 'required|max:255',
            'email' => 'required|email',
            'nomor_telepon' =>'required',
            'kepemilikan' => 'required',
            'tahun_berdiri' =>'required',
        ];
        }
    public function messages()
    {
        return [
            'nama_perusahaan.required' => 'Nama perusahaan harus diisi alias wajib',
            'email.required' => 'email harus diisi alias wajib',
            'nomor_telepon.required' => 'nomor telepon harus diisi alias wajib',
            'kepemilikan.required' => 'kepemilikan harus diisi alias wajib',
            'tahun_berdiri.required' => 'tahun berdiri harus diisi alias wajib',
          
        ];
    }
}


