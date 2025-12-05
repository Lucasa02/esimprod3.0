<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surat';
    protected $fillable = ['barang_uuid', 'nama_file', 'status'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_uuid', 'uuid');
    }
}
