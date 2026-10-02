<?php

namespace App\Support;

use App\Models\BeritaArticle;
use App\Models\BeritaCategory;
use App\Models\BeritaPlacement;
use App\Models\BeritaSetting;
use App\Models\BeritaStory;
use Illuminate\Support\Facades\Route;

/**
 * Menyiapkan semua konten halaman publik Berita.
 * Dipanggil dari resources/views/profile/partials/berita-content.blade.php
 */
class BeritaContent
{
    public static function get(): array
    {
        $s = BeritaSetting::allValues();

        $articles = BeritaArticle::active()->ordered()->get();

        $placements = BeritaPlacement::with('article')->get()->groupBy('slot');

        $featured = optional($placements->get('featured', collect())->first())->article;
        $featured = ($featured && $featured->is_active) ? $featured : null;

        $side = $placements->get('side', collect())
            ->sortBy('position')
            ->pluck('article')
            ->filter(fn ($a) => $a && $a->is_active)
            ->values();

        $mostRead = $placements->get('most_read', collect())
            ->sortBy('position')
            ->pluck('article')
            ->filter(fn ($a) => $a && $a->is_active)
            ->values();

        // Daftar "Berita Terbaru" = semua artikel aktif, dikurangi featured (tapi side & most_read boleh dobel muncul di list).
        $list = $featured ? $articles->reject(fn ($a) => $a->id === $featured->id)->values() : $articles;

        $categories = BeritaCategory::orderBy('order')->orderBy('id')->get();

        $stories = BeritaStory::active()->ordered()->get();

        $ctaUrl = trim($s['cta_btn_url']);
        if ($ctaUrl === '') {
            $ctaUrl = Route::has('kontak') ? route('kontak') : '#';
        }

        return [
            's'           => $s,
            'featured'    => $featured,
            'side'        => $side,
            'mostRead'    => $mostRead,
            'list'        => $list,
            'categories'  => $categories,
            'stories'     => $stories,
            'ctaUrl'      => $ctaUrl,
            'totalActive' => $articles->count(),
        ];
    }
}
