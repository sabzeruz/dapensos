<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisBantuanTable extends Migration
{
    public function up()
    {
        Schema::create('jenis_bantuans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bantuan', 100);
            $table->text('deskripsi')->nullable();
            $table->string('kriteria', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jenis_bantuans');
    }
};