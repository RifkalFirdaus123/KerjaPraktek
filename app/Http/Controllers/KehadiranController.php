<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF; // Add this line

class KehadiranController extends Controller
{
    // Menampilkan daftar kehadiran untuk event tertentu
    public function index()
    {
        // Ambil event berdasarkan ID
        $events = Event::all();
        // Ambil semua kehadiran untuk event tertentu
        // $kehadirans = Kehadiran::where('event_id', $event->id)->get();

        return view('kehadirans.index', compact('events'));
    }

    // Menampilkan form untuk menambah kehadiran untuk event tertentu
    public function create($eventId)
    {
        // Ambil event berdasarkan ID
        $event = Event::findOrFail($eventId);

        // Mengarahkan ke form tambah kehadiran
        return view('kehadirans.create', compact('event'));
    }

    // Menyimpan data kehadiran
    public function store(Request $request, Event $event)
    {
        // dd($request, $event);
        // Validasi input
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'nama' => 'required|string',
            'nim' => 'required|string',
            'angkatan' => 'required|string',
        ]);

        // Menyimpan kehadiran
        Kehadiran::create([
            'event_id' => $request->event_id,
            'nama' => $request->nama,
            'nim' => $request->nim,
            'angkatan' => $request->angkatan,
        ]);

        if(!Auth::user()) {
            // Mengarahkan kembali ke halaman daftar kehadiran setelah update
            return redirect()->route('events.index')
                             ->with('success', 'Kehadiran berhasil diisi, terimakasih!');
        } 

        return redirect()->route('kehadirans.index');
    }

    // Menampilkan form edit kehadiran
    public function edit(Kehadiran $kehadiran, $eventId)
    {
        // Ambil semua event
        $event = Event::findOrFail($eventId);

        $kehadirans = Kehadiran::where('event_id', $event->id)->get();
        // Mengarahkan ke form edit kehadiran
        return view('kehadirans.edit', compact('kehadirans', 'event', 'eventId'));
    }

    // Memperbarui data kehadiran
    public function update(Request $request, Kehadiran $kehadiran)
    {
        // Validasi input
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'nama' => 'required|string',
            'nim' => 'required|string',
            'angkatan' => 'required|string',
        ]);

        // Update data kehadiran
        $kehadiran->update($request->all());
        if(!Auth::user()) {
            // Mengarahkan kembali ke halaman daftar kehadiran setelah update
            return redirect()->route('events.index', $kehadiran->event_id)
                             ->with('success', 'Kehadiran berhasil diisi, terimakasih!');
        } 

        return redirect()->route('kehadirans.index');
    }

    // Menghapus data kehadiran
    public function destroy(Kehadiran $kehadiran)
    {
        // dd($kehadiran);
        // $kehadiran = Kehadiran::findOrFail($kehadiran);
        // Menghapus data kehadiran
        $kehadiran->delete();

        // Mengarahkan kembali ke halaman daftar kehadiran setelah penghapusan
        return redirect()->back()
                         ->with('success', 'Kehadiran berhasil dihapus!');
    }

    // Menampilkan daftar kehadiran dalam format HTML
    public function showHtml($eventId)
    {
        $event = Event::findOrFail($eventId);
        $kehadirans = Kehadiran::where('event_id', $event->id)->get();
        $tanggal = now()->format('d-m-Y');

        return response()->view('kehadirans.html', compact('event', 'kehadirans', 'tanggal'));
    }

    public function exportPDF($event)
    {
        try {
            // Find the event
            $event = Event::findOrFail($event);
            
            // Get kehadirans for this event
            $kehadirans = Kehadiran::where('event_id', $event->id)
                                  ->orderBy('nama', 'asc')
                                  ->get();
            
            // Load PDF view
            $pdf = PDF::loadView('kehadirans.show', [
                'event' => $event,
                'kehadirans' => $kehadirans,
                'tanggal' => now()->format('d/m/Y')
            ]);
            
            return $pdf->download('daftar-kehadiran-'.$event->nama_event.'.pdf');
            
        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Gagal menghasilkan PDF: ' . $e->getMessage());
        }
    }
}
