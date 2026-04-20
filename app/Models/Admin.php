<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'id_admin',
        'nama_admin',
        'username',
        'password',
        'email',
    ];

    protected $hidden = ['password'];


    // relasi ke prestasi
    public function prestasi() {
        return $this->hasMany(Prestasi::class, 'id_admin', 'id_admin');
    }

    // relasi ke detail pengajuan
    public function detailPengajuanPrestasi() {
        return $this->hasMany(DetailPengajuanPrestasi::class, 'id_admin', 'id_admin');
    }
}
