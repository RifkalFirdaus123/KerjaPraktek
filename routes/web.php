<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\PeminjamanBarangController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

// Halaman depan menampilkan daftar dosen
Route::get('/',   [HomeController::class, 'index'])->name('home.index');



// Dashboard (login required)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile (login required)
Route::middleware('auth')->group(function () {
    Route::get('/profile',   [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');
});

// CRUD resource untuk konten yang dikelola admin
Route::resource('beritas', BeritaController::class);
Route::resource('dosens', DosenController::class);
Route::resource('events', EventController::class);
Route::resource('peminjaman-barangs', PeminjamanBarangController::class);
Route::resource('permintaans', PermintaanController::class);
Route::get('/home', [HomeController::class, 'index'])->name('homes.index');

// Kehadiran: form isi (semua user, no auth)
// ───────────────────────────────────────────
Route::get('/events/{event}/kehadirans/create', 
    [KehadiranController::class, 'create'])
    ->name('kehadirans.create');

// Simpan kehadiran
Route::post('/kehadirans/{event}', 
    [KehadiranController::class, 'store'])
    ->name('kehadirans.store');

// Page daftar kehadiran (semua user)
Route::get('/kehadirans', 
    [KehadiranController::class, 'index'])
    ->name('kehadirans.index');

Route::get('/kehadirans/{event}/edit', 
    [KehadiranController::class, 'edit'])
    ->name('kehadirans.edit');

Route::put('/kehadirans/{event}/edit', 
    [KehadiranController::class, 'update'])
    ->name('kehadirans.update');

Route::delete('/kehadirans/{kehadiran}/delete', 
    [KehadiranController::class, 'destroy'])
    ->name('kehadirans.destroy');

    
    // Rute untuk memperbarui status permintaan
    Route::put('/permintaans/{id}/update-status', [PermintaanController::class, 'updateStatus'])->name('permintaans.updateStatus');
    
    Route::put('/permintaan/{id}/return', [PermintaanController::class, 'markAsReturned'])->name('peminjaman.return');

// Rute untuk memperbarui status permintaan
Route::post('/permintaans/{id}/update-status', [PermintaanController::class, 'updateStatus'])
    ->name('permintaans.updateStatus');


    // Rute untuk menampilkan daftar permintaan peminjaman barang
Route::get('/permintaans', [PermintaanController::class, 'index'])->name('permintaans.index');


Route::put('/permintaans/{id}/disetujui', [PermintaanController::class, 'updateStatus'])->name('permintaans.updateStatus');
Route::put('/permintaans/{id}/ditolak', [PermintaanController::class, 'updateStatusDitolak'])->name('permintaans.updateStatusDitolak');

Route::resource('event', \App\Http\Controllers\EventController::class);

Route::resource('beritas', BeritaController::class);

Route::get('/kehadirans/export-pdf/{eventId}', [KehadiranController::class, 'exportPDF'])
    ->name('kehadirans.export-pdf');// Authentication Routes

Route::put('/permintaan/{id}/cancel', [PermintaanController::class, 'markAsCancelled'])->name('peminjaman.cancel');
Route::put('/permintaan/{id}/complete', [PermintaanController::class, 'markAsCompleted'])->name('peminjaman.complete');

Route::get('/admin/edit-lab-description', [AdminController::class, 'editLabDescription'])->name('admin.editLabDescription');
Route::get('/admin/add-section', [AdminController::class, 'addSection'])->name('admin.addSection');


// Halaman ganti password untuk admin
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/change-password', [\App\Http\Controllers\AdminController::class, 'showChangePasswordForm'])->name('admin.changePasswordForm');
    Route::post('/admin/change-password', [\App\Http\Controllers\AdminController::class, 'changePassword'])->name('admin.changePassword');
});

Route::resource('descriptions', DescriptionController::class)->middleware('auth');
require __DIR__.'/auth.php';

