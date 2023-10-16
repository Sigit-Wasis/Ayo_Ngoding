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
        Schema::create('mts_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jenis_barang')->nullable()->references('id')->on('jenis_barang')->onUpdate('cascade')->onDelete('cascade');
            $table->string('kode_barang')->unique();
            $table->string('nama_barang');
            $table->integer('harga');
            $table->string('satuan') ->comment('misalkan kardus,botol,pcs');
            $table->text('deskripsi');
            $table->string('gambar');
            $table->integer('Stok');
            $table->foreignId('id_vendor')->nullable()->references('id')->on('vendors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('created_by')->nullable()->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();  // Field created_at dan updated_at sudah otomatis di-generate di timestamps
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mts_barang');
    }
};
