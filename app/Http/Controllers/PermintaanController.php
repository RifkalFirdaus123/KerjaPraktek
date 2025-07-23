<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanBarang;
use Illuminate\Http\Request;

class PermintaanController extends Controller
{
    // Menampilkan daftar semua permintaan dan yang disetujui
    public function index(Request $request)
    {
        // Tampilkan 5 data terbaru, paginasi
        $peminjamanBarangs = \App\Models\PeminjamanBarang::latest()->paginate(5);

        // Ambil semua yang statusnya Disetujui atau Selesai Dipinjam untuk tabel bawah
        $peminjamanBarangsDisetujui = \App\Models\PeminjamanBarang::whereIn('status', ['Disetujui', 'Selesai Dipinjam'])
            ->latest()
            ->paginate(5, ['*'], 'disetujui_page');

        return view('permintaans.index', compact('peminjamanBarangs', 'peminjamanBarangsDisetujui'));
    }

    // Menyetujui permintaan
    public function updateStatus($id)
    {
        $peminjaman = PeminjamanBarang::findOrFail($id);

        if ($peminjaman->status !== 'Disetujui') {
            $peminjaman->status = 'Disetujui';
            $peminjaman->save();

            return redirect()->route('permintaans.index')
                ->with('success', 'Permintaan berhasil disetujui!');
        }

        return redirect()->route('permintaans.index')
            ->with('info', 'Permintaan sudah disetujui sebelumnya.');
    }

    // Menolak permintaan
    public function updateStatusDitolak($id)
    {
        $peminjaman = PeminjamanBarang::findOrFail($id);
        $peminjaman->status = 'Tidak Disetujui';
        $peminjaman->save();

        return redirect()->route('permintaans.index')
            ->with('error', 'Permintaan telah ditolak.');
    }

    // Menandai peminjaman sebagai "Telah Dikembalikan"
    public function markAsReturned($id)
    {
        $peminjaman = PeminjamanBarang::findOrFail($id);
        $peminjaman->status = 'Telah Dikembalikan';
        $peminjaman->save();

        return redirect()->route('permintaans.index')
            ->with('success', 'Status berhasil diperbarui menjadi Telah Dikembalikan.');
    }

    // Membatalkan peminjaman
    public function markAsCancelled($id)
    {
        try {
            $peminjaman = PeminjamanBarang::findOrFail($id);

            if ($peminjaman->status === 'Disetujui') {
                $peminjaman->status = 'Batal Dipinjam';
                $peminjaman->save();

                return redirect()->route('permintaans.index')
                    ->with('success', 'Peminjaman berhasil dibatalkan.');
            }

            return redirect()->route('permintaans.index')
                ->with('error', 'Peminjaman hanya dapat dibatalkan jika statusnya Disetujui.');
        } catch (\Exception $e) {
            return redirect()->route('permintaans.index')
                ->with('error', 'Terjadi kesalahan saat membatalkan peminjaman.');
        }
    }

    // Menyelesaikan peminjaman
    public function markAsCompleted($id)
    {
        try {
            $peminjaman = PeminjamanBarang::findOrFail($id);

            if ($peminjaman->status === 'Disetujui') {
                // Update status untuk semua entri dengan data yang sama
                PeminjamanBarang::where('nama_peminjam', $peminjaman->nama_peminjam)
                    ->where('nim_nip', $peminjaman->nim_nip)
                    ->where('nama_barang', $peminjaman->nama_barang)
                    ->where('jumlah', $peminjaman->jumlah)
                    ->where('tanggal_peminjaman', $peminjaman->tanggal_peminjaman)
                    ->where('tanggal_pengembalian', $peminjaman->tanggal_pengembalian)
                    ->update(['status' => 'Selesai Dipinjam']);

                return redirect()->route('permintaans.index')
                    ->with('success', 'Peminjaman telah ditandai sebagai selesai.');
            }

            return redirect()->route('permintaans.index')
                ->with('error', 'Tidak dapat menyelesaikan peminjaman yang bukan berstatus Disetujui.');
        } catch (\Exception $e) {
            return redirect()->route('permintaans.index')
                ->with('error', 'Terjadi kesalahan saat menyelesaikan peminjaman.');
        }
    }
}
