<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bmn_barangs', function (Blueprint $table) {
            // 1. Tambah kolom baru
            $table->decimal('nilai_perolehan', 15, 2)->nullable()->after('persentase_kondisi');
            $table->date('tanggal_perolehan')->nullable()->after('nilai_perolehan');
        });

        // 2. Migrasi data: Memindahkan Tahun ke format Tanggal (Data tetap aman)
        // Kita asumsikan tahun 2024 menjadi 2024-01-01
        DB::statement("UPDATE bmn_barangs SET tanggal_perolehan = CAST(CONCAT(tahun_pengadaan, '-01-01') AS DATE) WHERE tahun_pengadaan IS NOT NULL");

        Schema::table('bmn_barangs', function (Blueprint $table) {
            // 3. Hapus kolom lama setelah data berhasil dipindah
            $table->dropColumn('tahun_pengadaan');
        });
    }

    public function down(): void
    {
        Schema::table('bmn_barangs', function (Blueprint $table) {
            // Untuk rollback: tambahkan kembali tahun_pengadaan dan hapus yang baru
            $table->year('tahun_pengadaan')->nullable();
        });

        // Kembalikan data dari tanggal ke tahun
        DB::statement("UPDATE bmn_barangs SET tahun_pengadaan = YEAR(tanggal_perolehan) WHERE tanggal_perolehan IS NOT NULL");

        Schema::table('bmn_barangs', function (Blueprint $table) {
            $table->dropColumn(['nilai_perolehan', 'tanggal_perolehan']);
        });
    }
};