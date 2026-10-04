<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BkkSetting extends Model
{
    protected $table = 'bkk_settings';

    protected $fillable = ['key', 'value'];

    /** Teks bawaan = isi halaman sebelum ada admin. Dipakai selama key belum pernah disimpan. */
    public static function defaults(): array
    {
        return [
            // ---- HERO ----
            'hero_kicker'  => 'Pusat Informasi Karier Skaneda',
            'hero_title_1' => 'BKK &',
            'hero_title_2' => 'Loker',
            'hero_lead'    => 'Bursa Kerja Khusus SMK Negeri 2 Mojokerto — membantu siswa dan alumni menuju dunia kerja lewat informasi karier, rekrutmen industri, persiapan kerja, dan jejaring dengan dunia usaha.',
            'hero_pill_1'  => 'Informasi Karier',
            'hero_pill_2'  => 'Rekrutmen Industri',
            'hero_pill_3'  => 'Siswa & Alumni',

            // ---- STRIP ----
            'strip_label' => 'BKK Skaneda',
            'strip_text'  => 'Informasi lowongan, kegiatan BKK, rekrutmen industri, persiapan karier, dan penelusuran lulusan.',

            // ---- TENTANG BKK (judul bagian) ----
            'about_eyebrow'  => 'Tentang BKK',
            'about_title'    => 'Mengenal',
            'about_title_em' => 'BKK Skaneda',
            'about_sub'      => 'BKK merupakan layanan sekolah yang menghubungkan kompetensi siswa dan alumni dengan kebutuhan dunia kerja.',

            // ---- TENTANG BKK (kartu) ----
            'about_card_title' => 'Bursa Kerja Khusus SMK Negeri 2 Mojokerto',
            'about_p1' => 'BKK membantu siswa dan alumni memperoleh informasi, akses, serta pendampingan menuju dunia kerja. Kegiatannya mencakup pelayanan informasi kerja, penempatan dan penyaluran tenaga kerja, kerja sama dengan dunia kerja/dunia industri, administrasi pencari kerja, bimbingan industri dan jabatan, serta pemantauan perkembangan karier lulusan.',
            'about_p2' => 'Layanan BKK juga berkembang melalui rekrutmen industri, workshop dan seminar karier, simulasi psikotes, job fair/job matching, kegiatan Alumni Berbagi, penelusuran alumni, dan tracer vokasi.',
            'vision_title' => 'Visi BKK',
            'vision_text'  => 'Komitmen BKK dalam memberikan pelayanan karier bagi masyarakat pendidikan.',
            'vision_quote' => 'Kami siap melayani masyarakat pendidikan dan pembelajaran berbasis budaya Kerja, Disiplin dan Berprestasi.',

            // ---- FOTO DOKUMENTASI (3 slot) ----
            'photo_1'     => 'images/bkk/rekruitment-tongtji.png',
            'photo_1_alt' => 'Dokumentasi kegiatan BKK 1',
            'photo_2'     => 'images/bkk/rekruitment-deabakery.png',
            'photo_2_alt' => 'Dokumentasi kegiatan BKK 2',
            'photo_3'     => 'images/bkk/rekruitment-btpn.png',
            'photo_3_alt' => 'Dokumentasi kegiatan BKK 3',

            // ---- MITRA INDUSTRI (judul bagian) ----
            'partners_eyebrow'  => 'DUDI & Kemitraan',
            'partners_title'    => 'Mitra',
            'partners_title_em' => 'Industri',
            'partners_sub'      => 'Kerja sama strategis SMKN 2 Mojokerto dengan perusahaan mitra untuk PKL, Kelas Industri, & Rekrutmen Lulusan.',

            // ---- LOWONGAN (judul bagian) ----
            'jobs_eyebrow'  => 'Informasi Rekrutmen',
            'jobs_title'    => 'Loker &',
            'jobs_title_em' => 'Rekrutmen',
            'jobs_sub'      => 'Daftar lowongan pekerjaan & rekrutmen resmi BKK SMKN 2 Mojokerto.',

            // ---- CATATAN DI BAWAH LOWONGAN ----
            'notice_text' => 'Informasi rekrutmen BKK dipublikasikan secara resmi. Seluruh proses pendaftaran dan seleksi BKK SMKN 2 Mojokerto',
            'notice_bold' => 'TIDAK DIPUNGUT BIAYA (GRATIS)',

            // ---- CTA PENUTUP ----
            'cta_title'    => 'Siap melangkah menuju',
            'cta_title_em' => 'dunia kerja?',
            'cta_text'     => 'Pantau informasi rekrutmen, kegiatan BKK, pembekalan karier, dan berbagai kesempatan yang dipublikasikan oleh SMK Negeri 2 Mojokerto.',
            'cta_btn_text' => '',   // kosong = tombol tidak tampil
            'cta_btn_url'  => '',
        ];
    }

    public static function allValues(): array
    {
        $values = static::defaults();

        foreach (static::query()->pluck('value', 'key') as $key => $value) {
            if (array_key_exists($key, $values)) {
                $values[$key] = (string) $value;
            }
        }

        return $values;
    }

    public static function get(string $key): string
    {
        return static::allValues()[$key] ?? '';
    }

    public static function put(string $key, string $value): void
    {
        if (array_key_exists($key, static::defaults())) {
            static::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }

    public static function putMany(array $data): void
    {
        foreach ($data as $key => $value) {
            static::put($key, (string) $value);
        }
    }

    /** true kalau path berasal dari upload admin (bukan file bawaan di public/images). */
    public static function isUploaded(?string $path): bool
    {
        return $path && !str_starts_with($path, 'images/');
    }

    public static function mediaUrl(?string $path): string
    {
        if (!$path) {
            return '';
        }

        return str_starts_with($path, 'images/')
            ? asset($path)
            : Storage::disk('public')->url($path);
    }
}
