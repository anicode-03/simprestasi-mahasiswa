<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswas';

    protected $fillable = [
        'user_id',
        'nim',
        'jurusan',
        'prodi',
        'no_hp',
        'angkatan',
        'avatar_url',
        'alamat',
    ];

    // Relasi ke user (login)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke prestasi
    public function prestasi()
    {
        return $this->hasMany(Prestasi::class, 'mahasiswa_id', 'id');
    }
}
