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
        Schema::create('detail_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_barang')->notNull()->references('id')->on('mst_barang')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('jumlah');
            $table->foreignId('id_tr_pengajuan')->notNull()->references('id')->on('tr_pengajuan')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('total_per_barang');
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
        Schema::dropIfExists('detail_pengajuan');
    }
};
