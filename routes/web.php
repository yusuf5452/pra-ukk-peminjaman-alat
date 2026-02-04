<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// === IMPORT CONTROLLER ADMIN ===
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminKategoriController;
use App\Http\Controllers\Admin\AdminAlatController;
use App\Http\Controllers\Admin\AdminPeminjamanController;
use App\Http\Controllers\Admin\AdminPengembalianController;
use App\Http\Controllers\Admin\AdminLaporanController;
use App\Http\Controllers\Admin\AdminLogController;
use App\Http\Controllers\Admin\AdminProfileController;

// === IMPORT CONTROLLER PETUGAS ===
use App\Http\Controllers\Petugas\PetugasDashboardController;
use App\Http\Controllers\Petugas\PetugasVerifikasiController; // Untuk Persetujuan
use App\Http\Controllers\Petugas\PetugasPeminjamanController;
use App\Http\Controllers\Petugas\PetugasPengembalianController;
use App\Http\Controllers\Petugas\PetugasLaporanController;

// === IMPORT CONTROLLER PEMINJAM ===
use App\Http\Controllers\Peminjam\PeminjamDashboardController;
use App\Http\Controllers\Peminjam\PeminjamAlatController;
use App\Http\Controllers\Peminjam\PeminjamPengajuanController;
use App\Http\Controllers\Peminjam\PeminjamRiwayatController;
use App\Http\Controllers\Peminjam\PeminjamPengembalianController as PeminjamKembaliController; // Alias biar gak bentrok

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// ====================================================
// GROUP ROUTE ADMIN
// ====================================================
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Master Data
    Route::resource('/users', AdminUserController::class);
    Route::resource('/kategori', AdminKategoriController::class);
    Route::resource('/alat', AdminAlatController::class);

    // Transaksi
    Route::get('/peminjaman', [AdminPeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/pengembalian', [AdminPengembalianController::class, 'index'])->name('pengembalian.index');

    // Laporan & System
    Route::get('/laporan', [AdminLaporanController::class, 'index'])->name('laporan.index');
    Route::get('/log', [AdminLogController::class, 'index'])->name('log.index');

    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');
});

// ====================================================
// GROUP ROUTE PETUGAS
// ====================================================
Route::middleware(['auth', 'verified', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('dashboard');

    // Operasional
    // Verifikasi -> persetujuan.blade.php
    Route::get('/persetujuan', [PetugasVerifikasiController::class, 'index'])->name('persetujuan.index'); 
    
    // Daftar Peminjaman -> pinjaman.blade.php
    Route::get('/peminjaman', [PetugasPeminjamanController::class, 'index'])->name('peminjaman.index');

    // Pengembalian -> pengembalian.blade.php
    Route::get('/pengembalian', [PetugasPengembalianController::class, 'index'])->name('pengembalian.index');

    // Laporan -> laporan.blade.php
    Route::get('/laporan', [PetugasLaporanController::class, 'index'])->name('laporan.index');
});

// ====================================================
// GROUP ROUTE PEMINJAM (MEMBER)
// ====================================================
Route::middleware(['auth', 'verified', 'role:peminjam'])->prefix('peminjam')->name('peminjam.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [PeminjamDashboardController::class, 'index'])->name('dashboard');

    // Eksplorasi Alat -> alat.blade.php
    Route::get('/alat', [PeminjamAlatController::class, 'index'])->name('alat.index');

    // Pengajuan -> pengajuan.blade.php
    Route::get('/pengajuan', [PeminjamPengajuanController::class, 'index'])->name('pengajuan.index');

    // Riwayat -> riwayat.blade.php
    Route::get('/riwayat', [PeminjamRiwayatController::class, 'index'])->name('riwayat.index');

    // Pengembalian Saya -> pengembalian.blade.php
    Route::get('/pengembalian', [PeminjamKembaliController::class, 'index'])->name('pengembalian.index');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';