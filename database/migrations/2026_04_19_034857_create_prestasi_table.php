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

            $table->foreignId('mahasiswa_id')->constrained()->cascadeOnDelete();
            $table->foreignId('kategori_id')->constrained();
            $table->foreignId('tingkat_id')->constrained();
            $table->foreignId('capaian_id')->constrained('capaians');

            $table->string('nama_kompetisi');
            $table->string('penyelenggara');

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
