<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — SMK Negeri 2 Mojokerto
|--------------------------------------------------------------------------
|
| Contoh rute untuk project Laravel.
| File view yang dipakai:
|   - resources/views/index.blade.php       (beranda, pakai @include partials)
|   - resources/views/layouts/app.blade.php (layout utama, pakai @extends)
|
*/

// ===== BERANDA =====
// index.blade.php memanggil @include('partials.header') & @include('partials.footer')
Route::get('/', function () {
    return view('index');
})->name('home');

// ===== CONTOH HALAMAN LAIN (menggunakan layout utama) =====
// Buat file resources/views/profil.blade.php dengan struktur:
//   @extends('layouts.app')
//   @section('title', 'Profil Sekolah — SMK Negeri 2 Mojokerto')
//   @section('content') ... konten ... @endsection
Route::view('/profil', 'profil')->name('profil');

// Rute untuk halaman-halaman lain yang akan menyusul
// (career-roadmap, pkl-tracer, karya-siswa, school-roadmap):
// Route::view('/peta-karier', 'career-roadmap')->name('career-roadmap');
// Route::view('/pkl-alumni',  'pkl-tracer')->name('pkl-tracer');
// Route::view('/karya-siswa', 'karya-siswa')->name('karya-siswa');
// Route::view('/roadmap',     'school-roadmap')->name('school-roadmap');
