<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuktiPrestasi extends Model
{
    protected $table = 'bukti_prestasi';
    protected $primaryKey = 'id_bukti';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_bukti', 'id_prestasi', 'dok_sertifikat', 'dok_kegiatan'
    ];

    // relasi ke prestasi
    public function prestasi() {
        return $this->belongTo(Prestasi::class, 'id_prestasi', 'id_prestasi');
    }
}
