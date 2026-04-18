<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['nama_kategori', 'nama_kategori'];

    // Satu kategori bisa punya banyak prestasi
    public function prestasi() {
        return $this->hasMany(Prestasi::class, 'id_kategori', 'id_kategori');
    }
}
