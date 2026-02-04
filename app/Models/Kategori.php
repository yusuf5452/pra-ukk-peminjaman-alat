<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    
    // Sesuaikan primary key jika bukan 'id'
    protected $primaryKey = 'id_kategori';
    
    // Izinkan mass assignment untuk kolom ini
    protected $fillable = [
        'nama_kategori',
        'deskripsi' // Tambahkan ini agar deskripsi bisa disimpan
    ];

    // Relasi: Kategori memiliki banyak alat
    public function alat()
    {
        return $this->hasMany(Alat::class, 'id_kategori');
    }
}