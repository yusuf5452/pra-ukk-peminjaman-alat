<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('alat', function (Blueprint $table) {
            // Menambahkan kolom baru tanpa menghapus data lama
            // 'after' digunakan untuk menentukan posisi kolom (opsional, hanya rapi di database mysql)
            $table->decimal('harga_sewa_per_hari', 10, 2)->default(0)->after('stok');
            $table->text('deskripsi')->nullable()->after('harga_denda_per_hari');
            $table->string('gambar')->nullable()->after('deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alat', function (Blueprint $table) {
            $table->dropColumn(['harga_sewa_per_hari', 'deskripsi', 'gambar']);
        });
    }
};