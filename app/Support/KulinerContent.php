<?php

namespace App\Support;

use App\Models\Major;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Isi halaman publik jurusan KULINER (berdiri sendiri; salin & ganti nama untuk jurusan lain).
 *
 *  - sections()  : definisi section + field (dipakai admin untuk membuat form & validasi)
 *  - defaults()  : isi bawaan (isi asli halaman KULINER yang lama)
 *  - get()       : isi bawaan digabung dengan yang tersimpan di kolom majors.details
 *  - url()/rich()/icon()... : pembantu untuk Blade halaman publik
 *
 * Semua isi disimpan di kolom JSON `details` milik tabel majors, jadi TIDAK perlu migrasi baru.
 */
class KulinerContent
{
    public const CODE = 'KULINER';          // kode jurusan di tabel majors
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
                'desc'  => 'Bagian paling atas halaman: label, judul besar, dan tombol Kitchen Tour.',
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
                    'title'  => 'Tombol Kitchen Tour',
                    'fields' => [
                        self::f('tour_show', 'Tampilkan tombol Kitchen Tour di hero', 'check', ['default' => false]),
                        $T('tour_title', 'Teks tebal tombol', ['default' => 'Lihat Kitchen Tour']),
                        $T('tour_sub', 'Teks kecil tombol', ['default' => 'Jelajahi Dapur Praktik {name}']),
                        $T('tour_scene', 'ID scene Kitchen Tour', ['max' => 80,
                            'hint' => 'Contoh: lab-pastry (dipakai untuk ?scene=... di halaman Virtual Tour). Dipakai juga oleh section Kitchen Tour di bawah.']),
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
                        self::f('video_file', 'Video (MP4/WEBM)', 'video', ['hint' => 'Upload dari komputer, atau isi path file yang sudah ada di folder public (mis. images/videos/video-kuliner.mp4). Maks 50 MB.']),
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
                    'fields' => array_merge([self::show('tentang')], self::head('about', 'Apa Itu {code}?', 'DARI BAHAN', 'MENJADI HIDANGAN'), [
                        $T('about_h2', 'Lanjutan judul (biru tua, setelah emas)', ['default' => 'BERNILAI', 'max' => 60, 'hint' => 'Opsional. Hasil akhir judul: baris biru + emas + baris ini.']),
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
                    'fields' => array_merge([self::show('mitra')], self::head('partners', 'Kerja Sama & Industri Kreatif', 'BERKOLABORASI DENGAN', 'INDUSTRI KULINER'), [
                        $T('partners_footer', 'Teks di bawah marquee', ['default' => 'Belajar • Praktik • Berkolaborasi • Siap Berkarya']),
                    ]),
                ], [
                    'title' => 'Logo Mitra', 'repeater' => 'partners', 'item' => 'Mitra', 'max' => 40,
                    'fields' => [
                        $T('name', 'Nama mitra', ['required' => true, 'max' => 80]),
                        $I('image', 'Logo', ['hint' => 'Upload atau isi path (mis. images/kuliner/logo.png).']),
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
                        self::f('icon', 'Ikon lencana', 'icon', ['default' => 'fa-fire-burner', 'max' => 60]),
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
                'desc'  => 'Kartu fasilitas & dapur praktik.',
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
                        $T('category', 'Kategori', ['default' => 'Karya', 'max' => 30, 'hint' => 'Mis. Masakan Utama, Food Photography, Pastry & Bakery. Jadi tombol filter.']),
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
                    'fields' => array_merge([self::show('prospek')], self::head('prospect', 'Mau Jadi Apa?', 'SETELAH LULUS,', 'MAU JADI APA?')),
                ], [
                    'title' => 'Kartu Prospek', 'repeater' => 'prospect_items', 'item' => 'Prospek', 'max' => 6,
                    'fields' => array_merge(self::iconTone(), [
                        $T('title', 'Judul', ['required' => true, 'max' => 40]),
                        $A('desc', 'Deskripsi', ['max' => 300]),
                        $T('tags', 'Tag (pisahkan dengan koma)', ['max' => 160, 'hint' => 'Contoh: Hotel, Restoran, Katering']),
                        $I('image', 'Foto'),
                    ]),
                    'default' => [],
                ]],
            ],

            /* ---------------- LAB TOUR ---------------- */
            'lab' => [
                'label' => 'Kitchen Tour', 'icon' => 'fa-compass', 'anchor' => 'lab-tour',
                'desc'  => 'Banner ajakan menuju Virtual/Kitchen Tour. Butuh "ID scene Kitchen Tour" di tab Hero.',
                'blocks' => [[
                    'title'  => 'Konten Kitchen Tour',
                    'fields' => [
                        self::show('lab'),
                        $T('lab_kicker', 'Label kecil', ['default' => 'Creative Studio Experience']),
                        $T('lab_h1', 'Judul (biru tua)', ['default' => 'Jelajahi', 'required' => true, 'max' => 40]),
                        $T('lab_hgold', 'Lanjutan judul (emas)', ['default' => 'Dapur Praktik {name}', 'max' => 40]),
                        $T('lab_sub', 'Sub-judul kecil', ['default' => 'Lihat Kitchen Tour {code}']),
                        $A('lab_desc', 'Deskripsi', ['max' => 500]),
                        $T('lab_feats', 'Tiga label fitur (pisahkan dengan koma)', ['default' => 'Fasilitas Dapur, Pengolahan Makanan, Presentasi Karya', 'max' => 200]),
                        $T('lab_btn', 'Teks tombol', ['default' => 'Mulai Kitchen Tour', 'max' => 40]),
                        $T('lab_watermark', 'Tulisan besar transparan', ['default' => 'KULINER', 'max' => 12]),
                        self::f('lab_image', 'Foto banner', 'image', ['hint' => 'Mis. tour/lab-pastry.jpg atau upload.']),
                        $T('lab_badge', 'Lencana pada foto', ['default' => 'Kitchen Tour', 'max' => 30]),
                        $T('lab_caption_title', 'Judul di atas foto', ['default' => 'Jelajahi Dapur Praktik {name}']),
                        $T('lab_caption_sub', 'Keterangan di atas foto', ['max' => 120]),
                        $T('lab_chip_title', 'Judul chip kecil', ['default' => 'Kitchen Tour {code}', 'max' => 40]),
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

        if (true) { // kelas ini khusus KULINER
            $out = array_replace($out, self::kuliner());
        }

        return self::tok($out, $m);
    }

    /** Isi bawaan + data tersimpan. Kunci yang pernah disimpan admin selalu menang (termasuk kosong). */
    /** Baris jurusan KULINER di tabel majors (tempat isi halaman disimpan di kolom details). */
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
     |  Isi asli halaman KULINER (disalin dari halaman publik KULINER)
     * ------------------------------------------------------------------ */

    private static function kuliner(): array
    {
        $p = fn (string $icon, string $tone, string $title, string $desc) => compact('icon', 'tone', 'title', 'desc');

        return [
            'hero_kicker' => 'PROGRAM KEAHLIAN KULINER', 'hero_icon' => 'fa-utensils',
            'hero_title_1' => 'KULINER', 'hero_title_2' => 'SKANEDA', 'hero_watermark' => 'KULINER',
            'tour_show' => true, 'tour_title' => 'Lihat Kitchen Tour', 'tour_sub' => 'Jelajahi Dapur Praktik Kuliner', 'tour_scene' => 'lab-pastry',

            'video_title_1' => 'MENGENAL LEBIH DEKAT', 'video_title_gold' => 'KULINER',
            'video_file' => 'images/videos/video-kuliner.mp4',
            'video_desc' => 'Kenali Program Keahlian Kuliner, mulai dari pembelajaran, kegiatan praktik, fasilitas, hingga berbagai pengalaman yang akan kamu dapatkan selama belajar di KULINER.',
            'video_side' => 'KULINER • SKANEDA',
            'video_cards' => [
                $p('fa-utensils', 'green', 'Ide & Konsep', 'Mengembangkan ide dan konsep hidangan'),
                $p('fa-fire-burner', '', 'Pengolahan Makanan', 'Mempelajari teknik memasak dan mengolah bahan pangan'),
                $p('fa-plate-wheat', 'gold', 'Hidangan Siap Saji', 'Menghasilkan hidangan yang lezat dan menarik'),
            ],

            'about_eyebrow' => 'Apa Itu KULINER?', 'about_h1' => 'DARI BAHAN', 'about_hgold' => 'MENJADI HIDANGAN', 'about_h2' => 'BERNILAI',
            'about_lead' => 'Program Keahlian **Kuliner** membekali peserta didik dengan keterampilan mengolah bahan pangan menjadi hidangan bernilai melalui teknik memasak, pastry dan bakery, food styling, sanitasi pangan, dan kewirausahaan kuliner.',
            'about_sub' => 'Pembelajaran mencakup pengolahan makanan Indonesia dan kontinental, pastry dan bakery, food styling dan plating, sanitasi dan higiene, food & beverage service, serta manajemen usaha kuliner. Melalui praktik dapur dan proyek nyata, siswa belajar menghasilkan hidangan berkualitas sekaligus mengembangkan jiwa kewirausahaan.',
            'about_minis' => [
                ['icon' => 'fa-utensils', 'tone' => '', 'text' => 'Pengolahan Makanan — Mengenal bahan & teknik masak'],
                ['icon' => 'fa-cookie-bite', 'tone' => 'green', 'text' => 'Pastry & Bakery — Membuat kue dan roti berkualitas'],
                ['icon' => 'fa-camera', 'tone' => 'gold', 'text' => 'Food Styling — Menyajikan hidangan yang menggugah selera'],
                ['icon' => 'fa-lightbulb', 'tone' => '', 'text' => 'Kewirausahaan — Membangun usaha kuliner yang kuat'],
            ],
            'flow_label' => 'Alur KULINER', 'flow_core_icon' => 'fa-utensils', 'flow_core_title' => 'KULINER', 'flow_core_sub' => 'Idea to Future',
            'flow_bottom' => 'OLAH • RASA • KREATIF',
            'flow_steps' => [
                $p('fa-utensils', '', 'Ide & Konsep', 'Mengenal bahan baku pangan'),
                $p('fa-fire-burner', 'green', 'Olah & Masak', 'Proses menjadi hidangan'),
                $p('fa-magnifying-glass', 'blue', 'Uji Mutu', 'Kualitas & keamanan pangan'),
                $p('fa-plate-wheat', 'gold', 'Hidangan Jadi', 'Siap disajikan'),
            ],

            'partners_eyebrow' => 'Kerja Sama & Industri Kreatif',
            'partners_h1' => 'BERKOLABORASI DENGAN', 'partners_hgold' => 'INDUSTRI KULINER',
            'partners_footer' => 'Belajar • Praktik • Berkolaborasi • Siap Berkarya',
            'partners' => array_map(
                fn ($r) => ['name' => $r[0], 'image' => 'images/kuliner/' . $r[1] . '.png'],
                [
                    ['Aston Hotel', 'aston'], ['Manov Kopi', 'manovkopi'], ['Movenpick Surabaya City', 'movenpick'],
                    ['Sitarasa', 'sitarasa'], ['Sunrise Hotel', 'sunrisehotel'], ['The Southern Hotel', 'the-southern'],
                    ['Vasa Hotel Surabaya', 'vasa-hotel'], ['Aysha', 'aysha'], ['Deavy Hantaran', 'deavy-hantaran'],
                    ['Fave Hotel', 'favehotel'], ['Fullspace', 'fullspace'], ['Lynn Hotel Tuban', 'lynn-tuban'],
                    ['Proof.co', 'proofco'],
                ]
            ),

            'learn_eyebrow' => 'APA YANG KAMU PELAJARI?', 'learn_h1' => 'APA YANG AKAN', 'learn_hgold' => 'KAMU PELAJARI?',
            'learn_items' => [
                $p('fa-utensils', '', 'Pengolahan Makanan', 'Mempelajari teknik dasar memasak, mengolah bahan pangan, dan menyajikan makanan Indonesia maupun internasional.'),
                $p('fa-cookie-bite', 'green', 'Pastry & Bakery', 'Membuat kue, roti, dan produk pastry dengan teknik, resep, dan takaran yang tepat.'),
                $p('fa-magnifying-glass', 'blue', 'Sanitasi & Keamanan Pangan', 'Mempelajari standar kebersihan, keamanan pangan, dan kontrol kualitas hidangan sesuai standar industri.'),
                $p('fa-camera', 'gold', 'Food Styling & Presentasi', 'Menata dan menyajikan hidangan agar tampil menarik untuk dokumentasi, promosi, dan konten digital.'),
                $p('fa-plate-wheat', '', 'Food & Beverage Service', 'Mempelajari tata cara pelayanan makanan dan minuman sesuai standar industri perhotelan dan restoran.'),
                $p('fa-lightbulb', 'gold', 'Kewirausahaan Kuliner', 'Mengembangkan jiwa usaha: menghitung kelayakan, memasarkan, dan membangun bisnis kuliner mandiri.'),
            ],

            'practice_eyebrow' => 'BELAJAR LEWAT PROYEK KREATIF', 'practice_h1' => 'BELAJAR BUKAN', 'practice_hgold' => 'HANYA DI KELAS',
            'practice_items' => [
                ['icon' => 'fa-fire-burner', 'badge' => 'Praktik', 'title' => 'Praktik Dapur', 'desc' => 'Mengerjakan proyek memasak dan pengolahan makanan di dapur praktik KULINER yang mendukung proses belajar.', 'image' => 'images/kuliner/kuliner-dapur.jpeg'],
                ['icon' => 'fa-utensils', 'badge' => 'Produksi', 'title' => 'Dapur Produksi', 'desc' => 'Menghasilkan karya nyata seperti masakan utama, pastry dan bakery, plating kreatif, dan minuman inovatif.', 'image' => 'images/kuliner/dapur-produksi.png'],
                ['icon' => 'fa-circle-check', 'badge' => 'Evaluasi', 'title' => 'Presentasi & Evaluasi Karya', 'desc' => 'Mempresentasikan, mengevaluasi, dan mengembangkan hidangan berdasarkan rasa, penyajian, kebersihan, dan kepuasan konsumen.', 'image' => 'images/kuliner/kuliner-praktik.jpg'],
            ],

            'facility_eyebrow' => 'Bebas Bereksperimen', 'facility_h1' => 'RUANG UNTUK', 'facility_hgold' => 'BEREKSPERIMEN',
            'facility_items' => [
                $p('fa-fire-burner', '', 'Dapur Praktik Kuliner', 'Dapur praktik lengkap dengan peralatan modern untuk praktik memasak dan mengolah makanan.'),
                $p('fa-tools', 'green', 'Peralatan Masak', 'Kompor, oven, mixer, dan peralatan masak yang lengkap, memadai, dan terawat.'),
                $p('fa-camera', 'gold', 'Ruang LKS', 'Ruang khusus untuk mendukung kegiatan latihan dan persiapan Lomba Kompetensi Siswa.'),
                $p('fa-plate-wheat', '', 'Area Pastry & Bakery', 'Area khusus untuk membuat kue, roti, dan produk pastry dengan standar mutu dan kebersihan.'),
                $p('fa-snowflake', 'green', 'Ruang Penyimpanan Dingin', 'Fasilitas penyimpanan bahan baku dan produk jadi yang terjaga kualitas dan kesegarannya.'),
                $p('fa-laptop', 'gold', 'Fasilitas Pendukung', 'Ruang kelas, akses internet, referensi resep, dan perangkat digital untuk menunjang pembelajaran.'),
            ],

            'product_eyebrow' => 'Karya Siswa', 'product_h1' => 'DARI IDE', 'product_hgold' => 'MENJADI KARYA',
            'product_note' => 'Kumpulan karya siswa KULINER — diolah melalui proses kreatif, uji rasa, presentasi, dan produksi hidangan nyata.',
            'product_items' => [
                ['title' => 'BeiMie', 'category' => 'Masakan Utama', 'desc' => 'Mie unik berbahan dasar daun murbei yang alami dan kaya manfaat, perpaduan cita rasa lezat dengan pilihan yang lebih sehat.', 'foot' => 'Studio Produksi', 'image' => 'images/kuliner/beimie.jpeg'],
                ['title' => 'Fotografi Produk', 'category' => 'Food Photography', 'desc' => 'Eksplorasi komposisi, pencahayaan, dan sudut pengambilan untuk menghasilkan visual hidangan yang menggugah selera.', 'foot' => 'Studio Produksi', 'image' => 'images/kuliner/rotitawar-kuliner.jpeg'],
                ['title' => 'Kreasi Kue & Roti', 'category' => 'Pastry & Bakery', 'desc' => 'Pembuatan aneka kue dan roti dengan teknik dan resep pastry yang tepat, tampil cantik dan lezat.', 'foot' => 'Studio Produksi', 'image' => 'images/kuliner/pastry-kuliner.jpeg'],
            ],

            'activity_eyebrow' => 'BERKARYA & BERPRESTASI', 'activity_h1' => 'AKTIF BERKARYA,', 'activity_hgold' => 'BERANI BERPRESTASI',
            'activity_items' => [
                ['icon' => 'fa-trophy', 'badge' => 'Prestasi', 'title' => 'Prestasi Siswa KULINER', 'desc' => 'Prestasi lomba kuliner, pengolahan makanan, pastry dan bakery, dan food styling tingkat kota hingga nasional', 'tall' => true, 'image' => 'images/kuliner/lkslampung.jpg'],
                ['icon' => 'fa-cookie-bite', 'badge' => 'Praktik', 'title' => 'Produksi Kreatif', 'desc' => 'Kegiatan praktik rutin di dapur KULINER untuk menghasilkan karya kreatif', 'tall' => false, 'image' => 'images/kuliner/kuliner-dapur.jpeg'],
                ['icon' => 'fa-building', 'badge' => 'Industri', 'title' => 'Kunjungan Industri Kuliner', 'desc' => 'Belajar langsung dari restoran, hotel, katering, dan industri kuliner', 'tall' => false, 'image' => 'images/kuliner/ki-kuliner.jpeg'],
                ['icon' => 'fa-plate-wheat', 'badge' => 'Pameran', 'title' => 'Pameran Karya', 'desc' => 'Memamerkan karya unggulan di berbagai pameran dan ajang kreatif', 'tall' => false, 'image' => 'images/kuliner/pameran-kuliner.png'],
                ['icon' => 'fa-briefcase', 'badge' => 'PKL', 'title' => 'PKL & Magang di Industri F&B', 'desc' => 'Pengalaman kerja langsung di hotel, restoran, katering, dan perusahaan F&B', 'tall' => false, 'image' => 'images/kuliner/pkl.png'],
            ],

            'prospect_eyebrow' => 'Mau Jadi Apa?', 'prospect_h1' => 'SETELAH LULUS,', 'prospect_hgold' => 'MAU JADI APA?',
            'prospect_items' => [
                ['icon' => 'fa-briefcase', 'tone' => 'blue', 'title' => 'KERJA', 'desc' => 'Chef, Pastry Chef, Food Stylist, Cook, Entrepreneur Kuliner, Food & Beverage Professional — siap berkarya di industri kuliner.', 'tags' => 'Hotel, Restoran, Katering, Cafe', 'image' => 'images/kuliner/kerja-kuliner.jpg'],
                ['icon' => 'fa-graduation-cap', 'tone' => '', 'title' => 'KULIAH', 'desc' => 'Tata Boga, Pariwisata, Perhotelan, Gizi & Kesehatan, Bisnis Kuliner, atau bidang terkait — bekal KULINER jadi modal kuat di perguruan tinggi.', 'tags' => 'Tata Boga, Perhotelan, Gizi & Kesehatan', 'image' => 'images/kuliner/kuliah.jpeg'],
                ['icon' => 'fa-briefcase', 'tone' => 'green', 'title' => 'USAHA KREATIF', 'desc' => 'Katering, restoran, cafe, bisnis kue dan roti, serta usaha kuliner mandiri — bangun usaha dengan karya dan cita rasa khasmu.', 'tags' => 'Katering, Usaha Kuliner, Bisnis Pastry', 'image' => 'images/kuliner/usaha-kuliner.jpg'],
            ],

            'lab_kicker' => 'Creative Studio Experience', 'lab_h1' => 'Jelajahi', 'lab_hgold' => 'Dapur Praktik Kuliner', 'lab_sub' => 'Lihat Kitchen Tour KULINER',
            'lab_desc' => 'Kenali lebih dekat dapur praktik KULINER sebagai ruang belajar dan praktik untuk mengolah bahan pangan, mengembangkan konsep hidangan, serta memproduksi karya dan membangun kewirausahaan kuliner.',
            'lab_feats' => 'Fasilitas Dapur, Pengolahan Makanan, Presentasi Karya',
            'lab_btn' => 'Mulai Kitchen Tour', 'lab_watermark' => 'KULINER',
            'lab_image' => 'tour/lab-pastry.jpg', 'lab_badge' => 'Kitchen Tour',
            'lab_caption_title' => 'Jelajahi Dapur Praktik Kuliner', 'lab_caption_sub' => 'Fasilitas praktik Kuliner',
            'lab_chip_title' => 'Kitchen Tour KULINER', 'lab_chip_sub' => 'Explore KULINER Creative Studio',

            'cta_h1' => 'Siap Menjadi Bagian dari', 'cta_hgold' => 'KULINER?',
            'cta_desc' => 'Kenali potensimu, temukan pengalaman belajar yang sesuai, dan mulai perjalananmu bersama KULINER — dari ide menuju karya dan masa depan kreatif.',
            'cta_btn_text' => 'Daftar PPDB', 'cta_watermark' => '#KULINER',
            'cta_bg' => 'images/aphp-upacara.jpg',
        ];
    }
}
