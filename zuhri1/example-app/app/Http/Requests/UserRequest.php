<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'password' => 'required|string|confirmed',
            'email' => 'required|email',
        ];
    }
    public function messages()
    {
        return [
            'name' => 'Nama harus diisi alias wajib',
            'password.required' => 'password harus diisi alias wajib',
            'password.confirmed' => 'Konfirmasi password harus sama dengan Password',
            'email.required' => 'email harus diisi alias wajib',
            'email.email' => 'email tidak valid',
        ];
    }
}
