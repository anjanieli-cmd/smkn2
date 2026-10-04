<?php

namespace App\Support;

use App\Models\Major;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Isi halaman publik jurusan LPS (Layanan Perbankan Syariah) (berdiri sendiri; salin & ganti nama untuk jurusan lain).
 *
 *  - sections()  : definisi section + field (dipakai admin untuk membuat form & validasi)
 *  - defaults()  : isi bawaan (LPS punya isi asli dari halaman lama, jurusan lain teks generik)
 *  - get()       : isi bawaan digabung dengan yang tersimpan di kolom majors.details
 *  - url()/rich()/icon()... : pembantu untuk Blade halaman publik
 *
 * Semua isi disimpan di kolom JSON `details` milik tabel majors, jadi TIDAK perlu migrasi baru.
 */
class LpsContent
{
    public const CODE = 'LPS';          // kode jurusan di tabel majors
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
                'desc'  => 'Bagian paling atas halaman: label, judul besar, dan tombol LPS Tour.',
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
                    'title'  => 'Tombol LPS Tour',
                    'fields' => [
                        self::f('tour_show', 'Tampilkan tombol LPS Tour di hero', 'check', ['default' => false]),
                        self::f('tour_icon', 'Ikon tombol & lencana tour', 'icon', ['default' => 'fa-handshake', 'max' => 60]),
                        $T('tour_title', 'Teks tebal tombol', ['default' => 'Lihat LPS Tour']),
                        $T('tour_sub', 'Teks kecil tombol', ['default' => 'Jelajahi Ruang Praktik Bank Mini Syariah']),
                        $T('tour_scene', 'ID scene LPS Tour', ['max' => 80,
                            'hint' => 'Contoh: lab-lps (dipakai untuk ?scene=... di halaman Virtual Tour). Dipakai juga oleh section LPS Tour di bawah.']),
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
                        $A('video_desc', 'Deskripsi', ['default' => 'Kenali Program Keahlian {name}, mulai dari pembelajaran, praktik perbankan, fasilitas bank mini, hingga pengalaman yang akan kamu dapatkan.', 'max' => 600]),
                        self::f('video_file', 'Video (MP4/WEBM)', 'video', ['hint' => 'Upload dari komputer, atau isi path file yang sudah ada di folder public (mis. images/videos/video-lps.mp4). Maks 50 MB.']),
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
                'desc'  => 'Penjelasan program keahlian, 4 poin ringkas, dan panel alur di sebelah kanan.',
                'blocks' => [[
                    'title'  => 'Teks Utama',
                    'fields' => array_merge([self::show('tentang')], self::head('about', 'Apa Itu {code}?', 'MELAYANI DENGAN', 'PRINSIP SYARIAH'), [
                        $T('about_h2', 'Lanjutan judul (biru tua, setelah emas)', ['default' => '', 'max' => 60, 'hint' => 'Opsional. Hasil akhir judul: baris biru + emas + baris ini.']),
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
                    'fields' => array_merge([self::show('mitra')], self::head('partners', 'Kerja Sama & Industri Perbankan', 'BERKOLABORASI DENGAN', 'INDUSTRI PERBANKAN SYARIAH'), [
                        $T('partners_footer', 'Teks di bawah marquee', ['default' => 'Belajar • Praktik • Berkolaborasi • Siap Bekerja']),
                    ]),
                ], [
                    'title' => 'Logo Mitra', 'repeater' => 'partners', 'item' => 'Mitra', 'max' => 40,
                    'fields' => [
                        $T('name', 'Nama mitra', ['required' => true, 'max' => 80]),
                        $I('image', 'Logo', ['hint' => 'Upload atau isi path (mis. images/lps/logo.png).']),
                    ],
                    'default' => [],
                ]],
            ],

            /* ---------------- PEMBELAJARAN ---------------- */
            'belajar' => [
                'label' => 'Pembelajaran', 'icon' => 'fa-book-open', 'anchor' => 'pembelajaran',
                'desc'  => 'Kartu "Apa yang akan kamu pelajari" (disarankan 6, kelipatan 3 supaya rapi). Tulisan "Pelajari" di tiap kartu otomatis.',
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
                    'fields' => array_merge([self::show('praktik')], self::head('practice', 'BELAJAR LEWAT SIMULASI PERBANKAN', 'BELAJAR BUKAN', 'HANYA DI KELAS')),
                ], [
                    'title' => 'Kartu Praktik', 'repeater' => 'practice_items', 'item' => 'Kartu', 'max' => 9,
                    'fields' => [
                        self::f('icon', 'Ikon lencana', 'icon', ['default' => 'fa-handshake', 'max' => 60]),
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
                'desc'  => 'Kartu fasilitas & ruang praktik (bank mini, laboratorium, koperasi).',
                'blocks' => [[
                    'title'  => 'Judul',
                    'fields' => array_merge([self::show('fasilitas')], self::head('facility', 'Praktik Nyata Perbankan', 'RUANG UNTUK', 'PRAKTIK PERBANKAN')),
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
                'label' => 'Dokumentasi', 'icon' => 'fa-camera-retro', 'anchor' => 'produk',
                'desc'  => 'Slider dokumentasi praktik siswa. Tombol filter (opsional) dibuat otomatis dari kategori yang kamu isi.',
                'blocks' => [[
                    'title'  => 'Judul',
                    'fields' => array_merge([self::show('produk')], self::head('product', 'Dokumentasi Praktik Siswa', 'KOMPETENSI', 'DALAM AKSI'), [
                        $A('product_note', 'Catatan di kanan judul', ['max' => 300]),
                        self::f('product_filter', 'Tampilkan tombol filter kategori', 'check', ['default' => false, 'hint' => 'Hanya muncul kalau ada lebih dari satu kategori.']),
                    ]),
                ], [
                    'title' => 'Daftar Dokumentasi', 'repeater' => 'product_items', 'item' => 'Dokumentasi', 'max' => 30,
                    'fields' => [
                        $T('title', 'Judul dokumentasi', ['required' => true, 'max' => 80]),
                        $T('category', 'Kategori (lencana di foto)', ['default' => 'Praktik', 'max' => 30, 'hint' => 'Mis. Teller, Pelayanan, Duta. Jadi lencana di foto dan tombol filter.']),
                        $A('desc', 'Deskripsi', ['max' => 300]),
                        $T('foot', 'Teks kecil di dasar kartu', ['default' => 'Bank Mini', 'max' => 40]),
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
                    'fields' => array_merge([self::show('kegiatan')], self::head('activity', 'BERKARYA & BERPRESTASI', 'AKTIF BERLATIH,', 'BERANI BERPRESTASI')),
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
                    'fields' => array_merge([self::show('prospek')], self::head('prospect', 'Mau Berkontribusi di Mana?', 'SETELAH LULUS,', 'MAU BERKONTRIBUSI DI MANA?')),
                ], [
                    'title' => 'Kartu Prospek', 'repeater' => 'prospect_items', 'item' => 'Prospek', 'max' => 6,
                    'fields' => array_merge(self::iconTone(), [
                        $T('title', 'Judul', ['required' => true, 'max' => 40]),
                        $A('desc', 'Deskripsi', ['max' => 300]),
                        $T('tags', 'Tag (pisahkan dengan koma)', ['max' => 160, 'hint' => 'Contoh: Bank Syariah, BPRS, BMT']),
                        $I('image', 'Foto'),
                    ]),
                    'default' => [],
                ]],
            ],

            /* ---------------- LAB TOUR ---------------- */
            'lab' => [
                'label' => 'LPS Tour', 'icon' => 'fa-compass', 'anchor' => 'lab-tour',
                'desc'  => 'Banner ajakan menuju Virtual Tour bank mini. Butuh "ID scene LPS Tour" dan tombol tour aktif di tab Hero.',
                'blocks' => [[
                    'title'  => 'Konten LPS Tour',
                    'fields' => [
                        self::show('lab'),
                        $T('lab_kicker', 'Label kecil', ['default' => 'Sharia Banking Practice Experience']),
                        $T('lab_h1', 'Judul (biru tua)', ['default' => 'Jelajahi', 'required' => true, 'max' => 40]),
                        $T('lab_hgold', 'Lanjutan judul (emas)', ['default' => 'Ruang Praktik Bank Mini Syariah', 'max' => 60]),
                        $T('lab_sub', 'Sub-judul kecil', ['default' => 'Lihat LPS Tour {code}']),
                        $A('lab_desc', 'Deskripsi', ['max' => 500]),
                        $T('lab_feats', 'Tiga label fitur (pisahkan dengan koma)', ['default' => 'Fasilitas Bank Mini, Simulasi Teller & CS, Praktik Administrasi', 'max' => 200]),
                        $T('lab_btn', 'Teks tombol', ['default' => 'Mulai LPS Tour', 'max' => 40]),
                        $T('lab_watermark', 'Tulisan besar transparan', ['default' => 'LPS', 'max' => 12]),
                        self::f('lab_image', 'Foto banner', 'image', ['hint' => 'Mis. tour/lab-lps.jpg atau upload.']),
                        $T('lab_badge', 'Lencana pada foto', ['default' => 'LPS Tour', 'max' => 30]),
                        $T('lab_caption_title', 'Judul di atas foto', ['default' => 'Jelajahi Ruang Praktik Bank Mini Syariah']),
                        $T('lab_caption_sub', 'Keterangan di atas foto', ['max' => 120]),
                        $T('lab_chip_title', 'Judul chip kecil', ['default' => 'LPS Tour {code}', 'max' => 40]),
                        $T('lab_chip_sub', 'Keterangan chip kecil', ['default' => 'Explore Bank Mini Syariah', 'max' => 60]),
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

        if (true) { // kelas ini khusus LPS
            $out = array_replace($out, self::lps());
        }

        return self::tok($out, $m);
    }

    /** Isi bawaan + data tersimpan. Kunci yang pernah disimpan admin selalu menang (termasuk kosong). */
    /** Baris jurusan LPS di tabel majors (tempat isi halaman disimpan di kolom details). */
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
     |  Isi asli halaman LPS (disalin dari halaman publik LPS yang lama)
     * ------------------------------------------------------------------ */

    private static function lps(): array
    {
        $p = fn (string $icon, string $tone, string $title, string $desc) => compact('icon', 'tone', 'title', 'desc');

        return [
            'hero_kicker' => 'PROGRAM KEAHLIAN LPS', 'hero_icon' => 'fa-building-columns',
            'hero_title_1' => 'LPS', 'hero_title_2' => 'SKANEDA', 'hero_watermark' => 'LPS',
            'tour_show' => true, 'tour_icon' => 'fa-handshake', 'tour_title' => 'Lihat LPS Tour',
            'tour_sub' => 'Jelajahi Ruang Praktik Bank Mini Syariah', 'tour_scene' => 'lab-lps',

            'video_file' => 'images/videos/video-lps.mp4',
            'video_title_1' => 'MENGENAL LEBIH DEKAT', 'video_title_gold' => 'LPS',
            'video_desc' => 'Kenali Program Keahlian Layanan Perbankan Syariah (LPS), mulai dari pembelajaran, praktik perbankan, fasilitas bank mini, hingga berbagai pengalaman yang akan kamu dapatkan selama belajar di LPS.',
            'video_side' => 'LPS • SKANEDA',
            'video_cards' => [
                $p('fa-piggy-bank', 'green', 'Dasar Perbankan Syariah', 'Memahami prinsip dan akad dalam perbankan syariah'),
                $p('fa-handshake', '', 'Produk & Layanan Syariah', 'Mempelajari tabungan, deposito, dan pembiayaan syariah'),
                $p('fa-headset', 'gold', 'Layanan Nasabah', 'Melatih keterampilan sebagai teller dan customer service'),
            ],

            'about_eyebrow' => 'Apa Itu LPS?', 'about_h1' => 'MELAYANI DENGAN', 'about_hgold' => 'PRINSIP SYARIAH', 'about_h2' => '',
            'about_lead' => 'Program Keahlian **Layanan Perbankan Syariah (LPS)** membekali peserta didik dengan keterampilan mengelola transaksi, melayani nasabah, dan menjalankan operasional perbankan berdasarkan prinsip syariah — mulai dari teller, customer service, hingga administrasi back office.',
            'about_sub' => 'Pembelajaran mencakup dasar-dasar perbankan syariah, akad-akad muamalah, produk simpanan dan pembiayaan syariah, administrasi transaksi, aplikasi core banking, hingga praktik langsung di bank mini syariah. Melalui simulasi dan praktik kerja, siswa belajar melayani nasabah secara profesional sekaligus memahami prinsip kejujuran dan keadilan dalam ekonomi syariah.',
            'about_minis' => [
                ['icon' => 'fa-piggy-bank', 'tone' => '', 'text' => 'Produk Simpanan Syariah — Tabungan, giro, dan deposito syariah'],
                ['icon' => 'fa-handshake', 'tone' => 'green', 'text' => 'Akad & Pembiayaan — Murabahah, mudharabah, dan musyarakah'],
                ['icon' => 'fa-headset', 'tone' => 'gold', 'text' => 'Layanan Nasabah — Melayani transaksi sebagai teller & customer service'],
                ['icon' => 'fa-scale-balanced', 'tone' => '', 'text' => 'Kepatuhan Syariah — Menjunjung prinsip kejujuran dan keadilan'],
            ],
            'flow_label' => 'Alur LPS', 'flow_core_icon' => 'fa-building-columns', 'flow_core_title' => 'LPS', 'flow_core_sub' => 'Belajar hingga Bekerja',
            'flow_bottom' => 'TELLER • CUSTOMER SERVICE • SYARIAH',
            'flow_steps' => [
                $p('fa-piggy-bank', '', 'Produk Syariah', 'Mengenal produk simpanan'),
                $p('fa-handshake', 'green', 'Transaksi Nasabah', 'Praktik jadi teller & CS'),
                $p('fa-scale-balanced', 'blue', 'Uji Kepatuhan', 'Ketelitian & keakuratan'),
                $p('fa-user-tie', 'gold', 'Siap Bekerja', 'Siap terjun industri'),
            ],

            'partners_eyebrow' => 'Kerja Sama & Industri Perbankan',
            'partners_h1' => 'BERKOLABORASI DENGAN', 'partners_hgold' => 'INDUSTRI PERBANKAN SYARIAH',
            'partners_footer' => 'Belajar • Praktik • Berkolaborasi • Siap Bekerja',
            'partners' => array_map(
                fn ($r) => ['name' => $r[0], 'image' => 'images/lps/' . $r[1] . '.png'],
                [
                    ['Bank Muamalat Indonesia', 'bankmuamalat'], ['Lynn Hotel Mojokerto', 'lynn'], ['Bank Mandiri Taspen', 'mandiritaspen'],
                    ['BMT Permata', 'bmt'], ['Sunrise Hotel', 'sunrisehotel'], ['Wahyu Redjo', 'wahyuredjo'],
                    ['BKM', 'bkm'], ['BTPN', 'btpn'], ['Tiga Permata', 'tiga-permata'],
                ]
            ),

            'learn_eyebrow' => 'APA YANG KAMU PELAJARI?', 'learn_h1' => 'APA YANG AKAN', 'learn_hgold' => 'KAMU PELAJARI?',
            'learn_items' => [
                $p('fa-piggy-bank', '', 'Produk & Layanan Syariah', 'Mempelajari produk tabungan, giro, deposito, serta layanan simpanan berbasis prinsip syariah.'),
                $p('fa-handshake', 'green', 'Akad Muamalah', 'Memahami akad murabahah, mudharabah, musyarakah, ijarah, dan penerapannya dalam pembiayaan.'),
                $p('fa-magnifying-glass', 'blue', 'Administrasi & Kepatuhan', 'Mempelajari proses verifikasi dokumen, ketelitian transaksi, dan kepatuhan terhadap prinsip syariah.'),
                $p('fa-headset', 'gold', 'Layanan Nasabah (Customer Service)', 'Melatih komunikasi, keramahan, dan penyelesaian keluhan nasabah secara profesional.'),
                $p('fa-calculator', '', 'Operasional Teller', 'Praktik menghitung, menerima, dan mengeluarkan uang tunai sesuai prosedur perbankan.'),
                $p('fa-lightbulb', 'gold', 'Kewirausahaan Syariah', 'Mengembangkan jiwa usaha berbasis ekonomi syariah: menghitung kelayakan, memasarkan, dan membangun bisnis mandiri.'),
            ],

            'practice_eyebrow' => 'BELAJAR LEWAT SIMULASI PERBANKAN', 'practice_h1' => 'BELAJAR BUKAN', 'practice_hgold' => 'HANYA DI KELAS',
            'practice_items' => [
                ['icon' => 'fa-handshake', 'badge' => 'Praktik', 'title' => 'Praktik Koperasi', 'desc' => 'Mengerjakan simulasi transaksi di koperasi dewantara yang mendukung praktik langsung.', 'image' => 'images/lps/praktik-koperasi.png'],
                ['icon' => 'fa-calculator', 'badge' => 'Transaksi', 'title' => 'Pengelolaan Keuangan', 'desc' => 'Siswa LPS mempelajari pengelolaan keuangan tentunya juga memperoleh pendidikan moral yang berakhlak mulia.', 'image' => 'images/lps/pengelolaan-keuangan.png'],
                ['icon' => 'fa-circle-check', 'badge' => 'Evaluasi', 'title' => 'Evaluasi & Penilaian Praktik', 'desc' => 'Mengevaluasi ketepatan, ketelitian, dan pelayanan berdasarkan standar operasional perbankan syariah.', 'image' => 'images/lps/ukk-lps.jpeg'],
            ],

            'facility_eyebrow' => 'Praktik Nyata Perbankan', 'facility_h1' => 'RUANG UNTUK', 'facility_hgold' => 'PRAKTIK PERBANKAN',
            'facility_items' => [
                $p('fa-building-columns', '', 'Bank Mini Syariah', 'Ruang praktik lengkap dengan loket teller dan customer service layaknya bank sungguhan.'),
                $p('fa-diagram-project', 'green', 'Laboratorium LPS', 'Perangkat komputer dan aplikasi simulasi perbankan untuk praktik transaksi digital.'),
                $p('fa-building-columns', 'gold', 'Koperasi Dewantara', 'Praktik keterampilan siswa LPS dalam pengelolaan, pelayanan, dan transaksi koperasi secara langsung.'),
            ],

            'product_eyebrow' => 'Dokumentasi Praktik Siswa', 'product_h1' => 'KOMPETENSI', 'product_hgold' => 'DALAM AKSI',
            'product_note' => 'Dokumentasi praktik siswa LPS — dirancang melalui simulasi transaksi, pelayanan nasabah, dan praktik administrasi perbankan.',
            'product_filter' => false,
            'product_items' => [
                ['title' => 'Praktik Teller', 'category' => 'Teller', 'desc' => 'Simulasi menerima setoran, penarikan tunai, dan transfer sesuai prosedur bank syariah.', 'foot' => 'Bank Mini', 'image' => 'images/lps/pengelolaan-keuangan.png'],
                ['title' => 'Praktik Pelayanan Koperasi', 'category' => 'Pelayanan', 'desc' => 'Melatih siswa dalam memberikan pelayanan, mengelola transaksi, dan menjalankan kegiatan koperasi secara langsung.', 'foot' => 'Koperasi', 'image' => 'images/lps/praktik-koperasi.png'],
                ['title' => 'Duta Koperasi Jawa Timur', 'category' => 'Duta', 'desc' => 'Mengenalkan nilai, peran, dan manfaat koperasi serta mengajak generasi muda memahami & berpartisipasi dalam kegiatan koperasi.', 'foot' => 'Koperasi', 'image' => 'images/lps/vania-carla.jpeg'],
            ],

            'activity_eyebrow' => 'BERKARYA & BERPRESTASI', 'activity_h1' => 'AKTIF BERLATIH,', 'activity_hgold' => 'BERANI BERPRESTASI',
            'activity_items' => [
                ['icon' => 'fa-trophy', 'badge' => 'Prestasi', 'title' => 'Prestasi Siswa LPS', 'desc' => 'Prestasi lomba perbankan syariah, akuntansi, dan ekonomi syariah tingkat kota hingga nasional', 'tall' => true, 'image' => 'images/lps/dugen-icha.jpeg'],
                ['icon' => 'fa-handshake', 'badge' => 'Praktik', 'title' => 'Praktik Rutin', 'desc' => 'Kegiatan praktik rutin di bank mini syariah untuk melatih transaksi dan pelayanan', 'tall' => false, 'image' => 'images/lps/praktik-rutin.png'],
                ['icon' => 'fa-building', 'badge' => 'Industri', 'title' => 'Kunjungan Lembaga Keuangan', 'desc' => 'Belajar langsung dari bank syariah, BPRS, dan lembaga keuangan syariah lainnya', 'tall' => false, 'image' => 'images/lps/ki-lps.jpg'],
                ['icon' => 'fa-users', 'badge' => 'Simulasi', 'title' => 'Simulasi Perbankan', 'desc' => 'Menampilkan hasil praktik terbaik dalam berbagai ajang dan expo sekolah', 'tall' => false, 'image' => 'images/lps/ukk-lps.jpeg'],
                ['icon' => 'fa-user-tie', 'badge' => 'PKL', 'title' => 'PKL & Magang di Lembaga Keuangan', 'desc' => 'Pengalaman kerja langsung di bank syariah, BPRS, dan koperasi syariah', 'tall' => false, 'image' => 'images/lps/pkl-lps.jpeg'],
            ],

            'prospect_eyebrow' => 'Mau Berkontribusi di Mana?', 'prospect_h1' => 'SETELAH LULUS,', 'prospect_hgold' => 'MAU BERKONTRIBUSI DI MANA?',
            'prospect_items' => [
                ['icon' => 'fa-user-tie', 'tone' => 'blue', 'title' => 'KERJA', 'desc' => 'Teller, Customer Service, Back Office, Staff Administrasi, Frontliner, atau Marketing — siap bekerja di bank syariah maupun lembaga keuangan syariah lainnya.', 'tags' => 'Bank Syariah, BPRS, BMT / Koperasi Syariah, Lembaga Keuangan Mikro', 'image' => 'images/lps/kerja-lps.jpeg'],
                ['icon' => 'fa-graduation-cap', 'tone' => '', 'title' => 'KULIAH', 'desc' => 'Perbankan Syariah, Ekonomi Syariah, Akuntansi, Manajemen Keuangan, atau bidang ekonomi terkait — bekal LPS jadi modal kuat di perguruan tinggi.', 'tags' => 'Ekonomi Syariah, Akuntansi, Manajemen', 'image' => 'images/lps/kuliah.jpeg'],
                ['icon' => 'fa-user-tie', 'tone' => 'green', 'title' => 'USAHA', 'desc' => 'Jasa keuangan mikro syariah, koperasi syariah, konsultan keuangan syariah, dan bisnis mandiri berbasis prinsip syariah.', 'tags' => 'Koperasi Syariah, Jasa Keuangan, Bisnis Mandiri', 'image' => 'images/lps/usaha-lps.jpeg'],
            ],

            'lab_kicker' => 'Sharia Banking Practice Experience', 'lab_h1' => 'Jelajahi', 'lab_hgold' => 'Ruang Praktik Bank Mini Syariah', 'lab_sub' => 'Lihat LPS Tour LPS',
            'lab_desc' => 'Kenali lebih dekat bank mini syariah sebagai ruang belajar dan praktik untuk melayani nasabah, mengelola transaksi, serta memahami operasional perbankan berbasis prinsip syariah.',
            'lab_feats' => 'Fasilitas Bank Mini, Simulasi Teller & CS, Praktik Administrasi',
            'lab_btn' => 'Mulai LPS Tour', 'lab_watermark' => 'LPS',
            'lab_image' => 'tour/lab-lps.jpg', 'lab_badge' => 'LPS Tour',
            'lab_caption_title' => 'Jelajahi Ruang Praktik Bank Mini Syariah', 'lab_caption_sub' => 'Fasilitas praktik Layanan Perbankan Syariah',
            'lab_chip_title' => 'LPS Tour LPS', 'lab_chip_sub' => 'Explore Bank Mini Syariah',

            'cta_h1' => 'Siap Menjadi Bagian dari', 'cta_hgold' => 'LPS?',
            'cta_desc' => 'Kenali potensimu, temukan pengalaman belajar yang sesuai, dan mulai perjalananmu bersama LPS — dari teori menuju praktik dan karier di dunia perbankan syariah.',
            'cta_btn_text' => 'Daftar PPDB', 'cta_watermark' => '#LPS',
            'cta_bg' => 'images/aphp-upacara.jpg',
        ];
    }
}
