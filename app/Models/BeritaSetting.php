<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeritaSetting extends Model
{
    protected $table = 'berita_settings';

    protected $fillable = ['key', 'value'];

    /** Teks bawaan = isi halaman sebelum ada admin. Dipakai selama key belum pernah disimpan. */
    public static function defaults(): array
    {
        return [
            // ---- HERO ----
            'hero_kicker'   => 'Kanal Berita & Informasi Resmi Sekolah',
            'hero_title_1'  => 'Berita',
            'hero_title_2'  => 'Skaneda',
            'hero_pill_1'   => 'Arsip Kegiatan Skaneda',
            'hero_pill_2'   => 'Data Bersumber dari Dokumen Sekolah',
            'hero_pill_3'   => '28 Artikel',

            // ---- STRIP EDISI ----
            'strip_label' => 'Terkini',
            'strip_text'  => '#SkanedaBerkegiatan — Dokumentasi kegiatan, prestasi, dan perjalanan siswa SMK Negeri 2 Mojokerto.',

            // ---- CTA PENUTUP ----
            'cta_title'      => 'Punya kabar menarik',
            'cta_title_gold' => 'dari Skaneda?',
            'cta_text'       => 'Kirim liputan, dokumentasi kegiatan, atau karya jurnalistikmu untuk dimuat di kanal Berita Skaneda — redaksi terbuka untuk seluruh warga sekolah.',
            'cta_btn_text'   => 'Kirim ke Redaksi',
            'cta_btn_url'    => '',   // kosong = route('kontak')
            'cta_note'       => 'Informasi resmi: smkn2mojokerto.sch.id · #DisiplinBerprestasi',
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

    public static function putMany(array $data): void
    {
        $allowed = array_keys(static::defaults());

        foreach ($data as $key => $value) {
            if (in_array($key, $allowed, true)) {
                static::updateOrCreate(['key' => $key], ['value' => (string) $value]);
            }
        }
    }
}
