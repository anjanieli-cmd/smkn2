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
use App\Models\SchoolProfile;
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

        // 5. Teacher & Staff
        TeacherStaff::create([
            'name' => 'Drs. Iswahyudi, M.Pd.',
            'nip' => '196805121994031005',
            'role_position' => 'Kepala Sekolah',
            'is_active' => true,
        ]);

        TeacherStaff::create([
            'name' => 'Rina Wijaya, S.Kom., M.T.',
            'nip' => '198503152010012011',
            'role_position' => 'Ketua Program Keahlian RPL',
            'is_active' => true,
        ]);

        TeacherStaff::create([
            'name' => 'Bambang Sugiarto, S.Sn.',
            'nip' => '198207202008021003',
            'role_position' => 'Ketua Program Keahlian DKV',
            'is_active' => true,
        ]);

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
    }
}
