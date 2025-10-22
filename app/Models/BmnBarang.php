<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BmnBarang extends Model
{
    use HasFactory;

    protected $table = 'bmn_barangs';

    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'kategori',
        'merk',              // baru, opsional
        'nomor_seri',        // baru, opsional
        'jumlah',
        'persentase_kondisi',
        'kondisi',
        'foto',
        'ruangan',
        'tahun_pengadaan',
        'catatan',
    ];
}
