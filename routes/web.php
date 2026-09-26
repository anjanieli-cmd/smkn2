<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes — SMK Negeri 2 Mojokerto
|--------------------------------------------------------------------------
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
Route::view('/profil', 'profil')->name('profil');
Route::view('/profile/sejarah-sekolah', 'profile.sejarah-sekolah')->name('profil.sejarah-sekolah');
Route::view('/profile/visi-misi', 'profile.visi-misi')->name('profil.visi-misi');
Route::view('/profile/struktur-organisasi', 'profile.struktur-organisasi')->name('profil.struktur-organisasi');

// Guru & Staf (Dynamic DB data)
Route::get('/profile/guru-staf', function () {
    $teachers = \App\Models\TeacherStaff::where('is_active', true)->orderBy('name', 'asc')->get();
    return view('profile.guru-staf', compact('teachers'));
})->name('profil.guru-staf');

Route::view('/profile/roadmap-pengembangan', 'profile.roadmap-pengembangan')->name('profil.roadmap-pengembangan');
Route::view('/profile/tour', 'profile.tour')->name('profil.tour');


// ==========================================================================
// PROGRAM KEAHLIAN
// ==========================================================================
Route::get('/program-keahlian', function () {
    $majors = \App\Models\Major::all();
    return view('program-keahlian', compact('majors'));
})->name('program-keahlian');

Route::view('/keahlian/aphp', 'keahlian.aphp')->name('aphp');
Route::view('/keahlian/dkv', 'keahlian.dkv')->name('dkv');
Route::view('/keahlian/kuliner', 'keahlian.kuliner')->name('kuliner');
Route::view('/keahlian/lps', 'keahlian.lps')->name('lps');
Route::view('/keahlian/rpl', 'keahlian.rpl')->name('rpl');


// ==========================================================================
// SISWA & EKSKUL
// ==========================================================================
Route::view('/karya-siswa', 'karya-siswa')->name('karya-siswa.legacy');

Route::get('/siswa/karya-siswa', function () {
    $studentWorks = \App\Models\StudentWork::with('major')->latest()->get();
    return view('siswa.karya-siswa', compact('studentWorks'));
})->name('karya-siswa');

Route::view('/siswa/prestasi-siswa', 'siswa.prestasi-siswa')->name('prestasi-siswa');

Route::get('/siswa/ekstrakurikuler', function () {
    $extracurriculars = \App\Models\Extracurricular::all();
    return view('siswa.ekstrakurikuler', compact('extracurriculars'));
})->name('ekstrakurikuler');

Route::get('/siswa/voice', function () {
    $eVoices = \App\Models\EVoice::latest()->get();
    return view('siswa.voice', compact('eVoices'));
})->name('voice');


// ==========================================================================
// PUBLIKASI & BERITA
// ==========================================================================
Route::get('/berita/index', function () {
    $news = \App\Models\NewsArticle::latest()->get();
    return view('berita.index', compact('news'));
})->name('index');

Route::get('/berita/factcheck', function () {
    $factChecks = \App\Models\FactCheck::latest()->get();
    return view('berita.factcheck', compact('factChecks'));
})->name('factcheck');

Route::view('/galeri/kegiatan', 'galeri.kegiatan')->name('kegiatan');
Route::view('/prestasi', 'siswa.prestasi-siswa')->name('prestasi');
Route::redirect('/galeri/prestasi-sekolah', '/prestasi')->name('prestasi-sekolah');


// ==========================================================================
// BKK, LOKER & ALUMNI
// ==========================================================================
Route::get('/bkk-loker', function () {
    $jobVacancies = \App\Models\JobVacancy::latest()->get();
    $industries = \App\Models\IndustryPartnership::all();
    return view('bkk-loker', compact('jobVacancies', 'industries'));
})->name('bkk-loker');

Route::redirect('/pkl-alumni', '/bkk-loker')->name('pkl-alumni');
Route::redirect('/kontak', '/#kontak')->name('kontak');

Route::get('/alumni/portofolio', function () {
    $alumni = \App\Models\Alumni::with('major')->latest()->get();
    return view('alumni.portofolio', compact('alumni'));
})->name('portofolio');

Route::view('/ppdb', 'ppdb.index')->name('ppdb');
Route::view('/ai', 'ai')->name('ai');


// ==========================================================================
// ADMIN PANEL (DEDICATED PAGES)
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

        // Dedicated Admin Pages
        Route::get('/news', function () {
            $items = \App\Models\NewsArticle::latest()->get();
            return view('admin.news.index', compact('items'));
        })->name('news.index');

        Route::get('/teachers', function () {
            $teachers = \App\Models\TeacherStaff::orderBy('name', 'asc')->get();
            return view('admin.teachers.index', compact('teachers'));
        })->name('teachers.index');

        Route::get('/majors', function () {
            $items = \App\Models\Major::all();
            return view('admin.majors.index', compact('items'));
        })->name('majors.index');

        Route::get('/extracurriculars', function () {
            $items = \App\Models\Extracurricular::orderBy('name', 'asc')->get();
            return view('admin.extracurriculars.index', compact('items'));
        })->name('extracurriculars.index');

        Route::get('/industries', function () {
            $items = \App\Models\IndustryPartnership::all();
            return view('admin.industries.index', compact('items'));
        })->name('industries.index');

        Route::get('/job-vacancies', function () {
            $items = \App\Models\JobVacancy::latest()->get();
            return view('admin.job-vacancies.index', compact('items'));
        })->name('job-vacancies.index');

        Route::get('/student-works', function () {
            $items = \App\Models\StudentWork::with('major')->latest()->get();
            return view('admin.student-works.index', compact('items'));
        })->name('student-works.index');

        Route::get('/alumni', function () {
            $items = \App\Models\Alumni::with('major')->latest()->get();
            return view('admin.alumni.index', compact('items'));
        })->name('alumni.index');

        Route::get('/fact-checks', function () {
            $items = \App\Models\FactCheck::latest()->get();
            return view('admin.fact-checks.index', compact('items'));
        })->name('fact-checks.index');

        Route::get('/e-voices', function () {
            $items = \App\Models\EVoice::latest()->get();
            return view('admin.e-voices.index', compact('items'));
        })->name('e-voices.index');

        Route::get('/chatbot-knowledge', function () {
            $items = \App\Models\ChatbotKnowledge::latest()->get();
            return view('admin.chatbot-knowledge.index', compact('items'));
        })->name('chatbot-knowledge.index');
    });

});