<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPengajuanPrestasi extends Model
{
    protected $table = 'detail_pengajuan_prestasi';

    protected $fillable = [
        'prestasi_id',
        'status',
        'catatan',
        'changed_by'
    ];
}