<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TingkatPrestasi extends Model
{
    protected $table = 'tingkat_prestasi';
    protected $primaryKey = 'id_tingkat';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_tingkat', 'nama_tingkat'];

    public function prestasi() {
        return $this->hasMany(\App\Models\Prestasi::class, 'id_tingkat', 'id_tingkat');
    }
}
