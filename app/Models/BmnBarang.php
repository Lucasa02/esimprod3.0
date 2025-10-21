<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BmnBarang extends Model
{
    use HasFactory;

    protected $table = 'bmn_barang';

    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'kategori',
        'ruangan',
        'jumlah',
        'kondisi',
        'keterangan'
    ];
}
