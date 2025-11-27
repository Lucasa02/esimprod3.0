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
        'nup',
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
        'asal_pengadaan',  
        'peruntukan',
        'posisi',
        'catatan',
    ];
public function perawatan()
{
    return $this->hasMany(PerawatanInventaris::class, 'barang_id');
}

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString(); // generate UUID otomatis saat create
        });
    }

public function perawatanAktif()
{
    return $this->hasOne(PerawatanInventaris::class, 'barang_id')
                ->where('status', '!=', 'selesai')
                ->latest();
}


}
