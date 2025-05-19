<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermintaanTable extends Migration
{
    public function up()
    {
        Schema::create('permintaans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peminta');
            $table->string('nim_nip');
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->string('status')->default('pending'); // Status permintaan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('permintaans');
    }
}
