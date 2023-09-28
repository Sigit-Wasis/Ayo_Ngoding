<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    use HasFactory;
    // NAMA TABLE SAMA DENGAN YANG ADA DI DATABASE
    protected $table = 'mst_jenis_barang';
    // SEMUA FIELD ITU TERISI
    protected $guarded = [];
}
