<?php

namespace App\Services\Chatbot;

use App\Interfaces\AI\AIProviderInterface;

class MockGeminiProvider implements AIProviderInterface
{
    public function generateResponse(string $userPrompt, array $contextChunks): string
    {
        if (empty($contextChunks)) {
            return "Halo! 👋 Saya NARA SKANEDA (Sahabat & Asisten Digital SMKN 2 Kota Mojokerto). 🎓 Informasi spesifik yang kamu tanyakan belum tersedia dalam basis pengetahuan resmi sekolah kami. Silakan ajukan pertanyaan lain atau hubungi admin sekolah kami! 😊";
        }

        $promptLower = mb_strtolower(trim($userPrompt));

        // 1. Check for specific keywords to target the exact matching chunk
        $targetChunk = null;
        $specificKeywords = [
            'lps' => ['lps', 'perbankan syariah', 'bank syariah', 'bank mini'],
            'rpl' => ['rpl', 'rekayasa perangkat lunak', 'pplg', 'coding', 'pemrograman'],
            'dkv' => ['dkv', 'desain komunikasi visual', 'animasi', 'fotografi', 'videografi', 'grafis'],
            'aphp' => ['aphp', 'pertanian', 'agribisnis', 'pengolahan hasil pertanian', 'pangan'],
            'kuliner' => ['kuliner', 'tata boga', 'boga', 'pastry', 'bakery', 'restoran', 'chef'],
            'robotik' => ['robotik', 'coding club', 'iot'],
            'pramuka' => ['pramuka', 'kepanduan', 'scout', 'bantara'],
            'paskibra' => ['paskibra', 'paskib', 'pbb', 'pengibar bendera'],
            'pmr' => ['pmr', 'palang merah', 'p3k'],
            'futsal' => ['futsal', 'sepak bola', 'bola'],
            'basket' => ['basket', 'bola basket'],
            'voli' => ['voli', 'bola voli'],
            'silat' => ['silat', 'pencak silat', 'beladiri'],
            'tari' => ['tari', 'dance'],
            'musik' => ['musik', 'band', 'studio musik'],
            'rhisma' => ['rhisma', 'hadrah', 'kerohanian islam', 'sholawat'],
            'kir' => ['kir', 'karya ilmiah'],
            'evoice' => ['evoice', 'e-voice', 'aspirasi', 'pengaduan', 'saran'],
            'factcheck' => ['factcheck', 'fact check', 'hoaks', 'hoax', 'klarifikasi'],
            'tour' => ['tour', 'virtual tour', '360', 'keliling'],
            'berita' => ['berita', 'kabar', 'terbaru', 'kegiatan', 'acara', 'event'],
            'fasilitas' => ['fasilitas', 'sarana', 'lab', 'studio', 'wifi'],
            'alumni' => ['alumni', 'peta', 'sebaran', 'karir'],
            'bkk' => ['bkk', 'dudi', 'industri', 'lowongan', 'pkl', 'magang', 'mitra'],
            'quiz' => ['quiz', 'matchmaker', 'cocok', 'rekomendasi ekskul'],
            'prestasi' => ['prestasi', 'juara', 'lks', 'karya'],
            'guru' => ['guru', 'kepala sekolah', 'pengajar', 'staf'],
            'kawilaras' => ['kawi laras', 'budaya', 'kamis wiwitan'],
            'sehat' => ['sehat', 'kebugaran', 'gerakan sekolah sehat'],
        ];

        foreach ($specificKeywords as $topic => $keywords) {
            foreach ($keywords as $kw) {
                if (str_contains($promptLower, $kw)) {
                    foreach ($contextChunks as $chunk) {
                        $chunkLower = mb_strtolower($chunk);
                        if (str_contains($chunkLower, $kw)) {
                            $targetChunk = $chunk;
                            break 3;
                        }
                    }
                }
            }
        }

        if ($targetChunk === null) {
            $targetChunk = $contextChunks[0];
        }

        // 2. Direct topic handling for rich, detailed, persona-aligned responses
        // RPL
        if (str_contains($promptLower, 'rpl') || str_contains($promptLower, 'perangkat lunak') || str_contains($promptLower, 'pplg')) {
            return "Halo! 👋 Konsentrasi Keahlian **Rekayasa Perangkat Lunak / PPLG (RPL)** di SMKN 2 Kota Mojokerto berfokus pada pengembangan aplikasi web, mobile, pemrograman berorientasi objek, serta manajemen basis data.\n\n💻 **Lokasi Pembelajaran**: Lab Komputer RPL 1 & RPL 2 (Lantai 2 Gedung Utama).\n💼 **Peluang Karir**: Software Engineer, Web Developer, Mobile App Developer, UI/UX Designer, & Database Administrator.\n🤝 **Mitra Industri**: PT Telkom Indonesia, Otak Kanan Surabaya, Khofie Soft. 😊";
        }

        // DKV
        if (str_contains($promptLower, 'dkv') || str_contains($promptLower, 'desain komunikasi visual')) {
            return "Halo! 👋 Konsentrasi Keahlian **Desain Komunikasi Visual (DKV)** di SMKN 2 Kota Mojokerto mengajarkan desain grafis, fotografi studio, videografi, animasi 2D/3D, ilustrasi digital, dan branding multimedia.\n\n🎨 **Lokasi Pembelajaran**: Studio Desain Grafis & Studio Fotografi DKV.\n💼 **Peluang Karir**: Graphic Designer, Photographer, Content Creator, Video Editor, & Animator. 😊";
        }

        // APHP
        if (str_contains($promptLower, 'aphp') || str_contains($promptLower, 'hasil pertanian')) {
            return "Halo! 👋 Konsentrasi Keahlian **Agribisnis Pengolahan Hasil Pertanian (APHP)** di SMKN 2 Kota Mojokerto mempelajari teknologi pengolahan pangan, analisis mutu produk pangan, pengemasan, serta pengujian mikrobiologi.\n\n🌾 **Lokasi Pembelajaran**: Lab Pengolahan Hasil Pertanian & Lab Mikrobiologi Pangan.\n💼 **Peluang Karir**: QC/QA Industri Pangan, Wirausaha Kuliner Organik, & Staf Lab Pengujian Pangan. 😊";
        }

        // Kuliner / Tata Boga
        if (str_contains($promptLower, 'kuliner') || str_contains($promptLower, 'tata boga') || str_contains($promptLower, 'boga')) {
            return "Halo! 👋 Konsentrasi Keahlian **Tata Boga (Kuliner)** di SMKN 2 Kota Mojokerto mempelajari teknik memasak Nusantara & Internasional, pastry & bakery, tata hidang (table service), serta manajemen bisnis kuliner.\n\n🍳 **Lokasi Pembelajaran**: Dapur Praktik Utama (Kitchen Lab) & Restoran Simulasi TEFA.\n💼 **Peluang Karir**: Chef Restoran/Hotel, Baker, Food Stylist, & Entrepreneur Catering.\n🤝 **Mitra Industri**: Hotel Vasa Surabaya & SHS Surabaya. 😊";
        }

        // LPS / Perbankan Syariah
        if (str_contains($promptLower, 'lps') || str_contains($promptLower, 'perbankan syariah') || str_contains($promptLower, 'bank syariah')) {
            return "Halo! 👋 Konsentrasi Keahlian **Layanan Perbankan Syariah (LPS)** di SMKN 2 Kota Mojokerto membekali siswa dengan keahlian administrasi keuangan berbasis syariah, akuntansi perbankan, customer service, serta pengelolaan transaksi di Bank Mini Syariah.\n\n🏦 **Lokasi Pembelajaran**: Laboratorium Bank Mini Syariah BSI.\n💼 **Peluang Karir**: Teller Bank, Customer Service Syariah, Staf Keuangan, & Back Office Perbankan.\n🤝 **Mitra Industri**: Bank Syariah Indonesia (BSI), Bank Jatim, KPPN, BAZNAS. 😊";
        }

        // General Jurusan
        if (str_contains($promptLower, 'jurusan') || str_contains($promptLower, 'keahlian') || str_contains($promptLower, 'proli')) {
            return "Halo! 👋 Berikut adalah 5 Konsentrasi Keahlian / Jurusan Unggulan di SMK Negeri 2 Kota Mojokerto:\n\n1. 💻 **RPL (Rekayasa Perangkat Lunak / PPLG)** — Pemrograman Web, Mobile App & Software\n2. 🎨 **DKV (Desain Komunikasi Visual)** — Grafis, Videografi, Animasi & Fotografi\n3. 🌾 **APHP (Agribisnis Pengolahan Hasil Pertanian)** — Teknologi Pangan & Olahan Organik\n4. 🍳 **Tata Boga (Kuliner)** — Pastry, Bakery, International Cuisine & Restoran TEFA\n5. 🏦 **LPS (Layanan Perbankan Syariah)** — Keuangan Syariah, Teller & Bank Mini Syariah BSI\n\nKamu tertarik dengan jurusan yang mana? NARA bisa jelaskan lebih detail! 😊";
        }

        // Specific Ekstrakurikuler
        if (str_contains($promptLower, 'pramuka')) {
            return "Halo! 👋 **Pramuka (Gugus Depan SKANEDA)** adalah ekstrakurikuler wajib bagi seluruh siswa kelas X untuk membentuk kedisiplinan, kepemimpinan, dan kemandirian.\n\n📍 **Tempat Kegiatan**: Lapangan Utama & Halaman Depan SMKN 2 Kota Mojokerto.\n⏰ **Jadwal**: Setiap hari Jumat sore (Pukul 14.00 - 16.30 WIB). 😊";
        }
        if (str_contains($promptLower, 'paskibra')) {
            return "Halo! 👋 **Paskibra (Pasukan Pengibar Bendera SKANEDA)** melatih baris-berbaris (PBB), kedisiplinan tinggi, serta bertugas pada upacara resmi sekolah dan kota.\n\n📍 **Tempat Kegiatan**: Lapangan Utama & Hall Gedung Serbaguna SKANEDA.\n⏰ **Jadwal**: Hari Selasa dan Kamis (Pukul 15.30 - 17.00 WIB). 😊";
        }
        if (str_contains($promptLower, 'robotik') || str_contains($promptLower, 'coding club')) {
            return "Halo! 👋 **Robotik & Coding Club** adalah wadah bagi siswa yang berminat pada pemrograman mikroprosesor, IoT, perakitan robotika, dan kompetisi IT.\n\n📍 **Tempat Kegiatan**: Lab Komputer RPL 1 (Gedung RPL Lantai 2).\n⏰ **Jadwal**: Hari Rabu sore (Pukul 15.30 - 17.00 WIB). 😊";
        }
        if (str_contains($promptLower, 'pmr') || str_contains($promptLower, 'palang merah')) {
            return "Halo! 👋 **PMR (Palang Merah Remaja)** melatih pertolongan pertama, kesehatan remaja, donor darah, dan aksi kemanusiaan.\n\n📍 **Tempat Kegiatan**: Ruang UKS Utama & Halaman Lab Kesehatan SKANEDA.\n⏰ **Jadwal**: Hari Senin sore (Pukul 15.30 - 17.00 WIB). 😊";
        }

        // General Ekskul
        if (str_contains($promptLower, 'ekskul') || str_contains($promptLower, 'ekstrakurikuler')) {
            return "Halo! 👋 Berikut adalah 12 kegiatan Ekstrakurikuler di SMKN 2 Kota Mojokerto:\n\n1. ⛺ **Pramuka (Wajib)** — Lapangan Utama (Jumat 14.00 WIB)\n2. 🇮🇩 **Paskibra** — Hall Serbaguna (Selasa & Kamis 15.30 WIB)\n3. 🤖 **Robotik & Coding** — Lab RPL 1 (Rabu 15.30 WIB)\n4. 🚑 **PMR** — Ruang UKS (Senin 15.30 WIB)\n5. ⚽ **Futsal & Sepakbola** — Lapangan Outdoor (Rabu & Jumat 15.30 WIB)\n6. 🏀 **Bola Basket** — Lapangan Basket (Selasa & Sabtu 07.00 WIB)\n7. 🏐 **Bola Voli** — Lapangan Voli (Kamis 15.30 WIB)\n8. 🥋 **Pencak Silat** — Aula Utama (Sabtu 15.00 WIB)\n9. 💃 **Tari Tradisional/Modern** — Sanggar Seni (Kamis 15.30 WIB)\n10. 🎵 **Seni Musik & Band** — Studio Musik (Rabu 15.30 WIB)\n11. 🕌 **Rhisma** — Masjid Al-Ikhlas (Jumat & Sabtu)\n12. 📑 **KIR** — Perpustakaan Digital (Selasa 15.30 WIB)\n\nAda ekskul tertentu yang ingin kamu ketahui lokasi dan jadwalnya? 😊";
        }

        // Quiz Matchmaker Ekskul
        if (str_contains($promptLower, 'quiz') || str_contains($promptLower, 'matchmaker') || str_contains($promptLower, 'cocok') || str_contains($promptLower, 'rekomendasi ekskul')) {
            return "Halo! 👋 **Fitur Ekskul Matchmaker Quiz** adalah kuiz interaktif di website SMKN 2 Kota Mojokerto untuk membantu siswa menemukan ekstrakurikuler yang paling sesuai dengan minat, bakat, dan hobi kamu!\n\n🎯 Kamu cukup menjawab beberapa pertanyaan sederhana, dan sistem akan merekomendasikan ekskul yang paling pas buat kamu! 😊";
        }

        // PPDB
        if (str_contains($promptLower, 'ppdb') || str_contains($promptLower, 'daftar') || str_contains($promptLower, 'pendaftaran') || str_contains($promptLower, 'biaya')) {
            return "Halo! 👋 Informasi Pendaftaran PPDB SMKN 2 Kota Mojokerto:\n\n✨ **Biaya Pendaftaran**: **GRATIS (100% TIDAK DIPUNGUT BIAYA)**.\n📌 **4 Jalur Masuk**: 1. Jalur Afirmasi, 2. Jalur Prestasi (Rapor & Kejuaraan), 3. Jalur Zonasi, 4. Jalur Mutasi Orang Tua.\n📋 **Syarat Umum**: Lulusan SMP/MTs, Ijazah/SKL, usia maks 21 tahun, sehat jasmani & rohani. 😊";
        }

        // Profil & Alamat
        if (str_contains($promptLower, 'alamat') || str_contains($promptLower, 'kontak') || str_contains($promptLower, 'lokasi') || str_contains($promptLower, 'dimana') || str_contains($promptLower, 'telepon')) {
            return "Halo! 👋 Informasi Resmi Profil & Alamat SMKN 2 Kota Mojokerto:\n\n🏫 **Alamat**: Jl. Raden Wijaya No. 1, Kranggan, Kota Mojokerto, Jawa Timur.\n📞 **Telepon**: (0321) 321555 | ✉️ **Email**: info@smkn2mojokerto.sch.id\n⭐ **Akreditasi**: A (Unggul) | **Status**: SMK Pusat Keunggulan (PK)\n🎯 **Motto**: *Disiplin • Berakhlak • Berprestasi*. 😊";
        }

        // Kepala Sekolah & Guru
        if (str_contains($promptLower, 'guru') || str_contains($promptLower, 'kepala sekolah') || str_contains($promptLower, 'pengajar') || str_contains($promptLower, 'staf')) {
            return "Halo! 👋 Tenaga Pendidik & Staf SMKN 2 Kota Mojokerto dipimpin oleh:\n\n👨‍🏫 **Kepala Sekolah**: Drs. Akhmad Mukhlason (Drs. H. Ahmad Fauzi, M.Pd.)\n👩‍💻 **Ketua Program RPL**: Rina Wijaya, S.Kom., M.T.\n🎨 **Ketua Program DKV**: Bambang Sugiarto, S.Sn.\n\nSeluruh dewan guru terverifikasi profesional dan bersertifikasi pendidik di bidangnya masing-masing. 😊";
        }

        // Fasilitas
        if (str_contains($promptLower, 'fasilitas') || str_contains($promptLower, 'sarana')) {
            return "Halo! 👋 SMKN 2 Kota Mojokerto memiliki fasilitas pembelajaran modern & lengkap:\n\n💻 **Lab Komputer RPL High-Spec**\n🎨 **Studio DKV & Studio Fotografi**\n🌾 **Lab Pengolahan Pangan APHP**\n🍳 **Kitchen Lab & Restoran TEFA Kuliner**\n🏦 **Laboratorium Bank Mini Syariah LPS**\n📚 **Perpustakaan Digital & Free High-Speed WiFi**\n🕌 **Masjid Al-Ikhlas, UKS, & Lapangan Olahraga Outdoor** 😊";
        }

        // BKK & Kemitraan Industri / Lowongan Kerja
        if (str_contains($promptLower, 'bkk') || str_contains($promptLower, 'dudi') || str_contains($promptLower, 'industri') || str_contains($promptLower, 'lowongan') || str_contains($promptLower, 'pkl') || str_contains($promptLower, 'magang') || str_contains($promptLower, 'mitra') || str_contains($promptLower, 'kerja')) {
            return "Halo! 👋 **Bursa Kerja Khusus (BKK) SKANEDA** memfasilitasi Prakerin/PKL dan penyaluran kerja alumni ke berbagai perusahaan mitra industri:\n\n🏢 **Mitra Utama**: PT Telkom Indonesia, PT Astra International, Bank Syariah Indonesia (BSI), PT Surabaya Autocomp Indonesia (SAI), Toko Emas Wahyu Redjo, Hotel Vasa Surabaya, dan FIF Group.\n💼 BKK rutin mengadakan rekrutmen kampus & temu alumni untuk menyalurkan lulusan langsung ke dunia kerja! 😊";
        }

        // Alumni Career Map
        if (str_contains($promptLower, 'alumni') || str_contains($promptLower, 'peta') || str_contains($promptLower, 'sebaran') || str_contains($promptLower, 'karir')) {
            return "Halo! 👋 **Peta Sebaran Alumni SKANEDA** menampilkan lokasi kerja dan studi alumni SMKN 2 Kota Mojokerto secara interaktif di seluruh Indonesia dan mancanegara.\n\n🌐 Banyak alumni RPL, DKV, Kuliner, APHP, dan LPS yang kini bekerja di perusahaan nasional (seperti Tokopedia, Telkom) maupun melanjutkan studi di Perguruan Tinggi Negeri ternama (seperti ITS, Unair, UB)! 😊";
        }

        // Virtual Tour 360°
        if (str_contains($promptLower, 'tour') || str_contains($promptLower, 'virtual tour') || str_contains($promptLower, '360') || str_contains($promptLower, 'keliling')) {
            return "Halo! 👋 **Fitur Virtual School Tour 360°** memungkinkan kamu untuk menjelajahi lingkungan SMKN 2 Kota Mojokerto secara 3D interaktif!\n\n🌐 Kamu bisa melihat gedung utama, lab komputer RPL, studio DKV, dapur kuliner, bank mini syariah, hingga fasilitas lapangan dari layar perangkatmu! 😊";
        }

        // Berita & Agenda
        if (str_contains($promptLower, 'berita') || str_contains($promptLower, 'kabar') || str_contains($promptLower, 'terbaru') || str_contains($promptLower, 'agenda') || str_contains($promptLower, 'acara') || str_contains($promptLower, 'kegiatan')) {
            return "Halo! 👋 Informasi Berita & Agenda Terbaru SMKN 2 Kota Mojokerto:\n\n📰 **1. Pelatihan Web Framework Laravel 2024** — Pembekalan siswa RPL bersama alumni profesional.\n📰 **2. Uji Kompetensi Keahlian (UKK)** — Pelaksanaan ujian kelulusan bekerja sama dengan penguji industri (PT Otak Kanan, Hotel Vasa, BPD Jatim, BSI).\n📰 **3. Literasi Keuangan Syariah** — Edukasi pembiayaan bersama FIF Group & Bakti BCA.\n📰 **4. Program Budaya Kawi Laras** — Pelestarian budaya Jawa setiap minggu kedua dalam bulan.\n📰 **5. Program Gerakan Sekolah Sehat** — Tes kebugaran fisik berkala bagi siswa.\n\nKamu bisa membaca artikel berita lengkap di menu Berita Website kami! 😊";
        }

        // E-Voice
        if (str_contains($promptLower, 'evoice') || str_contains($promptLower, 'e-voice') || str_contains($promptLower, 'aspirasi') || str_contains($promptLower, 'pengaduan') || str_contains($promptLower, 'saran')) {
            return "Halo! 👋 **E-Voice SKANEDA** adalah portal pengaduan & aspirasi digital siswa SMKN 2 Kota Mojokerto.\n\n📣 Kamu dapat menyampaikan saran, kritik membangun, atau pengaduan secara transparan, memberikan dukungan (upvote) pada aspirasi teman, dan memantau status tindak lanjut dari sekolah secara real-time! 😊";
        }

        // FactCheck
        if (str_contains($promptLower, 'factcheck') || str_contains($promptLower, 'fact check') || str_contains($promptLower, 'hoaks') || str_contains($promptLower, 'hoax') || str_contains($promptLower, 'klarifikasi')) {
            return "Halo! 👋 **School FactCheck** adalah portal verifikasi berita resmi SMKN 2 Kota Mojokerto untuk memverifikasi kebenaran isu, berita hoaks, atau rumor seputar sekolah (seperti isu pendaftaran palsu atau pemungutan biaya). 😊";
        }

        // Prestasi Siswa
        if (str_contains($promptLower, 'prestasi') || str_contains($promptLower, 'juara') || str_contains($promptLower, 'lks') || str_contains($promptLower, 'karya')) {
            return "Halo! 👋 SMKN 2 Kota Mojokerto kaya akan **Prestasi Siswa**:\n\n🏆 **Juara LKS Web Technologies & Graphic Design** tingkat Jawa Timur\n🏆 **Juara 3 & Juara Favorit Lomba Cerdas Cermat & Koperasi Syariah** tingkat Provinsi Jawa Timur\n🏆 **Status Sekolah Pusat Keunggulan (PK) & Sekolah Adiwiyata**\n\nKamu bisa melihat galeri karya dan rincian prestasi di menu Karya & Prestasi Siswa! 😊";
        }

        // Kawi Laras & Budaya
        if (str_contains($promptLower, 'kawi laras') || str_contains($promptLower, 'budaya') || str_contains($promptLower, 'lurik')) {
            return "Halo! 👋 **Kawi Laras (Kamis Wiwitan Laku Adab Lan Rasa Sayekti)** adalah program budaya mingguan di SMKN 2 Kota Mojokerto.\n\n👘 Setiap Kamis minggu kedua setiap bulan, seluruh siswa dan guru mengenakan busana tradisional Jawa (lurik & kebaya) serta menerapkan nilai ungah-ungguh dan adab budaya Jawa. 😊";
        }

        // 3. Clean up extracted title and chunk body for generic fallback
        $title = '';
        $cleanContent = $targetChunk;

        if (preg_match('/^\[([^\]]+)\]\s*([^:]+):\s*(.*)$/us', $targetChunk, $matches)) {
            $title = trim($matches[2]);
            $cleanContent = trim($matches[3]);
        } else {
            $cleanContent = preg_replace('/^\[[^\]]+\]\s*/u', '', $targetChunk);
            $cleanContent = trim((string) $cleanContent);
        }

        $displayTitle = preg_replace('/^Detail\s+/i', '', $title);

        return "Halo! 👋 Berdasarkan data resmi SMKN 2 Kota Mojokerto:\n\n📌 **{$displayTitle}**:\n{$cleanContent}\n\nAda hal lain yang ingin kamu tanyakan seputar SMKN 2 Kota Mojokerto? NARA siap membantu! 😊";
    }
}
