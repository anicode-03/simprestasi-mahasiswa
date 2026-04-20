<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPengajuanPrestasi extends Model
{
    use HasFactory;

    protected $table = 'detail_pengajuan_prestasi';
    protected $primaryKey = 'id_detail';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'id_detail',
        'id_prestasi',
        'id_admin',
        'status',
        'catatan_admin',
    ];

    // Relasi ke Prestasi
    public function prestasi(): BelongsTo
    {
        return $this->belongsTo(Prestasi::class, 'id_prestasi', 'id_prestasi');
    }

    // Relasi ke Admin
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_admin', 'id');
    }
}