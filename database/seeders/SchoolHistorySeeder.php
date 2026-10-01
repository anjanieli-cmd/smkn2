<?php

namespace Database\Seeders;

use App\Models\SchoolHistory;
use Illuminate\Database\Seeder;

class SchoolHistorySeeder extends Seeder
{
    public function run(): void
    {
        $history = SchoolHistory::singleton();

        $history->update([
            // Hero
            'hero_kicker' => null,
            'hero_image' => 'images/wide_minimalist_abstract_technology_background_des.png',

            // Intro / Statistik
            'intro_eyebrow' => 'Dari masa ke masa',
            'intro_title' => '2013 → HARI INI.',
            'intro_desc' => 'SMK Negeri 2 Mojokerto mulai berdiri pada 24 Juni 2013 sebagai bagian dari upaya menghadirkan pendidikan kejuruan bagi masyarakat Kota Mojokerto. Dari awal yang sederhana, sekolah ini terus berkembang melalui perpindahan tempat layanan pendidikan, pembangunan gedung baru, penambahan kompetensi keahlian, hingga kini memiliki lima bidang keahlian yang menjadi bagian dari perjalanan vokasi SMKN 2 Mojokerto.',

            'stat1_value' => '2013',
            'stat1_label' => 'Tahun berdiri',
            'stat2_value' => '24',
            'stat2_label' => 'Juni · Tanggal berdiri',
            'stat3_value' => '2',
            'stat3_label' => 'Kompetensi keahlian awal',
            'stat4_value' => '5',
            'stat4_label' => 'Bidang keahlian saat ini',

            // Story band
            'story_eyebrow' => 'Yang tidak berubah',
            'story_title' => 'MANUSIANYA. SEMANGATNYA.',
            'story_desc' => 'Teknologi dan fasilitas boleh berubah. Program keahlian terus berkembang. Namun inti perjalanan sekolah tetap sama: membentuk siswa yang siap berkarya, berkarakter, dan punya keberanian untuk melangkah lebih jauh.',
            'story_image' => 'images/smkn-guru.jpg',
            'story_chips' => ['Berkarakter', 'Kompeten', 'Adaptif', 'Berdaya saing'],

            // Virtual Tour
            'vt_title' => 'Jelajahi SMKN 2 Mojokerto',
            'vt_desc' => 'Jelajahi lingkungan SMK Negeri 2 Mojokerto secara interaktif melalui Virtual Tour 360°. Rasakan suasana sekolah dari sudut pandangmu dan lihat fasilitas sekolah secara lebih dekat.',
            'vt_link' => '#',
            'vt_image' => 'images/hero-sekolah.jpg',
        ]);

        // Bersihkan data lama biar seeder bisa dijalankan ulang tanpa duplikat
        $history->chapters()->delete();
        $history->principals()->delete();
        $history->galleries()->delete();

        $history->chapters()->createMany([
            [
                'kicker' => 'BAB PERTAMA',
                'year_label' => '24 JUNI 2013',
                'icon' => 'fa-flag',
                'tag' => 'Fondasi',
                'short_title' => 'Awal Berdiri',
                'short_desc' => 'SMK Negeri 2 Mojokerto mulai berdiri pada 24 Juni 2013 berdasarkan SK Pendirian Sekolah Nomor 188.45/630/417.111/2013.',
                'long_title' => 'Awal Berdiri',
                'lead' => 'Sebuah perjalanan baru dimulai dari satu langkah.',
                'body' => 'SMK Negeri 2 Mojokerto mulai berdiri pada 24 Juni 2013 dengan SK Pendirian Sekolah dan SK Ijin Operasional Sekolah Nomor 188.45/630/417.111/2013.',
                'note' => 'Dari awal berdiri, SMKN 2 Mojokerto mulai membangun fondasi sebagai sekolah menengah kejuruan di Kota Mojokerto.',
                'order' => 0,
            ],
            [
                'kicker' => 'BAB KEDUA',
                'year_label' => '2013',
                'icon' => 'fa-school',
                'tag' => 'Awal Perjalanan',
                'short_title' => 'Langkah Pertama',
                'short_desc' => 'Pada awal berdiri, layanan pendidikan masih bertempat di gedung SMKN 1 Mojokerto, Jl. Kedungsari, Magersari, Kota Mojokerto.',
                'long_title' => 'Langkah Pertama',
                'lead' => 'Sebelum memiliki gedung sendiri, perjalanan pendidikan dimulai dari tempat yang sederhana.',
                'body' => 'Pelaksanaan layanan pendidikan SMKN 2 Mojokerto pada awal berdiri bertempat di gedung SMKN 1 Mojokerto, Jl. Kedungsari, Magersari, Kota Mojokerto.',
                'note' => 'Pada masa awal tersebut, sekolah dikepalai oleh Bapak Drs. Harol Kristiyandoko, MT yang kala itu juga menjabat sebagai Kepala SMKN 1 Mojokerto.',
                'order' => 1,
            ],
            [
                'kicker' => 'BAB KETIGA',
                'year_label' => '16 JANUARI 2014',
                'icon' => 'fa-building',
                'tag' => 'Perkembangan',
                'short_title' => 'Menempati Gedung Baru',
                'short_desc' => 'SMKN 2 Kota Mojokerto mulai menempati gedung baru di Jl. Pulorejo, Kecamatan Prajuritkulon, Kota Mojokerto.',
                'long_title' => 'Gedung Baru',
                'lead' => 'Langkah berikutnya membawa SKANEDA ke rumahnya sendiri.',
                'body' => 'Pada 16 Januari 2014, SMKN 2 Kota Mojokerto menempati gedung baru di Jl. Pulorejo, Kecamatan Prajuritkulon, Kota Mojokerto.',
                'note' => 'Gedung baru tersebut diresmikan oleh Walikota Mojokerto, Drs. H. Mas’ud Yunus, menjadi salah satu tonggak penting dalam perkembangan sekolah.',
                'order' => 2,
            ],
            [
                'kicker' => 'BAB KEEMPAT',
                'year_label' => 'AWAL BERDIRI',
                'icon' => 'fa-utensils',
                'tag' => 'Kompetensi',
                'short_title' => 'Dua Kompetensi Keahlian',
                'short_desc' => 'Pada awal berdirinya, SMKN 2 Mojokerto membuka dua kompetensi keahlian: Tata Boga (TB) dan Rekayasa Perangkat Lunak (RPL).',
                'long_title' => 'Dua Kompetensi Keahlian',
                'lead' => 'Dari dua kompetensi, perjalanan pendidikan kejuruan mulai dibangun.',
                'body' => 'Pada awal berdirinya, SMKN 2 Mojokerto membuka dua kompetensi keahlian, yaitu Tata Boga (TB) dan Rekayasa Perangkat Lunak (RPL).',
                'note' => 'Keduanya menjadi bagian awal dari pilihan pendidikan kejuruan yang disediakan untuk masyarakat Kota Mojokerto.',
                'order' => 3,
            ],
            [
                'kicker' => 'BAB KELIMA',
                'year_label' => 'TAHUN BERIKUTNYA',
                'icon' => 'fa-layer-group',
                'tag' => 'Ekspansi',
                'short_title' => 'Kompetensi Semakin Beragam',
                'short_desc' => 'Tahun berikutnya, sekolah membuka tiga kompetensi keahlian baru: DKV, APHP, dan Perbankan Syari’ah.',
                'long_title' => 'Kompetensi Semakin Beragam',
                'lead' => 'Pertumbuhan sekolah diikuti dengan semakin luasnya pilihan bidang keahlian.',
                'body' => 'Tahun berikutnya, SMKN 2 Mojokerto membuka tiga kompetensi keahlian lainnya, yaitu Desain Komunikasi Visual (DKV), Agribisnis Pengolahan Hasil Pertanian (APHP), dan Perbankan Syari’ah (PS).',
                'note' => 'Penambahan kompetensi memperluas ruang belajar dan pilihan pengembangan keterampilan bagi peserta didik.',
                'order' => 4,
            ],
            [
                'kicker' => 'BAB TERKINI',
                'year_label' => 'HARI INI',
                'icon' => 'fa-graduation-cap',
                'tag' => 'Hari Ini',
                'short_title' => 'Lima Bidang Keahlian',
                'short_desc' => 'Hingga saat ini, SMKN 2 Kota Mojokerto memiliki lima bidang keahlian yang terus menjadi bagian dari perkembangan sekolah.',
                'long_title' => 'Lima Bidang Keahlian',
                'lead' => 'Dari dua kompetensi awal, SKANEDA kini hadir dengan lima bidang keahlian.',
                'body' => 'Hingga saat ini, SMKN 2 Kota Mojokerto memiliki lima bidang keahlian, yaitu pariwisata; seni dan industri kreatif; agribisnis dan agroteknologi; teknologi informasi dan komunikasi; serta bisnis manajemen.',
                'note' => 'Perjalanan sejak 2013 terus berlanjut dengan semangat mengembangkan pendidikan vokasi sesuai kebutuhan peserta didik dan masyarakat.',
                'order' => 5,
            ],
        ]);

        $history->principals()->createMany([
            [
                'name' => 'Drs. Harol Kristiandoko, M.T.',
                'period_label' => '2014 – 2018',
                'photo' => 'images/kepsek1.jpeg',
                'caption' => 'Periode kepemimpinan. Salah satu bagian awal dari perjalanan panjang SMK Negeri 2 Mojokerto.',
                'is_current' => false,
                'order' => 0,
            ],
            [
                'name' => 'Drs. Heru Susianto, M.Pd',
                'period_label' => '2018 – 2019',
                'photo' => 'images/kepsek2.jpeg',
                'caption' => 'Periode kepemimpinan. Salah satu bagian awal dari perjalanan panjang SMK Negeri 2 Mojokerto.',
                'is_current' => false,
                'order' => 1,
            ],
            [
                'name' => 'Siti Fatimah, S.Pd., M.M.',
                'period_label' => '2019 – 2020',
                'photo' => 'images/kepsek3.jpeg',
                'caption' => 'Periode kepemimpinan. Melanjutkan fondasi dan pertumbuhan sekolah dari masa ke masa.',
                'is_current' => false,
                'order' => 2,
            ],
            [
                'name' => 'Drs. Akhmad Mukhlason, M.M.Pd.',
                'period_label' => '2020 – 2026',
                'photo' => 'images/kepsek4.png',
                'caption' => 'Periode kepemimpinan. Fase penting menuju sekolah vokasi yang semakin modern dan adaptif.',
                'is_current' => false,
                'order' => 3,
            ],
            [
                'name' => 'Iswahyudi, S.ST. M.Pd',
                'period_label' => '2026 – Sekarang',
                'photo' => 'images/kepsek5.jpeg',
                'caption' => 'Kepala sekolah saat ini. Membawa SKANEDA terus bergerak menuju pendidikan vokasi yang unggul.',
                'is_current' => true,
                'order' => 4,
            ],
        ]);

        $history->galleries()->createMany([
            [
                'image' => 'images/aphp1.jpeg',
                'small_label' => 'Program keahlian',
                'big_label' => 'APHP · Agribisnis Pengolahan Hasil Pertanian',
                'is_featured' => true,
                'order' => 0,
            ],
            [
                'image' => 'images/dkv1.jpeg',
                'small_label' => 'Kreatif',
                'big_label' => 'Desain Komunikasi Visual',
                'is_featured' => false,
                'order' => 1,
            ],
            [
                'image' => 'images/kuliner1.jpeg',
                'small_label' => 'Industri kreatif',
                'big_label' => 'Kuliner',
                'is_featured' => false,
                'order' => 2,
            ],
            [
                'image' => 'images/rpl1.jpeg',
                'small_label' => 'Teknologi',
                'big_label' => 'Rekayasa Perangkat Lunak',
                'is_featured' => false,
                'order' => 3,
            ],
            [
                'image' => 'images/lps1.jpeg',
                'small_label' => 'Ekonomi',
                'big_label' => 'Layanan Perbankan Syariah',
                'is_featured' => false,
                'order' => 4,
            ],
        ]);
    }
}