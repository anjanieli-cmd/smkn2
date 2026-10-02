<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\SchoolHistoryController;
use App\Http\Controllers\Admin\GalleryAdminController;
use App\Http\Controllers\Admin\AchievementAdminController;
use App\Http\Controllers\SejarahSekolahController;
use App\Http\Controllers\Admin\TourAdminController;
use App\Http\Controllers\Api\TourApiController;
use App\Http\Controllers\Admin\VisiMisiAdminController;
use App\Http\Controllers\Admin\StrukturAdminController;
use App\Http\Controllers\Admin\PpdbAdminController;
use App\Http\Controllers\Admin\BeritaAdminController;

Route::middleware(['auth'])            // <- samakan dengan grup admin kamu
    ->prefix('admin/berita')
    ->name('admin.berita.')
    ->group(function () {
        Route::get('/', [BeritaAdminController::class, 'index'])->name('index');

        // teks halaman (hero, strip, CTA)
        Route::put('/settings', [BeritaAdminController::class, 'updateSettings'])->name('settings.update');

        // artikel
        Route::post('/articles', [BeritaAdminController::class, 'storeArticle'])->name('articles.store');
        Route::put('/articles/{article}', [BeritaAdminController::class, 'updateArticle'])->name('articles.update');
        Route::delete('/articles/{article}', [BeritaAdminController::class, 'destroyArticle'])->name('articles.destroy');
        Route::post('/articles/{article}/toggle', [BeritaAdminController::class, 'toggleArticle'])->name('articles.toggle');
        Route::post('/articles/{article}/move/{direction}', [BeritaAdminController::class, 'moveArticle'])
            ->whereIn('direction', ['up', 'down'])->name('articles.move');

        // penempatan (featured / side / most_read)
        Route::put('/placements', [BeritaAdminController::class, 'updatePlacements'])->name('placements.update');

        // cerita skaneda
        Route::post('/stories', [BeritaAdminController::class, 'storeStory'])->name('stories.store');
        Route::put('/stories/{story}', [BeritaAdminController::class, 'updateStory'])->name('stories.update');
        Route::delete('/stories/{story}', [BeritaAdminController::class, 'destroyStory'])->name('stories.destroy');
        Route::post('/stories/{story}/toggle', [BeritaAdminController::class, 'toggleStory'])->name('stories.toggle');
        Route::post('/stories/{story}/move/{direction}', [BeritaAdminController::class, 'moveStory'])
            ->whereIn('direction', ['up', 'down'])->name('stories.move');

        // kategori
        Route::post('/categories', [BeritaAdminController::class, 'storeCategory'])->name('categories.store');
        Route::put('/categories/{category}', [BeritaAdminController::class, 'updateCategory'])->name('categories.update');
        Route::delete('/categories/{category}', [BeritaAdminController::class, 'destroyCategory'])->name('categories.destroy');
        Route::post('/categories/{category}/move/{direction}', [BeritaAdminController::class, 'moveCategory'])
            ->whereIn('direction', ['up', 'down'])->name('categories.move');
    });

Route::middleware(['auth'])            // <- samakan dengan grup admin kamu
    ->prefix('admin/ppdb')
    ->name('admin.ppdb.')
    ->group(function () {
        Route::get('/', [PpdbAdminController::class, 'index'])->name('index');

        // teks per tab: teks | definisi | jalur | syarat | alur | jadwal | jurusan | faq
        Route::put('/settings/{tab}', [PpdbAdminController::class, 'updateSettings'])
            ->whereIn('tab', ['teks', 'definisi', 'jalur', 'syarat', 'alur', 'jadwal', 'jurusan', 'faq'])
            ->name('settings.update');

        // daftar (kartu / baris) per section
        Route::post('/items/{section}', [PpdbAdminController::class, 'storeItem'])
            ->whereIn('section', ['definisi', 'jalur', 'syarat', 'alur', 'jadwal', 'jurusan', 'faq'])
            ->name('items.store');
        Route::put('/items/{item}', [PpdbAdminController::class, 'updateItem'])->name('items.update');
        Route::delete('/items/{item}', [PpdbAdminController::class, 'destroyItem'])->name('items.destroy');
        Route::post('/items/{item}/toggle', [PpdbAdminController::class, 'toggleItem'])->name('items.toggle');
        Route::post('/items/{item}/move/{direction}', [PpdbAdminController::class, 'moveItem'])
            ->whereIn('direction', ['up', 'down'])->name('items.move');
    });


