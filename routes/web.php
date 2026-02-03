<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// === GROUP ROUTE ADMIN ===
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Ubah return string menjadi return view
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard'); 
    })->name('admin.dashboard');
});

// === GROUP ROUTE PETUGAS ===
// Hanya bisa diakses jika role = petugas
Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/petugas/dashboard', function () {
        return "Halo Petugas!";
    })->name('petugas.dashboard');
    
    // Route untuk validasi peminjaman & pengembalian
});

// === GROUP ROUTE PEMINJAM ===
// Hanya bisa diakses jika role = peminjam
Route::middleware(['auth', 'role:peminjam'])->group(function () {
    Route::get('/dashboard', function () {
        return "Halo Peminjam!";
    })->name('dashboard');
    
    // Route untuk ajukan pinjaman
});

// === GROUP MULTI ROLE (Contoh) ===
// Bisa diakses oleh Admin DAN Petugas
Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    Route::get('/laporan', function () {
        return "Ini halaman Laporan (Admin & Petugas Only)";
    });
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
