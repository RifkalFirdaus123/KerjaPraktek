<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('nama_event');
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable(); // Kolom untuk menyimpan nama file foto (nullable karena tidak selalu ada)
            $table->date('tanggal_event')->nullable();
            $table->time('waktu')->nullable(); // Menambahkan kolom pukul (jam)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
