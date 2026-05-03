<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_create_prestasis_table.php
    public function up(): void
    {
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id();

            // Relasi
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->cascadeOnDelete();
            $table->foreignId('kategori_id')->constrained('kategoris');
            $table->foreignId('tingkat_id')->constrained('tingkats');
            $table->foreignId('capaian_id')->constrained('capaians');

            // Detail Kompetisi (Sesuai Form)
            $table->string('nama_kompetisi');
            $table->string('penyelenggara');
            $table->string('dosen_pembimbing')->nullable(); // Tambahan
            $table->string('lokasi')->nullable();           // Tambahan
            $table->date('tanggal_pelaksanaan')->nullable(); // Tambahan
            $table->string('link_pendukung')->nullable();   // Tambahan
            $table->text('deskripsi')->nullable();

            // Status & Verifikasi
            $table->enum('status', ['pending', 'disetujui', 'ditolak', 'revisi'])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('verified_at')->nullable();

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
