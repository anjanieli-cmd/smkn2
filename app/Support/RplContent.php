<?php

namespace App\Support;

use App\Models\Major;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Isi halaman publik jurusan RPL (berdiri sendiri; salin & ganti nama untuk jurusan lain).
 *
 *  - sections()  : definisi section + field (dipakai admin untuk membuat form & validasi)
 *  - defaults()  : isi bawaan (RPL punya isi asli dari halaman lama)
 *  - get()       : isi bawaan digabung dengan yang tersimpan di kolom majors.details
 *  - url()/rich()/icon()... : pembantu untuk Blade halaman publik
 *
 * Semua isi disimpan di kolom JSON `details` milik tabel majors, jadi TIDAK perlu migrasi baru.
 */
class RplContent
{
    public const CODE = 'RPL';          // kode jurusan di tabel majors
    public const UPLOAD_DIR = 'majors';

    public const TONES = [
        ''      => 'Biru Tua',
        'green' => 'Hijau',
        'gold'  => 'Emas',
        'blue'  => 'Biru Muda',
    ];

    /* ------------------------------------------------------------------
     |  Pembantu pembuat definisi field
     * ------------------------------------------------------------------ */

    private static function f(string $key, string $label, string $type = 'text', array $o = []): array
    {
        return array_merge([
            'key'      => $key,
            'label'    => $label,
            'type'     => $type,      // text|textarea|icon|tone|select|image|video|check
            'default'  => $type === 'check' ? false : '',
            'max'      => $type === 'textarea' ? 1500 : 200,
            'hint'     => null,
            'required' => false,
            'options'  => [],
            'wide'     => in_array($type, ['textarea', 'image', 'video'], true),
        ], $o);
    }

    private static function show(string $section): array
    {
        return self::f("show_{$section}", 'Tampilkan section ini di halaman publik', 'check', ['default' => true]);
    }

    /** Kumpulan field judul 3 bagian: "baris putih" + "baris emas". */
    private static function head(string $p, string $eyebrow, string $h1, string $gold): array
    {
        return [
            self::f("{$p}_eyebrow", 'Label kecil di atas judul', 'text', ['default' => $eyebrow]),
            self::f("{$p}_h1", 'Judul (warna biru tua)', 'text', ['default' => $h1, 'required' => true]),
            self::f("{$p}_hgold", 'Lanjutan judul (warna emas)', 'text', ['default' => $gold]),
        ];
    }

    private static function iconTone(): array
    {
        return [
            self::f('icon', 'Ikon FontAwesome', 'icon', ['default' => 'fa-circle-check', 'max' => 60]),
            self::f('tone', 'Warna ikon', 'tone'),
        ];
    }

    /* ------------------------------------------------------------------
     |  Definisi section (urutan = urutan tab di admin = urutan di halaman publik)
     * ------------------------------------------------------------------ */