Route::middleware(['auth'])            // <- samakan dengan grup admin kamu
    ->prefix('admin/struktur')
    ->name('admin.struktur.')
    ->group(function () {
        Route::get('/', [StrukturAdminController::class, 'index'])->name('index');

        // teks tunggal per tab: hero | peran
        Route::put('/settings/{tab}', [StrukturAdminController::class, 'updateSettings'])
            ->whereIn('tab', ['hero', 'peran'])->name('settings.update');

        // orang / jabatan di bagan
        Route::post('/members', [StrukturAdminController::class, 'storeMember'])->name('members.store');
        Route::put('/members/{member}', [StrukturAdminController::class, 'updateMember'])->name('members.update');
        Route::delete('/members/{member}', [StrukturAdminController::class, 'destroyMember'])->name('members.destroy');
        Route::post('/members/{member}/toggle', [StrukturAdminController::class, 'toggleMember'])->name('members.toggle');
        Route::post('/members/{member}/move/{direction}', [StrukturAdminController::class, 'moveMember'])
            ->whereIn('direction', ['up', 'down'])->name('members.move');

        // kartu "Alur Kerja"
        Route::post('/roles', [StrukturAdminController::class, 'storeRole'])->name('roles.store');
        Route::put('/roles/{role}', [StrukturAdminController::class, 'updateRole'])->name('roles.update');
        Route::delete('/roles/{role}', [StrukturAdminController::class, 'destroyRole'])->name('roles.destroy');
        Route::post('/roles/{role}/toggle', [StrukturAdminController::class, 'toggleRole'])->name('roles.toggle');
        Route::post('/roles/{role}/move/{direction}', [StrukturAdminController::class, 'moveRole'])
            ->whereIn('direction', ['up', 'down'])->name('roles.move');
    });

Route::middleware(['auth'])            // <- samakan dengan grup admin kamu
    ->prefix('admin/visi-misi')
    ->name('admin.visi-misi.')
    ->group(function () {
        Route::get('/', [VisiMisiAdminController::class, 'index'])->name('index');

        // teks tunggal per tab: hero | visi | misi | tujuan | nilai
        Route::put('/settings/{tab}', [VisiMisiAdminController::class, 'updateSettings'])
            ->whereIn('tab', ['hero', 'visi', 'misi', 'tujuan', 'nilai'])->name('settings.update');

        // item kartu (misi / tujuan / nilai)
        Route::post('/items', [VisiMisiAdminController::class, 'storeItem'])->name('items.store');
        Route::put('/items/{item}', [VisiMisiAdminController::class, 'updateItem'])->name('items.update');
        Route::delete('/items/{item}', [VisiMisiAdminController::class, 'destroyItem'])->name('items.destroy');
        Route::post('/items/{item}/toggle', [VisiMisiAdminController::class, 'toggleItem'])->name('items.toggle');
        Route::post('/items/{item}/move/{direction}', [VisiMisiAdminController::class, 'moveItem'])
            ->whereIn('direction', ['up', 'down'])->name('items.move');
    });


