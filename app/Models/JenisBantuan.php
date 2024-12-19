<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBantuan extends Model
{
    use HasFactory;

    protected $table = 'jenis_bantuans';

    protected $fillable = [
        'nama_bantuan',
        'deskripsi',
        'kriteria',
    ];
}