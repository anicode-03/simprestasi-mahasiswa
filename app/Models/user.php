<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'nim', 'prodi', 'jurusan', 'angkatan', 'no_hp'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'angkatan' => 'integer',
        ];
    }

    // Helper Role
    public function isAdmin(): bool { return $this->role === 'admin'; }
    public function isMahasiswa(): bool { return $this->role === 'mahasiswa'; }

    // Relasi
    public function prestasis()
    {
        return $this->hasMany(Prestasi::class, 'user_id'); // Mahasiswa yang mengajukan
    }

    public function reviewedPrestasis()
    {
        return $this->hasMany(DetailPengajuanPrestasi::class, 'reviewer_id'); // Admin yang review
    }
}