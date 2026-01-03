<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BmnRuangan extends Model
{
    use HasFactory;

    protected $table = 'bmn_ruangans';
    protected $fillable = ['uuid', 'nama_ruangan'];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }
}