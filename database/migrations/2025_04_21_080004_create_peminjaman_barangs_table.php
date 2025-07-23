<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanBarangsTable extends Migration
{
    public function up()
    {
        Schema::create('peminjaman_barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peminjam');
            $table->string('nim_nip');            // tambah kalau butuh NIM/NIP
            $table->string('nomor_hp');            // tambah kalau butuh no HP
            $table->string('nama_barang');         // ini nama barang langsung
            $table->integer('jumlah');
            $table->date('tanggal_peminjaman');    // fix nama kolom sesuai form
            $table->date('tanggal_pengembalian');  // fix nama kolom
            $table->string('status')->default('Belum Disetujui'); // Menambahkan kolom status dengan default value
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('peminjaman_barangs');
    }
}
