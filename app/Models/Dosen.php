<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi
    protected $fillable = [
        'nama', 'nip', 'email', 'foto', 'status', 'matkul'
    ];

    // Cast matkul ke array otomatis
    protected $casts = [
        'matkul' => 'array',
    ];
}
