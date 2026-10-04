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
use App\Http\Controllers\Admin\MajorAdminController;
use App\Http\Controllers\MajorPublicController;
use App\Http\Controllers\Admin\AphpAdminController;
use App\Http\Controllers\Admin\DkvAdminController;
use App\Http\Controllers\Admin\KulinerAdminController;
use App\Http\Controllers\Admin\LpsAdminController;
use App\Http\Controllers\Admin\RplAdminController;
use App\Http\Controllers\Admin\BkkAdminController;
use App\Http\Controllers\Admin\KegiatanAdminController;

Route::middleware(['auth'])            // <- samakan dengan grup admin kamu
    ->prefix('admin/kegiatan')
    ->name('admin.kegiatan.')
    ->group(function () {
        Route::get('/', [KegiatanAdminController::class, 'index'])->name('index');

        // teks halaman
        Route::put('/settings', [KegiatanAdminController::class, 'updateSettings'])->name('settings.update');

        // album
        Route::post('/albums', [KegiatanAdminController::class, 'storeAlbum'])->name('albums.store');
        Route::put('/albums/{album}', [KegiatanAdminController::class, 'updateAlbum'])->name('albums.update');
        Route::delete('/albums/{album}', [KegiatanAdminController::class, 'destroyAlbum'])->name('albums.destroy');
        Route::post('/albums/{album}/toggle', [KegiatanAdminController::class, 'toggleAlbum'])->name('albums.toggle');
        Route::post('/albums/{album}/move/{direction}', [KegiatanAdminController::class, 'moveAlbum'])
            ->whereIn('direction', ['up', 'down'])->name('albums.move');

        // sorotan (featured / momen pilihan)
        Route::put('/placements', [KegiatanAdminController::class, 'updatePlacements'])->name('placements.update');

        // kalender tahunan
        Route::post('/months', [KegiatanAdminController::class, 'storeMonth'])->name('months.store');
        Route::put('/months/{month}', [KegiatanAdminController::class, 'updateMonth'])->name('months.update');
        Route::delete('/months/{month}', [KegiatanAdminController::class, 'destroyMonth'])->name('months.destroy');
        Route::post('/months/{month}/toggle', [KegiatanAdminController::class, 'toggleMonth'])->name('months.toggle');
        Route::post('/months/{month}/move/{direction}', [KegiatanAdminController::class, 'moveMonth'])
            ->whereIn('direction', ['up', 'down'])->name('months.move');

        // kategori
        Route::post('/categories', [KegiatanAdminController::class, 'storeCategory'])->name('categories.store');
        Route::put('/categories/{category}', [KegiatanAdminController::class, 'updateCategory'])->name('categories.update');
        Route::delete('/categories/{category}', [KegiatanAdminController::class, 'destroyCategory'])->name('categories.destroy');
        Route::post('/categories/{category}/move/{direction}', [KegiatanAdminController::class, 'moveCategory'])
            ->whereIn('direction', ['up', 'down'])->name('categories.move');
    });

Route::middleware(['auth'])            // <- samakan dengan grup admin kamu
    ->prefix('admin/bkk')
    ->name('admin.bkk.')
    ->group(function () {
        Route::get('/', [BkkAdminController::class, 'index'])->name('index');

        // teks halaman (hero, strip, tentang, judul bagian, catatan, CTA)
        Route::put('/settings', [BkkAdminController::class, 'updateSettings'])->name('settings.update');
        Route::post('/photos', [BkkAdminController::class, 'updatePhotos'])->name('photos.update');

        // lowongan
        Route::post('/jobs', [BkkAdminController::class, 'storeJob'])->name('jobs.store');
        Route::put('/jobs/{job}', [BkkAdminController::class, 'updateJob'])->name('jobs.update');
        Route::delete('/jobs/{job}', [BkkAdminController::class, 'destroyJob'])->name('jobs.destroy');
        Route::post('/jobs/{job}/toggle', [BkkAdminController::class, 'toggleJob'])->name('jobs.toggle');
        Route::put('/jobs/{job}/status', [BkkAdminController::class, 'statusJob'])->name('jobs.status');

        // mitra industri
        Route::post('/industries', [BkkAdminController::class, 'storeIndustry'])->name('industries.store');
        Route::put('/industries/{industry}', [BkkAdminController::class, 'updateIndustry'])->name('industries.update');
        Route::delete('/industries/{industry}', [BkkAdminController::class, 'destroyIndustry'])->name('industries.destroy');
        Route::post('/industries/{industry}/toggle', [BkkAdminController::class, 'toggleIndustry'])->name('industries.toggle');
        Route::post('/industries/{industry}/move/{direction}', [BkkAdminController::class, 'moveIndustry'])
            ->whereIn('direction', ['up', 'down'])->name('industries.move');
    });

