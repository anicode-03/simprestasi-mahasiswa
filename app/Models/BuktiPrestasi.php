<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BuktiPrestasi extends Model
{
    protected $table = 'bukti_prestasi';

    protected $fillable = [
        'prestasi_id',
        'file_path',
        'tipe_file'
    ];

    public function prestasi(): BelongsTo
    {
        return $this->belongsTo(Prestasi::class, 'prestasi_id', 'id');
    }
}