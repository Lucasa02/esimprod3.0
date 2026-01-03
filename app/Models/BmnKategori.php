<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BmnKategori extends Model
{
    use HasFactory;

    protected $table = 'bmn_kategoris';
    protected $fillable = ['uuid', 'nama_kategori'];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }
}