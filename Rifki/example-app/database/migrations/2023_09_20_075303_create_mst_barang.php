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
        Schema::create('mst_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jenis_barang')->notNull()->references('id')->on('mst_jenis_barang')->onUpdate('cascade')->onDelete('cascade');
            $table->string('kode_barang')->unique();
            $table->string('nama_barang');
            $table->string('harga');
            $table->string('satuan')->comment('misalkan kardus, botol, pcs');
            $table->text('deskripsi');
            $table->string('gambar');
            $table->integer('stok_barang');
            $table->foreignId('id_vendor')->notNull()->references('id')->on('vendors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('created_by')->notNull()->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('updated_by')->notNull()->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_barang');
    }
};
