<?php

namespace App\Support;

use App\Models\BkkIndustry;
use App\Models\BkkJobVacancy;
use App\Models\BkkSetting;

/**
 * Menyiapkan semua konten halaman publik BKK & Loker.
 * Dipanggil dari resources/views/profile/bkk-loker.blade.php
 */
class BkkContent
{
    public static function get(): array
    {
        $s = BkkSetting::allValues();

        $photos = [];
        foreach ([1, 2, 3] as $n) {
            $photos[] = [
                'url' => BkkSetting::mediaUrl($s["photo_$n"]),
                'alt' => $s["photo_{$n}_alt"] !== '' ? $s["photo_{$n}_alt"] : "Dokumentasi kegiatan BKK $n",
            ];
        }

        return [
            's'          => $s,
            'photos'     => $photos,
            'industries' => BkkIndustry::active()->ordered()->get(),
            'jobs'       => BkkJobVacancy::sortCollection(BkkJobVacancy::active()->get()),
            'ctaUrl'     => trim($s['cta_btn_url']),
        ];
    }
}
