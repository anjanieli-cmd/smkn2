<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Partner;
use App\Models\RoadmapPhase;
use App\Models\RoadmapPillar;
use Illuminate\Database\Seeder;

/**
 * Mengisi data awal Pengumuman, Logo Partner, dan Roadmap
 * dengan isi yang sama persis seperti teks lama di Blade,
 * jadi tampilan web publik tidak berubah setelah dipindah ke database.
 *
 * Aman dijalankan berulang kali: tabel yang sudah berisi tidak akan ditimpa.
 * (Teks footer / konten umum tidak perlu di-seed, nilai bawaannya ada di SiteSetting::DEFAULTS.)
 */
class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        if (Announcement::count() === 0) {
            $rows = [
                ['fa-bullhorn', 'PPDB 2025/2026 Dibuka — Daftar Sekarang!'],
                ['fa-trophy',   'Juara 1 LKS Provinsi Jawa Timur 2024 — Selamat!'],
                ['fa-calendar', 'Ujian Akhir Semester: 10–20 Juni 2025'],
                ['fa-star',     'Akreditasi A — SMK Negeri 2 Mojokerto'],
            ];
            foreach ($rows as $i => [$icon, $text]) {
                Announcement::create(['icon' => $icon, 'text' => $text, 'is_active' => true, 'order' => $i]);
            }
        }

        if (Partner::count() === 0) {
            $rows = [
                ['Garuda Spark',   'images/partners/garuda-spark.png'],
                ['JHIC 2.0',       'images/partners/jhic.png'],
                ['Jagoan Hosting', 'images/partners/jagoan-hosting.png'],
                ['Ngalup',         'images/partners/ngalup.png'],
                ['Komdigi',        'images/partners/komdigi.png'],
            ];
            foreach ($rows as $i => [$name, $logo]) {
                Partner::create(['name' => $name, 'logo' => $logo, 'is_active' => true, 'order' => $i]);
            }
        }

        if (RoadmapPillar::count() === 0) {
            $rows = [
                ['fa-book-open-reader', 'Mutu Pembelajaran & Kurikulum', 'Kurikulum merdeka yang diselaraskan dengan kebutuhan industri, pembelajaran berbasis proyek nyata, serta asesmen yang mendorong kompetensi dan karakter.'],
                ['fa-laptop-code',      'Digitalisasi Sekolah',          'Layanan administrasi digital, pembelajaran berbasis teknologi, perpustakaan elektronik, serta data terpadu untuk pengambilan keputusan yang lebih baik.'],
                ['fa-handshake',        'Kemitraan DUDI',                'Penguatan teaching factory, magang industri, guru tamu dari praktisi, serta sertifikasi kompetensi bersama dunia usaha dan industri.'],
                ['fa-users-gear',       'Penguatan SDM',                 'Pengembangan profesional guru dan tenaga kependidikan, sertifikasi keahlian, serta budaya belajar sepanjang hayat bagi seluruh warga sekolah.'],
                ['fa-heart',            'Budaya & Karakter',             'Penguatan profil pelajar Pancasila, lingkungan sekolah yang aman dan menyenangkan, serta budaya gotong royong yang menyehatkan.'],
            ];
            foreach ($rows as $i => [$icon, $title, $text]) {
                RoadmapPillar::create(['icon' => $icon, 'title' => $title, 'text' => $text, 'order' => $i]);
            }
        }

        if (RoadmapPhase::count() === 0) {
            $rows = [
                [
                    '2025', 'fa-seedling', 'Fondasi Penguatan',
                    'Memperkuat fondasi layanan pendidikan: tata kelola, mutu pembelajaran, dan kesiapan seluruh warga sekolah menghadapi transformasi.',
                    ['Penyusunan rencana strategis & evaluasi diri sekolah', 'Penguatan kurikulum merdeka di seluruh kompetensi keahlian', 'Peremajaan sarana prasarana pendukung pembelajaran'],
                    'Fondasi', false,
                ],
                [
                    '2026', 'fa-laptop-code', 'Digitalisasi Layanan',
                    'Menghadirkan layanan sekolah berbasis digital yang cepat, transparan, dan mudah diakses oleh peserta didik, orang tua, dan masyarakat.',
                    ['Sistem informasi sekolah terpadu (akademik & administrasi)', 'Perpustakaan digital & pembelajaran berbasis LMS', 'Penerimaan peserta didik baru secara daring'],
                    'Transformasi', false,
                ],
                [
                    '2027', 'fa-handshake', 'Penguatan Kemitraan DUDI',
                    'Menjadikan dunia usaha dan industri sebagai mitra sejati — dari perancangan kurikulum hingga penyerapan lulusan.',
                    ['Teaching factory berjalan di seluruh kompetensi keahlian', 'Magang industri & guru tamu dari praktisi', 'Sertifikasi kompetensi bersama mitra DUDI'],
                    'Kemitraan', false,
                ],
                [
                    '2028', 'fa-trophy', 'Peningkatan Mutu & Prestasi',
                    'Mendorong budaya unggul: prestasi akademik dan non-akademik, inovasi guru, serta capaian kompetensi lulusan yang diakui industri.',
                    ['Pembinaan intensif lomba & kompetisi siswa (LKS, OSN)', 'Sertifikasi keahlian guru & program guru penggerak', 'Kemitraan sekolah & program link and match lanjutan'],
                    'Prestasi', false,
                ],
                [
                    '2029', 'fa-medal', 'Menuju Sekolah Pusat Keunggulan',
                    'Memantapkan posisi sebagai sekolah menengah kejuruan pusat keunggulan dengan layanan, fasilitas, dan hasil yang berstandar nasional.',
                    ['Akreditasi unggul & penjaminan mutu berkelanjutan', 'Fasilitas laboratorium & bengkel berstandar industri', 'Publikasi praktik baik & berbagi ke sekolah lain'],
                    'Keunggulan', false,
                ],
                [
                    '2030', 'fa-star', 'Sekolah Vokasi Rujukan Nasional',
                    'Menjadi sekolah menengah kejuruan rujukan dengan lulusan yang beriman, berkarakter, kompeten, dan mampu bersaing di tingkat nasional maupun internasional.',
                    ['Lulusan terserap industri, berwirausaha, atau lanjut studi', 'Sekolah rujukan & pusat pelatihan vokasi masyarakat', 'Ekosistem vokasi yang berkelanjutan dan inklusif'],
                    'Next chapter', true,
                ],
            ];
            foreach ($rows as $i => [$year, $icon, $title, $text, $items, $tag, $isGoal]) {
                RoadmapPhase::create([
                    'year' => $year, 'icon' => $icon, 'title' => $title, 'text' => $text,
                    'items' => $items, 'tag' => $tag, 'is_goal' => $isGoal, 'order' => $i,
                ]);
            }
        }
    }
}
