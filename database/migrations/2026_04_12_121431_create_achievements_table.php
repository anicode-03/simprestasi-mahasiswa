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
        Schema::create('achievements', function (Blueprint $table) {
        $table->engine = 'InnoDB'; 
        $table->id('id_prestasi');
        $table->foreignId('id_mahasiswa')->constrained('users');
        $table->foreignId('id_kategori')->constrained('categories', 'id_kategori');
        $table->foreignId('id_admin')->nullable()->constrained('users'); 
        
        $table->string('nama_prestasi');
        $table->string('juara');
        $table->string('tingkat');
        $table->date('tanggal_pengajuan');
        $table->enum('status', ['pending', 'valid', 'invalid'])->default('pending');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
