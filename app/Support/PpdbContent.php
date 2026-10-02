<?php

namespace App\Support;

use App\Models\PpdbItem;
use App\Models\PpdbSetting;
use Illuminate\Support\Facades\Route;

/**
 * Menyiapkan semua konten halaman publik PPDB.
 * Dipanggil dari resources/views/profile/partials/ppdb-content.blade.php
 */
class PpdbContent
{
    public static function get(): array
    {
        $s = PpdbSetting::allValues();

        $items = PpdbItem::active()->ordered()->get()->groupBy('section');

        return [
            's'      => $s,
            'items'  => $items,
            'banner' => PpdbSetting::imageUrl($s['intro_banner']) ?: asset('images/jurusan.jpeg'),
            'ctaUrl' => self::url($s['cta_button_url'], self::firstRoute(['kontak']) ?: '#'),
        ];
    }

    private static function url(?string $custom, string $fallback): string
    {
        $custom = trim((string) $custom);

        return $custom !== '' ? $custom : $fallback;
    }

    private static function firstRoute(array $names): ?string
    {
        foreach ($names as $name) {
            if (Route::has($name)) {
                return route($name);
            }
        }

        return null;
    }
}
