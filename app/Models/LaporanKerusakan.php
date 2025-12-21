<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LaporanKerusakan extends Model
{
    protected $table = 'laporan_kerusakan';

    protected $fillable = [
        'uuid',
        'barang_id',
        'jenis_kerusakan',
        'deskripsi',
        'foto',
        'status',
    ];

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
