<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perawatan_inventaris', function (Blueprint $table) {
            $table->id();

            $table->string('uuid')->unique();

            $table->unsignedBigInteger('barang_id');
            $table->foreign('barang_id')->references('id')->on('bmn_barangs')->onDelete('cascade');

            $table->date('tanggal_perawatan')->nullable();

            $table->enum('jenis_perawatan', [
                'perbaikan',
                'rencana_penghapusan',
                'penghapusan'
            ])->default('perbaikan');

            $table->text('deskripsi')->nullable();

            $table->enum('status', ['proses', 'pending', 'selesai'])
                  ->default('proses');

            $table->integer('biaya')->nullable();

            $table->string('foto_bukti')->nullable();
            $table->string('foto_kerusakan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perawatan_inventaris');
    }
};
