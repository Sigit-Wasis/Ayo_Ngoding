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
        Schema::create('history_stok_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->notNull()->references('id')->on('mts_barang')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('stok_sebelum')->unsigned();
            $table->integer('stok_sesudah')->unsigned();
            $table->integer('stok_sekarang')->unsigned();
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
        Schema::dropIfExists('history_stok_barang');
    }
};