// ---------- ADMIN ----------
Route::middleware(['auth'])            // <- samakan dengan grup admin kamu
    ->prefix('admin/tour')
    ->name('admin.tour.')
    ->group(function () {
        Route::get('/', [TourAdminController::class, 'index'])->name('index');
        Route::post('/scenes', [TourAdminController::class, 'store'])->name('store');
        Route::put('/scenes/{scene}', [TourAdminController::class, 'update'])->name('update');
        Route::delete('/scenes/{scene}', [TourAdminController::class, 'destroy'])->name('destroy');
        Route::post('/scenes/{scene}/move/{direction}', [TourAdminController::class, 'move'])
            ->whereIn('direction', ['up', 'down'])->name('move');

        Route::post('/scenes/{scene}/hotspots', [TourAdminController::class, 'storeHotspot'])->name('hotspots.store');
        Route::put('/hotspots/{hotspot}', [TourAdminController::class, 'updateHotspot'])->name('hotspots.update');
        Route::delete('/hotspots/{hotspot}', [TourAdminController::class, 'destroyHotspot'])->name('hotspots.destroy');
    });

// ---------- API PUBLIK (dipakai profile/tour.blade.php) ----------
// Kalau route /api/tour sudah ada, GANTI isinya ke controller ini (jangan dobel).
Route::get('/api/tour', [TourApiController::class, 'index']);


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

// Sejarah Sekolah (Dynamic DB data — diisi lewat Admin > Sejarah Sekolah)
Route::get('/profile/sejarah-sekolah', [SejarahSekolahController::class, 'index'])
    ->name('profil.sejarah-sekolah');

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

Route::get('/siswa/prestasi-siswa', function () {
    \Database\Seeders\AchievementSeeder::seedIfEmpty();
    $items = \App\Models\SchoolAchievement::orderBy('created_at', 'desc')->get();
    return view('siswa.prestasi-siswa', compact('items'));
})->name('prestasi-siswa');

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

Route::get('/galeri/kegiatan', function (Illuminate\Http\Request $request) {
    \Database\Seeders\GallerySeeder::seedIfEmpty();

    $query = \App\Models\Gallery::with('photos');

    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('category', 'like', "%{$search}%");
        });
    }

    $albums = $query->orderBy('created_at', 'desc')
        ->orderBy('event_date', 'desc')
        ->get();

    return view('galeri.kegiatan', compact('albums'));
})->name('kegiatan');
Route::get('/prestasi', function () {
    \Database\Seeders\AchievementSeeder::seedIfEmpty();
    $items = \App\Models\SchoolAchievement::orderBy('created_at', 'desc')->get();
    return view('siswa.prestasi-siswa', compact('items'));
})->name('prestasi');
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


// Standard Login fallback route for Laravel Auth middleware
Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');

