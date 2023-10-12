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
        Schema::table('tr_pengajuan', function (Blueprint $table) {
            $table->string('status_pengajuan_vendor');
            $table->string('status_ditolak_vendor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tr_pengajuan', function (Blueprint $table) {
           // 
        });
    }
};
