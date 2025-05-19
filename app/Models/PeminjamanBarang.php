<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanBarang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_peminjam', 'nim_nip', 'nomor_hp', 'nama_barang', 'jumlah', 
        'tanggal_peminjaman', 'tanggal_pengembalian', 'status', 'foto_bukti_pengembalian'
    ];
}
