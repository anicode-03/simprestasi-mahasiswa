<?php

namespace App\Models;

use App\Models\Capaian;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasi';

    protected $fillable = [
        'mahasiswa_id',
        'kategori_id',
        'tingkat_id',
        'capaian_id',
        'nama_kompetisi',
        'penyelenggara',
        'lokasi',
        'tanggal_pelaksanaan',
        'status',
        'catatan_admin',
        'verified_by',
        'verified_at',
    ];

    // 🔸 Relasi ke mahasiswa
    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id');
    }

    // 🔸 Relasi ke kategori
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    // 🔸 Relasi ke tingkat
    public function tingkat(): BelongsTo
    {
        return $this->belongsTo(Tingkat::class, 'tingkat_id', 'id');
    }

    // 🔸 Relasi ke capaian
    public function capaian(): BelongsTo
    {
        return $this->belongsTo(Capaian::class, 'capaian_id', 'id');
    }

    // 🔸 Relasi ke admin (verifikator)
    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by', 'id');
    }

    // 🔸 Relasi ke bukti prestasi
    public function bukti(): HasMany
    {
        return $this->hasMany(BuktiPrestasi::class, 'prestasi_id', 'id');
    }
}
