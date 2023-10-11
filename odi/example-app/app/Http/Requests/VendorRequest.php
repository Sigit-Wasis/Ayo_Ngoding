<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            'nama_perusahaan' => 'required',
            'email' => 'required|email',
            'nomor_telpon' => 'required|max:13',
            'kepemilikan' => 'required',
            'tahun_berdiri' => 'required',
            
        ];
}
    public function messages()
    {
        return [
            'nama_perusahaan.required' => 'Nama Perusahaan Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
            'email.unique' => 'Email Yang Dimasukan Tidak Valid',
            'nomor_telpon.required' => 'Nomor Telpon Wajib Diisi',
            'nomor_telpon.max' => 'Nomor Telpon Tidak Boleh Banyak maximal 13',
            'kepemilikan.required' => 'Kepemilikan Wajib Diisi',
            'tahun_berdiri.required' => 'Tahun Berdiri Wajib Diisi',
            
        ];
    }
}