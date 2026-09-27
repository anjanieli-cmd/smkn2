<?php

namespace App\Http\Controllers;

use App\Models\SchoolHistory;
use Illuminate\View\View;

class SejarahSekolahController extends Controller
{
    /**
     * Halaman publik Sejarah Sekolah.
     * Mengambil satu baris konten singleton beserta relasi
     * chapters, principals, dan galleries untuk ditampilkan
     * di resources/views/profile/sejarah-sekolah.blade.php.
     */
    public function index(): View
    {
        $history = SchoolHistory::singleton()->load('chapters', 'principals', 'galleries');

        return view('profile.sejarah-sekolah', compact('history'));
    }
}