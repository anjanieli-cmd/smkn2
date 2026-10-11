<?php

namespace App\Services\Chatbot;

use App\Interfaces\AI\AIProviderInterface;

class MockGeminiProvider implements AIProviderInterface
{
    public function generateResponse(string $userPrompt, array $contextChunks): string
    {
        $notFoundMessage = "Halo! 👋 Saya NARA SKANEDA (SMKN 2 Kota Mojokerto Assistance & Resource Agent). Maaf, informasi tersebut belum tersedia dalam basis pengetahuan resmi SMKN 2 Kota Mojokerto.";

        if (empty($contextChunks)) {
            return $notFoundMessage;
        }

        $promptLower = mb_strtolower(trim($userPrompt));

        // 0. Greetings & Conversational Openers (only when no specific topic keyword is present)
        $hasSpecificTopic = str_contains($promptLower, 'rpl') || str_contains($promptLower, 'dkv') || str_contains($promptLower, 'aphp') ||
                            str_contains($promptLower, 'kuliner') || str_contains($promptLower, 'boga') || str_contains($promptLower, 'lps') ||
                            str_contains($promptLower, 'perbankan') || str_contains($promptLower, 'jurusan') || str_contains($promptLower, 'keahlian') ||
                            str_contains($promptLower, 'proli') || str_contains($promptLower, 'ekskul') || str_contains($promptLower, 'ekstrakurikuler') ||
                            str_contains($promptLower, 'ppdb') || str_contains($promptLower, 'pendaftaran') || str_contains($promptLower, 'guru') ||
                            str_contains($promptLower, 'staf') || str_contains($promptLower, 'staff') || str_contains($promptLower, 'pendidik') ||
                            str_contains($promptLower, 'kependidikan') || str_contains($promptLower, 'tata usaha') || preg_match('/\btu\b/u', $promptLower) ||
                            str_contains($promptLower, 'ruangan') || str_contains($promptLower, 'ruang') || str_contains($promptLower, 'tempat') ||
                            str_contains($promptLower, 'lokasi') || str_contains($promptLower, 'area') || str_contains($promptLower, 'gedung') ||
                            str_contains($promptLower, 'lab') || str_contains($promptLower, 'studio') || str_contains($promptLower, 'bengkel') ||
                            str_contains($promptLower, 'liat') || str_contains($promptLower, 'lihat') || str_contains($promptLower, 'tampil') ||
                            str_contains($promptLower, 'karya') || str_contains($promptLower, 'produk') || str_contains($promptLower, 'kegiatan') ||
                            str_contains($promptLower, 'acara') || str_contains($promptLower, 'agenda') || str_contains($promptLower, 'lomba') ||
                            str_contains($promptLower, 'kepsek') || str_contains($promptLower, 'iswahyudi') || str_contains($promptLower, 'kantin') ||
                            str_contains($promptLower, 'perpustakaan') || str_contains($promptLower, 'perpus') || str_contains($promptLower, 'musholla') ||
                            str_contains($promptLower, 'masjid') || str_contains($promptLower, 'gerbang') || str_contains($promptLower, 'lobi') ||
                            str_contains($promptLower, 'lapangan') || str_contains($promptLower, 'aula') || str_contains($promptLower, 'parkir') ||
                            str_contains($promptLower, 'bkk') || str_contains($promptLower, 'dudi') || str_contains($promptLower, 'alumni') ||
                            str_contains($promptLower, 'fasilitas') || str_contains($promptLower, 'alamat') || str_contains($promptLower, 'kontak') ||
                            str_contains($promptLower, 'tour') || str_contains($promptLower, '360') || str_contains($promptLower, 'berita') ||
                            str_contains($promptLower, 'evoice') || str_contains($promptLower, 'factcheck') || str_contains($promptLower, 'prestasi') ||
                            str_contains($promptLower, 'kawi laras') || str_contains($promptLower, 'sejarah') || str_contains($promptLower, 'struktur') ||
                            str_contains($promptLower, 'organisasi') || str_contains($promptLower, 'waka') || str_contains($promptLower, 'wakil') ||
                            str_contains($promptLower, 'kaprog') || str_contains($promptLower, 'kaprodi') || str_contains($promptLower, 'ketua program') ||
                            str_contains($promptLower, 'bagan') || str_contains($promptLower, 'bendahara') || str_contains($promptLower, 'bos') ||
                            str_contains($promptLower, 'bpopp') || str_contains($promptLower, 'koordinator') || str_contains($promptLower, 'humas') ||
                            str_contains($promptLower, 'humastri') || str_contains($promptLower, 'sarpras') || str_contains($promptLower, 'kesiswaan') ||
                            str_contains($promptLower, 'kurikulum') || str_contains($promptLower, 'visi') || str_contains($promptLower, 'misi') ||
                            str_contains($promptLower, 'komite');

        $greetings = ['halo', 'haloo', 'hi', 'hai', 'p', 'ping', 'tes', 'test', 'selamat pagi', 'selamat siang', 'selamat sore', 'selamat malam', 'assalamualaikum', 'aku mau tanya', 'mau tanya', 'mau tanya dong', 'permisi', 'nara', 'halo nara', 'hai nara'];

        if (!$hasSpecificTopic && (in_array($promptLower, $greetings) || str_contains($promptLower, 'mau tanya') || str_contains($promptLower, 'apa yang bisa'))) {
            return "Halo! 👋 Saya NARA SKANEDA (SMKN 2 Kota Mojokerto Assistance & Resource Agent). Ada yang bisa NARA bantu seputar informasi SMKN 2 Kota Mojokerto? 😊";
        }

        // 0b. Sejarah Sekolah
        if (str_contains($promptLower, 'sejarah') || str_contains($promptLower, 'berdiri') || str_contains($promptLower, 'pendirian') || str_contains($promptLower, 'sejak')) {
            return "Halo! 👋 **Sejarah Singkat SMKN 2 Kota Mojokerto**:\n\nSMK Negeri 2 Mojokerto didirikan untuk mencetak tenaga kerja terampil dan profesional di Kota Mojokerto dan sekitarnya. Berdiri di kawasan strategis Pulorejo, Prajurit Kulon, sekolah ini berkembang pesat menjadi SMK Pusat Keunggulan (PK) dengan 5 konsentrasi keahlian unggulan berstandar nasional dan internasional.\n\nKamu dapat membaca kronologi dan galeri sejarah lengkap di menu [Sejarah Sekolah](/profile/history). 😊";
        }

        // 0c1. Waka (Wakil Kepala Sekolah)
        if (str_contains($promptLower, 'waka') || str_contains($promptLower, 'wakil')) {
            if (str_contains($promptLower, 'kurikulum')) {
                return "Halo! 👋 **Waka Kurikulum** SMKN 2 Kota Mojokerto adalah **MELATI PUSPITA SARI, S.Pd.** 📘\n\nBeliau mengelola kegiatan akademik, pembelajaran, dan Kurikulum Merdeka. 😊";
            }
            if (str_contains($promptLower, 'kesiswaan')) {
                return "Halo! 👋 **Waka Kesiswaan** SMKN 2 Kota Mojokerto adalah **AINUR ROFIK, M. Pd, Si.** 👨‍🎓\n\nBeliau membina karakter, kedisiplinan, dan kegiatan ekstrakurikuler siswa. 😊";
            }
            if (str_contains($promptLower, 'sarpras') || str_contains($promptLower, 'sarana')) {
                return "Halo! 👋 **Waka Sarana & Prasarana** SMKN 2 Kota Mojokerto adalah **M. WIRA HENDY HIMAWAN, M.Pd** 🏫\n\nBeliau mengelola fasilitas, laboratorium, dan gedung sekolah. 😊";
            }
            if (str_contains($promptLower, 'humas') || str_contains($promptLower, 'humastri') || str_contains($promptLower, 'hubungan industri')) {
                return "Halo! 👋 **Waka Humastri (Humas & Hubungan Industri)** SMKN 2 Kota Mojokerto adalah **ARIKAWWEKU CKRISNA, S.Pd.** 🤝\n\nBeliau mengelola kemitraan industri (DUDIKA), PKL/Prakerin, dan Bursa Kerja Khusus (BKK). 😊";
            }

            return "Halo! 👋 **Jajaran Wakil Kepala Sekolah (Waka) SMKN 2 Kota Mojokerto**:\n\n1. 📘 **Waka Kurikulum**: MELATI PUSPITA SARI, S.Pd.\n2. 👨‍🎓 **Waka Kesiswaan**: AINUR ROFIK, M. Pd, Si.\n3. 🏫 **Waka Sarana & Prasarana**: M. WIRA HENDY HIMAWAN, M.Pd\n4. 🤝 **Waka Humastri**: ARIKAWWEKU CKRISNA, S.Pd.\n\nDetail lengkap dapat kamu lihat di menu [Struktur Organisasi](/profile/structure). 😊";
        }

        // 0c2. Kaprog / Kaprodi (Ketua Kompetensi Keahlian)
        if (str_contains($promptLower, 'kaprog') || str_contains($promptLower, 'kaprodi') || str_contains($promptLower, 'ketua program') || str_contains($promptLower, 'ketua jurusan') || str_contains($promptLower, 'ketua kompetensi')) {
            if (str_contains($promptLower, 'rpl') || str_contains($promptLower, 'pplg') || str_contains($promptLower, 'perangkat lunak')) {
                return "Halo! 👋 **Ketua Kompetensi Keahlian (Kaprog/Kaprodi) RPL / PPLG** SMKN 2 Kota Mojokerto adalah **DANANG TEGUH SANTOSO, S.Kom** 💻.\n\nBeliau mengoordinasikan pembelajaran dan pengembangan kompetensi keahlian RPL. 😊";
            }
            if (str_contains($promptLower, 'dkv') || str_contains($promptLower, 'desain')) {
                return "Halo! 👋 **Ketua Kompetensi Keahlian (Kaprog/Kaprodi) DKV** SMKN 2 Kota Mojokerto adalah **NURFALAH SEPTAYOGA S.Kom.** 🎨.\n\nBeliau mengoordinasikan pembelajaran dan pengembangan kompetensi keahlian Desain Komunikasi Visual. 😊";
            }
            if (str_contains($promptLower, 'aphp') || str_contains($promptLower, 'pertanian')) {
                return "Halo! 👋 **Ketua Kompetensi Keahlian (Kaprog/Kaprodi) APHP** SMKN 2 Kota Mojokerto adalah **DESY ANDINI DILIAWATI, S.T.P.** 🌾.\n\nBeliau mengoordinasikan pembelajaran dan pengembangan kompetensi Agribisnis Pengolahan Hasil Pertanian. 😊";
            }
            if (str_contains($promptLower, 'kuliner') || str_contains($promptLower, 'boga') || str_contains($promptLower, 'tata boga')) {
                return "Halo! 👋 **Ketua Kompetensi Keahlian (Kaprog/Kaprodi) Kuliner / Tata Boga** SMKN 2 Kota Mojokerto adalah **DHIYAH AMANATI KARTIKA SARI, S.Pd.** 🍳.\n\nBeliau mengoordinasikan pembelajaran dan pengembangan kompetensi keahlian Kuliner. 😊";
            }
            if (str_contains($promptLower, 'lps') || str_contains($promptLower, 'perbankan')) {
                return "Halo! 👋 **Ketua Kompetensi Keahlian (Kaprog/Kaprodi) LPS** SMKN 2 Kota Mojokerto adalah **METIY ARIANA, S.Pd, M.Pd.** 🏦.\n\nBeliau mengoordinasikan pembelajaran dan pengembangan kompetensi Layanan Perbankan Syariah. 😊";
            }

            return "Halo! 👋 **Ketua Kompetensi Keahlian (Kaprog/Kaprodi) SMKN 2 Kota Mojokerto**:\n\n💻 **Kaprog RPL (PPLG)**: DANANG TEGUH SANTOSO, S.Kom\n🎨 **Kaprog DKV**: NURFALAH SEPTAYOGA S.Kom.\n🌾 **Kaprog APHP**: DESY ANDINI DILIAWATI, S.T.P.\n🍳 **Kaprog Kuliner**: DHIYAH AMANATI KARTIKA SARI, S.Pd.\n🏦 **Kaprog LPS**: METIY ARIANA, S.Pd, M.Pd.\n\nDetail lengkap dapat kamu lihat di menu [Struktur Organisasi](/profile/structure). 😊";
        }

        // 0c3. Bendahara (BOS & BPOPP)
        if (str_contains($promptLower, 'bendahara') || str_contains($promptLower, 'bos') || str_contains($promptLower, 'bpopp')) {
            if (str_contains($promptLower, 'bpopp')) {
                return "Halo! 👋 **Bendahara BPOPP** SMKN 2 Kota Mojokerto adalah **FAJAR DHILAMAYA, S.Pd.** 💳.\n\nBeliau mengelola administrasi keuangan program BPOPP sekolah. 😊";
            }
            if (str_contains($promptLower, 'bos')) {
                return "Halo! 👋 **Bendahara BOS** SMKN 2 Kota Mojokerto adalah **MEGA NOVINDA SARI, S.Pd.** 💰.\n\nBeliau mengelola administrasi dan pencatatan dana BOS sekolah. 😊";
            }
            return "Halo! 👋 **Bendahara SMKN 2 Kota Mojokerto**:\n\n💰 **Bendahara BOS**: MEGA NOVINDA SARI, S.Pd.\n💳 **Bendahara BPOPP**: FAJAR DHILAMAYA, S.Pd.\n\nDetail lengkap dapat kamu lihat di menu [Struktur Organisasi](/profile/structure). 😊";
        }

        // 0c4. Koordinator BKK
        if (str_contains($promptLower, 'bkk') && (str_contains($promptLower, 'koordinator') || str_contains($promptLower, 'ketua') || str_contains($promptLower, 'siapa') || str_contains($promptLower, 'pimpinan'))) {
            return "Halo! 👋 **Koordinator BKK (Bursa Kerja Khusus)** SMKN 2 Kota Mojokerto adalah **MULAT ADITYAWIRANTI, S.Pd.** 🤝\n\nBeliau mengoordinasikan Bursa Kerja Khusus, Prakerin/PKL, dan kemitraan penyaluran lulusan ke industri. 😊";
        }

        // 0c5. Komite Sekolah
        if (str_contains($promptLower, 'komite')) {
            return "Halo! 👋 **Komite Sekolah SMKN 2 Kota Mojokerto**:\n\nKomite Sekolah berperan aktif memberikan pertimbangan, masukan strategis, serta mengawal kualitas layanan dan fasilitas pendidikan bersama sekolah dan orang tua murid.\n\nInformasi kepengurusan dapat kamu lihat di menu [Struktur Organisasi](/profile/structure). 😊";
        }

        // 0c6. Struktur Organisasi & Bagan
        if (str_contains($promptLower, 'struktur') || str_contains($promptLower, 'organisasi') || str_contains($promptLower, 'bagan') || str_contains($promptLower, 'susunan') || str_contains($promptLower, 'pengurus')) {
            return "Halo! 👋 **Struktur Organisasi Resmi SMKN 2 Kota Mojokerto**:\n\n🏛️ **Kepala Sekolah**: Iswahyudi S.ST. M.Pd.\n\n👔 **Jajaran Waka**:\n• Waka Kurikulum: MELATI PUSPITA SARI, S.Pd.\n• Waka Kesiswaan: AINUR ROFIK, M. Pd, Si.\n• Waka Sarana & Prasarana: M. WIRA HENDY HIMAWAN, M.Pd\n• Waka Humastri: ARIKAWWEKU CKRISNA, S.Pd.\n\n💰 **Bendahara & Unit**:\n• Bendahara BOS: MEGA NOVINDA SARI, S.Pd.\n• Bendahara BPOPP: FAJAR DHILAMAYA, S.Pd.\n• Koordinator BKK: MULAT ADITYAWIRANTI, S.Pd.\n\n📚 **Kaprog / Kaprodi**:\n• RPL: DANANG TEGUH SANTOSO, S.Kom\n• DKV: NURFALAH SEPTAYOGA S.Kom.\n• APHP: DESY ANDINI DILIAWATI, S.T.P.\n• Kuliner: DHIYAH AMANATI KARTIKA SARI, S.Pd.\n• LPS: METIY ARIANA, S.Pd, M.Pd.\n\nStruktur bagan dan susunan organisasi lengkap dapat kamu lihat di menu [Struktur Organisasi](/profile/structure). 😊";
        }

        // 0d. Visi & Misi
        if (str_contains($promptLower, 'visi') || str_contains($promptLower, 'misi')) {
            return "Halo! 👋 **Visi & Misi SMKN 2 Kota Mojokerto**:\n\n🎯 **Visi**: Terwujudnya lulusan yang berakhlak mulia, kompeten, berjiwa wirausaha, dan berdaya saing global.\n\n📌 **Misi Utama**:\n1. Menyelenggarakan pendidikan kejuruan berbasis karakter dan religius.\n2. Mengembangkan kurikulum berstandar industri bersama mitra DUDIKA.\n3. Meningkatkan kualitas sarana laboratorium & Teaching Factory (TEFA).\n4. Membekali siswa dengan keterampilan digital, kewirausahaan, dan kesiapan kerja. 😊";
        }

        // 0e. Perpustakaan & Literasi
        if (str_contains($promptLower, 'perpustakaan') || str_contains($promptLower, 'perpus') || str_contains($promptLower, 'buku') || str_contains($promptLower, 'literasi')) {
            return "Halo! 👋 Ya, di SMKN 2 Kota Mojokerto terdapat **Perpustakaan Digital** 📚 yang menyediakan koleksi buku cetak, e-book, referensi pembelajaran, dan area baca yang tenang serta nyaman bagi seluruh siswa dan guru.\n\nAnda dapat melihat dan mengunjungi lokasi tempat ini secara langsung di halaman [Virtual Tour 360°](/profile/tour). 😊";
        }

        // Reject out-of-scope queries explicitly
        if (
            str_contains($promptLower, 'persiapan') ||
            str_contains($promptLower, 'dipersiapkan') ||
            str_contains($promptLower, 'diperlukan')
        ) {
            return $notFoundMessage;
        }

        // 0f1. Specific Room / Lab Virtual Tour Requests (e.g. "ruangan lab rpl", "liat lab dkv", "virtual tour lab rpl")
        $isLookOrRoom = str_contains($promptLower, 'ruangan') || str_contains($promptLower, 'ruang') ||
                        str_contains($promptLower, 'tempat') || str_contains($promptLower, 'lokasi') ||
                        str_contains($promptLower, 'area') || str_contains($promptLower, 'gedung') ||
                        str_contains($promptLower, 'lab') || str_contains($promptLower, 'studio') ||
                        str_contains($promptLower, 'bengkel') || str_contains($promptLower, 'liat') ||
                        str_contains($promptLower, 'lihat') || str_contains($promptLower, 'tour') ||
                        str_contains($promptLower, '360') || str_contains($promptLower, 'jelajah');

        if ($isLookOrRoom) {
            if (str_contains($promptLower, 'rpl') || str_contains($promptLower, 'pplg') || str_contains($promptLower, 'perangkat lunak')) {
                return "Halo! 👋 **Laboratorium RPL (Rekayasa Perangkat Lunak)** SMKN 2 Kota Mojokerto:\n\n💻 Ruang praktik komputer RPL (Lab RPL 1 & Lab RPL 2 di Lantai 2 Gedung Utama) yang dilengkapi unit PC High-Spec untuk pemrograman web, mobile app development, dan software engineering.\n\nKamu dapat melihat dan menjelajahi ruangan ini secara 360° di menu [Virtual Tour 360° Lab RPL](/profile/tour?scene=lab-rpl). 😊";
            }
            if (str_contains($promptLower, 'dkv') || str_contains($promptLower, 'desain')) {
                return "Halo! 👋 **Laboratorium & Studio DKV** SMKN 2 Kota Mojokerto:\n\n🎨 Ruang praktik Desain Komunikasi Visual yang dilengkapi PC grafis high-spec, Studio Fotografi, dan studio karya multimedia.\n\nKamu dapat melihat dan menjelajahi ruangan ini secara 360° di menu [Virtual Tour 360° Lab DKV](/profile/tour?scene=lab-dkv). 😊";
            }
            if (str_contains($promptLower, 'aphp') || str_contains($promptLower, 'pertanian')) {
                return "Halo! 👋 **Laboratorium APHP** SMKN 2 Kota Mojokerto:\n\n🌾 Ruang praktik Agribisnis Pengolahan Hasil Pertanian (Lab APHP 1 & Lab APHP 2) untuk teknologi pengolahan pangan dan pengujian mikrobiologi.\n\nKamu dapat melihat dan menjelajahi ruangan ini secara 360° di menu [Virtual Tour 360° Lab APHP](/profile/tour?scene=lab-1-aphp). 😊";
            }
            if (str_contains($promptLower, 'kuliner') || str_contains($promptLower, 'boga') || str_contains($promptLower, 'pastry')) {
                return "Halo! 👋 **Laboratorium Pastry & Tata Hidang (Kuliner)** SMKN 2 Kota Mojokerto:\n\n🍳 Dapur Kitchen Lab utama, Lab Pastry & Bakery, serta Restoran Simulasi TEFA untuk praktik memasak dan layanan tata hidang.\n\nKamu dapat melihat dan menjelajahi ruangan ini secara 360° di menu [Virtual Tour 360° Lab Pastry](/profile/tour?scene=lab-pastry). 😊";
            }
            if (str_contains($promptLower, 'lps') || str_contains($promptLower, 'perbankan')) {
                return "Halo! 👋 **Laboratorium LPS (Bank Mini Syariah)** SMKN 2 Kota Mojokerto:\n\n🏦 Ruang praktik Layanan Perbankan Syariah yang dirancang layaknya kantor cabang Bank Mini Syariah BSI untuk simulasi teller & customer service.\n\nKamu dapat melihat dan menjelajahi ruangan ini secara 360° di menu [Virtual Tour 360° Lab LPS](/profile/tour?scene=lab-lps). 😊";
            }
        }

        // 0f2. General Room / Location / Place List Requests (e.g. "ada tempat aja di skaneda", "di skaneda ada ruangan apa aja", "daftar ruangan")
        if (str_contains($promptLower, 'ruangan') || (str_contains($promptLower, 'ruang') && !str_contains($promptLower, 'peluang')) || str_contains($promptLower, 'tempat') || str_contains($promptLower, 'lokasi') || str_contains($promptLower, 'area') || str_contains($promptLower, 'gedung') || str_contains($promptLower, 'ada lab') || str_contains($promptLower, 'daftar lab')) {
            return "Halo! 👋 **Daftar Ruangan, Tempat & Fasilitas di SMKN 2 Kota Mojokerto**:\n\n💻 **Laboratorium Komputer & Praktik Keahlian**:\n• **Lab RPL 1 & 2**: Ruang komputer pemrograman & web development.\n• **Studio DKV & Studio Fotografi**: Ruang desain grafis & fotografi studio.\n• **Lab APHP 1 & 2**: Ruang pengolahan pangan & lab mikrobiologi.\n• **Kitchen Lab Pastry & Lab Tata Hidang**: Dapur praktik & restoran TEFA Kuliner.\n• **Lab Bank Mini Syariah (LPS)**: Ruang simulasi perbankan BSI.\n\n🏫 **Tempat & Fasilitas Pembelajaran Utama**:\n• **Gerbang Utama & Lobi Sekolah**\n• **Ruang Kelas Teori & Kelas Belakang**\n• **Perpustakaan Digital**\n• **Aula Serbaguna**\n• **Masjid Al-Ikhlas & Musholla**\n• **Kantin Sekolah, Lapangan Olahraga, & Area Parkir**\n\nKamu dapat melihat dan menjelajahi seluruh ruangan dan tempat tersebut secara 360° di menu [Virtual Tour 360°](/profile/tour). 😊";
        }

        // 1. Kepala Sekolah / Kepsek
        if (str_contains($promptLower, 'kepsek') || str_contains($promptLower, 'kepala sekolah') || str_contains($promptLower, 'iswahyudi') || str_contains($promptLower, 'pimpinan')) {
            return "Halo! 👋 Kepala Sekolah (Pimpinan) SMKN 2 Kota Mojokerto saat ini adalah **Bapak Iswahyudi S.ST. M.Pd.** 👨‍🏫.\n\nBeliau memimpin penyelenggaraan pendidikan di SMKN 2 Kota Mojokerto untuk mewujudkan sekolah kejuruan yang unggul, berkarakter, dan berdaya saing global. Ada hal lain yang ingin kamu tanyakan seputar kepemimpinan atau program sekolah kami? 😊";
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

        // Reject invalid / non-existent subjects explicitly
        if (
            str_contains($promptLower, 'otomotif') ||
            str_contains($promptLower, 'mesin') ||
            str_contains($promptLower, 'kasur') ||
            str_contains($promptLower, 'fisika') ||
            str_contains($promptLower, 'renang') ||
            str_contains($promptLower, 'catur') ||
            str_contains($promptLower, 'tkj') ||
            str_contains($promptLower, 'tav') ||
            str_contains($promptLower, 'farmasi') ||
            str_contains($promptLower, 'keperawatan') ||
            str_contains($promptLower, 'kecantikan') ||
            str_contains($promptLower, 'panah') ||
            str_contains($promptLower, 'drumband') ||
            str_contains($promptLower, 'merek') ||
            str_contains($promptLower, 'merk') ||
            str_contains($promptLower, 'presiden') ||
            str_contains($promptLower, 'makanan') ||
            str_contains($promptLower, 'resep')
        ) {
            return $notFoundMessage;
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

        // 4b. Jam Belajar / Pembelajaran Siswa (06.45 - 15.00 WIB)
        if (str_contains($promptLower, 'jam belajar') || str_contains($promptLower, 'pembelajaran') || str_contains($promptLower, 'jam pembelajaran') || str_contains($promptLower, 'jadwal belajar') || str_contains($promptLower, 'jam masuk') || str_contains($promptLower, 'jam pulang') || str_contains($promptLower, 'kbm')) {
            return "Halo! 👋 **Jam Belajar / Pembelajaran Siswa SMKN 2 Kota Mojokerto**:\n\n🎒 **Jam Belajar (KBM Siswa)**: Senin – Jumat · 06.45 – 15.00 WIB\n🚪 **Pintu Gerbang**: Ditutup tepat pukul 06.45 WIB demi kedisiplinan & ketertiban siswa.\n🗓️ **Hari Libur**: Sabtu & Minggu Libur. 😊";
        }

        // 4c. Jam Operasional Sekolah & Pelayanan Kantor TU (07.00 - 16.00 WIB)
        if (str_contains($promptLower, 'operasional') || str_contains($promptLower, 'jam operasional') || str_contains($promptLower, 'jam kantor') || str_contains($promptLower, 'pelayanan tu') || str_contains($promptLower, 'kantor tu')) {
            return "Halo! 👋 **Jam Operasional Sekolah & Pelayanan Kantor TU SMKN 2 Kota Mojokerto**:\n\n🏢 **Jam Operasional / Pelayanan TU**: Senin – Jumat · 07.00 – 16.00 WIB\n🗓️ **Hari Libur**: Sabtu & Minggu Libur. 😊";
        }

        // 5. Profil & Alamat
        if (str_contains($promptLower, 'alamat') || str_contains($promptLower, 'kontak') || str_contains($promptLower, 'lokasi sekolah') || str_contains($promptLower, 'dimana sekolah')) {
            return "Halo! 👋 Informasi Resmi Profil & Alamat SMKN 2 Kota Mojokerto:\n\n🏫 **Alamat**: Jl. Raya Pulorejo, Kel. Pulorejo, Kec. Prajurit Kulon, Kota Mojokerto, Jawa Timur 61325.\n📞 **Telepon**: 0312 2292 9922 / (0321) 321555 | ✉️ **Email**: info@smkn2mojokerto.sch.id\n⏰ **Jam Operasional**: Senin–Jumat · 07.00–16.00 WIB (Sabtu & Minggu Libur)\n⭐ **Akreditasi**: A (Unggul) | **Status**: SMK Pusat Keunggulan (PK)\n🎯 **Motto**: *Disiplin • Berakhlak • Berprestasi*. 😊";
        }

        // 6a. Staf (Tenaga Kependidikan) — Check staf FIRST so "staf" query gets staff specific answer
        if (str_contains($promptLower, 'staf') || str_contains($promptLower, 'staff') || str_contains($promptLower, 'kependidikan') || str_contains($promptLower, 'tata usaha') || preg_match('/\btu\b/u', $promptLower)) {
            return "Halo! 👋 **Tenaga Kependidikan / Staf SMKN 2 Kota Mojokerto**:\n\nSMK Negeri 2 Mojokerto memiliki **20+ Tenaga Kependidikan & Staf** yang mengelola administrasi, keuangan, perpustakaan, dan layanan operasional sekolah:\n\n💰 **Bendahara BOS**: MEGA NOVINDA SARI, S.Pd.\n💳 **Bendahara BPOPP**: FAJAR DHILAMAYA, S.Pd.\n🤝 **Koordinator BKK**: MULAT ADITYAWIRANTI, S.Pd.\n🏫 **Staf Tata Usaha (TU), Perpustakaan Digital, Teknisi Lab, & Pengelola Sarana Sekolah**.\n\nDaftar staf kependidikan selengkapnya dapat kamu lihat di menu [Staff & Guru](/profile/staff-guru). 😊";
        }

        // 6b. Guru (Tenaga Pendidik)
        if (str_contains($promptLower, 'guru') || str_contains($promptLower, 'pendidik') || str_contains($promptLower, 'pengajar')) {
            return "Halo! 👋 **Tenaga Pendidik / Guru SMKN 2 Kota Mojokerto**:\n\nSMK Negeri 2 Mojokerto didukung oleh **67+ Guru Profesional & Bersertifikasi Pendidik** yang mengajar di bidang produktif keahlian (RPL, DKV, APHP, Kuliner, LPS) maupun kelompok mata pelajaran normatif-adaptif (Matematika, Bahasa Indonesia, Bahasa Inggris, Agama, IPAS, PJOK, dsb).\n\nProfil dewan guru selengkapnya dapat kamu lihat di menu [Staff & Guru](/profile/staff-guru). 😊";
        }

        // 6c. Karya Siswa / Produk Inovatif
        if (str_contains($promptLower, 'karya') || str_contains($promptLower, 'produk siswa') || str_contains($promptLower, 'hasil karya')) {
            return "Halo! 👋 **Karya & Produk Inovatif Siswa SMKN 2 Kota Mojokerto**:\n\n1. 🌾 **MultiMie & Sari Bunga Telang** — Produk olahan mi sehat & minuman herbal karya siswa APHP & Kuliner.\n2. 🚗 **Aplikasi Tambal Ban Express** — Aplikasi booking & pemesanan layanan tambal ban mobile karya siswa RPL.\n3. 🎨 **Nirmana 3D & Visual Branding** — Karya desain grafis, ilustrasi, animasi 3D, & fotografi studio karya siswa DKV.\n4. 🍳 **Pastry & Bakery TEFA** — Roti, cake, & pastry produk Teaching Factory karya siswa Kuliner.\n5. 🍹 **Maja Mojo & Bei Mie** — Olahan produk inovasi pangan karya siswa APHP.\n6. 🏦 **Layanan Mini Bank Syariah** — Operasional transaksi & administrasi keuangan karya siswa LPS.\n\nKamu dapat melihat galeri karya siswa selengkapnya di menu [Karya Siswa](/siswa/karya). 😊";
        }

        // 6d. Kegiatan Sekolah
        if (str_contains($promptLower, 'kegiatan') || str_contains($promptLower, 'acara') || str_contains($promptLower, 'agenda')) {
            return "Halo! 👋 **Jurnal Kegiatan & Agenda SMKN 2 Kota Mojokerto**:\n\n📌 **Uji Kompetensi Keahlian (UKK)** — Ujian kelulusan berstandar industri bersama penguji DUDIKA.\n📌 **Program Budaya Kawi Laras** — Pelestarian budaya Jawa mengenakan busana tradisional tiap bulan.\n📌 **Praktek Kerja Lapangan (PKL) & Rekrutmen BKK** — Pembekalan & rekrutmen bersama industri mitra.\n📌 **Pentas Seni (Pensi), TEFA Expo, & Pameran Karya Siswa**.\n📌 **Gerakan Sekolah Sehat (GSS) & Kegiatan Keagamaan** di Masjid Al-Ikhlas.\n\nKamu dapat melihat jurnal foto kegiatan di menu [Kegiatan Sekolah](/galeri/kegiatan) dan Berita di [Berita Sekolah](/berita). 😊";
        }

        // 7. Fasilitas & Tempat Spesifik
        if (str_contains($promptLower, 'gerbang')) {
            return "Halo! 👋 Ya, SMKN 2 Kota Mojokerto memiliki **Gerbang Utama** 🏫 yang megah dan aman di Jl. Raya Pulorejo, Kel. Pulorejo, Kec. Prajurit Kulon, Kota Mojokerto 61325. Gerbang ditutup tepat pukul 07.00 WIB demi ketertiban siswa.\n\nKamu dapat melihat tampilan Gerbang Utama secara 360° di menu [Virtual Tour 360°](/profile/tour). 😊";
        }
        if (str_contains($promptLower, 'kantin')) {
            return "Halo! 👋 Ya, di SMKN 2 Kota Mojokerto terdapat **Kantin Sekolah** 🍱 yang bersih, sehat, dan menyediakan aneka makanan serta minuman higienis untuk siswa.\n\nKamu bisa melihat lokasi Kantin Sekolah secara 360° di menu [Virtual Tour 360°](/profile/tour). 😊";
        }
        if (str_contains($promptLower, 'musholla') || str_contains($promptLower, 'masjid')) {
            return "Halo! 👋 Ya, SMKN 2 Kota Mojokerto memiliki **Masjid Al-Ikhlas & Musholla** 🕌 yang bersih dan nyaman sebagai tempat ibadah, sholat berjamaah, serta kegiatan keagamaan siswa.\n\nKamu dapat melihat lokasinya secara 360° di menu [Virtual Tour 360°](/profile/tour). 😊";
        }
        if (str_contains($promptLower, 'aula')) {
            return "Halo! 👋 Ya, SMKN 2 Kota Mojokerto memiliki **Aula Serbaguna** 🏛️ yang luas untuk kegiatan upacara indoor, seminar, pementasan seni, serta pertemuan resmi sekolah.\n\nKamu bisa menjelajahi lokasi Aula di menu [Virtual Tour 360°](/profile/tour). 😊";
        }
        if (str_contains($promptLower, 'lapangan')) {
            return "Halo! 👋 Ya, SMKN 2 Kota Mojokerto memiliki **Lapangan Utama & Lapangan Basket Beratap** 🏀 untuk kegiatan upacara, olahraga, serta latihan futsal dan basket.\n\nKamu dapat melihat Lapangan Olahraga secara 360° di menu [Virtual Tour 360°](/profile/tour). 😊";
        }
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
        if (str_contains($promptLower, 'berita') || str_contains($promptLower, 'kabar') || str_contains($promptLower, 'terbaru') || str_contains($promptLower, 'artikel')) {
            return "Halo! 👋 **Berita & Kabar Terbaru SMKN 2 Kota Mojokerto**:\n\n📰 **Pelatihan Web Framework Laravel 2024** — Pembekalan siswa RPL bersama alumni profesional.\n📰 **Pelaksanaan Uji Kompetensi Keahlian (UKK)** — Ujian bersama penguji industri mitra.\n📰 **Literasi Keuangan Syariah & Perbankan** — Edukasi pembiayaan bersama BSI & Bakti BCA.\n📰 **Program Budaya Kawi Laras** — Pelestarian budaya Jawa di lingkungan sekolah.\n📰 **Program Gerakan Sekolah Sehat (GSS)** — Pembinaan kebugaran fisik & kesehatan siswa.\n\nKamu bisa membaca artikel berita lengkap di menu [Berita Sekolah](/berita). 😊";
        }

        // 12. E-Voice & FactCheck
        if (str_contains($promptLower, 'evoice') || str_contains($promptLower, 'e-voice') || str_contains($promptLower, 'aspirasi') || str_contains($promptLower, 'pengaduan')) {
            return "Halo! 👋 **E-Voice SKANEDA** adalah portal pengaduan & aspirasi digital siswa SMKN 2 Kota Mojokerto.\n\n📣 Kamu dapat menyampaikan saran, kritik membangun, atau pengaduan secara transparan, memberikan dukungan (upvote) pada aspirasi teman, dan memantau status tindak lanjut dari sekolah secara real-time! 😊";
        }
        if (str_contains($promptLower, 'factcheck') || str_contains($promptLower, 'fact check') || str_contains($promptLower, 'hoaks') || str_contains($promptLower, 'hoax') || str_contains($promptLower, 'klarifikasi')) {
            return "Halo! 👋 **School FactCheck** adalah portal verifikasi berita resmi SMKN 2 Kota Mojokerto untuk memverifikasi kebenaran isu, berita hoaks, atau rumor seputar sekolah (seperti isu pendaftaran palsu atau pemungutan biaya). 😊";
        }

        // 13. Prestasi
        if (str_contains($promptLower, 'prestasi') || str_contains($promptLower, 'juara') || str_contains($promptLower, 'lks') || str_contains($promptLower, 'lomba')) {
            return "Halo! 👋 **Prestasi Unggulan Siswa SMKN 2 Kota Mojokerto**:\n\n🏆 **Juara FESTIKA Jatim 2025** (Dua tim siswa Skaneda meraih juara).\n🏆 **Juara 1 Pencak Silat KONI Championship** (Dhiva Alennia).\n🏆 **Juara 1 Web Development Polinema** (Tim Penerbang Roket RPL).\n🏆 **Medali Perak LKS Nasional Bidang Kuliner** (Patisserie & Confectionery).\n🏆 **Juara 3 LKS Jawa Timur 2026** (Lomba Kompetensi Siswa Jatim).\n🏆 **Finalis FIKSI Nasional 2025** (Tim APHP, DKV, & RPL).\n🏆 **Juara Nasional Paskibraka 2024** & Juara 1 Futsal Mojokerto Raya.\n🏆 **Penghargaan Sekolah Adiwiyata Provinsi Jawa Timur**.\n🎓 **Alumni Beasiswa Huaqiao University, China**.\n\nKamu dapat melihat daftar prestasi lengkap di menu [Prestasi Siswa](/siswa/prestasi). 😊";
        }

        // 14. Kawi Laras
        if (str_contains($promptLower, 'kawi laras') || str_contains($promptLower, 'kawilaras') || str_contains($promptLower, 'kamis wiwitan')) {
            return "Halo! 👋 **Kawi Laras (Kamis Wiwitan Laku Adab Lan Rasa Sayekti)** adalah program budaya mingguan di SMKN 2 Kota Mojokerto.\n\n👘 Setiap Kamis minggu kedua setiap bulan, seluruh siswa dan guru mengenakan busana tradisional Jawa (lurik & kebaya) serta menerapkan nilai ungah-ungguh dan adab budaya Jawa. 😊";
        }

        // 15. Matchmaker Quiz
        if (str_contains($promptLower, 'quiz') || str_contains($promptLower, 'matchmaker')) {
            return "Halo! 👋 **Fitur Ekskul Matchmaker Quiz** adalah kuiz interaktif di website SMKN 2 Kota Mojokerto untuk membantu siswa menemukan ekstrakurikuler yang paling sesuai dengan minat, bakat, dan hobi kamu!\n\n🎯 Kamu cukup menjawab beberapa pertanyaan sederhana, dan sistem akan merekomendasikan ekskul yang paling pas buat kamu! 😊";
        }

        // If query is not recognized or available in knowledge base, explicitly reject instead of returning random data
        return $notFoundMessage;
    }
}
