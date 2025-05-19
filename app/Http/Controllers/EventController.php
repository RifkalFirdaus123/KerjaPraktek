<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    // Menampilkan daftar event
    public function index()
    {
        $events = Event::latest()
            ->paginate(9); // Show 9 items per page
        
        return view('events.index', compact('events'));
    }

    // Menampilkan form untuk membuat event baru
    public function create()
    {
        return view('events.create');
    }

    // Menyimpan event baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_event' => 'required|string|max:255',
            'deskripsi'  => 'required|string',
            'tanggal_event' => 'required|date',
            'waktu'      => 'nullable|date_format:H:i',
        ]);

        try {
            if ($request->hasFile('foto')) {
                $validated['foto'] = $request->file('foto')->store('foto_event', 'public');
            }

            Event::create($validated);

            return redirect()->route('events.index')->with('success', 'Event berhasil ditambahkan.');
        } catch (\Exception $e) {
            \Log::error('Gagal menyimpan event: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan event.'. $e->getMessage()]);
        }
    }

    // Menampilkan form untuk mengedit event
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    // Memperbarui data event
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'nama_event' => 'required|string|max:255',
            'deskripsi'  => 'required|string',
            'foto'       => 'nullable|image|max:2048',
            'tanggal_event'    => 'nullable|date',
            'waktu'      => 'nullable|date_format:H:i',
        ]);

        if ($request->hasFile('foto')) {
            if ($event->foto) {
                Storage::disk('public')->delete($event->foto);
            }
            $validated['foto'] = $request->file('foto')->store('foto_event', 'public');
        }

        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Event berhasil diperbarui.');
    }

    // Menghapus event
    public function destroy(Event $event)
    {
        if ($event->foto) {
            Storage::disk('public')->delete($event->foto);
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event berhasil dihapus.');
    }
}
