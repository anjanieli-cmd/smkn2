<?php

namespace App\Services\Chatbot;

use App\Enums\ChatbotResponseType;
use App\Interfaces\AI\AIProviderInterface;

class ChatbotService
{
    public function __construct(
        private PromptGuardService $promptGuard,
        private KnowledgeRetrieverService $retriever,
        private AIProviderInterface $aiProvider
    ) {}

    /**
     * Process incoming user message and return response array with latency details.
     *
     * @param string $message
     * @return array{response_type: string, message: string, retrieval_ms: float, ai_ms: float, total_ms: float}
     */
    public function processMessage(string $message): array
    {
        $startTime = microtime(true);
        $retrievalMs = 0.0;
        $aiMs = 0.0;

        // 1. Prompt Injection Defense
        if ($this->promptGuard->isPromptInjection($message)) {
            $totalMs = round((microtime(true) - $startTime) * 1000, 2);
            return [
                'response_type' => ChatbotResponseType::BLOCKED->value,
                'message' => 'Maaf, permintaan Anda tidak dapat diproses karena melanggar kebijakan keamanan.',
                'retrieval_ms' => 0.0,
                'ai_ms' => 0.0,
                'total_ms' => $totalMs,
            ];
        }

        // 2. Out of Scope Check (Zero AI calls / zero tokens)
        if ($this->promptGuard->isOutOfScope($message)) {
            $totalMs = round((microtime(true) - $startTime) * 1000, 2);
            return [
                'response_type' => ChatbotResponseType::OUT_OF_SCOPE->value,
                'message' => 'Halo! 👋 Saya NARA SKANEDA (Sahabat & Asisten Digital SMKN 2 Kota Mojokerto). 🏫✨ Saya hanya dapat membantu memberikan informasi resmi seputar SMKN 2 Kota Mojokerto (SKANEDA) dan website ini. Untuk pertanyaan lain, silakan hubungi kontak resmi sekolah kami! 😊',
                'retrieval_ms' => 0.0,
                'ai_ms' => 0.0,
                'total_ms' => $totalMs,
            ];
        }

        // 3. Knowledge Retrieval
        $retrievalStart = microtime(true);
        $contextChunks = $this->retriever->retrieveRelevantContext($message);
        $retrievalMs = round((microtime(true) - $retrievalStart) * 1000, 2);

        if (empty($contextChunks)) {
            $totalMs = round((microtime(true) - $startTime) * 1000, 2);
            return [
                'response_type' => ChatbotResponseType::NOT_FOUND->value,
                'message' => 'Halo! 👋 Saya NARA SKANEDA. 🎓 Informasi spesifik yang kamu tanyakan belum tersedia dalam basis pengetahuan resmi SMKN 2 Kota Mojokerto. Silakan ajukan pertanyaan lain atau hubungi admin sekolah kami! 😊',
                'retrieval_ms' => $retrievalMs,
                'ai_ms' => 0.0,
                'total_ms' => $totalMs,
            ];
        }

        // 4. AI Provider Execution
        $aiStart = microtime(true);
        $aiResponse = $this->aiProvider->generateResponse($message, $contextChunks);
        $aiMs = round((microtime(true) - $aiStart) * 1000, 2);

        // Sanitize any triple asterisks (***) from response
        $aiResponse = str_replace('***', '', $aiResponse);
        $aiResponse = (string) preg_replace('/\*{3,}/', '**', $aiResponse);

        $totalMs = round((microtime(true) - $startTime) * 1000, 2);

        return [
            'response_type' => ChatbotResponseType::ANSWER->value,
            'message' => $aiResponse,
            'retrieval_ms' => $retrievalMs,
            'ai_ms' => $aiMs,
            'total_ms' => $totalMs,
        ];
    }
}
