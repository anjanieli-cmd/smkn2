<?php

namespace Database\Seeders;

use App\Models\TourScene;
use Illuminate\Database\Seeder;

/**
 * Memindahkan data lokasi Virtual Tour yang sebelumnya hardcoded di
 * resources/views/profile/tour.blade.php ke database.
 *
 * Foto TIDAK dipindah: path 'tour/xxx.jpg' menunjuk ke file yang sudah ada di
 * public/tour/ — TourScene::panorama_url otomatis memakai asset() untuk file
 * di public/, dan Storage url untuk foto hasil upload admin.
 *
 * Aman dijalankan berulang (updateOrCreate berdasarkan slug).
 */
class TourSceneSeeder extends Seeder
{
    public function run(): void
    {
        $scenes = [
            [
                'slug' => 'gerbang-utama', 'title' => 'Gerbang Utama', 'category' => 'area', 'icon' => 'fa-archway',
                'description' => 'Titik masuk utama SMK Negeri 2 Mojokerto, gerbang pertama yang menyambut siswa dan tamu setiap hari.',
                'panorama' => 'tour/gerbang-utama.jpg', 'haov' => 360, 'vaov' => 91, 'v_offset' => 0,
                'order' => 0, 'is_home' => true,
            ],
            [
                'slug' => 'lobi-sekolah', 'title' => 'Lobi & Ruang Tunggu', 'category' => 'area', 'icon' => 'fa-door-open',
                'description' => 'Area penerima tamu sekolah, penghubung menuju gedung kelas dan ruang program keahlian.',
                'panorama' => 'tour/lobi-sekolah.jpg', 'haov' => 360, 'vaov' => 122, 'v_offset' => 0,
                'order' => 1, 'is_home' => false,
            ],
            [
                'slug' => 'lapangan-utama', 'title' => 'Lapangan Utama', 'category' => 'area', 'icon' => 'fa-flag',
                'description' => 'Lapangan terbuka utama sekolah, dipakai untuk upacara bendera dan kegiatan siswa.',
                'panorama' => 'tour/lapangan-utama.jpg', 'haov' => 360, 'vaov' => 95.49, 'v_offset' => 0,
                'order' => 2, 'is_home' => false,
            ],
            [
                'slug' => 'lapangan-tengah', 'title' => 'Lapangan Tengah', 'category' => 'area', 'icon' => 'fa-shapes',
                'description' => 'Halaman tengah sekolah yang menghubungkan beberapa gedung kelas.',
                'panorama' => 'tour/lapangan-tengah.jpg', 'haov' => 360, 'vaov' => 124.9, 'v_offset' => 0,
                'order' => 3, 'is_home' => false,
            ],
            [
                'slug' => 'lapangan-basket', 'title' => 'Lapangan Basket', 'category' => 'fasilitas', 'icon' => 'fa-basketball',
                'description' => 'Lapangan basket beratap yang juga dipakai untuk kegiatan olahraga dan futsal siswa.',
                'panorama' => 'tour/lapangan-basket.jpg', 'haov' => 360, 'vaov' => 99.41, 'v_offset' => 0,
                'order' => 4, 'is_home' => false,
            ],
            [
                'slug' => 'parkiran', 'title' => 'Area Parkir', 'category' => 'fasilitas', 'icon' => 'fa-square-parking',
                'description' => 'Area parkir kendaraan siswa dan tamu di lingkungan sekolah.',
                'panorama' => 'tour/parkiran.jpg', 'haov' => 360, 'vaov' => 98.55, 'v_offset' => 0,
                'order' => 5, 'is_home' => false,
            ],
            [
                'slug' => 'aula', 'title' => 'Aula Serbaguna', 'category' => 'fasilitas', 'icon' => 'fa-people-roof',
                'description' => 'Ruang besar untuk acara sekolah, seminar, dan pertemuan wali murid.',
                'panorama' => 'tour/aula.jpg', 'haov' => 360, 'vaov' => 106.01, 'v_offset' => 0,
                'order' => 6, 'is_home' => false,
            ],
            [
                'slug' => 'kantin', 'title' => 'Kantin Sekolah', 'category' => 'fasilitas', 'icon' => 'fa-utensils',
                'description' => 'Area kantin tempat siswa dan guru membeli serta menyantap makanan saat istirahat.',
                'panorama' => 'tour/kantin.jpg', 'haov' => 360, 'vaov' => 94.73, 'v_offset' => 0,
                'order' => 7, 'is_home' => false,
            ],
            [
                'slug' => 'musholla', 'title' => 'Musholla', 'category' => 'fasilitas', 'icon' => 'fa-mosque',
                'description' => 'Tempat ibadah untuk siswa dan warga sekolah menjalankan sholat.',
                'panorama' => 'tour/musholla.jpg', 'haov' => 360, 'vaov' => 93.47, 'v_offset' => 0,
                'order' => 8, 'is_home' => false,
            ],
            [
                'slug' => 'ruang-kelas', 'title' => 'Ruang Kelas', 'category' => 'kelas', 'icon' => 'fa-chalkboard-user',
                'description' => 'Ruang kelas teori tempat siswa mengikuti kegiatan belajar mengajar.',
                'panorama' => 'tour/ruang-kelas.jpg', 'haov' => 360, 'vaov' => 85.78, 'v_offset' => 0,
                'order' => 9, 'is_home' => false,
            ],
            [
                'slug' => 'lab-lps', 'title' => 'Laboratorium LPS', 'category' => 'kelas', 'icon' => 'fa-building-columns',
                'description' => 'Ruang praktik siswa Layanan Perbankan Syariah, dilengkapi unit komputer untuk simulasi layanan nasabah.',
                'panorama' => 'tour/lab-lps.jpg', 'haov' => 360, 'vaov' => 92.25, 'v_offset' => 0,
                'order' => 10, 'is_home' => false,
            ],
            [
                'slug' => 'kelas-belakang', 'title' => 'Kelas Bagian Belakang', 'category' => 'kelas', 'icon' => 'fa-chalkboard',
                'description' => 'Deretan ruang kelas di bagian belakang lingkungan sekolah.',
                'panorama' => 'tour/kelas-belakang.jpg', 'haov' => 360, 'vaov' => 98.78, 'v_offset' => 0,
                'order' => 11, 'is_home' => false,
            ],
            [
                'slug' => 'lab-rpl', 'title' => 'Laboratorium RPL', 'category' => 'kelas', 'icon' => 'fa-code',
                'description' => 'Ruang praktik siswa Rekayasa Perangkat Lunak, dilengkapi unit komputer untuk kegiatan pemrograman.',
                'panorama' => 'tour/lab-rpl.jpg', 'haov' => 360, 'vaov' => 94.68, 'v_offset' => 0,
                'order' => 12, 'is_home' => false,
            ],
            [
                'slug' => 'lab-dkv', 'title' => 'Laboratorium DKV', 'category' => 'kelas', 'icon' => 'fa-palette',
                'description' => 'Ruang praktik siswa Desain Komunikasi Visual, dilengkapi perangkat desain digital.',
                'panorama' => 'tour/lab-dkv.jpg', 'haov' => 360, 'vaov' => 102.92, 'v_offset' => 0,
                'order' => 13, 'is_home' => false,
            ],
            [
                'slug' => 'lab-1-aphp', 'title' => 'Laboratorium APHP 1', 'category' => 'kelas', 'icon' => 'fa-wheat-awn',
                'description' => 'Ruang praktik pertama siswa Agribisnis Pengolahan Hasil Pertanian.',
                'panorama' => 'tour/lab-1-aphp.jpg', 'haov' => 360, 'vaov' => 105.76, 'v_offset' => 0,
                'order' => 14, 'is_home' => false,
            ],
            [
                'slug' => 'lab-2-aphp', 'title' => 'Laboratorium APHP 2', 'category' => 'kelas', 'icon' => 'fa-flask',
                'description' => 'Ruang praktik kedua siswa Agribisnis Pengolahan Hasil Pertanian.',
                'panorama' => 'tour/lab-2-aphp.jpg', 'haov' => 360, 'vaov' => 92.08, 'v_offset' => 0,
                'order' => 15, 'is_home' => false,
            ],
            [
                'slug' => 'lab-pastry', 'title' => 'Laboratorium Pastry', 'category' => 'kelas', 'icon' => 'fa-bread-slice',
                'description' => 'Dapur praktik siswa Kuliner untuk produk pastry dan bakery.',
                'panorama' => 'tour/lab-pastry.jpg', 'haov' => 360, 'vaov' => 141.23, 'v_offset' => 0,
                'order' => 16, 'is_home' => false,
            ],
            [
                'slug' => 'lab-tata-hidang', 'title' => 'Laboratorium Tata Hidang', 'category' => 'kelas', 'icon' => 'fa-champagne-glasses',
                'description' => 'Ruang praktik siswa Kuliner untuk pelayanan dan penataan hidangan (table setting).',
                'panorama' => 'tour/lab-tata-hidang.jpg', 'haov' => 360, 'vaov' => 179.44, 'v_offset' => 0,
                'order' => 17, 'is_home' => false,
            ],
        ];

        foreach ($scenes as $data) {
            TourScene::updateOrCreate(['slug' => $data['slug']], $data);
        }

        // Hotspot: "Menuju Lobi" di Gerbang Utama (hasil Mode Kalibrasi terakhir)
        $gerbang = TourScene::where('slug', 'gerbang-utama')->first();
        $lobi = TourScene::where('slug', 'lobi-sekolah')->first();

        if ($gerbang && $lobi) {
            $gerbang->hotspots()->updateOrCreate(
                ['target_scene_id' => $lobi->id],
                ['pitch' => 6.27, 'yaw' => -84.00, 'label' => 'Menuju Lobi', 'icon' => 'fa-plus', 'order' => 0]
            );
        }
    }
}
