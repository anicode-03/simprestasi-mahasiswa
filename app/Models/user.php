<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'NIm',
        'role',
        'name',
        'email',
        'password',
        'jurusan',
        'prodi',
        'angkatan',
        'no_hp',
    ];


    protected $hidden = [
        'password',
        'rememeber_token',
    ];

    protected function casts(): array {
        return [
            'email_verivied_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    //relasi user(mahasiswa) one to many
    public function prestasi(): HasMany {
        return $this->hasMany(Prestasi::class, 'NIM', 'NIM');
    }


    //relasi use(admin) memverifikasi banyak detail pengajuan
    public function detailPengajuan(): HasMany {
        return $this->hasMany(DetailPengajuanPrestasi::class, 'id_admin', 'id');
    }


    // cek apakah user adalah admin
    public function isAdmin(): bool {
        return $this->role === 'admin';
    }

    // apakah user adalah mahasiswa
    public function isMahasiswa(): bool {
        return $this->role === 'mahasiswa';
    }
}