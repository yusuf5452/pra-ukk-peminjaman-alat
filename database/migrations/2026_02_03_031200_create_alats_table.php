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
    Schema::create('alat', function (Blueprint $table) {
        $table->id('id_alat');
        $table->string('nama_alat');
        // Foreign Key ke Kategori
        $table->foreignId('id_kategori')->constrained('kategori', 'id_kategori')->onDelete('cascade');
        $table->integer('stok');
        $table->string('kondisi'); // Contoh: Baik, Rusak Ringan
        $table->decimal('harga_denda_per_hari', 10, 2);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alats');
    }
};
