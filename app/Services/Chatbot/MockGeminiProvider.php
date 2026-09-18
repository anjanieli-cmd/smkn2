<?php

namespace App\Services\Chatbot;

use App\Interfaces\AI\AIProviderInterface;

class MockGeminiProvider implements AIProviderInterface
{
    public function generateResponse(string $userPrompt, array $contextChunks): string
    {
        if (empty($contextChunks)) {
            return "Maaf, informasi tersebut belum tersedia dalam informasi resmi SMKN 2 Mojokerto. Silakan hubungi admin sekolah.";
        }

        $promptLower = mb_strtolower(trim($userPrompt));

        // 1. First, check for specific sub-keywords to find exact matching detail chunk
        $targetChunk = null;
        $specificKeywords = [
            'lps' => ['lps', 'perbankan syariah'],
            'rpl' => ['rpl', 'rekayasa perangkat lunak'],
            'dkv' => ['dkv', 'desain komunikasi visual'],
            'aphp' => ['aphp', 'pertanian'],
            'kuliner' => ['kuliner', 'tata boga', 'boga'],
            'robotik' => ['robotik', 'coding club'],
            'pramuka' => ['pramuka'],
            'paskibra' => ['paskibra'],
            'pmr' => ['pmr', 'palang merah'],
            'olahraga' => ['futsal', 'basket', 'voli', 'olahraga', 'seni'],
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

        // 2. If no specific chunk matched, target by general category
        $categoryTarget = null;
        if ($targetChunk === null) {
            if (str_contains($promptLower, 'ekskul') || str_contains($promptLower, 'ekstrakurikuler')) {
                $categoryTarget = 'Ekstrakurikuler';
            } elseif (str_contains($promptLower, 'jurusan') || str_contains($promptLower, 'keahlian') || str_contains($promptLower, 'proli')) {
                $categoryTarget = 'Jurusan';
            } elseif (str_contains($promptLower, 'ppdb') || str_contains($promptLower, 'daftar') || str_contains($promptLower, 'pendaftaran')) {
                $categoryTarget = 'PPDB';
            } elseif (str_contains($promptLower, 'jam') || str_contains($promptLower, 'jadwal') || str_contains($promptLower, 'masuk') || str_contains($promptLower, 'pulang')) {
                $categoryTarget = 'Tata Tertib';
            } elseif (str_contains($promptLower, 'kontak') || str_contains($promptLower, 'alamat') || str_contains($promptLower, 'telepon') || str_contains($promptLower, 'email')) {
                $categoryTarget = 'Profil';
            } elseif (str_contains($promptLower, 'bkk') || str_contains($promptLower, 'pkl') || str_contains($promptLower, 'magang') || str_contains($promptLower, 'industri')) {
                $categoryTarget = 'Karir';
            }

            if ($categoryTarget !== null) {
                foreach ($contextChunks as $chunk) {
                    if (str_contains($chunk, "[{$categoryTarget}]")) {
                        $targetChunk = $chunk;
                        break;
                    }
                }
            }
        }

        if ($targetChunk === null) {
            $targetChunk = $contextChunks[0];
        }

        // 3. Extract title and body content
        $title = '';
        $cleanContent = $targetChunk;

        if (preg_match('/^\[([^\]]+)\]\s*([^:]+):\s*(.*)$/us', $targetChunk, $matches)) {
            $categoryTarget = $categoryTarget ?? $matches[1];
            $title = trim($matches[2]);
            $cleanContent = trim($matches[3]);
        } else {
            $cleanContent = preg_replace('/^\[[^\]]+\]\s*/u', '', $targetChunk);
            $cleanContent = trim((string) $cleanContent);
        }

        // Clean up title for user display (e.g. "Detail Jurusan LPS" -> "Jurusan LPS")
        $displayTitle = preg_replace('/^Detail\s+/i', '', $title);

        // 4. Format into a natural, friendly conversational response
        if (!empty($displayTitle) && !str_starts_with(mb_strtolower($displayTitle), 'daftar')) {
            return "Berikut informasi mengenai {$displayTitle} di SMK Negeri 2 Mojokerto:\n\n" . $cleanContent . "\n\nAda hal lain yang ingin kamu tanyakan mengenai program sekolah kami?";
        }

        if ($categoryTarget === 'Ekstrakurikuler') {
            return "Berikut adalah kegiatan ekstrakurikuler di SMK Negeri 2 Mojokerto:\n\n" . $cleanContent . "\n\nAda kegiatan ekstrakurikuler tertentu yang ingin kamu ketahui lebih lanjut?";
        }

        if ($categoryTarget === 'Jurusan') {
            return "Berikut adalah konsentrasi keahlian/jurusan di SMK Negeri 2 Mojokerto:\n\n" . $cleanContent . "\n\nKamu tertarik dengan jurusan yang mana?";
        }

        if ($categoryTarget === 'PPDB') {
            return "Berikut informasi resmi pendaftaran PPDB SMK Negeri 2 Mojokerto:\n\n" . $cleanContent;
        }

        if ($categoryTarget === 'Tata Tertib') {
            return "Berikut jadwal dan jam operasional kegiatan di SMK Negeri 2 Mojokerto:\n\n" . $cleanContent;
        }

        if ($categoryTarget === 'Profil') {
            return "Berikut informasi kontak dan alamat resmi SMK Negeri 2 Mojokerto:\n\n" . $cleanContent;
        }

        return "Berdasarkan informasi resmi SMK Negeri 2 Mojokerto:\n\n" . $cleanContent;
    }
}

