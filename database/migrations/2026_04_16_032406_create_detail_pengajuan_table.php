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
            $table->string('id_detail')->primary();


            // relasi ke tabel prestasi
            $table->string('id_prestasi');
            $table->foreign('id_prestasi')->references('id_prestasi')->on('prestasi')->onDelete('cascade');


            // relasi ke tabel user (role admin)
            $table->foreignId('user_id')->constrained('users');


            $table->string('status');
            $table->text('catatan_admin')->nullable();
            
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
