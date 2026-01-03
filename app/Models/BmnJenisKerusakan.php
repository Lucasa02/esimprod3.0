<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BmnJenisKerusakan extends Model
{
    protected $fillable = ['uuid', 'nama_jenis_kerusakan'];
    

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }
}