Route::middleware(['auth'])            // <- samakan dengan grup admin kamu
    ->prefix('admin/rpl')
    ->name('admin.rpl.')
    ->group(function () {
        Route::get('/', [RplAdminController::class, 'index'])->name('index');
        Route::put('/section/{section}', [RplAdminController::class, 'updateSection'])->name('section.update');
    });

Route::middleware(['auth'])            // <- samakan dengan grup admin kamu
    ->prefix('admin/lps')
    ->name('admin.lps.')
    ->group(function () {
        Route::get('/', [LpsAdminController::class, 'index'])->name('index');
        Route::put('/section/{section}', [LpsAdminController::class, 'updateSection'])->name('section.update');
    });


Route::middleware(['auth'])            // <- samakan dengan grup admin kamu
    ->prefix('admin/kuliner')
    ->name('admin.kuliner.')
    ->group(function () {
        Route::get('/', [KulinerAdminController::class, 'index'])->name('index');
        Route::put('/section/{section}', [KulinerAdminController::class, 'updateSection'])->name('section.update');
    });


Route::middleware(['auth'])            // <- samakan dengan grup admin kamu
    ->prefix('admin/dkv')
    ->name('admin.dkv.')
    ->group(function () {
        Route::get('/', [DkvAdminController::class, 'index'])->name('index');
        Route::put('/section/{section}', [DkvAdminController::class, 'updateSection'])->name('section.update');
    });

Route::middleware(['auth'])            // <- samakan dengan grup admin kamu
    ->prefix('admin/aphp')
    ->name('admin.aphp.')
    ->group(function () {
        Route::get('/', [AphpAdminController::class, 'index'])->name('index');
        Route::put('/section/{section}', [AphpAdminController::class, 'updateSection'])->name('section.update');
    });


Route::middleware(['auth'])
    ->prefix('admin/berita')
    ->name('admin.berita.')
    ->group(function () {
        Route::get('/', [BeritaAdminController::class, 'index'])->name('index');
        Route::put('/settings', [BeritaAdminController::class, 'updateSettings'])->name('settings.update');
        Route::post('/articles', [BeritaAdminController::class, 'storeArticle'])->name('articles.store');
        Route::put('/articles/{article}', [BeritaAdminController::class, 'updateArticle'])->name('articles.update');
        Route::delete('/articles/{article}', [BeritaAdminController::class, 'destroyArticle'])->name('articles.destroy');
        Route::post('/articles/{article}/toggle', [BeritaAdminController::class, 'toggleArticle'])->name('articles.toggle');
        Route::post('/articles/{article}/move/{direction}', [BeritaAdminController::class, 'moveArticle'])
            ->whereIn('direction', ['up', 'down'])->name('articles.move');
        Route::put('/placements', [BeritaAdminController::class, 'updatePlacements'])->name('placements.update');
        Route::post('/stories', [BeritaAdminController::class, 'storeStory'])->name('stories.store');
        Route::put('/stories/{story}', [BeritaAdminController::class, 'updateStory'])->name('stories.update');
        Route::delete('/stories/{story}', [BeritaAdminController::class, 'destroyStory'])->name('stories.destroy');
        Route::post('/stories/{story}/toggle', [BeritaAdminController::class, 'toggleStory'])->name('stories.toggle');
        Route::post('/stories/{story}/move/{direction}', [BeritaAdminController::class, 'moveStory'])
            ->whereIn('direction', ['up', 'down'])->name('stories.move');
        Route::post('/categories', [BeritaAdminController::class, 'storeCategory'])->name('categories.store');
        Route::put('/categories/{category}', [BeritaAdminController::class, 'updateCategory'])->name('categories.update');
        Route::delete('/categories/{category}', [BeritaAdminController::class, 'destroyCategory'])->name('categories.destroy');
        Route::post('/categories/{category}/move/{direction}', [BeritaAdminController::class, 'moveCategory'])
            ->whereIn('direction', ['up', 'down'])->name('categories.move');
    });

