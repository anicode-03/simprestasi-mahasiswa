<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengajuanPrestasi extends Model
{
    use HasFactory;

    protected $table = 'detail_pengajuan_prestasis';
    protected $primaryKey = 'id_detail';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_detail',
        'id_prestasi',
        'id_admin',
        'status',
        'catatan_admin',
    ];

    // Relasi ke Prestasi
    public function prestasi()
    {
        return $this->belongsTo(Prestasi::class, 'id_prestasi', 'id_prestasi');
    }

    // Relasi ke Admin
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}