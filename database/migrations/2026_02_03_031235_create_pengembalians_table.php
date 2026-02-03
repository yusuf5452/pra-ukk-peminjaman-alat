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
    Schema::create('pengembalian', function (Blueprint $table) {
        $table->id('id_pengembalian');
        // FK ke Peminjaman
        $table->foreignId('id_peminjaman')->constrained('peminjaman', 'id_peminjaman')->onDelete('cascade');
        $table->date('tanggal_dikembalikan');
        $table->decimal('total_denda', 10, 2)->default(0);
        $table->text('keterangan')->nullable(); // Misal: "Ada lecet sedikit"
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};
