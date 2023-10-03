<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
                'username' => 'required | max:255',
                'nama_lengkap' => 'required|max:255',
                'email' => 'required |email | unique:users',
                'password' => 'nullable|confirmed| max:10 | min:8',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username Harus di Isi',
            'username.max' => 'Username Tidak Boleh Melebihi 255 Karakter',
            'email' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak boleh kosong',
            'password.confirmed' => 'Password konfirmasi harus sama dengan password',
            'password.max' => 'Password tidak boleh melebihi 10 Karakter',
            'password.min' => 'Password tidak boleh kurang dari 10 Karakter',
        ];
    }
}
