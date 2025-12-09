<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'foto_bukti'
    ];

    public function barang()
    {
        return $this->belongsTo(BmnBarang::class, 'barang_id');
    }
}
