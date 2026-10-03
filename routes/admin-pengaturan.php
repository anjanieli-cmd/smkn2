<?php

/*
|--------------------------------------------------------------------------
| Route admin: Roadmap, Announcement, Partner, Footer, Konten Umum
|--------------------------------------------------------------------------
| File ini di-require dari dalam grup admin (prefix 'admin', name 'admin.',
| middleware 'auth') di routes/web.php, jadi nama route otomatis menjadi
| admin.roadmap.index, admin.announcement.index, dst.
| Dipisah ke file sendiri supaya routes/web.php (dipakai bareng teman)
| cukup ditambah 1 baris dan tidak bentrok saat merge di GitHub.
*/

use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\RoadmapController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\HomeContentController;
use Illuminate\Support\Facades\Route;

// Roadmap Pengembangan
Route::get('/roadmap', [RoadmapController::class, 'index'])->name('roadmap.index');
Route::put('/roadmap', [RoadmapController::class, 'update'])->name('roadmap.update');

// Announcement Bar
Route::get('/announcement', [AnnouncementController::class, 'index'])->name('announcement.index');
Route::put('/announcement', [AnnouncementController::class, 'update'])->name('announcement.update');

// Logo Partner / Mitra
Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');
Route::put('/partners', [PartnerController::class, 'update'])->name('partners.update');

// Informasi Footer
Route::get('/footer', [SiteSettingController::class, 'footer'])->name('footer.index');
Route::put('/footer', [SiteSettingController::class, 'updateFooter'])->name('footer.update');

// Konten beranda
Route::get('/general', [SiteSettingController::class, 'general'])->name('general.index');
Route::put('/general', [SiteSettingController::class, 'updateGeneral'])->name('general.update');
Route::put('/general/industry', [HomeContentController::class, 'updateIndustry'])->name('general.industry.update');
Route::put('/general/achievements', [HomeContentController::class, 'updateAchievements'])->name('general.achievements.update');