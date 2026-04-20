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
            $table->string('id_detail', 20)->primary();


            $table->string('id_prestasi', 20);
            $table->foreign('id_prestasi')->references('id_prestasi')->on('prestasi')->onDelete('cascade');


            $table->foreignId('reviewer_id')->constrained('users')->onDelete('cascade');
            
            $table->enum('status', ['Diajukan', 'Disetujui', 'Ditolak', 'Revisi'])->default('Diajukan');
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
