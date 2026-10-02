<?php

namespace App\Support;

use App\Models\StrukturMember;
use App\Models\StrukturRole;
use App\Models\StrukturSetting;
use Illuminate\Support\Facades\Route;

/**
 * Menyiapkan semua konten halaman publik Struktur Organisasi.
 * Dipanggil dari resources/views/profile/partials/struktur-content.blade.php
 */
class StrukturContent
{
    public static function get(): array
    {
        $s = StrukturSetting::allValues();

        $members = StrukturMember::active()->ordered()->get();

        // chip filter: hanya bidang yang punya orang aktif
        $chips = collect(StrukturMember::BIDANG)
            ->filter(fn ($label, $key) => $members->contains('bidang', $key))
            ->all();

        // data untuk modal detail (dibaca script di halaman publik lewat window.SO_DATA)
        $modal = [];
        foreach ($members as $m) {
            $modal['m' . $m->id] = [
                'name'   => $m->person ?: $m->position,
                'role'   => $m->position,
                'unit'   => $m->unit,
                'avatar' => 'fas ' . ($m->icon ?: 'fa-user'),
                'gold'   => $m->level === 1,
                'photo'  => $m->photo_url,
                'tags'   => array_values(array_filter([$m->unit ?: (StrukturMember::BIDANG[$m->bidang] ?? null)])),
                'tasks'  => $m->tasksList(),
                'note'   => (string) $m->note,
            ];
        }

        return [
            's'      => $s,
            'levels' => $members->groupBy('level'),
            'chips'  => $chips,
            'modal'  => $modal,
            'roles'  => StrukturRole::ordered()->active()->get(),
            'vtUrl'  => self::url($s['vt_button_url'], self::firstRoute(['profil.virtual-tour', 'profil.tour', 'virtual-tour', 'tour']) ?: '#'),
            'ctaUrl' => self::url($s['cta_button_url'], self::firstRoute(['profil.guru-staf']) ?: '#'),
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
