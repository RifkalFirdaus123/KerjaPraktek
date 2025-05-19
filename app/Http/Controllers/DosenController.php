<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index()
    {
        $dosens = Dosen::orderBy('nama', 'asc')->get();
        return view('dosens.index', compact('dosens'));
    }

    public function create()
    {
        return view('dosens.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:dosens,nip',
            'email' => 'required|email|unique:dosens,email',
            'status' => 'required',
            'matkul' => 'nullable|array',
            'matkul.*' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('fotos', 'public');
            $validated['foto'] = $path;
        }

        Dosen::create($validated);

        return redirect()->route('dosens.index')->with('success', 'Dosen berhasil ditambahkan.');
    }

    public function edit(Dosen $dosen)
    {
        return view('dosens.edit', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:dosens,nip,' . $dosen->id,
            'email' => 'required|email|unique:dosens,email,' . $dosen->id,
            'status' => 'required',
            'matkul' => 'nullable|array',
            'matkul.*' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($dosen->foto) {
                Storage::disk('public')->delete($dosen->foto);
            }
            $path = $request->file('foto')->store('fotos', 'public');
            $validated['foto'] = $path;
        }

        $dosen->update($validated);

        return redirect()->route('dosens.index')->with('success', 'Dosen berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen)
    {
        // Hapus foto juga kalau ada
        if ($dosen->foto) {
            Storage::disk('public')->delete($dosen->foto);
        }

        $dosen->delete();

        return redirect()->route('dosens.index')->with('success', 'Dosen berhasil dihapus.');
    }
}