    public static function sections(): array
    {
        $T = fn (string $k, string $l, array $o = []) => self::f($k, $l, 'text', $o);
        $A = fn (string $k, string $l, array $o = []) => self::f($k, $l, 'textarea', $o);
        $I = fn (string $k, string $l, array $o = []) => self::f($k, $l, 'image', $o);

        return [

            /* ---------------- HERO ---------------- */
            'hero' => [
                'label' => 'Hero', 'icon' => 'fa-house', 'anchor' => '',
                'desc'  => 'Bagian paling atas halaman: label, judul besar, dan tombol Coding Lab Tour.',
                'blocks' => [[
                    'title'  => 'Teks Hero',
                    'fields' => [
                        $T('hero_kicker', 'Label kecil (pil oranye)', ['default' => 'PROGRAM KEAHLIAN {code}']),
                        self::f('hero_icon', 'Ikon di label', 'icon', ['default' => 'fa-code', 'max' => 60]),
                        $T('hero_title_1', 'Judul baris 1 (biru tua)', ['default' => '{code}', 'required' => true, 'max' => 40]),
                        $T('hero_title_2', 'Judul baris 2 (emas/oranye)', ['default' => 'SKANEDA', 'max' => 40]),
                        $T('hero_watermark', 'Tulisan besar transparan di latar belakang', ['default' => '{code}', 'max' => 20,
                            'hint' => 'Pendek saja, mis. kode jurusan.']),
                    ],
                ], [
                    'title'  => 'Tombol Coding Lab Tour',
                    'fields' => [
                        self::f('tour_show', 'Tampilkan tombol Coding Lab Tour di hero', 'check', ['default' => false]),
                        $T('tour_title', 'Teks tebal tombol', ['default' => 'Lihat Coding Lab Tour']),
                        $T('tour_sub', 'Teks kecil tombol', ['default' => 'Jelajahi Laboratorium Komputer {code}']),
                        $T('tour_scene', 'ID scene Coding Lab Tour', ['max' => 80,
                            'hint' => 'Contoh: lab-rpl (dipakai untuk ?scene=... di halaman Virtual Tour). Dipakai juga oleh section Coding Lab Tour di bawah.']),
                    ],
                ]],
            ],

            /* ---------------- VIDEO ---------------- */
            'video' => [
                'label' => 'Video', 'icon' => 'fa-film', 'anchor' => 'video',
                'desc'  => 'Video pengenalan jurusan (popup). Section ini otomatis tersembunyi kalau video belum diisi.',
                'blocks' => [[
                    'title'  => 'Video & Teks',
                    'fields' => [
                        self::show('video'),
                        $T('video_title_1', 'Judul (biru tua)', ['default' => 'MENGENAL LEBIH DEKAT', 'required' => true]),
                        $T('video_title_gold', 'Lanjutan judul (emas)', ['default' => '{code}']),
                        $A('video_desc', 'Deskripsi', ['default' => 'Kenali Program Keahlian {name}, mulai dari pembelajaran, kegiatan praktik, fasilitas, hingga pengalaman yang akan kamu dapatkan.', 'max' => 600]),
                        self::f('video_file', 'Video (MP4/WEBM)', 'video', ['hint' => 'Upload dari komputer, atau isi path file yang sudah ada di folder public (mis. images/videos/video-rpl.mp4). Maks 50 MB.']),
                        $T('video_label', 'Label pada pemutar', ['default' => 'Video Pengenalan']),
                        $T('video_brand_sub', 'Teks kecil di pojok pemutar', ['default' => 'Program Keahlian']),
                        $T('video_side', 'Tulisan vertikal di samping pemutar', ['default' => '{code} • SKANEDA']),
                    ],
                ], [
                    'title' => 'Tiga Kartu Kecil', 'repeater' => 'video_cards', 'item' => 'Kartu', 'max' => 3,
                    'fields' => array_merge(self::iconTone(), [
                        $T('title', 'Judul', ['required' => true, 'max' => 60]),
                        $T('desc', 'Keterangan singkat', ['max' => 100]),
                    ]),
                    'default' => [],
                ]],
            ],

            /* ---------------- TENTANG ---------------- */
            'tentang' => [
                'label' => 'Tentang', 'icon' => 'fa-circle-info', 'anchor' => 'tentang',
                'desc'  => 'Penjelasan jurusan, 4 poin ringkas, dan panel alur di sebelah kanan.',
                'blocks' => [[
                    'title'  => 'Teks Utama',
                    'fields' => array_merge([self::show('tentang')], self::head('about', 'Apa Itu {code}?', 'DARI IDE', 'MENJADI KARYA'), [
                        $T('about_h2', 'Lanjutan judul (biru tua, setelah emas)', ['default' => 'VISUAL', 'max' => 60, 'hint' => 'Opsional. Hasil akhir judul: baris biru + emas + baris ini.']),
                        $A('about_lead', 'Paragraf utama', ['default' => 'Program Keahlian **{name}** membekali peserta didik dengan keterampilan yang siap dipakai di dunia kerja dan usaha.',
                            'hint' => 'Bungkus dengan **dua bintang** untuk menebalkan kata.', 'max' => 800]),
                        $A('about_sub', 'Paragraf penjelas', ['max' => 800]),
                    ]),
                ], [
                    'title' => 'Empat Poin Ringkas (kartu kecil)', 'repeater' => 'about_minis', 'item' => 'Poin', 'max' => 4,
                    'fields' => array_merge(self::iconTone(), [
                        $T('text', 'Teks', ['required' => true, 'max' => 120]),
                    ]),
                    'default' => [],
                ], [
                    'title'  => 'Panel Alur (kanan)',
                    'fields' => [
                        $T('flow_label', 'Judul panel', ['default' => 'Alur {code}', 'max' => 40]),
                        self::f('flow_core_icon', 'Ikon lingkaran tengah', 'icon', ['default' => 'fa-graduation-cap', 'max' => 60]),
                        $T('flow_core_title', 'Teks lingkaran tengah', ['default' => '{code}', 'max' => 20]),
                        $T('flow_core_sub', 'Teks kecil lingkaran', ['default' => 'Skaneda', 'max' => 30]),
                        $T('flow_bottom', 'Teks di dasar panel', ['max' => 80]),
                    ],
                ], [
                    'title' => 'Empat Langkah Alur', 'repeater' => 'flow_steps', 'item' => 'Langkah', 'max' => 4,
                    'fields' => array_merge(self::iconTone(), [
                        $T('title', 'Judul', ['required' => true, 'max' => 40]),
                        $T('desc', 'Keterangan', ['max' => 60]),
                    ]),
                    'default' => [],
                ]],
            ],

            /* ---------------- MITRA INDUSTRI ---------------- */
            'mitra' => [
                'label' => 'Mitra Industri', 'icon' => 'fa-handshake', 'anchor' => 'industri',
                'desc'  => 'Logo mitra industri yang berjalan sebagai marquee. Disarankan logo PNG transparan.',
                'blocks' => [[
                    'title'  => 'Judul',
                    'fields' => array_merge([self::show('mitra')], self::head('partners', 'Kerja Sama & Dunia Industri', 'BERKOLABORASI DENGAN', 'DUNIA INDUSTRI'), [
                        $T('partners_footer', 'Teks di bawah marquee', ['default' => 'Belajar • Praktik • Berkolaborasi • Siap Berkarya']),
                    ]),
                ], [
                    'title' => 'Logo Mitra', 'repeater' => 'partners', 'item' => 'Mitra', 'max' => 40,
                    'fields' => [
                        $T('name', 'Nama mitra', ['required' => true, 'max' => 80]),
                        $I('image', 'Logo', ['hint' => 'Upload atau isi path (mis. images/rpl/logo.png).']),
                    ],
                    'default' => [],
                ]],
            ],

            /* ---------------- PEMBELAJARAN ---------------- */
            'belajar' => [
                'label' => 'Pembelajaran', 'icon' => 'fa-book-open', 'anchor' => 'pembelajaran',
                'desc'  => 'Kartu "Apa yang akan kamu pelajari" (disarankan 6, kelipatan 3 supaya rapi).',
                'blocks' => [[
                    'title'  => 'Judul',
                    'fields' => array_merge([self::show('belajar')], self::head('learn', 'APA YANG KAMU PELAJARI?', 'APA YANG AKAN', 'KAMU PELAJARI?')),
                ], [
                    'title' => 'Kartu Pembelajaran', 'repeater' => 'learn_items', 'item' => 'Kartu', 'max' => 12,
                    'fields' => array_merge(self::iconTone(), [
                        $T('title', 'Judul', ['required' => true, 'max' => 60]),
                        $A('desc', 'Deskripsi', ['max' => 300]),
                    ]),
                    'default' => [],
                ]],
            ],

            /* ---------------- PRAKTIK ---------------- */
            'praktik' => [
                'label' => 'Praktik', 'icon' => 'fa-people-carry-box', 'anchor' => 'praktik',
                'desc'  => 'Kartu foto "Belajar bukan hanya di kelas".',
                'blocks' => [[
                    'title'  => 'Judul',
                    'fields' => array_merge([self::show('praktik')], self::head('practice', 'BUKAN HANYA DI KELAS', 'BELAJAR BUKAN', 'HANYA DI KELAS')),
                ], [
                    'title' => 'Kartu Praktik', 'repeater' => 'practice_items', 'item' => 'Kartu', 'max' => 9,
                    'fields' => [
                        self::f('icon', 'Ikon lencana', 'icon', ['default' => 'fa-code', 'max' => 60]),
                        $T('badge', 'Teks lencana', ['default' => 'Praktik', 'max' => 30]),
                        $T('title', 'Judul', ['required' => true, 'max' => 80]),
                        $A('desc', 'Deskripsi', ['max' => 300]),
                        $I('image', 'Foto', ['hint' => 'Foto mendatar/portrait, maks 4 MB.']),
                    ],
                    'default' => [],
                ]],
            ],

            /* ---------------- FASILITAS ---------------- */
            'fasilitas' => [
                'label' => 'Fasilitas', 'icon' => 'fa-building', 'anchor' => 'fasilitas',
                'desc'  => 'Kartu fasilitas & laboratorium.',
                'blocks' => [[
                    'title'  => 'Judul',
                    'fields' => array_merge([self::show('fasilitas')], self::head('facility', 'Bebas Bereksperimen', 'RUANG UNTUK', 'BEREKSPERIMEN')),
                ], [
                    'title' => 'Kartu Fasilitas', 'repeater' => 'facility_items', 'item' => 'Fasilitas', 'max' => 12,
                    'fields' => array_merge(self::iconTone(), [
                        $T('title', 'Nama fasilitas', ['required' => true, 'max' => 60]),
                        $A('desc', 'Deskripsi', ['max' => 300]),
                    ]),
                    'default' => [],
                ]],
            ],

            /* ---------------- PRODUK / KARYA SISWA ---------------- */
            'produk' => [
                'label' => 'Karya Siswa', 'icon' => 'fa-box-open', 'anchor' => 'produk',
                'desc'  => 'Slider produk/karya siswa. Tombol filter dibuat otomatis dari kategori yang kamu isi.',
                'blocks' => [[
                    'title'  => 'Judul',
                    'fields' => array_merge([self::show('produk')], self::head('product', 'Karya Siswa', 'DARI IDE', 'MENJADI KARYA'), [
                        $A('product_note', 'Catatan di kanan judul', ['max' => 300]),
                    ]),
                ], [
                    'title' => 'Daftar Karya / Produk', 'repeater' => 'product_items', 'item' => 'Karya', 'max' => 30,
                    'fields' => [
                        $T('title', 'Nama karya', ['required' => true, 'max' => 80]),
                        $T('category', 'Kategori', ['default' => 'Karya', 'max' => 30, 'hint' => 'Mis. Pemrograman Web, Mobile, UI/UX Design. Jadi tombol filter.']),
                        $A('desc', 'Deskripsi', ['max' => 300]),
                        $T('foot', 'Teks kecil di dasar kartu', ['default' => 'Karya Siswa', 'max' => 40]),
                        $I('image', 'Foto', ['hint' => 'Disarankan rasio 4:3.']),
                    ],
                    'default' => [],
                ]],
            ],

            /* ---------------- KEGIATAN & PRESTASI ---------------- */
            'kegiatan' => [
                'label' => 'Kegiatan', 'icon' => 'fa-trophy', 'anchor' => 'kegiatan',
                'desc'  => 'Galeri kegiatan & prestasi. Kartu bertanda "tinggi" tampil dua baris.',
                'blocks' => [[
                    'title'  => 'Judul',
                    'fields' => array_merge([self::show('kegiatan')], self::head('activity', 'BERKARYA & BERPRESTASI', 'AKTIF BERKARYA,', 'BERANI BERPRESTASI')),
                ], [
                    'title' => 'Kartu Kegiatan', 'repeater' => 'activity_items', 'item' => 'Kegiatan', 'max' => 12,
                    'fields' => [
                        self::f('icon', 'Ikon lencana', 'icon', ['default' => 'fa-trophy', 'max' => 60]),
                        $T('badge', 'Teks lencana', ['default' => 'Kegiatan', 'max' => 30]),
                        $T('title', 'Judul', ['required' => true, 'max' => 80]),
                        $T('desc', 'Keterangan singkat', ['max' => 160]),
                        self::f('tall', 'Kartu tinggi (dua baris)', 'check'),
                        $I('image', 'Foto'),
                    ],
                    'default' => [],
                ]],
            ],

            /* ---------------- PROSPEK LULUSAN ---------------- */
            'prospek' => [
                'label' => 'Prospek Lulusan', 'icon' => 'fa-route', 'anchor' => 'prospek',
                'desc'  => 'Kartu "Setelah lulus mau ke mana?" (Kerja / Kuliah / Usaha, dll).',
                'blocks' => [[
                    'title'  => 'Judul',
                    'fields' => array_merge([self::show('prospek')], self::head('prospect', 'Mau ke Mana ya?', 'SETELAH LULUS,', 'MAU KEMANA?')),
                ], [
                    'title' => 'Kartu Prospek', 'repeater' => 'prospect_items', 'item' => 'Prospek', 'max' => 6,
                    'fields' => array_merge(self::iconTone(), [
                        $T('title', 'Judul', ['required' => true, 'max' => 40]),
                        $A('desc', 'Deskripsi', ['max' => 300]),
                        $T('tags', 'Tag (pisahkan dengan koma)', ['max' => 160, 'hint' => 'Contoh: Software House, Startup Teknologi']),
                        $I('image', 'Foto'),
                    ]),
                    'default' => [],
                ]],
            ],

            /* ---------------- LAB TOUR ---------------- */
            'lab' => [
                'label' => 'Coding Lab Tour', 'icon' => 'fa-compass', 'anchor' => 'lab-tour',
                'desc'  => 'Banner ajakan menuju Coding Lab Tour. Butuh "ID scene Coding Lab Tour" di tab Hero.',
                'blocks' => [[
                    'title'  => 'Konten Coding Lab Tour',
                    'fields' => [
                        self::show('lab'),
                        $T('lab_kicker', 'Label kecil', ['default' => 'Software Development Practice Experience']),
                        $T('lab_h1', 'Judul (biru tua)', ['default' => 'Jelajahi', 'required' => true, 'max' => 40]),
                        $T('lab_hgold', 'Lanjutan judul (emas)', ['default' => 'Laboratorium Komputer {code}', 'max' => 40]),
                        $T('lab_sub', 'Sub-judul kecil', ['default' => 'Lihat Coding Lab Tour {code}']),
                        $A('lab_desc', 'Deskripsi', ['max' => 500]),
                        $T('lab_feats', 'Tiga label fitur (pisahkan dengan koma)', ['default' => 'Fasilitas Lab Komputer, Pengembangan Aplikasi, Presentasi Proyek', 'max' => 200]),
                        $T('lab_btn', 'Teks tombol', ['default' => 'Mulai Coding Lab Tour', 'max' => 40]),
                        $T('lab_watermark', 'Tulisan besar transparan', ['default' => 'RPL', 'max' => 12]),
                        self::f('lab_image', 'Foto banner', 'image', ['hint' => 'Mis. tour/lab-rpl.jpg atau upload.']),
                        $T('lab_badge', 'Lencana pada foto', ['default' => 'Coding Lab Tour', 'max' => 30]),
                        $T('lab_caption_title', 'Judul di atas foto', ['default' => 'Jelajahi Laboratorium Komputer {code}']),
                        $T('lab_caption_sub', 'Keterangan di atas foto', ['max' => 120]),
                        $T('lab_chip_title', 'Judul chip kecil', ['default' => 'Coding Lab Tour {code}', 'max' => 40]),
                        $T('lab_chip_sub', 'Keterangan chip kecil', ['default' => 'Explore {code} Coding Lab', 'max' => 60]),
                    ],
                ]],
            ],

            /* ---------------- CTA ---------------- */
            'cta' => [
                'label' => 'Ajakan Penutup', 'icon' => 'fa-paper-plane', 'anchor' => '',
                'desc'  => 'Kotak biru di paling bawah dengan tombol pendaftaran.',
                'blocks' => [[
                    'title'  => 'Konten',
                    'fields' => [
                        $T('cta_h1', 'Judul (putih)', ['default' => 'Siap Menjadi Bagian dari', 'required' => true]),
                        $T('cta_hgold', 'Lanjutan judul (emas)', ['default' => '{code}?']),
                        $A('cta_desc', 'Paragraf', ['default' => 'Daftarkan dirimu dan kembangkan potensi terbaikmu bersama SMK Negeri 2 Mojokerto.', 'max' => 400]),
                        $T('cta_btn_text', 'Teks tombol', ['default' => 'Daftar PPDB', 'required' => true, 'max' => 40]),
                        $T('cta_btn_url', 'Link tombol', ['max' => 255, 'hint' => 'Kosong = halaman PPDB (route ppdb). Harus diawali http://, https://, / atau #.']),
                        $T('cta_watermark', 'Tulisan besar transparan', ['default' => '#{code}', 'max' => 20]),
                        self::f('cta_bg', 'Foto latar (samar)', 'image'),
                    ],
                ]],
            ],
        ];
    }

