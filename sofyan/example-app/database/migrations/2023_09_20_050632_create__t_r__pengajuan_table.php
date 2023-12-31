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
        Schema::create('_t_r__pengajuan', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal_pengajuan');
            $table->integer('grand_total');
            $table->string('status_pengajuan_ap');
            $table->string('keterangan_ditolak_ap');
            $table->string('status_pengajuan_vendor');
            $table->string('keterangan_ditolak_vendor');
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
        Schema::dropIfExists('_t_r__pengajuan');
    }
};
