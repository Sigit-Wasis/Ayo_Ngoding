<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'nullable|confirmed|min:6|max:10',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Nama tidak boleh kosong',
            'name.max' => 'Nama maksimal 255 karakter',
            'username.required' => 'Username tidak boleh kosong',
            'username.max' => 'Username maksimal 255 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email yang anda mmasukan tidak valid',
            'password.min' => 'Password minimal 6 karakter',
            'password.max' => 'Password maksimal 10 karakter',
            'password.confirmed' => 'Password konfirmasi tidak boleh berbeda'
        ];
    }
}
