<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    public $timestamps = true;
    use HasFactory;
    protected $table = '_m_s_t__jenis__barang';
    protected $guarded = [];
}
