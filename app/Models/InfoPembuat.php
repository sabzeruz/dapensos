<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoPembuat extends Model
{
    use HasFactory;

    protected $table = 'info_pembuats'; // Pastikan nama tabel sesuai
    protected $fillable = ['nama', 'deskripsi', 'gambar'];
}

