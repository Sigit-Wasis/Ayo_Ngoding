<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    use HasFactory;
    // pastikan nama table sama dengan yang ada di database
    protected $table = 'mst_jenis_barang';
    // semua field itu terisi
    protected $guarded = [];
} 