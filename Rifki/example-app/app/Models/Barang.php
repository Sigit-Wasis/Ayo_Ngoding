<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'mst_barang'; // Nama tabel yang sesuai

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'harga',
        'satuan',
        'deskripsi',
        'gambar',
        'stok_barang',
        'id_jenis_barang',
    ];
}