Route::middleware(['auth'])
    ->prefix('admin/ppdb')
    ->name('admin.ppdb.')
    ->group(function () {
        Route::get('/', [PpdbAdminController::class, 'index'])->name('index');
        Route::put('/settings/{tab}', [PpdbAdminController::class, 'updateSettings'])
            ->whereIn('tab', ['teks', 'definisi', 'jalur', 'syarat', 'alur', 'jadwal', 'jurusan', 'faq'])
            ->name('settings.update');
        Route::post('/items/{section}', [PpdbAdminController::class, 'storeItem'])
            ->whereIn('section', ['definisi', 'jalur', 'syarat', 'alur', 'jadwal', 'jurusan', 'faq'])
            ->name('items.store');
        Route::put('/items/{item}', [PpdbAdminController::class, 'updateItem'])->name('items.update');
        Route::delete('/items/{item}', [PpdbAdminController::class, 'destroyItem'])->name('items.destroy');
        Route::post('/items/{item}/toggle', [PpdbAdminController::class, 'toggleItem'])->name('items.toggle');
        Route::post('/items/{item}/move/{direction}', [PpdbAdminController::class, 'moveItem'])
            ->whereIn('direction', ['up', 'down'])->name('items.move');
    });

Route::middleware(['auth'])
    ->prefix('admin/struktur')
    ->name('admin.struktur.')
    ->group(function () {
        Route::get('/', [StrukturAdminController::class, 'index'])->name('index');
        Route::put('/settings/{tab}', [StrukturAdminController::class, 'updateSettings'])
            ->whereIn('tab', ['hero', 'peran'])->name('settings.update');
        Route::post('/members', [StrukturAdminController::class, 'storeMember'])->name('members.store');
        Route::put('/members/{member}', [StrukturAdminController::class, 'updateMember'])->name('members.update');
        Route::delete('/members/{member}', [StrukturAdminController::class, 'destroyMember'])->name('members.destroy');
        Route::post('/members/{member}/toggle', [StrukturAdminController::class, 'toggleMember'])->name('members.toggle');
        Route::post('/members/{member}/move/{direction}', [StrukturAdminController::class, 'moveMember'])
            ->whereIn('direction', ['up', 'down'])->name('members.move');
        Route::post('/roles', [StrukturAdminController::class, 'storeRole'])->name('roles.store');
        Route::put('/roles/{role}', [StrukturAdminController::class, 'updateRole'])->name('roles.update');
        Route::delete('/roles/{role}', [StrukturAdminController::class, 'destroyRole'])->name('roles.destroy');
        Route::post('/roles/{role}/toggle', [StrukturAdminController::class, 'toggleRole'])->name('roles.toggle');
        Route::post('/roles/{role}/move/{direction}', [StrukturAdminController::class, 'moveRole'])
            ->whereIn('direction', ['up', 'down'])->name('roles.move');
    });

Route::middleware(['auth'])
    ->prefix('admin/visi-misi')
    ->name('admin.visi-misi.')
    ->group(function () {
        Route::get('/', [VisiMisiAdminController::class, 'index'])->name('index');
        Route::put('/settings/{tab}', [VisiMisiAdminController::class, 'updateSettings'])
            ->whereIn('tab', ['hero', 'visi', 'misi', 'tujuan', 'nilai'])->name('settings.update');
        Route::post('/items', [VisiMisiAdminController::class, 'storeItem'])->name('items.store');
        Route::put('/items/{item}', [VisiMisiAdminController::class, 'updateItem'])->name('items.update');
        Route::delete('/items/{item}', [VisiMisiAdminController::class, 'destroyItem'])->name('items.destroy');
        Route::post('/items/{item}/toggle', [VisiMisiAdminController::class, 'toggleItem'])->name('items.toggle');
        Route::post('/items/{item}/move/{direction}', [VisiMisiAdminController::class, 'moveItem'])
            ->whereIn('direction', ['up', 'down'])->name('items.move');
    });

