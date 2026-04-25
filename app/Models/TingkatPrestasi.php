<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\database\Eloquent\Relations\HasMany;

class TingkatPrestasi extends Model
{
    use HasFactory;

    protected $table = 'tingkat_prestasi';
    protected $primaryKey = 'id_tingkat';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'id_tingkat',
        'nama_tingkat',
    ];

    //relasi one to many
    public function prestasi(): HasMany {
        return $this->hasMany(Prestasi::class, 'id_tingkat', 'id_tingkat');
    }

}
