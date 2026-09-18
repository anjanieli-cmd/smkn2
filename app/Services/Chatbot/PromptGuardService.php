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
        $normalized = mb_strtolower($message);

        foreach ($this->outOfScopePhrases as $phrase) {
            if (str_contains($normalized, $phrase)) {
                return true;
            }
        }

        return false;
    }
}
