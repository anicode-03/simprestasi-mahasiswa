<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasi';
    protected $fillable = [
        'mahasiswa_id',
        'kategori_id',
        'tingkat_id',
        'capaian_id',
        'nama_kompetisi',
        'penyelenggara',
        'dosen_pembimbing',
        'lokasi',
        'tanggal_pelaksanaan',
        'link_pendukung',
        'deskripsi',          // pastikan ini ada
        'status',
        'catatan_admin',
        'verified_by',
        'verified_at',
    ];

    protected $casts = [
        'tanggal_pelaksanaan' => 'date',
        'verified_at'         => 'datetime',
    ];

    // ─── RELASI ───
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function tingkat()
    {
        return $this->belongsTo(Tingkat::class);
    }

    public function capaian()
    {
        return $this->belongsTo(Capaian::class);
    }

    public function buktis()
    {
        return $this->hasMany(BuktiPrestasi::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}