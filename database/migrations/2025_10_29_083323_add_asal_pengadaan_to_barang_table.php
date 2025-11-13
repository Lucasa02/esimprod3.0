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
    Schema::table('barang', function (Blueprint $table) {
        if (!Schema::hasColumn('barang', 'asal_pengadaan')) {
            $table->string('asal_pengadaan')->nullable()->after('tahun_pengadaan');
        }
    });
}


public function down(): void
{
    Schema::table('barang', function (Blueprint $table) {
        $table->dropColumn('asal_pengadaan');
    });
}

};