    /* ------------------------------------------------------------------
     |  Isi bawaan
     * ------------------------------------------------------------------ */

    public static function defaults(?Major $m = null): array
    {
        $m ??= new Major(['code' => 'KODE', 'name' => 'Nama Jurusan']);

        $out = [];
        foreach (self::sections() as $s) {
            foreach ($s['blocks'] as $b) {
                if (isset($b['repeater'])) {
                    $out[$b['repeater']] = $b['default'] ?? [];
                } else {
                    foreach ($b['fields'] as $f) {
                        $out[$f['key']] = $f['default'];
                    }
                }
            }
        }

        if (true) { // kelas ini khusus RPL
            $out = array_replace($out, self::rpl());
        }

        return self::tok($out, $m);
    }

    /** Isi bawaan + data tersimpan. Kunci yang pernah disimpan admin selalu menang (termasuk kosong). */
    /** Baris jurusan RPL di tabel majors (tempat isi halaman disimpan di kolom details). */
    public static function major(): Major
    {
        return Major::where('code', self::CODE)->firstOrFail();
    }

    public static function get(Major $m): array
    {
        $d = self::defaults($m);
        $stored = is_array($m->details) ? $m->details : [];

        return array_replace($d, array_intersect_key($stored, $d));
    }

    private static function tok(mixed $v, Major $m): mixed
    {
        if (is_array($v)) {
            return array_map(fn ($x) => self::tok($x, $m), $v);
        }
        if (is_string($v)) {
            return strtr($v, ['{code}' => (string) $m->code, '{name}' => (string) $m->name]);
        }

        return $v;
    }

