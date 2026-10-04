<?php

namespace App\Support;

use App\Models\Major;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Isi halaman publik jurusan DKV (berdiri sendiri; salin & ganti nama untuk jurusan lain).
 *
 *  - sections()  : definisi section + field (dipakai admin untuk membuat form & validasi)
 *  - defaults()  : isi bawaan (DKV punya isi asli dari halaman lama, jurusan lain teks generik)
 *  - get()       : isi bawaan digabung dengan yang tersimpan di kolom majors.details
 *  - url()/rich()/icon()... : pembantu untuk Blade halaman publik
 *
 * Semua isi disimpan di kolom JSON `details` milik tabel majors, jadi TIDAK perlu migrasi baru.
 */
class DkvContent
{
    public const CODE = 'DKV';          // kode jurusan di tabel majors
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
                'desc'  => 'Bagian paling atas halaman: label, judul besar, dan tombol Studio Tour.',
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
                    'title'  => 'Tombol Studio Tour',
                    'fields' => [
                        self::f('tour_show', 'Tampilkan tombol Studio Tour di hero', 'check', ['default' => false]),
                        $T('tour_title', 'Teks tebal tombol', ['default' => 'Lihat Studio Tour']),
                        $T('tour_sub', 'Teks kecil tombol', ['default' => 'Jelajahi Studio {code}']),
                        $T('tour_scene', 'ID scene Studio Tour', ['max' => 80,
                            'hint' => 'Contoh: lab-dkv (dipakai untuk ?scene=... di halaman Virtual Tour). Dipakai juga oleh section Studio Tour di bawah.']),
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
                        self::f('video_file', 'Video (MP4/WEBM)', 'video', ['hint' => 'Upload dari komputer, atau isi path file yang sudah ada di folder public (mis. images/videos/video-dkv.mp4). Maks 50 MB.']),
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
                        $I('image', 'Logo', ['hint' => 'Upload atau isi path (mis. images/dkv/logo.png).']),
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
                        self::f('icon', 'Ikon lencana', 'icon', ['default' => 'fa-vector-square', 'max' => 60]),
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
                'desc'  => 'Kartu fasilitas & studio.',
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
                        $T('category', 'Kategori', ['default' => 'Karya', 'max' => 30, 'hint' => 'Mis. Desain Grafis, Fotografi, Produk Kreatif. Jadi tombol filter.']),
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
                        $T('tags', 'Tag (pisahkan dengan koma)', ['max' => 160, 'hint' => 'Contoh: Agensi Kreatif, Studio Desain']),
                        $I('image', 'Foto'),
                    ]),
                    'default' => [],
                ]],
            ],

            /* ---------------- LAB TOUR ---------------- */
            'lab' => [
                'label' => 'Studio Tour', 'icon' => 'fa-compass', 'anchor' => 'lab-tour',
                'desc'  => 'Banner ajakan menuju Virtual/Studio Tour. Butuh "ID scene Studio Tour" di tab Hero.',
                'blocks' => [[
                    'title'  => 'Konten Studio Tour',
                    'fields' => [
                        self::show('lab'),
                        $T('lab_kicker', 'Label kecil', ['default' => 'Creative Studio Experience']),
                        $T('lab_h1', 'Judul (biru tua)', ['default' => 'Jelajahi', 'required' => true, 'max' => 40]),
                        $T('lab_hgold', 'Lanjutan judul (emas)', ['default' => 'Studio {code}', 'max' => 40]),
                        $T('lab_sub', 'Sub-judul kecil', ['default' => 'Lihat Studio Tour {code}']),
                        $A('lab_desc', 'Deskripsi', ['max' => 500]),
                        $T('lab_feats', 'Tiga label fitur (pisahkan dengan koma)', ['default' => 'Fasilitas Studio, Desain Grafis, Presentasi Karya', 'max' => 200]),
                        $T('lab_btn', 'Teks tombol', ['default' => 'Mulai Studio Tour', 'max' => 40]),
                        $T('lab_watermark', 'Tulisan besar transparan', ['default' => 'DKV', 'max' => 12]),
                        self::f('lab_image', 'Foto banner', 'image', ['hint' => 'Mis. tour/lab-dkv.jpg atau upload.']),
                        $T('lab_badge', 'Lencana pada foto', ['default' => 'Studio Tour', 'max' => 30]),
                        $T('lab_caption_title', 'Judul di atas foto', ['default' => 'Jelajahi Studio {code}']),
                        $T('lab_caption_sub', 'Keterangan di atas foto', ['max' => 120]),
                        $T('lab_chip_title', 'Judul chip kecil', ['default' => 'Studio Tour {code}', 'max' => 40]),
                        $T('lab_chip_sub', 'Keterangan chip kecil', ['default' => 'Explore {code} Creative Studio', 'max' => 60]),
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

        if (true) { // kelas ini khusus DKV
            $out = array_replace($out, self::dkv());
        }

        return self::tok($out, $m);
    }

    /** Isi bawaan + data tersimpan. Kunci yang pernah disimpan admin selalu menang (termasuk kosong). */
    /** Baris jurusan DKV di tabel majors (tempat isi halaman disimpan di kolom details). */
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
     |  Isi asli halaman DKV (disalin dari halaman publik DKV)
     * ------------------------------------------------------------------ */

    private static function dkv(): array
    {
        $p = fn (string $icon, string $tone, string $title, string $desc) => compact('icon', 'tone', 'title', 'desc');

        return [
            'hero_kicker' => 'PROGRAM KEAHLIAN DKV', 'hero_icon' => 'fa-pen-nib',
            'hero_title_1' => 'DKV', 'hero_title_2' => 'SKANEDA', 'hero_watermark' => 'DKV',
            'tour_show' => true, 'tour_title' => 'Lihat Studio Tour', 'tour_sub' => 'Jelajahi Studio DKV', 'tour_scene' => 'lab-dkv',

            'video_file' => 'images/videos/video-dkv.mp4',
            'video_desc' => 'Kenali Program Keahlian Desain Komunikasi Visual, mulai dari pembelajaran, kegiatan praktik, fasilitas, hingga berbagai pengalaman yang akan kamu dapatkan selama belajar di DKV.',
            'video_side' => 'DKV • SKANEDA',
            'video_cards' => [
                $p('fa-palette', 'green', 'Ide & Konsep', 'Mengembangkan ide dan konsep visual'),
                $p('fa-vector-square', '', 'Desain Grafis', 'Mempelajari prinsip desain dan komposisi visual'),
                $p('fa-object-group', 'gold', 'Karya Visual', 'Menghasilkan karya visual yang komunikatif'),
            ],

            'about_eyebrow' => 'Apa Itu DKV?', 'about_h1' => 'DARI IDE', 'about_hgold' => 'MENJADI KARYA', 'about_h2' => 'VISUAL',
            'about_lead' => 'Program Keahlian **Desain Komunikasi Visual (DKV)** membekali peserta didik dengan keterampilan merancang pesan visual melalui desain grafis, ilustrasi, fotografi, videografi, branding, dan media digital.',
            'about_sub' => 'Pembelajaran mencakup desain grafis, ilustrasi digital, fotografi, videografi, tipografi, branding, layout, serta media digital. Melalui proyek kreatif dan praktik studio, siswa belajar menghasilkan karya yang komunikatif sekaligus mengembangkan jiwa kewirausahaan.',
            'about_minis' => [
                ['icon' => 'fa-palette', 'tone' => '', 'text' => 'Desain Komunikasi Visual — Mengenal elemen & prinsip visual'],
                ['icon' => 'fa-vector-square', 'tone' => 'green', 'text' => 'Ilustrasi — Menciptakan visual yang ekspresif'],
                ['icon' => 'fa-camera', 'tone' => 'gold', 'text' => 'Karya Kreatif — Menghasilkan produk nyata'],
                ['icon' => 'fa-lightbulb', 'tone' => '', 'text' => 'Branding — Membangun identitas visual yang kuat'],
            ],
            'flow_label' => 'Alur DKV', 'flow_core_icon' => 'fa-pen-nib', 'flow_core_title' => 'DKV', 'flow_core_sub' => 'Idea to Future',
            'flow_bottom' => 'DESAIN • VISUAL • KREATIF',
            'flow_steps' => [
                $p('fa-palette', '', 'Ide & Konsep', 'Menggali ide & referensi visual'),
                $p('fa-vector-square', 'green', 'Desain', 'Proses membentuk karya'),
                $p('fa-magnifying-glass', 'blue', 'Review & Revisi', 'Evaluasi konsep & tampilan'),
                $p('fa-object-group', 'gold', 'Karya Visual', 'Siap dikembangkan'),
            ],

            'partners_eyebrow' => 'Kerja Sama & Industri Kreatif',
            'partners_h1' => 'BERKOLABORASI DENGAN', 'partners_hgold' => 'INDUSTRI KREATIF',
            'partners_footer' => 'Belajar • Praktik • Berkolaborasi • Siap Berkarya',
            'partners' => array_map(
                fn ($r) => ['name' => $r[0], 'image' => 'images/dkv/' . $r[1] . '.png'],
                [
                    ['Casalamia Photo Studio', 'casalamia'], ['Ilham Camera', 'ilham-camera'], ['OURASTUDIO', 'ourastudio'],
                    ['Matahari Advertising', 'matahari-adver'], ['Sensatype Studio', 'sensatype'], ['Utero Mojokerto', 'utero'],
                    ['Zavision Digital Workshop', 'zavision'], ['Difams', 'difams'], ['Rumah Kemasan', 'rumah-kemasan'],
                    ['Teknos', 'teknos'], ['Ziebest', 'ziebest'], ['MPJ', 'MPJ'],
                ]
            ),

            'learn_eyebrow' => 'APA YANG KAMU PELAJARI?', 'learn_h1' => 'APA YANG AKAN', 'learn_hgold' => 'KAMU PELAJARI?',
            'learn_items' => [
                $p('fa-vector-square', '', 'Desain Grafis', 'Mempelajari prinsip desain grafis, komposisi, warna, tipografi, dan tata letak untuk menghasilkan visual yang komunikatif.'),
                $p('fa-palette', 'green', 'Konsep Visual', 'Mengembangkan konsep, moodboard, referensi, dan gaya visual sesuai kebutuhan proyek.'),
                $p('fa-magnifying-glass', 'blue', 'Analisis & Mutu', 'Mempelajari proses review karya, konsistensi visual, keterbacaan, dan kesesuaian desain dengan target audiens.'),
                $p('fa-circle-check', 'gold', 'Fotografi & Videografi', 'Membuat foto dan video untuk kebutuhan dokumentasi, promosi, storytelling, dan konten digital.'),
                $p('fa-object-group', '', 'Branding & Identitas Visual', 'Merancang logo, warna, tipografi, dan elemen identitas visual yang konsisten untuk sebuah brand.'),
                $p('fa-lightbulb', 'gold', 'Kewirausahaan', 'Mengembangkan jiwa usaha: menghitung kelayakan, memasarkan, dan membangun bisnis mandiri.'),
            ],

            'practice_eyebrow' => 'BELAJAR LEWAT PROYEK KREATIF', 'practice_h1' => 'BELAJAR BUKAN', 'practice_hgold' => 'HANYA DI KELAS',
            'practice_items' => [
                ['icon' => 'fa-vector-square', 'badge' => 'Praktik', 'title' => 'Praktik Studio', 'desc' => 'Mengerjakan proyek desain dan produksi media visual di studio DKV yang mendukung proses kreatif.', 'image' => 'images/dkv/dkv-photo.jpg'],
                ['icon' => 'fa-film', 'badge' => 'Produksi', 'title' => 'Studio Produksi', 'desc' => 'Menghasilkan karya nyata seperti poster, identitas merek, ilustrasi, konten media sosial, dan video kreatif.', 'image' => 'images/dkv/dkv-labjurusan.jpg'],
                ['icon' => 'fa-circle-check', 'badge' => 'Praktik', 'title' => 'Fotografi', 'desc' => 'Menghasilkan karya visual melalui teknik pengambilan gambar, pencahayaan, komposisi, dan pengaturan objek.', 'image' => 'images/dkv/photography.jpg'],
            ],

            'facility_eyebrow' => 'Bebas Bereksperimen', 'facility_h1' => 'RUANG UNTUK', 'facility_hgold' => 'BEREKSPERIMEN',
            'facility_items' => [
                $p('fa-vector-square', '', 'Laboratorium DKV', 'Studio desain lengkap dengan perangkat modern untuk praktik dan eksperimen visual.'),
                $p('fa-film', 'gold', 'Studio Foto & Video', 'Ruang produksi untuk fotografi, videografi, lighting, dan pembuatan konten visual.'),
            ],

            'product_eyebrow' => 'Karya Siswa', 'product_h1' => 'DARI IDE', 'product_hgold' => 'MENJADI KARYA',
            'product_note' => 'Kumpulan karya siswa DKV — dirancang melalui proses kreatif, revisi, presentasi, dan produksi media visual.',
            'product_items' => [
                ['title' => 'Desain Aplikasi', 'category' => 'Desain Grafis', 'desc' => 'Merancang tampilan untuk pengguna melalui eksplorasi layout, warna, tipografi, dan elemen visual yang fungsional dan menarik.', 'foot' => 'Studio Produksi', 'image' => 'images/dkv/tambalbanexpres.jpeg'],
                ['title' => 'Fotografi Produk', 'category' => 'Fotografi', 'desc' => 'Eksplorasi komposisi, pencahayaan, dan sudut pengambilan untuk menghasilkan visual yang menarik.', 'foot' => 'Studio Produksi', 'image' => 'images/dkv/multimie.jpeg'],
                ['title' => 'NIRMANA 3D', 'category' => 'Produk Kreatif', 'desc' => 'Mengeksplorasi bentuk, ruang, tekstur, dan komposisi untuk menghasilkan karya tiga dimensi yang harmonis dan menarik.', 'foot' => 'Studio Produksi', 'image' => 'images/dkv/nirmana.jpeg'],
                ['title' => 'Figur Karakter', 'category' => 'Produk Kreatif', 'desc' => 'Merancang karakter visual dengan bentuk, warna, dan identitas yang unik.', 'foot' => 'Studio Produksi', 'image' => 'images/dkv/patung.jpeg'],
            ],

            'activity_eyebrow' => 'BERKARYA & BERPRESTASI', 'activity_h1' => 'AKTIF BERKARYA,', 'activity_hgold' => 'BERANI BERPRESTASI',
            'activity_items' => [
                ['icon' => 'fa-trophy', 'badge' => 'Prestasi', 'title' => 'Prestasi Siswa DKV', 'desc' => 'Prestasi lomba desain, ilustrasi, fotografi, dan multimedia tingkat kota hingga nasional', 'tall' => true, 'image' => 'images/dkv/dkv-fiksi.jpg'],
                ['icon' => 'fa-vector-square', 'badge' => 'Praktik', 'title' => 'Produksi Kreatif', 'desc' => 'Kegiatan praktik rutin di studio DKV untuk menghasilkan karya kreatif', 'tall' => false, 'image' => 'images/dkv/patung.jpeg'],
                ['icon' => 'fa-building', 'badge' => 'Industri', 'title' => 'Kunjungan Industri Kreatif', 'desc' => 'Belajar langsung dari agensi, studio, percetakan, dan industri kreatif', 'tall' => false, 'image' => 'images/dkv/ki-dkv.jpeg'],
                ['icon' => 'fa-object-group', 'badge' => 'Pameran', 'title' => 'Pameran Karya', 'desc' => 'Memamerkan karya unggulan di berbagai pameran dan ajang kreatif', 'tall' => false, 'image' => 'images/dkv/pameran-dkv.jpeg'],
                ['icon' => 'fa-briefcase', 'badge' => 'PKL', 'title' => 'PKL & Magang', 'desc' => 'Pengalaman kerja langsung di studio, agensi, percetakan, dan perusahaan kreatif', 'tall' => false, 'image' => 'images/dkv/pkl-dkv.jpeg'],
            ],

            'prospect_eyebrow' => 'Mau ke Mana ya?', 'prospect_h1' => 'SETELAH LULUS,', 'prospect_hgold' => 'MAU KEMANA?',
            'prospect_items' => [
                ['icon' => 'fa-briefcase', 'tone' => 'blue', 'title' => 'KERJA', 'desc' => 'Graphic Designer, Illustrator, Photographer, Videographer, Content Creator, UI Designer — siap berkarya di industri kreatif.', 'tags' => 'Agensi Kreatif, Studio Desain, Production House, Branding', 'image' => 'images/dkv/kerja-dkv.jpg'],
                ['icon' => 'fa-graduation-cap', 'tone' => '', 'title' => 'KULIAH', 'desc' => 'Desain Komunikasi Visual, Desain Grafis, Fotografi, Animasi, Multimedia, atau bidang kreatif terkait — bekal DKV jadi modal kuat di perguruan tinggi.', 'tags' => 'Desain Grafis, Fotografi, Multimedia', 'image' => 'images/dkv/kuliah.jpeg'],
                ['icon' => 'fa-rocket', 'tone' => 'green', 'title' => 'USAHA KREATIF', 'desc' => 'Jasa desain, studio kreatif, content production, branding, dan bisnis visual mandiri — bangun usaha kreatif dengan karya dan identitasmu.', 'tags' => 'Karya Kreatif, Studio Produksi, Bisnis', 'image' => 'images/dkv/usaha-dkv.jpg'],
            ],

            'lab_kicker' => 'Creative Studio Experience', 'lab_h1' => 'Jelajahi', 'lab_hgold' => 'Studio DKV', 'lab_sub' => 'Lihat Studio Tour DKV',
            'lab_desc' => 'Kenali lebih dekat studio DKV sebagai ruang belajar dan praktik untuk merancang karya visual, mengembangkan konsep, serta memproduksi media kreatif.',
            'lab_feats' => 'Fasilitas Studio, Desain Grafis, Presentasi Karya',
            'lab_btn' => 'Mulai Studio Tour', 'lab_watermark' => 'DKV',
            'lab_image' => 'tour/lab-dkv.jpg', 'lab_badge' => 'Studio Tour',
            'lab_caption_title' => 'Jelajahi Studio DKV', 'lab_caption_sub' => 'Fasilitas praktik Desain Komunikasi Visual',
            'lab_chip_title' => 'Studio Tour DKV', 'lab_chip_sub' => 'Explore DKV Creative Studio',

            'cta_h1' => 'Siap Menjadi Bagian dari', 'cta_hgold' => 'DKV?',
            'cta_desc' => 'Kenali potensimu, temukan pengalaman belajar yang sesuai, dan mulai perjalananmu bersama DKV — dari ide menuju karya dan masa depan kreatif.',
            'cta_btn_text' => 'Daftar PPDB', 'cta_watermark' => '#DKV',
            'cta_bg' => 'images/aphp-upacara.jpg',
        ];
    }
}
