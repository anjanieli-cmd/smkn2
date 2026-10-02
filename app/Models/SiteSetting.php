<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Penyimpanan pengaturan situs berbentuk key–value.
 * Dipakai untuk: Informasi Footer, Konten Umum Website, dan teks intro/statistik Roadmap.
 *
 * Pemakaian di Blade:  {{ \App\Models\SiteSetting::get('footer_tagline') }}
 * Kalau key belum ada di database, nilai bawaan dari DEFAULTS dipakai
 * (sama persis dengan teks lama yang sebelumnya ditulis manual di Blade).
 */
class SiteSetting extends Model
{
    protected $fillable = ['key', 'value'];

    /** Cache per-request supaya tidak query berulang-ulang di satu halaman. */
    protected static ?array $cache = null;

    public const DEFAULTS = [
        // ---------- Informasi Footer ----------
        'footer_sub'            => 'Sekolah Menengah Kejuruan Unggulan',
        'footer_tagline'        => 'Mencetak lulusan vokasi berkualitas, berkarakter, dan siap bersaing di era global.',
        'footer_social_label'   => 'Follow Our Journey',
        'footer_instagram'      => '',
        'footer_youtube'        => '',
        'footer_facebook'       => '',
        'footer_partners_label' => 'Didukung Oleh',
        'footer_copyright'      => '© 2026 SMK Negeri 2 Mojokerto',
        'footer_slogan'         => 'Belajar hari ini, berkarya untuk masa depan.',

        // ---------- Konten Umum Website ----------
        'hero_eyebrow'          => 'Disiplin, Berprestasi',
        'hero_desc'             => 'Mewujudkan pendidikan vokasi yang unggul, berkarakter, dan siap menghadapi masa depan.',
        'contact_sub'           => 'Kami siap membantu Anda.',
        'contact_line'          => 'Informasi sekolah, PPDB, dan program keahlian.',
        'contact_address'       => 'Jl. Raya Pulorejo, Kel. Pulorejo, Kec. Prajurit Kulon, Kota Mojokerto, Jawa Timur 61325',
        'contact_phone'         => '0312 2292 9922',
        'contact_email'         => 'info@smkn2mojokerto.sch.id',
        'contact_hours'         => 'Senin–Jumat · 07.00–16.00 WIB',

        // ---------- Roadmap (intro + statistik) ----------
        'roadmap_intro_copy'    => 'Roadmap ini menjadi penunjuk arah bersama bagi seluruh warga sekolah: guru, tenaga kependidikan, peserta didik, orang tua, hingga mitra dunia usaha dan industri. Setiap fase dirancang dengan target konkret, indikator keberhasilan, dan semangat gotong royong — agar setiap langkah kecil hari ini bermuara pada lompatan besar di masa depan.',
        'roadmap_stat1_value'   => '6',
        'roadmap_stat1_label'   => 'Fase Pengembangan',
        'roadmap_stat2_value'   => '5',
        'roadmap_stat2_label'   => 'Pilar Strategis',
        'roadmap_stat3_value'   => '2030',
        'roadmap_stat3_label'   => 'Target Nasional',
        'roadmap_stat4_value'   => '25+',
        'roadmap_stat4_label'   => 'Program Prioritas',
    ];

    protected static function values(): array
    {
        if (static::$cache === null) {
            static::$cache = static::query()->pluck('value', 'key')->all();
        }

        return static::$cache;
    }

    /** Ambil satu nilai. Key belum ada di DB => pakai DEFAULTS. Key ada tapi kosong => tetap kosong. */
    public static function get(string $key, ?string $default = null): ?string
    {
        $all = static::values();

        if (array_key_exists($key, $all)) {
            return $all[$key] ?? '';
        }

        return static::DEFAULTS[$key] ?? $default;
    }

    /** Ambil banyak key sekaligus (untuk mengisi form admin). */
    public static function many(array $keys): array
    {
        $out = [];
        foreach ($keys as $key) {
            $out[$key] = static::get($key, '');
        }

        return $out;
    }

    /** Simpan banyak key sekaligus. */
    public static function setMany(array $data): void
    {
        foreach ($data as $key => $value) {
            static::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        static::$cache = null;
    }
}
