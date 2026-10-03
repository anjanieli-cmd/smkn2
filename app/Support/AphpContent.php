<?php

namespace App\Support;

use App\Models\Major;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Isi halaman publik jurusan APHP (berdiri sendiri; salin & ganti nama untuk jurusan lain).
 *
 *  - sections()  : definisi section + field (dipakai admin untuk membuat form & validasi)
 *  - defaults()  : isi bawaan (APHP punya isi asli dari halaman lama, jurusan lain teks generik)
 *  - get()       : isi bawaan digabung dengan yang tersimpan di kolom majors.details
 *  - url()/rich()/icon()... : pembantu untuk Blade halaman publik
 *
 * Semua isi disimpan di kolom JSON `details` milik tabel majors, jadi TIDAK perlu migrasi baru.
 */
class AphpContent
{
    public const CODE = 'APHP';          // kode jurusan di tabel majors
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
                'desc'  => 'Bagian paling atas halaman: label, judul besar, dan tombol Lab Tour.',
                'blocks' => [[
                    'title'  => 'Teks Hero',
                    'fields' => [
                        $T('hero_kicker', 'Label kecil (pil oranye)', ['default' => 'PROGRAM KEAHLIAN {code}']),
                        self::f('hero_icon', 'Ikon di label', 'icon', ['default' => 'fa-graduation-cap', 'max' => 60]),
                        $T('hero_title_1', 'Judul baris 1 (biru tua)', ['default' => '{code}', 'required' => true, 'max' => 40]),
                        $T('hero_title_2', 'Judul baris 2 (emas/oranye)', ['default' => 'SKANEDA', 'max' => 40]),
                        $T('hero_watermark', 'Tulisan besar transparan di latar belakang', ['default' => '{code}', 'max' => 20,
                            'hint' => 'Pendek saja, mis. kode jurusan.']),
                    ],
                ], [
                    'title'  => 'Tombol Lab Tour',
                    'fields' => [
                        self::f('tour_show', 'Tampilkan tombol Lab Tour di hero', 'check', ['default' => false]),
                        $T('tour_title', 'Teks tebal tombol', ['default' => 'Lihat Lab Tour']),
                        $T('tour_sub', 'Teks kecil tombol', ['default' => 'Jelajahi Laboratorium {code}']),
                        $T('tour_scene', 'ID scene Lab Tour', ['max' => 80,
                            'hint' => 'Contoh: lab-2-aphp (dipakai untuk ?scene=... di halaman Virtual Tour). Dipakai juga oleh section Lab Tour di bawah.']),
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
                    'fields' => array_merge([self::show('tentang')], self::head('about', 'Apa Itu {code}?', 'DARI AWAL', 'MENJADI AHLI'), [
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
                        $I('image', 'Logo', ['hint' => 'Upload atau isi path (mis. images/aphp/logo.png).']),
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
                        self::f('icon', 'Ikon lencana', 'icon', ['default' => 'fa-flask', 'max' => 60]),
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
                        $T('category', 'Kategori', ['default' => 'Karya', 'max' => 30, 'hint' => 'Mis. Makanan, Minuman, Aplikasi. Jadi tombol filter.']),
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
                        $T('tags', 'Tag (pisahkan dengan koma)', ['max' => 160, 'hint' => 'Contoh: QC, Produksi, Marketing']),
                        $I('image', 'Foto'),
                    ]),
                    'default' => [],
                ]],
            ],

