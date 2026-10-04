<?php

namespace Database\Seeders;

use App\Models\SchoolAchievement;
use Illuminate\Database\Seeder;

/**
 * Data awal halaman Prestasi Sekolah (31 prestasi).
 *
 * AMAN dijalankan berulang kapan saja:
 *   php artisan db:seed --class=AchievementSeeder
 *
 *  - Prestasi dicocokkan lewat JUDUL. Yang belum ada akan dibuat ulang.
 *    (Cocok untuk memulihkan data yang hilang/terhapus.)
 *  - Prestasi yang sudah ada TIDAK ditimpa, jadi hasil edit admin tetap aman.
 *    Hanya kolom baru yang masih kosong (tingkat spesifik, peringkat, kategori,
 *    tanggal) yang diisi dari data awal.
 *  - Jangan dipanggil dari route/controller. Jalankan lewat terminal saja.
 */
class AchievementSeeder extends Seeder
{
    /** Kolom yang boleh diisi otomatis pada data lama yang masih kosong. */
    private const BACKFILL = ['level_label', 'rank', 'tag', 'event_date'];

    public static function items(): array
    {
        return [
            // ---------- Data awal lama (tanpa tanggal lengkap) ----------
            [
                'title'       => 'Juara 2 Hackathon Pelajar Nusantara',
                'level'       => 'Nasional',
                'level_label' => 'Nasional',
                'year'        => '2026',
                'rank'        => 'Juara 2',
                'tag'         => 'RPL',
                'winner_name' => 'Tim Dev SKANEDA (RPL)',
                'description' => 'Kompetisi pembuatan aplikasi solusi smart city antar pelajar se-Indonesia.',
                'image_url'   => 'images/rpl1.jpeg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Juara 1 Lomba Desain Grafis DKV Mojokerto',
                'level'       => 'Kota/Kabupaten',
                'level_label' => 'Kota Mojokerto',
                'year'        => '2026',
                'rank'        => 'Juara 1',
                'tag'         => 'DKV',
                'winner_name' => 'Ahmad Zaki (XI DKV)',
                'description' => 'Lomba desain poster kreatif peringatan Hari Pendidikan Nasional.',
                'image_url'   => 'images/dkv1.jpeg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Juara 1 LKS Web Technologies Jawa Timur',
                'level'       => 'Provinsi',
                'level_label' => 'Jawa Timur',
                'year'        => '2025',
                'rank'        => 'Juara 1',
                'tag'         => 'RPL',
                'winner_name' => 'Rovino Ramadhani (RPL)',
                'description' => 'Lomba Kompetensi Siswa SMK Tingkat Provinsi Jawa Timur 2025 di bidang pengembangan web.',
                'image_url'   => 'images/lks.jpeg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Penghargaan Sekolah Adiwiyata Mandiri',
                'level'       => 'Nasional',
                'level_label' => 'Nasional',
                'year'        => '2025',
                'rank'        => 'Penghargaan',
                'tag'         => 'Lingkungan',
                'winner_name' => 'Tim Lingkungan SKANEDA',
                'description' => 'Penghargaan lingkungan hidup tingkat nasional oleh Kementerian Lingkungan Hidup dan Kehutanan.',
                'image_url'   => 'images/adiwiyata.jpeg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Medali Emas O2SN Karate Putri',
                'level'       => 'Provinsi',
                'level_label' => 'Jawa Timur',
                'year'        => '2025',
                'rank'        => 'Medali Emas',
                'tag'         => 'Olahraga',
                'winner_name' => 'Siti Nurhaliza (X RPL 2)',
                'description' => 'Olimpiade Olahraga Siswa Nasional (O2SN) SMK Tingkat Provinsi Jawa Timur.',
                'image_url'   => 'images/galeri/perjusa.jpg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Juara 1 FIKSI Bidang Boga & Olahan Pangan',
                'level'       => 'Nasional',
                'level_label' => 'Nasional',
                'year'        => '2024',
                'rank'        => 'Juara 1',
                'tag'         => 'APHP',
                'winner_name' => 'Tim APHP SKANEDA',
                'description' => 'Festival Inovasi dan Kewirausahaan Siswa Indonesia (FIKSI) Kemendikbudristek.',
                'image_url'   => 'images/galeri/fiksi.jpg',
                'is_featured' => false,
            ],

            // ---------- Dipindahkan dari halaman publik (sebelumnya tertulis mati di Blade) ----------
            [
                'title'       => 'Siswi Perbankan Syariah Dinobatkan sebagai Duta Koperasi Bertalenta 2022',
                'level'       => 'Kota/Kabupaten',
                'level_label' => 'Kota Mojokerto',
                'year'        => '2022',
                'event_date'  => '2022-09-01',
                'rank'        => 'Duta Koperasi',
                'tag'         => 'Perbankan Syariah',
                'description' => 'Cantika Putri Hapsari, siswi Perbankan Syariah SMKN 2 Mojokerto, berhasil meraih kategori Duta Koperasi Bertalenta Kota Mojokerto 2022. Prestasi ini menjadi bukti kemampuan dan kepeduliannya dalam mengembangkan literasi perkoperasian di kalangan generasi muda.',
                'image_url'   => 'images/prestasi/dutkop22.jpg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Siswa SMKN 2 Mojokerto Raih Prestasi di Ajang Duta GenRe 2022',
                'level'       => 'Kota/Kabupaten',
                'level_label' => 'Kota Mojokerto & Jombang',
                'year'        => '2022',
                'event_date'  => '2022-09-11',
                'rank'        => 'Duta GenRe',
                'tag'         => 'Umum',
                'description' => 'Siswa SMKN 2 Mojokerto berhasil menorehkan prestasi dalam ajang Duta GenRe 2022. Riska Kurniaila meraih Duta GenRe Sosial Media Inspiratif Kabupaten Jombang, sementara Muhammad Zulkifli dan Siti Nur Kholifah menjadi finalis Duta GenRe Kota Mojokerto.',
                'image_url'   => 'images/prestasi/dugen22.jpg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Skaneda Raih Juara 3 Lomba Cerdas Cermat DISKOPUKMPERINDAG',
                'level'       => 'Kota/Kabupaten',
                'level_label' => 'Kota Mojokerto',
                'year'        => '2024',
                'event_date'  => '2024-07-27',
                'rank'        => 'Juara 3',
                'tag'         => 'Perbankan Syariah',
                'description' => 'Tim Layanan Perbankan Syariah SMKN 2 Mojokerto berhasil meraih Juara 3 Lomba Cerdas Cermat Tingkat SMA/SMK/MA se-Kota Mojokerto. Prestasi ini diraih berkat ketekunan, disiplin waktu, literasi yang luas, serta bimbingan dari para guru.',
                'image_url'   => 'images/prestasi/cerdascermat.jpg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Skaneda Raih Juara Favorit Duta Koperasi 2024',
                'level'       => 'Kota/Kabupaten',
                'level_label' => 'Kota Mojokerto',
                'year'        => '2024',
                'event_date'  => '2024-08-03',
                'rank'        => 'Juara Favorit',
                'tag'         => 'Umum',
                'description' => 'Naura Rahma Putri berhasil meraih Juara Favorit Duta Koperasi Kota Mojokerto 2024, sementara Zidana Khoiron dan Lahriria Amanah Muarta menjadi finalis. Prestasi ini didukung kekompakan tim, sosialisasi koperasi, serta dukungan warga sekolah.',
                'image_url'   => 'images/prestasi/dutkop24.jpg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Skaneda Sapu Bersih Juara Lomba Paskibraka Tingkat Nasional 2024',
                'level'       => 'Nasional',
                'level_label' => 'Nasional',
                'year'        => '2024',
                'event_date'  => '2024-08-14',
                'rank'        => 'Multi Juara',
                'tag'         => 'Paskibraka',
                'description' => 'Tim Paskibraka SMKN 2 Mojokerto berhasil meraih berbagai penghargaan dalam lomba LKBB Mahapatih Se-Nasional. Prestasi yang diraih meliputi juara variasi, formasi, pasukan, kostum, make-up, serta beberapa kategori lainnya.',
                'image_url'   => 'images/prestasi/paskib24.jpg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Skaneda Terpilih dalam Program Korea E-Learning Improvement Cooperation (KLIC)',
                'level'       => 'Nasional',
                'level_label' => 'Nasional',
                'year'        => '2024',
                'event_date'  => '2024-08-18',
                'rank'        => 'Program Terpilih',
                'tag'         => 'Program',
                'description' => 'SMKN 2 Mojokerto menjadi salah satu sekolah terpilih dalam program Korea E-Learning Improvement Cooperation (KLIC). Melalui program ini, guru mendapatkan pelatihan teknologi pembelajaran, termasuk Artificial Intelligence dan Robotic Programming dari para pengajar Korea.',
                'image_url'   => 'images/prestasi/klic.jpg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Tim Kuliner Skaneda Raih Medali Perak LKS Nasional',
                'level'       => 'Nasional',
                'level_label' => 'Nasional',
                'year'        => '2024',
                'event_date'  => '2024-08-23',
                'rank'        => 'Juara 2',
                'tag'         => 'Kuliner',
                'description' => 'Ahmed Husein Jalili dan Mohammad Dzakaa Irawan berhasil meraih Medali Perak atau Juara 2 Nasional dalam LKS XXXII bidang Patisserie and Confectionery di Lampung. Prestasi ini merupakan hasil latihan intensif selama hampir 10 bulan dan dukungan dari para pembimbing.',
                'image_url'   => 'images/prestasi/lkslampung.jpg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Skaneda Raih Juara Favorit Lomba Koperasi Tingkat Jawa Timur',
                'level'       => 'Provinsi',
                'level_label' => 'Jawa Timur',
                'year'        => '2024',
                'event_date'  => '2024-09-21',
                'rank'        => 'Juara Favorit',
                'tag'         => 'Umum',
                'description' => 'Tim Layanan Perbankan Syariah SMKN 2 Mojokerto berhasil meraih Juara Favorit Lomba Koperasi Tingkat Jawa Timur 2024. Prestasi ini diraih melalui kekompakan tim, kreativitas, inovasi produk, serta kolaborasi Kopsis Dewantara dengan berbagai jurusan.',
                'image_url'   => 'images/prestasi/lombakoperasi.jpg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Dua Tim RPL dan DKV Lolos 6 dan 10 Besar Nasional FIKSI',
                'level'       => 'Nasional',
                'level_label' => 'Nasional',
                'year'        => '2024',
                'event_date'  => '2024-09-21',
                'rank'        => '6 & 10 Besar',
                'tag'         => 'RPL & DKV',
                'description' => 'Dua tim SMKN 2 Mojokerto berhasil lolos dalam FIKSI Tingkat Nasional 2024. Tim Saqran Cakra menempati 6 besar melalui inovasi desain kaos Majapahit, sedangkan Tim Skaneda Mojokerto masuk 10 besar melalui produk Tambal Express.',
                'image_url'   => 'images/prestasi/fiksi.jpg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Tim Futsal Skaneda Raih Juara 1 Tingkat Mojokerto Raya',
                'level'       => 'Kota/Kabupaten',
                'level_label' => 'Mojokerto Raya',
                'year'        => '2024',
                'event_date'  => '2024-10-16',
                'rank'        => 'Juara 1',
                'tag'         => 'Olahraga',
                'description' => 'Tim Futsal SMKN 2 Mojokerto berhasil menjadi Juara 1 Pertandingan Futsal Pelajar Tingkat SMA/SMK se-Mojokerto Raya. Kemenangan ini diraih melalui permainan kompak dan strategi yang diterapkan bersama pelatih serta dukungan keluarga besar Skaneda.',
                'image_url'   => 'images/prestasi/lombafutsal.jpg',
                'is_featured' => false,
            ],
            [
                'title'       => 'PMR Skaneda Raih Juara 2 Lomba Poster dan Video Kreatif',
                'level'       => 'Kota/Kabupaten',
                'level_label' => 'Mojokerto Raya',
                'year'        => '2024',
                'event_date'  => '2024-10-16',
                'rank'        => 'Juara 2',
                'tag'         => 'Umum',
                'description' => 'Tim PMR SMKN 2 Mojokerto berhasil meraih Juara 2 Lomba Video Kreatif dan Poster dalam rangka HUT ke-79 PMI. Prestasi ini menjadi hasil dari kreativitas, disiplin, latihan, serta bimbingan pembina PMR Skaneda.',
                'image_url'   => 'images/prestasi/juarapmr.jpg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Tim Maja Force RPL Lolos 10 Besar MEA Tingkat Nasional',
                'level'       => 'Nasional',
                'level_label' => 'Nasional',
                'year'        => '2024',
                'event_date'  => '2024-10-19',
                'rank'        => '10 Besar',
                'tag'         => 'RPL',
                'description' => 'Tim Maja Force dari RPL SMKN 2 Mojokerto berhasil masuk 10 besar Madani Entrepreneur Academy (MEA) Tingkat Nasional. Tim mengembangkan inovasi minuman berbahan buah maja dan mempersiapkan produk melalui berbagai tahapan seleksi serta pembinaan.',
                'image_url'   => 'images/prestasi/mea.jpg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Skaneda Raih Juara 1 LKS DIKMEN Bidang Akuntansi',
                'level'       => 'Kota/Kabupaten',
                'level_label' => 'Kota Mojokerto',
                'year'        => '2025',
                'event_date'  => '2025-03-03',
                'rank'        => 'Juara 1',
                'tag'         => 'Akuntansi',
                'description' => 'Putra Ananda Rifky Noviansyah Hardianto berhasil meraih Juara 1 LKS DIKMEN Bidang Akuntansi Tingkat Kabupaten/Kota Mojokerto. Prestasi ini diraih melalui latihan intensif, tryout, evaluasi, serta pendalaman materi akuntansi dan pajak.',
                'image_url'   => 'images/prestasi/lksakuntansi.jpg',
                'is_featured' => false,
            ],
            [
                'title'       => 'SMKN 2 Mojokerto Raih Penghargaan Sekolah Adiwiyata Provinsi',
                'level'       => 'Provinsi',
                'level_label' => 'Jawa Timur',
                'year'        => '2025',
                'event_date'  => '2025-12-25',
                'rank'        => 'Penghargaan',
                'tag'         => 'Lingkungan',
                'description' => 'SMKN 2 Mojokerto berhasil meraih penghargaan sebagai Sekolah Adiwiyata Provinsi Jawa Timur setelah sebelumnya masuk dalam Top 20 dari 238 sekolah calon Adiwiyata. Capaian ini menjadi bukti komitmen sekolah dalam membangun lingkungan pendidikan yang berkelanjutan.',
                'image_url'   => 'images/prestasi/adiwiyata.jpeg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Talenta Muda Skaneda Bersinar, Dua Tim Raih Juara FESTIKA Jatim 2025',
                'level'       => 'Provinsi',
                'level_label' => 'Jawa Timur',
                'year'        => '2025',
                'event_date'  => '2025-12-26',
                'rank'        => 'Juara 2 & 3',
                'tag'         => 'RPL',
                'description' => 'Dua tim SMKN 2 Mojokerto, Outsider dan Jayashima, berhasil meraih Juara 2 dan Juara 3 dalam FESTIKA Jawa Timur 2025 kategori AREK-AI Aplikasi Python. Prestasi ini menunjukkan kemampuan siswa dalam mengembangkan teknologi dan berinovasi di era digital.',
                'image_url'   => 'images/prestasi/festika.jpeg',
                'is_featured' => true,
            ],
            [
                'title'       => 'Skaneda Raih Juara 2 Tolak Peluru pada POPKOTA Mojokerto 2026',
                'level'       => 'Kota/Kabupaten',
                'level_label' => 'Kota Mojokerto',
                'year'        => '2026',
                'event_date'  => '2026-07-04',
                'rank'        => 'Juara 2',
                'tag'         => 'Olahraga',
                'description' => 'Dawwas, siswa SMKN 2 Mojokerto, berhasil meraih Juara 2 Tolak Peluru Putra dalam Pekan Olahraga Pelajar Kota Mojokerto 2026. Prestasi ini menjadi bukti semangat, disiplin, dan sportivitas siswa Skaneda dalam bidang olahraga.',
                'image_url'   => 'images/prestasi/tolakpeluru.jpeg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Skaneda Raih Prestasi pada FLS3N Kota Mojokerto 2026',
                'level'       => 'Kota/Kabupaten',
                'level_label' => 'Kota Mojokerto',
                'year'        => '2026',
                'event_date'  => '2026-05-26',
                'rank'        => 'Juara 2 & 3',
                'tag'         => 'Seni',
                'description' => 'SMKN 2 Mojokerto berhasil menorehkan prestasi dalam FLS3N Kota Mojokerto 2026. Gracia meraih Juara 2 Solo Putri, sedangkan Fauziyah meraih Juara 3 Komik Digital, bersama peserta lainnya yang turut memberikan penampilan terbaik.',
                'image_url'   => 'images/prestasi/fls3n.jpeg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Skaneda Raih Medali Perunggu Cabang Dayung',
                'level'       => 'Kota/Kabupaten',
                'level_label' => 'Kota Mojokerto',
                'year'        => '2026',
                'event_date'  => '2026-05-10',
                'rank'        => 'Juara 3',
                'tag'         => 'Olahraga',
                'description' => 'Ayu Pinky berhasil meraih Medali Perunggu Cabang Olahraga Dayung pada Pekan Olahraga Pelajar Kota Mojokerto 2026. Prestasi ini menjadi bukti kerja keras, kedisiplinan, dan semangat pantang menyerah dalam mencapai prestasi olahraga.',
                'image_url'   => 'images/prestasi/dayung.jpeg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Inspiratif! Kak Carla, Bukti Semangat Skaneda Menuju Prestasi',
                'level'       => 'Kota/Kabupaten',
                'level_label' => 'Internal Sekolah',
                'year'        => '2026',
                'event_date'  => '2026-04-21',
                'rank'        => 'Inspiratif',
                'tag'         => 'Inspirasi',
                'description' => 'Perjalanan inspiratif Kak Carla menjadi gambaran bahwa kerja keras, konsistensi, dan semangat belajar dapat membuka berbagai kesempatan. Kisah tersebut diharapkan mampu memotivasi siswa Skaneda untuk berani mengembangkan potensi dan meraih cita-cita.',
                'image_url'   => 'images/prestasi/carla.jpeg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Skaneda Raih Juara 3 pada Dua Bidang LKS Jawa Timur 2026',
                'level'       => 'Provinsi',
                'level_label' => 'Jawa Timur',
                'year'        => '2026',
                'event_date'  => '2026-04-13',
                'rank'        => 'Juara 3',
                'tag'         => 'DKV & Kuliner',
                'description' => 'SMKN 2 Mojokerto berhasil meraih Juara 3 Graphic Design Technology dan Juara 3 Patisserie and Confectionery dalam LKS Jawa Timur 2026. Prestasi ini menjadi hasil dari kerja keras, dedikasi, latihan, serta dukungan para pembimbing.',
                'image_url'   => 'images/prestasi/lks26.jpg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Skaneda Raih Prestasi pada Ajang Duta GenRe Kota Mojokerto 2026',
                'level'       => 'Kota/Kabupaten',
                'level_label' => 'Kota Mojokerto',
                'year'        => '2026',
                'event_date'  => '2026-05-05',
                'rank'        => 'Partisipasi',
                'tag'         => 'Umum',
                'description' => 'SMKN 2 Mojokerto kembali berpartisipasi dalam Duta GenRe Kota Mojokerto 2026. Keikutsertaan ini menjadi bukti komitmen sekolah dalam membentuk generasi muda yang sehat, berkarakter, memiliki kepedulian sosial, serta mampu menjadi teladan bagi lingkungan.',
                'image_url'   => 'images/prestasi/dugen26.jpeg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Alumni Skaneda Raih Beasiswa di Huaqiao University, China',
                'level'       => 'Internasional',
                'level_label' => 'Internasional',
                'year'        => '2026',
                'event_date'  => '2026-07-29',
                'rank'        => 'Beasiswa',
                'tag'         => 'Beasiswa',
                'description' => 'Kameela Masyayu Ananda Apsari, alumni SMKN 2 Mojokerto, berhasil memperoleh Beasiswa Keguruan Bahasa Tionghoa dari LKPBT Jatim di Huaqiao University, China. Pencapaian ini menjadi bukti bahwa lulusan Skaneda mampu melanjutkan pendidikan dan meraih kesempatan hingga tingkat internasional.',
                'image_url'   => 'images/prestasi/china.jpeg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Dhiva Alennia Raih Juara 1 Pencak Silat KONI Championship',
                'level'       => 'Kota/Kabupaten',
                'level_label' => 'Kabupaten Mojokerto',
                'year'        => '2026',
                'event_date'  => '2026-08-17',
                'rank'        => 'Juara 1',
                'tag'         => 'Olahraga',
                'description' => 'Dhiva Alennia berhasil meraih Juara 1 Pencak Silat KONI Championship yang diselenggarakan di GOR Dinas Pendidikan Kabupaten Mojokerto. Prestasi ini menjadi bukti kerja keras, keberanian, disiplin, dan semangat pantang menyerah dalam meraih podium.',
                'image_url'   => 'images/prestasi/pencaksilat.jpeg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Tim Penerbang Roket Raih Juara 1 Web Development di Polinema',
                'level'       => 'Provinsi',
                'level_label' => 'Malang (Regional)',
                'year'        => '2024',
                'event_date'  => '2024-11-29',
                'rank'        => 'Juara 1',
                'tag'         => 'RPL',
                'description' => 'Tim Penerbang Roket SMKN 2 Mojokerto berhasil meraih Juara 1 Lomba Web Development yang diselenggarakan di Politeknik Negeri Malang. Prestasi ini menunjukkan kreativitas, kemampuan teknologi, kerja sama, serta semangat belajar siswa dalam bidang pengembangan web.',
                'image_url'   => 'images/prestasi/goldentiket.jpeg',
                'is_featured' => false,
            ],
            [
                'title'       => 'Tim APHP Skaneda Melaju ke Babak Final FIKSI 2025',
                'level'       => 'Nasional',
                'level_label' => 'Nasional',
                'year'        => '2025',
                'event_date'  => '2025-10-18',
                'rank'        => 'Finalis',
                'tag'         => 'APHP',
                'description' => 'Tim APHP (Agribisnis Pengolahan Hasil Pertanian) SMKN 2 Mojokerto kembali menorehkan prestasi dengan berhasil lolos sebagai finalis dalam ajang Festival Inovasi dan Kewirausahaan Siswa Indonesia (FIKSI) 2025. Pencapaian ini menjadi bukti atas kreativitas, inovasi, dan kerja keras tim APHP Skaneda dalam mengembangkan ide kewirausahaan di bidang pengolahan hasil pertanian. Keberhasilan melaju ke tahap final menjadi kesempatan bagi Tim APHP Skaneda untuk terus menunjukkan potensi dan membawa nama SMKN 2 Mojokerto pada ajang bergengsi tersebut.',
                'image_url'   => 'images/prestasi/fiksi25.jpg',
                'is_featured' => false,
            ],
        ];
    }

    public static function seedIfEmpty(): void
    {
        foreach (self::items() as $item) {
            $achv = SchoolAchievement::firstOrCreate(['title' => $item['title']], $item);

            if ($achv->wasRecentlyCreated) {
                continue;
            }

            $fill = [];
            foreach (self::BACKFILL as $col) {
                if (blank($achv->{$col}) && filled($item[$col] ?? null)) {
                    $fill[$col] = $item[$col];
                }
            }

            if ($fill) {
                $achv->update($fill);
            }
        }
    }

    public function run(): void
    {
        self::seedIfEmpty();
    }
}