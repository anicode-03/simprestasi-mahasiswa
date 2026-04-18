<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasi';
    protected $primaryKey = 'id_prestasi';
    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = [
        'id_prestasi', 'nama_kegiatan', 'user_id', 'admin_id',
        'id_kategori', 'id_tingkat', 'peran', 'juara', 'tanggal',
        'tahun_kegiatan', 'penyelenggara', 'lokasi_kegiatan', 'deskripsi',
        'status'
    ];

    //relasi ke mahasiswa 
    public function mahasiswa() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // relasi ke kategori 
    public function kategori() {
        return $this->belongsTo(Category::class, 'id_kategori', 'id_kategori');
    }
    // relasi ke tingkat
    public function tingkat() {
        return $this->belongsTo(TingkatPrestasi::class, 'id_tingkat', 'id_tingkat');
    }

    // relasi ke bukti
    public function bukti() {
        return $this->hasMany(BuktiPrestasi::class, 'id_prestasi', 'id_prestasi');
    }
}
