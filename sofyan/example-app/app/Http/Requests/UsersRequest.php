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
            'email' => 'required|string',
            'password' => 'required|string|min:8|max:10',
        ];

    }

    public function messages()
    {
    return [
        'name.required' => 'Kolom nama harus diisi.',
        'name.max' => 'nama terlalu panjang.',
        'email.required' => 'Kolom deskripsi harus diisi.',
        'password.min' => 'password terlalu pendek.',
        'password.max' => 'password terlalu panjang.',
    ];
    }
}
