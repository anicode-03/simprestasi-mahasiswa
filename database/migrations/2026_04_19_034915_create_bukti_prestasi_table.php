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
        Schema::create('bukti_prestasi', function (Blueprint $table) {
            $table->string('id_bukti', 20)->primary();
            $table->string('id_prestasi', 20);
            $table->string('dok_sertifikat');
            $table->string('dok_kegiatan');
            $table->timestamps();

            $table->foreign('id_prestasi')->references('id_prestasi')->on('prestasi')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukti_prestasi');
    }
};
