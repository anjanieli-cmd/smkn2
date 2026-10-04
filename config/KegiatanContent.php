<?php

namespace App\Support;

use App\Models\KegiatanAlbum;
use App\Models\KegiatanCategory;
use App\Models\KegiatanMonth;
use App\Models\KegiatanPlacement;
use App\Models\KegiatanSetting;
use Illuminate\Support\Facades\Route;

/**
 * Menyiapkan semua konten halaman publik Kegiatan.
 * Dipanggil dari resources/views/profile/partials/kegiatan-content.blade.php
 */
class KegiatanContent
{
    private const SIZE_CLASS = [
        'standard' => '',
        'md'       => 'kg-card--md',
        'lg'       => 'kg-card--lg',
        'tall'     => 'kg-card--tall',
        'wide'     => 'kg-card--wide',
    ];

    /** Pola ukuran bawaan untuk album berukuran "Otomatis" (sama dengan versi lama). */
    private const AUTO_PATTERN = ['kg-card--lg', 'kg-card--wide', '', 'kg-card--tall', 'kg-card--md'];

    public static function get(): array
    {
        $s = KegiatanSetting::allValues();

        $categories = KegiatanCategory::orderBy('order')->orderBy('id')->get()->keyBy('key');

        $albums = KegiatanAlbum::active()->ordered()->with('photos')->get();

        // ---- galeri ----
        $gallery = $albums->where('show_in_gallery', true)->values()->map(function ($album, $i) use ($categories) {
            $cat = $album->category_key ? $categories->get($album->category_key) : null;
            $size = $album->size ?: 'auto';

            return (object) [
                'id'         => $album->id,
                'title'      => $album->title,
                'cat_key'    => $cat ? $cat->key : 'lainnya',
                'cat_label'  => $cat ? $cat->label : 'Kegiatan',
                'date'       => $album->date_label ?: '',
                'desc'       => $album->description ?: $album->title,
                'cover'      => $album->cover_url,
                'photos'     => $album->lightboxUrls(),
                'size_class' => $size === 'auto'
                    ? self::AUTO_PATTERN[$i % count(self::AUTO_PATTERN)]
                    : (self::SIZE_CLASS[$size] ?? ''),
            ];
        });

        // hanya kategori yang punya isi yang jadi tombol filter
        $filterCategories = $categories->filter(
            fn ($c) => $gallery->contains('cat_key', $c->key)
        )->values();

        // ---- sorotan ----
        $placements = KegiatanPlacement::with(['album.photos'])->orderBy('position')->get()->groupBy('slot');

        $pick = function (string $slot) use ($placements, $categories) {
            return $placements->get($slot, collect())
                ->filter(fn ($p) => $p->album && $p->album->is_active)
                ->map(function ($p) use ($categories) {
                    $a = $p->album;
                    $cat = $a->category_key ? $categories->get($a->category_key) : null;

                    return (object) [
                        'title'     => $a->title,
                        'cover'     => $a->cover_url,
                        'label'     => trim((string) $p->label),
                        'cat_label' => $cat ? $cat->label : 'Kegiatan',
                        'date'      => $a->date_label ?: '',
                        'desc'      => $a->description ?: $a->title,
                        'photos'    => $a->lightboxUrls(),
                    ];
                })->values();
        };

        $featured = $pick('featured')->first();
        $pickBig = $pick('pick_big')->first();
        $pickSmall = $pick('pick_small');

        $ctaUrl = trim($s['cta_btn_url']);
        if ($ctaUrl === '') {
            $ctaUrl = Route::has('kontak') ? route('kontak') : '#';
        }

        return [
            's'                => $s,
            'gallery'          => $gallery,
            'filterCategories' => $filterCategories,
            'featured'         => $featured,
            'pickBig'          => $pickBig,
            'pickSmall'        => $pickSmall,
            'months'           => KegiatanMonth::active()->ordered()->get(),
            'ctaUrl'           => $ctaUrl,
            'fallback'         => asset(KegiatanMedia::FALLBACK),
        ];
    }
}
