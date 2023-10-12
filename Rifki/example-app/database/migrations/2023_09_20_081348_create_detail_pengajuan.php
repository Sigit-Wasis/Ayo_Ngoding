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
        Schema::create('detail_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_barang')->notNull()->references('id')->on('mst_barang')->onUpdate('cascade')->onDelete('cascade');
            $table->string('jumlah');
            $table->string('total_barang');
            $table->foreignId('id_tr_pengajuan')->notNull()->references('id')->on('tr_pengajuan')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pengajuan');
    }
};
