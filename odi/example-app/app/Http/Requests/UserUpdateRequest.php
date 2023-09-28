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
                'password' => 'nullable|confirmed|min:8|max:10',
                'email' => 'required|email',
            ];
    }
        public function messages()
        {
            return [
                'name.required' => 'Nama Wajib Diisi',
                'name.max' => 'Nama Tidak Boleh Banyak',
                'username.required' => 'Username Wajib Diisi',
                'username.max' => 'Nama Tidak Boleh Banyak',
                'password.required' => 'Password Wajib Diisi',
                'password.min' => 'Password minimal 8',
                'password.max' => 'Password minimal 10',
                'password.confirmed' => 'Password Harus Sama',
                'email.required' => 'Email Wajib Diisi',
                'email.email' => 'Email Yang Dimasukan Tidak Valid',
            ];
    }
}