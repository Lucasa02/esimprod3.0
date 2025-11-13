<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $with = ['jenisBarang'];

    protected $fillable = [
    'uuid',
    'kode_barang',
    'nama_barang',
    'jenis_barang_id',
    'jumlah',
    'kondisi',
    'tahun_pengadaan',
    'asal_pengadaan',
    'catatan',
    'nomor_seri',
    'merk',
    'status',
    'deskripsi',
    'qr_code',
    'limit',
    'sisa_limit',
    'foto',
    'studio',
];


    protected static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        // UUID otomatis
        if (empty($model->uuid)) {
            $model->uuid = (string) Str::uuid();
        }

        // ✅ Generate kode unik otomatis (BRG-0001, BRG-0002, dst)
if (empty($model->kode_barang)) {
    // Ambil angka terbesar dari kolom kode_barang
    $lastNumber = DB::table('barang')
        ->select(DB::raw('MAX(CAST(SUBSTRING(kode_barang, 5) AS UNSIGNED)) AS last_number'))
        ->value('last_number');

    $nextNumber = $lastNumber ? $lastNumber + 1 : 1;
    $model->kode_barang = 'BRG-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
}


        // Nomor Seri Otomatis
        if (empty($model->nomor_seri)) {
            $model->nomor_seri = 'NS-' . strtoupper(Str::random(6));
        }

        // Merk default
        if (empty($model->merk)) {
            $model->merk = 'Belum Ditetapkan';
        }

        // Jenis Barang default
        if (empty($model->jenis_barang_id)) {
            $model->jenis_barang_id = 1;
        }

        // Studio default
        if (empty($model->studio)) {
            $model->studio = 'studio1';
        }

        // QR Code default
        if (empty($model->qr_code)) {
            $model->qr_code = 'QR-' . $model->kode_barang;
        }

        // Limit & Sisa Limit default
        if (empty($model->limit)) {
            $model->limit = 1;
        }
        if (empty($model->sisa_limit)) {
            $model->sisa_limit = $model->limit;
        }
    });
}


    // 🔗 Relasi ke tabel jenis_barang
    public function jenisBarang(): BelongsTo
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_barang_id');
    }

    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class, 'kode_barang', 'kode_barang');
    }

    public function detail_peminjaman(): HasMany
    {
        return $this->hasMany(DetailPeminjaman::class, 'kode_barang', 'kode_barang');
    }

    public function detail_pengembalian(): HasMany
    {
        return $this->hasMany(DetailPengembalian::class, 'kode_barang', 'kode_barang');
    }
}
