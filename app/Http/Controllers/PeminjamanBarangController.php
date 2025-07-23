<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanBarang;
use Illuminate\Http\Request;

class PeminjamanBarangController extends Controller
{
    // Menampilkan daftar peminjaman barang
    public function index()
    {
        $peminjamanBarangs = PeminjamanBarang::all();
        return view('peminjaman-barangs.index', compact('peminjamanBarangs'));
    }

    // Menampilkan form peminjaman barang
    public function create()
    {
        return view('peminjaman-barangs.create');
    }

    // Menyimpan data peminjaman barang
    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'nim_nip' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:20',
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'tanggal_peminjaman' => 'required|date',
            'tanggal_pengembalian' => 'required|date',
        ]);

        // Menyimpan data ke dalam database
        PeminjamanBarang::create([
            'nama_peminjam' => $request->nama_peminjam,
            'nim_nip' => $request->nim_nip,
            'nomor_hp' => $request->nomor_hp,
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
        ]);

    return redirect()->route('peminjaman-barangs.index')
        ->with('success', 'Terima kasih! Peminjaman berhasil diajukan. Silakan pantau status peminjaman Anda.');
    }
}
