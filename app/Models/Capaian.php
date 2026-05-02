<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Capaian extends Model
{
    protected $table = 'capaian';

    protected $fillable = [
        'nama_capaian',
    ];

    public function prestasi(): HasMany
    {
        return $this->hasMany(Prestasi::class, 'capaian_id', 'id');
    }
}