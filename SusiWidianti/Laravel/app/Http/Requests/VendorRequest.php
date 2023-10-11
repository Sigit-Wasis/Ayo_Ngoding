<?php 
 
namespace App\Http\Requests; 
 
use Illuminate\Foundation\Http\FormRequest; 
 
class VendorRequest extends FormRequest 
{ 
    public function authorize() 
    { 
        return true; 
    } 
 
    public function rules()
{
    return [
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'email' => 'required|email|unique:vendors,email',
        'kepemilikan' => 'required|string|max:255',
        'tahun_berdiri' => 'required|date',
        'telphone' => 'nullable|string|max:15', // Kolom 'telphone' menjadi opsional
    ];
}

 
public function messages()
{
    return [
        'nama.required' => 'Nama tidak boleh kosong',
        'nama.max' => 'Nama maksimal 255 karakter',
        'alamat.required' => 'Alamat tidak boleh kosong',
        'alamat.max' => 'Alamat maksimal 255 karakter',
        'email.required' => 'Email tidak boleh kosong',
        'email.email' => 'Email yang Anda masukan tidak valid',
        'email.unique' => 'Email sudah digunakan oleh vendor lain',
        'kepemilikan.required' => 'Kepemilikan tidak boleh kosong',
        'kepemilikan.max' => 'Kepemilikan maksimal 255 karakter',
        'tahun_berdiri.required' => 'Tahun berdiri tidak boleh kosong',
        'tahun_berdiri.date' => 'Tahun berdiri harus dalam format tanggal yang benar',
        'telphone.max' => 'Telepon maksimal 15 karakter', // Pesan untuk 'telphone' jika melebihi maksimal karakter
    ];
}
}