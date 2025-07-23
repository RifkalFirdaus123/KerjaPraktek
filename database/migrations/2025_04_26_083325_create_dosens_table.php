<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip')->unique();
            $table->string('email')->nullable();
            $table->string('status')->nullable(); // Kolom status (Anggota, Sekretaris KK, dst)
            $table->json('matkul')->nullable();    // Kolom mata kuliah diampu (array/list)
            $table->string('foto')->nullable();    // Kolom foto
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
};
