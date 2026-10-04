<?php

namespace App\Support;

use App\Models\KaryaCategory;
use App\Models\KaryaSetting;
use App\Models\KaryaWork;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\HtmlString;

/**
 * Menyiapkan semua konten halaman publik Karya Siswa.
 * Dipanggil dari resources/views/profile/karya-siswa.blade.php
 */
class KaryaContent
{
    public static function get(): array
    {
        $s = KaryaSetting::allValues();

        $categories = KaryaCategory::orderBy('order')->orderBy('id')->get();
        $byKey = $categories->keyBy('key');

        $works = KaryaWork::active()->ordered()->get()->map(function (KaryaWork $w) use ($byKey) {
            $cat = $w->category_key ? $byKey->get($w->category_key) : null;

            $tagLabel = trim((string) $w->tag_label) ?: ($cat ? $cat->label : 'Karya');
            $tagIcon  = trim((string) $w->tag_icon) ?: ($cat ? $cat->icon : 'fa-star');
            $short    = trim((string) $w->major_short) ?: trim((string) $w->major_label);

            return (object) [
                'show_in_slider'   => $w->show_in_slider,
                'show_in_products' => $w->show_in_products,
                'title'      => $w->title,
                'desc'       => trim((string) $w->description),
                'cover'      => $w->cover_url,
                'tag_label'  => $tagLabel,
                'tag_icon'   => $tagIcon,
                'student'    => trim((string) $w->student_label),
                'major'      => trim((string) $w->major_label),
                'major_icon' => trim((string) $w->major_icon) ?: 'fa-graduation-cap',
                'year'       => trim((string) $w->year_label),
                'pill'       => implode(' · ', array_filter([$short, trim((string) $w->year_label)])),
            ];
        });

        $ctaUrl = trim($s['cta_btn_url']);
        if ($ctaUrl === '') {
            $ctaUrl = Route::has('kontak') ? route('kontak') : '#';
        }

        return [
            's'          => $s,
            'categories' => $categories,
            'slides'     => $works->where('show_in_slider', true)->values(),
            'products'   => $works->where('show_in_products', true)->values(),
            'ctaUrl'     => $ctaUrl,
            'fallback'   => asset(KaryaMedia::FALLBACK),
        ];
    }

    /** Escape HTML, lalu ubah **teks** menjadi <strong>teks</strong>. */
    public static function rich(?string $text): HtmlString
    {
        $safe = e((string) $text);
        $safe = preg_replace('/\*\*(.+?)\*\*/su', '<strong>$1</strong>', $safe);

        return new HtmlString($safe);
    }
}
