<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class PerawatanInventaris extends Model
{
    use HasFactory;

    protected $table = 'perawatan_inventaris';

    protected $fillable = [
        'uuid',
        'barang_id',
        'tanggal_perawatan',
        'jenis_perawatan',
        'deskripsi',
        'status',
        'biaya',
        'foto_kerusakan',
        'foto_bukti',
        'surat_penghapusan'
        
    ];

    // Tambahkan ini agar UUID terisi otomatis
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function barang()
    {
        return $this->belongsTo(BmnBarang::class, 'barang_id');
    }

    
}
