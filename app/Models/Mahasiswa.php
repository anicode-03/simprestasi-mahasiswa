<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = [
        'nim',
        'nama_mahasiswa',
        'email',
        'prodi',
        'jurusan',
        'angkatan',
        'password',
        'no_hp',
    ];


    protected $hidden = ['password'];

    public function prestasi() {
        return $this->hasMany(Prestasi::class, 'nim', 'nim');
    }
}