// ==========================================================================
// ADMIN PANEL (DEDICATED PAGES)
// ==========================================================================
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // ===== Halaman login (khusus tamu / belum login) =====
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    });

    // ===== Halaman yang butuh login =====
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        // 1. Teachers & Staff
        Route::get('/teachers', function () {
            $teachers = \App\Models\TeacherStaff::orderBy('name', 'asc')->get();
            return view('admin.teachers.index', compact('teachers'));
        })->name('teachers.index');

        Route::get('/teachers/create', function () {
            return view('admin.teachers.create');
        })->name('teachers.create');

        Route::get('/teachers/{id}/edit', function ($id) {
            $item = \App\Models\TeacherStaff::findOrFail($id);
            return view('admin.teachers.edit', compact('item'));
        })->name('teachers.edit');

        // 2. Extracurriculars & Organizations
        Route::get('/extracurriculars', function () {
            $items = \App\Models\Extracurricular::orderBy('name', 'asc')->get();
            return view('admin.extracurriculars.index', compact('items'));
        })->name('extracurriculars.index');

        Route::get('/extracurriculars/create', function () {
            return view('admin.extracurriculars.create');
        })->name('extracurriculars.create');

        Route::get('/extracurriculars/{id}/edit', function ($id) {
            $item = \App\Models\Extracurricular::findOrFail($id);
            return view('admin.extracurriculars.edit', compact('item'));
        })->name('extracurriculars.edit');

        // 3. Mitra Industri DUDI
        Route::get('/industries', function () {
            $items = \App\Models\IndustryPartnership::all();
            return view('admin.industries.index', compact('items'));
        })->name('industries.index');

        Route::get('/industries/create', function () {
            return view('admin.industries.create');
        })->name('industries.create');

        Route::get('/industries/{id}/edit', function ($id) {
            $item = \App\Models\IndustryPartnership::findOrFail($id);
            return view('admin.industries.edit', compact('item'));
        })->name('industries.edit');

        // 4. Job Vacancies
        Route::get('/job-vacancies', function () {
            $items = \App\Models\JobVacancy::latest()->get();
            return view('admin.job-vacancies.index', compact('items'));
        })->name('job-vacancies.index');

        Route::get('/job-vacancies/create', function () {
            return view('admin.job-vacancies.create');
        })->name('job-vacancies.create');

        Route::get('/job-vacancies/{id}/edit', function ($id) {
            $item = \App\Models\JobVacancy::findOrFail($id);
            return view('admin.job-vacancies.edit', compact('item'));
        })->name('job-vacancies.edit');

        // 5. Student Works
        Route::get('/student-works', function () {
            $items = \App\Models\StudentWork::with('major')->latest()->get();
            return view('admin.student-works.index', compact('items'));
        })->name('student-works.index');

        // 6. School Fact-Check
        Route::get('/fact-checks', function () {
            $items = \App\Models\FactCheck::latest()->get();
            return view('admin.fact-checks.index', compact('items'));
        })->name('fact-checks.index');

        Route::get('/fact-checks/create', function () {
            return view('admin.fact-checks.create');
        })->name('fact-checks.create');

        Route::get('/fact-checks/{id}/edit', function ($id) {
            $item = \App\Models\FactCheck::findOrFail($id);
            return view('admin.fact-checks.edit', compact('item'));
        })->name('fact-checks.edit');

        // 7. E-Voices
        Route::get('/e-voices', function () {
            $items = \App\Models\EVoice::latest()->get();
            return view('admin.e-voices.index', compact('items'));
        })->name('e-voices.index');

        Route::get('/e-voices/create', function () {
            return view('admin.e-voices.create');
        })->name('e-voices.create');

        Route::get('/e-voices/{id}/edit', function ($id) {
            $item = \App\Models\EVoice::findOrFail($id);
            return view('admin.e-voices.edit', compact('item'));
        })->name('e-voices.edit');

        // Sejarah Sekolah
        Route::get('/school-history', [SchoolHistoryController::class, 'index'])
            ->name('school-history.index');

        Route::put('/school-history', [SchoolHistoryController::class, 'update'])
            ->name('school-history.update');

        require __DIR__ . '/admin-pengaturan.php';
        
        // 8. Galeri Kegiatan Sekolah (Album & Foto)
        Route::get('/gallery', [GalleryAdminController::class, 'index'])->name('gallery.index');
        Route::post('/gallery', [GalleryAdminController::class, 'store'])->name('gallery.store');
        Route::put('/gallery/{id}', [GalleryAdminController::class, 'update'])->name('gallery.update');
        Route::delete('/gallery/{id}', [GalleryAdminController::class, 'destroy'])->name('gallery.destroy');
        Route::post('/gallery/{id}/photos', [GalleryAdminController::class, 'uploadPhotos'])->name('gallery.photos.upload');
        Route::delete('/gallery/photos/{photoId}', [GalleryAdminController::class, 'deletePhoto'])->name('gallery.photos.destroy');

        // 9. Prestasi Sekolah (Trophy Cabinet & Dokumentasi)
        Route::get('/achievements', [AchievementAdminController::class, 'index'])->name('achievements.index');
        Route::post('/achievements', [AchievementAdminController::class, 'store'])->name('achievements.store');
        Route::put('/achievements/{id}', [AchievementAdminController::class, 'update'])->name('achievements.update');
        Route::delete('/achievements/{id}', [AchievementAdminController::class, 'destroy'])->name('achievements.destroy');
    });
});