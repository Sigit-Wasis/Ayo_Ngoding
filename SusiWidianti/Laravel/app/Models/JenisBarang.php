<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    use HasFactory;
    //Pastikan nama table sama dengan yang didatabase
    protected $table ='jenis_barang';
    //SEMUA Field terisi
    protected $guarded = [];
}


