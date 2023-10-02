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
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'password' => 'nullable|confirmed|min:6|max:10',
            'email' => 'required|email',

        ];
    }
    public function messages()
    {
        return [
            'nama.required' => 'Nama tidak boleh kosong',
            'nama.max' => 'Nama terlalu panjang',
            'username.required' => 'kolo username harus diisi',
            'username.max' => 'username terlalu panjang',
            'email.required' => 'kolom email harus diisi',
            'email.email' => 'email harus berformat email yang valid',
            'password.required' => 'kolom password harus diisi',
            'password.min' => 'password terlalu pendek',
            'password.max' => 'password terlalu panjang',
            'password.confirmed' => 'konfirmasi password tidak sesuai dengan password',
        ];
    }
}
