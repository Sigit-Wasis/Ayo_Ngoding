<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    use HasFactory;
    // PASTIKAN NAMA TABEL SAMA DENGAN YANG ADA DIDATABASE
    protected $table = "jenis_barang";
    //SEMUA FIELD ITU TERISI
    protected $quarded =[];
}
