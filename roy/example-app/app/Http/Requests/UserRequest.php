<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                'name' => 'required|max:255',
                'user_name' => 'required',
                'email' => 'required|string|email|unique:users', // validasi email dan memastikan email unik
                'password' => 'required|string|min:8|max:10|confirmed', // validasi password dan konfirmasi password

        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'Nama  Harus Diisi Alias Wajib.',
            'user_name.max' => 'User Name Tidak Boleh Melbihi 255 Karakter.',
            'email.required' => 'Email Harus Diisi Alias Wajib.',
            'email.email' => 'Email harus berformat email yang valid.',
            'email.unique' => 'email sudah digunakan oleh pengguna lain.',
            'password.required' => 'Password Harus Diisi Alias Wajib.',
            'password.min' => 'Password terlalu pendek.',
            'password.max' => 'password terlalu panjang.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai dengan password.',
        ];
    }
}
