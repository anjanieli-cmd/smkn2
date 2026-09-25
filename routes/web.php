<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes — SMK Negeri 2 Mojokerto
|--------------------------------------------------------------------------
|
| Route disesuaikan dengan route() yang dipakai di
| resources/views/layouts/app.blade.php.
|
*/

// ==========================================================================
// BERANDA
// ==========================================================================
Route::get('/', function () {
    return view('welcome');
})->name('home');


// ==========================================================================
// PROFIL
// ==========================================================================

// Profil utama
Route::view('/profil', 'profil')->name('profil');

// Sejarah Sekolah
Route::view('/profile/sejarah-sekolah', 'profile.sejarah-sekolah')
    ->name('profil.sejarah-sekolah');

// Visi & Misi
Route::view('/profile/visi-misi', 'profile.visi-misi')
    ->name('profil.visi-misi');

// Struktur Organisasi
Route::view('/profile/struktur-organisasi', 'profile.struktur-organisasi')
    ->name('profil.struktur-organisasi');

// Guru & Staf
Route::view('/profile/guru-staf', 'profile.guru-staf')
    ->name('profil.guru-staf');

// Roadmap Pengembangan
Route::view('/profile/roadmap-pengembangan', 'profile.roadmap-pengembangan')
    ->name('profil.roadmap-pengembangan');

Route::view('/profile/tour', 'profile.tour')
    ->name('profil.tour');



// ==========================================================================
// PROGRAM KEAHLIAN
// ==========================================================================

// Halaman utama Program Keahlian
Route::view('/program-keahlian', 'program-keahlian')
    ->name('program-keahlian');

// APHP
Route::view('/keahlian/aphp', 'keahlian.aphp')
    ->name('aphp');


// ==========================================================================
// SISWA
// ==========================================================================

// Karya Siswa (legacy path — dipertahankan biar link lama tidak 404)
Route::view('/karya-siswa', 'karya-siswa')
    ->name('karya-siswa.legacy');


// ==========================================================================
// PPDB
// ==========================================================================
Route::view('/ppdb', 'ppdb.index')
    ->name('ppdb');

// ==========================================================================
// BKK & LOKER
// ==========================================================================
Route::view('/bkk-loker', 'bkk-loker')
    ->name('bkk-loker');

// Route lama tetap dipertahankan agar link lama tidak rusak.
Route::redirect('/pkl-alumni', '/bkk-loker')
    ->name('pkl-alumni');

Route::redirect('/kontak', '/#kontak')
    ->name('kontak');

Route::view('/siswa/karya-siswa', 'siswa.karya-siswa')
    ->name('karya-siswa');

Route::view('/siswa/prestasi-siswa', 'siswa.prestasi-siswa')
    ->name('prestasi-siswa');

Route::view('/siswa/ekstrakurikuler', 'siswa.ekstrakurikuler')
    ->name('ekstrakurikuler');

Route::view('/berita/index', 'berita.index')
    ->name('index');

Route::view('/galeri/kegiatan', 'galeri.kegiatan')
    ->name('kegiatan');

// Prestasi — gabungan Prestasi Siswa & Prestasi Sekolah
Route::view('/prestasi', 'siswa.prestasi-siswa')
    ->name('prestasi');

// Route lama tetap dipertahankan agar link lama tidak rusak.
Route::redirect('/galeri/prestasi-sekolah', '/prestasi')
    ->name('prestasi-sekolah');

Route::view('/keahlian/dkv', 'keahlian.dkv')
    ->name('dkv');

Route::view('/keahlian/kuliner', 'keahlian.kuliner')
    ->name('kuliner');

Route::view('/keahlian/lps', 'keahlian.lps')
    ->name('lps');

Route::view('/keahlian/rpl', 'keahlian.rpl')
    ->name('rpl');

Route::view('/siswa/voice', 'siswa.voice')
    ->name('voice');

Route::view('/berita/factcheck', 'berita.factcheck')
    ->name('factcheck');

Route::view('/alumni/portofolio', 'alumni.portofolio')
    ->name('portofolio');

Route::view('ai', 'ai')
    ->name('ai');


// ==========================================================================
// ADMIN
// ==========================================================================
Route::prefix('admin')->name('admin.')->group(function () {

    // ===== Halaman login (khusus tamu / belum login) =====
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    });

    // ===== Halaman yang butuh login =====
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        // contoh route modul lain, tinggal tambah sesuai kebutuhan:
        // Route::resource('berita', BeritaController::class);
        // Route::resource('galeri', GaleriController::class);
        // Route::resource('ppdb', PpdbController::class);
    });

});