<?php

namespace App\Support;

use App\Models\SiteSetting;

/**
 * Teks halaman publik "Prestasi Sekolah" yang bisa diedit dari admin
 * (Admin → Galeri → Prestasi Sekolah → tab "Teks Halaman").
 *
 * Disimpan di tabel site_settings dengan awalan "prestasi_".
 * Kalau belum pernah diedit (atau barisnya terhapus), nilai bawaan di DEFAULTS
 * dipakai, sama persis dengan teks lama yang dulu tertulis di Blade.
 *
 * Penulisan teks:  **tebal**   __miring/emas__   (baris baru = <br>)
 */
class PrestasiContent
{
    public const PREFIX = 'prestasi_';

    public const DEFAULTS = [
        'seo_title'                => 'Prestasi Sekolah — SMK Negeri 2 Mojokerto',
        'seo_description'          => 'Prestasi institusi SMK Negeri 2 Mojokerto — trophy cabinet, pencapaian utama, galeri penghargaan, dan arsip prestasi resmi sekolah dari tingkat kota hingga nasional.',
        'hero_kicker'              => 'Trophy Cabinet Sekolah',
        'hero_title_white'         => 'Prestasi',
        'hero_title_gold'          => 'Sekolah',
        'hero_lead'                => 'Arsip prestasi siswa, guru, dan alumni SMK Negeri 2 Mojokerto yang terdokumentasi dalam berbagai ajang dari tingkat kota hingga capaian internasional.',
        'hero_pill1'               => 'Arsip Resmi Sekolah',
        'hero_pill2'               => 'Kota → Internasional',
        'hero_pill3'               => '',
        'opening_eyebrow'          => 'Institutional Achievement',
        'opening_title_white'      => 'Jejak Prestasi',
        'opening_title_gold'       => 'Skaneda',
        'opening_desc'             => 'Kumpulan artikel prestasi **SMK Negeri 2 Mojokerto** yang dihimpun dari dokumen prestasi siswa, guru, dan alumni. Setiap artikel memuat pencapaian sesuai informasi dan tingkat yang tercantum pada sumber.',
        'opening_meta1_label'      => 'Artikel Prestasi',
        'opening_meta2_value'      => 'Internasional',
        'opening_meta2_label'      => 'Jangkauan Terluas di Data',
        'opening_meta3_label'      => 'Tahun Tercatat',
        'cabinet_tag'              => 'Trophy Cabinet',
        'cabinet_title'            => "Etalase Kehormatan\nSekolah",
        'cabinet_text'             => 'Piala, medali, penghargaan, dan pencapaian dari berbagai ajang menjadi bukti nyata perjalanan prestasi Skaneda.',
        'cabinet_foot_levels'      => 'Kota · Provinsi · Nasional · Internasional',
        'cabinet_foot_count_label' => 'Artikel Prestasi',
        'featured_eyebrow'         => 'Capaian Utama Institusi',
        'featured_badge'           => 'Featured Achievement',
        'featured_year_label'      => 'Tahun Capaian',
        'featured_button'          => 'Baca selengkapnya',
        'achv_eyebrow'             => 'Dokumentasi Resmi',
        'achv_title_white'         => 'Pencapaian',
        'achv_title_gold'          => 'Prestasi',
        'achv_subtitle'            => 'Kumpulan berita pencapaian siswa, guru, dan alumni Skaneda — lengkap dengan foto, judul, dan isi artikelnya, dari tingkat kota hingga internasional.',
        'achv_more_button'         => 'Muat Prestasi Lainnya',
        'achv_empty'               => 'Belum ada prestasi pada kategori ini.',
        'moment_eyebrow'           => 'Dokumentasi Prestasi',
        'moment_title_white'       => 'Momen',
        'moment_title_gold'        => 'Kejayaan',
        'moment_subtitle'          => 'Ruang dokumentasi untuk foto-foto asli pencapaian Skaneda, disusun dalam grid bento dengan ukuran yang bervariasi.',
        'moment1_image'            => 'images/prestasi/adiwiyata.jpeg',
        'moment1_title'            => 'Sekolah Adiwiyata Provinsi Jawa Timur',
        'moment1_meta'             => 'Provinsi · 2025',
        'moment2_image'            => 'images/prestasi/lkslampung.jpg',
        'moment2_title'            => 'LKS Patisserie And Confectionery',
        'moment2_meta'             => 'Nasional · 2024',
        'moment3_image'            => 'images/prestasi/paskib24.jpg',
        'moment3_title'            => 'Paskibraka Skaneda',
        'moment3_meta'             => 'Nasional · 2024',
        'moment4_image'            => 'images/prestasi/lks26.jpg',
        'moment4_title'            => 'LKS Jawa Timur',
        'moment4_meta'             => 'Provinsi · 2026',
        'quote_image'              => 'images/ps-kampus.jpg',
        'quote_text'               => 'Prestasi bukan sekadar penghargaan, tetapi __bukti perjalanan sekolah__ dalam memberikan pendidikan terbaik.',
        'quote_source'             => 'Moto Prestasi SMK Negeri 2 Mojokerto',
        'archive_eyebrow'          => 'Prestige Journey',
        'archive_title_white'      => 'Perjalanan',
        'archive_title_gold'       => 'Prestasi',
        'archive_subtitle'         => 'Jejak kemenangan peserta didik Skaneda dari tahun ke tahun — setiap titik adalah kerja keras yang membuahkan hasil. Klik salah satu judul untuk membaca artikel lengkapnya.',
        'archive_badge'            => '',
        'cta_eyebrow'              => 'Mari Bergabung',
        'cta_title'                => 'Jadilah Bagian dari Perjalanan Prestasi Skaneda',
        'cta_text'                 => 'Bergabunglah bersama keluarga besar SMK Negeri 2 Mojokerto — tempat disiplin, karya, dan prestasi tumbuh menjadi kebanggaan.',
        'cta_button'               => 'Hubungi Sekolah',
    ];

    /** Kunci yang berisi foto (diunggah lewat admin). */
    public const IMAGE_KEYS = ['moment1_image', 'moment2_image', 'moment3_image', 'moment4_image', 'quote_image'];

    public static function keys(): array
    {
        return array_keys(self::DEFAULTS);
    }

    public static function get(string $key): string
    {
        return (string) SiteSetting::get(self::PREFIX . $key, self::DEFAULTS[$key] ?? '');
    }

    /** Semua nilai sekaligus (untuk mengisi form admin). */
    public static function all(): array
    {
        $out = [];
        foreach (self::keys() as $key) {
            $out[$key] = self::get($key);
        }

        return $out;
    }

    /** Teks aman (di-escape) dengan **tebal**, __miring__, dan baris baru. */
    public static function rich(string $key): string
    {
        $text = e(self::get($key));
        $text = preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $text);
        $text = preg_replace('/__(.+?)__/s', '<em>$1</em>', $text);

        return nl2br($text, false);
    }
}