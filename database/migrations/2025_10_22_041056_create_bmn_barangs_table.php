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
            $table->string('uuid')->unique();                // UUID unik untuk tiap barang
            $table->string('kode_barang')->unique();        // Kode barang
            $table->string('nama_barang');
            $table->string('kategori');
            $table->string('merk')->nullable();
            $table->string('nomor_seri')->nullable();
            $table->integer('jumlah');
            $table->integer('persentase_kondisi')->nullable();
            $table->string('kondisi')->nullable();
            $table->string('foto')->nullable();
            $table->string('ruangan');
            $table->string('posisi')->nullable(); // ✅ Tambahan posisi rak/meja
            $table->year('tahun_pengadaan')->nullable();
            $table->string('asal_pengadaan')->nullable();    // ✅ Tambahan: Asal pengadaan
            $table->string('peruntukan')->nullable();        // ✅ Tambahan: Peruntukan barang
            $table->text('catatan')->nullable();
            $table->string('qr_code')->nullable();           // Kolom untuk menyimpan path/filename QR code
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bmn_barangs');
    }
};
