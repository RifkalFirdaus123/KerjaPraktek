<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Tampilkan form ganti password
    public function showChangePasswordForm()
    {
        return view('admin.change-password');
    }

    // Proses ganti password
    public function changePassword(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'current_password' => ['nullable'],
            'new_password' => ['nullable', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();
        $update = false;

        // Update username jika berubah
        if ($request->name !== $user->name) {
            $user->name = $request->name;
            $update = true;
        }

        // Jika ingin ganti password
        if ($request->filled('new_password')) {
            if (!$request->filled('current_password') || !Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password lama salah.']);
            }
            $user->password = Hash::make($request->new_password);
            $update = true;
        }

        if ($update) {
            $user->save();
            return back()->with('status', 'Perubahan berhasil disimpan.');
        }

        return back()->with('status', 'Tidak ada perubahan.');
    }
}
