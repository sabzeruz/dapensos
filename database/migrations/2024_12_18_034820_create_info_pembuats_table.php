<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoPembuatsTable extends Migration
{
    public function up()
    {
        Schema::create('info_pembuats', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi');
            $table->string('gambar')->nullable(); // Kolom gambar
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('info_pembuats');
    }
};
