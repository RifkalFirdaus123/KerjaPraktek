<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function __construct()
    {
        // Hanya halaman index dan show yang bisa diakses tanpa login
        $this->middleware('auth')->except(['index', 'show']);
    }

    // Menampilkan daftar berita
    public function index()
    {
        $beritas = Berita::latest()
            ->paginate(10); // Show 10 items per page
        
        return view('beritas.index', compact('beritas'));
    }

    // Menampilkan form untuk membuat berita baru
    public function create()
    {
        return view('beritas.create');
    }

    // Menyimpan berita baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'   => 'required|string|max:255',
            'isi'     => 'required|string',
            'foto'    => 'nullable|image',
            'tanggal' => 'nullable',
        ]);

        try {
            if ($request->hasFile('foto')) {
                $validated['foto'] = $request->file('foto')->store('foto_berita', 'public');
            }

            Berita::create($validated);

            return redirect()->route('beritas.index')
                             ->with('success', 'Berita berhasil ditambahkan.');
        } catch (\Exception $e) {
            \Log::error('Gagal menyimpan berita: '.$e->getMessage());

            return redirect()->back()
                             ->withInput()
                             ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan berita.'.$e->getMessage()]);
        }
    }

    // ✅ Menampilkan detail satu berita
    public function show(Berita $berita)
    {
        return view('beritas.show', compact('berita'));
    }

    // Menampilkan form edit berita
    public function edit(Berita $berita)
    {
        return view('beritas.edit', compact('berita'));
    }

    // Memperbarui berita
    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'judul'   => 'required|string|max:255',
            'isi'     => 'required|string',
            'foto'    => 'nullable|image|max:2048',
            'tanggal' => 'nullable|date',
        ]);

        if ($request->hasFile('foto')) {
            if ($berita->foto) {
                Storage::disk('public')->delete($berita->foto);
            }
            $validated['foto'] = $request->file('foto')->store('foto_berita', 'public');
        }

        $berita->update($validated);

        return redirect()->route('beritas.index')
                         ->with('success', 'Berita berhasil diperbarui.');
    }

    // Menghapus berita
    public function destroy(Berita $berita)
    {
        if ($berita->foto) {
            Storage::disk('public')->delete($berita->foto);
        }

        $berita->delete();

        return redirect()->route('beritas.index')
                         ->with('success', 'Berita berhasil dihapus.');
    }
}
