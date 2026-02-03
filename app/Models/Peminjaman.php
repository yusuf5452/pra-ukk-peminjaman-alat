<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';

    protected $fillable = [
        'id_user',
        'tanggal_pinjam',
        'tanggal_jatuh_tempo',
        'status'
    ];

    // Relasi: Peminjaman milik satu user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi: Peminjaman memiliki banyak detail alat
    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class, 'id_peminjaman');
    }

    // Relasi: Peminjaman memiliki satu pengembalian (jika sudah dikembalikan)
    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'id_peminjaman');
    }
}
