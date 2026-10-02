<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PpdbSetting extends Model
{
    protected $table = 'ppdb_settings';

    protected $fillable = ['key', 'value'];

    /**
     * Isian teks per tab admin.
     * key => [tab, label, tipe (input|textarea), wajib?, maksimal karakter, judul kelompok (opsional)]
     */
    public const FIELDS = [
        // ---- tab "teks": bagian atas & penutup ----
        'hero_kicker'     => ['teks', 'Label kecil di atas judul', 'input', false, 120, 'Hero (bagian paling atas halaman)'],
        'hero_title_1'    => ['teks', 'Judul baris 1 (biru)', 'input', true, 40],
        'hero_title_2'    => ['teks', 'Judul baris 2 (emas)', 'input', true, 40],
        'cta_title'       => ['teks', 'Judul (putih)', 'input', true, 120, 'Ajakan penutup (kotak biru di paling bawah)'],
        'cta_title_gold'  => ['teks', 'Lanjutan judul (emas)', 'input', false, 120],
        'cta_text'        => ['teks', 'Paragraf', 'textarea', false, 600],
        'cta_button_text' => ['teks', 'Teks tombol', 'input', true, 60],
        'cta_button_url'  => ['teks', 'Link tombol (opsional)', 'input', false, 255, null, 'Kosong = otomatis ke halaman Kontak. Boleh diawali http://, https://, / atau #.'],
        'cta_note'        => ['teks', 'Catatan kecil di bawah tombol', 'input', false, 200],

        // ---- Pengertian ----
        'intro_heading'      => ['definisi', 'Judul (biru)', 'input', true, 80, 'Judul bagian'],
        'intro_heading_gold' => ['definisi', 'Lanjutan judul (emas)', 'input', false, 80],
        'intro_note'         => ['definisi', 'Paragraf pengantar', 'textarea', false, 500],

        // ---- Jalur ----
        'track_heading'      => ['jalur', 'Judul (biru)', 'input', true, 80, 'Judul bagian'],
        'track_heading_gold' => ['jalur', 'Lanjutan judul (emas)', 'input', false, 80],
        'track_note'         => ['jalur', 'Paragraf di samping judul', 'textarea', false, 400],

        // ---- Persyaratan ----
        'req_heading'      => ['syarat', 'Judul (biru)', 'input', true, 80, 'Judul bagian'],
        'req_heading_gold' => ['syarat', 'Lanjutan judul (emas)', 'input', false, 80],
        'req_note'         => ['syarat', 'Kotak catatan kuning di bawah daftar berkas', 'textarea', false, 600],

        // ---- Alur ----
        'flow_heading'      => ['alur', 'Judul (biru)', 'input', true, 80, 'Judul bagian'],
        'flow_heading_gold' => ['alur', 'Lanjutan judul (emas)', 'input', false, 80],

        // ---- Jadwal ----
        'jadwal_heading'      => ['jadwal', 'Judul (biru)', 'input', true, 80, 'Judul bagian'],
        'jadwal_heading_gold' => ['jadwal', 'Lanjutan judul (emas)', 'input', false, 80],
        'jadwal_title'        => ['jadwal', 'Judul kotak jadwal', 'input', true, 120],
        'jadwal_badge'        => ['jadwal', 'Label tahun pelajaran', 'input', false, 80],
        'jadwal_foot'         => ['jadwal', 'Catatan di bawah tabel', 'textarea', false, 400],

        // ---- Program keahlian ----
        'jurusan_heading'      => ['jurusan', 'Judul (biru)', 'input', true, 80, 'Judul bagian'],
        'jurusan_heading_gold' => ['jurusan', 'Lanjutan judul (emas)', 'input', false, 80],
        'jurusan_note'         => ['jurusan', 'Paragraf di samping judul', 'textarea', false, 400],

        // ---- FAQ ----
        'faq_heading'      => ['faq', 'Judul (biru)', 'input', true, 80, 'Judul bagian'],
        'faq_heading_gold' => ['faq', 'Lanjutan judul (emas)', 'input', false, 80],
        'faq_note'         => ['faq', 'Paragraf di samping judul', 'textarea', false, 400],
    ];

    /** Teks bawaan = isi halaman sebelum ada admin. */
    public static function defaults(): array
    {
        return [
            'hero_kicker'     => 'Penerimaan Peserta Didik Baru',
            'hero_title_1'    => 'PPDB',
            'hero_title_2'    => 'SKANEDA',

            'intro_heading'      => 'EMPAT KATA, SATU',
            'intro_heading_gold' => 'MASA DEPAN.',
            'intro_note'         => 'PPDB adalah pintu masuk resmi bagi calon peserta didik untuk bergabung menjadi bagian dari keluarga besar Skaneda.',
            'intro_banner'       => 'images/jurusan.jpeg',

            'track_heading'      => 'EMPAT JALUR MENUJU',
            'track_heading_gold' => 'SKANEDA.',
            'track_note'         => 'Setiap calon peserta didik dapat memilih jalur yang paling sesuai dengan kondisi dan potensinya.',

            'req_heading'      => 'SIAPKAN',
            'req_heading_gold' => 'BERKASMU.',
            'req_note'         => 'Jalur afirmasi wajib melampirkan bukti keikutsertaan program penanganan keluarga tidak mampu (KIP/PKH/DTKS). Berkas difotokopi sesuai ketentuan panitia resmi.',

            'flow_heading'      => 'ENAM LANGKAH MENUJU',
            'flow_heading_gold' => 'GERBANG SKANEDA.',

            'jadwal_heading'      => 'CATAT TANGGAL',
            'jadwal_heading_gold' => 'PENTINGNYA.',
            'jadwal_title'        => 'Jadwal PPDB SMK Negeri 2 Mojokerto',
            'jadwal_badge'        => 'Tahun Pelajaran 2026/2027',
            'jadwal_foot'         => 'Jadwal dapat berubah mengikuti ketetapan resmi Dinas Pendidikan Provinsi Jawa Timur — pantau terus pengumuman sekolah.',

            'jurusan_heading'      => 'PILIH KOMPETENSI, RAIH',
            'jurusan_heading_gold' => 'MASA DEPANMU.',
            'jurusan_note'         => 'SMK Negeri 2 Mojokerto membuka 5 kompetensi keahlian yang selaras dengan kebutuhan dunia usaha dan dunia industri.',

            'faq_heading'      => 'MASIH ADA',
            'faq_heading_gold' => 'PERTANYAAN?',
            'faq_note'         => 'Jawaban singkat untuk pertanyaan yang paling sering ditanyakan calon peserta didik dan orang tua.',

            'cta_title'       => 'Siap menjadi bagian dari',
            'cta_title_gold'  => 'keluarga Skaneda?',
            'cta_text'        => 'Jangan lewatkan kesempatanmu! Siapkan berkas, pilih kompetensi keahlian favoritmu, dan wujudkan masa depan yang lebih cerah bersama SMK Negeri 2 Mojokerto.',
            'cta_button_text' => 'Hubungi Panitia PPDB',
            'cta_button_url'  => '',   // kosong = otomatis ke route kontak
            'cta_note'        => 'Informasi resmi: smkn2mojokerto.sch.id · #DisiplinBerprestasi',
        ];
    }

    /** Field untuk satu tab: key => [tab, label, tipe, wajib, max, kelompok, hint] */
    public static function fieldsFor(string $tab): array
    {
        return array_filter(self::FIELDS, fn ($f) => $f[0] === $tab);
    }

    /** Semua nilai: default digabung dengan yang tersimpan di database. */
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

    /**
     * URL gambar.
     * - File lama di public/ (mis. "images/jurusan.jpeg") -> asset()
     * - Hasil upload admin (disk public) -> Storage url
     */
    public static function imageUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }
        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }
        if (file_exists(public_path($path))) {
            return asset($path);
        }

        return Storage::disk('public')->url($path);
    }
}
