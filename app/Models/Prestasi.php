<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasi';
    protected $primaryKey = 'id_prestasi';
    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = ['id_prestasi', 'nim', 'id_kategori', 'id_tingkat', 'nama_prestasi', 'penyelenggara', 'lokasi', 'tanggal_kegiatan', 'deskripsi'];

    // relasi ke mahasiswa
    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    //relasi ke admin
    public function admin() {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }

    //relasi ke kategori
    public function kategori() {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    //relasi ke tingkat prestasi
    public function tingkatPrestasi() {
        return $this->belongsTo(TingkatPrestasi::class, 'id_tingkat', 'id_tingkat');
    }

    //relasi ke bukti prestasi
    public function buktiPrestasi() {
        return $this->hasMany(BuktiPrestasi::class, 'id_prestasi', 'id_prestasi');
    }

    //relasi ke detail pengajuan
    public function detailPengajuanPrestasi() {
        return $this->hasMany(DetailPengajuanPrestasi::class, 'id_prestasi', 'id_prestasi');
    }

}
