<?php

namespace Database\Seeders;

use App\Models\KegiatanAlbum;
use App\Models\KegiatanCategory;
use App\Models\KegiatanMonth;
use App\Models\KegiatanPlacement;
use Illuminate\Database\Seeder;

/**
 * Memindahkan isi halaman Kegiatan yang sebelumnya hardcoded ke database.
 * Foto memakai file yang sudah ada di public/images/galeri/ (tidak dipindah).
 * Hanya mengisi tabel yang masih kosong, jadi aman diulang dan tidak
 * menimpa hasil edit admin.
 */
class KegiatanSeeder extends Seeder
{
    public function run(): void
    {
        if (!KegiatanCategory::query()->exists()) {
            foreach ([
                ['akademik', 'Akademik', 'fa-book-open'],
                ['ekstrakurikuler', 'Ekstrakurikuler', 'fa-running'],
                ['kesiswaan', 'Kesiswaan', 'fa-users'],
                ['upacara', 'Upacara', 'fa-flag'],
                ['kompetisi', 'Kompetisi', 'fa-trophy'],
                ['kegiatan-sekolah', 'Kegiatan Sekolah', 'fa-school'],
                ['kunjungan-industri', 'Kunjungan Industri', 'fa-industry'],
            ] as $i => [$key, $label, $icon]) {
                KegiatanCategory::create(['key' => $key, 'label' => $label, 'icon' => $icon, 'order' => $i]);
            }
        }

        if (!KegiatanAlbum::query()->exists()) {
            // [judul, kategori, tahun, foto, ukuran kartu]
            $rows = [
                ['Ujian Kompetensi Keahlian (UKK)', 'akademik', '2026', 'ukk.jpeg', 'lg'],
                ['Praktik Kerja Lapangan (PKL)', 'akademik', '2026', 'pkl.jpg', 'wide'],
                ['Penilaian Sumatif Akhir Jenjang (PSAJ)', 'akademik', '2026', 'psaj.jpg', 'standard'],

                ['Lacurva', 'ekstrakurikuler', '2026', 'lacurva.jpg', 'tall'],
                ['Tari Tradisional', 'ekstrakurikuler', '2026', 'tari.jpg', 'md'],
                ['Paskib', 'ekstrakurikuler', '2026', 'paskib.png', 'standard'],

                ['MPLS Peserta Didik Baru', 'kesiswaan', '2026', 'mpls.jpg', 'wide'],
                ['LDKPD', 'kesiswaan', '2025', 'ldkpd.jpg', 'standard'],
                ['Perjusa', 'kesiswaan', '2026', 'perjusa.jpg', 'md'],

                ['Hari Kemerdekaan', 'upacara', '2026', 'kemerdekaan.jpg', 'lg'],
                ['Hari Pramuka', 'upacara', '2025', 'pramuka.jpg', 'standard'],
                ['Rutin Hari Senin', 'upacara', '2026', 'upacararutin.jpg', 'standard'],

                ['Festika', 'kompetisi', '2025', 'festika.jpeg', 'wide'],
                ['Lomba Kompetensi Siswa (LKS)', 'kompetisi', '2026', 'lks2026.jpeg', 'tall'],
                ['FIKSI', 'kompetisi', '2024', 'fiksi.jpg', 'md'],

                ['Skrining Kesehatan', 'kegiatan-sekolah', '2026', 'skrining.jpeg', 'lg'],
                ['Hari Besar Keagamaan', 'kegiatan-sekolah', '2026', 'isramiraj.jpg', 'standard'],
                ['Classmeet', 'kegiatan-sekolah', '2026', 'classmeet.jpg', 'md'],

                ['Kunjungan Industri APHP', 'kunjungan-industri', '2026', 'ki-aphp.jpeg', 'wide'],
                ['Kunjungan Industri RPL', 'kunjungan-industri', '2026', 'ki-rpl.jpg', 'standard'],
                ['Kunjungan Industri Kuliner', 'kunjungan-industri', '2026', 'ki-kuliner.jpeg', 'md'],
                ['Kunjungan Industri LPS', 'kunjungan-industri', '2026', 'ki-lps.jpg', 'standard'],
            ];

            $byTitle = [];
            foreach ($rows as $i => [$title, $cat, $year, $file, $size]) {
                $byTitle[$title] = KegiatanAlbum::create([
                    'title'           => $title,
                    'category_key'    => $cat,
                    'date_label'      => $year,
                    'photo'           => 'images/galeri/' . $file,
                    'size'            => $size,
                    'show_in_gallery' => true,
                    'order'           => $i,
                    'is_active'       => true,
                ]);
            }

            // Album khusus Sorotan (tidak muncul di galeri "Jejak Kegiatan")
            $adiwiyata = KegiatanAlbum::create([
                'title' => 'Sekolah Adiwiyata 2025', 'category_key' => 'kegiatan-sekolah', 'date_label' => '25 Desember 2025',
                'photo' => 'images/galeri/adiwiyata.jpeg', 'size' => 'standard',
                'show_in_gallery' => false, 'order' => count($rows), 'is_active' => true,
            ]);
            $lks = KegiatanAlbum::create([
                'title' => 'LKS', 'category_key' => 'kompetisi', 'date_label' => '2026',
                'photo' => 'images/galeri/lks.jpg', 'size' => 'standard',
                'show_in_gallery' => false, 'order' => count($rows) + 1, 'is_active' => true,
            ]);

            if (!KegiatanPlacement::query()->exists()) {
                $place = fn (string $slot, int $pos, KegiatanAlbum $a, ?string $label) => KegiatanPlacement::create([
                    'slot' => $slot, 'position' => $pos, 'album_id' => $a->id, 'label' => $label,
                ]);

                $place('featured', 0, $adiwiyata, 'Penghargaan • 25 Desember 2025');

                $place('pick_big', 0, $byTitle['Ujian Kompetensi Keahlian (UKK)'],
                    'Ujian Kompetensi Keahlian, bukti nyata dari setiap keterampilan yang diasah.');

                $place('pick_small', 0, $byTitle['Kunjungan Industri Kuliner'], 'Kunjungan Industri');
                $place('pick_small', 1, $lks, 'LKS');
                $place('pick_small', 2, $byTitle['FIKSI'], 'FIKSI');
                $place('pick_small', 3, $byTitle['Praktik Kerja Lapangan (PKL)'], 'PKL');
            }
        }

        if (!KegiatanMonth::query()->exists()) {
            foreach ([
                ['JAN', 'Awal Semester Genap & Rapat Kerja Program', 'Menyusun rencana kegiatan semester'],
                ['FEB', 'Kunjungan Industri', 'Belajar langsung ke dunia industri'],
                ['MAR', 'Pembekalan PKL', 'Membekali siswa sebelum terjun ke DUDI'],
                ['APR', 'Pemberangkatan PKL', 'Melepas siswa memulai praktik kerja lapangan'],
                ['MEI', 'Pelepasan & Wisuda Kelas XII', 'Mengantar alumni menuju dunia kerja'],
                ['JUN', 'Penerimaan Rapot', 'Evaluasi hasil belajar satu semester'],
                ['JUL', 'MPLS Peserta Didik Baru', 'Menyambut keluarga baru SKANEDA'],
                ['AGU', 'Lomba 17-an & HUT Kemerdekaan', 'Memeriahkan bulan kemerdekaan'],
                ['SEP', 'Peringatan Hari Besar & Latihan Gabungan', 'Momen kebersamaan seluruh siswa'],
                ['OKT', 'Penjemputan PKL', 'Menyambut kembali siswa dari dunia industri'],
            ] as $i => [$label, $event, $note]) {
                KegiatanMonth::create(['label' => $label, 'event' => $event, 'note' => $note, 'order' => $i, 'is_active' => true]);
            }
        }
    }
}
