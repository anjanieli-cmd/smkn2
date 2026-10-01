<?php

namespace App\Support;

use App\Models\VisiMisiItem;
use App\Models\VisiMisiSetting;
use Illuminate\Support\HtmlString;

/**
 * Menyiapkan semua konten halaman publik Visi & Misi.
 * Dipanggil dari resources/views/profile/partials/visi-content.blade.php
 */
class VisiMisiContent
{
    public static function get(): array
    {
        $s = VisiMisiSetting::allValues();

        $tags = array_values(array_filter(array_map(
            'trim',
            preg_split('/\r\n|\r|\n/', (string) $s['visi_tags']) ?: []
        ), fn ($t) => $t !== ''));

        $ctaUrl = trim((string) $s['cta_button_url']);
        if ($ctaUrl === '') {
            $ctaUrl = route('home') . '#ppdb';
        }

        return [
            's'      => $s,
            'tags'   => $tags,
            'ctaUrl' => $ctaUrl,
            'misi'   => VisiMisiItem::ofType('misi')->active()->get(),
            'tujuan' => VisiMisiItem::ofType('tujuan')->active()->get(),
            'nilai'  => VisiMisiItem::ofType('nilai')->active()->get(),
        ];
    }

    /**
     * Teks aman (di-escape) dengan *penekanan* diubah jadi <em>penekanan</em>
     * (bagian yang tampil bergradasi emas di kartu Visi).
     */
    public static function em(?string $text): HtmlString
    {
        $safe = e((string) $text);
        $safe = preg_replace('/\*(.+?)\*/su', '<em>$1</em>', $safe);

        return new HtmlString($safe);
    }
}
