<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'username' =>'required|max:255',
            'email' =>'required|email',
            'password' => 'nullable|confirmed|max:10|min:6'
        ];
    }

    public function messages()
    {
        return[


        'username.required' => 'Username Harus Diisi Terlebih dahulu',
        'username.max' =>'Nama Jenis Barang Tidak Boleh Melebihi 255 Karakter',
        'email' => 'Email tidak boleh kosong',
        'email.email' => 'Email yang dimasukan tidak boleh kosong',
        'password.confirmed' => 'Password konfirmasi harus sama dengn password',
        'password.max' => 'Password Tidak Boleh Melebihi 10 Karakter',
        'password.min' =>'NPassword Tidak Boleh kurang dari 8 Karakter',


        ];

    }
}
