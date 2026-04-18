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
            $table->string('id_prestasi')->primary();
            $table->string('nama_kegiatan');

            // relasi (foreign keys)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->constrained('users');

            $table->string('id_kategori');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori');


            $table->string('id_tingkat');
            $table->foreign('id_tingkat')->references('id_tingkat')->on('tingkat_prestasi');

            $table->string('peran');
            $table->string('juara')->nullable();
            $table->date('tanggal');
            $table->year('tahun_kegiatan');
            $table->string('penyelenggara');
            $table->string('lokasi_kegiatan');
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['draft', 'diajukan', 'disetujui', 'ditolak'])->default('diajukan');
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
