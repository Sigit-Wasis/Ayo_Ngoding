<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users', // Validasi email dan memastikan email unik
            'password' => 'required|string|min:8|max:10|confirmed', // Validasi password dan konfirmasi password
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Kolom nama harus diisi.',
            'name.max' => 'Nama terlalu panjang.',
            'email.required' => 'Kolom email harus diisi.',
            'email.email' => 'Email harus berformat email yang valid.',
            'email.unique' => 'Email sudah digunakan oleh pengguna lain.',
            'password.required' => 'Kolom password harus diisi.',
            'password.min' => 'Password terlalu pendek.',
            'password.max' => 'Password terlalu panjang.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai dengan password.',
        ];
    }
}
