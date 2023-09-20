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
            $table->foreignId('id_barang')->notNull()->references('id')->on('barang')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('jumlah');
            $table->foreignId('id_tr_pengajuan')->notNull()->references('id')->on('pengajuan')->onUpdate('cascade')->onDelete('cascade');
            $table->string('total_per_barang');
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
        Schema::dropIfExists('detail_pengajuan');
    }
};
