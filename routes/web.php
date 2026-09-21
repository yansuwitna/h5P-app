<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\MateriController;
use Illuminate\Support\Facades\Route;

// Halaman Depan Utama (Landing Page)
Route::get('/', function () {
    $settings = \App\Models\LandingSetting::getAllSettings();
    $totalMateri = \App\Models\MateriH5p::count();
    $totalGuru = \App\Models\Guru::count();
    $totalSiswa = \App\Models\Siswa::count();
    return view('welcome', compact('settings', 'totalMateri', 'totalGuru', 'totalSiswa'));
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/beranda', [BerandaController::class, 'redirectByRole'])->name('beranda');
    
    // Panel Admin & Sub-halaman Terpisah
    Route::get('/admin', [BerandaController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/guru', [BerandaController::class, 'adminGuru'])->name('admin.guru');
    Route::get('/admin/siswa', [BerandaController::class, 'adminSiswa'])->name('admin.siswa');
    Route::get('/admin/cms', [BerandaController::class, 'adminCms'])->name('admin.cms');
    
    // Aksi Form Admin
    Route::post('/admin/landing-settings', [BerandaController::class, 'updateLandingSettings'])->name('admin.landing.update');
    Route::post('/admin/import-guru', [BerandaController::class, 'importGuruExcel'])->name('admin.guru.import');
    Route::post('/admin/import-siswa', [BerandaController::class, 'importSiswaExcel'])->name('admin.siswa.import');
    Route::post('/admin/guru-manual', [BerandaController::class, 'daftarGuruManual'])->name('admin.guru.manual');

    // Panel Guru & Sub-halaman Terpisah
    Route::get('/guru', [BerandaController::class, 'guruDashboard'])->name('guru.dashboard');
    Route::get('/guru/siswa', [BerandaController::class, 'guruSiswa'])->name('guru.siswa');
    Route::get('/guru/materi', [BerandaController::class, 'guruMateri'])->name('guru.materi');
    Route::post('/beranda/siswa', [BerandaController::class, 'daftarSiswa'])->name('siswa.daftar');
    Route::post('/materi/unggah', [MateriController::class, 'unggah'])->name('materi.unggah');
    
    // Panel Siswa & Sub-halaman Terpisah
    Route::get('/siswa', [BerandaController::class, 'siswaDashboard'])->name('siswa.dashboard');
    Route::get('/siswa/materi', [BerandaController::class, 'siswaMateri'])->name('siswa.materi');
    Route::get('/siswa/rapor', [BerandaController::class, 'siswaRapor'])->name('siswa.rapor');
    Route::get('/materi/kerjakan/{id}', [MateriController::class, 'kerjakan'])->name('materi.kerjakan');
    Route::post('/materi/nilai', [MateriController::class, 'simpanNilai'])->name('materi.nilai');

    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
