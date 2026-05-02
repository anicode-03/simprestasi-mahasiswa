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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            // Relasi: user_id merujuk ke id di tabel users
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->string('nim', 20)->unique();
            $table->string('jurusan');
            $table->string('prodi');
            $table->string('no_hp', 15);
            $table->year('angkatan');
            $table->string('avatar_url')->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
