<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            // ✅ Tambahkan UUID hanya jika kolomnya belum ada
            if (!Schema::hasColumn('barang', 'uuid')) {
                $table->uuid('uuid')->unique()->after('id');
            }
        });
    }

    /**
     * Rollback migrasi.
     */
    public function down(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            if (Schema::hasColumn('barang', 'uuid')) {
                $table->dropColumn('uuid');
            }
        });
    }
};
