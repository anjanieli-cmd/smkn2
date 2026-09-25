<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard admin.
     */
    public function index()
    {
        // Ganti dengan query asli sesuai model kamu nanti, contoh:
        // $totalBerita   = Berita::count();
        // $pengunjung    = Pengunjung::count();
        // $pendaftarPpdb = Ppdb::count();
        // $totalGuru     = Guru::count();
        // $totalJurusan  = Jurusan::count();

        return view('admin.dashboard');
    }
}