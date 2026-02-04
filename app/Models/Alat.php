<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $table = 'alat';
    protected $primaryKey = 'id_alat';

    protected $fillable = [
        'nama_alat',
        'id_kategori',
        'stok',
        'kondisi',
        'harga_sewa_per_hari',  // Baru
        'harga_denda_per_hari',
        'deskripsi',            // Baru
        'gambar'                // Baru
    ];

    // Relasi: Alat milik satu kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    // Relasi: Alat ada di banyak detail peminjaman
    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class, 'id_alat');
    }
}