            /* ---------------- LAB TOUR ---------------- */
            'lab' => [
                'label' => 'Lab Tour', 'icon' => 'fa-compass', 'anchor' => 'lab-tour',
                'desc'  => 'Banner ajakan menuju Virtual/Lab Tour. Butuh "ID scene Lab Tour" di tab Hero.',
                'blocks' => [[
                    'title'  => 'Konten Lab Tour',
                    'fields' => [
                        self::show('lab'),
                        $T('lab_kicker', 'Label kecil', ['default' => 'Laboratory Experience']),
                        $T('lab_h1', 'Judul (biru tua)', ['default' => 'Jelajahi', 'required' => true, 'max' => 40]),
                        $T('lab_hgold', 'Lanjutan judul (emas)', ['default' => 'Lab {code}', 'max' => 40]),
                        $T('lab_sub', 'Sub-judul kecil', ['default' => 'Lihat Lab Tour {code}']),
                        $A('lab_desc', 'Deskripsi', ['max' => 500]),
                        $T('lab_feats', 'Tiga label fitur (pisahkan dengan koma)', ['default' => 'Fasilitas Praktik, Peralatan Modern, Suasana Belajar', 'max' => 200]),
                        $T('lab_btn', 'Teks tombol', ['default' => 'Mulai Lab Tour', 'max' => 40]),
                        $T('lab_watermark', 'Tulisan besar transparan', ['default' => 'LAB', 'max' => 12]),
                        self::f('lab_image', 'Foto banner', 'image', ['hint' => 'Mis. tour/lab-2-aphp.jpg atau upload.']),
                        $T('lab_badge', 'Lencana pada foto', ['default' => 'Lab Tour', 'max' => 30]),
                        $T('lab_caption_title', 'Judul di atas foto', ['default' => 'Jelajahi Laboratorium {code}']),
                        $T('lab_caption_sub', 'Keterangan di atas foto', ['max' => 120]),
                        $T('lab_chip_title', 'Judul chip kecil', ['default' => 'Lab Tour {code}', 'max' => 40]),
                        $T('lab_chip_sub', 'Keterangan chip kecil', ['default' => 'Explore {code} Laboratory', 'max' => 60]),
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

        if (true) { // kelas ini khusus APHP
            $out = array_replace($out, self::aphp());
        }

        return self::tok($out, $m);
    }

    /** Isi bawaan + data tersimpan. Kunci yang pernah disimpan admin selalu menang (termasuk kosong). */
    /** Baris jurusan APHP di tabel majors (tempat isi halaman disimpan di kolom details). */
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
     |  Isi asli halaman APHP (disalin dari halaman publik lama)
     * ------------------------------------------------------------------ */

    private static function aphp(): array
    {
        $p = fn (string $icon, string $tone, string $title, string $desc) => compact('icon', 'tone', 'title', 'desc');

        return [
            'hero_kicker' => 'PROGRAM KEAHLIAN APHP', 'hero_icon' => 'fa-seedling',
            'hero_title_1' => 'APHP', 'hero_title_2' => 'SKANEDA', 'hero_watermark' => 'APHP',
            'tour_show' => true, 'tour_title' => 'Lihat Lab Tour', 'tour_sub' => 'Jelajahi Laboratorium APHP', 'tour_scene' => 'lab-2-aphp',

            'video_file' => 'images/videos/video-aphp.mp4',
            'video_desc' => 'Kenali Program Keahlian Agribisnis Pengolahan Hasil Pertanian, mulai dari pembelajaran, kegiatan praktik, fasilitas, hingga berbagai pengalaman yang akan kamu dapatkan selama belajar di APHP.',
            'video_side' => 'APHP • SKANEDA',
            'video_cards' => [
                $p('fa-wheat-awn', 'green', 'Bahan Pertanian', 'Mengenal potensi hasil pertanian'),
                $p('fa-flask', '', 'Teknologi Pengolahan', 'Belajar proses pengolahan pangan'),
                $p('fa-box-open', 'gold', 'Produk Bernilai', 'Menghasilkan produk siap dikembangkan'),
            ],

            'about_eyebrow' => 'Apa Itu APHP?', 'about_h1' => 'DARI BAHAN BAKU', 'about_hgold' => 'JADI PRODUK', 'about_h2' => 'BERNILAI',
            'about_lead' => 'Program Keahlian **Agribisnis Pengolahan Hasil Pertanian (APHP)** membekali peserta didik dengan keterampilan mengolah hasil pertanian menjadi produk berkualitas dan bernilai jual.',
            'about_sub' => 'Pembelajaran mencakup pengolahan bahan nabati, hewani, herbal, dan perkebunan, pengujian mutu, pengemasan, serta pemasaran produk. Melalui praktik dan unit produksi, siswa belajar menghasilkan produk sekaligus mengembangkan jiwa kewirausahaan.',
            'about_minis' => [
                ['icon' => 'fa-wheat-awn', 'tone' => '', 'text' => 'Agribisnis — Mengenal bahan & hasil pertanian'],
                ['icon' => 'fa-flask', 'tone' => 'green', 'text' => 'Teknologi — Mempelajari proses pengolahan'],
                ['icon' => 'fa-bread-slice', 'tone' => 'gold', 'text' => 'Produk Pangan — Menghasilkan produk nyata'],
                ['icon' => 'fa-chart-line', 'tone' => '', 'text' => 'Kewirausahaan — Mengembangkan peluang usaha'],
            ],
            'flow_label' => 'Alur APHP', 'flow_core_icon' => 'fa-seedling', 'flow_core_title' => 'APHP', 'flow_core_sub' => 'Farm to Future',
            'flow_bottom' => 'AGRIBISNIS • TEKNOLOGI • PRODUK',
            'flow_steps' => [
                $p('fa-wheat-awn', '', 'Bahan Pertanian', 'Mengenal potensi bahan'),
                $p('fa-flask', 'green', 'Pengolahan', 'Proses menjadi produk'),
                $p('fa-microscope', 'blue', 'Uji Mutu', 'Kualitas & keamanan'),
                $p('fa-box-open', 'gold', 'Produk Bernilai', 'Siap dikembangkan'),
            ],

            'partners' => array_map(
                fn ($r) => ['name' => $r[0], 'image' => 'images/aphp/' . $r[1] . '.png'],
                [
                    ['Eni Cookies', 'enicookies'], ["Nawasena's House", 'nawasena'], ['Sigma Food', 'sigmafood'],
                    ['Hachi Donut', 'hachi'], ['PT Sido Jodo', 'sidojodo'], ['Olivia Bakery', 'olivia'],
                    ['Amateras Bakery', 'amateras'], ['Sanrio', 'sanrio'], ['Nun Bakery', 'nun-bakery'],
                    ['Family Food', 'family-food'], ['Dxavier', 'dxavier'], ['DKU Donut', 'dku-donut'], ['Arasa', 'arasa'],
                ]
            ),

            'learn_items' => [
                $p('fa-flask', '', 'Teknologi Pengolahan', 'Mempelajari teknik pengolahan bahan nabati, hewani, dan herbal menjadi produk berkualitas.'),
                $p('fa-wheat-awn', 'green', 'Bahan Hasil Pertanian', 'Mengenal karakteristik, penanganan, dan pengolahan berbagai bahan hasil pertanian.'),
                $p('fa-microscope', 'blue', 'Analisis & Mutu', 'Mempelajari pengujian mutu produk: kadar air, keasaman, uji organoleptik, dan keamanan pangan.'),
                $p('fa-clipboard-check', 'gold', 'Higiene & Sanitasi', 'Menerapkan prinsip kebersihan dan keamanan pangan dalam setiap proses produksi.'),
                $p('fa-box-open', '', 'Pengemasan', 'Merancang kemasan yang menarik, aman, dan sesuai standar industri pangan.'),
                $p('fa-chart-line', 'gold', 'Kewirausahaan', 'Mengembangkan jiwa usaha: menghitung kelayakan, memasarkan, dan membangun bisnis mandiri.'),
            ],

            'practice_items' => [
                ['icon' => 'fa-flask', 'badge' => 'Praktik', 'title' => 'Panen Kedelai', 'desc' => 'Siswa APHP turut serta dalam kegiatan Temu Lapang dan Panen Produk Benih Sumber VUB Kedelai di Mojokerto.', 'image' => 'images/aphp/panen-kedelai.jpeg'],
                ['icon' => 'fa-industry', 'badge' => 'Produksi', 'title' => 'Pameran Produk Kreatif', 'desc' => 'Ajang kreativitas siswa APHP dalam menampilkan beragam produk inovatif hasil olahan pertanian.', 'image' => 'images/aphp/pameran.jpeg'],
                ['icon' => 'fa-clipboard-check', 'badge' => 'Produksi', 'title' => 'MJFEE', 'desc' => 'Siswa APHP turut memamerkan beragam produk olahan kreatif dalam Millenial Job Fair and Entrepreneur Expo.', 'image' => 'images/aphp/MJFEE.jpeg'],
            ],

            'facility_items' => [
                $p('fa-flask', '', 'Laboratorium APHP', 'Lab pengolahan lengkap dengan peralatan modern untuk praktik dan eksperimen.'),
                $p('fa-tools', 'green', 'Peralatan Praktik', 'Alat pengolahan, pengemasan, dan pengujian mutu yang memadai dan terawat.'),
                $p('fa-industry', 'gold', 'Ruang Produksi', 'Ruang produksi yang higienis dan sesuai standar keamanan pangan.'),
                $p('fa-box-open', '', 'Area Pengemasan', 'Area khusus untuk pengemasan produk dengan standar mutu dan desain menarik.'),
                $p('fa-snowflake', 'green', 'Penyimpanan', 'Fasilitas penyimpanan bahan baku dan produk jadi yang terjaga kualitasnya.'),
                $p('fa-laptop', 'gold', 'Fasilitas Pendukung', 'Ruang kelas, perpustakaan, dan akses digital untuk menunjang pembelajaran.'),
            ],

            'product_note' => 'Hasil olahan karya siswa APHP — diproduksi di laboratorium sekolah dengan standar higiene dan mutu.',
            'product_items' => [
                ['title' => 'MultiMie', 'category' => 'Makanan', 'desc' => 'Mi instan praktis dengan bumbu siap seduh — produk inovasi siswa APHP.', 'foot' => 'Unit Produksi', 'image' => 'images/aphp/multimie.jpeg'],
                ['title' => 'Sari Bunga Telang', 'category' => 'Minuman', 'desc' => 'Minuman herbal alami dari ekstrak bunga telang dengan warna biru khas dan cita rasa menyegarkan — inovasi olahan kreatif siswa APHP.', 'foot' => 'Unit Produksi', 'image' => 'images/aphp/bungatelang.jpeg'],
                ['title' => 'Mie Daun Kelor', 'category' => 'Makanan', 'desc' => 'Mie goreng bergizi dengan warna hijau alami dari ekstrak daun kelor, dilengkapi isian ayam dan sayuran.', 'foot' => 'Unit Produksi', 'image' => 'images/aphp/mie-kelor.jpeg'],
                ['title' => 'Triple Choco', 'category' => 'Makanan', 'desc' => 'Roti manis dengan perpaduan tiga varian cokelat — produk kreatif siswa APHP', 'foot' => 'Unit Produksi', 'image' => 'images/aphp/triplechoco.jpeg'],
            ],

            'activity_items' => [
                ['icon' => 'fa-trophy', 'badge' => 'Prestasi', 'title' => 'Prestasi Siswa APHP', 'desc' => 'Juara lomba & penghargaan tingkat kota hingga nasional', 'tall' => true, 'image' => 'images/aphp/fiksi.jpg'],
                ['icon' => 'fa-flask', 'badge' => 'Praktik', 'title' => 'Praktik Produksi', 'desc' => 'Kegiatan praktik rutin di laboratorium APHP', 'tall' => false, 'image' => 'images/aphp/praktik-produksi.jpeg'],
                ['icon' => 'fa-building', 'badge' => 'Industri', 'title' => 'Kunjungan Industri', 'desc' => 'Belajar langsung dari dunia industri pengolahan pangan', 'tall' => false, 'image' => 'images/aphp/ki-aphp.jpeg'],
                ['icon' => 'fa-box-open', 'badge' => 'Pameran', 'title' => 'Pameran Produk', 'desc' => 'Memamerkan produk unggulan di berbagai ajang', 'tall' => false, 'image' => 'images/aphp/pameran.jpeg'],
                ['icon' => 'fa-briefcase', 'badge' => 'PKL', 'title' => 'PKL & Magang', 'desc' => 'Pengalaman kerja langsung di industri dan perusahaan', 'tall' => false, 'image' => 'images/aphp/pkl.jpg'],
            ],

            'prospect_items' => [
                ['icon' => 'fa-briefcase', 'tone' => 'blue', 'title' => 'KERJA', 'desc' => 'Industri pangan, Quality Control, Produksi, Packaging, Marketing — siap kerja dengan sertifikat kompetensi.', 'tags' => 'Industri Pangan, QC, Produksi, Marketing', 'image' => 'images/aphp/bekerja-aphp.jpeg'],
                ['icon' => 'fa-graduation-cap', 'tone' => '', 'title' => 'KULIAH', 'desc' => 'Teknologi pangan, Agribisnis, Gizi, atau bidang terkait — bekal APHP jadi modal kuat di perguruan tinggi.', 'tags' => 'Teknologi Pangan, Agribisnis, Gizi', 'image' => 'images/aphp/kuliah.jpeg'],
                ['icon' => 'fa-rocket', 'tone' => 'green', 'title' => 'USAHA', 'desc' => 'Produk pangan, Unit produksi, Bisnis mandiri — bangun usaha sendiri dengan merek dan produkmu.', 'tags' => 'Produk Pangan, Unit Produksi, Bisnis', 'image' => 'images/aphp/usaha-aphp.jpeg'],
            ],

            'lab_desc' => 'Kenali lebih dekat laboratorium APHP sebagai ruang belajar dan praktik untuk mengolah hasil pertanian menjadi produk pangan. Lihat fasilitas dan suasana praktik APHP dari dekat.',
            'lab_feats' => 'Fasilitas Praktik, Pengolahan Pangan, Pengujian Produk',
            'lab_image' => 'tour/lab-2-aphp.jpg',
            'lab_caption_sub' => 'Fasilitas praktik Agribisnis Pengolahan Hasil Pertanian',

            'cta_desc' => 'Kenali potensimu, temukan pengalaman belajar yang sesuai, dan mulai perjalananmu bersama APHP — dari farm menuju future.',
            'cta_bg' => 'images/aphp-upacara.jpg',
        ];
    }
}
