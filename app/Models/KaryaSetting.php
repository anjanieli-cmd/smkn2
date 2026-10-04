<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KaryaSetting extends Model
{
    protected $table = 'karya_settings';

    protected $fillable = ['key', 'value'];

    /**
     * Teks bawaan = isi halaman sebelum ada admin. Dipakai selama key belum pernah disimpan.
     * Pada paragraf, **teks** akan ditampilkan tebal.
     */
    public static function defaults(): array
    {
        return [
            // ---- HERO ----
            'hero_kicker'  => 'Galeri Karya Peserta Didik',
            'hero_title_1' => 'Karya',
            'hero_title_2' => 'Siswa',

            // ---- PENGANTAR ----
            'intro_title'    => 'Karya nyata,',
            'intro_title_em' => 'buah dari belajar.',
            'intro_note'     => 'Karya siswa adalah wujud nyata dari pembelajaran berbasis proyek dan kearifan lokal yang dikembangkan SMK Negeri 2 Mojokerto.',

            'stat_1_num' => '25+', 'stat_1_label' => 'Karya Per Tahun',
            'stat_2_num' => '5',   'stat_2_label' => 'Kompetensi Keahlian',
            'stat_3_num' => '3',   'stat_3_label' => 'Kategori Unggulan',

            'cat_line' => 'Kategori karya yang dikembangkan',

            'blurb_1' => 'Setiap kompetensi keahlian di Skaneda menghasilkan **karya yang nyata dan aplikatif** — dari aplikasi digital, produk kuliner, desain visual, hingga olahan hasil pertanian bernilai tambah. Karya-karya ini lahir dari **praktik langsung, kerja sama industri, dan ajang lomba**, sehingga peserta didik tidak hanya unggul secara teori, tetapi juga **siap berkarya dan siap bekerja** setelah lulus.',
            'blurb_2' => 'Lewat galeri ini, kami mempersembahkan sebagian kecil dari **kebanggaan Skaneda** — bukti bahwa peserta didik SMK bisa menghasilkan karya yang membanggakan sekolah, keluarga, dan daerah.',

            // ---- SLIDER ----
            'slider_title'    => 'Galeri karya',
            'slider_title_em' => 'pilihan.',
            'slider_note'     => 'Geser atau gunakan tombol panah untuk menjelajahi karya — setiap slide memuat foto, judul karya, nama siswa, jurusan, dan tahun.',

            // ---- BIDANG / KATEGORI ----
            'kat_title'    => 'Lima bidang,',
            'kat_title_em' => 'ratusan karya.',
            'kat_note'     => 'Karya siswa tersebar di seluruh kompetensi keahlian — semuanya lahir dari praktik nyata dan kemitraan industri.',

            // ---- PRODUK ----
            'prod_title'    => 'Produk nyata,',
            'prod_title_em' => 'karya siswa sendiri.',
            'prod_note'     => 'Sebagian produk hasil tangan peserta didik Skaneda — dari aplikasi, kuliner, desain, hingga olahan pertanian dan layanan keuangan syariah.',

            // ---- CTA ----
            'cta_title'    => 'Karya berikutnya bisa jadi',
            'cta_title_em' => 'karyamu.',
            'cta_text'     => 'Bergabunglah bersama SMK Negeri 2 Mojokerto dan wujudkan kreativitasmu menjadi karya nyata — didukung guru profesional, fasilitas lengkap, dan kemitraan dunia usaha & industri.',
            'cta_btn_text' => 'Hubungi Sekolah',
            'cta_btn_url'  => '',   // kosong = route('kontak')
            'cta_note'     => 'Informasi resmi: smkn2mojokerto.sch.id · #DisiplinBerprestasi',
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
