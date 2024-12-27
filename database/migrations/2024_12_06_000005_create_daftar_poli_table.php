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
        Schema::create('daftar_poli', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pasien');
            $table->unsignedBigInteger('id_jadwal');
            $table->text('keluhan');
            $table->integer('no_antrian');
            $table->string('status')->default('menunggu');
            $table->timestamps();

             // Foreign keys
             $table->foreign('id_pasien')->references('id')->on('pasien')->onDelete('cascade');
             $table->foreign('id_jadwal')->references('id')->on('jadwal_periksa')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_poli');
        Schema::table('daftar_poli', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
