<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('vendor', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan');
            $table->string('email')->unique();
            $table->string('nomor_telpon');
            $table->string('kepemilikan');
            $table->string('tahun_berdiri');
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
        Schema::dropIfExists('vendor');
    }
}
