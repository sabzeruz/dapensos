<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('penerima_bansos', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat');
            $table->string('no_telepon');
            $table->foreignId('jenis_bantuan_id')->constrained('jenis_bantuans');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('penerima_bansos');
    }
};