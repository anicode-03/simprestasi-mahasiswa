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
            $table->id();

            $table->string('id_prestasi', 20)->unique();

            $table->foreignId('users_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('id_kategori', 20);
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');

            $table->string('id_tingkat', 20);
            $table->foreign('id_tingkat')->references('id_tingkat')->on('tingkat_prestasi')->onDelete('cascade');

            $table->string('nama_prestasi');
            $table->integer('peringkat');
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
