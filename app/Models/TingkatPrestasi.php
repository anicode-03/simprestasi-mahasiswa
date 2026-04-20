<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TingkatPrestasi extends Model
{
    use HasFactory;

    protected $table = 'tingkat_prestasi';
    protected $primaryKey = 'id_tingkat';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_tingkat', 'nama_tingkat'];

    // relasi ke prestasi 
    public function prestasi() {
        return $this->hasMany(Prestasi::class, 'id_tingkat', 'id_tingkat');
    }

}
