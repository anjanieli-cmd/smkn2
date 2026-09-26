<?php

namespace Database\Seeders;

use App\Enums\AlumniStatus;
use App\Enums\ChatbotKnowledgeStatus;
use App\Enums\EVoiceCategory;
use App\Enums\EVoiceStatus;
use App\Enums\FactCheckStatus;
use App\Enums\JobVacancyStatus;
use App\Enums\PublicationStatus;
use App\Models\Alumni;
use App\Models\ChatbotKnowledge;
use App\Models\EVoice;
use App\Models\Extracurricular;
use App\Models\ExtracurricularOption;
use App\Models\ExtracurricularQuestion;
use App\Models\FactCheck;
use App\Models\IndustryPartnership;
use App\Models\JobVacancy;
use App\Models\Major;
use App\Models\NewsArticle;
use App\Models\Portfolio;
use App\Models\SchoolProfile;
use App\Models\StudentWork;
use App\Models\TeacherStaff;
use App\Models\TourLocation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. School Profiles
        SchoolProfile::create([
            'key' => 'general',
            'content' => [
                'name' => 'SMK Negeri 2 Mojokerto',
                'address' => 'Jl. Raden Wijaya No. 1, Kranggan, Kota Mojokerto, Jawa Timur',
                'phone' => '(0321) 321555',
                'email' => 'info@smkn2mojokerto.sch.id',
                'vision' => 'Menjadi Sekolah Menengah Kejuruan yang Unggul, Berkarakter, dan Berdaya Saing Global.',
                'mission' => [
                    'Menyelenggarakan pendidikan kejuruan berkualitas berstandar industri.',
                    'Membentuk karakter peserta didik yang beriman, bertaqwa, dan berakhlak mulia.',
                    'Meningkatkan kemitraan strategis dengan Dunia Usaha dan Dunia Industri (DUDI).',
                ],
            ],
        ]);

        // 2. Majors (APHP, DKV, KULINER, LPS, RPL)
        $rpl = Major::create([
            'code' => 'RPL',
            'name' => 'Rekayasa Perangkat Lunak',
            'slug' => 'rekayasa-perangkat-lunak',
            'description' => 'Konsentrasi keahlian pemrograman web, mobile, dan pengembangan software.',
        ]);

        $dkv = Major::create([
            'code' => 'DKV',
            'name' => 'Desain Komunikasi Visual',
            'slug' => 'desain-komunikasi-visual',
            'description' => 'Fokus pada grafis, ilustrasi, animasi, videografi, dan desain kreatif.',
        ]);

        $aphp = Major::create([
            'code' => 'APHP',
            'name' => 'Agribisnis Pengolahan Hasil Pertanian',
            'slug' => 'agribisnis-pengolahan-hasil-pertanian',
            'description' => 'Inovasi pengolahan hasil pertanian dan pangan modern.',
        ]);

        $kuliner = Major::create([
            'code' => 'KULINER',
            'name' => 'Kuliner',
            'slug' => 'kuliner',
            'description' => 'Seni tata boga, manajemen kuliner, dan tata hidang profesional.',
        ]);

        $lps = Major::create([
            'code' => 'LPS',
            'name' => 'Layanan Perbankan Syariah',
            'slug' => 'layanan-perbankan-syariah',
            'description' => 'Manajemen keuangan syariah dan administrasi perbankan.',
        ]);

        // 3. Extracurriculars & Organizations (Exact from Website Frontend)
        $pramuka = Extracurricular::create(['name' => 'Pramuka', 'slug' => 'pramuka', 'category' => 'Kepanduan', 'description' => 'Membentuk kemandirian, kepemimpinan, kepedulian lingkungan, dan keterampilan melalui kegiatan kepanduan.']);
        $paskibra = Extracurricular::create(['name' => 'Paskib', 'slug' => 'paskib', 'category' => 'Kedisiplinan', 'description' => 'Membentuk kedisiplinan, keteguhan, tanggung jawab, dan kekompakan melalui latihan baris-berbaris.']);
        $robotik = Extracurricular::create(['name' => 'Robotik & Coding Club', 'slug' => 'robotik-coding-club', 'category' => 'Teknologi', 'description' => 'Pengembangan minat bakat di bidang mikrokontroler, IoT, perakitan robot, dan pemrograman.']);
        $banjari = Extracurricular::create(['name' => 'Banjari', 'slug' => 'banjari', 'category' => 'Keagamaan', 'description' => 'Mengembangkan seni musik Islami melalui lantunan shalawat, kekompakan, dan penampilan dalam kegiatan sekolah.']);
        $basket = Extracurricular::create(['name' => 'Basket', 'slug' => 'basket', 'category' => 'Olahraga', 'description' => 'Melatih teknik permainan, kebugaran, sportivitas, dan kerja sama tim melalui latihan serta pertandingan pelajar.']);
        $voli = Extracurricular::create(['name' => 'Bola Voli', 'slug' => 'bola-voli', 'category' => 'Olahraga', 'description' => 'Membangun kekompakan tim melalui latihan teknik dasar, strategi permainan, dan kompetisi antarpelajar.']);
        $btq = Extracurricular::create(['name' => 'BTQ', 'slug' => 'btq', 'category' => 'Keagamaan', 'description' => 'Meningkatkan kemampuan membaca Al-Qur’an dengan baik serta membangun kebiasaan belajar agama secara rutin.']);
        $futsal = Extracurricular::create(['name' => 'Futsal', 'slug' => 'futsal', 'category' => 'Olahraga', 'description' => 'Mengasah kecepatan, strategi, disiplin, dan kerja sama tim melalui latihan futsal dan pertandingan pelajar.']);
        $jurnalistik = Extracurricular::create(['name' => 'Jurnalistik', 'slug' => 'jurnalistik', 'category' => 'Media & Literasi', 'description' => 'Menjadi ruang bagi siswa untuk menulis, meliput kegiatan sekolah, mengolah informasi, dan menghasilkan karya media.']);
        $tari = Extracurricular::create(['name' => 'Tari', 'slug' => 'tari', 'category' => 'Seni & Budaya', 'description' => 'Melestarikan budaya melalui tari tradisional dan kreasi serta memberikan ruang untuk tampil dan berkarya.']);
        $pena = Extracurricular::create(['name' => 'PENA', 'slug' => 'pena', 'category' => 'Seni & Budaya', 'description' => 'Wadah mini teater untuk melatih ekspresi, kepercayaan diri, penulisan naskah, dan kemampuan tampil di depan publik.']);
        $silat = Extracurricular::create(['name' => 'Silat', 'slug' => 'silat', 'category' => 'Bela Diri', 'description' => 'Melatih bela diri, ketahanan fisik, kedisiplinan, dan sikap percaya diri melalui latihan pencak silat.']);
        $pmr = Extracurricular::create(['name' => 'PMR', 'slug' => 'pmr', 'category' => 'Kesehatan', 'description' => 'Membekali siswa dengan kepedulian kemanusiaan, pertolongan pertama, dan kesiapsiagaan dalam kegiatan sekolah.']);
        $pikr = Extracurricular::create(['name' => 'PIK-R', 'slug' => 'pik-r', 'category' => 'Kesehatan', 'description' => 'Menjadi ruang edukasi dan konseling sebaya untuk membangun remaja yang sehat, bertanggung jawab, dan berencana.']);
        $osis = Extracurricular::create(['name' => 'OSIS', 'slug' => 'osis', 'category' => 'Organisasi', 'description' => 'Wadah utama kepemimpinan siswa untuk merancang dan menjalankan berbagai program kegiatan sekolah.']);
        $lacurva = Extracurricular::create(['name' => 'Lacurva', 'slug' => 'lacurva', 'category' => 'Organisasi', 'description' => 'Komunitas suporter Skaneda yang membangun semangat, kreativitas, dan dukungan positif untuk kegiatan serta prestasi siswa.']);
        $pasus = Extracurricular::create(['name' => 'Pasus', 'slug' => 'pasus', 'category' => 'Organisasi', 'description' => 'Organisasi siswa yang menumbuhkan kedisiplinan, tanggung jawab, kekompakan, dan kesiapan membantu kegiatan sekolah.']);

        // 4. Extracurricular Matchmaker Quiz
        $q1 = ExtracurricularQuestion::create([
            'question_text' => 'Apa kegiatan yang paling kamu sukai di waktu luang?',
            'order' => 1,
        ]);

        ExtracurricularOption::create([
            'question_id' => $q1->id,
            'option_text' => 'Merakit elektronik atau membuat program komputer',
            'extracurricular_scores' => ['Robotik & Coding Club' => 10, 'Pramuka' => 2],
        ]);

        ExtracurricularOption::create([
            'question_id' => $q1->id,
            'option_text' => 'Melatih kedisiplinan dan kegiatan fisik berbaris',
            'extracurricular_scores' => ['Paskib' => 10, 'Pramuka' => 5],
        ]);

        // 5. Teacher & Staff (All entries matching user page)
        $teachersData = [
            ['name' => 'Iswahyudi, S.ST.', 'nip' => 'SKN-001-G', 'role_position' => 'Kepala Sekolah', 'photo_url' => 'images/guru/iswahyudi.png'],
            ['name' => 'Dra. Lugiati', 'nip' => 'SKN-002-G', 'role_position' => 'Guru Produktif Kuliner', 'photo_url' => 'images/guru/lugiati.png'],
            ['name' => 'Sri Mulyati, S.Pd.', 'nip' => 'SKN-003-G', 'role_position' => 'Guru Normatif Pendidikan Pancasila', 'photo_url' => 'images/guru/srimul.png'],
            ['name' => 'Harjo Santoso, S.Pd.', 'nip' => 'SKN-004-G', 'role_position' => 'Guru Normatif PJOK', 'photo_url' => 'images/guru/harjo.png'],
            ['name' => 'Endah Trapsilawati Nawangsih, S.Pd.', 'nip' => 'SKN-005-G', 'role_position' => 'Guru Produktif Kuliner', 'photo_url' => 'images/guru/endah.png'],
            ['name' => 'Ainur Rofik, M.Pd., Si', 'nip' => 'SKN-006-G', 'role_position' => 'Guru Normatif IPAS', 'photo_url' => 'images/guru/rofik.png'],
            ['name' => 'Liawanti Gestika Ardiyana, S.Pi.', 'nip' => 'SKN-007-G', 'role_position' => 'Guru Produktif APHP', 'photo_url' => 'images/guru/liawanti.png'],
            ['name' => 'Sri Andrijanti, S.Pd.', 'nip' => 'SKN-008-G', 'role_position' => 'Guru Produktif Kuliner', 'photo_url' => 'images/guru/andri.png'],
            ['name' => 'Nurul Hidayah, S.E.', 'nip' => 'SKN-009-G', 'role_position' => 'Guru Normatif Pendidikan Pancasila', 'photo_url' => 'images/guru/nurul.png'],
            ['name' => 'Rudik Sanjaya Sugiarto, SS.,MBA.', 'nip' => 'SKN-010-G', 'role_position' => 'Guru Normatif Bahasa Inggris', 'photo_url' => 'images/guru/rudik.png'],
            ['name' => 'Indira Kusumaning Fuadah, S.Pd.', 'nip' => 'SKN-011-G', 'role_position' => 'Guru Normatif Informatika', 'photo_url' => 'images/guru/indira.png'],
            ['name' => 'Arikaweku Ckrisna, S. Pd., M.Pd.', 'nip' => 'SKN-012-G', 'role_position' => 'Guru Produktif LPS', 'photo_url' => 'images/guru/arikaweku.png'],
            ['name' => 'Leni Kristiana Dewi, S.T.', 'nip' => 'SKN-013-G', 'role_position' => 'Guru Produktif RPL', 'photo_url' => 'images/guru/leni.png'],
            ['name' => 'Supriati, S.Kom.', 'nip' => 'SKN-014-G', 'role_position' => 'Guru Produktif RPL', 'photo_url' => 'images/guru/supriati.png'],
            ['name' => 'Mochammad Arsori, S.Pd.', 'nip' => 'SKN-015-G', 'role_position' => 'Guru Normatif Bahasa Indonesia', 'photo_url' => 'images/guru/asrori.png'],
            ['name' => 'Rahmat Efendi, S.Pd.', 'nip' => 'SKN-016-G', 'role_position' => 'Guru Normatif Bahasa Indonesia', 'photo_url' => 'images/guru/rahmat.png'],
            ['name' => 'Sumber Arum', 'nip' => 'SKN-018-S', 'role_position' => 'Staff Kebersihan', 'photo_url' => 'images/guru/sumber.png'],
            ['name' => 'Suyanto', 'nip' => 'SKN-019-S', 'role_position' => 'Staff Kebersihan', 'photo_url' => 'images/guru/suyanto.png'],
            ['name' => 'Tria Ayu Anggraini', 'nip' => 'SKN-020-S', 'role_position' => 'Staff Tata Usaha', 'photo_url' => 'images/guru/tria.png'],
        ];

        foreach ($teachersData as $t) {
            TeacherStaff::create(array_merge($t, ['is_active' => true]));
        }

        // 5b. News Articles (Matching User Berita Page)
        $newsArticles = [
            ['title' => 'Uji Kompetensi Keahlian (UKK) Jurusan APHP', 'slug' => 'ukk-jurusan-aphp', 'category' => 'kegiatan', 'summary' => 'Melaksanakan kegiatan Uji Kompetensi Keahlian (UKK) pada jurusan Agribisnis Pengolahan Hasil Pertanian (APHP) dengan melakukan praktik pembuatan produk roti.', 'content' => 'Melaksanakan kegiatan Uji Kompetensi Keahlian (UKK) pada jurusan Agribisnis Pengolahan Hasil Pertanian (APHP) dengan melakukan praktik pembuatan produk roti.', 'image_url' => 'images/berita/ukk-aphp.jpeg'],
            ['title' => 'Uji Kompetensi Keahlian (UKK) Jurusan DKV', 'slug' => 'ukk-jurusan-dkv', 'category' => 'kegiatan', 'summary' => 'Melaksanakan kegiatan Uji Kompetensi Keahlian (UKK) pada jurusan Desain Komunikasi Visual (DKV) dengan membuat dan menampilkan cosplay berdasarkan karakter yang disukai.', 'content' => 'Melaksanakan kegiatan Uji Kompetensi Keahlian (UKK) pada jurusan Desain Komunikasi Visual (DKV) dengan membuat dan menampilkan cosplay berdasarkan karakter yang disukai.', 'image_url' => 'images/berita/ukk-dkv.jpeg'],
            ['title' => 'Uji Kompetensi Keahlian (UKK) Jurusan Kuliner', 'slug' => 'ukk-jurusan-kuliner', 'category' => 'kegiatan', 'summary' => 'Melaksanakan kegiatan Uji Kompetensi Keahlian (UKK) pada jurusan Kuliner dengan melakukan praktik pengolahan dan penyajian makanan.', 'content' => 'Melaksanakan kegiatan Uji Kompetensi Keahlian (UKK) pada jurusan Kuliner dengan melakukan praktik pengolahan dan penyajikan makanan.', 'image_url' => 'images/berita/ukk-kuliner.jpeg'],
            ['title' => 'Uji Kompetensi Keahlian (UKK) Jurusan LPS', 'slug' => 'ukk-jurusan-lps', 'category' => 'kegiatan', 'summary' => 'Melaksanakan kegiatan Uji Kompetensi Keahlian (UKK) pada jurusan Layanan Perbankan Syariah (LPS) dengan melakukan praktik yang berkaitan dengan pelayanan di bidang perbankan.', 'content' => 'Melaksanakan kegiatan Uji Kompetensi Keahlian (UKK) pada jurusan Layanan Perbankan Syariah (LPS) dengan melakukan praktik yang berkaitan dengan pelayanan di bidang perbankan.', 'image_url' => 'images/berita/ukk-lps.jpeg'],
            ['title' => 'Sukses! Rekayasa Perangkat Lunak (RPL) SMK Negeri 2 Mojokerto Laksanakan Uji Kompetensi Keahlian', 'slug' => 'ukk-jurusan-rpl', 'category' => 'kegiatan', 'summary' => 'Kegiatan Uji Kompetensi Kelulusan Kompetensi Keahlian Rekayasa Perangkat Lunak (RPL) dilaksanakan pada 18–20 Februari 2025.', 'content' => 'Kegiatan Uji Kompetensi Kelulusan Kompetensi Keahlian Rekayasa Perangkat Lunak (RPL) dilaksanakan pada 18–20 Februari 2025 dan diikuti oleh siswa kelas XII RPL SMK Negeri 2 Mojokerto.', 'image_url' => 'images/berita/ukk-rpl.jpeg'],
            ['title' => 'P5: Praktik Simulasi Pernikahan', 'slug' => 'p5-simulasi-pernikahan', 'category' => 'kegiatan', 'summary' => 'Melaksanakan kegiatan Projek Penguatan Profil Pelajar Pancasila (P5) melalui praktik simulasi pernikahan yang dilakukan oleh siswa kelas XI.', 'content' => 'Melaksanakan kegiatan Projek Penguatan Profil Pelajar Pancasila (P5) melalui praktik simulasi pernikahan yang dilakukan oleh siswa kelas XI.', 'image_url' => 'images/berita/nikah.jpeg'],
            ['title' => 'Paduan Suara Skaneda', 'slug' => 'paduan-suara-skaneda', 'category' => 'kegiatan', 'summary' => 'Melaksanakan kegiatan paduan suara yang diikuti oleh seluruh angkatan sebagai bagian dari kegiatan sekolah.', 'content' => 'Melaksanakan kegiatan paduan suara yang diikuti oleh seluruh angkatan sebagai bagian dari kegiatan sekolah.', 'image_url' => 'images/berita/padus.jpeg'],
            ['title' => 'SMKN 2 Mojokerto Jadi Tuan Rumah Pelatihan Pembelajaran Mendalam Batch 2', 'slug' => 'tuan-rumah-pelatihan-pembelajaran-mendalam', 'category' => 'akademik', 'summary' => 'Pelatihan Pembelajaran Mendalam bagi Guru Jenjang SMK Batch 2 dilaksanakan selama enam hari di Aula SMK Negeri 2 Mojokerto.', 'content' => 'Pelatihan Pembelajaran Mendalam bagi Guru Jenjang SMK Batch 2 dilaksanakan selama enam hari, mulai tanggal 11 hingga 16 Agustus 2025, bertempat di Aula SMK Negeri 2 Mojokerto.', 'image_url' => 'images/berita/tuan-rumah.jpeg'],
            ['title' => 'Sosialisasi Genre Goes To School Ciptakan Harmonisasi di Kalangan Siswa', 'slug' => 'sosialisasi-genre-goes-to-school', 'category' => 'kegiatan', 'summary' => 'Kegiatan Sosialisasi Genre Goes To School dilaksanakan di Aula SMK Negeri 2 Mojokerto pada Rabu, 6 Agustus 2025.', 'content' => 'Kegiatan Sosialisasi Genre Goes To School dilaksanakan di Aula SMK Negeri 2 Mojokerto pada Rabu, 6 Agustus 2025.', 'image_url' => 'images/berita/genre.jpeg'],
            ['title' => 'SMK Negeri 2 Mojokerto Sukses Laksanakan Rekrutmen Toko Emas Wahyu Redjo', 'slug' => 'rekrutmen-wahyu-redjo', 'category' => 'sekolah', 'summary' => 'Kegiatan Rekrutmen Pramuniaga Toko Emas Wahyu Redjo dilaksanakan bekerja sama dengan BKK SMK Negeri 2 Mojokerto.', 'content' => 'Kegiatan Rekrutmen Pramuniaga Toko Emas Wahyu Redjo dilaksanakan bekerja sama dengan BKK SMK Negeri 2 Mojokerto pada Rabu, 23 Juli 2025.', 'image_url' => 'images/berita/wahyu-redjo.jpeg'],
            ['title' => 'LPS SMKN 2 Mojokerto Gelar Literasi Keuangan Bersama FIF Group', 'slug' => 'literasi-keuangan-fif-group', 'category' => 'akademik', 'summary' => 'Literasi Keuangan dan Edukasi Pembiayaan bersama FIF Group dilaksanakan oleh jurusan Layanan Perbankan Syariah (LPS).', 'content' => 'Kegiatan Literasi Keuangan dan Edukasi Pembiayaan bersama FIF Group dilaksanakan oleh jurusan Layanan Perbankan Syariah (LPS) SMK Negeri 2 Mojokerto pada Kamis, 24 Juli 2025.', 'image_url' => 'images/berita/literasikeuangan.jpeg'],
            ['title' => 'RPL SMKN 2 Mojokerto Gelar Pelatihan Web dengan Framework Laravel', 'slug' => 'pelatihan-web-laravel-rpl', 'category' => 'akademik', 'summary' => 'Pelatihan Web dengan Framework Laravel dilaksanakan pada September 2024 dan diikuti oleh 37 perwakilan siswa kelas XII.', 'content' => 'Kegiatan Pelatihan Web dengan Framework Laravel dilaksanakan pada September 2024 dan diikuti oleh 37 perwakilan siswa kelas XII SMK Negeri 2 Mojokerto.', 'image_url' => 'images/berita/pelatihan-web.jpeg'],
        ];

        foreach ($newsArticles as $n) {
            NewsArticle::create(array_merge($n, [
                'author_name' => 'Tim Humas SKANEDA',
                'status' => 'PUBLISHED',
                'published_at' => now(),
            ]));
        }

        // 5c. Student Works (Matching User Karya Siswa Page)
        $studentWorksData = [
            ['title' => 'MultiMie', 'student_name' => 'Tim APHP Angkatan 2023', 'major_id' => $aphp->id, 'description' => 'Mi instan praktis dengan bumbu siap seduh — produk inovasi siswa APHP.', 'media_url' => 'images/karya/multimie.jpeg'],
            ['title' => 'Aplikasi Tambal Ban Express', 'student_name' => 'Kelas XII RPL', 'major_id' => $rpl->id, 'description' => 'Mengembangkan aplikasi layanan tambal ban berbasis web untuk memudahkan pemesanan dan pelayanan secara cepat dan praktis.', 'media_url' => 'images/karya/tambalbanexpres.jpeg'],
            ['title' => 'Sari Bunga Telang', 'student_name' => 'Kelas XII APHP', 'major_id' => $aphp->id, 'description' => 'Minuman herbal alami dari ekstrak bunga telang dengan warna biru khas dan cita rasa menyegarkan — inovasi olahan kreatif siswa APHP.', 'media_url' => 'images/karya/bungatelang.jpeg'],
            ['title' => 'Pastry & Bakery Kreatif', 'student_name' => 'Kelas XI Kuliner', 'major_id' => $kuliner->id, 'description' => 'Pembuatan aneka kue dan roti dengan teknik dan resep pastry yang tepat, tampil cantik dan lezat.', 'media_url' => 'images/karya/pastry-kuliner.jpeg'],
            ['title' => 'Nirmana 3D', 'student_name' => 'Kelas XII DKV', 'major_id' => $dkv->id, 'description' => 'Mengeksplorasi bentuk, ruang, tekstur, dan komposisi untuk menghasilkan karya tiga dimensi yang harmonis dan menarik.', 'media_url' => 'images/karya/nirmana.jpeg'],
            ['title' => 'Maja Mojo', 'student_name' => 'Tim RPL', 'major_id' => $rpl->id, 'description' => 'Minuman olahan berbahan dasar buah mojo dengan cita rasa unik, inovasi kreatif siswa RPL dalam memanfaatkan bahan pangan lokal.', 'media_url' => 'images/karya/estrakbuahmojo.jpeg'],
            ['title' => 'Produk Olahan Hasil Pertanian', 'student_name' => 'APHP', 'major_id' => $aphp->id, 'description' => 'Mengolah bahan pangan menjadi berbagai produk roti bernilai tambah — dari roti manis, roti isi, hingga kreasi roti inovatif.', 'media_url' => 'images/karya/vocamo.png'],
            ['title' => 'Bei Mie', 'student_name' => 'Kelas XI Kuliner', 'major_id' => $kuliner->id, 'description' => 'Mie unik berbahan dasar daun murbei yang alami dan kaya manfaat, perpaduan cita rasa lezat dengan pilihan yang lebih sehat.', 'media_url' => 'images/karya/bei-mie.jpeg'],
        ];

        foreach ($studentWorksData as $sw) {
            StudentWork::create(array_merge($sw, ['status' => 'PUBLISHED']));
        }

        // 6. Industry Partnerships & DUDI
        IndustryPartnership::create([
            'company_name' => 'PT Telkom Indonesia (Persero) Tbk',
            'field_of_work' => 'Telekomunikasi & IT',
            'partnership_scope' => 'Praktek Kerja Lapangan (PKL), Kelas Industri, Penyaluran Lulusan',
            'is_active' => true,
        ]);

        IndustryPartnership::create([
            'company_name' => 'PT Astra International Tbk',
            'field_of_work' => 'Otomotif & Manufaktur',
            'partnership_scope' => 'Beasiswa & Rekrutmen Alumni',
            'is_active' => true,
        ]);

        IndustryPartnership::create([
            'company_name' => 'Bank Syariah Indonesia (BSI)',
            'field_of_work' => 'Perbankan Syariah',
            'partnership_scope' => 'Laboratorium Bank Mini Syariah & Magang LPS',
            'is_active' => true,
        ]);

        IndustryPartnership::create([
            'company_name' => 'PT Surabaya Autocomp Indonesia (SAI)',
            'field_of_work' => 'Manufaktur Kabel Otomotif',
            'partnership_scope' => 'Rekrutmen Lulusan & PKL',
            'is_active' => true,
        ]);

        IndustryPartnership::create([
            'company_name' => 'PT Pesta Pora Abadi (Mie Gacoan)',
            'field_of_work' => 'Food & Beverage',
            'partnership_scope' => 'Rekrutmen Alumni Kuliner & Penyaluran Kerja',
            'is_active' => true,
        ]);

        // 6b. Job Vacancies (Matching BKK & Loker Page)
        $jobsData = [
            ['title' => 'Rekrutmen Operator Produksi', 'company_name' => 'PT Surabaya Autocomp Indonesia (SAI)', 'location' => 'Mojokerto', 'description' => 'BKK memfasilitasi seleksi alumni dan masyarakat umum melalui tahapan administrasi, tes, wawancara, dan kesehatan.'],
            ['title' => 'Sosialisasi & Rekrutmen Bank Syariah', 'company_name' => 'BTPN Syariah', 'location' => 'Mojokerto', 'description' => 'Terdokumentasi sebagai kegiatan rekrutmen dan sosialisasi BKK.'],
            ['title' => 'Rekrutmen Crew Restaurant', 'company_name' => 'PT Pesta Pora Abadi (Mie Gacoan)', 'location' => 'Mojokerto', 'description' => 'Rekrutmen tercatat pada Desember 2023 dan Mei 2024 sebagai bagian dari kegiatan penyaluran kerja melalui BKK.'],
            ['title' => 'Rekrutmen Ritel Supermarket', 'company_name' => 'PT Lion Superindo & PT Sumber Alfaria Trijaya Tbk', 'location' => 'Jawa Timur', 'description' => 'PT Lion Superindo tercatat melakukan rekrutmen melalui online. PT Sumber Alfaria Trijaya Tbk tercatat dalam pengajuan kerja sama rekrutmen.'],
            ['title' => 'Rekrutmen Pramuniaga', 'company_name' => 'Toko Emas Wahyu Redjo', 'location' => 'Mojokerto', 'description' => 'Rekrutmen Pramuniaga di SMK Negeri 2 Mojokerto. Kegiatan diikuti 131 siswa kelas XII dan difasilitasi bersama BKK sekolah.'],
            ['title' => 'Walk-in Interview Server, Cook, Barista', 'company_name' => 'Tong Tji', 'location' => 'SMKN 2 Mojokerto', 'description' => 'Walk-in Interview di SMKN 2 Mojokerto untuk posisi Server, Cook, dan Barista. Minimal SMA/SMK sederajat; fresh graduate dipersilakan.'],
            ['title' => 'Walk-in Interview Operational Staff', 'company_name' => 'Dea Bakery', 'location' => 'Kota Mojokerto', 'description' => 'Walk-in Interview pukul 09.00–15.00 WIB di SMKN 2 Kota Mojokerto.'],
            ['title' => 'Program Magang & Part-time', 'company_name' => 'PT Pendekar Bodoh (D\'Cost Seafood)', 'location' => 'Mojokerto', 'description' => 'Program Magang & Part-time bersama BKK SMK Negeri 2 Mojokerto.'],
            ['title' => 'Sosialisasi & Rekrutmen Industri', 'company_name' => 'Jotun', 'location' => 'Mojokerto', 'description' => 'Sosialisasi dan rekrutmen kerja yang terdokumentasi pada arsip BKK.'],
            ['title' => 'School Hiring Cooker & Video Editor', 'company_name' => 'PT Motasa Indonesia', 'location' => 'Mojokerto', 'description' => 'School Hiring dengan posisi Cooker dan Video Editor, penempatan Mojokerto, Jawa Timur.'],
            ['title' => 'Direct Sales Agent - Career Day', 'company_name' => 'XLSMART Career Day', 'location' => 'Aula SMKN 2 Mojokerto', 'description' => 'Posisi Direct Sales Agent di Aula SMKN 2 Mojokerto.'],
        ];

        foreach ($jobsData as $job) {
            JobVacancy::create(array_merge($job, ['status' => 'ACTIVE']));
        }

        // 7. Chatbot Knowledge Base (Comprehensive School Information)
        ChatbotKnowledge::create([
            'title' => 'Alamat dan Kontak Resmi Sekolah',
            'category' => 'Profil',
            'content' => 'SMK Negeri 2 Mojokerto beralamat di Jl. Raden Wijaya No. 1, Kranggan, Kota Mojokerto, Jawa Timur. Telepon: (0321) 321555, Email: info@smkn2mojokerto.sch.id, Website: https://smkn2mojokerto.sch.id.',
            'keywords' => ['alamat', 'lokasi', 'telepon', 'kontak', 'email', 'website', 'dimana', 'peta'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 10,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Visi dan Misi SMKN 2 Mojokerto',
            'category' => 'Profil',
            'content' => 'Visi: Menjadi Sekolah Menengah Kejuruan yang Unggul, Berkarakter, dan Berdaya Saing Global. Misi: 1. Menyelenggarakan pendidikan kejuruan berkualitas berstandar industri. 2. Membentuk karakter peserta didik beriman, bertaqwa, dan berakhlak mulia. 3. Meningkatkan kemitraan strategis dengan DUDI.',
            'keywords' => ['visi', 'misi', 'tujuan', 'motto', 'prinsip'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 10,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Kepala Sekolah dan Kepemimpinan SMKN 2 Mojokerto',
            'category' => 'Profil',
            'content' => 'Kepala SMK Negeri 2 Mojokerto saat ini adalah Bapak Drs. Iswahyudi, M.Pd. Beliau memimpin SMKN 2 Mojokerto dalam mewujudkan sekolah kejuruan yang unggul, berkarakter, dan berdaya saing global.',
            'keywords' => ['kepsek', 'kepala sekolah', 'iswahyudi', 'pak iswahyudi', 'bapak iswahyudi', 'pemimpin', 'pimpinan'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 10,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Sejarah Singkat SMKN 2 Mojokerto',
            'category' => 'Profil',
            'content' => 'SMK Negeri 2 Mojokerto didirikan untuk mencetak tenaga kerja terampil dan profesional di Kota Mojokerto dan sekitarnya. Berdiri di kawasan strategis Kranggan, sekolah ini berkembang pesat menjadi SMK Pusat Keunggulan (PK) dengan 5 konsentrasi keahlian berstandar nasional dan internasional.',
            'keywords' => ['sejarah', 'berdiri', 'pendirian', 'latar belakang', 'sejak'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 8,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Daftar Jurusan dan Konsentrasi Keahlian',
            'category' => 'Jurusan',
            'content' => 'SMK Negeri 2 Mojokerto memiliki 5 konsentrasi keahlian unggulan: 1. Rekayasa Perangkat Lunak (RPL) - Pemrograman Web/Mobile & Software. 2. Desain Komunikasi Visual (DKV) - Grafis, Multimedia, Animasi & Fotografi. 3. Agribisnis Pengolahan Hasil Pertanian (APHP) - Pangan Modern. 4. Kuliner (Tata Boga) - Seni Olah Rasa & Manajemen Restoran. 5. Layanan Perbankan Syariah (LPS) - Keuangan Syariah & Bank Mini.',
            'keywords' => ['jurusan', 'keahlian', 'konsentrasi', 'kompetensi', 'proli', 'rpl', 'dkv', 'aphp', 'kuliner', 'lps', 'berapa', 'apa saja'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 10,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Fasilitas dan Sarana Prasarana Sekolah',
            'category' => 'Fasilitas',
            'content' => 'SMKN 2 Mojokerto dilengkapi fasilitas modern: Laboratorium Komputer RPL High-Spec, Studio DKV & Fotografi, Lab Pengolahan Pangan APHP, Commercial Kitchen & Restaurant Kuliner, Bank Mini Syariah LPS, Perpustakaan Digital, Musala, UKS, Lapangan Olahraga, dan Akses Free High-Speed WiFi di seluruh area sekolah.',
            'keywords' => ['fasilitas', 'sarana', 'prasarana', 'lab', 'laboratorium', 'studio', 'perpustakaan', 'wifi', 'musala', 'musholla', 'uks', 'lapangan'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 9,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Jam Belajar dan Operational Sekolah',
            'category' => 'Tata Tertib',
            'content' => 'Kegiatan Belajar Mengajar (KBM) di SMKN 2 Mojokerto berlangsung hari Senin hingga Jumat pukul 07.00 WIB - 15.30 WIB. Gerbang sekolah ditutup tepat pukul 07.00 WIB. Hari Sabtu dan Minggu libur.',
            'keywords' => ['jam', 'waktu', 'jadwal', 'masuk', 'pulang', 'belajar', 'operasional'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 9,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Kegiatan Ekstrakurikuler dan Organisasi Siswa',
            'category' => 'Ekstrakurikuler',
            'content' => 'SMKN 2 Mojokerto memiliki 13 Ekstrakurikuler (Banjari, Basket, Bola Voli, BTQ, Futsal, Jurnalistik, Paskib, Pramuka, Tari, PENA, Silat, PMR, PIK-R) dan 3 Organisasi Siswa (OSIS, Lacurva, Pasus).',
            'keywords' => ['ekskul', 'ekstrakurikuler', 'kegiatan', 'organisasi', 'wadah'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 9,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Bursa Kerja Khusus (BKK) dan Kemitraan Industri',
            'category' => 'Karir',
            'content' => 'Unit BKK SMKN 2 Mojokerto aktif memfasilitasi Praktek Kerja Lapangan (PKL) dan penyaluran kerja alumni ke perusahaan mitra seperti PT Telkom Indonesia, PT Astra International, Bank Syariah Indonesia, serta industri pangan & perhotelan ternama.',
            'keywords' => ['bkk', 'dudi', 'industri', 'kemitraan', 'magang', 'pkl', 'kerja', 'karir', 'lulusan', 'perusahaan', 'mitra'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 9,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Informasi PPDB 2026',
            'category' => 'PPDB',
            'content' => 'Pendaftaran PPDB SMKN 2 Mojokerto dilakukan secara online melalui portal resmi PPDB Jawa Timur. Jalur pendaftaran meliputi jalur prestasi, afirmasi, dan zonasi. Pendaftaran TIDAK DIPUNGUT BIAYA (GRATIS).',
            'keywords' => ['ppdb', 'daftar', 'pendaftaran', 'syarat', 'masuk', 'biaya', 'jalur'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 10,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Prestasi dan Keunggulan Sekolah',
            'category' => 'Prestasi',
            'content' => 'SMKN 2 Mojokerto meraih berbagai prestasi: Juara LKS Web Technologies & Graphic Design tingkat Jawa Timur, Juara Inovasi Pangan, serta berstatus Sekolah Pusat Keunggulan (PK) dan Sekolah Adiwiyata.',
            'keywords' => ['prestasi', 'juara', 'lks', 'penghargaan', 'pencapaian', 'lomba', 'keunggulan'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 8,
            'published_at' => now(),
        ]);

        // 7b. Detailed Majors Knowledge (RPL, DKV, APHP, Kuliner, LPS)
        ChatbotKnowledge::create([
            'title' => 'Detail Jurusan RPL (Rekayasa Perangkat Lunak)',
            'category' => 'Jurusan',
            'content' => 'Konsentrasi keahlian RPL (Rekayasa Perangkat Lunak) berfokus pada pemrograman web, aplikasi mobile, pengembangan software, basis data, dan UI/UX design. Siswa RPL dibekali keterampilan teknologi terkini (PHP, Laravel, JavaScript, Python, Flutter) serta kesempatan magang di industri TI ternama seperti PT Telkom Indonesia.',
            'keywords' => ['rpl', 'rekayasa perangkat lunak', 'pemrograman', 'coding', 'web', 'mobile', 'software', 'aplikasi'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 9,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Detail Jurusan DKV (Desain Komunikasi Visual)',
            'category' => 'Jurusan',
            'content' => 'Konsentrasi keahlian DKV (Desain Komunikasi Visual) mengasah kreativitas visual siswa di bidang desain grafis, ilustrasi digital, animasi 2D/3D, videografi, fotografi studio, dan branding multimedia. Dilengkapi studio fotografi dan lab multimedia modern.',
            'keywords' => ['dkv', 'desain komunikasi visual', 'desain', 'grafis', 'ilustrasi', 'animasi', 'videografi', 'fotografi', 'gambar'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 9,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Detail Jurusan APHP (Agribisnis Pengolahan Hasil Pertanian)',
            'category' => 'Jurusan',
            'content' => 'Konsentrasi keahlian APHP berfokus pada teknologi pengolahan hasil pertanian menjadi produk pangan higienis, pengawasan mutu pangan, pengemasan modern, serta kewirausahaan produk olahan pangan bernilai jual tinggi.',
            'keywords' => ['aphp', 'agribisnis', 'pengolahan hasil pertanian', 'pangan', 'olahan', 'pertanian', 'makanan'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 9,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Detail Jurusan Kuliner (Tata Boga)',
            'category' => 'Jurusan',
            'content' => 'Konsentrasi keahlian Kuliner (Tata Boga) mempelajari seni olah rasa masakan nusantara dan internasional, manajemen dapur profesional, bakery & pastry, tata hidang (table service), serta pengelolaan restoran dan katering standar hotel.',
            'keywords' => ['kuliner', 'tata boga', 'boga', 'masak', 'dapur', 'bakery', 'pastry', 'restoran', 'katering', 'chef'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 9,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Detail Jurusan LPS (Layanan Perbankan Syariah)',
            'category' => 'Jurusan',
            'content' => 'Konsentrasi keahlian LPS (Layanan Perbankan Syariah) membekali siswa dengan keahlian administrasi keuangan berbasis syariah, akuntansi perbankan, customer service, serta pengelolaan transaksi di Laboratorium Bank Mini Syariah bekerja sama dengan Bank Syariah Indonesia (BSI).',
            'keywords' => ['lps', 'layanan perbankan syariah', 'perbankan', 'syariah', 'bank', 'keuangan', 'teller', 'customer service'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 9,
            'published_at' => now(),
        ]);

        // 7c. Detailed Extracurriculars & Organizations Knowledge (Matching Website Frontend Exact Data)
        ChatbotKnowledge::create([
            'title' => 'Ekstrakurikuler Banjari',
            'category' => 'Ekstrakurikuler',
            'content' => 'Banjari (Keagamaan): Mengembangkan seni musik Islami melalui lantunan shalawat, kekompakan, dan penampilan dalam kegiatan sekolah. Pembina: Pembina kegiatan keagamaan. Latihan: Jumat. Kegiatan: Latihan vokal, rebana, shalawat, dan penampilan sekolah.',
            'keywords' => ['banjari', 'rebana', 'shalawat', 'sholawat', 'hadrah', 'keagamaan'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 9,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Ekstrakurikuler Basket',
            'category' => 'Ekstrakurikuler',
            'content' => 'Basket (Olahraga): Melatih teknik permainan, kebugaran, sportivitas, dan kerja sama tim melalui latihan serta pertandingan pelajar. Pembina: Pembina olahraga sekolah. Latihan: Selasa & Jumat. Kegiatan: Latihan teknik, sparing, dan turnamen pelajar.',
            'keywords' => ['basket', 'bola basket', 'olahraga'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 9,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Ekstrakurikuler Bola Voli',
            'category' => 'Ekstrakurikuler',
            'content' => 'Bola Voli (Olahraga): Membangun kekompakan tim melalui latihan teknik dasar, strategi permainan, dan kompetisi antarpelajar. Pembina: Pembina olahraga sekolah. Latihan: Kamis & Sabtu. Kegiatan: Passing, servis, smash, sparing, dan turnamen.',
            'keywords' => ['voli', 'bola voli', 'volley', 'olahraga'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 9,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Ekstrakurikuler BTQ',
            'category' => 'Ekstrakurikuler',
            'content' => 'BTQ (Keagamaan): Meningkatkan kemampuan membaca Al-Qur’an dengan baik serta membangun kebiasaan belajar agama secara rutin. Pembina: Pembina kegiatan keagamaan. Latihan: Jumat. Kegiatan: Tilawah, tahsin, hafalan, dan pembinaan keagamaan.',
            'keywords' => ['btq', 'baca tulis al quran', 'baca tulis al-qur\'an', 'al-qur\'an', 'alquran', 'tahsin', 'tilawah', 'hafalan'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 9,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Ekstrakurikuler Futsal',
            'category' => 'Ekstrakurikuler',
            'content' => 'Futsal (Olahraga): Mengasah kecepatan, strategi, disiplin, dan kerja sama tim melalui latihan futsal dan pertandingan pelajar. Pembina: Pembina olahraga sekolah. Latihan: Senin & Rabu. Kegiatan: Latihan teknik, sparing, dan turnamen antarsekolah.',
            'keywords' => ['futsal', 'sepak bola', 'bola', 'olahraga'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 9,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Ekstrakurikuler Jurnalistik',
            'category' => 'Ekstrakurikuler',
            'content' => 'Jurnalistik (Media & Literasi): Menjadi ruang bagi siswa untuk menulis, meliput kegiatan sekolah, mengolah informasi, dan menghasilkan karya media. Pembina: Pembina jurnalistik sekolah. Latihan: Rabu. Kegiatan: Menulis berita, wawancara, fotografi, dan publikasi sekolah.',
            'keywords' => ['jurnalistik', 'jurnal', 'pers', 'liputan', 'wawancara', 'media', 'berita'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 9,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Ekstrakurikuler Paskib',
            'category' => 'Ekstrakurikuler',
            'content' => 'Paskib (Kedisiplinan): Membentuk kedisiplinan, keteguhan, tanggung jawab, dan kekompakan melalui latihan baris-berbaris. Pembina: Pembina Paskib sekolah. Latihan: Rabu & Sabtu. Kegiatan: PBB, formasi, upacara, dan kegiatan kebangsaan.',
            'keywords' => ['paskib', 'paskibra', 'baris berbaris', 'pbb', 'pengibar bendera', 'kedisiplinan'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 9,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Ekstrakurikuler Pramuka',
            'category' => 'Ekstrakurikuler',
            'content' => 'Pramuka (Kepanduan): Membentuk kemandirian, kepemimpinan, kepedulian lingkungan, dan keterampilan melalui kegiatan kepanduan. Pembina: Pembina Pramuka sekolah. Latihan: Jumat. Kegiatan: Latihan kepramukaan, kemah, keterampilan, dan kegiatan sosial.',
            'keywords' => ['pramuka', 'kepanduan', 'scout', 'kemah', 'gugus depan', 'skaneda'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 9,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Ekstrakurikuler Tari',
            'category' => 'Ekstrakurikuler',
            'content' => 'Tari (Seni & Budaya): Melestarikan budaya melalui tari tradisional dan kreasi serta memberikan ruang untuk tampil dan berkarya. Pembina: Pembina seni sekolah. Latihan: Rabu & Sabtu. Kegiatan: Latihan tari tradisional, tari kreasi, dan pentas seni.',
            'keywords' => ['tari', 'dance', 'seni tari', 'tari tradisional', 'tari kreasi', 'budaya'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 9,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Ekstrakurikuler PENA',
            'category' => 'Ekstrakurikuler',
            'content' => 'PENA (Seni & Budaya): Wadah mini teater untuk melatih ekspresi, kepercayaan diri, penulisan naskah, dan kemampuan tampil di depan publik. Pembina: Pembina seni dan teater sekolah. Latihan: Kamis. Kegiatan: Latihan akting, olah vokal, naskah, dan pementasan.',
            'keywords' => ['pena', 'teater', 'theater', 'drama', 'akting', 'naskah', 'seni'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 9,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Ekstrakurikuler Silat',
            'category' => 'Ekstrakurikuler',
            'content' => 'Silat (Bela Diri): Melatih bela diri, ketahanan fisik, kedisiplinan, dan sikap percaya diri melalui latihan pencak silat. Pembina: Pembina bela diri sekolah. Latihan: Selasa & Kamis. Kegiatan: Teknik dasar, jurus, sparing, dan kejuaraan.',
            'keywords' => ['silat', 'pencak silat', 'bela diri', 'beladiri'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 9,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Ekstrakurikuler PMR',
            'category' => 'Ekstrakurikuler',
            'content' => 'PMR (Kesehatan): Membekali siswa dengan kepedulian kemanusiaan, pertolongan pertama, dan kesiapsiagaan dalam kegiatan sekolah. Pembina: Pembina PMR sekolah. Latihan: Sabtu. Kegiatan: P3K, kesehatan remaja, kegiatan sosial, dan siaga bencana.',
            'keywords' => ['pmr', 'palang merah remaja', 'p3k', 'kesehatan', 'pertolongan pertama'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 9,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Ekstrakurikuler PIK-R',
            'category' => 'Ekstrakurikuler',
            'content' => 'PIK-R (Kesehatan): Menjadi ruang edukasi dan konseling sebaya untuk membangun remaja yang sehat, bertanggung jawab, dan berencana. Pembina: Pembina PIK-R sekolah. Latihan: Kamis. Kegiatan: Edukasi remaja, konseling sebaya, kampanye kesehatan, dan kegiatan sosial.',
            'keywords' => ['pik-r', 'pikr', 'pik r', 'konseling', 'konseling sebaya', 'kesehatan remaja'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 9,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Organisasi OSIS',
            'category' => 'Organisasi',
            'content' => 'OSIS (Organisasi): Wadah utama kepemimpinan siswa untuk merancang dan menjalankan berbagai program kegiatan sekolah. Pembina: Pembina OSIS sekolah. Latihan/Agenda: Sesuai program kerja. Kegiatan: Program kerja siswa, kegiatan sekolah, kepemimpinan, dan bakti sosial.',
            'keywords' => ['osis', 'organisasi siswa', 'pengurus osis', 'kepemimpinan'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 9,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Organisasi Lacurva',
            'category' => 'Organisasi',
            'content' => 'Lacurva (Organisasi): Komunitas suporter Skaneda yang membangun semangat, kreativitas, dan dukungan positif untuk kegiatan serta prestasi siswa. Pembina: Pembina kegiatan siswa. Latihan/Agenda: Sesuai agenda pertandingan. Kegiatan: Dukungan pertandingan, koreografi, kreativitas suporter, dan solidaritas.',
            'keywords' => ['lacurva', 'la curva', 'suporter', 'supporter', 'ultras', 'skaneda suporter'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 9,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Organisasi Pasus',
            'category' => 'Organisasi',
            'content' => 'Pasus (Organisasi): Organisasi siswa yang menumbuhkan kedisiplinan, tanggung jawab, kekompakan, dan kesiapan membantu kegiatan sekolah. Pembina: Pembina Pasus sekolah. Latihan/Agenda: Sesuai agenda sekolah. Kegiatan: Pengamanan kegiatan, kedisiplinan, ketertiban, dan dukungan acara sekolah.',
            'keywords' => ['pasus', 'pasukan khusus', 'keamanan sekolah', 'ketertiban'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 9,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Ekstrakurikuler Olahraga dan Seni',
            'category' => 'Ekstrakurikuler',
            'content' => 'SMKN 2 Mojokerto memfasilitasi ekskul Futsal, Basket, Voli, Seni Tari Tradisional/Modern, serta Band/Musik dengan lapangan olahraga standar dan pelatih profesional.',
            'keywords' => ['futsal', 'basket', 'voli', 'olahraga', 'seni', 'musik', 'tari', 'band'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 8,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Program Budaya Kawi Laras',
            'category' => 'Budaya',
            'content' => 'Kawi Laras (Kamis Wiwitan Laku Adab Lan Rasa Sayekti) adalah program pembiasaan budaya Jawa setiap Kamis minggu kedua dalam bulan. Seluruh siswa dan guru mengenakan pakaian tradisional Jawa (lurik & kebaya) untuk melestarikan nilai adab, sopan santun, dan rasa mulia.',
            'keywords' => ['kawi laras', 'kawilaras', 'budaya', 'lurik', 'kebaya', 'kamis wiwitan', 'adab', 'jawa'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 8,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Peta Sebaran Alumni SKANEDA',
            'category' => 'Karir',
            'content' => 'Fitur Peta Sebaran Alumni menampilkan pemetaan lokasi kerja, wirausaha, dan perguruan tinggi tempat alumni SMKN 2 Mojokerto berkiprah di seluruh Indonesia dan internasional secara interaktif.',
            'keywords' => ['alumni', 'peta', 'sebaran', 'karir', 'kuliah', 'perusahaan', 'lokasi'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 8,
            'published_at' => now(),
        ]);

        ChatbotKnowledge::create([
            'title' => 'Ekstrakurikuler Matchmaker Quiz',
            'category' => 'Ekstrakurikuler',
            'content' => 'Fitur Matchmaker Quiz membantu siswa baru memilih ekstrakurikuler yang paling sesuai dengan menjawab pertanyaan minat bakat secara otomatis.',
            'keywords' => ['quiz', 'matchmaker', 'cocok', 'pilih ekskul', 'rekomendasi ekskul'],
            'status' => ChatbotKnowledgeStatus::PUBLISHED,
            'is_ai_allowed' => true,
            'priority' => 8,
            'published_at' => now(),
        ]);

        // 8. Alumni & Map Aggregation Data
        Alumni::create([
            'name' => 'Budi Santoso',
            'graduation_year' => 2023,
            'major_id' => $rpl->id,
            'status' => AlumniStatus::WORKING,
            'company' => 'Tokopedia',
            'job_title' => 'Software Engineer',
            'city' => 'Jakarta',
            'country' => 'Indonesia',
            'latitude' => -6.2088,
            'longitude' => 106.8456,
            'publication_status' => PublicationStatus::PUBLISHED,
        ]);

        Alumni::create([
            'name' => 'Siti Nurhaliza',
            'graduation_year' => 2022,
            'major_id' => $dkv->id,
            'status' => AlumniStatus::STUDYING,
            'university' => 'Institut Teknologi Sepuluh Nopember (ITS)',
            'city' => 'Surabaya',
            'country' => 'Indonesia',
            'latitude' => -7.2575,
            'longitude' => 112.7521,
            'publication_status' => PublicationStatus::PUBLISHED,
        ]);

        // 9. FactCheck
        FactCheck::create([
            'title' => 'Klarifikasi Isu Biaya Pendaftaran PPDB',
            'claim' => 'Beredar kabar pendaftaran PPDB SMKN 2 Mojokerto dipungut biaya Rp 500.000.',
            'verdict_explanation' => 'HOAKS. Seluruh proses pendaftaran PPDB SMKN 2 Mojokerto TIDAK DIPUNGUT BIAYA (GRATIS).',
            'status' => FactCheckStatus::FALSE,
            'published_at' => now(),
        ]);

        // 10. E-Voice
        EVoice::create([
            'ticket_code' => 'EV-99A1-2026',
            'title' => 'Penambahan Fasilitas WiFi di Area Perpustakaan',
            'description' => 'Mohon diperkuat jaringan WiFi di lantai 2 perpustakaan agar mendukung riset siswa.',
            'category' => EVoiceCategory::ASPIRASI->value,
            'upvotes_count' => 15,
            'status' => EVoiceStatus::REVIEWING,
        ]);

           $this->call([
       AdminSeeder::class,
   ]);
    }
}
