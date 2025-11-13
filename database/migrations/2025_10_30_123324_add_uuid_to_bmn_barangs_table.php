<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('bmn_barangs', function (Blueprint $table) {
            if (!Schema::hasColumn('bmn_barangs', 'uuid')) {
                $table->uuid('uuid')->unique()->after('id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('bmn_barangs', function (Blueprint $table) {
            if (Schema::hasColumn('bmn_barangs', 'uuid')) {
                $table->dropColumn('uuid');
            }
        });
    }
};