    /* ------------------------------------------------------------------
     |  Pembantu untuk Blade
     * ------------------------------------------------------------------ */

    public static function url(?string $path): string
    {
        $p = trim((string) $path);
        if ($p === '') {
            return '';
        }
        if (preg_match('#^https?://#i', $p)) {
            return $p;
        }
        if (str_starts_with($p, self::UPLOAD_DIR . '/')) {
            return Storage::disk('public')->url($p);
        }

        return asset(ltrim($p, '/'));
    }

    public static function isUploaded(?string $path): bool
    {
        return is_string($path) && str_starts_with($path, self::UPLOAD_DIR . '/');
    }

    /** Escape lalu ubah **teks** menjadi <strong>teks</strong>. Aman dari HTML. */
    public static function rich(?string $text): string
    {
        return preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', e((string) $text));
    }

    public static function icon(?string $icon, string $fallback = 'fa-circle'): string
    {
        $icon = trim((string) $icon);

        return preg_match('/^fa-[a-z0-9-]+$/', $icon) ? $icon : $fallback;
    }

    public static function tone(?string $tone): string
    {
        return in_array($tone, ['green', 'gold', 'blue'], true) ? $tone : '';
    }

    public static function tags(?string $csv): array
    {
        return array_values(array_filter(array_map('trim', explode(',', (string) $csv)), fn ($t) => $t !== ''));
    }

