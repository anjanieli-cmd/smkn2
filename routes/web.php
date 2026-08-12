<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — SMK Negeri 2 Mojokerto
|--------------------------------------------------------------------------
|
| File view yang dipakai:
|   - resources/views/welcome.blade.php     (beranda — file utuh hasil
|     penggabungan header + index + footer, TANPA @include partials)
|   - resources/views/layouts/app.blade.php (layout utama, pakai @extends)
|
*/

// ===== BERANDA =====
// welcome.blade.php adalah file utuh (header + index + footer sudah
// dilebur menjadi satu), sehingga tidak perlu @include partials lagi.
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ===== PROFIL =====
// Buat file resources/views/profil.blade.php dengan struktur:
//   @extends('layouts.app')
//   @section('title', 'Profil Sekolah — SMK Negeri 2 Mojokerto')
//   @section('content') ... konten ... @endsection
Route::view('/profil', 'profil')->name('profil');

// ===== PROGRAM KEAHLIAN =====
// Buat file resources/views/program-keahlian.blade.php
Route::view('/program-keahlian', 'program-keahlian')->name('program-keahlian');

// ===== KARYA SISWA =====
// Buat file resources/views/karya-siswa.blade.php
Route::view('/karya-siswa', 'karya-siswa')->name('karya-siswa');

// ===== PKL & ALUMNI =====
// Buat file resources/views/pkl-alumni.blade.php
Route::view('/pkl-alumni', 'pkl-alumni')->name('pkl-alumni');

// ===== PPDB (tombol CTA "Daftar PPDB") =====
// Buat file resources/views/ppdb.blade.php
Route::view('/ppdb', 'ppdb')->name('ppdb');