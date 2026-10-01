<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public static function seedIfEmpty(): void
    {
        $initialGalleries = [
            [
                'title'       => 'Sekolah Adiwiyata 2025',
                'category'    => 'Kompetisi',
                'event_date'  => '2025-12-25',
                'image_url'   => 'images/galeri/adiwiyata.jpeg',
                'description' => 'Dokumentasi penyerahan trofi sekolah hijau ramah lingkungan.',
            ],
            [
                'title'       => 'Ujian Kompetensi Keahlian (UKK)',
                'category'    => 'Akademik',
                'event_date'  => '2026-03-10',
                'image_url'   => 'images/galeri/ukk.jpeg',
                'description' => 'Pelaksanaan Ujian Kompetensi Keahlian (UKK) siswa SMK Negeri 2 Mojokerto.',
            ],
            [
                'title'       => 'Praktik Kerja Lapangan (PKL)',
                'category'    => 'Akademik',
                'event_date'  => '2026-01-15',
                'image_url'   => 'images/galeri/pkl.jpg',
                'description' => 'Siswa menjalani Praktik Kerja Lapangan (PKL) di dunia industri.',
            ],
            [
                'title'       => 'Penilaian Sumatif Akhir Jenjang (PSAJ)',
                'category'    => 'Akademik',
                'event_date'  => '2026-04-05',
                'image_url'   => 'images/galeri/psaj.jpg',
                'description' => 'Pelaksanaan Penilaian Sumatif Akhir Jenjang (PSAJ).',
            ],
            [
                'title'       => 'Lacurva',
                'category'    => 'Ekstrakurikuler',
                'event_date'  => '2026-02-20',
                'image_url'   => 'images/galeri/lacurva.jpg',
                'description' => 'Latihan dan kebersamaan tim suporter dan ekstrakurikuler Lacurva.',
            ],
            [
                'title'       => 'Tari Tradisional',
                'category'    => 'Ekstrakurikuler',
                'event_date'  => '2026-02-14',
                'image_url'   => 'images/galeri/tari.jpg',
                'description' => 'Latihan tari tradisional siswa SKANEDA.',
            ],
            [
                'title'       => 'Paskib',
                'category'    => 'Ekstrakurikuler',
                'event_date'  => '2026-02-01',
                'image_url'   => 'images/galeri/paskib.png',
                'description' => 'Latihan Pasukan Pengibar Bendera (Paskib).',
            ],
            [
                'title'       => 'MPLS Peserta Didik Baru',
                'category'    => 'Kesiswaan',
                'event_date'  => '2025-07-15',
                'image_url'   => 'images/galeri/mpls.jpg',
                'description' => 'Masa Pengenalan Lingkungan Sekolah (MPLS) peserta didik baru.',
            ],
            [
                'title'       => 'LDKPD',
                'category'    => 'Kesiswaan',
                'event_date'  => '2025-10-10',
                'image_url'   => 'images/galeri/ldkpd.jpg',
                'description' => 'Latihan Dasar Kepemimpinan Peserta Didik (LDKPD).',
            ],
            [
                'title'       => 'Perjusa',
                'category'    => 'Kesiswaan',
                'event_date'  => '2026-01-20',
                'image_url'   => 'images/galeri/perjusa.jpg',
                'description' => 'Perkemahan Jumat Sabtu (Perjusa) siswa SKANEDA.',
            ],
            [
                'title'       => 'Hari Kemerdekaan',
                'category'    => 'Upacara',
                'event_date'  => '2025-08-17',
                'image_url'   => 'images/galeri/kemerdekaan.jpg',
                'description' => 'Upacara peringatan Hari Kemerdekaan Indonesia.',
            ],
            [
                'title'       => 'Hari Pramuka',
                'category'    => 'Upacara',
                'event_date'  => '2025-08-14',
                'image_url'   => 'images/galeri/pramuka.jpg',
                'description' => 'Upacara peringatan Hari Pramuka.',
            ],
            [
                'title'       => 'Rutin Hari Senin',
                'category'    => 'Upacara',
                'event_date'  => '2026-01-12',
                'image_url'   => 'images/galeri/upacararutin.jpg',
                'description' => 'Upacara Rutin Hari Senin.',
            ],
            [
                'title'       => 'Festika',
                'category'    => 'Kompetisi',
                'event_date'  => '2025-11-20',
                'image_url'   => 'images/galeri/festika.jpeg',
                'description' => 'Festival dan Lomba Karya (Festika) siswa SKANEDA.',
            ],
            [
                'title'       => 'Lomba Kompetensi Siswa (LKS)',
                'category'    => 'Kompetisi',
                'event_date'  => '2026-05-10',
                'image_url'   => 'images/galeri/lks2026.jpeg',
                'description' => 'Lomba Kompetensi Siswa (LKS) tingkat nasional.',
            ],
            [
                'title'       => 'FIKSI',
                'category'    => 'Kompetisi',
                'event_date'  => '2024-10-15',
                'image_url'   => 'images/galeri/fiksi.jpg',
                'description' => 'Festival Inovasi dan Kewirausahaan Siswa Indonesia (FIKSI).',
            ],
            [
                'title'       => 'Skrining Kesehatan',
                'category'    => 'Kegiatan Sekolah',
                'event_date'  => '2026-02-05',
                'image_url'   => 'images/galeri/skrining.jpeg',
                'description' => 'Kegiatan skrining kesehatan siswa.',
            ],
            [
                'title'       => 'Hari Besar Keagamaan',
                'category'    => 'Kegiatan Sekolah',
                'event_date'  => '2026-03-01',
                'image_url'   => 'images/galeri/isramiraj.jpg',
                'description' => 'Peringatan hari besar keagamaan di sekolah.',
            ],
            [
                'title'       => 'Classmeet',
                'category'    => 'Kegiatan Sekolah',
                'event_date'  => '2025-12-18',
                'image_url'   => 'images/galeri/classmeet.jpg',
                'description' => 'Classmeeting antar kelas SMK Negeri 2 Mojokerto.',
            ],
            [
                'title'       => 'Kunjungan Industri APHP',
                'category'    => 'Kunjungan Industri',
                'event_date'  => '2026-02-18',
                'image_url'   => 'images/galeri/ki-aphp.jpeg',
                'description' => 'Kunjungan industri jurusan Agribisnis Pengolahan Hasil Pertanian.',
            ],
            [
                'title'       => 'Kunjungan Industri RPL',
                'category'    => 'Kunjungan Industri',
                'event_date'  => '2026-02-22',
                'image_url'   => 'images/galeri/ki-rpl.jpg',
                'description' => 'Kunjungan industri jurusan Rekayasa Perangkat Lunak.',
            ],
            [
                'title'       => 'Kunjungan Industri Kuliner',
                'category'    => 'Kunjungan Industri',
                'event_date'  => '2026-02-25',
                'image_url'   => 'images/galeri/ki-kuliner.jpeg',
                'description' => 'Kunjungan industri jurusan Kuliner.',
            ],
            [
                'title'       => 'Kunjungan Industri LPS',
                'category'    => 'Kunjungan Industri',
                'event_date'  => '2026-02-28',
                'image_url'   => 'images/galeri/ki-lps.jpg',
                'description' => 'Kunjungan industri jurusan Layanan Perbankan Syariah.',
            ],
        ];

        foreach ($initialGalleries as $galleryData) {
            Gallery::firstOrCreate(
                ['title' => $galleryData['title']],
                $galleryData
            );
        }
    }

    public function run(): void
    {
        self::seedIfEmpty();
    }
}
