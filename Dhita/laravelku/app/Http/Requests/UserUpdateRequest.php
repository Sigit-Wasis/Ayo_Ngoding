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
            'username' => 'required | max:255',
            'email' => 'required | max:255',
            'password' => 'nullable|confirmed| max:10 | min:8',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Nama User Harus di Isi',
            'username.max' => 'Nama User Tidak Boleh Melebihi 255 Karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email yang anda masukan tidak valid',
            'password.confirmed' => 'Password konfirmasi harus sama dengan password',
            'password.max' => 'Password tidak boleh melebihi 10 Karakter',
            'password.min' => 'Password tidak boleh kurang dari 10 Karakter',
        ];
    }
}