    public static function slug(string $s): string
    {
        return Str::slug($s) ?: 'lainnya';
    }

    /* ------------------------------------------------------------------
     |  Isi asli halaman RPL (disalin dari rpl.blade.php yang lama)
     * ------------------------------------------------------------------ */

    private static function rpl(): array
    {
        $p = fn (string $icon, string $tone, string $title, string $desc) => compact('icon', 'tone', 'title', 'desc');

        return [
            'hero_kicker' => 'PROGRAM KEAHLIAN RPL', 'hero_icon' => 'fa-code',
            'hero_title_1' => 'RPL', 'hero_title_2' => 'SKANEDA', 'hero_watermark' => 'RPL',
            'tour_show' => true, 'tour_title' => 'Lihat Coding Lab Tour', 'tour_sub' => 'Jelajahi Laboratorium Komputer Rekayasa Perangkat Lunak', 'tour_scene' => 'lab-rpl',

            'video_file' => 'images/videos/video-rpl.mp4',
            'video_desc' => 'Kenali Program Keahlian Rekayasa Perangkat Lunak (RPL), mulai dari pembelajaran, praktik coding, fasilitas laboratorium, hingga berbagai pengalaman yang akan kamu dapatkan selama belajar di RPL.',
            'video_side' => 'RPL • SKANEDA',
            'video_cards' => [
                $p('fa-code', 'green', 'Dasar Pemrograman', 'Memahami logika, algoritma, dan struktur data'),
                $p('fa-laptop-code', '', 'Pengembangan Aplikasi', 'Mempelajari pengembangan aplikasi web & mobile'),
                $p('fa-database', 'gold', 'Basis Data', 'Merancang dan mengelola basis data aplikasi'),
            ],

            'about_eyebrow' => 'Apa Itu RPL?', 'about_h1' => 'DARI LOGIKA', 'about_hgold' => 'MENJADI APLIKASI', 'about_h2' => '',
            'about_lead' => 'Program Keahlian **Rekayasa Perangkat Lunak (RPL)** membekali peserta didik dengan keterampilan merancang, membangun, dan menguji perangkat lunak — mulai dari pemrograman dasar, pengembangan aplikasi web & mobile, basis data, hingga UI/UX design.',
            'about_sub' => 'Pembelajaran mencakup algoritma & struktur data, bahasa pemrograman, basis data, pengembangan aplikasi berbasis web dan mobile, desain antarmuka (UI/UX), serta pengujian dan penerapan perangkat lunak. Melalui proyek nyata dan praktik laboratorium, siswa belajar membangun aplikasi yang fungsional sekaligus mengembangkan jiwa kewirausahaan digital.',
            'about_minis' => [
                ['icon' => 'fa-code', 'tone' => '', 'text' => 'Pemrograman — Menguasai logika & bahasa pemrograman'],
                ['icon' => 'fa-laptop-code', 'tone' => 'green', 'text' => 'Pengembangan Aplikasi — Membangun aplikasi web & mobile'],
                ['icon' => 'fa-database', 'tone' => 'gold', 'text' => 'Basis Data — Merancang dan mengelola basis data'],
                ['icon' => 'fa-pen-ruler', 'tone' => '', 'text' => 'UI/UX — Merancang antarmuka yang mudah digunakan'],
            ],
            'flow_label' => 'Alur RPL', 'flow_core_icon' => 'fa-code', 'flow_core_title' => 'RPL', 'flow_core_sub' => 'Logika hingga Rilis',
            'flow_bottom' => 'WEB • MOBILE • DATABASE',
            'flow_steps' => [
                $p('fa-lightbulb', '', 'Analisis Kebutuhan', 'Mengenal masalah pengguna'),
                $p('fa-code', 'green', 'Coding & Development', 'Membangun aplikasi'),
                $p('fa-bug', 'blue', 'Testing & Debugging', 'Kualitas & keamanan'),
                $p('fa-rocket', 'gold', 'Rilis Aplikasi', 'Siap digunakan'),
            ],

            'partners_eyebrow' => 'Kerja Sama & Industri Teknologi',
            'partners_h1' => 'BERKOLABORASI DENGAN', 'partners_hgold' => 'INDUSTRI TEKNOLOGI',
            'partners_footer' => 'Belajar • Coding • Berkolaborasi • Siap Berkarya',
            'partners' => array_map(
                fn ($r) => ['name' => $r[0], 'image' => 'images/rpl/' . $r[1] . '.png'],
                [
                    ['PT Hummatech Indonesia', 'hummatech'], ['PT Minarsih Tech Mojokerto', 'minarsih'], ['PT Universal Big Data', 'ubig'],
                    ['IT Brain Indonesia', 'it-brain'], ['PT Otak Kanan', 'otak-kanan'], ['IT Corner', 'it-corner'],
                    ['Topsell Mojokerto', 'topsell'], ['Bitniaga', 'bitniaga'], ['Movenpick Hotel', 'movenpick'],
                    ['Dispenduk', 'dispenduk'], ['Jaccs MFM', 'jaccsmfm'], ['Permata', 'permata'],
                ]
            ),

            'learn_eyebrow' => 'APA YANG KAMU PELAJARI?', 'learn_h1' => 'APA YANG AKAN', 'learn_hgold' => 'KAMU PELAJARI?',
            'learn_items' => [
                $p('fa-code', '', 'Algoritma & Pemrograman Dasar', 'Mempelajari logika berpikir komputasional, struktur data, dan dasar-dasar bahasa pemrograman.'),
                $p('fa-globe', 'green', 'Pemrograman Web', 'Membangun website dengan HTML, CSS, JavaScript, hingga framework backend modern.'),
                $p('fa-mobile-screen-button', 'blue', 'Pemrograman Mobile', 'Mengembangkan aplikasi Android/mobile mulai dari antarmuka hingga fungsi utama aplikasi.'),
                $p('fa-database', 'gold', 'Basis Data', 'Merancang, membuat query, dan mengelola basis data untuk mendukung aplikasi yang dibangun.'),
                $p('fa-pen-ruler', '', 'UI/UX Design', 'Merancang antarmuka yang mudah digunakan, konsisten, dan sesuai kebutuhan pengguna.'),
                $p('fa-lightbulb', 'gold', 'Kewirausahaan Digital', 'Mengembangkan jiwa usaha: membangun produk digital, memasarkan, dan membangun startup mandiri.'),
            ],

            'practice_eyebrow' => 'BELAJAR LEWAT PROYEK NYATA', 'practice_h1' => 'BELAJAR BUKAN', 'practice_hgold' => 'HANYA DI DALAM KELAS',
            'practice_items' => [
                ['icon' => 'fa-code', 'badge' => 'Praktik', 'title' => 'Praktik Lab Komputer', 'desc' => 'Mengerjakan proyek pemrograman dan pengembangan aplikasi di laboratorium komputer RPL yang mendukung proses belajar.', 'image' => 'images/rpl/praktik-rpl.jpg'],
                ['icon' => 'fa-laptop-code', 'badge' => 'Pengembangan', 'title' => 'Pengembangan Aplikasi', 'desc' => 'Menghasilkan aplikasi nyata seperti website, aplikasi mobile, sistem informasi, dan game sederhana.', 'image' => 'images/rpl/ukk-rpl.jpeg'],
                ['icon' => 'fa-circle-check', 'badge' => 'Evaluasi', 'title' => 'Pengujian Aplikasi', 'desc' => 'Menguji, dan menyempurnakan aplikasi berdasarkan fungsi, tampilan, dan kebutuhan pengguna.', 'image' => 'images/rpl/pengujian-rpl.jpg'],
            ],

            'facility_eyebrow' => 'Bebas Bereksperimen', 'facility_h1' => 'RUANG UNTUK', 'facility_hgold' => 'BEREKSPERIMEN',
            'facility_items' => [
                $p('fa-laptop-code', '', 'Laboratorium Komputer', 'Lab pemrograman lengkap dengan perangkat modern untuk praktik coding dan pengembangan aplikasi.'),
            ],

            'product_eyebrow' => 'Karya Siswa', 'product_h1' => 'DARI IDE', 'product_hgold' => 'MENJADI KARYA',
            'product_note' => 'Kumpulan proyek siswa RPL — dirancang melalui proses analisis, coding, pengujian, dan presentasi aplikasi.',
            'product_items' => [
                ['title' => 'Aplikasi Tambal Ban Express', 'category' => 'Pemrograman Web', 'desc' => 'Aplikasi layanan tambal ban berbasis web yang memudahkan pengguna memesan layanan tambal ban secara cepat dan praktis.', 'foot' => 'Lab Komputer', 'image' => 'images/rpl/tambalbanexpres.jpeg'],
                ['title' => 'Maja Mojo', 'category' => 'Pengolahan', 'desc' => 'Minuman olahan berbahan dasar buah mojo dengan cita rasa unik, inovasi kreatif siswa RPL dalam memanfaatkan bahan pangan lokal.', 'foot' => 'Lab Komputer', 'image' => 'images/rpl/estrakbuahmojo.jpeg'],
                ['title' => 'Website Berbasis Python', 'category' => 'UI/UX Design', 'desc' => 'Meraih prestasi melalui pengembangan website berbasis Python dalam ajang FESTIKA 2025.', 'foot' => 'Lab Komputer', 'image' => 'images/rpl/festika-produk.jpeg'],
            ],

            'activity_eyebrow' => 'BERKARYA & BERPRESTASI', 'activity_h1' => 'AKTIF BERKARYA,', 'activity_hgold' => 'BERANI BERPRESTASI',
            'activity_items' => [
                ['icon' => 'fa-trophy', 'badge' => 'Prestasi', 'title' => 'Prestasi Siswa RPL', 'desc' => 'Prestasi lomba pemrograman, hackathon, web design, dan aplikasi mobile tingkat kota hingga nasional', 'tall' => true, 'image' => 'images/rpl/prestasi-rpl.jpg'],
                ['icon' => 'fa-code', 'badge' => 'Praktik', 'title' => 'Coding Bareng', 'desc' => 'Kegiatan praktik rutin di laboratorium RPL untuk menghasilkan aplikasi nyata', 'tall' => false, 'image' => 'images/rpl/codingbareng.jpg'],
                ['icon' => 'fa-building', 'badge' => 'Industri', 'title' => 'Kunjungan Industri Teknologi', 'desc' => 'Belajar langsung dari startup, software house, dan perusahaan teknologi', 'tall' => false, 'image' => 'images/rpl/ki-rpl.jpg'],
                ['icon' => 'fa-laptop-code', 'badge' => 'Pameran', 'title' => 'Pameran', 'desc' => 'Memamerkan website terbaik karya siswa dalam berbagai pameran teknologi', 'tall' => false, 'image' => 'images/rpl/pameran.png'],
                ['icon' => 'fa-user-tie', 'badge' => 'PKL', 'title' => 'PKL & Magang di Industri Teknologi', 'desc' => 'Pengalaman kerja langsung di software house, startup, dan perusahaan digital', 'tall' => false, 'image' => 'images/rpl/pkl-rpl.jpeg'],
            ],

            'prospect_eyebrow' => 'Mau Jadi Apa?', 'prospect_h1' => 'SETELAH LULUS,', 'prospect_hgold' => 'MAU JADI APA?',
            'prospect_items' => [
                ['icon' => 'fa-laptop-code', 'tone' => 'blue', 'title' => 'KERJA', 'desc' => 'Software Developer, Programmer, Web Developer, Mobile App Developer, UI/UX Designer, Database Administrator — siap berkarya di industri teknologi.', 'tags' => 'Software House, Startup Teknologi, IT Perusahaan, Freelancer', 'image' => 'images/rpl/kerja-rpl.jpg'],
                ['icon' => 'fa-graduation-cap', 'tone' => '', 'title' => 'KULIAH', 'desc' => 'Teknik Informatika, Sistem Informasi, Ilmu Komputer, Teknologi Informasi, atau bidang teknologi terkait — bekal RPL jadi modal kuat di perguruan tinggi.', 'tags' => 'Teknik Informatika, Sistem Informasi, Ilmu Komputer', 'image' => 'images/rpl/kuliah.jpeg'],
                ['icon' => 'fa-laptop-code', 'tone' => 'green', 'title' => 'USAHA DIGITAL', 'desc' => 'Jasa pembuatan website, aplikasi, startup digital, freelance developer, dan bisnis teknologi mandiri — bangun usaha digital dengan produk dan idemu sendiri.', 'tags' => 'Startup, Freelance Developer, Produk Digital', 'image' => 'images/rpl/usaha-rpl.jpeg'],
            ],

            'lab_kicker' => 'Software Development Practice Experience', 'lab_h1' => 'Jelajahi', 'lab_hgold' => 'Laboratorium Komputer RPL', 'lab_sub' => 'Lihat Coding Lab Tour RPL',
            'lab_desc' => 'Kenali lebih dekat laboratorium komputer RPL sebagai ruang belajar dan praktik untuk merancang, membangun, dan menguji aplikasi web maupun mobile.',
            'lab_feats' => 'Fasilitas Lab Komputer, Pengembangan Aplikasi, Presentasi Proyek',
            'lab_btn' => 'Mulai Coding Lab Tour', 'lab_watermark' => 'RPL',
            'lab_image' => 'tour/lab-rpl.jpg', 'lab_badge' => 'Coding Lab Tour',
            'lab_caption_title' => 'Jelajahi Laboratorium Komputer RPL', 'lab_caption_sub' => 'Fasilitas praktik Rekayasa Perangkat Lunak',
            'lab_chip_title' => 'Coding Lab Tour RPL', 'lab_chip_sub' => 'Explore RPL Coding Lab',

            'cta_h1' => 'Siap Menjadi Bagian dari', 'cta_hgold' => 'RPL?',
            'cta_desc' => 'Kenali potensimu, temukan pengalaman belajar yang sesuai, dan mulai perjalananmu bersama RPL — dari logika menuju aplikasi dan karier di dunia teknologi.',
            'cta_btn_text' => 'Daftar PPDB', 'cta_watermark' => '#RPL',
            'cta_bg' => 'images/aphp-upacara.jpg',
        ];
    }
}
