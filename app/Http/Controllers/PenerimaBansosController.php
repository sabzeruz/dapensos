<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenerimaBansosController extends Controller
{
    public function index()
    {
        return view('penerimaBansos.index'); // Pastikan path view benar
    }
}