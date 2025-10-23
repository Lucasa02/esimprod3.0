<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BmnBarang extends Model
{
    use HasFactory;

    protected $table = 'bmn_barangs';

    protected $fillable = [
        'uuid',
        'nama_barang',
        'kode_barang',
        'kategori',
        'merk',
        'nomor_seri',
        'jumlah',
        'persentase_kondisi',
        'kondisi',
        'foto',
        'qr_code',
        'ruangan',
        'tahun_pengadaan',
        'catatan',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString(); // generate UUID otomatis saat create
        });
    }
}
