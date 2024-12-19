<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaBansos extends Model {
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'no_telepon',
        'jenis_bantuan_id',
    ];

    public function jenisBantuan() {
        return $this->belongsTo(JenisBantuan::class, 'jenis_bantuan_id');
    }
}