<?php

namespace App\Services\Chatbot;

class PromptGuardService
{
    /**
     * Phrases indicating malicious prompt injection attempts.
     */
    private array $injectionPhrases = [
        'ignore previous instructions',
        'forget your rules',
        'show system prompt',
        'show database',
        'give me api key',
        'give me all school data',
        'bypass restrictions',
        'act as developer mode',
        'print env',
        'show secrets',
    ];

    /**
     * Keywords indicating out-of-scope non-school topics.
     */
    private array $outOfScopePhrases = [
        'presiden',
        'resep',
        'nasi goreng',
        'cara masak',
        'cara membuat makanan',
        'cara membuat website',
        'siapa artis',
        'bagaimana hacking',
        'berita politik',
        'harga saham',
        'cuaca',
        'sejarah dunia',
        'game online',
        'mobile legends',
        'dota',
        'film',
        'lagu',
        'crypto',
        'kripto',
        'kantin',
        'menu kantin',
        'persiapan',
        'dipersiapkan',
        'diperlukan',
        'benci',
        'suka',
        'cinta',
        'curhat',
        'sayang',
        'kasur',
        'merek',
        'merk',
        'baju',
        'sepatu',
        'celana',
        'laptop',
        'smartphone',
        'handphone',
        'tokopedia',
        'shopee',
        'lazada',
        'beli',
        'jual',
        'diskon',
        'promo',
        'mobil',
        'motor',
        'bengkel',
        'wisata',
        'hotel',
        'restoran',
        'makanan',
        'minuman',
    ];

    /**
     * Keywords belonging to SMKN 2 Mojokerto school context domain.
     */
    private array $schoolDomainPhrases = [
        'smk', 'smkn', 'skaneda', 'mojokerto', 'sekolah', 'jurusan', 'keahlian', 'proli',
        'rpl', 'dkv', 'aphp', 'kuliner', 'lps', 'boga', 'perbankan', 'syariah', 'pplg',
        'guru', 'staf', 'pengajar', 'kepsek', 'kepala sekolah', 'iswahyudi', 'siswa',
        'ekskul', 'ekstrakurikuler', 'osis', 'lacurva', 'pasus', 'pramuka', 'paskib',
        'futsal', 'basket', 'voli', 'btq', 'banjari', 'jurnalistik', 'tari', 'teater',
        'pena', 'silat', 'pmr', 'pik-r', 'pikr', 'ppdb', 'pendaftaran', 'zonasi',
        'afirmasi', 'bkk', 'loker', 'lowongan', 'dudi', 'industri', 'pkl', 'magang',
        'alumni', 'portofolio', 'evoice', 'e-voice', 'aspirasi', 'factcheck', 'fact check',
        'hoaks', 'hoax', 'berita', 'karya', 'prestasi', 'lks', 'virtual tour', 'tour',
        'kawi laras', 'kawilaras', 'matchmaker', 'jadwal', 'jam belajar', 'kbm',
        'alamat', 'kontak', 'telepon', 'email', 'lokasi', 'fasilitas', 'perpus',
        'lab', 'studio', 'masjid', 'visi', 'misi', 'profil', 'sejarah', 'struktur'
    ];

    /**
     * Check if user message contains prompt injection.
     */
    public function isPromptInjection(string $message): bool
    {
        $normalized = mb_strtolower($message);

        foreach ($this->injectionPhrases as $phrase) {
            if (str_contains($normalized, $phrase)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if user message is out of scope.
     */
    public function isOutOfScope(string $message): bool
    {
        $normalized = mb_strtolower(trim($message));

        // 1. Explicit out-of-scope phrase match
        foreach ($this->outOfScopePhrases as $phrase) {
            if (str_contains($normalized, $phrase)) {
                return true;
            }
        }

        // 2. If message contains greetings only, allow it to pass to retriever
        if (in_array($normalized, ['halo', 'haloo', 'hi', 'hai', 'p', 'ping', 'tes', 'test', 'selamat pagi', 'selamat siang', 'selamat sore', 'selamat malam', 'assalamualaikum'])) {
            return false;
        }

        // 3. Domain relevance check: If query has >= 3 words and 0 school domain keywords, mark as out-of-scope
        $tokens = array_filter(
            preg_split('/\s+/', preg_replace('/[^\w\s]/u', '', $normalized)),
            fn ($t) => mb_strlen($t) >= 2
        );

        if (count($tokens) >= 1) {
            $hasDomainKeyword = false;
            foreach ($this->schoolDomainPhrases as $domainKeyword) {
                if (str_contains($normalized, $domainKeyword)) {
                    $hasDomainKeyword = true;
                    break;
                }
            }

            if (!$hasDomainKeyword) {
                return true;
            }
        }

        return false;
    }
}
