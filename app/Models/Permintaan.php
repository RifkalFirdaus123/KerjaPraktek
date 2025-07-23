<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_peminta', 
        'nim_nip', 
        'nama_barang', 
        'jumlah', 
        'status'
    ];
}
