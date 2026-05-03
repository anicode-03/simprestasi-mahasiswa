<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne; // Tambahkan ini

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    // id tidak perlu dimasukkan ke fillable karena auto-increment
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Penting untuk membedakan Admin/Mahasiswa
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * 1. Relasi ke Profil Mahasiswa
     * Karena data seperti NIM, Jurusan, Prodi ada di tabel terpisah 
     */
    public function mahasiswa(): HasOne
    {
        return $this->hasOne(Mahasiswa::class, 'user_id', 'id');
    }



    public function prestasi()
    {
        return $this->hasManyThrough(
            Prestasi::class,
            Mahasiswa::class,
            'user_id',
            'mahasiswa_id',
            'id',
            'id'
        );
    }

    public function verifiedPrestasi(): HasMany
    {
        return $this->hasMany(Prestasi::class, 'verified_by', 'id');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isMahasiswa(): bool
    {
        return $this->role === 'mahasiswa';
    }
    // Tambahkan di dalam class User (bisa ditaruh di paling bawah sebelum kurung tutup)

    /**
     * Mendapatkan inisial dari nama user (Max 2 huruf)
     */
    public function getInitialsAttribute(): string
    {
        $words = explode(' ', $this->name);

        // Jika nama hanya 1 kata, ambil 2 huruf pertama (misal: "Budi" -> "BU")
        if (count($words) <= 1) {
            return strtoupper(substr($this->name, 0, 2));
        }

        // Jika lebih dari 1 kata, ambil huruf pertama kata pertama dan kedua (misal: "Aris Rahman" -> "AR")
        $first = substr($words[0], 0, 1);
        $second = substr($words[1], 0, 1);

        return strtoupper($first . $second);
    }
}
