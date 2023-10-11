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
     * @return array
     */
    public function rules()
    {
        return [
            'nama_perusahaan' => 'required|max:255',
            'email' => 'required|email|unique:vendor',
            'nomor_telpon' => 'required',
            'kepemilikan' => 'required',
            'tahun_berdiri' => 'required',
            
        ];
    }

    public function messages()
    {
        return[
            'nama_perusahaan.required' => 'Nama Perusahaan Harus Diisi Alias Wajib',
            'email.required' => 'Email Harus Diisi Alias Wajib.',
            'email.email' => 'Email harus berformat email yang valid.',
            'nomor_telpon.required' => 'Nomor Telpon Wajib Diisi Maximal 13 Angka',
            'kepemilikan.required' => 'Kepemilikan harus di isi alias wajib',
            'tahun_berdiri.required'=> 'Tahun Berdiri harus di isi alias wajib',
            
        ];
    }
}
