<?php

namespace App\Services\Chatbot;

use App\Enums\ChatbotKnowledgeStatus;
use App\Models\ChatbotKnowledge;
use App\Models\Extracurricular;
use App\Models\FactCheck;
use App\Models\IndustryPartnership;
use App\Models\JobVacancy;
use App\Models\Major;
use App\Models\SchoolProfile;
use App\Models\TeacherStaff;
use Illuminate\Support\Facades\Cache;

class KnowledgeRetrieverService
{
    /**
     * Retrieve top relevant knowledge chunks strictly enforcing publication & AI permission boundaries.
     *
     * @param string $userMessage
     * @return array<int, string>
     */
    public function retrieveRelevantContext(string $userMessage): array
    {
        $matchedContexts = [];
        $normalizedMessage = mb_strtolower(trim($userMessage));

        // Tokenize user message into lower-case words (minimum 2 characters)
        $tokens = array_filter(
            preg_split('/\s+/', preg_replace('/[^\w\s]/u', '', $normalizedMessage)),
            fn ($token) => mb_strlen($token) >= 2
        );

        $stopWords = [
            'smkn', 'smk', 'mojokerto', 'sekolah', 'kota', 'jurusan', 'ekskul', 'ekstrakurikuler',
            'profil', 'info', 'informasi', 'dengan', 'untuk', 'yang', 'pada', 'atau', 'serta',
            'daftar', 'detail', 'tentang', 'mana', 'gimana', 'apa', 'aja', 'bisa', 'ada', 'mau',
            'tanya', 'kalo', 'kalau', 'bagaimana', 'apakah', 'ini', 'itu', 'dan', 'di', 'ke', 'dari'
        ];

        // 1. Query ChatbotKnowledge base
        $cacheKey = 'chatbot.knowledge.published.v3';
        $knowledges = Cache::remember($cacheKey, 3600, function () {
            return ChatbotKnowledge::query()
                ->where('status', ChatbotKnowledgeStatus::PUBLISHED)
                ->where('is_ai_allowed', true)
                ->orderBy('priority', 'desc')
                ->get(['title', 'category', 'content', 'keywords'])
                ->toArray();
        });

        // If cache returned empty array, invalidate cache and re-fetch directly from DB
        if (empty($knowledges)) {
            Cache::forget($cacheKey);
            $knowledges = ChatbotKnowledge::query()
                ->where('status', ChatbotKnowledgeStatus::PUBLISHED)
                ->where('is_ai_allowed', true)
                ->orderBy('priority', 'desc')
                ->get(['title', 'category', 'content', 'keywords'])
                ->toArray();
        }

        $scoredMatches = [];

        if (is_array($knowledges)) {
            foreach ($knowledges as $item) {
                if (is_array($item)) {
                    $title = $item['title'] ?? '';
                    $category = $item['category'] ?? '';
                    $content = $item['content'] ?? '';
                    $keywords = $item['keywords'] ?? [];
                    $priority = (int) ($item['priority'] ?? 0);
                } elseif (is_object($item) && isset($item->title)) {
                    $title = $item->title;
                    $category = $item->category;
                    $content = $item->content;
                    $keywords = $item->keywords;
                    $priority = (int) ($item->priority ?? 0);
                } else {
                    continue;
                }

                $titleNorm = mb_strtolower((string) $title);
                $categoryNorm = mb_strtolower((string) $category);
                $contentNorm = mb_strtolower((string) $content);

                $score = 0;

                // 1. Direct title match or specific token match in title
                if ($titleNorm !== '') {
                    if (str_contains($normalizedMessage, $titleNorm)) {
                        $score += 120;
                    }
                    foreach ($tokens as $token) {
                        if (str_contains($titleNorm, $token)) {
                            if (in_array($token, $stopWords, true)) {
                                $score += 2;
                            } else {
                                $score += 80;
                            }
                        }
                    }
                }

                // 2. Keyword match
                if (is_array($keywords)) {
                    foreach ($keywords as $keyword) {
                        $kwNorm = mb_strtolower((string) $keyword);
                        if ($kwNorm !== '') {
                            if (str_contains($normalizedMessage, $kwNorm)) {
                                $score += 60;
                            } elseif (in_array($kwNorm, $tokens, true)) {
                                $score += 50;
                            }
                        }
                    }
                }

                // 3. Category match
                if ($categoryNorm !== '' && (str_contains($normalizedMessage, $categoryNorm) || in_array($categoryNorm, $tokens, true))) {
                    $score += 30;
                }

                // 4. Content token overlap
                if (!empty($tokens)) {
                    foreach ($tokens as $token) {
                        if (!in_array($token, $stopWords, true) && str_contains($contentNorm, $token)) {
                            $score += 10;
                        }
                    }
                }

                // Priority weight bonus
                $score += ($priority * 2);

                if ($score >= 25) {
                    $scoredMatches[] = [
                        'score' => $score,
                        'chunk' => "[{$category}] {$title}: {$content}",
                    ];
                }
            }
        }

        if (!empty($scoredMatches)) {
            usort($scoredMatches, fn ($a, $b) => $b['score'] <=> $a['score']);
            foreach (array_slice($scoredMatches, 0, 4) as $match) {
                $matchedContexts[] = $match['chunk'];
            }
        }

        // 2. Dynamic Fallback to Domain Models if context is sparse (< 2 chunks)
        if (count($matchedContexts) < 2) {
            $fallbackContexts = $this->retrieveFromDomainModels($normalizedMessage, $tokens);
            $matchedContexts = array_merge($matchedContexts, $fallbackContexts);
        }

        return array_values(array_unique($matchedContexts));
    }

