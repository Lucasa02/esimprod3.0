<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('bmn_barangs', function (Blueprint $table) {
            if (!Schema::hasColumn('bmn_barangs', 'qr_code')) {
                $table->string('qr_code')->nullable()->after('foto');
            }
        });
    }

    public function down(): void
    {
        Schema::table('bmn_barangs', function (Blueprint $table) {
            if (Schema::hasColumn('bmn_barangs', 'qr_code')) {
                $table->dropColumn('qr_code');
            }
        });
    }
};
