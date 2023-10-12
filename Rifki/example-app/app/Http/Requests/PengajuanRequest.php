<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengajuanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'id_vendor' => 'required|exists:vendors,id',
            'id_barang' => 'required|exists:mst_barang,id',
            'jumlah' => 'required|integer|min:1',
            // Add more validation rules as needed
        ];
    }
     /**
     * Get custom error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'id_vendor.required' => 'The vendor field is required.',
            'id_vendor.exists' => 'The selected vendor is invalid.',
            'id_barang.required' => 'The barang field is required.',
            'id_barang.exists' => 'The selected barang is invalid.',
            'jumlah.required' => 'The jumlah field is required.',
            'jumlah.integer' => 'The jumlah must be an integer.',
            'jumlah.min' => 'The jumlah must be at least :min.',
            // Add more custom error messages as needed
        ];
    }
}
