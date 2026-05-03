<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tingkat extends Model
{
    use HasFactory;

    protected $table = 'tingkats';

    protected $fillable = [
        'nama_tingkat',
    ];

    // relasi ke prestasi
    public function prestasi(): HasMany
    {
        return $this->hasMany(Prestasi::class, 'tingkat_id', 'id');
    }
}