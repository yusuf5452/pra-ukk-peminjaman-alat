<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    use HasFactory;

    protected $table = 'detail_peminjaman';
    protected $primaryKey = 'id_detail';

    protected $fillable = [
        'id_peminjaman',
        'id_alat',
        'jumlah'
    ];

    // Relasi: Detail milik satu peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman');
    }

    // Relasi: Detail merujuk pada satu alat
    public function alat()
    {
        return $this->belongsTo(Alat::class, 'id_alat');
    }
}
