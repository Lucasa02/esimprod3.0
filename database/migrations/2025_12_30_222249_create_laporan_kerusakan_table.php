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
    Schema::create('laporan_kerusakan', function (Blueprint $table) {
        $table->id();
        $table->uuid('uuid');

        // Kolom barang_id yang benar
        $table->foreignId('barang_id')
              ->constrained('bmn_barangs')
              ->onDelete('cascade');

        $table->string('jenis_kerusakan');
        $table->text('deskripsi')->nullable();
        $table->string('foto')->nullable();
        $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::dropIfExists('laporan_kerusakan');
}

};
