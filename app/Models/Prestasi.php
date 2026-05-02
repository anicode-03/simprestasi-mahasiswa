<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasi';
    protected $primaryKey = 'id_prestasi';
    public $invrementing = 'true';
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'id_prestasi',
        'id_kategori',
        'id_tingkat',
        'NIM',
        'id_admin',
        'nama_prestasi',
        'penyelenggara',
        'juara',
        'lokasi',
        'tgl_kegiatan',
        'peringkat',
        'tgl_pengajuan',
        'deskripsi',
    ];

    // relasi belongsTo kategori (many to one)
    public function kategori(): BelongsTo {
        return $this->belongsTo(Kategori::class, 'id_tingkat', 'id_tingkat');
    }

    // relasi ke tingkat prestasi 
    public function tingkatPrestasi(): BelongsTo
    {
        return $this->belongsTo(TingkatPrestasi::class, 'id_tingkat', 'id_tingkat');
    }

    // relasi belongs ke mahasiswa 
    public function mahasiswa(): BelongsTo {
        return $this->belongsTo(User::class, 'NIM', 'NIM');
    }

    // relasi belongs ke admin
    public function admin(): BelongsTo {
        return $this->belongsTo(User::class, 'id_admin', 'id');
    }

    //relasi ke bukti prestasi (one to many)
    public function buktiPrestasi(): HasMany {
        return $this->hasMany(BuktiPrestasi::class, 'id_prestasi', 'id_prestasi');
    }

    //relasi ke detailpengajuan (one to many)
    public function detailPengajuan(): HasMany {
        return $this->hasMany(DetailPengajuanPrestasi::class, 'id_prestasi', 'id_prestasi');
    }
}
