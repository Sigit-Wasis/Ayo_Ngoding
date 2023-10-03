<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6|max:10',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Nama tidak boleh kosong',
            'name.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email yang anda mmasukan tidak valid',
            'password.min' => 'Password minimal 6 karakter',
            'password.max' => 'Password maksimal 10 karakter',
            'password.confirmed' => 'Password tidak boleh kosong'
        ];
    }
}
