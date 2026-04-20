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
        Schema::create('prestasi', function (Blueprint $table) {
            $table->string('id_prestasi', 20)->primary();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->foreignId('id_kategori')->constrained('kategoris')->onDelete('cascade');
            $table->foreignId('id_tingkat')->constrained('tingkat_prestasis')->onDelete('cascade');

            $table->string('nama_prestasi');
            $table->string('penyelenggara');
            $table->string('lokasi');
            $table->date('tanggal_kegiatan');
            $table->text('deskripsi')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};
