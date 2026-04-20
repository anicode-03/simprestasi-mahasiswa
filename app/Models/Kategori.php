<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'id_kategori',
        'nama_kategori',
    ];

    //relasi one to many
    public function prestasi(): HasMany {
        return $this->hasMany(Prestasi::class, 'id_kategori', 'id_kategori');
    }
}
