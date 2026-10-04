<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KegiatanSetting extends Model
{
    protected $table = 'kegiatan_settings';

    protected $fillable = ['key', 'value'];

    /** Teks bawaan = isi halaman sebelum ada admin. Dipakai selama key belum pernah disimpan. */
    public static function defaults(): array
    {
        return [
            // ---- HERO ----
            'hero_kicker'  => 'School Activity Journal',
            'hero_title_1' => 'Kegiatan',
            'hero_title_2' => 'Skaneda',
            'hero_lead'    => 'Momen, kegiatan, dan pengalaman yang membentuk keluarga besar SMK Negeri 2 Mojokerto — didokumentasikan dalam satu jurnal aktivitas sekolah.',
            'hero_pill_1'  => 'Photo Journal',
            'hero_pill_2'  => 'Sepanjang Tahun',
            'hero_pill_3'  => 'Semua Warga Sekolah',

            // ---- PEMBUKA ----
            'intro_eyebrow'  => 'Aktivitas Skaneda',
            'intro_title_1'  => 'Hidup Sekolah',
            'intro_title_2'  => 'yang',
            'intro_title_em' => 'Bergerak',
            'intro_text'     => 'Di SMK Negeri 2 Mojokerto, belajar tidak pernah berhenti di dalam kelas. Lomba, latihan, karya, upacara, dan kunjungan industri menjadi irama harian yang membentuk karakter, keterampilan, dan kebersamaan.',
            'intro_pill'     => 'Sekolah Adiwiyata 2025',

            'stat_1_num' => '20+',  'stat_1_label' => 'Kegiatan per Tahun',
            'stat_2_num' => '12',   'stat_2_label' => 'Ekstrakurikuler Aktif',
            'stat_3_num' => '5',    'stat_3_label' => 'Kompetensi Raih Juara',
            'stat_4_num' => '100%', 'stat_4_label' => 'Siswa Ikut Kegiatan',

            'quote_text'   => 'Sekolah bukan hanya tempat belajar, tetapi juga tempat bertumbuh — lewat setiap kegiatan, siswa belajar bekerja sama, memimpin, dan memberi.',
            'quote_author' => '— Pembina Kesiswaan SKANEDA',
            'quote_stamp'  => '#SkanedaAktif',

            // ---- GALERI ----
            'gallery_eyebrow'      => 'Photo Journal',
            'gallery_title'        => 'Jejak',
            'gallery_title_em'     => 'Kegiatan',
            'gallery_text'         => 'Koleksi foto kegiatan siswa — dari ruang praktik hingga panggung penghargaan. Pilih kategori untuk menyaring momen favoritmu.',
            'gallery_search_hint'  => 'Cari judul kegiatan...',

            // ---- KALENDER ----
            'year_eyebrow'  => 'Activity Calendar',
            'year_title'    => 'Perjalanan',
            'year_title_em' => 'Satu Tahun',
            'year_text'     => 'Irama kegiatan SKANEDA sepanjang tahun ajaran — dari MPLS hingga pelepasan, dari ruang kelas hingga panggung penghargaan.',

            // ---- MOMEN PILIHAN ----
            'picks_eyebrow'  => 'Curated Moments',
            'picks_title'    => 'Momen',
            'picks_title_em' => 'Pilihan',
            'picks_text'     => 'Beberapa momen yang paling membekas — dipilih dari ribuan foto kegiatan di sepanjang tahun.',

            // ---- CTA ----
            'cta_title'    => 'Ikuti Terus',
            'cta_title_em' => 'Setiap Langkah Kami',
            'cta_text'     => 'Jadilah bagian dari cerita SMK Negeri 2 Mojokerto. Kabar kegiatan terbaru selalu kami sampaikan lewat kanal resmi sekolah.',
            'cta_btn_text' => 'Hubungi Sekolah',
            'cta_btn_url'  => '',   // kosong = route('kontak')
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
