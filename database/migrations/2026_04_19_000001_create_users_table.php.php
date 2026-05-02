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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary Key (id)
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            
            // Tambahkan role untuk membedakan akses Admin & Mahasiswa
            $table->enum('role', ['admin', 'mahasiswa'])->default('mahasiswa');
            
            $table->rememberToken();
            $table->timestamps(); // Menciptakan kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};