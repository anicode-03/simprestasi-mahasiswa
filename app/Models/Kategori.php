<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    protected $table = 'kategoris';

    protected $fillable = [
        'nama_kategori',
    ];

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class, 'kategori_id', 'id');
    }
}
