<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->integer('limit')->default(1)->change();
            $table->integer('sisa_limit')->default(1)->change();
        });
    }

    public function down(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->integer('limit')->nullable()->change();
            $table->integer('sisa_limit')->nullable()->change();
        });
    }
};

