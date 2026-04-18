<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPengajuan extends Model
{
    protected $table = 'detail_pengajuan';
    protected $primaryKey = 'id_detail';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_detail', 'id_prestasi', 'user_id', 'status', 'catatan_admin'
    ];

    // Detail merujuk ke data prestasi tertentu
    public function prestasi() {
        return $this->belongTo(\App\Models\Prestasi::class, 'id_prestasi', 'id_prestasi');
    }

    // admin yang memverifikasi
    public function verifikator() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
