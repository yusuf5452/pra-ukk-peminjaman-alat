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
    Schema::create('peminjaman', function (Blueprint $table) {
        $table->id('id_peminjaman');
        // Foreign Key ke User
        $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
        $table->date('tanggal_pinjam');
        $table->date('tanggal_jatuh_tempo');
        // Status: diajukan, dipinjam, selesai, ditolak
        $table->enum('status', ['diajukan', 'dipinjam', 'selesai', 'ditolak'])->default('diajukan');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
