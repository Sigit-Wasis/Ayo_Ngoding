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
            'username' => 'required',
            'password' => 'required|confirmed',
            'email' => 'required|unique:users',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Nama Wajib Diisi',
            'name.max' => 'Nama Tidak Boleh Banyak',
            'username.required' => 'Username Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
            'password.confirmed' => 'Password Harus Sama',
            'email.required' => 'Email Barang Wajib Diisi',
            'email.unique' => 'Email Harus Sama',
        ];


}
}