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
        Schema::create('_m_s_t__barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Id_jenis_barang')->notNull()->references('id')->on('_m_s_t__jenis__barang')->onUpdate('cascade')->onDelete('cascade');
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->string('harga');
            $table->string('satuan');
            $table->string('deskripsi');
            $table->string('stok');
            $table->string('image');
            $table->foreignId('created_by')->notNull()->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('updated_by')->notNull()->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('_m_s_t__barang');
    }
};
