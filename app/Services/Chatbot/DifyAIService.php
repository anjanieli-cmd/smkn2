<?php

namespace App\Services\Chatbot;

use App\Interfaces\AI\AIProviderInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DifyAIService implements AIProviderInterface
{
    private string $baseUrl;
    private string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.dify.base_url', env('DIFY_BASE_URL', 'http://localhost/v1'));
        $this->apiKey = config('services.dify.api_key', env('DIFY_API_KEY', ''));
    }

    /**
     * Generate AI response using Dify AI Self-Hosted REST API.
     *
     * @param string $userPrompt
     * @param array<int, string> $contextChunks
     * @return string
     */
    public function generateResponse(string $userPrompt, array $contextChunks): string
    {
        if (empty($this->apiKey)) {
            Log::warning('Dify API Key is not set in environment.');
            return $this->fallbackResponse($userPrompt, $contextChunks);
        }

        try {
            $contextText = !empty($contextChunks) ? implode("\n\n", $contextChunks) : '';

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(15)->post(rtrim($this->baseUrl, '/') . '/chat-messages', [
                'inputs' => [
                    'school_context' => $contextText,
                ],
                'query' => $userPrompt,
                'response_mode' => 'blocking',
                'user' => 'smkn2-student-user',
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['answer']) && !empty($data['answer'])) {
                    return trim($data['answer']);
                }
            }

            Log::error('Dify API Request Failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        } catch (\Throwable $e) {
            Log::error('Dify AI Exception: ' . $e->getMessage());
        }

        return $this->fallbackResponse($userPrompt, $contextChunks);
    }

    private function fallbackResponse(string $userPrompt, array $contextChunks): string
    {
        return app(MockGeminiProvider::class)->generateResponse($userPrompt, $contextChunks);
    }
}
