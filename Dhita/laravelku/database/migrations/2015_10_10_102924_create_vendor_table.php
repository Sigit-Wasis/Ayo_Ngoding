<?php 
 
use Illuminate\Database\Migrations\Migration; 
use Illuminate\Database\Schema\Blueprint; 
use Illuminate\Support\Facades\Schema; 
 
return new class extends Migration 
{ 
 
    public function up() 
    { 
        Schema::create('vendor', function (Blueprint $table) { 
            $table->id(); 
            $table->string('nama'); 
            $table->string('alamat'); 
            $table->string('telphone'); 
            $table->string('email')->unique(); 
            $table->string('kepemilikan'); 
            $table->string('tahun_berdiri'); 
            $table->foreignId('created_by')->notNull()->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade'); 
            $table->foreignId('updated_by')->notNull()->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade'); 
            $table->timestamps(); 
        }); 
    } 
 
    public function down() 
    { 
        Schema::dropIfExists('vendor'); 
    } 
};