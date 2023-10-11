<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('detail_pengajuan', function (Blueprint $table) {
            $table->integer('total_per_barang')->comment('menyimpan total dari harga barang dikali dengan jumlah');
            $table->foreignId('id_tr_pengajuan')->notNull()->references('id')->on('tr_pengajuan')->onUpdate('cascade')->onDelete('cascade');
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_pengajuan', function (Blueprint $table) {
            //
        });
    }
};
