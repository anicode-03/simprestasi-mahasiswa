<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\database\Eloquent\Relations\BelongsTo;

class BuktiPrestasi extends Model
{
    use HasFactory;

    protected $table = 'bukti_prestasi';
    protected $primaryKey = 'id_bukti';
    public $incrementing = 'true';
    protected $keyType = 'int';
    public $timestamps = true;
    
    protected $fillable = [
        'id_bukti',
        'id_prestasi',
        'dok_sertifikat',
        'dok_kegiatan',
    ];

    // relasi ke prestasi
    public function prestasi(): BelongsTo {
        return $this->belongsTo(Prestasi::class, 'id_prestasi', 'id_prestasi');
    }
}
