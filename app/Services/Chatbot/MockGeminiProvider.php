<?php

namespace App\Services\Chatbot;

use App\Interfaces\AI\AIProviderInterface;

class MockGeminiProvider implements AIProviderInterface
{
    public function generateResponse(string $userPrompt, array $contextChunks): string
    {
        $notFoundMessage = "Halo! 👋 Saya NARA SKANEDA (Sahabat & Asisten Digital SMKN 2 Kota Mojokerto). 🎓 Informasi spesifik yang kamu tanyakan belum tersedia dalam basis pengetahuan resmi SMKN 2 Kota Mojokerto. Silakan ajukan pertanyaan lain atau hubungi admin sekolah kami! 😊";

        if (empty($contextChunks)) {
            return $notFoundMessage;
        }

        $promptLower = mb_strtolower(trim($userPrompt));

        // Reject out-of-scope queries explicitly
        if (
            str_contains($promptLower, 'kantin') ||
            str_contains($promptLower, 'menu kantin') ||
            str_contains($promptLower, 'persiapan') ||
            str_contains($promptLower, 'dipersiapkan') ||
            str_contains($promptLower, 'diperlukan')
        ) {
            return $notFoundMessage;
        }

        // 1. Kepala Sekolah / Kepsek
        if (str_contains($promptLower, 'kepsek') || str_contains($promptLower, 'kepala sekolah') || str_contains($promptLower, 'iswahyudi')) {
            return "Halo! 👋 Kepala Sekolah SMKN 2 Kota Mojokerto saat ini adalah **Bapak Drs. Iswahyudi, M.Pd.** 👨‍🏫.\n\nBeliau memimpin SMKN 2 Kota Mojokerto dalam mewujudkan sekolah kejuruan yang unggul, berkarakter, dan berdaya saing global. Ada hal lain yang ingin kamu tanyakan seputar kepemimpinan atau program sekolah kami? 😊";
        }

        // 2. Jurusan
        if (str_contains($promptLower, 'rpl') || str_contains($promptLower, 'rekayasa perangkat lunak') || str_contains($promptLower, 'pplg')) {
            return "Halo! 👋 Konsentrasi Keahlian **Rekayasa Perangkat Lunak / PPLG (RPL)** di SMKN 2 Kota Mojokerto berfokus pada pengembangan aplikasi web, mobile, pemrograman berorientasi objek, serta manajemen basis data.\n\n💻 **Lokasi Pembelajaran**: Lab Komputer RPL 1 & RPL 2 (Lantai 2 Gedung Utama).\n💼 **Peluang Karir**: Software Engineer, Web Developer, Mobile App Developer, UI/UX Designer, & Database Administrator.\n🤝 **Mitra Industri**: PT Telkom Indonesia, Otak Kanan Surabaya, Khofie Soft. 😊";
        }
        if (str_contains($promptLower, 'dkv') || str_contains($promptLower, 'desain komunikasi visual')) {
            return "Halo! 👋 Konsentrasi Keahlian **Desain Komunikasi Visual (DKV)** di SMKN 2 Kota Mojokerto mengajarkan desain grafis, fotografi studio, videografi, animasi 2D/3D, ilustrasi digital, dan branding multimedia.\n\n🎨 **Lokasi Pembelajaran**: Studio Desain Grafis & Studio Fotografi DKV.\n💼 **Peluang Karir**: Graphic Designer, Photographer, Content Creator, Video Editor, & Animator. 😊";
        }
        if (str_contains($promptLower, 'aphp') || str_contains($promptLower, 'hasil pertanian')) {
            return "Halo! 👋 Konsentrasi Keahlian **Agribisnis Pengolahan Hasil Pertanian (APHP)** di SMKN 2 Kota Mojokerto mempelajari teknologi pengolahan pangan, analisis mutu produk pangan, pengemasan, serta pengujian mikrobiologi.\n\n🌾 **Lokasi Pembelajaran**: Lab Pengolahan Hasil Pertanian & Lab Mikrobiologi Pangan.\n💼 **Peluang Karir**: QC/QA Industri Pangan, Wirausaha Kuliner Organik, & Staf Lab Pengujian Pangan. 😊";
        }
        if (str_contains($promptLower, 'kuliner') || str_contains($promptLower, 'tata boga') || str_contains($promptLower, 'boga')) {
            return "Halo! 👋 Konsentrasi Keahlian **Tata Boga (Kuliner)** di SMKN 2 Kota Mojokerto mempelajari teknik memasak Nusantara & Internasional, pastry & bakery, tata hidang (table service), serta manajemen bisnis kuliner.\n\n🍳 **Lokasi Pembelajaran**: Dapur Praktik Utama (Kitchen Lab) & Restoran Simulasi TEFA.\n💼 **Peluang Karir**: Chef Restoran/Hotel, Baker, Food Stylist, & Entrepreneur Catering.\n🤝 **Mitra Industri**: Hotel Vasa Surabaya & SHS Surabaya. 😊";
        }
        if (str_contains($promptLower, 'lps') || str_contains($promptLower, 'perbankan syariah') || str_contains($promptLower, 'bank syariah')) {
            return "Halo! 👋 Konsentrasi Keahlian **Layanan Perbankan Syariah (LPS)** di SMKN 2 Kota Mojokerto membekali siswa dengan keahlian administrasi keuangan berbasis syariah, akuntansi perbankan, customer service, serta pengelolaan transaksi di Bank Mini Syariah.\n\n🏦 **Lokasi Pembelajaran**: Laboratorium Bank Mini Syariah BSI.\n💼 **Peluang Karir**: Teller Bank, Customer Service Syariah, Staf Keuangan, & Back Office Perbankan.\n🤝 **Mitra Industri**: Bank Syariah Indonesia (BSI), Bank Jatim, KPPN, BAZNAS. 😊";
        }
        if (str_contains($promptLower, 'jurusan') || str_contains($promptLower, 'keahlian') || str_contains($promptLower, 'proli')) {
            return "Halo! 👋 Berikut adalah 5 Konsentrasi Keahlian / Jurusan Unggulan di SMK Negeri 2 Kota Mojokerto:\n\n1. 💻 **RPL (Rekayasa Perangkat Lunak / PPLG)** — Pemrograman Web, Mobile App & Software\n2. 🎨 **DKV (Desain Komunikasi Visual)** — Grafis, Videografi, Animasi & Fotografi\n3. 🌾 **APHP (Agribisnis Pengolahan Hasil Pertanian)** — Teknologi Pangan & Olahan Organik\n4. 🍳 **Tata Boga (Kuliner)** — Pastry, Bakery, International Cuisine & Restoran TEFA\n5. 🏦 **LPS (Layanan Perbankan Syariah)** — Keuangan Syariah, Teller & Bank Mini Syariah BSI\n\nKamu tertarik dengan jurusan yang mana? NARA bisa jelaskan lebih detail! 😊";
        }

        // 3. Specific Ekstrakurikuler & Organisasi (Check specific ekskul BEFORE general ekskul)
        if (str_contains($promptLower, 'banjari') || str_contains($promptLower, 'hadrah') || str_contains($promptLower, 'sholawat') || str_contains($promptLower, 'shalawat')) {
            return "Halo! 👋 **Banjari (Keagamaan)** di SMKN 2 Kota Mojokerto mengembangkan seni musik Islami melalui lantunan shalawat, kekompakan, dan penampilan dalam kegiatan sekolah.\n\n👤 **Pembina**: Pembina kegiatan keagamaan\n⏰ **Jadwal Latihan**: Setiap hari Jumat\n📌 **Kegiatan**: Latihan vokal, rebana, shalawat, dan penampilan sekolah. 😊";
        }
        if (str_contains($promptLower, 'basket')) {
            return "Halo! 👋 **Basket (Olahraga)** di SMKN 2 Kota Mojokerto melatih teknik permainan, kebugaran, sportivitas, dan kerja sama tim melalui latihan serta pertandingan pelajar.\n\n👤 **Pembina**: Pembina olahraga sekolah\n⏰ **Jadwal Latihan**: Selasa & Jumat\n📌 **Kegiatan**: Latihan teknik, sparing, dan turnamen pelajar. 😊";
        }
        if (str_contains($promptLower, 'voli')) {
            return "Halo! 👋 **Bola Voli (Olahraga)** di SMKN 2 Kota Mojokerto membangun kekompakan tim melalui latihan teknik dasar, strategi permainan, dan kompetisi antarpelajar.\n\n👤 **Pembina**: Pembina olahraga sekolah\n⏰ **Jadwal Latihan**: Kamis & Sabtu\n📌 **Kegiatan**: Passing, servis, smash, sparing, dan turnamen. 😊";
        }
        if (str_contains($promptLower, 'btq') || str_contains($promptLower, 'baca tulis al quran')) {
            return "Halo! 👋 **BTQ (Keagamaan)** di SMKN 2 Kota Mojokerto meningkatkan kemampuan membaca Al-Qur’an dengan baik serta membangun kebiasaan belajar agama secara rutin.\n\n👤 **Pembina**: Pembina kegiatan keagamaan\n⏰ **Jadwal Latihan**: Setiap hari Jumat\n📌 **Kegiatan**: Tilawah, tahsin, hafalan, dan pembinaan keagamaan. 😊";
        }
        if (str_contains($promptLower, 'futsal')) {
            return "Halo! 👋 **Futsal (Olahraga)** di SMKN 2 Kota Mojokerto mengasah kecepatan, strategi, disiplin, dan kerja sama tim melalui latihan futsal dan pertandingan pelajar.\n\n👤 **Pembina**: Pembina olahraga sekolah\n⏰ **Jadwal Latihan**: Senin & Rabu\n📌 **Kegiatan**: Latihan teknik, sparing, dan turnamen antarsekolah. 😊";
        }
        if (str_contains($promptLower, 'jurnalistik') || str_contains($promptLower, 'jurnal')) {
            return "Halo! 👋 **Jurnalistik (Media & Literasi)** di SMKN 2 Kota Mojokerto menjadi ruang bagi siswa untuk menulis, meliput kegiatan sekolah, mengolah informasi, dan menghasilkan karya media.\n\n👤 **Pembina**: Pembina jurnalistik sekolah\n⏰ **Jadwal Latihan**: Setiap hari Rabu\n📌 **Kegiatan**: Menulis berita, wawancara, fotografi, dan publikasi sekolah. 😊";
        }
        if (str_contains($promptLower, 'paskib')) {
            return "Halo! 👋 **Paskib (Kedisiplinan)** di SMKN 2 Kota Mojokerto membentuk kedisiplinan, keteguhan, tanggung jawab, dan kekompakan melalui latihan baris-berbaris.\n\n👤 **Pembina**: Pembina Paskib sekolah\n⏰ **Jadwal Latihan**: Rabu & Sabtu\n📌 **Kegiatan**: PBB, formasi, upacara, dan kegiatan kebangsaan. 😊";
        }
        if (str_contains($promptLower, 'pramuka')) {
            return "Halo! 👋 **Pramuka (Kepanduan)** di SMKN 2 Kota Mojokerto membentuk kemandirian, kepemimpinan, kepedulian lingkungan, dan keterampilan melalui kegiatan kepanduan.\n\n👤 **Pembina**: Pembina Pramuka sekolah\n⏰ **Jadwal Latihan**: Setiap hari Jumat\n📌 **Kegiatan**: Latihan kepramukaan, kemah, keterampilan, dan kegiatan sosial. 😊";
        }
        if (str_contains($promptLower, 'tari')) {
            return "Halo! 👋 **Tari (Seni & Budaya)** di SMKN 2 Kota Mojokerto melestarikan budaya melalui tari tradisional dan kreasi serta memberikan ruang untuk tampil dan berkarya.\n\n👤 **Pembina**: Pembina seni sekolah\n⏰ **Jadwal Latihan**: Rabu & Sabtu\n📌 **Kegiatan**: Latihan tari tradisional, tari kreasi, dan pentas seni. 😊";
        }
        if (str_contains($promptLower, 'pena') || str_contains($promptLower, 'teater') || str_contains($promptLower, 'theater')) {
            return "Halo! 👋 **PENA (Seni & Budaya)** di SMKN 2 Kota Mojokerto adalah wadah mini teater untuk melatih ekspresi, kepercayaan diri, penulisan naskah, dan kemampuan tampil di depan publik.\n\n👤 **Pembina**: Pembina seni dan teater sekolah\n⏰ **Jadwal Latihan**: Setiap hari Kamis\n📌 **Kegiatan**: Latihan akting, olah vokal, naskah, dan pementasan. 😊";
        }
        if (str_contains($promptLower, 'silat')) {
            return "Halo! 👋 **Silat (Bela Diri)** di SMKN 2 Kota Mojokerto melatih bela diri, ketahanan fisik, kedisiplinan, dan sikap percaya diri melalui latihan pencak silat.\n\n👤 **Pembina**: Pembina bela diri sekolah\n⏰ **Jadwal Latihan**: Selasa & Kamis\n📌 **Kegiatan**: Teknik dasar, jurus, sparing, dan kejuaraan. 😊";
        }
        if (str_contains($promptLower, 'pmr') || str_contains($promptLower, 'palang merah')) {
            return "Halo! 👋 **PMR (Kesehatan)** di SMKN 2 Kota Mojokerto membekali siswa dengan kepedulian kemanusiaan, pertolongan pertama, dan kesiapsiagaan dalam kegiatan sekolah.\n\n👤 **Pembina**: Pembina PMR sekolah\n⏰ **Jadwal Latihan**: Setiap hari Sabtu\n📌 **Kegiatan**: P3K, kesehatan remaja, kegiatan sosial, dan siaga bencana. 😊";
        }
        if (str_contains($promptLower, 'pik-r') || str_contains($promptLower, 'pikr') || str_contains($promptLower, 'pik r')) {
            return "Halo! 👋 **PIK-R (Kesehatan)** di SMKN 2 Kota Mojokerto menjadi ruang edukasi dan konseling sebaya untuk membangun remaja yang sehat, bertanggung jawab, dan berencana.\n\n👤 **Pembina**: Pembina PIK-R sekolah\n⏰ **Jadwal Latihan**: Setiap hari Kamis\n📌 **Kegiatan**: Edukasi remaja, konseling sebaya, kampanye kesehatan, dan kegiatan sosial. 😊";
        }
        if (str_contains($promptLower, 'osis')) {
            return "Halo! 👋 **OSIS (Organisasi)** di SMKN 2 Kota Mojokerto adalah wadah utama kepemimpinan siswa untuk merancang dan menjalankan berbagai program kegiatan sekolah.\n\n👤 **Pembina**: Pembina OSIS sekolah\n⏰ **Agenda**: Sesuai program kerja\n📌 **Kegiatan**: Program kerja siswa, kegiatan sekolah, kepemimpinan, dan bakti sosial. 😊";
        }
        if (str_contains($promptLower, 'lacurva') || str_contains($promptLower, 'la curva')) {
            return "Halo! 👋 **Lacurva (Organisasi)** di SMKN 2 Kota Mojokerto adalah komunitas suporter Skaneda yang membangun semangat, kreativitas, dan dukungan positif untuk kegiatan serta prestasi siswa.\n\n👤 **Pembina**: Pembina kegiatan siswa\n⏰ **Agenda**: Sesuai agenda pertandingan\n📌 **Kegiatan**: Dukungan pertandingan, koreografi, kreativitas suporter, dan solidaritas. 😊";
        }
        if (str_contains($promptLower, 'pasus')) {
            return "Halo! 👋 **Pasus (Organisasi)** di SMKN 2 Kota Mojokerto adalah organisasi siswa yang menumbuhkan kedisiplinan, tanggung jawab, kekompakan, dan kesiapan membantu kegiatan sekolah.\n\n👤 **Pembina**: Pembina Pasus sekolah\n⏰ **Agenda**: Sesuai agenda sekolah\n📌 **Kegiatan**: Pengamanan kegiatan, kedisiplinan, ketertiban, dan dukungan acara sekolah. 😊";
        }
        if (str_contains($promptLower, 'ekskul') || str_contains($promptLower, 'ekstrakurikuler')) {
            return "Halo! 👋 SMKN 2 Kota Mojokerto memiliki 13 Ekstrakurikuler dan 3 Organisasi Siswa:\n\n📌 **Ekstrakurikuler**:\n1. 🥁 Banjari (Jumat)\n2. 🏀 Basket (Selasa & Jumat)\n3. 🏐 Bola Voli (Kamis & Sabtu)\n4. 📖 BTQ (Jumat)\n5. ⚽ Futsal (Senin & Rabu)\n6. 📰 Jurnalistik (Rabu)\n7. 🇮🇩 Paskib (Rabu & Sabtu)\n8. ⛺ Pramuka (Jumat)\n9. 💃 Tari (Rabu & Sabtu)\n10. 🎭 PENA / Teater (Kamis)\n11. 🥋 Silat (Selasa & Kamis)\n12. 🚑 PMR (Sabtu)\n13. 🩺 PIK-R (Kamis)\n\n📌 **Organisasi Siswa**:\n1. OSIS\n2. Lacurva\n3. Pasus\n\nKamu ingin tahu detail ekskul atau organisasi yang mana? 😊";
        }

        // 4. PPDB
        if (str_contains($promptLower, 'ppdb') || str_contains($promptLower, 'pendaftaran ppdb') || str_contains($promptLower, 'biaya ppdb')) {
            return "Halo! 👋 Informasi Pendaftaran PPDB SMKN 2 Kota Mojokerto:\n\n✨ **Biaya Pendaftaran**: **GRATIS (100% TIDAK DIPUNGUT BIAYA)**.\n📌 **4 Jalur Masuk**: 1. Jalur Afirmasi, 2. Jalur Prestasi (Rapor & Kejuaraan), 3. Jalur Zonasi, 4. Jalur Mutasi Orang Tua.\n📋 **Syarat Umum**: Lulusan SMP/MTs, Ijazah/SKL, usia maks 21 tahun, sehat jasmani & rohani. 😊";
        }

        // 5. Profil & Alamat
        if (str_contains($promptLower, 'alamat') || str_contains($promptLower, 'kontak') || str_contains($promptLower, 'lokasi sekolah') || str_contains($promptLower, 'dimana sekolah')) {
            return "Halo! 👋 Informasi Resmi Profil & Alamat SMKN 2 Kota Mojokerto:\n\n🏫 **Alamat**: Jl. Raden Wijaya No. 1, Kranggan, Kota Mojokerto, Jawa Timur.\n📞 **Telepon**: (0321) 321555 | ✉️ **Email**: info@smkn2mojokerto.sch.id\n⭐ **Akreditasi**: A (Unggul) | **Status**: SMK Pusat Keunggulan (PK)\n🎯 **Motto**: *Disiplin • Berakhlak • Berprestasi*. 😊";
        }

        // 6. Guru & Staf
        if (str_contains($promptLower, 'guru') || str_contains($promptLower, 'pengajar') || str_contains($promptLower, 'staf')) {
            return "Halo! 👋 Tenaga Pendidik & Staf SMKN 2 Kota Mojokerto dipimpin oleh:\n\n👨‍🏫 **Kepala Sekolah**: Drs. Iswahyudi, M.Pd.\n👩‍💻 **Ketua Program RPL**: Rina Wijaya, S.Kom., M.T.\n🎨 **Ketua Program DKV**: Bambang Sugiarto, S.Sn.\n\nSeluruh dewan guru terverifikasi profesional dan bersertifikasi pendidik di bidangnya masing-masing. 😊";
        }

        // 7. Fasilitas
        if (str_contains($promptLower, 'fasilitas') || str_contains($promptLower, 'sarana')) {
            return "Halo! 👋 SMKN 2 Kota Mojokerto memiliki fasilitas pembelajaran modern & lengkap:\n\n💻 **Lab Komputer RPL High-Spec**\n🎨 **Studio DKV & Studio Fotografi**\n🌾 **Lab Pengolahan Pangan APHP**\n🍳 **Kitchen Lab & Restoran TEFA Kuliner**\n🏦 **Laboratorium Bank Mini Syariah LPS**\n📚 **Perpustakaan Digital & Free High-Speed WiFi**\n🕌 **Masjid Al-Ikhlas, UKS, & Lapangan Olahraga Outdoor** 😊";
        }

        // 8. BKK & DUDI
        if (str_contains($promptLower, 'bkk') || str_contains($promptLower, 'dudi') || str_contains($promptLower, 'industri') || str_contains($promptLower, 'lowongan') || str_contains($promptLower, 'pkl') || str_contains($promptLower, 'magang') || str_contains($promptLower, 'mitra') || str_contains($promptLower, 'kerja')) {
            return "Halo! 👋 **Bursa Kerja Khusus (BKK) SKANEDA** memfasilitasi Prakerin/PKL dan penyaluran kerja alumni ke berbagai perusahaan mitra industri:\n\n🏢 **Mitra Utama**: PT Telkom Indonesia, PT Astra International, Bank Syariah Indonesia (BSI), PT Surabaya Autocomp Indonesia (SAI), Toko Emas Wahyu Redjo, Hotel Vasa Surabaya, dan FIF Group.\n💼 BKK rutin mengadakan rekrutmen kampus & temu alumni untuk menyalurkan lulusan langsung ke dunia kerja! 😊";
        }

        // 9. Alumni
        if (str_contains($promptLower, 'alumni') || str_contains($promptLower, 'peta alumni') || str_contains($promptLower, 'sebaran')) {
            return "Halo! 👋 **Peta Sebaran Alumni SKANEDA** menampilkan lokasi kerja dan studi alumni SMKN 2 Kota Mojokerto secara interaktif di seluruh Indonesia dan mancanegara.\n\n🌐 Banyak alumni RPL, DKV, Kuliner, APHP, dan LPS yang kini bekerja di perusahaan nasional (seperti Tokopedia, Telkom) maupun melanjutkan studi di Perguruan Tinggi Negeri ternama (seperti ITS, Unair, UB)! 😊";
        }

        // 10. Tour
        if (str_contains($promptLower, 'tour') || str_contains($promptLower, 'virtual tour') || str_contains($promptLower, '360')) {
            return "Halo! 👋 **Fitur Virtual School Tour 360°** memungkinkan kamu untuk menjelajahi lingkungan SMKN 2 Kota Mojokerto secara 3D interaktif!\n\n🌐 Kamu bisa melihat gedung utama, lab komputer RPL, studio DKV, dapur kuliner, bank mini syariah, hingga fasilitas lapangan dari layar perangkatmu! 😊";
        }

        // 11. Berita
        if (str_contains($promptLower, 'berita') || str_contains($promptLower, 'kabar') || str_contains($promptLower, 'terbaru') || str_contains($promptLower, 'agenda')) {
            return "Halo! 👋 Informasi Berita & Agenda Terbaru SMKN 2 Kota Mojokerto:\n\n📰 **1. Pelatihan Web Framework Laravel 2024** — Pembekalan siswa RPL bersama alumni profesional.\n📰 **2. Uji Kompetensi Keahlian (UKK)** — Pelaksanaan ujian kelulusan bekerja sama dengan penguji industri (PT Otak Kanan, Hotel Vasa, BPD Jatim, BSI).\n📰 **3. Literasi Keuangan Syariah** — Edukasi pembiayaan bersama FIF Group & Bakti BCA.\n📰 **4. Program Budaya Kawi Laras** — Pelestarian budaya Jawa setiap minggu kedua dalam bulan.\n📰 **5. Program Gerakan Sekolah Sehat** — Tes kebugaran fisik berkala bagi siswa.\n\nKamu bisa membaca artikel berita lengkap di menu Berita Website kami! 😊";
        }

        // 12. E-Voice & FactCheck
        if (str_contains($promptLower, 'evoice') || str_contains($promptLower, 'e-voice') || str_contains($promptLower, 'aspirasi') || str_contains($promptLower, 'pengaduan')) {
            return "Halo! 👋 **E-Voice SKANEDA** adalah portal pengaduan & aspirasi digital siswa SMKN 2 Kota Mojokerto.\n\n📣 Kamu dapat menyampaikan saran, kritik membangun, atau pengaduan secara transparan, memberikan dukungan (upvote) pada aspirasi teman, dan memantau status tindak lanjut dari sekolah secara real-time! 😊";
        }
        if (str_contains($promptLower, 'factcheck') || str_contains($promptLower, 'fact check') || str_contains($promptLower, 'hoaks') || str_contains($promptLower, 'hoax') || str_contains($promptLower, 'klarifikasi')) {
            return "Halo! 👋 **School FactCheck** adalah portal verifikasi berita resmi SMKN 2 Kota Mojokerto untuk memverifikasi kebenaran isu, berita hoaks, atau rumor seputar sekolah (seperti isu pendaftaran palsu atau pemungutan biaya). 😊";
        }

        // 13. Prestasi
        if (str_contains($promptLower, 'prestasi') || str_contains($promptLower, 'juara') || str_contains($promptLower, 'lks')) {
            return "Halo! 👋 SMKN 2 Kota Mojokerto kaya akan **Prestasi Siswa**:\n\n🏆 **Juara LKS Web Technologies & Graphic Design** tingkat Jawa Timur\n🏆 **Juara 3 & Juara Favorit Lomba Cerdas Cermat & Koperasi Syariah** tingkat Provinsi Jawa Timur\n🏆 **Status Sekolah Pusat Keunggulan (PK) & Sekolah Adiwiyata**\n\nKamu bisa melihat galeri karya dan rincian prestasi di menu Karya & Prestasi Siswa! 😊";
        }

        // 14. Kawi Laras
        if (str_contains($promptLower, 'kawi laras') || str_contains($promptLower, 'kawilaras') || str_contains($promptLower, 'kamis wiwitan')) {
            return "Halo! 👋 **Kawi Laras (Kamis Wiwitan Laku Adab Lan Rasa Sayekti)** adalah program budaya mingguan di SMKN 2 Kota Mojokerto.\n\n👘 Setiap Kamis minggu kedua setiap bulan, seluruh siswa dan guru mengenakan busana tradisional Jawa (lurik & kebaya) serta menerapkan nilai ungah-ungguh dan adab budaya Jawa. 😊";
        }

        // 15. Matchmaker Quiz
        if (str_contains($promptLower, 'quiz') || str_contains($promptLower, 'matchmaker')) {
            return "Halo! 👋 **Fitur Ekskul Matchmaker Quiz** adalah kuiz interaktif di website SMKN 2 Kota Mojokerto untuk membantu siswa menemukan ekstrakurikuler yang paling sesuai dengan minat, bakat, dan hobi kamu!\n\n🎯 Kamu cukup menjawab beberapa pertanyaan sederhana, dan sistem akan merekomendasikan ekskul yang paling pas buat kamu! 😊";
        }

        // Fallback for context chunks if topic is in context chunk title
        if (!empty($contextChunks)) {
            $targetChunk = $contextChunks[0];
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

            $response = "Halo! 👋 Berdasarkan data resmi SMKN 2 Kota Mojokerto:\n\n📌 **{$displayTitle}**:\n{$cleanContent}\n\nAda hal lain yang ingin kamu tanyakan seputar SMKN 2 Kota Mojokerto? NARA siap membantu! 😊";
            $response = str_replace('***', '', $response);
            $response = (string) preg_replace('/\*{3,}/', '**', $response);

            return $response;
        }

        return $notFoundMessage;
    }
}
