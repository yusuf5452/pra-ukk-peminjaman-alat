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
    Schema::create('detail_peminjaman', function (Blueprint $table) {
        $table->id('id_detail');
        // FK ke Peminjaman
        $table->foreignId('id_peminjaman')->constrained('peminjaman', 'id_peminjaman')->onDelete('cascade');
        // FK ke Alat
        $table->foreignId('id_alat')->constrained('alat', 'id_alat')->onDelete('cascade');
        $table->integer('jumlah');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_peminjamen');
    }
};
