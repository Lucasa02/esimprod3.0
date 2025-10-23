<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            if (!Schema::hasColumn('barang', 'jumlah')) {
                $table->integer('jumlah')->nullable()->after('merk');
            }

            if (!Schema::hasColumn('barang', 'kondisi')) {
                $table->integer('kondisi')->nullable()->after('jumlah');
            }

            if (!Schema::hasColumn('barang', 'tahun_pengadaan')) {
                $table->year('tahun_pengadaan')->nullable()->after('kondisi');
            }

            if (!Schema::hasColumn('barang', 'catatan')) {
                $table->text('catatan')->nullable()->after('tahun_pengadaan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            if (Schema::hasColumn('barang', 'jumlah')) {
                $table->dropColumn('jumlah');
            }
            if (Schema::hasColumn('barang', 'kondisi')) {
                $table->dropColumn('kondisi');
            }
            if (Schema::hasColumn('barang', 'tahun_pengadaan')) {
                $table->dropColumn('tahun_pengadaan');
            }
            if (Schema::hasColumn('barang', 'catatan')) {
                $table->dropColumn('catatan');
            }
        });
    }
};
