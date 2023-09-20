<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstBarangTable extends Migration
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
            // $table->integer('id_barang')->unique();
            $table->foreignId('id_jenis_barang')->notNull()->references('id')->on('jenis_barang')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('kode_barang');
            $table->string('nama_barang');
            $table->string ('harga');
            $table->string ('deskripsi');
            $table->string ('stok');
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
        Schema::dropIfExists('mst_barang');
    }
}
