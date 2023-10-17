<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jenis_barang')->notNull()->references('id')->on('mst_jenis_barang')->onUpdate('cascade')->onDelete('cascade');
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->integer('harga');
            $table->string('satuan')->comment('Kardus, Botol, Pcs');
            $table->text('deskripsi');
            $table->string('gambar');
            $table->integer('stok_barang');
            $table->foreignId('id_vendor')->nullable()->references('id')->on('vendors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('created_by')->nullable()->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_barang');
    }
};