Route::middleware(['auth'])
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

Route::get('/profile/sejarah-sekolah', [SejarahSekolahController::class, 'index'])
    ->name('profil.sejarah-sekolah');

Route::view('/profile/visi-misi', 'profile.visi-misi')->name('profil.visi-misi');
Route::view('/profile/struktur-organisasi', 'profile.struktur-organisasi')->name('profil.struktur-organisasi');

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

// Halaman detail tiap kompetensi keahlian (nama route utama)
Route::view('/keahlian/aphp', 'keahlian.aphp')->name('keahlian.aphp');
Route::view('/keahlian/dkv', 'keahlian.dkv')->name('keahlian.dkv');
Route::view('/keahlian/kuliner', 'keahlian.kuliner')->name('keahlian.kuliner');
Route::view('/keahlian/lps', 'keahlian.lps')->name('keahlian.lps');
Route::view('/keahlian/rpl', 'keahlian.rpl')->name('keahlian.rpl');

// Alias lama — biar navbar & footer yang pakai route('rpl'), route('dkv'), dll tetap jalan
Route::get('/keahlian/aphp', [MajorPublicController::class, 'show'])->defaults('slugOrCode', 'aphp')->name('aphp');
Route::get('/keahlian/dkv', [MajorPublicController::class, 'show'])->defaults('slugOrCode', 'dkv')->name('dkv');
Route::get('/keahlian/kuliner', [MajorPublicController::class, 'show'])->defaults('slugOrCode', 'kuliner')->name('kuliner');
Route::get('/keahlian/lps', [MajorPublicController::class, 'show'])->defaults('slugOrCode', 'lps')->name('lps');
Route::get('/keahlian/rpl', [MajorPublicController::class, 'show'])->defaults('slugOrCode', 'rpl')->name('rpl');
Route::get('/keahlian/{slug}', [MajorPublicController::class, 'show'])->name('keahlian.detail');


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

Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');


// ==========================================================================
// ADMIN PANEL
// ==========================================================================
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    });

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

        // 2. Extracurriculars
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

        // 3. Mitra Industri
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

        // 6. Fact-Check
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

        // 8. Galeri
        Route::get('/gallery', [GalleryAdminController::class, 'index'])->name('gallery.index');
        Route::post('/gallery', [GalleryAdminController::class, 'store'])->name('gallery.store');
        Route::put('/gallery/{id}', [GalleryAdminController::class, 'update'])->name('gallery.update');
        Route::delete('/gallery/{id}', [GalleryAdminController::class, 'destroy'])->name('gallery.destroy');
        Route::post('/gallery/{id}/photos', [GalleryAdminController::class, 'uploadPhotos'])->name('gallery.photos.upload');
        Route::delete('/gallery/photos/{photoId}', [GalleryAdminController::class, 'deletePhoto'])->name('gallery.photos.destroy');

        // 9. Prestasi
        Route::get('/achievements', [AchievementAdminController::class, 'index'])->name('achievements.index');
        Route::post('/achievements', [AchievementAdminController::class, 'store'])->name('achievements.store');
        Route::put('/achievements/{id}', [AchievementAdminController::class, 'update'])->name('achievements.update');
        Route::delete('/achievements/{id}', [AchievementAdminController::class, 'destroy'])->name('achievements.destroy');

        // 10. Program Keahlian
        Route::get('/majors', [MajorAdminController::class, 'index'])->name('majors.index');
        Route::post('/majors', [MajorAdminController::class, 'store'])->name('majors.store');
        Route::put('/majors/{id}', [MajorAdminController::class, 'update'])->name('majors.update');
        Route::post('/majors/{id}/toggle', [MajorAdminController::class, 'toggle'])->name('majors.toggle');
        Route::delete('/majors/{id}', [MajorAdminController::class, 'destroy'])->name('majors.destroy');
    });
});