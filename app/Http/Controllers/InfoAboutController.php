<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InfoPembuat;

class InfoAboutController extends Controller
{
    public function index()
    {
        $info_pembuats = InfoPembuat::all(); // Ambil semua data dari tabel
        return view('InfoAbout.index', compact('info_pembuats')); // Path view sesuai dengan lokasi file
    }
}
