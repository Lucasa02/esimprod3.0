<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bmn_barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('kode_barang')->unique();
            $table->string('kategori');
            $table->string('merk')->nullable();        // opsional
            $table->string('nomor_seri')->nullable();  // opsional
            $table->integer('jumlah');
            $table->integer('persentase_kondisi')->nullable();
            $table->string('kondisi')->nullable();
            $table->string('foto')->nullable();
            $table->string('ruangan');
            $table->year('tahun_pengadaan')->nullable(); // kolom tahun pengadaan
            $table->text('catatan')->nullable();        // kolom catatan/penjelasan kerusakan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bmn_barangs');
    }
};
