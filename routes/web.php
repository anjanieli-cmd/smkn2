<?php

use Illuminate\Support\Facades\Route;

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

// Karya Siswa
Route::view('/karya-siswa', 'karya-siswa')
    ->name('karya-siswa');




// ==========================================================================
// PPDB
// ==========================================================================
Route::view('/ppdb', 'ppdb.index')
    ->name('ppdb');

// ==========================================================================
// PKL & ALUMNI
// ==========================================================================
Route::view('/pkl-alumni', 'pkl-alumni')
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

Route::view('/galeri/prestasi-sekolah', 'galeri.prestasi-sekolah')
    ->name('prestasi-sekolah');

Route::view('/keahlian/aphp', 'keahlian.aphp')
    ->name('aphp');

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


