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
        Schema::create('tr_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal_pengajuan');
            $table->string('grand_total');
            $table->string('status_pengajuan_ap');
            $table->string('keterangan_ditolak_ap');
            $table->string('status_pengajuan_vendor');
            $table->string('keterangan_ditolak_vendor');
            $table->timestamps();
            $table->foreignId('created_by')->notNull()->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('updated_by')->notNull()->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_pengajuan');
    }
};