    /**
     * Fallback retrieval directly from application domain models.
     *
     * @param string $normalizedMessage
     * @param array<int, string> $tokens
     * @return array<int, string>
     */
    private function retrieveFromDomainModels(string $normalizedMessage, array $tokens): array
    {
        $fallbackContexts = [];

        // Check PPDB
        if (str_contains($normalizedMessage, 'ppdb') || str_contains($normalizedMessage, 'pendaftaran ppdb') || str_contains($normalizedMessage, 'jalur ppdb')) {
            $fallbackContexts[] = "[PPDB] Informasi PPDB 2026: Pendaftaran PPDB SMKN 2 Mojokerto dilakukan secara online melalui portal resmi PPDB Jawa Timur (Jalur Prestasi, Afirmasi, Zonasi). Pendaftaran TIDAK DIPUNGUT BIAYA (GRATIS).";
        }

        // Check Majors (Jurusan & Specific Major Sub-Keywords)
        if (str_contains($normalizedMessage, 'jurusan') || str_contains($normalizedMessage, 'keahlian') || str_contains($normalizedMessage, 'proli') || str_contains($normalizedMessage, 'rpl') || str_contains($normalizedMessage, 'dkv') || str_contains($normalizedMessage, 'aphp') || str_contains($normalizedMessage, 'kuliner') || str_contains($normalizedMessage, 'boga') || str_contains($normalizedMessage, 'lps') || str_contains($normalizedMessage, 'perbankan')) {
            $majors = Major::all(['code', 'name', 'description']);
            if ($majors->isNotEmpty()) {
                $majorList = $majors->map(fn ($m) => "{$m->code} ({$m->name}): {$m->description}")->implode(' | ');
                $fallbackContexts[] = "[Jurusan] Daftar Konsentrasi Keahlian SMKN 2 Mojokerto ({$majors->count()} Jurusan): {$majorList}";
            } else {
                $fallbackContexts[] = "[Jurusan] Daftar Konsentrasi Keahlian SMKN 2 Mojokerto: 1. Rekayasa Perangkat Lunak (RPL), 2. Desain Komunikasi Visual (DKV), 3. Agribisnis Pengolahan Hasil Pertanian (APHP), 4. Kuliner (Tata Boga), 5. Layanan Perbankan Syariah (LPS).";
            }
        }

        // Check School Profile (Visi, Misi, Alamat, Kontak)
        if (str_contains($normalizedMessage, 'visi') || str_contains($normalizedMessage, 'misi') || str_contains($normalizedMessage, 'alamat sekolah') || str_contains($normalizedMessage, 'kontak sekolah') || str_contains($normalizedMessage, 'profil sekolah')) {
            $profile = SchoolProfile::where('key', 'general')->first();
            if ($profile && is_array($profile->content)) {
                $c = $profile->content;
                $name = $c['name'] ?? 'SMK Negeri 2 Mojokerto';
                $address = $c['address'] ?? '';
                $phone = $c['phone'] ?? '';
                $email = $c['email'] ?? '';
                $vision = $c['vision'] ?? '';
                $mission = is_array($c['mission'] ?? null) ? implode('; ', $c['mission']) : ($c['mission'] ?? '');
                $fallbackContexts[] = "[Profil Sekolah] {$name}, Alamat: {$address}, Telp: {$phone}, Email: {$email}, Visi: {$vision}, Misi: {$mission}";
            } else {
                $fallbackContexts[] = "[Profil Sekolah] SMK Negeri 2 Mojokerto beralamat di Jl. Raden Wijaya No. 1, Kranggan, Kota Mojokerto, Jawa Timur. Telepon: (0321) 321555, Email: info@smkn2mojokerto.sch.id.";
            }
        }

        // Check Jam Belajar & Operasional
        if (str_contains($normalizedMessage, 'jam belajar') || str_contains($normalizedMessage, 'jadwal masuk') || str_contains($normalizedMessage, 'jam masuk') || str_contains($normalizedMessage, 'jam pulang')) {
            $fallbackContexts[] = "[Tata Tertib] Jam Belajar dan Operasional Sekolah: Kegiatan Belajar Mengajar (KBM) di SMKN 2 Mojokerto berlangsung hari Senin hingga Jumat pukul 07.00 WIB - 15.30 WIB. Gerbang sekolah ditutup tepat pukul 07.00 WIB. Hari Sabtu dan Minggu libur.";
        }

        // Check Extracurriculars (& Specific Ekskul Sub-Keywords)
        if (str_contains($normalizedMessage, 'ekskul') || str_contains($normalizedMessage, 'ekstrakurikuler') || str_contains($normalizedMessage, 'pramuka') || str_contains($normalizedMessage, 'paskibra') || str_contains($normalizedMessage, 'robotik') || str_contains($normalizedMessage, 'pmr') || str_contains($normalizedMessage, 'futsal') || str_contains($normalizedMessage, 'basket') || str_contains($normalizedMessage, 'voli') || str_contains($normalizedMessage, 'silat') || str_contains($normalizedMessage, 'tari') || str_contains($normalizedMessage, 'musik') || str_contains($normalizedMessage, 'rhisma') || str_contains($normalizedMessage, 'kir')) {
            $ekskuls = Extracurricular::all(['name', 'category', 'description']);
            if ($ekskuls->isNotEmpty()) {
                $ekskulList = $ekskuls->map(fn ($e) => "{$e->name} ({$e->category}): {$e->description}")->implode(' | ');
                $fallbackContexts[] = "[Ekstrakurikuler] Daftar Ekskul SMKN 2 Mojokerto: {$ekskulList}";
            } else {
                $fallbackContexts[] = "[Ekstrakurikuler] Kegiatan Ekstrakurikuler: Pramuka (Wajib), Paskibra, Robotik & Coding Club, PMR, Olahraga (Futsal, Basket, Voli), Seni Musik & Tari, serta Kerohanian Islam (Rhisma).";
            }
        }

        // Check Teacher & Staff / Kepsek
        if (str_contains($normalizedMessage, 'kepsek') || str_contains($normalizedMessage, 'kepala sekolah') || str_contains($normalizedMessage, 'iswahyudi') || str_contains($normalizedMessage, 'guru') || str_contains($normalizedMessage, 'pengajar') || str_contains($normalizedMessage, 'staf')) {
            $teachers = TeacherStaff::where('is_active', true)->get(['name', 'role_position']);
            if ($teachers->isNotEmpty()) {
                $teacherList = $teachers->map(fn ($t) => "{$t->name} ({$t->role_position})")->implode(', ');
                $fallbackContexts[] = "[Guru & Staf] Kepala Sekolah: Drs. Iswahyudi, M.Pd. Daftar Pengajar SMKN 2 Mojokerto: {$teacherList}";
            } else {
                $fallbackContexts[] = "[Guru & Staf] Kepala Sekolah SMKN 2 Mojokerto saat ini adalah Bapak Drs. Iswahyudi, M.Pd.";
            }
        }

        // Check Industry Partnerships & BKK
        if (str_contains($normalizedMessage, 'dudi') || str_contains($normalizedMessage, 'bkk') || str_contains($normalizedMessage, 'mitra industri') || str_contains($normalizedMessage, 'lowongan kerja')) {
            $partners = IndustryPartnership::where('is_active', true)->get(['company_name', 'field_of_work', 'partnership_scope']);
            if ($partners->isNotEmpty()) {
                $partnerList = $partners->map(fn ($p) => "{$p->company_name} ({$p->field_of_work} - {$p->partnership_scope})")->implode(', ');
                $fallbackContexts[] = "[Kemitraan DUDI] Perusahaan Mitra Industri & BKK: {$partnerList}";
            } else {
                $fallbackContexts[] = "[Kemitraan DUDI] Bursa Kerja Khusus (BKK) SMKN 2 Mojokerto bekerja sama dengan PT Telkom Indonesia, PT Astra International, Bank Syariah Indonesia, dan industri perhotelan/pangan.";
            }
        }

        // Check News & Events
        if (str_contains($normalizedMessage, 'berita') || str_contains($normalizedMessage, 'kabar berita')) {
            $news = \App\Models\NewsArticle::latest()->take(3)->get(['title', 'summary']);
            if ($news->isNotEmpty()) {
                $newsList = $news->map(fn ($n) => "• {$n->title}: {$n->summary}")->implode(' ');
                $fallbackContexts[] = "[Berita Terbaru] Berita & Agenda SMKN 2 Mojokerto: {$newsList}";
            }
        }

        return $fallbackContexts;
    }
}

